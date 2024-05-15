<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartIndexScore;
use App\Models\PartIndexQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartIndexController extends Controller
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
        $model = DB::table('part_target_sub')
                    ->join('part_target', 'part_target_sub.part_target_id', '=', 'part_target.part_target_id')
                    ->join('part', 'part_target.part_id', '=', 'part.part_id')
                    ->select('part_order', 'part_target.part_id', 'part_target_order', 'part_target_sub.part_target_id', 'part_target_sub_order', 'part_target_sub_name', 'part_target_sub_id')
                    ->paginate(15);

        return view('part-index.index', [
            'model' => $model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function createById($id)
    {
        $model = DB::table('part_target_sub')
            ->join('part_target', 'part_target_sub.part_target_id', '=', 'part_target.part_target_id')
            ->join('part', 'part_target.part_id', '=', 'part.part_id')
            ->select('part_order', 'part_name', 'part_target_order', 'part_target_name',  'part_target_sub_order', 'part_target_sub_name', 'part_target_sub_id')
            ->where('part_target_sub_id', $id)
            ->get();

        $question = PartIndexQuestion::where('part_target_sub_id', $id)->count();
        $score = PartIndexScore::where('part_target_sub_id', $id)->count();

        if($question > 0 || $score > 0){
            $data_score = PartIndexScore::where('part_target_sub_id', $id)->orderBy('part_index_score_order', 'asc')->get();
            $data_question = PartIndexQuestion::where('part_target_sub_id', $id)->orderBy('part_index_question_order', 'asc')->get();
            //dd($data);
            return view('part-index.form-edit', [
                'id' => $id,
                'data_score' => $data_score,
                'data_question' => $data_question,
                'model' => $model,
            ]);
        }
        else{
            return view('part-index.form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_question' => 'required',
            'inputs_score.*.name_score' => 'required'
        ]);

        $question = $request->name_question;

        foreach ($question as $key => $value) {
            $model = new PartIndexQuestion();
            $model->part_index_question_order = ($key + 1);
            $model->part_index_question_desc = $value;
            $model->part_target_sub_id = $request->part_target_sub_id;
            $model->created_by = '';
            $model->updated_by = '';
            $model->save();
        }

        foreach ($request->inputs_score as $key => $items) {
            foreach ($items as $item) {
                $score = new PartIndexScore();
                $score->part_target_sub_id = $request->part_target_sub_id;
                $score->part_index_score_order = ($key + 1);
                $score->part_index_score_desc = $item;
                $score->created_by = '';
                $score->updated_by = '';
                $score->save();
            }
        }

        return redirect()->route('part-index.index')->with('success', 'เพิ่มข้อมูลสำเร็จ');
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
    public function edit($id)
    {
        $data = PartIndexQuestion::where('part_target_sub_id', $id)->get();

        $model = DB::table('part_target_sub')
                    ->join('part_target', 'part_target_sub.part_target_id', '=', 'part_target.part_target_id')
                    ->join('part', 'part_target.part_id', '=', 'part.part_id')
                    ->select('part_order', 'part_name', 'part_target_order', 'part_target_name',  'part_target_sub_order', 'part_target_sub_name', 'part_target_sub_id')
                    ->get();

        return view('part-index.form-edit', [
            'id' => $id,
            'data' => $data,
            'model' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_question' => 'required',
        ]);

        //delete old data question
        $question_count = DB::table('part_index_question')->select('part_index_question_desc')->where('part_target_sub_id', $request->part_target_sub_id)->get();
        
        if($question_count->count() > 0){
            PartIndexQuestion::where('part_target_sub_id', $id)->delete();
        }
        //insert data question
        foreach ($request->name_question as $key => $value) {
            $model = new PartIndexQuestion();
            $model->part_index_question_order = ($key + 1);
            $model->part_index_question_desc = $value;
            $model->part_target_sub_id = $request->part_target_sub_id;
            $model->updated_by = '';
            $model->save();
        }

        //delete old data score
        $score_count = DB::table('part_index_score')->select('part_index_score_desc')->where('part_target_sub_id', $request->part_target_sub_id)->get();

        if($score_count->count() > 0){
            PartIndexScore::where('part_target_sub_id', $id)->delete();
        }

        //insert data score
        foreach ($request->inputs_score as $key => $items) {
            foreach ($items as $item) {
                $score = new PartIndexScore();
                $score->part_target_sub_id = $request->part_target_sub_id;
                $score->part_index_score_order = ($key + 1);
                $score->part_index_score_desc = $item;
                $score->updated_by = '';
                $score->save();
            }
        }
        
        return redirect()->route('part-index.index')->with('info', 'แก้ไขข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
