<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;

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
        // $model->created_by = Auth::user()->id;
        // $model->updated_by = Auth::user()->id;
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
        // $model->updated_by = Auth::user()->id;
        $model->save();

        return redirect()->route('part.index')->with('info', 'แก้ไขข้อมูลสำเร็จ');
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
