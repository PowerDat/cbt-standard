<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\PartTargetSub;
use App\Models\PartIndexScore;
use App\Models\PartIndexQuestion;
use Illuminate\Support\Facades\DB;

class EvaluateController extends Controller
{
    public function index()//เกณฑ์การประเมิน ข้อมูลด้าน
    {
        $part = Part::all();

        return view('evaluate.index', [
            'part' => $part,
        ]);
    }

    public function target($part_id) //เกณฑ์การประเมิน ด้าน 1 ด้านการบริหารจัดการการท่องเที่ยวโดยชุมชน
    {
        $part = Part::find($part_id);
        $part_target = PartTarget::where('part_id', $part_id)->get();

        return view('evaluate.target', [
            'part' => $part,
            'part_target' => $part_target,
        ]);
    }

    public function form($part_target_id) //ฟอร์มประเมิน
    {
        $part_target = PartTarget::where('part_target_id', $part_target_id)->get();
        // $part_target_sub = PartTargetSub::where('part_target_id', $part_target_id)->get();
        $part_target_sub = DB::select("
        SELECT 
            part_target_sub_id
            , part_target_id
            , part_target_sub_name
            , part_target_sub_order
            , part_target_sub_desc 
            , ROW_NUMBER() OVER(PARTITION BY part_target_id ORDER BY part_target_sub_id) AS rowNum
        FROM part_target_sub
        WHERE part_target_id = $part_target_id
        ");
        $part = Part::where('part_id', $part_target[0]->part_id)->get();      
        $part_index_score = PartIndexScore::orderBy('part_index_score_order', 'desc')->get();
        $part_index_question = PartIndexQuestion::orderBy('part_index_question_order', 'asc')->get();
        

        return view('evaluate.form', [
            'part' => $part,
            'part_target' => $part_target,
            'part_target_sub' => $part_target_sub,
            'part_index_score' => $part_index_score,
            'part_index_question' => $part_index_question,
        ]);
    }

}
