<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\PartTargetSub;
use App\Models\AppraisalScore;
use App\Models\PartIndexScore;
use App\Models\AppraisalQuestion;
use App\Models\PartIndexQuestion;
use Illuminate\Support\Facades\DB;
use App\Models\AppraisalTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EvaluateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() //เกณฑ์การประเมิน ข้อมูลด้าน
    {
        $part = Part::all();
        $partTarget = PartTarget::all();

        return view('evaluate.index', [
            'part' => $part,
            'partTarget' => $partTarget,
        ]);
    }

    public function target($part_id) //เกณฑ์การประเมิน 
    {
        $part = Part::find($part_id);
        $part_target = PartTarget::where('part_id', $part_id)->get();
        //สถานะ
        $transaction = AppraisalTransaction::all();
        //คะแนน
        $score = AppraisalScore::all();
        $part_target_sub = PartTargetSub::all();

        return view('evaluate.target', [
            'part' => $part,
            'part_target' => $part_target,
            'transaction' => $transaction,
            'score' => $score,
            'part_target_sub' => $part_target_sub,
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


        //status
        $transaction = AppraisalTransaction::select('appraisal_transaction_status')->where('part_target_id', $part_target_id)->get();

        if (!empty($transaction[0]->appraisal_transaction_status)) {
            if ($transaction[0]->appraisal_transaction_status == '1') {
                //เรียกข้อมูลแบบร่าง
                $ap_question = AppraisalQuestion::select('part_target_sub_id', 'part_index_question_id')->where('part_target_id', $part_target_id)->get();
                $ap_score = AppraisalScore::select('part_target_sub_id', 'appraisal_score_score', 'appraisal_score_comment')->where('part_target_id', $part_target_id)->get();
                // dd($ap_score);
                return view('evaluate.form-draft', [
                    'part' => $part,
                    'part_target' => $part_target,
                    'part_target_sub' => $part_target_sub,
                    'part_index_score' => $part_index_score,
                    'part_index_question' => $part_index_question,
                    'part_target_id' => $part_target_id,
                    'ap_question' => $ap_question,
                    'ap_score' => $ap_score,
                ]);
            }
        } else {
            return view('evaluate.form', [
                'part' => $part,
                'part_target' => $part_target,
                'part_target_sub' => $part_target_sub,
                'part_index_score' => $part_index_score,
                'part_index_question' => $part_index_question,
                'part_target_id' => $part_target_id,
            ]);
        }
    }

    public function store(Request $request)
    {
        $part_target_id = $request->part_target_id;

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

        $countQuestion = AppraisalQuestion::where('part_target_id', $part_target_id)->count();
        if ($countQuestion > 0) {
            AppraisalQuestion::where('part_target_id', $part_target_id)->delete();
        }

        $countScore = AppraisalScore::where('part_target_id', $part_target_id)->count();
        if ($countScore > 0) {
            AppraisalScore::where('part_target_id', $part_target_id)->delete();
        }

        $countTransaction = AppraisalTransaction::where('part_target_id', $part_target_id)->count();
        if ($countTransaction > 0) {
            AppraisalTransaction::where('part_target_id', $part_target_id)->delete();
        }

        //save data
        foreach ($part_target_sub as $key => $item) {
            $chk_question = "chk_question_" . ($key + 1);
            $rdo = "rdo_" . ($key + 1);
            $comment = "comment_" . ($key + 1);
            // $chk_question = "chk_question_" . $item->part_target_sub_id;
            // $rdo = "rdo_" . $item->part_target_sub_id;
            // $comment = "comment_" . $item->part_target_sub_id;

            $validator = Validator::make($request->all(), [
                "$rdo" => ['required'],
            ], [
                "$rdo.required" => 'กรอกคะแนนการประเมิน',
            ]);

            if (!$validator->passes()) 
            {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->errors()->toArray()
                ]);
            } 
            else 
            {
                // if (!empty($request->input($rdo))) {
                    $score = new AppraisalScore();
                    $score->part_target_sub_id = $item->part_target_sub_id;
                    $score->appraisal_score_score = $request->input($rdo);
                    $score->appraisal_score_comment = $request->input($comment);
                    $score->part_target_id = $part_target_id;
                    $score->created_by = Auth::user()->id;
                    $score->updated_by = Auth::user()->id;
                    $score->save();
                // }

                if (!empty($request->input($chk_question))) {
                    foreach ($request->input($chk_question) as $value) {
    
                        // $file = 'file_'.$value;
                        // $image = 'image_'.$value;
                        // $link_url = 'link_url_'.$value;
                       
                        // $validatorFile = Validator::make($request->all(), [
                        //     "$file" => 'mimes:pdf|max:2048',
                        //     "$image" => 'mimes:png,jpg|max:2048',
                        // ], [
                        //     "$file.mimes" => 'ไฟล์นามสกุล pdf เท่านั้น',
                        //     "$file.max" => 'ขนาดไม่เกิน 2 MB',
                        //     "$image.mimes" => 'ไฟล์นามสกุล png, jpg เท่านั้น',
                        //     "$image.max" => 'ขนาดไม่เกิน 2 MB',
                        // ]);

                        // if (!$validatorFile->passes()) 
                        // {
                        //     return response()->json([
                        //         'status' => 0,
                        //         'error' => $validatorFile->errors()->toArray()
                        //     ]);
                        // } 
                        // else
                        // {
                            $question = new AppraisalQuestion();
                            $question->part_target_sub_id = $item->part_target_sub_id;
                            $question->part_index_question_id = $value;
                            $question->part_target_id = $part_target_id;
                            // $question->file = $file;
                            // $question->image = $image;
                            // $question->link_url = $link_url;
                            $question->created_by = Auth::user()->id;
                            $question->updated_by = Auth::user()->id;
                            $question->save();
                        // }
                    }
                }
            }           
        }    
        
        $transaction = new AppraisalTransaction();
        $transaction->part_target_id = $part_target_id;
        $transaction->appraisal_transaction_date = date('Y-m-d');
        $transaction->appraisal_transaction_status = '2';
        $transaction->created_by = Auth::user()->id;
        $transaction->updated_by = Auth::user()->id;
        $transaction->save();
                    
        session()->flash('success', 'เพิ่มข้อมูลสำเร็จ');
                    
        return response()->json([
            'status' => 1,
            'msg' => 'เพิ่มข้อมูลสำเร็จ',
        ]);

    }

    public function saveDraft(Request $request)
    {
        $part_target_id = $request->part_target_id;

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

        $countQuestion = AppraisalQuestion::where('part_target_id', $part_target_id)->count();
        if ($countQuestion > 0) {
            AppraisalQuestion::where('part_target_id', $part_target_id)->delete();
        }

        $countScore = AppraisalScore::where('part_target_id', $part_target_id)->count();
        if ($countScore > 0) {
            AppraisalScore::where('part_target_id', $part_target_id)->delete();
        }

        $countTransaction = AppraisalTransaction::where('part_target_id', $part_target_id)->count();
        if ($countTransaction > 0) {
            AppraisalTransaction::where('part_target_id', $part_target_id)->delete();
        }

        //save data
        foreach ($part_target_sub as $key => $item) {
            $chk_question = "chk_question_" . ($key + 1);
            $rdo = "rdo_" . ($key + 1);
            $comment = "comment_" . ($key + 1);

            $score = new AppraisalScore();
            $score->part_target_sub_id = $item->part_target_sub_id;
            $score->appraisal_score_score = $request->input($rdo);
            $score->appraisal_score_comment = $request->input($comment);
            $score->part_target_id = $part_target_id;
            $score->created_by = Auth::user()->id;
            $score->updated_by = Auth::user()->id;
            $score->save();

            if (!empty($request->input($chk_question))) {
                foreach ($request->input($chk_question) as $value) {

                    // $file = 'file_'.$value;
                    // $image = 'image_'.$value;
                    // $link_url = 'link_url_'.$value;

                    // $validatorFile = Validator::make($request->all(), [
                    //     "$file" => 'mimes:pdf|max:2048',
                    //     "$image" => 'mimes:png,jpg|max:2048',
                    // ], [
                    //     "$file.mimes" => 'ไฟล์นามสกุล pdf เท่านั้น',
                    //     "$file.max" => 'ขนาดไม่เกิน 2 MB',
                    //     "$image.mimes" => 'ไฟล์นามสกุล png, jpg เท่านั้น',
                    //     "$image.max" => 'ขนาดไม่เกิน 2 MB',
                    // ]);

                    // if (!$validatorFile->passes()) 
                    // {
                    //     return response()->json([
                    //         'status' => 0,
                    //         'error' => $validatorFile->errors()->toArray()
                    //     ]);
                    // } 
                    // else
                    // {
                        $question = new AppraisalQuestion();

                        //upload file 
                        // if(!empty($request->file($file))){
                        //     $file = $request->file($file);
                        //     $destinationPath = "uploads/files";
                        //     $file->move($destinationPath, $file->getClientOriginalName());
                        //     $question->file = $file->getClientOriginalName(); //$fileName;

                        //     // $fileName = time().'.'.$request->file($file)->extension();
                        //     // $fileEncoded = File::get($request->input($file));
                        //     // $request->file->move(public_path('uploads'), $fileName);
                        //     // Storage::disk('local')->put('uploads'.$fileName, $request->input($file));
                        // }

                        //upload image
                        // if(!empty($request->file("$image"))){
                        //     $file = $request->file($image);
                        //     $destinationPath = "uploads/images";
                        //     $file->move($destinationPath, $file->getClientOriginalName());
                        //     $question->image = $file->getClientOriginalName();

                        //     // $imageName = time().'.'.$request->file("$image")->extension();  
                        //     // $imageEncoded = File::get($request->input("$image"));
                        //     // Storage::disk('local')->put('public/uploads/images/'.$imageName, $imageEncoded);
                        // }
                        
                        $question->part_target_sub_id = $item->part_target_sub_id;
                        $question->part_index_question_id = $value;
                        $question->part_target_id = $part_target_id;
                        // $question->link_url = $request->input($link_url);
                        $question->created_by = Auth::user()->id;
                        $question->updated_by = Auth::user()->id;
                        $question->save();
                    // }
                }
            }
        }

        $transaction = new AppraisalTransaction();
        $transaction->part_target_id = $part_target_id;
        $transaction->appraisal_transaction_date = date('Y-m-d');
        $transaction->appraisal_transaction_status = '1';
        $transaction->created_by = Auth::user()->id;
        $transaction->updated_by = Auth::user()->id;
        $transaction->save();

        session()->flash('success', 'บันทึกร่างสำเร็จ');
                    
        return response()->json([
            'status' => 1,
            'msg' => 'บันทึกร่างสำเร็จ',
        ]);
    }

    public function show($part_target_id)
    {
        $part_target = PartTarget::where('part_target_id', $part_target_id)->get();
        $part_target_sub = PartTargetSub::where('part_target_id', $part_target_id)->get();
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

        //status
        $transaction = AppraisalTransaction::select('appraisal_transaction_status')->where('part_target_id', $part_target_id)->get();

        if (!empty($transaction[0]->appraisal_transaction_status)) {
            if ($transaction[0]->appraisal_transaction_status == '2') {
                //เรียกข้อมูลแบบร่าง
                $ap_question = AppraisalQuestion::select('part_target_sub_id', 'part_index_question_id')->where('part_target_id', $part_target_id)->get();
                $ap_score = AppraisalScore::where('part_target_id', $part_target_id)->get();

                return view('evaluate.show', [
                    'part' => $part,
                    'part_target' => $part_target,
                    'part_target_sub' => $part_target_sub,
                    'part_index_score' => $part_index_score,
                    'part_index_question' => $part_index_question,
                    'part_target_id' => $part_target_id,
                    'ap_question' => $ap_question,
                    'ap_score' => $ap_score,
                ]);
            }
        }
    }

}
