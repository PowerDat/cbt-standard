<?php

namespace App\Http\Controllers\Evaluate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        return view('evaluate.community.index');
    }

    public function formGoalFirst()
    {
        return view('evaluate.community.form_goal_first');
    }
}
