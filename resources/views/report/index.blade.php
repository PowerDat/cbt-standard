@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">สรุปรายงาน</li>
                    <li class="breadcrumb-item active">
                        @if (session()->has('community_name'))
                        {{session()->get('community_name')}}
                        @endif

                        @if (session()->has('session_community_by_select_option'))
                        {{session()->get('session_community_by_select_option')}}
                        @endif
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">ชุมชนที่ประเมิน</label>
                                <select  class="form-control" id="evaluate_community">
                                    <option value="" selected disabled>เลือกชุมชน</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน : @if (session()->has('community_name')) {{session()->get('community_name')}} @endif</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-light" href="{{route('report.self')}}">
                                ประเมินตนเอง
                            </a>
                            {{-- <a class="btn btn-light" href="{{route('report.committee')}}">
                                กรรมการประเมิน
                            </a>
                            <a class="btn btn-light" href="">
                                สรุปผลการประเมิน
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
