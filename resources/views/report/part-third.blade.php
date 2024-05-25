@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">รายงาน</li>
                    <li class="breadcrumb-item">สรุปผลคะแนนรวม</li>
                    <li class="breadcrumb-item active">ด้าน 3</li>
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

                <div class="card-header">
                    <h3>สรุปผลคะแนนรวม ด้าน 3 ด้านการอนุรักษ์และส่งเสริมมรดกทางวัฒนธรรม</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
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
                                <tr>
                                    <td class="text-center">3.1</td>
                                    <td>ฐานข้อมูลด้านมรดกวัฒนธรรมเพื่อการท่องเที่ยวมีคุณภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3.2</td>
                                    <td>การเผยแพร่มรดกวัฒนธรรมผ่านการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3.3</td>
                                    <td>การอนุรักษ์ฟื้นฟูวัฒนธรรมท้องถิ่นประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">3.5</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                    <td class="text-center"><strong>36</strong></td>
                                    <td class="text-center"><strong>9.5</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                    <td class="text-center"><strong>{{ number_format(9.5/3, 2) }}</strong></td>
                                    <td class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 box-col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                <canvas id="myRadarGraph"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-6 m-t-50">
                            <ul class="list-group" style="font-size: 12px;">
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 3.1 ฐานข้อมูลด้านมรดกวัฒนธรรมเพื่อการท่องเที่ยวมีคุณภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 3.2 การเผยแพร่มรดกวัฒนธรรมผ่านการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 3.3 การอนุรักษ์ฟื้นฟูวัฒนธรรมท้องถิ่นประสิทธิภาพ</li>
                            </ul>
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
    const data = {
        labels: [
            'เกณฑ์ 3.1',
            'เกณฑ์ 3.2',
            'เกณฑ์ 3.3',
        ],
        datasets: [{
            label: 'ผลคะแนน',
            data: [2, 4, 3.5],
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {},
    };

    const myChart = new Chart(
        document.getElementById('myRadarGraph'),
        config
    );
</script>
@endpush