<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\PartTargetSub;
use App\Models\PartIndexScore;
use App\Models\PartIndexQuestion;
use Illuminate\Support\Facades\DB;

class PartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = DB::table('part')
            ->join('part_target', 'part.part_id', '=', 'part_target.part_id')
            ->join('part_target_sub', 'part_target.part_target_id', '=', 'part_target_sub.part_target_id')
            ->select('part_order', 'part_target.part_target_id', 'part_target_order', 'part_target_sub.part_target_sub_id', 'part_target_sub_order')
            ->paginate(10);

        return view('part-detail.index', [
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $part = Part::all();
        $partTarget = PartTarget::all();

        return view('part-detail.form', [
            'part' => $part,
            'partTarget' => $partTarget,
        ]);
    }

    public function createFromPart($part_id)
    {
        $part = Part::all();

        return view('part-detail.form', [
            'part' => $part,
            'part_id' => $part_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $request->validate([
                'part_id' => 'required',
                'part_target_id' => 'required',
                'part_target_sub_order' => 'required|numeric',
                'name_question' => 'required',
                'inputs_score.*.name_score' => 'required'
            ], [
                'part_id.required' => 'เลือกข้อมูลด้าน',
                'part_target_id.required' => 'เลือกข้อมูลเป้าประสงค์',
                'part_target_sub_order.numeric' => 'ลำดับเกณฑ์พิจารณา ต้องใส่เป็นตัวเลขเท่านั้น',
            ]);

            //ข้อมูลเกณฑ์พิจารณา
            $partTargetSub = new PartTargetSub();
            $partTargetSub->part_target_sub_order = $request->part_target_sub_order;
            $partTargetSub->part_target_id = $request->part_target_id;
            $partTargetSub->part_target_sub_name = $request->part_target_sub_name;
            $partTargetSub->part_target_sub_desc = $request->part_target_sub_desc;
            $partTargetSub->created_by = '';
            $partTargetSub->updated_by = '';
            $partTargetSub->save();

            // คำถามในการประเมิน
            foreach ($request->name_question as $key => $value) {
                $question = new PartIndexQuestion();
                $question->part_index_question_order = ($key + 1);
                $question->part_index_question_desc = $value;
                $question->part_target_sub_id = $partTargetSub->part_target_sub_id;
                $question->created_by = '';
                $question->updated_by = '';
                $question->save();
            }

            //เกณฑ์การให้คะแนน
            foreach ($request->inputs_score as $key => $items) {
                foreach ($items as $item) {
                    $score = new PartIndexScore();
                    $score->part_target_sub_id = $question->part_target_sub_id;
                    $score->part_index_score_order = ($key + 1);
                    $score->part_index_score_desc = $item;
                    $score->created_by = '';
                    $score->updated_by = '';
                    $score->save();
                }
            }

            session()->flash('success', 'เพิ่มข้อมูลสำเร็จ');

            return response()->json([
                'success'  => 'success'
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
        $part = Part::all();
        $partTarget = PartTarget::all();
        $partTargetSub = PartTargetSub::find($id);
        $question = PartIndexQuestion::where('part_target_sub_id', $id)->get();
        $score = PartIndexScore::where('part_target_sub_id', $id)
            ->orderBy('part_index_score_id', 'desc')
            ->get();
        $partTargetById = PartTarget::select('part_id')->where('part_target_id', $partTargetSub->part_target_id)->get();
        $part_id = $partTargetById[0]->part_id;

        return view('part-detail.form-edit', [
            'part' => $part,
            'partTarget' => $partTarget,
            'partTargetSub' => $partTargetSub,
            'question' => $question,
            'score' => $score,
            'part_id' => $part_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->ajax()) {

            $request->validate([
                'part_id' => 'required',
                'part_target_id' => 'required',
                'part_target_sub_order' => 'required|numeric',
                'name_question' => 'required',
                'inputs_score.*.name_score' => 'required'
            ], [
                'part_id.required' => 'เลือกข้อมูลด้าน',
                'part_target_id.required' => 'เลือกข้อมูลเป้าประสงค์',
                'part_target_sub_order.numeric' => 'ลำดับเกณฑ์พิจารณา ต้องใส่เป็นตัวเลขเท่านั้น',
            ]);

            //ข้อมูลเกณฑ์พิจารณา
            $partTargetSub = PartTargetSub::find($id);
            $partTargetSub->part_target_sub_order = $request->part_target_sub_order;
            $partTargetSub->part_target_id = $request->part_target_id;
            $partTargetSub->part_target_sub_name = $request->part_target_sub_name;
            $partTargetSub->part_target_sub_desc = $request->part_target_sub_desc;
            $partTargetSub->created_by = '';
            $partTargetSub->updated_by = '';
            $partTargetSub->save();

            // คำถามในการประเมิน
            //delete old data question
            $question_count = DB::table('part_index_question')->select('part_index_question_desc')->where('part_target_sub_id', $id)->get();

            if ($question_count->count() > 0) {
                PartIndexQuestion::where('part_target_sub_id', $id)->delete();
            }

            // เพิ่มข้อมูลคำถามในการประเมิน
            foreach ($request->name_question as $key => $value) {
                $question = new PartIndexQuestion();
                $question->part_index_question_order = ($key + 1);
                $question->part_index_question_desc = $value;
                $question->part_target_sub_id = $id;
                $question->created_by = '';
                $question->updated_by = '';
                $question->save();
            }

            //เกณฑ์การให้คะแนน
            //delete old data score
            $score_count = DB::table('part_index_score')->select('part_index_score_desc')->where('part_target_sub_id', $id)->get();

            if ($score_count->count() > 0) {
                PartIndexScore::where('part_target_sub_id', $id)->delete();
            }

            //เพิ่มข้อมูลเกณฑ์การให้คะแนน
            foreach ($request->inputs_score as $key => $items) {
                foreach ($items as $item) {
                    $score = new PartIndexScore();
                    $score->part_target_sub_id = $id;
                    $score->part_index_score_order = ($key + 1);
                    $score->part_index_score_desc = $item;
                    $score->created_by = '';
                    $score->updated_by = '';
                    $score->save();
                }
            }

            session()->flash('info', 'แก้ไขข้อมูลสำเร็จ');

            return response()->json([
                'success'  => 'success'
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

    public function fetchPartTargetById(Request $request)
    {
        $part_id = $request->part_id;

        $data = PartTarget::where('part_id', $part_id)->get();

        $output = '<option value="" selected disabled>เลือกข้อมูลเป้าประสงค์</option>';
        foreach ($data as $item) {
            $output .= '<option value="' . $item->part_target_id . '">' . $item->part_target_order . ' : ' . $item->part_target_name . '</option>';
        }

        echo $output;
    }
}
