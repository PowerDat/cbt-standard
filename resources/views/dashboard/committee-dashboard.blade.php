@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h3>ข้อมูลกรรมการ</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3 text-center">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2014/03/25/16/32/user-297330_960_720.png" alt="" style="width: 150px;height:150px;">
                    </div>
                    <div class="col-9">
                        
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{ ($user_profile->count() > 0) ? $user_profile[0]->user_profile_name : '' }}" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label text-end">นามสกุล</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{ ($user_profile->count() > 0) ? $user_profile[0]->user_profile_lastname : '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">อีเมล</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label text-end">เบอร์</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{ ($user_profile->count() > 0) ? $user_profile[0]->user_profile_tel : '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">หน่วยงาน/สถาบัน</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ ($user_profile->count() > 0) ? $user_profile[0]->user_profile_organization : '' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>                        

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection