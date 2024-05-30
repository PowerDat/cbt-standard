<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $validator = Validator::make($request->all(), [
            "user_login" => 'required',
            "password" => 'required'
        ]);
  
        if ($validator->fails())
        {
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        } 
        else 
        {
            $link = DB::select("select config_value from config where config_key = 'signon'");
            // dd($link[0]->config_value);

            $response = Http::post($link[0]->config_value, [
                'username' => $request->user_login,
                'password' => $request->password,
            ]);
           
            $user = User::select('role_id', 'email')->where('name', $request->user_login)->get();
            
            if($user->count() > 0)
            {
                $role_id = $user[0]->role_id;

                if($role_id == 1)
                {
                    session()->put('community_name', $response->json('community.community_name'));
                    session()->put('community_latitude', $response->json('community.community_latitude'));
                    session()->put('community_longitude', $response->json('community.community_longitude'));
                }

                if($role_id == 2)
                {
                    session()->put('user_name', $response->json('user_name'));
                    session()->put('user_surname', $response->json('user_surname'));
                    session()->put('user_image_cover', $response->json('user_image_cover'));
                }

                if (Auth::attempt(["email" => $user[0]->email, "password" => $request->password])) 
                {
                    return response()->json([
                        "status" => true, 
                        "redirect" => url("dashboard")
                    ]);
                } 
                else 
                {
                    return response()->json([
                        "status" => false,
                        "errors" => ["อีเมลหรือรหัสผ่านไม่ถูกต้อง"]
                    ]);
                }
            }
            else
            {
                $role = Role::select('id')->where('name', $response->json('role_name'))->get();

                $user = new User();
                $user->name = $request->user_login;
                $user->email = $response->json('user_email');
                $user->password = Hash::make($request->password);
                $user->role_id = $role[0]->id;
                $user->save();

                if($role[0]->id == 1)
                {
                    session()->put('community_name', $response->json('community.community_name'));
                    session()->put('community_latitude', $response->json('community.community_latitude'));
                    session()->put('community_longitude', $response->json('community.community_longitude'));
                }

                if($role[0]->id == 2)
                {
                    session()->put('user_name', $response->json('user_name'));
                    session()->put('user_surname', $response->json('user_surname'));
                    session()->put('user_image_cover', $response->json('user_image_cover'));
                }

                if (Auth::attempt(["email" => $response->json('user_email'), "password" => $request->password])) 
                {
                    return response()->json([
                        "status" => true, 
                        "redirect" => url("dashboard")
                    ]);
                } 
                else 
                {
                    return response()->json([
                        "status" => false,
                        "errors" => ["อีเมลหรือรหัสผ่านไม่ถูกต้อง"]
                    ]);
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
}
