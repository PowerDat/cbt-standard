<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    } 

    public function postLogin(Request $request)
    {
        $role_id = "";

        $validator = Validator::make($request->all(), 
            [
                "user_login" => 'required',
                "password" => 'required'
            ], 
            [
                "user_login.required" => 'กรอกชื่อผู้ใช้',
                "password.required" => 'กรอกรหัสผ่าน'
            ]
        );
  
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        else 
        {
            //call api
            $link = DB::select("select config_value from config where config_key = 'signon'");

            //check login from api
            $response = Http::post($link[0]->config_value, [
                'username' => $request->user_login,
                'password' => $request->password,
            ]);
            
            // หาชื่อไม่เจอจาก api 
            if($response->json('statusCode') == '403')
            {
                //login form database
                if (Auth::attempt(["name" => $request->user_login, "password" => $request->password])) 
                {
                    
                    foreach (Auth::user()->roles as $value) {
                        $role_id = $value->id;
                    }

                    $route = $this->getRoute($role_id);

                    return response()->json([
                        "status" => 1, 
                        "redirect" => route($route),
                    ]);
                } 
                else
                {
                    return response()->json([
                        'status' => 403,
                        'error' => 'ชื่อหรือรหัสผ่านไม่ถูกต้อง',
                    ]);
                }
            }
            else //หาเจอ
            {
                session()->put('community_name', $response->json('community.community_name'));
                session()->put('community_latitude', $response->json('community.community_latitude'));
                session()->put('community_longitude', $response->json('community.community_longitude'));

                session()->put('user_name', $response->json('user_name'));
                session()->put('user_surname', $response->json('user_surname'));
                session()->put('user_image_cover', $response->json('user_image_cover'));

                $user = User::select('email')->where('name', $request->user_login)->get();
                //มีข้อมูลในฐานข้อมูล
                if($user->count() > 0)
                {
                    if (Auth::attempt(["email" => $user[0]->email, "password" => $request->password])) 
                    {
                        foreach (Auth::user()->roles as $value) {
                            $role_id = $value->id;
                        }   

                        $route = $this->getRoute($role_id);

                        return response()->json([
                            "status" => 1, 
                            "redirect" => route($route),
                        ]);
                    } 
                }
                else
                {
                    $role = Role::select('id')->where('name', $response->json('role_name'))->get();
                    
                    //create user
                    $user = new User();
                    $user->name = $request->user_login;
                    $user->email = $response->json('user_email');
                    $user->password = Hash::make($request->password);
                    $user->save();

                    //create user_role
                    $user_role = new UserRole();
                    $user_role->user_id = $user->id;
                    $user_role->role_id = $role[0]->id;
                    $user_role->save();

                    foreach (Auth::user()->roles as $value) {
                        $role_id = $value->id;
                    }

                    $route = $this->getRoute($role_id);

                    if (Auth::attempt(["email" => $response->json('user_email'), "password" => $request->password])) 
                    {
                        return response()->json([
                            "status" => 1, 
                            "redirect" => route($route),
                        ]);
                    }
                }
            }
        }
    }

    public function logout() 
    {
        session()->flush();
        Auth::logout();
    
        return redirect()->route('auth.login');
    }

    public function getRoute($id)
    {
        $url = DB::select("
        SELECT permissions.route
        FROM permission_role 
        INNER JOIN permissions ON permission_role.permission_id = permissions.id
        WHERE role_id = $id
            AND NAME LIKE '%dashboard%'
        ");

        $route = $url[0]->route;

        return $route;
    }

}
