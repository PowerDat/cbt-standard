<?php

namespace App\Http\Controllers;

use App\Models\PartTargetSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartTargetSubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = DB::table('part_target_sub')
                    ->join('part_target', 'part_target_sub.part_target_id', '=', 'part_target.part_target_id')
                    ->join('part', 'part_target.part_id', '=', 'part.part_id')
                    ->select('part_order', 'part_target_order', 'part_target_sub_order', 'part_target_sub_name', 'part_target_sub_id')
                    ->paginate(15);

        return view('part-target-sub.index', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $part = DB::select("
        SELECT part_target_id
            ,  CONCAT(part_order, '. ', part_name, ' - ', part_target_order, ' ', part_target_name)  AS part_target_name
        FROM part 
        INNER JOIN part_target ON part.part_id = part_target.part_id
        ");

        return view('part-target-sub.form', [
            'part' => $part,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'part_target_sub_order' => 'required',
            'part_target_id' => 'required',
            'part_target_sub_name' => 'required',
            'part_target_sub_desc' => 'required',
        ]);

        $model = new PartTargetSub();
        $model->part_target_sub_order = $request->part_target_sub_order;
        $model->part_target_id = $request->part_target_id;
        $model->part_target_sub_name = $request->part_target_sub_name;
        $model->part_target_sub_desc = $request->part_target_sub_desc;
        $model->save();

        return redirect()->route('part-target-sub.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
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
        $model = PartTargetSub::find($id);

        $part = DB::select("
        SELECT part_target_id
            ,  CONCAT(part_order, '. ', part_name, ' - ', part_target_order, ' ', part_target_name)  AS part_target_name
        FROM part 
        INNER JOIN part_target ON part.part_id = part_target.part_id
        ");

        return view('part-target-sub.form', [
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
            'part_target_sub_order' => 'required',
            'part_target_id' => 'required',
            'part_target_sub_name' => 'required',
            'part_target_sub_desc' => 'required',
        ]);

        $model = PartTargetSub::find($id);
        $model->part_target_sub_order = $request->part_target_sub_order;
        $model->part_target_id = $request->part_target_id;
        $model->part_target_sub_name = $request->part_target_sub_name;
        $model->part_target_sub_desc = $request->part_target_sub_desc;
        $model->save();

        return redirect()->route('part-target-sub.index')->with('info', 'แก้ไขข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = PartTargetSub::find($id);
        $model->delete();
    
        return redirect()->route('part-target-sub.index')->with('info', 'ลบข้อมูลสำเร็จ');
    }
}
