<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('report.part-first');
    }

    public function partSecond()
    {
        return view('report.part-second');
    }

    public function partThird()
    {
        return view('report.part-third');
    }

    public function partFourth()
    {
        return view('report.part-fourth');
    }

    public function partFifth()
    {
        return view('report.part-fifth');
    }
}
