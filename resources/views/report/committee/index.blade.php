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
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน : @if (session()->has('community_name')) {{session()->get('community_name')}} @endif</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary active" href="{{route('report.committee.index')}}">
                                ชุมชนที่ประเมิน
                            </a>
                            <a class="btn btn-light" href="{{route('report.committee.summary')}}">
                                สรุปผลการประเมิน
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
    
                <div class="card-body">

                    <form method="POST" action="{{route('report.committee.get-result')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="form-label">ชุมชน</label>
                            </div>
                            <div class="col-sm-8">
                                <select  class="form-control" id="community" name="community">
                                    <option value="" selected disabled>เลือกชุมชน</option>
                                    @foreach ($community as $item)
                                        <option value="{{$item->community_id}}" 
                                        @if (session()->has('session_community'))
                                            @if (session()->get('session_community') == $item->community_id)
                                                selected
                                            @endif
                                        @endif
                                        >{{$item->community_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                            </div>
                        </div>
                    </form>
                    
                    @if (isset($parts))
                    <div class="row mt-5">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-1-tab" data-bs-toggle="pill" href="#pills-1"
                                        role="tab" aria-controls="pills-1" aria-selected="true">
                                        ด้าน 1
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-2-tab" data-bs-toggle="pill" href="#pills-2"
                                        role="tab" aria-controls="pills-2" aria-selected="false">
                                        ด้าน 2
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-3-tab" data-bs-toggle="pill" href="#pills-3"
                                        role="tab" aria-controls="pills-3" aria-selected="false">
                                        ด้าน 3
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-4-tab" data-bs-toggle="pill" href="#pills-4"
                                        role="tab" aria-controls="pills-4" aria-selected="false">
                                        ด้าน 4
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-5-tab" data-bs-toggle="pill" href="#pills-5"
                                        role="tab" aria-controls="pills-5" aria-selected="false">
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
                    @endif
    
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

    });
</script>
@endpush
