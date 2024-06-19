@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h3>ข้อมูลนักวิจัย</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3 text-center">
                        <img class="rounded-circle" src="{{session()->get('user_image_cover')}}" alt="" style="width: 150px;height:150px;">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{session()->get('user_name')}}" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label">นามสกุล</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{session()->get('user_surname')}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">อีเมล</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
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