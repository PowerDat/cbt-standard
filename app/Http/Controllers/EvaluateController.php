<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartTarget;
use App\Models\PartTargetSub;
use Illuminate\Http\Request;

class EvaluateController extends Controller
{
    public function index()
    {
        $part = Part::all();

        return view('evaluate.index', [
            'part' => $part,
        ]);
    }

    public function target($id)
    {
        $part = Part::find($id);
        $part_target = PartTarget::where('part_id', $id)->get();

        return view('evaluate.target', [
            'part' => $part,
            'part_target' => $part_target,
        ]);
    }

    public function form($id)
    {
        $part = Part::find($id);
        $part_target = PartTarget::where('part_id', $id)->get();
        $part_target_sub = PartTargetSub::where('part_target_id', $part_target[0]->part_target_id)->get();

        return view('evaluate.form', [
            'part' => $part,
            'part_target' => $part_target,
            'part_target_sub' => $part_target_sub,
        ]);
    }

}
