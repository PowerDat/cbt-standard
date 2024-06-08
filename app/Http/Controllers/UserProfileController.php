<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createById($id)
    {
        $user = User::find($id);

        return view('user-profile.create', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_profile_name' => 'required',
            'user_profile_lastname' => 'required',
            'user_profile_tel' => 'required',
            'user_profile_organization' => 'required',
        ], [
            'user_profile_name.required' => 'กรอกชื่อจริง',
            'user_profile_lastname.required' => 'กรอกนามสกุล',
            'user_profile_tel.required' => 'กรอกเบอร์โทรศัพท์',
            'user_profile_organization.required' => 'กรอกหน่วยงาน/สถาบัน',
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
            $profile = new UserProfile();
            $profile->user_id = $request->user_id;
            $profile->user_profile_name = $request->user_profile_name;
            $profile->user_profile_lastname = $request->user_profile_lastname;
            $profile->user_profile_tel = $request->user_profile_tel;
            $profile->user_profile_organization = $request->user_profile_organization;
            $profile->created_by = Auth::user()->id;
            $profile->updated_by = Auth::user()->id;
            $profile->save();

            return response()->json([
                'status' => 1,
                'msg' => 'เพิ่มข้อมูลสำเร็จ',
                'id' => $request->user_id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $user_profile = UserProfile::where('user_id', $id)->get();

        return view('user-profile.edit', [
            'user' => $user,
            'user_profile' => $user_profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_profile_name' => 'required',
            'user_profile_lastname' => 'required',
            'user_profile_tel' => 'required',
            'user_profile_organization' => 'required',
        ], [
            'user_profile_name.required' => 'กรอกชื่อจริง',
            'user_profile_lastname.required' => 'กรอกนามสกุล',
            'user_profile_tel.required' => 'กรอกเบอร์โทรศัพท์',
            'user_profile_organization.required' => 'กรอกหน่วยงาน/สถาบัน',
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
            $profile = UserProfile::find($id);
            $profile->user_profile_name = $request->user_profile_name;
            $profile->user_profile_lastname = $request->user_profile_lastname;
            $profile->user_profile_tel = $request->user_profile_tel;
            $profile->user_profile_organization = $request->user_profile_organization;
            $profile->updated_by = Auth::user()->id;
            $profile->save();

            return response()->json([
                'status' => 1,
                'msg' => 'แก้ไขข้อมูลสำเร็จ',
                'id' => $request->user_id,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->user_profile_id;

        $profile = UserProfile::find($id);
        if($profile->count() > 0)
        {
            $profile->delete();

            return response()->json([
                'status' => 1,
                'msg' => 'ลบข้อมูลสำเร็จ',
            ]);
        }
    }
}
