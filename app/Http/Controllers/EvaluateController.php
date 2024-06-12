<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Part;
use App\Models\User;
use App\Models\PartType;
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
use Illuminate\Support\Facades\Http;
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
        $part_type = PartType::all();
        $part = Part::all();

        $link = DB::select("select config_value from config where config_key = 'community-all'");
        $api_community = Http::get($link[0]->config_value);
        $response_community = $api_community->json('data');
        $session_api_community_name = session()->get('community_name');
        $session_api_community_id = "";

        if($session_api_community_name != "")
        {
            for ($i=0; $i < count($response_community); $i++) { 
                if($session_api_community_name == $response_community[$i]['community_name'])
                {
                    $session_api_community_id = $response_community[$i]['community_id'];
                    session()->put('session_api_community_id', $session_api_community_id);
                }
            }
        }
        
        return view('evaluate.index', [
            'part' => $part,
            'part_type' => $part_type,
            'response_community' => $response_community,
            'session_api_community_id' => $session_api_community_id,
        ]);
    }

    public function getPartType($part_type_id)
    {
        $part = Part::where('part_type_id', $part_type_id)->get();
        $part_type = PartType::where('part_type_id', $part_type_id)->get();
        $part_type_name = $part_type[0]->part_type_name;

        return view('evaluate.get-part-type', [
            'part' => $part,
            'part_type_name' => $part_type_name,
        ]);
    }

    public function target($part_id) //เกณฑ์การประเมิน 
    {
        $part = Part::find($part_id);
        $part_type_id = $part->part_type_id;
        $part_type = PartType::where('part_type_id', $part_type_id)->get();
        $part_type_name = $part_type[0]->part_type_name;
        $part_target = PartTarget::where('part_id', $part_id)->get();
        
        return view('evaluate.target', [
            'part' => $part,
            'part_target' => $part_target,
            'part_type_name' => $part_type_name,
        ]);
    }

    public function form($part_target_id) //ฟอร์มประเมิน
    {
        $part_target = PartTarget::where('part_target_id', $part_target_id)->get();
        $part_target_sub = DB::select("
        SELECT 
            part_target_sub_id
            , part_target_id
            , part_target_sub_name
            , part_target_sub_order
            , part_target_sub_desc 
        FROM part_target_sub
        WHERE part_target_id = $part_target_id
        ");
        
        // dd($part_target_sub);
        $part = Part::where('part_id', $part_target[0]->part_id)->get();
        $part_index_score = PartIndexScore::orderBy('part_index_score_order', 'desc')->get();
        $part_index_question = PartIndexQuestion::orderBy('part_index_question_order', 'asc')->get();

        //status
        $community_name = session()->get('community_name');
        $transaction = AppraisalTransaction::select('appraisal_transaction_status')->where(['part_target_id' => $part_target_id, 'community_name' => $community_name])->get();

        if (!empty($transaction[0]->appraisal_transaction_status)) {
            if ($transaction[0]->appraisal_transaction_status == '1') {
                //เรียกข้อมูลแบบร่าง
                $ap_question = AppraisalQuestion::select('*')->where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->get();
                $ap_score = AppraisalScore::select('*')->where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->get();
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
        FROM part_target_sub
        WHERE part_target_id = $part_target_id
        ");

        $countQuestion = AppraisalQuestion::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->count();
        if ($countQuestion > 0) {
            AppraisalQuestion::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->delete();
        }

        $countScore = AppraisalScore::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->count();
        if ($countScore > 0) {
            AppraisalScore::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->delete();
        }

        $countTransaction = AppraisalTransaction::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->count();
        if ($countTransaction > 0) {
            AppraisalTransaction::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->delete();
        }

        //save data
        foreach ($part_target_sub as $key => $item) {
            $chk_question = "chk_question_" . $item->part_target_sub_id;
            $rdo = "rdo_" . $item->part_target_sub_id;
            $comment = "comment_" . $item->part_target_sub_id;

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
    
                        $file = 'file_'.$value;
                        $image = 'image_'.$value;
                        $link_url = 'link_url_'.$value;
                       
                        $validatorFile = Validator::make($request->all(), [
                            "$file" => 'mimes:pdf|max:2048',
                            "$image" => 'mimes:png,jpg|max:2048',
                        ], [
                            "$file.mimes" => 'ไฟล์นามสกุล pdf เท่านั้น',
                            "$file.max" => 'ขนาดไม่เกิน 2 MB',
                            "$image.mimes" => 'ไฟล์นามสกุล png, jpg เท่านั้น',
                            "$image.max" => 'ขนาดไม่เกิน 2 MB',
                        ]);

                        if (!$validatorFile->passes()) 
                        {
                            return response()->json([
                                'status' => 0,
                                'error' => $validatorFile->errors()->toArray()
                            ]);
                        } 
                        else
                        {
                            $question = new AppraisalQuestion();

                            //upload file 
                            if(!empty($request->file($file))){
                                $file = $request->file($file);
                                $fileName = time().'.'.$file->extension();
                                // dd($fileName);

                                $destinationPath = "uploads/files";
                                $file->move($destinationPath, $fileName);
                                $question->file = $fileName; //$fileName;
                            }

                            //upload image
                            if(!empty($request->file("$image"))){
                                $file = $request->file($image);
                                $imageName = time().'.'.$file->extension();

                                $destinationPath = "uploads/images";
                                $file->move($destinationPath, $imageName);
                                $question->image = $imageName;
                            }

                            $question->part_target_sub_id = $item->part_target_sub_id;
                            $question->part_index_question_id = $value;
                            $question->part_target_id = $part_target_id;
                            $question->link_url = $request->input($link_url);
                            $question->created_by = Auth::user()->id;
                            $question->updated_by = Auth::user()->id;
                            $question->save();
                        }
                    }
                }
            }           
        }    
        
        $transaction = new AppraisalTransaction();
        $transaction->part_target_id = $part_target_id;
        $transaction->appraisal_transaction_date = date('Y-m-d');
        $transaction->appraisal_transaction_status = '2';
        $transaction->community_id = session()->get('session_api_community_id');
        $transaction->community_name = session()->get('community_name');
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
        FROM part_target_sub
        WHERE part_target_id = $part_target_id
        ");

        $countQuestion = AppraisalQuestion::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->count();
        if ($countQuestion > 0) {
            AppraisalQuestion::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->delete();
        }

        $countScore = AppraisalScore::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->count();
        if ($countScore > 0) {
            AppraisalScore::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->delete();
        }

        $countTransaction = AppraisalTransaction::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->count();
        if ($countTransaction > 0) {
            AppraisalTransaction::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->delete();
        }

        //save data
        foreach ($part_target_sub as $key => $item) {
            $chk_question = "chk_question_" . $item->part_target_sub_id;
            $rdo = "rdo_" . $item->part_target_sub_id;
            $comment = "comment_" . $item->part_target_sub_id;

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

                    $file = 'file_'.$value;
                    $image = 'image_'.$value;
                    $link_url = 'link_url_'.$value;

                    $validatorFile = Validator::make($request->all(), [
                        "$file" => 'mimes:pdf|max:2048',
                        "$image" => 'mimes:png,jpg|max:2048',
                    ], [
                        "$file.mimes" => 'ไฟล์นามสกุล pdf เท่านั้น',
                        "$file.max" => 'ขนาดไม่เกิน 2 MB',
                        "$image.mimes" => 'ไฟล์นามสกุล png, jpg เท่านั้น',
                        "$image.max" => 'ขนาดไม่เกิน 2 MB',
                    ]);

                    if (!$validatorFile->passes()) 
                    {
                        return response()->json([
                            'status' => 0,
                            'error' => $validatorFile->errors()->toArray()
                        ]);
                    } 
                    else
                    {
                        $question = new AppraisalQuestion();

                        //upload file 
                        if(!empty($request->file($file))){
                            $file = $request->file($file);
                            $fileName = time().'.'.$file->extension();
                            // dd($fileName);

                            $destinationPath = "uploads/files";
                            $file->move($destinationPath, $fileName);
                            $question->file = $fileName; //$fileName;
                        }

                        //upload image
                        if(!empty($request->file("$image"))){
                            $file = $request->file($image);
                            $imageName = time().'.'.$file->extension();

                            $destinationPath = "uploads/images";
                            $file->move($destinationPath, $imageName);
                            $question->image = $imageName;
                        }
                        
                        $question->part_target_sub_id = $item->part_target_sub_id;
                        $question->part_index_question_id = $value;
                        $question->part_target_id = $part_target_id;
                        $question->link_url = $request->input($link_url);
                        $question->created_by = Auth::user()->id;
                        $question->updated_by = Auth::user()->id;
                        $question->save();
                    }
                }
            }
        }

        $transaction = new AppraisalTransaction();
        $transaction->part_target_id = $part_target_id;
        $transaction->appraisal_transaction_date = date('Y-m-d');
        $transaction->appraisal_transaction_status = '1';
        $transaction->community_id = session()->get('session_api_community_id');
        $transaction->community_name = session()->get('community_name');
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
        $part_target = PartTarget::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->get();
        
        $part_target_sub = DB::select("
        SELECT 
            part_target_sub_id
            , part_target_id
            , part_target_sub_name
            , part_target_sub_order
            , part_target_sub_desc 
        FROM part_target_sub
        WHERE part_target_id = $part_target_id
        ");
        
        $part = Part::where('part_id', $part_target[0]->part_id)->get();
        $part_index_score = PartIndexScore::orderBy('part_index_score_order', 'desc')->get();
        $part_index_question = PartIndexQuestion::orderBy('part_index_question_order', 'asc')->get();
        $part_type_id = $part[0]->part_type_id;
        $part_type = PartType::where('part_type_id', $part_type_id)->get();
        $part_type_name = $part_type[0]->part_type_name;

        //status
        $transaction = AppraisalTransaction::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->get();

        if (!empty($transaction[0]->appraisal_transaction_status)) {
            if ($transaction[0]->appraisal_transaction_status == '2') {
                //เรียกข้อมูลแบบร่าง
                $ap_question = AppraisalQuestion::select('*')->where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->get();
                $ap_score = AppraisalScore::where(['part_target_id' => $part_target_id, 'created_by' => Auth::user()->id])->get();

                return view('evaluate.show', [
                    'part' => $part,
                    'part_target' => $part_target,
                    'part_target_sub' => $part_target_sub,
                    'part_index_score' => $part_index_score,
                    'part_index_question' => $part_index_question,
                    'part_target_id' => $part_target_id,
                    'ap_question' => $ap_question,
                    'ap_score' => $ap_score,
                    'part_type_name' => $part_type_name,
                ]);
            }
        }
    }

    public function saveCommunity(Request $request)
    {
        $community = $request->evaluate_community;
        $request->session()->put('evaluate_community', $community);

        return response()->json([
            'success' => true,
        ]);
    }

}
