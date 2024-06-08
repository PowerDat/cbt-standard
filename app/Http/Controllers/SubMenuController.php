<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = SubMenu::where('menu_status', 'Y')->paginate(10);
        
        return view('sub-menu.index', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createByMenuId($id)
    {
        $menu = Menu::all();

        return view('sub-menu.create', [
            'menu_id' => $id,
            'menu' => $menu,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_menu_order' => 'required|unique:sub_menu|numeric|min:1',
            'sub_menu_name' => 'required',
            'sub_menu_route' => 'required',
            'sub_menu_status' => 'required',
        ], [
            'sub_menu_order.required' => 'กรอกลำดับเมนูย่อย',
            'sub_menu_order.unique' => 'ลำดับเมนูย่อยมีอยู่แล้วในระบบ(ห้ามซ้ำ)',
            'sub_menu_order.numeric' => 'ลำดับเมนูย่อยต้องเป็นตัวเลขเท่านั้น',
            'sub_menu_order.min' => 'ลำดับเมนูย่อยห้ามต่ำกว่า 1',
            'sub_menu_name.required' => 'กรอกชื่อเมนูย่อย',
            'sub_menu_route.required' => 'กรอกRoute',
            'sub_menu_status.required' => 'กรอกสถานะ',
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
            $model = new SubMenu();
            $model->menu_id = $request->menu_id;
            $model->sub_menu_order = $request->sub_menu_order;
            $model->sub_menu_name = $request->sub_menu_name;
            $model->sub_menu_route = $request->sub_menu_route;
            $model->sub_menu_status = $request->sub_menu_status;
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'id' => $model->sub_menu_id,
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
        $sub_menu = SubMenu::find($id);
        $menu = Menu::all();

        return view('sub-menu.edit', [
            'menu' => $menu,
            'sub_menu' => $sub_menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'sub_menu_order' => 'required|numeric|min:1',
            'sub_menu_name' => 'required',
            'sub_menu_route' => 'required',
            'sub_menu_status' => 'required',
        ], [
            'sub_menu_order.required' => 'กรอกลำดับเมนูย่อย',
            'sub_menu_order.numeric' => 'ลำดับเมนูย่อยต้องเป็นตัวเลขเท่านั้น',
            'sub_menu_order.min' => 'ลำดับเมนูย่อยห้ามต่ำกว่า 1',
            'sub_menu_name.required' => 'กรอกชื่อเมนูย่อย',
            'sub_menu_route.required' => 'กรอกRoute',
            'sub_menu_status.required' => 'กรอกสถานะ',
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
            $model = SubMenu::find($id);
            $model->sub_menu_order = $request->sub_menu_order;
            $model->sub_menu_name = $request->sub_menu_name;
            $model->sub_menu_route = $request->sub_menu_route;
            $model->sub_menu_status = $request->sub_menu_status;
            $model->updated_by = Auth::user()->id;
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'แก้ไขข้อมูลสำเร็จ',
                'menu_id' => $model->menu_id,
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
}
