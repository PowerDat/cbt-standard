<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

class DashboardController extends Controller
{
    // public function __construct()
    // {   
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $role_name = Helper::getRoleName();
        
        return view('dashboard.dashboard', [
            'role_name' => $role_name,
        ]);
    }
}
