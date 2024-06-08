<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserRole;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('role.index', [
            'roles' => $roles,
            'n' => 1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
        ], [
            'name.required' => 'กรอกชื่อบทบาท',
            'name.unique' => 'ชื่อบทบาทมีอยู่แล้วในระบบ(ห้ามซ้ำ)',
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
            $model = new Role();
            $model->name = $request->name;
            $model->detail = $request->detail;
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
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
        $role = Role::find($id);

        $permisson = Permission::all();

        return view('role.edit', [
            'role' => $role,
            'permisson' => $permisson,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'กรอกชื่อบทบาท',
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
            $model = Role::find($id);
            $model->name = $request->name;
            $model->detail = $request->detail;
            $model->save();

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
        $id = $request->role_id;

        $role_id = UserRole::where('role_id', $id)->count(); 
        if($role_id > 0)
        {
            DB::table('user_role')->where('role_id', $id)->delete();
        }

        $role = Role::find($id);
        if($role->count() > 0)
        {
            $role->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'ลบข้อมูลสำเร็จ',
            ]);
        }
    }

    public function assignPermission(Request $request, Role $role)
    {
        $role->permission()->sync($request->permission);

        return response()->json([
            'status' => 1,
            'msg' => 'Permission added',
        ]);
    }

}
