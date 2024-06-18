<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Helper\Helper;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{   
    public function index()
    {
            $users = DB::table('users')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->select('users.id', 'users.name', 'users.email', 'user_role.role_id')
            ->paginate(10);
        

        $roles = Role::all();

        return view('user.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role_name = Helper::getRoleName();
        $roles = Role::all();
        $response_community_by_api = Helper::getCommunityByApi();

        return view('user.create', [
            'roles' => $roles,
            'role_name' => $role_name,
            'response_community_by_api' => $response_community_by_api,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ], [
            'role_id.required' => 'กรอกบทบาท',
            'name.required' => 'กรอกชื่อผู้ใช้',
            'email.required' => 'กรอกอีเมล',
            'email.unique' => 'อีเมลมีอยู่แล้วในระบบ(ห้ามซ้ำ)',
            'password.required' => 'กรอกรหัสผ่าน',
            'password.min' => 'รหัสผ่านต้องไม่ต่ำกว่า 6 ตัวอักษร',
            'confirm_password.required' => 'กรอกยืนยันรหัสผ่าน',
            'confirm_password.min' => 'ยืนยันรหัสผ่านต้องไม่ต่ำกว่า 6 ตัวอักษร',
            'confirm_password.same' => 'ตัวอักษรไม่เหมือนกับรหัสผ่าน',
        ]);

        if (!$validator->passes()) 
        {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_by = Auth::user()->id;
            $user->updated_by = Auth::user()->id;
            $user->save();

            //create user_role
            $user_role = new UserRole();
            $user_role->user_id = $user->id;
            $user_role->role_id = $request->role_id;
            $user_role->save();

            foreach($request->community as $value)
            {
                DB::select("
                INSERT INTO user_community (users_id, community_id)
                VALUES ($user->id, $value);
                ");
            }

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'id' => $user->id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $array_community = [];
        $user = User::find($id);
        $roles = Role::all();
        $user_role = UserRole::where('user_id', $id)->get();
        $user_role_id = $user_role[0]->role_id;
        $community = DB::select("
        select community_id from user_community where users_id = $id
        ");
        foreach ($community as $key => $value) {
            array_push($array_community, $value->community_id);
        }
        // dd($array_community);
        $response_community_by_api = Helper::getCommunityByApi();

        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
            'user_role_id' => $user_role_id,
            'response_community_by_api' => $response_community_by_api,
            'array_community' => $array_community,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->community);
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'role_id.required' => 'กรอกบทบาท',
            'name.required' => 'กรอกชื่อผู้ใช้',
            'email.required' => 'กรอกอีเมล',
        ]);

        if (!$validator->passes()) 
        {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else
        {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->updated_by = Auth::user()->id;
            $user->save();

            //create user_role
            $user_role = UserRole::where('user_id', $id)->get();

            foreach ($user_role as $item) 
            {
                $item->role_id = $request->role_id;
                $item->save();
            }
            //delect community evaluate
            $count_community = DB::select("SELECT COUNT(*) as num FROM user_community WHERE users_id = $id");
            // $deleted_community = DB::select("DELETE FROM user_community WHERE users_id = $id");
            //create community evaluate
            if($count_community[0]->num > 0)
            {
                DB::select("DELETE FROM user_community WHERE users_id = $id");
                
                foreach($request->community as $value)
                {
                    DB::select("
                    INSERT INTO user_community (users_id, community_id)
                    VALUES ($id, $value);
                    ");
                }
            }

            return response()->json([
                'status' => 1,
                'msg' => 'แก้ไขข้อมูลสำเร็จ',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->user_id;

        $count_community = DB::select("SELECT COUNT(*) as num FROM user_community WHERE users_id = $id");
        //create community evaluate
        if($count_community[0]->num > 0)
        {
            DB::select("DELETE FROM user_community WHERE users_id = $id");
        }

        $user_role = UserRole::where('user_id', $id)->count();
        if($user_role > 0)
        {
            DB::table('user_role')->where('user_id', $id)->delete();
        }

        $user = User::find($id);
        if($user->count() > 0)
        {
            $user->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'ลบข้อมูลสำเร็จ',
            ]);
        }
    }

    public function changePassword($id)
    {
        $user = User::find($id);

        return view('user.change-password', [
            'user' => $user,
        ]);
    }

    public function saveChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'required|min:6|same:new_password',
        ], [
            'new_password.required' => 'กรอกรหัสผ่าน',
            'new_password.min' => 'รหัสผ่านต้องไม่ต่ำกว่า 6 ตัวอักษร',
            'new_confirm_password.required' => 'กรอกยืนยันรหัสผ่าน',
            'new_confirm_password.min' => 'ยืนยันรหัสผ่านต้องไม่ต่ำกว่า 6 ตัวอักษร',
            'new_confirm_password.same' => 'ตัวอักษรไม่เหมือนกับรหัสผ่านใหม่',
        ]);

        if (!$validator->passes()) 
        {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else
        {
            $user = User::find($request->user_id);
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => 1,
                'msg' => 'แก้ไขรหัสผ่านสำเร็จ',
            ]);
        }
        

    }

}
