<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Part::paginate(15);

        return view('part.index', [
            'model' => $model,
        ]);
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
            'part_order' => 'required',
            'part_name' => 'required',
        ]);

        $model = new Part();
        $model->part_order = $request->part_order;
        $model->part_name = $request->part_name;
        $model->save();

        return redirect()->route('part.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
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

        return view('part.form', [
            'model' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'part_order' => 'required',
            'part_name' => 'required',
        ]);

        $model = Part::find($id);
        $model->part_order = $request->part_order;
        $model->part_name = $request->part_name;
        $model->save();

        return redirect()->route('part.index')->with('info', 'แก้ไขข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Part::find($id);
        $model->delete();

        return redirect()->route('part.index')->with('info', 'ลบข้อมูลสำเร็จ');
    }
}
