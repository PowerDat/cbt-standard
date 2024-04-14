@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">แบบประเมิน</li>
                        {{-- <li class="breadcrumb-item active">ข้อมูลด้าน</li> --}}
                    </ol>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>แบบประเมิน</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" id="pills-tab" role="tablist">
                            @foreach ($part as $key => $value)
                            <li class="nav-item">
                                <a class="nav-link {{ ($key === 0) ? 'active' : '' }}" id="pills-{{$key}}-tab" data-bs-toggle="pill"
                                    href="#pills-{{$key}}" role="tab" aria-controls="pills-{{$key}}" aria-selected="true">
                                    {{'ด้าน '.$value->part_order}} <div class="{{ ($key === 0) ? 'media' : '' }}"></div>
                                </a>
                            </li>
                            @endforeach                            
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @foreach ($part as $key => $value)
                            <div class="tab-pane fade {{ ($key === 0) ? 'show active' : '' }}" id="pills-{{$key}}" role="tabpanel"
                                aria-labelledby="pills-{{$key}}-tab">
                                <p class="mt-3 mb-3"><strong>{{'ด้าน '.$value->part_order.' : '.$value->part_name}}</strong></p>
                                {{-- @foreach ($partTarget as $target)
                                    @if ($value->part_id === $target->part_id)
                                        <p>{{'เป้าประสงค์ '.$target->part_target_order.' : '.$target->part_target_name}}</p>
                                    @endif
                                @endforeach --}}
                                <a href="{{route('evaluate.target', $value->part_id)}}" class="btn btn-light">
                                    ประเมิน
                                </a>
                            </div>
                            @endforeach                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
