<?php

namespace App\Http\Controllers\Report;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use PDF;

class CommunityReportController extends Controller
{
    public function index()
    {
        $parts = Part::all();
        $part_target_first = PartTarget::where('part_id', 1)->get();
        $part_target_second = PartTarget::where('part_id', 2)->get();
        $part_target_third = PartTarget::where('part_id', 3)->get();
        $part_target_fourth = PartTarget::where('part_id', 4)->get();
        $part_target_fifth = PartTarget::where('part_id', 5)->get();

        /* ----- ด้าน 1 ----- */
        $score_first = $this->getScore(1, 1);

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
        $score_second = $this->getScore(2, 1);

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
        $score_third = $this->getScore(3, 1);

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
        $score_fourth = $this->getScore(4, 1);

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
        $score_fifth = $this->getScore(5, 1);

        $total_fifth = 0;
        $arrLabels_fifth = [];
        $arrSumScore_fifth = [];

        foreach ($score_fifth as $value) {
            $total_fifth += $value->sum_score;

            array_push($arrLabels_fifth, $value->part_target_order);
            array_push($arrSumScore_fifth, $value->sum_score);
        }

        $data_fifth = $this->dataArr($arrLabels_fifth, $arrSumScore_fifth);

        return view('report.community.index', [
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
        ]);
    }

