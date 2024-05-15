<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\PartTargetSub;

class PartTargetController extends Controller
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
        return view('part-target.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $part = Part::all();

        return view('part-target.form', [
            'part' => $part,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'part_id' => 'required',
            'part_target_order' => 'required|numeric',
            'part_target_name' => 'required',
        ], [
            'part_id.required' => 'กรอกข้อมูลด้านเกณฑ์มาตรฐาน',
            'part_target_order.required' => 'กรอกข้อมูลลำดับเป้าประสงค์',
            'part_target_order.numeric' => 'กรอกลำดับเป้าประสงค์(เฉพาะตัวเลข)',
            'part_target_name.required' => 'กรอกข้อมูลข้อมูลเป้าประสงค์',
        ]);

        //PartTarget
        $model = new PartTarget();
        $model->part_target_order = $request->part_target_order;
        $model->part_id = $request->part_id;
        $model->part_target_name = $request->part_target_name;
        $model->created_by = '';
        $model->updated_by = '';
        $model->save();

        session()->flash('success', 'เพิ่มข้อมูลสำเร็จ');

        return response()->json([
            'success'  => 'success',
            'part_target_id'  => $model->part_target_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $part = Part::all();
        $partTarget = PartTarget::find($id);

        return view('part-target.form-edit', [
            'part' => $part,
            'partTarget' => $partTarget,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'part_id' => 'required',
            'part_target_order' => 'required|numeric',
            'part_target_name' => 'required',
        ], [
            'part_id.required' => 'กรอกข้อมูลด้านเกณฑ์มาตรฐาน',
            'part_target_order.required' => 'กรอกข้อมูลลำดับเป้าประสงค์',
            'part_target_order.numeric' => 'กรอกลำดับเป้าประสงค์(เฉพาะตัวเลข)',
            'part_target_name.required' => 'กรอกข้อมูลข้อมูลเป้าประสงค์',
        ]);

        $model = PartTarget::find($id);
        $model->part_target_order = $request->part_target_order;
        $model->part_id = $request->part_id;
        $model->part_target_name = $request->part_target_name;
        $model->updated_by = '';
        $model->save();

        session()->flash('info', 'แก้ไขข้อมูลสำเร็จ');

        return response()->json([
            'success'  => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (PartTargetSub::count() > 0) {
            return redirect()->back()->with('info', 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลเกณฑ์ย่อยใช้งานอยู่');
        } else {
            $model = PartTarget::find($id);
            $model->delete();

            return redirect()->route('part-target.index')->with('info', 'ลบข้อมูลสำเร็จ');
        }
    }
}
