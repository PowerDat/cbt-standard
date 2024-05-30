<?php

namespace App\Http\Controllers;

use App\Models\AppraisalScore;
use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function part()
    {
        return view('report.part');
    }

    public function partFirst()
    {
        $part = Part::where('part_id', 1)->get();
        $score = DB::select("
        SELECT 
            part_target.part_target_order
            , part_target.part_target_name
            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
        FROM part_target
        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
        WHERE part_id = 1
        GROUP BY 1,2
        ");
        
        $total = 0;
        $arrLabels = [];
        $arrSumScore = [];

        foreach ($score as $value) {
            $total += $value->sum_score;

            array_push($arrLabels, $value->part_target_order);
            array_push($arrSumScore, $value->sum_score);
        }

        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return view('report.part', [
            'part' => $part,
            'total' => $total,
            'score' => $score,
            'data' => $data,
        ]);
    }

    public function partSecond()
    {
        $part = Part::where('part_id', 2)->get();
        $score = DB::select("
        SELECT 
            part_target.part_target_order
            , part_target.part_target_name
            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
        FROM part_target
        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
        WHERE part_id = 2
        GROUP BY 1,2
        ");

        $total = 0;
        $arrLabels = [];
        $arrSumScore = [];

        foreach ($score as $value) {
            $total += $value->sum_score;

            array_push($arrLabels, $value->part_target_order);
            array_push($arrSumScore, $value->sum_score);
        }

        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return view('report.part', [
            'part' => $part,
            'total' => $total,
            'score' => $score,
            'data' => $data,
        ]);
    }

    public function partThird()
    {
        $part = Part::where('part_id', 3)->get();
        $score = DB::select("
        SELECT 
            part_target.part_target_order
            , part_target.part_target_name
            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
        FROM part_target
        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
        WHERE part_id = 3
        GROUP BY 1,2
        ");

        $total = 0;
        $arrLabels = [];
        $arrSumScore = [];

        foreach ($score as $value) {
            $total += $value->sum_score;

            array_push($arrLabels, $value->part_target_order);
            array_push($arrSumScore, $value->sum_score);
        }

        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return view('report.part', [
            'part' => $part,
            'total' => $total,
            'score' => $score,
            'data' => $data,
        ]);
    }

    public function partFourth()
    {
        $part = Part::where('part_id', 4)->get();
        $score = DB::select("
        SELECT 
            part_target.part_target_order
            , part_target.part_target_name
            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
        FROM part_target
        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
        WHERE part_id = 4
        GROUP BY 1,2
        ");

        $total = 0;
        $arrLabels = [];
        $arrSumScore = [];

        foreach ($score as $value) {
            $total += $value->sum_score;

            array_push($arrLabels, $value->part_target_order);
            array_push($arrSumScore, $value->sum_score);
        }

        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return view('report.part', [
            'part' => $part,
            'total' => $total,
            'score' => $score,
            'data' => $data,
        ]);
    }

    public function partFifth()
    {
        $part = Part::where('part_id', 5)->get();
        $score = DB::select("
        SELECT 
            part_target.part_target_order
            , part_target.part_target_name
            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
        FROM part_target
        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
        WHERE part_id = 5
        GROUP BY 1,2
        ");

        $total = 0;
        $arrLabels = [];
        $arrSumScore = [];

        foreach ($score as $value) {
            $total += $value->sum_score;

            array_push($arrLabels, $value->part_target_order);
            array_push($arrSumScore, $value->sum_score);
        }

        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return view('report.part', [
            'part' => $part,
            'total' => $total,
            'score' => $score,
            'data' => $data,
        ]);
    }
}
