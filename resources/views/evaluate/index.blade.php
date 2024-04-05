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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>แบบประเมิน</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered ">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        {{-- <th>ลำดับ</th>
                                        <th>ด้าน</th> --}}
                                        <th>ลำดับ</th>
                                        <th>ด้าน</th>
                                        <th>ประเมิน</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($part as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_order}}</td>
                                        <td>{{$item->part_name}}</td> 
                                        <td class="text-center">
                                            <a href="{{route('evaluate.target', $item->part_id)}}" class="btn btn-light">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
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
            
        </div> --}}
    </div>
@endsection
