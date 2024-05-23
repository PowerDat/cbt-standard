<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\PartTargetSub;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function createByPartId($id)
    {
        $part = Part::all();

        return view('part-target.form', [
            'part' => $part,
            'part_id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part_id' => 'required',
            'part_target_order' => 'required|numeric|unique:part_target',
            'part_target_name' => 'required',
        ], [
            'part_id.required' => 'กรอกข้อมูลด้านเกณฑ์มาตรฐาน',
            'part_target_order.required' => 'กรอกลำดับเป้าประสงค์',
            'part_target_order.numeric' => 'กรอกลำดับเป้าประสงค์(เฉพาะตัวเลข)',
            'part_target_order.unique' => 'ลำดับเป้าประสงค์มีอยู่แล้วในระบบ(ห้ามซ้ำ)',
            'part_target_name.required' => 'กรอกข้อมูลเป้าประสงค์',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else {
            //PartTarget
            $model = new PartTarget();
            $model->part_target_order = $request->part_target_order;
            $model->part_id = $request->part_id;
            $model->part_target_name = $request->part_target_name;
            $model->created_by = '';
            $model->updated_by = '';
            $model->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'part_target_id'  => $model->part_target_id,
            ]);
        }
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
        $partTargetByPartId = DB::table('part')
            ->join('part_target', 'part.part_id', '=', 'part_target.part_id')
            ->leftJoin('part_target_sub', 'part_target.part_target_id', '=', 'part_target_sub.part_target_id')
            ->select('part_order', 'part_name', 'part_target.part_target_id', 'part_target_order', 'part_target_name', 'part_target_sub.part_target_sub_id', 'part_target_sub_order', 'part_target_sub_name')
            ->where('part_target.part_target_id', $id)
            ->paginate(10);
        // dd($partTargetByPartId);
        return view('part-target.form-edit', [
            'part' => $part,
            'partTarget' => $partTarget,
            'partTargetByPartId' => $partTargetByPartId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'part_target_order' => 'required|numeric',
            'part_target_name' => 'required',
        ], [
            'part_target_order.required' => 'กรอกลำดับเป้าประสงค์',
            'part_target_order.numeric' => 'กรอกลำดับเป้าประสงค์(เฉพาะตัวเลข)',
            'part_target_name.required' => 'กรอกข้อมูลเป้าประสงค์',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } 
        else {
            $model = PartTarget::find($id);
            $model->part_target_order = $request->part_target_order;
            $model->part_target_name = $request->part_target_name;
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
