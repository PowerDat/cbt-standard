@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลชุมชนการท่องเที่ยว</li>
                </ol>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<!-- content -->
<div class="container-fluid">
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
                                    <input class="form-control" type="text" value="ชุมชนบ้านปรางค์" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <div class="row">
                                <label class="col-sm-1 col-form-label">ตำบล</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" value="หินดาด" readonly>
                                </div>
                                <label class="col-sm-1 col-form-label">อำเภอ</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" value="ห้วยแถลง" readonly>
                                </div>
                                <label class="col-sm-1 col-form-label">จังหวัด</label>
                                <div class="col-sm-3">
                                    <input class="form-control" type="text" value="นครราชสีมา" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <div class="row">
                                <label class="col-sm-1 col-form-label">ละติจูด</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" value="15.4919163" readonly>
                                </div>
                                <label class="col-sm-1 col-form-label">ลองติจูด</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" value="101.4889272" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <div class="row">
                                <label class="col-sm-5 col-form-label">เขตพื้นที่องค์กรปกครองส่วนท้องถิ่น(อบต./เทศบาล)</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" value="หินดาด" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">ในเขตพื้นที่พิเศษ</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="ชุมชนบ้านปรางค์" readonly>
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