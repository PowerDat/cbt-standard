<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartController extends Controller
{
    // public function __construct()
    // {   
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('part.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = Part::all()->count();
        $count_order = $order + 1;

        return view('part.form', [
            'count_order' => $count_order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part_order' => 'required|numeric|unique:part',
            'part_name' => 'required',
        ], [
            'part_order.required' => 'กรอกลำดับเกณฑ์มาตรฐาน',
            'part_order.numeric' => 'กรอกลำดับเกณฑ์มาตรฐาน(เฉพาะตัวเลข)',
            'part_order.unique' => 'ลำดับเกณฑ์มาตรฐานมีอยู่แล้วในระบบ(ห้ามซ้ำ)',
            'part_name.required' => 'กรอกชื่อลำดับเกณฑ์มาตรฐาน',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else {
            $model = new Part();
            $model->part_order = $request->part_order;
            $model->part_name = $request->part_name;
            $model->part_detail = $request->part_detail;
            $model->created_by = '';
            $model->updated_by = '';
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'part_id' => $model->part_id,
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
        $model = Part::find($id);
        $partTarget = PartTarget::where('part_id', $id)->get();

        return view('part.form-edit', [
            'model' => $model,
            'partTarget' => $partTarget,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'part_order' => 'required|numeric',
            'part_name' => 'required',
        ], [
            'part_order.required' => 'กรอกลำดับเกณฑ์มาตรฐาน',
            'part_order.numeric' => 'กรอกลำดับเกณฑ์มาตรฐาน(เฉพาะตัวเลข)',
            'part_name.required' => 'กรอกชื่อลำดับเกณฑ์มาตรฐาน',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else {
            $model = Part::find($id);
            $model->part_order = $request->part_order;
            $model->part_name = $request->part_name;
            $model->part_detail = $request->part_detail;
            $model->updated_by = '';
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
    public function delete(Request $request)
    {
        $id = $request->part_id;
        
        if (PartTarget::where('part_id', $id)->count() > 0) {
            
            return response()->json([
                'status' => 0,
                'msg' => 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลเป้าประสงค์ใช้งานอยู่',
            ]);
        } 
        else {
            $model = Part::find($id);
            $model->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'ลบข้อมูลสำเร็จ',
            ]);
        }
    }
}
