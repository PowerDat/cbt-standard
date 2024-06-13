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
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน : @if (session()->has('community_name'))
                        {{session()->get('community_name')}} @endif</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary active" href="report.self">
                                ประเมินตนเอง
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
                    <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">

                        {{-- table --}}
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เกณฑ์</th>
                                        <th>คะแนนเต็ม</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($score_first as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">4</td>
                                        <td class="text-center">{{$item->sum_score}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                        <td class="text-center"><strong>{{count($score_first) * 4}}</strong></td>
                                        <td class="text-center"><strong>{{number_format($total_first, 2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                        <td class="text-center">
                                            <strong>{{ number_format($total_first/count($score_first), 2) }}</strong>
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- grahp --}}
                        <div class="row mt-3">
                            <h5 class="text-center">การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
                            <div class="col-sm-6">
                                <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                    <canvas id="myRadarGraph_first"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-6 m-t-50">
                                <ul class="list-group" style="font-size: 12px;">
                                    @foreach ($part_target_first as $item)
                                    <li class="list-group-item">
                                        <i class="fa fa-circle"></i> {{'เกณฑ์ '.$item->part_target_order.'
                                        '.$item->part_target_name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                    {{-- /* ----- ด้าน 2 ----- */ --}}
                    <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เกณฑ์</th>
                                        <th>คะแนนเต็ม</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($score_second as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">4</td>
                                        <td class="text-center">{{$item->sum_score}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                        <td class="text-center"><strong>{{count($score_second) * 4}}</strong></td>
                                        <td class="text-center"><strong>{{number_format($total_second, 2)}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                        <td class="text-center">
                                            @if (!empty($total_second))
                                            <strong>{{number_format($total_second/count($score_second), 2) }}</strong>
                                            @endif
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- grahp --}}
                        <div class="row mt-3">
                            <h5 class="text-center">การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
                            <div class="col-sm-6">
                                <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                    <canvas id="myRadarGraph_second"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-6 m-t-50">
                                <ul class="list-group" style="font-size: 12px;">
                                    @foreach ($part_target_second as $item)
                                    <li class="list-group-item">
                                        <i class="fa fa-circle"></i> {{'เกณฑ์ '.$item->part_target_order.' '.$item->part_target_name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                    {{-- /* ----- ด้าน 3 ----- */ --}}
                    <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เกณฑ์</th>
                                        <th>คะแนนเต็ม</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($score_third as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">4</td>
                                        <td class="text-center">{{$item->sum_score}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                        <td class="text-center"><strong>{{count($score_third) * 4}}</strong></td>
                                        <td class="text-center"><strong>{{number_format($total_third, 2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                        <td class="text-center">
                                            @if (!empty($total_third))
                                            <strong>{{number_format($total_third/count($score_third), 2) }}</strong>
                                            @endif
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- grahp --}}
                        <div class="row mt-3">
                            <h5 class="text-center">การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
                            <div class="col-sm-6">
                                <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                    <canvas id="myRadarGraph_third"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-6 m-t-50">
                                <ul class="list-group" style="font-size: 12px;">
                                    @foreach ($part_target_third as $item)
                                    <li class="list-group-item">
                                        <i class="fa fa-circle"></i> {{'เกณฑ์ '.$item->part_target_order.' '.$item->part_target_name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>

                    {{-- /* ----- ด้าน 4 ----- */ --}}
                    <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เกณฑ์</th>
                                        <th>คะแนนเต็ม</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($score_fourth as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">4</td>
                                        <td class="text-center">{{$item->sum_score}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                        <td class="text-center"><strong>{{count($score_fourth) * 4}}</strong></td>
                                        <td class="text-center"><strong>{{number_format($total_fourth, 2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                        <td class="text-center">
                                            @if (!empty($total_fourth))
                                            <strong>{{number_format($total_fourth/count($score_fourth), 2) }}</strong>
                                            @endif
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- grahp --}}
                        <div class="row mt-3">
                            <h5 class="text-center">การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
                            <div class="col-sm-6">
                                <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                    <canvas id="myRadarGraph_fourth"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-6 m-t-50">
                                <ul class="list-group" style="font-size: 12px;">
                                    @foreach ($part_target_fourth as $item)
                                    <li class="list-group-item">
                                        <i class="fa fa-circle"></i> {{'เกณฑ์ '.$item->part_target_order.' '.$item->part_target_name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>

                    {{-- /* ----- ด้าน 5 ----- */ --}}
                    <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5-tab">
                        
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เกณฑ์</th>
                                        <th>คะแนนเต็ม</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($score_fifth as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">4</td>
                                        <td class="text-center">{{$item->sum_score}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                        <td class="text-center"><strong>{{count($score_fifth) * 4}}</strong></td>
                                        <td class="text-center"><strong>{{number_format($total_fifth, 2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                        <td class="text-center">
                                            @if (!empty($total_fifth))
                                            <strong>{{number_format($total_fifth/count($score_fifth), 2) }}</strong>
                                            @endif
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- grahp --}}
                        <div class="row mt-3">
                            <h5 class="text-center">การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
                            <div class="col-sm-6">
                                <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                    <canvas id="myRadarGraph_fifth"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-6 m-t-50">
                                <ul class="list-group" style="font-size: 12px;">
                                    @foreach ($part_target_fifth as $item)
                                    <li class="list-group-item">
                                        <i class="fa fa-circle"></i> {{'เกณฑ์ '.$item->part_target_order.' '.$item->part_target_name}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    /* ----- ด้าน 1 ----- */ 
    const data_first = {
        labels: @json($data_first['labels']),
        datasets: [{
            label: 'ผลคะแนน',
            data: @json($data_first['data']),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config_first = {
        type: 'radar',
        data: data_first,
        options: {},
    };

    const myChart_first = new Chart(
        document.getElementById('myRadarGraph_first'),
        config_first
    );

    /* ----- ด้าน 2 ----- */ 
    const data_second = {
        labels: @json($data_second['labels']),
        datasets: [{
            label: 'ผลคะแนน',
            data: @json($data_second['data']),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config_second = {
        type: 'radar',
        data: data_second,
        options: {},
    };

    const myChart_second = new Chart(
        document.getElementById('myRadarGraph_second'),
        config_second
    );

    /* ----- ด้าน 3 ----- */ 
    const data_third = {
        labels: @json($data_third['labels']),
        datasets: [{
            label: 'ผลคะแนน',
            data: @json($data_third['data']),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config_third = {
        type: 'radar',
        data: data_third,
        options: {},
    };

    const myChart_third = new Chart(
        document.getElementById('myRadarGraph_third'),
        config_third
    );

    /* ----- ด้าน 4 ----- */ 
    const data_fourth = {
        labels: @json($data_fourth['labels']),
        datasets: [{
            label: 'ผลคะแนน',
            data: @json($data_fourth['data']),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config_fourth = {
        type: 'radar',
        data: data_fourth,
        options: {},
    };

    const myChart_fourth = new Chart(
        document.getElementById('myRadarGraph_fourth'),
        config_fourth
    );

    /* ----- ด้าน 5 ----- */ 
    const data_fifth = {
        labels: @json($data_fifth['labels']),
        datasets: [{
            label: 'ผลคะแนน',
            data: @json($data_fifth['data']),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config_fifth = {
        type: 'radar',
        data: data_fifth,
        options: {},
    };

    const myChart_fifth = new Chart(
        document.getElementById('myRadarGraph_fifth'),
        config_fifth
    );

</script>
@endpush