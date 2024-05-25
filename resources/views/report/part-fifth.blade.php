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
                    <li class="breadcrumb-item active">ด้าน 5</li>
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
                    <h3>สรุปผลคะแนนรวม ด้าน 5 ด้านบริการและความปลอดภัย</h3>
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
                                    <td class="text-center">5.1</td>
                                    <td>การให้บริการและความปลอดภัยด้านการท่องเที่ยวเป็นไปอย่างพึงพอใจ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5.2</td>
                                    <td>นักสื่อความหมายมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5.3</td>
                                    <td>เส้นทางและกิจกรรมท่องเที่ยวมีความปลอดภัย</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">3.5</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5.4</td>
                                    <td>จุดบริการท่องเที่ยวมีคุณภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">1</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5.5</td>
                                    <td>การบริหารจัดการเส้นทางการเดินทางท่องเที่ยวในชุมชนมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5.6</td>
                                    <td>การบริหารจัดการกรณีฉุกเฉินมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">3</td>
                                </tr>
                                <tr>
                                    <td class="text-center">5.7</td>
                                    <td>การติดต่อประสานงานด้านบริการมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                    <td class="text-center"><strong>36</strong></td>
                                    <td class="text-center"><strong>19.5</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                    <td class="text-center"><strong>{{ number_format(19.5/7, 2) }}</strong></td>
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
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.1 การให้บริการและความปลอดภัยด้านการท่องเที่ยวเป็นไปอย่างพึงพอใจ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.2 นักสื่อความหมายมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.3 เส้นทางและกิจกรรมท่องเที่ยวมีความปลอดภัย</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.4 จุดบริการท่องเที่ยวมีคุณภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.5 การบริหารจัดการเส้นทางการเดินทางท่องเที่ยวในชุมชนมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.6 การบริหารจัดการกรณีฉุกเฉินมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 5.7 การติดต่อประสานงานด้านบริการมีประสิทธิภาพ</li>
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
            'เกณฑ์ 5.1',
            'เกณฑ์ 5.2',
            'เกณฑ์ 5.3',
            'เกณฑ์ 5.4',
            'เกณฑ์ 5.5',
            'เกณฑ์ 5.6',
            'เกณฑ์ 5.7',
        ],
        datasets: [{
            label: 'ผลคะแนน',
            data: [2, 4, 3.5, 1, 2, 3, 4],
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