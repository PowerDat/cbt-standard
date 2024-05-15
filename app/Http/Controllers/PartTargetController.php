<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use Illuminate\Http\Request;
use App\Models\PartTargetSub;
use App\Models\PartIndexScore;
use App\Models\PartIndexQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartTargetController extends Controller
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
        return view('part-target.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $part = Part::select('part_id', 'part_name', 'part_order')->get();

        return view('part-target.form', [
            'part' => $part,
        ]);
    }

    public function createFromPart($part_id)
    {
        $part = Part::select('part_id', 'part_name', 'part_order')->get();

        return view('part-target.form', [
            'part' => $part,
            'part_id' => $part_id,
        ]);
    }

    public function createById($part_target_id)
    {
        $part = Part::select('part_id', 'part_name', 'part_order')->get();
        $partTarget = PartTarget::find($part_target_id);
        $part_id = $partTarget->part_id;
        $partTargetSub = PartTargetSub::where('part_target_id', $part_target_id)->count();

        if ($partTargetSub > 0) {
            return redirect()->route('part-target.edit', $part_target_id);
        } else {
            return view('part-target.form', [
                'part' => $part,
                'part_id' => $part_id,
                'partTarget' => $partTarget,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'part_target_order' => 'required',
                'part_id' => 'required',
                'part_target_name' => 'required',
                'part_target_sub_order' => 'required',
                'part_target_sub_name' => 'required',
                'part_target_sub_desc' => 'required',
                'name_question' => 'required',
                'inputs_score.*.name_score' => 'required'
            ]);

            if (isset($request->part_target_id)) {
                //PartTarget
                $model = PartTarget::find($request->part_target_id);
                $model->part_target_order = $request->part_target_order;
                $model->part_id = $request->part_id;
                $model->part_target_name = $request->part_target_name;
                $model->updated_by = '';
                $model->save();

                //PartTargetSub
                $part_target_sub_order = $request->part_target_sub_order;
                $part_target_sub_name = $request->part_target_sub_name;
                $part_target_sub_desc = $request->part_target_sub_desc;

                for ($i = 0; $i < count($part_target_sub_order); $i++) {
                    $data = [
                        'part_target_id' => $request->part_target_id,
                        'part_target_sub_order' => $part_target_sub_order[$i],
                        'part_target_sub_name' => $part_target_sub_name[$i],
                        'part_target_sub_desc' => $part_target_sub_desc[$i],
                    ];
                    $insert_data[] = $data;
                }

                DB::table('part_target_sub')->insert($insert_data);
                $part_target_sub_id = DB::getPdo()->lastInsertId();
            } else {
                //PartTarget
                $model = new PartTarget();
                $model->part_target_order = $request->part_target_order;
                $model->part_id = $request->part_id;
                $model->part_target_name = $request->part_target_name;
                $model->created_by = '';
                $model->updated_by = '';
                $model->save();

                //PartTargetSub
                $part_target_sub_order = $request->part_target_sub_order;
                $part_target_sub_name = $request->part_target_sub_name;
                $part_target_sub_desc = $request->part_target_sub_desc;

                for ($i = 0; $i < count($part_target_sub_order); $i++) {
                    $data = [
                        'part_target_id' => $model->part_target_id,
                        'part_target_sub_order' => $part_target_sub_order[$i],
                        'part_target_sub_name' => $part_target_sub_name[$i],
                        'part_target_sub_desc' => $part_target_sub_desc[$i],
                    ];
                    $insert_data[] = $data;
                }

                DB::table('part_target_sub')->insert($insert_data);
                $part_target_sub_id = DB::getPdo()->lastInsertId();
            }

            // PartIndexQuestion
            $this->insertIndexQuestion($request->name_question, $part_target_sub_id);

            //PartIndexScore
            $this->insertIndexScore($request->inputs_score, $part_target_sub_id);

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
        $part = Part::select('part_id', 'part_name')->get();
        $partTarget = PartTarget::find($id);
        $partTargetSub = PartTargetSub::where('part_target_id', $partTarget->part_target_id)->get();
        $partIndexScore = PartIndexScore::where('part_target_sub_id', $partTargetSub[0]->part_target_sub_id)->orderBy('part_index_score_order', 'asc')->get();
        $partIndexQuestion = PartIndexQuestion::where('part_target_sub_id', $partTargetSub[0]->part_target_sub_id)->orderBy('part_index_question_order', 'asc')->get();
        // dd($partTargetSub);

        return view('part-target.show', [
            'part' => $part,
            'partTarget' => $partTarget,
            'partTargetSub' => $partTargetSub,
            'partIndexQuestion' => $partIndexQuestion,
            'partIndexScore' => $partIndexScore,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $part = Part::select('part_id', 'part_name', 'part_order')->get();
        $partTarget = PartTarget::find($id);
        $partTargetSub = PartTargetSub::where('part_target_id', $partTarget->part_target_id)->get();
        $partIndexScore = PartIndexScore::where('part_target_sub_id', $partTarget->part_target_id)->orderBy('part_index_score_order', 'asc')->get();
        $partIndexQuestion = PartIndexQuestion::where('part_target_sub_id', $partTarget->part_target_id)->orderBy('part_index_question_order', 'asc')->get();

        $countTargetSub = count($partTargetSub);
        // dd($countTargetSub);
        return view('part-target.form-edit', [
            'part' => $part,
            'partTarget' => $partTarget,
            'partTargetSub' => $partTargetSub,
            'partIndexQuestion' => $partIndexQuestion,
            'partIndexScore' => $partIndexScore,
            'countTargetSub' => $countTargetSub,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updated(Request $request, string $id)
    {
        $partTargetSub = PartTargetSub::where('part_target_id', $id)->get();       

        // //delete old data question
        $question_count = PartIndexQuestion::where('part_target_sub_id', $partTargetSub[0]->part_target_sub_id)->get(); 

        if($question_count->count() > 0){
            PartIndexQuestion::where('part_target_sub_id', $id)->delete();
        }

        //delete old data score
        $score_count = PartIndexScore::where('part_target_sub_id', $partTargetSub[0]->part_target_sub_id)->get();

        if($score_count->count() > 0){
            PartIndexScore::where('part_target_sub_id', $id)->delete();
        }

        //delete old data PartTargetSub
        // if($partTargetSub->count() > 0){
        //     PartTargetSub::where('part_target_id', $id)->delete();
        // }

        if ($request->ajax()) {
            $request->validate([
                'part_target_order' => 'required',
                'part_id' => 'required',
                'part_target_name' => 'required',
                'part_target_sub_order' => 'required',
                'part_target_sub_name' => 'required',
                'part_target_sub_desc' => 'required',
                'name_question' => 'required',
                'inputs_score.*.name_score' => 'required'
            ]);

            $model = PartTarget::find($id);
            $model->part_target_order = $request->part_target_order;
            $model->part_id = $request->part_id;
            $model->part_target_name = $request->part_target_name;
            $model->updated_by = '';
            $model->save();

            //PartTargetSub
            $part_target_sub_order = $request->part_target_sub_order;
            $part_target_sub_name = $request->part_target_sub_name;
            $part_target_sub_desc = $request->part_target_sub_desc;

            for ($i = 0; $i < count($part_target_sub_order); $i++) {
                $data = [
                    'part_target_id' => $request->part_target_id,
                    'part_target_sub_order' => $part_target_sub_order[$i],
                    'part_target_sub_name' => $part_target_sub_name[$i],
                    'part_target_sub_desc' => $part_target_sub_desc[$i],
                ];
                $insert_data[] = $data;
            }

            DB::table('part_target_sub')->insert($insert_data);
            $part_target_sub_id = DB::getPdo()->lastInsertId();

            // PartIndexQuestion
            $this->insertIndexQuestion($request->name_question, $part_target_sub_id);

            //PartIndexScore
            $this->insertIndexScore($request->inputs_score, $part_target_sub_id);

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
        if (PartTargetSub::count() > 0) {
            return redirect()->back()->with('info', 'ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลเกณฑ์ย่อยใช้งานอยู่');
        } else {
            $model = PartTarget::find($id);
            $model->delete();

            return redirect()->route('part-target.index')->with('info', 'ลบข้อมูลสำเร็จ');
        }
    }

    public function insertIndexScore($input, $part_target_sub_id)
    {
        foreach ($input as $key => $items) {
            foreach ($items as $item) {
                $score = new PartIndexScore();
                $score->part_target_sub_id = $part_target_sub_id;
                $score->part_index_score_order = ($key + 1);
                $score->part_index_score_desc = $item;
                $score->created_by = '';
                $score->updated_by = '';
                $score->save();
            }
        }
    }

    public function insertIndexQuestion($input, $part_target_sub_id)
    {
        foreach ($input as $key => $value) {
            $model = new PartIndexQuestion();
            $model->part_index_question_order = ($key + 1);
            $model->part_index_question_desc = $value;
            $model->part_target_sub_id = $part_target_sub_id;
            $model->created_by = '';
            $model->updated_by = '';
            $model->save();
        }
    }
}
