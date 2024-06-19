@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h3>ข้อมูลชุมชนการท่องเที่ยว</h3>
            </div>
            <div class="card-body">

                <div class="mb-3 row">
                    <div class="col">
                        <div class="row">
                            <label class="col-sm-1 col-form-label">ชื่อชุมชน</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{session()->get('community_name')}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <div class="row">
                            <label class="col-sm-1 col-form-label">ตำบล</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" value="" readonly>
                            </div>
                            <label class="col-sm-1 col-form-label">อำเภอ</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" value="" readonly>
                            </div>
                            <label class="col-sm-1 col-form-label">จังหวัด</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <div class="row">
                            <label class="col-sm-1 col-form-label">ละติจูด</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" value="{{session()->get('community_latitude')}}" readonly>
                            </div>
                            <label class="col-sm-1 col-form-label">ลองติจูด</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" value="{{session()->get('community_longitude')}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <div class="row">
                            <label
                                class="col-sm-5 col-form-label">เขตพื้นที่องค์กรปกครองส่วนท้องถิ่น(อบต./เทศบาล)</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <div class="row">
                            <label class="col-sm-2 col-form-label">ในเขตพื้นที่พิเศษ</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
