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
            @foreach ($part as $item)
            <div class="col-sm-6">
                <div class="card card-absolute">
                    
                    <div class="card-header bg-primary">
                        <h5 class="text-white">ด้าน {{$item->part_order}}</h5>
                    </div>

                    <div class="card-body">
                        <p>{{$item->part_name}}</p>
                        <p class="text-end">
                            <a href="{{route('evaluate.target', $item->part_id)}}" class="btn btn-light">ประเมิน</a>
                        </p>
                    </div>

                </div>
            </div>
            @endforeach
            
        </div>
    </div>
@endsection
