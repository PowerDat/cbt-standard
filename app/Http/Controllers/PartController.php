<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'part_order' => 'required|numeric',
            'part_name' => 'required',
        ], [
            'part_order.required' => 'กรอกลำดับด้านเกณฑ์มาตรฐาน',
            'part_order.numeric' => 'กรอกลำดับด้านเกณฑ์มาตรฐาน(เฉพาะตัวเลข)',
            'part_name.required' => 'กรอกข้อมูลด้านเกณฑ์มาตรฐาน',
        ]);

        $model = new Part();
        $model->part_order = $request->part_order;
        $model->part_name = $request->part_name;
        $model->part_detail = $request->part_detail;
        $model->created_by = '';
        $model->updated_by = '';
        $model->save();

        session()->flash('success', 'เพิ่มข้อมูลสำเร็จ');

        return response()->json([
            'success'  => 'success',
            'part_id' => $model->part_id,
        ]);

        // return redirect()->route('part.edit', $model->part_id);
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

        return view('part.form-edit', [
            'model' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'part_order' => 'required|numeric',
            'part_name' => 'required',
        ], [
            'part_order.required' => 'กรอกลำดับด้านเกณฑ์มาตรฐาน',
            'part_order.numeric' => 'กรอกลำดับด้านเกณฑ์มาตรฐาน(เฉพาะตัวเลข)',
            'part_name.required' => 'กรอกข้อมูลด้านเกณฑ์มาตรฐาน',
        ]);

        $model = Part::find($id);
        $model->part_order = $request->part_order;
        $model->part_name = $request->part_name;
        $model->part_detail = $request->part_detail;
        $model->updated_by = '';
        $model->save();

        session()->flash('info', 'แก้ไขข้อมูลสำเร็จ');

        return response()->json([
            'success'  => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(PartTarget::where('part_id', $id)->count() > 0){
            return redirect()->back()->with('info', 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลเป้าประสงค์ใช้งานอยู่');
        }
        else{
            $model = Part::find($id);
            $model->delete();
    
            return redirect()->route('part.index')->with('info', 'ลบข้อมูลสำเร็จ');
        }
    }
}
