@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">สรุปรายงาน</li>
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
                <div class="card-header pb-0">
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-light" href="{{route('report.self')}}">
                                ประเมนตนเอง
                            </a>
                            <a class="btn btn-light" href="">
                                กรรมการประเมิน
                            </a>
                            <a class="btn btn-light" href="">
                                สรุปผลการประเมิน
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush