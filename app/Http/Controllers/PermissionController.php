<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::paginate(10);

        return view('permission.index', [
            'permission' => $permission,
            'n' => 1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions',
        ], [
            'name.required' => 'กรอกชื่อสิทธิ์',
            'name.unique' => 'ชื่อสิทธิ์มีอยู่แล้วในระบบ(ห้ามซ้ำ)',
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
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->save();

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
        $permission = Permission::find($id);

        return view('permission.edit', [
            'permission' => $permission,
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
            'name.required' => 'กรอกชื่อสิทธิ์',
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
            $permission = Permission::find($id);
            $permission->name = $request->name;
            $permission->save();

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
        $id = $request->permission_id;

        $permission = Permission::find($id);

        if($permission->count() > 0)
        {
            $permission->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'ลบข้อมูลสำเร็จ',
            ]);
        }
    }
}
