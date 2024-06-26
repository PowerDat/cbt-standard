@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">สรุปรายงาน</li>
                    <li class="breadcrumb-item">
                        @if (session()->has('community_name'))
                        {{session()->get('community_name')}}
                        @endif

                        @if (session()->has('session_community_by_select_option'))
                        {{session()->get('session_community_by_select_option')}}
                        @endif
                    </li>
                    <li class="breadcrumb-item active">ประเมินตนเอง</li>
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
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน : 
                        @if (session()->has('community_name')) 
                            {{session()->get('community_name')}} 
                        @endif

                        @if (session()->has('session_community_by_select_option'))
                            {{session()->get('session_community_by_select_option')}}
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary active" href="{{route('report.self-assessment')}}">
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

    <div class="col-sm-12 col-xl-6 xl-100">
        <div class="card">

            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" href="#pills-1" role="tab"
                            aria-controls="pills-1" aria-selected="true">
                            ด้าน 1
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-2-tab" data-bs-toggle="pill" href="#pills-2" role="tab"
                            aria-controls="pills-2" aria-selected="false">
                            ด้าน 2
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-3-tab" data-bs-toggle="pill" href="#pills-3" role="tab"
                            aria-controls="pills-3" aria-selected="false">
                            ด้าน 3
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-4-tab" data-bs-toggle="pill" href="#pills-4" role="tab"
                            aria-controls="pills-4" aria-selected="false">
                            ด้าน 4
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-5-tab" data-bs-toggle="pill" href="#pills-5" role="tab"
                            aria-controls="pills-5" aria-selected="false">
                            ด้าน 5
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-warningtabContent">

                    {{-- /* ----- ด้าน 1 ----- */ --}}
                    @include('report.part-first')

                    {{-- /* ----- ด้าน 2 ----- */ --}}
                    @include('report.part-second')

                    {{-- /* ----- ด้าน 3 ----- */ --}}
                    @include('report.part-third')

                    {{-- /* ----- ด้าน 4 ----- */ --}}
                    @include('report.part-fourth')

                    {{-- /* ----- ด้าน 5 ----- */ --}}
                    @include('report.part-fifth')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush