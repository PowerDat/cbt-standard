<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __construct()
    // {   
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $role_id = Auth::user()->role_id;
        $role = Role::select('name')->where('id', $role_id)->get();
        $role_name = $role[0]->name;

        return view('dashboard.dashboard', [
            'role_name' => $role_name,
        ]);
    }
}
