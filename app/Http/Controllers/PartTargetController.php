<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use App\Models\PartTargetSub;
use Illuminate\Http\Request;

class PartTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = PartTarget::paginate(15);

        return view('part-target.index', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $part = Part::select('part_id', 'part_name', 'part_order')->get();

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
            'part_target_order' => 'required',
            'part_id' => 'required',
            'part_target_name' => 'required',
        ]);

        $model = new PartTarget();
        $model->part_target_order = $request->part_target_order;
        $model->part_id = $request->part_id;
        $model->part_target_name = $request->part_target_name;
        $model->save();

        return redirect()->route('part-target.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
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
        $model = PartTarget::find($id);
        $part = Part::select('part_id', 'part_name')->get();

        return view('part-target.form', [
            'part' => $part,
            'model' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'part_target_order' => 'required',
            'part_id' => 'required',
            'part_target_name' => 'required',
        ]);

        $model = PartTarget::find($id);
        $model->part_target_order = $request->part_target_order;
        $model->part_id = $request->part_id;
        $model->part_target_name = $request->part_target_name;
        $model->save();

        return redirect()->route('part-target.index')->with('info', 'แก้ไขข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(PartTargetSub::count() > 0){
            return redirect()->back()->with('info', 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลเกณฑ์ย่อยใช้งานอยู่');
        }
        else{
            $model = PartTarget::find($id);
            $model->delete();
    
            return redirect()->route('part-target.index')->with('info', 'ลบข้อมูลสำเร็จ');
        }
    }
}
