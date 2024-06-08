<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::where('menu_status', 'Y')->orderBy('menu_order', 'asc')->paginate(10);

        return view('menu.index', [
            'menu' => $menu,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_order' => 'required|unique:menu|numeric|min:1',
            'menu_name' => 'required',
            'menu_route' => 'required',
            'menu_status' => 'required',
        ], [
            'menu_order.required' => 'กรอกลำดับเมนู',
            'menu_order.unique' => 'ลำดับเมนูมีอยู่แล้วในระบบ(ห้ามซ้ำ)',
            'menu_order.numeric' => 'ลำดับเมนูต้องเป็นตัวเลขเท่านั้น',
            'menu_order.min' => 'ลำดับเมนูห้ามต่ำกว่า 1',
            'menu_name.required' => 'กรอกชื่อเมนู',
            'menu_route.required' => 'กรอกRoute',
            'menu_status.required' => 'กรอกสถานะ',
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
            $model = new Menu();
            $model->menu_order = $request->menu_order;
            $model->menu_name = $request->menu_name;
            $model->menu_route = $request->menu_route;
            $model->menu_status = $request->menu_status;
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'id' => $model->menu_id,
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
        $model = Menu::find($id);
        $sub_menu = SubMenu::where('menu_id', $id)->get();

        return view('menu.edit', [
            'model' => $model,
            'sub_menu' => $sub_menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'menu_order' => 'required|numeric|min:1',
            'menu_name' => 'required',
            'menu_route' => 'required',
            'menu_status' => 'required',
        ], [
            'menu_order.required' => 'กรอกลำดับเมนู',
            'menu_order.numeric' => 'ลำดับเมนูต้องเป็นตัวเลขเท่านั้น',
            'menu_order.min' => 'ลำดับเมนูห้ามต่ำกว่า 1',
            'menu_name.required' => 'กรอกชื่อเมนู',
            'menu_route.required' => 'กรอกRoute',
            'menu_status.required' => 'กรอกสถานะ',
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
            $model = Menu::find($id);
            $model->menu_order = $request->menu_order;
            $model->menu_name = $request->menu_name;
            $model->menu_route = $request->menu_route;
            $model->menu_status = $request->menu_status;
            $model->updated_by = Auth::user()->id;
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
}