    public function committee()
    {
        if (session()->has('community_name')) {
            $community_name = session()->get('community_name');
        }

        $users = DB::select("
        SELECT 
            user_role.user_id
            , CONCAT(user_profile.user_profile_name, ' ', user_profile.user_profile_lastname) AS full_name
        FROM appraisal_transaction 
        INNER JOIN user_role ON appraisal_transaction.created_by = user_role.user_id
        INNER JOIN user_profile ON user_role.user_id = user_profile.user_id
        WHERE appraisal_transaction.appraisal_transaction_status = 2
            AND appraisal_transaction.community_name = '$community_name' 
            AND user_role.role_id = 5
        ");

        return view('report.community.committee', [
            'users' => $users,
        ]);
    }

    public function evaluationCommittee(Request $request)
    {
        if (session()->has('community_name')) {
            $community_name = session()->get('community_name');
        }

        $users = DB::select("
        SELECT 
            user_role.user_id
            , CONCAT(user_profile.user_profile_name, ' ', user_profile.user_profile_lastname) AS full_name
        FROM appraisal_transaction 
        INNER JOIN user_role ON appraisal_transaction.created_by = user_role.user_id
        INNER JOIN user_profile ON user_role.user_id = user_profile.user_id
        WHERE appraisal_transaction.appraisal_transaction_status = 2
            AND appraisal_transaction.community_name = '$community_name' 
            AND user_role.role_id = 5
        ");

        $user_id = $request->committee;
        $request->session()->put('committee_user_id', $user_id);

        $parts = Part::all();
        $part_target_first = PartTarget::where('part_id', 1)->get();
        $part_target_second = PartTarget::where('part_id', 2)->get();
        $part_target_third = PartTarget::where('part_id', 3)->get();
        $part_target_fourth = PartTarget::where('part_id', 4)->get();
        $part_target_fifth = PartTarget::where('part_id', 5)->get();

        /* ----- ด้าน 1 ----- */
        $score_first = $this->getScoreCommittee(1, $user_id);

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
        $score_second = $this->getScoreCommittee(2, $user_id);

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
        $score_third = $this->getScoreCommittee(3, $user_id);

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
        $score_fourth = $this->getScoreCommittee(4, $user_id);

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
        $score_fifth = $this->getScoreCommittee(5, $user_id);

        $total_fifth = 0;
        $arrLabels_fifth = [];
        $arrSumScore_fifth = [];

        foreach ($score_fifth as $value) {
            $total_fifth += $value->sum_score;

            array_push($arrLabels_fifth, $value->part_target_order);
            array_push($arrSumScore_fifth, $value->sum_score);
        }

        $data_fifth = $this->dataArr($arrLabels_fifth, $arrSumScore_fifth);

        return view('report.community.committee', [
            'parts' => $parts,
            'part_target_first' => $part_target_first,
            'total_first' => $total_first,
            'score_first' => $score_first,
            'data_first' => $data_first,
            'part_target_second' => $part_target_second,
            'total_second' => $total_second,
            'score_second' => $score_second,
            'data_second' => $data_second,
            'part_target_third' => $part_target_third,
            'total_third' => $total_third,
            'score_third' => $score_third,
            'data_third' => $data_third,
            'part_target_fourth' => $part_target_fourth,
            'total_fourth' => $total_fourth,
            'score_fourth' => $score_fourth,
            'data_fourth' => $data_fourth,
            'part_target_fifth' => $part_target_fifth,
            'total_fifth' => $total_fifth,
            'score_fifth' => $score_fifth,
            'data_fifth' => $data_fifth,
            'users' => $users,
        ]);
    }

    //ดูข้อมูลของชุมชนที่ประเมินตนเอง
    public function getScore($part_id, $role_id)
    {
        $community_name = "";
        $score = "";

        if (session()->has('community_name')) {
            $community_name = session()->get('community_name');
        }

        if (session()->has('session_community_by_select_option')) {
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
                if ($role->role_id === $role_id) {
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

    public function getScoreCommittee($part_id, $user_id)
    {
        $community_name = "";
        $score = "";

        if (session()->has('community_name')) {
            $community_name = session()->get('community_name');
        }

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
                AND appraisal_transaction.created_by = $user_id
                AND appraisal_score.created_by = $user_id
            GROUP BY  part_target.part_target_id, part_target.part_target_order, part_target.part_target_name
        ");

        return $score;
    }

    public function dataArr($arrLabels, $arrSumScore)
    {
        $data = [
            'labels' => $arrLabels,
            'data' => $arrSumScore,
        ];

        return $data;
    }

    public function summary()
    {
        $date_thai = "";

        if (session()->has('community_name')) {
            $community_name = session()->get('community_name');
        }

        $user_evaluate = DB::select("
        SELECT CONCAT(user_profile.user_profile_name, ' ', user_profile.user_profile_lastname) AS full_name, appraisal_transaction_date
        FROM appraisal_transaction 
        INNER JOIN user_role ON appraisal_transaction.created_by = user_role.user_id
        INNER JOIN user_profile ON user_role.user_id = user_profile.user_id
        WHERE appraisal_transaction.appraisal_transaction_status = 2
            AND appraisal_transaction.community_name = '$community_name' 
            AND user_role.role_id = 5
        ");

        $thai_months = [
            1 => 'มกราคม.',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม',
        ];

        if (count($user_evaluate) > 0) {
            $date = Carbon::parse($user_evaluate[0]->appraisal_transaction_date);
            $month = $thai_months[$date->month];
            $year = $date->year + 543;
            $date_thai = $date->format("j $month $year");
        }

        

        return view('report.community.summary', [
            'user_evaluate' => $user_evaluate,
            'date_thai' => $date_thai,
        ]);
    }

    public function pdf()
    {
            if (session()->has('community_name')) {
                $community_name = session()->get('community_name');
            }
    
            $user_evaluate = DB::select("
            SELECT CONCAT(user_profile.user_profile_name, ' ', user_profile.user_profile_lastname) AS full_name, appraisal_transaction_date
            FROM appraisal_transaction 
            INNER JOIN user_role ON appraisal_transaction.created_by = user_role.user_id
            INNER JOIN user_profile ON user_role.user_id = user_profile.user_id
            WHERE appraisal_transaction.appraisal_transaction_status = 2
                AND appraisal_transaction.community_name = '$community_name' 
                AND user_role.role_id = 5
            ");
    
            $thai_months = [
                1 => 'มกราคม.',
                2 => 'กุมภาพันธ์',
                3 => 'มีนาคม',
                4 => 'เมษายน',
                5 => 'พฤษภาคม',
                6 => 'มิถุนายน',
                7 => 'กรกฎาคม',
                8 => 'สิงหาคม',
                9 => 'กันยายน',
                10 => 'ตุลาคม',
                11 => 'พฤศจิกายน',
                12 => 'ธันวาคม',
            ];
    
            $date = Carbon::parse($user_evaluate[0]->appraisal_transaction_date);
            $month = $thai_months[$date->month];
            $year = $date->year + 543;
            $date_thai = $date->format("j $month $year");
    
            $pdf = PDF::loadView('report.community.summarypdf', [
                'user_evaluate' => $user_evaluate,
                'date_thai' => $date_thai,
            ]);
    
            return $pdf->stream('summary.pdf');
    }


}
