<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Helper\Helper;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\AppraisalScore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $parts = Part::all();

        return view('report.index', [
            'parts' => $parts,
        ]);
    }

    public function community()
    {
        return view('report.community');
    }

    //ชุมชนประเมินตนเอง
    public function selfAssessment()
    {
        
    }

    public function committee()
    {
        $response_community_by_api = Helper::getCommunityByApi();;//ข้อมูลชุมชนที่มาจาก 
        $user_id = Auth::user()->id;
        $community = DB::select("
        select community_id from user_community where users_id = $user_id
        ");
        
        return view('report.committee', [
            'community' => $community,
            'response_community_by_api' => $response_community_by_api,
        ]);
    }

    //กรรมการประเมิน
    public function evaluationCommittee()
    {
        $parts = Part::all();
        $part_target_first = PartTarget::where('part_id', 1)->get();
        $part_target_second = PartTarget::where('part_id', 2)->get();
        $part_target_third = PartTarget::where('part_id', 3)->get();
        $part_target_fourth = PartTarget::where('part_id', 4)->get();
        $part_target_fifth = PartTarget::where('part_id', 5)->get();
        
        $response_community_by_api = Helper::getCommunityByApi();;//ข้อมูลชุมชนที่มาจาก 
        $user_id = Auth::user()->id;
        $community = DB::select("
        select community_id from user_community where users_id = $user_id
        ");
        
        /* ----- ด้าน 1 ----- */
        $score_first = $this->getScoreCommittee(1);
        
        $total_first = 0;
        $arrLabels_first = [];
        $arrSumScore_first = [];

        foreach ($score_first as $value) {
            $total_first += $value->sum_score;

            array_push($arrLabels_first, $value->part_target_order);
            array_push($arrSumScore_first, $value->sum_score);
        }

        $data_first = $this->dataArr($arrLabels_first, $arrSumScore_first);

        /* ----- ด้าน 2 ----- */
        $score_second = $this->getScoreCommittee(2); 
        
        $total_second = 0;
        $arrLabels_second = [];
        $arrSumScore_second = [];

        foreach ($score_second as $value) {
            $total_second += $value->sum_score;

            array_push($arrLabels_second, $value->part_target_order);
            array_push($arrSumScore_second, $value->sum_score);
        }

        $data_second = $this->dataArr($arrLabels_second, $arrSumScore_second);

        /* ----- ด้าน 3 ----- */
        $score_third = $this->getScoreCommittee(3);
        
        $total_third = 0;
        $arrLabels_third = [];
        $arrSumScore_third = [];

        foreach ($score_third as $value) {
            $total_third += $value->sum_score;

            array_push($arrLabels_third, $value->part_target_order);
            array_push($arrSumScore_third, $value->sum_score);
        }

        $data_third = $this->dataArr($arrLabels_third, $arrSumScore_third);

        /* ----- ด้าน 4 ----- */
        $score_fourth = $this->getScoreCommittee(4);
        
        $total_fourth = 0;
        $arrLabels_fourth = [];
        $arrSumScore_fourth = [];

        foreach ($score_fourth as $value) {
            $total_fourth += $value->sum_score;

            array_push($arrLabels_fourth, $value->part_target_order);
            array_push($arrSumScore_fourth, $value->sum_score);
        }

        $data_fourth = $this->dataArr($arrLabels_fourth, $arrSumScore_fourth);

        /* ----- ด้าน 5 ----- */
        $score_fifth = $this->getScoreCommittee(5);
        
        $total_fifth = 0;
        $arrLabels_fifth = [];
        $arrSumScore_fifth = [];

        foreach ($score_fifth as $value) {
            $total_fifth += $value->sum_score;

            array_push($arrLabels_fifth, $value->part_target_order);
            array_push($arrSumScore_fifth, $value->sum_score);
        }

        $data_fifth = $this->dataArr($arrLabels_fifth, $arrSumScore_fifth);

        return view('report.evaluation-committee', [
            'parts' => $parts,
            'part_target_first' => $part_target_first,
            'part_target_second' => $part_target_second,
            'part_target_third' => $part_target_third,
            'part_target_fourth' => $part_target_fourth,
            'part_target_fifth' => $part_target_fifth,
            'total_first' => $total_first,
            'score_first' => $score_first,
            'data_first' => $data_first,
            'total_second' => $total_second,
            'score_second' => $score_second,
            'data_second' => $data_second,
            'total_third' => $total_third,
            'score_third' => $score_third,
            'data_third' => $data_third,
            'total_fourth' => $total_fourth,
            'score_fourth' => $score_fourth,
            'data_fourth' => $data_fourth,
            'total_fifth' => $total_fifth,
            'score_fifth' => $score_fifth,
            'data_fifth' => $data_fifth,
            'community' => $community,
            'response_community_by_api' => $response_community_by_api,
        ]);
    }
    
    public function part($id)
    {
        $part = Part::all();
        $score = DB::select("
        SELECT 
            part_target.part_target_order
            , part_target.part_target_name
            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
        FROM part_target
        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
        WHERE part_id = $id
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

        return view('report.self-assessment', [
            'part' => $part,
            'total' => $total,
            'score' => $score,
            'data' => $data,
            'part_id' => $id,
        ]);
    }

    public function partFirst()
    {
        // $part = Part::where('part_id', 1)->get();
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

        // return view('report.part', [
        //     'part' => $part,
        //     'total' => $total,
        //     'score' => $score,
        //     'data' => $data,
        // ]);
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

    //ดูข้อมูลของชุมชนที่ประเมินตนเอง
    public function getScoreCommunity($part_id)
    {
        $community_name = "";
        $score = "";

        if (session()->has('community_name'))
        {
            $community_name = session()->get('community_name');
        }

        if (session()->has('session_community_by_select_option')){
            $community_name = session()->get('session_community_by_select_option');
        }

        $users = DB::select("
        SELECT created_by AS user_id /*คนที่ทำเเบบประเมิน*/
        FROM appraisal_transaction 
        WHERE appraisal_transaction_status = 2
            AND community_name = '$community_name'
        ");

        foreach ($users as $item) {
            //check role community
            $user_role = DB::select("
            SELECT role_id 
            FROM user_role
            WHERE user_id = $item->user_id
            ");

            foreach ($user_role as $role) {
                if($role->role_id === 1)
                {
                    $score = DB::select("
                        SELECT part_target.part_target_id
                        , part_target.part_target_order
                            , part_target.part_target_name
                            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
                        FROM part_target
                        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
                        INNER JOIN appraisal_transaction ON part_target.part_target_id = appraisal_transaction.part_target_id 
                        WHERE part_id = $part_id
                            AND appraisal_transaction.community_name =  '$community_name'
                            AND appraisal_transaction_status = 2
                            AND appraisal_transaction.created_by = $item->user_id
                            AND appraisal_score.created_by = $item->user_id
                        GROUP BY  part_target.part_target_id, part_target.part_target_order, part_target.part_target_name
                    ");

                    return $score;
                }
            }
        }
    }

    public function getScoreCommittee($part_id)
    {
        $community_name = "";
        $score = "";

        if (session()->has('community_name'))
        {
            $community_name = session()->get('community_name');
        }

        if (session()->has('session_community_by_select_option')){
            $community_name = session()->get('session_community_by_select_option');
        }

        $users = DB::select("
        SELECT created_by AS user_id /*คนที่ทำเเบบประเมิน*/
        FROM appraisal_transaction 
        WHERE appraisal_transaction_status = 2
            AND community_name = '$community_name'
        ");

        foreach ($users as $item) {
            //check role community
            $user_role = DB::select("
            SELECT role_id 
            FROM user_role
            WHERE user_id = $item->user_id
            ");

            foreach ($user_role as $role) {
                if($role->role_id === 5)
                {
                    $score = DB::select("
                        SELECT part_target.part_target_id
                        , part_target.part_target_order
                            , part_target.part_target_name
                            , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
                        FROM part_target
                        LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
                        INNER JOIN appraisal_transaction ON part_target.part_target_id = appraisal_transaction.part_target_id 
                        WHERE part_id = $part_id
                            AND appraisal_transaction.community_name =  '$community_name'
                            AND appraisal_transaction_status = 2
                            AND appraisal_transaction.created_by = $item->user_id
                            AND appraisal_score.created_by = $item->user_id
                        GROUP BY  part_target.part_target_id, part_target.part_target_order, part_target.part_target_name
                    ");

                    return $score;
                }
            }
        }
    }

    public function dataArr($arrLabels, $arrSumScore)
    {
        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return $data;
    }
}
