<?php

namespace App\Http\Controllers\Report;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommitteeReportController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $community = DB::select("
        select community_id, community_name from appraisal_transaction where created_by = $user_id
        ");

        return view('report.committee.index', [
            'community' => $community,
        ]);
    }

    public function getResult(Request $request)
    {
        // dd($request->community);
        $user_id = Auth::user()->id;
        $request_community = $request->community;
        $request->session()->put('session_community', $request_community);
        $community = DB::select("
        select community_id, community_name from appraisal_transaction where created_by = $user_id
        ");

        $parts = Part::all();
        $part_target_first = PartTarget::where('part_id', 1)->get();
        $part_target_second = PartTarget::where('part_id', 2)->get();
        $part_target_third = PartTarget::where('part_id', 3)->get();
        $part_target_fourth = PartTarget::where('part_id', 4)->get();
        $part_target_fifth = PartTarget::where('part_id', 5)->get();

        /* ----- ด้าน 1 ----- */
        $score_first = $this->getScoreCommittee(1, $user_id, $request_community);

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
        $score_second = $this->getScoreCommittee(2, $user_id, $request_community);

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
        $score_third = $this->getScoreCommittee(3, $user_id, $request_community);

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
        $score_fourth = $this->getScoreCommittee(4, $user_id, $request_community);

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
        $score_fifth = $this->getScoreCommittee(5, $user_id, $request_community);

        $total_fifth = 0;
        $arrLabels_fifth = [];
        $arrSumScore_fifth = [];

        foreach ($score_fifth as $value) {
            $total_fifth += $value->sum_score;

            array_push($arrLabels_fifth, $value->part_target_order);
            array_push($arrSumScore_fifth, $value->sum_score);
        }

        $data_fifth = $this->dataArr($arrLabels_fifth, $arrSumScore_fifth);

        return view('report.committee.index', [
            'community' => $community,
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
        ]);
    }

    public function getScoreCommittee($part_id, $user_id, $community)
    {
        $score = "";

        $score = DB::select("
            SELECT part_target.part_target_id
            , part_target.part_target_order
                , part_target.part_target_name
                , sum(appraisal_score_score) / COUNT(appraisal_score.part_target_id) AS sum_score
            FROM part_target
            LEFT JOIN appraisal_score ON part_target.part_target_id = appraisal_score.part_target_id
            INNER JOIN appraisal_transaction ON part_target.part_target_id = appraisal_transaction.part_target_id 
            WHERE part_id = $part_id
                AND appraisal_transaction.community_id =  '$community'
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
        $community_id = "";

        if (session()->has('session_community'))
        {
            $community_id = session()->get('session_community');
        }

        $user_evaluate = DB::select("
        SELECT CONCAT(user_profile.user_profile_name, ' ', user_profile.user_profile_lastname) AS full_name, appraisal_transaction_date
        , appraisal_transaction.community_name
        FROM appraisal_transaction 
        INNER JOIN user_role ON appraisal_transaction.created_by = user_role.user_id
        INNER JOIN user_profile ON user_role.user_id = user_profile.user_id
        WHERE appraisal_transaction.appraisal_transaction_status = 2
            AND appraisal_transaction.community_id = '$community_id' 
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

        return view('report.committee.summary', [
            'user_evaluate' => $user_evaluate,
            'date_thai' => $date_thai,
        ]);
    }
}
