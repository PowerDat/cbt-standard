<?php

namespace App\Http\Controllers;

use App\Models\Part;
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
}
