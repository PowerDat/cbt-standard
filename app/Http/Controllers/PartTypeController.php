<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = PartType::all();

        return view('part-type.index', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('part-type.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part_type_name' => 'required',
        ], [
            'part_type_name.required' => 'กรอกชื่อประเภทเกณฑ์มาตรฐาน',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $model = new PartType();
            $model->part_type_name = $request->part_type_name;
            $model->part_type_detail = $request->part_type_detail;
            $model->created_by = Auth::user()->id;
            $model->updated_by = Auth::user()->id;
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'part_type_id' => $model->part_type_id,
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
        $model = PartType::find($id);
        $part = Part::where('part_type_id', $id)->get();

        return view('part-type.form-edit', [
            'model' => $model,
            'part' => $part,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'part_type_name' => 'required',
        ], [
            'part_type_name.required' => 'กรอกชื่อประเภทเกณฑ์มาตรฐาน',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $model = PartType::find($id);
            $model->part_type_name = $request->part_type_name;
            $model->part_type_detail = $request->part_type_detail;
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

    public function delete(Request $request)
    {
        $id = $request->part_type_id;
        
        if (Part::where('part_type_id', $id)->count() > 0) {
            
            return response()->json([
                'status' => 0,
                'msg' => 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลเกณฑ์มาตรฐานใช้งานอยู่',
            ]);
        } 
        else {
            $model = PartType::find($id);
            $model->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'ลบข้อมูลสำเร็จ',
            ]);
        }
    }
}
