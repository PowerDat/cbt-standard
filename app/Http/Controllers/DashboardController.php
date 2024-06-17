<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __construct()
    // {   
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $role_name = Helper::getRoleName();
        $user_profile = UserProfile::where('user_id', Auth::user()->id)->get();
        
        return view('dashboard.dashboard', [
            'role_name' => $role_name,
            'user_profile' => $user_profile,
        ]);
    }
}
