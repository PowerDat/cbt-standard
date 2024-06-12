<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        $roles = Role::paginate(10);
        
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
        // $this->authorize('create', Role::class);

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
                'id' => $model->id,
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
        $menus = Menu::where('menu_status', 'Y')->orderBy('menu_order', 'asc')->get();
        $permisson = Permission::all();

        return view('role.edit', [
            'role' => $role,
            'permisson' => $permisson,
            'menus' => $menus,
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

        $permission = DB::table('permission_role')->where('role_id', $id)->get();
        if($permission->count() > 0)
        {
            DB::table('permission_role')->where('role_id', $id)->delete();
        }

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
        // dd($request->permission_name);
        $permission_role = DB::table('permission_role')->where('role_id', $role->id)->get();
        
        //ลบข้อมูล
        if($permission_role->count() > 0)
        {
            DB::table('permission_role')->where('role_id', $role->id)->delete();

            foreach($permission_role as $a)
            {
                DB::table('permissions')->where('id', $a->permission_id)->delete();
            }
        }

        // เพิ่มข้อมูล
        foreach ($request->permission_name as $value) 
        {
            $name_replace = str_replace('.index', '', $value);

            $permission = new Permission();
            $permission->name = $name_replace;

            $explode = explode("-", $value);
            // dd($explode);
            $action = ($explode[0]);

            $str_view = str_replace('view-', '', $value);
            $str_create = str_replace('create-', '', $value);
            $str_update = str_replace('update-', '', $value);
            $str_delete = str_replace('delete-', '', $value);

            if($str_view != ""){
                $permission->route = $str_view;
            }
            elseif ($str_create != "") {
                $permission->route = $str_create;
            }
            elseif ($str_update != "") {
                $permission->route = $str_update;
            }
            elseif ($str_delete != "") {
                $permission->route = $str_delete;
            }
            
            $permission->action = $action;

            $permission->save();

            $permission_id = $permission->id;
                
            DB::table('permission_role')->insert([
                'role_id' => $role->id,
                'permission_id' => $permission_id,
            ]);
        }

        return response()->json([
            'status' => 1,
            'msg' => 'กำหนดสิทธิ์สำเร็จ',
        ]);
    }

}
