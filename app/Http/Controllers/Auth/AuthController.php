<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    } 


    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => 'required|email',
            "password" => 'required'
        ]);
  
        if ($validator->fails())
        {
            return response()->json([
                    "status" => false,
                    "errors" => $validator->errors()
                ]);
        } 
        else 
        {
            if (Auth::attempt($request->only(["email", "password"]))) 
            {
                return response()->json([
                    "status" => true, 
                    "redirect" => url("dashboard")
                ]);
            } 
            else 
            {
                return response()->json([
                    "status" => false,
                    "errors" => ["อีเมลหรือรหัสผ่านไม่ถูกต้อง"]
                ]);
            }
        }
    }
}
