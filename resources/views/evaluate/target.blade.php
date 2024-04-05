@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">แบบประเมิน</li>
                        {{-- <li class="breadcrumb-item">{{'ด้าน '.$part->part_order}}</li>
                        <li class="breadcrumb-item active">{{$part->part_name}}</li> --}}
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
                        <div class="row">
                            <div class="col-sm-9">
                                <h5>{{'ด้าน '.$part->part_order.' '.$part->part_name}}</h5>
                            </div>
                            <div class="col-sm-3 text-end">
                                <a href="{{route('evaluate.index')}}" class="btn btn-info ">ย้อนกลับ</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive mt-5">
                            <table class="table table-bordered ">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เป้าประสงค์</th>
                                        <th>ประเมิน</th>
                                        <th>สถานะ</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($part_target as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">
                                            <a href="{{route('evaluate.form', $item->part_target_id)}}" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{-- <span class="badge badge-primary">สำเร็จ</span> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
