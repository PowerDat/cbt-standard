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
                    <li class="breadcrumb-item active">ด้าน 2</li>
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
                    <h3>สรุปผลคะแนนรวม ด้าน 2 ด้านการจัดการเศรษฐกิจ สังคมและคุณภาพชีวิตที่ดี</h3>
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
                                    <td class="text-center">2.1</td>
                                    <td>การจัดสรรรายได้มีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2.2</td>
                                    <td>การส่งเสริมการยกระดับคุณภาพชีวิตที่ดีเป็นไปอย่างมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2.3</td>
                                    <td>ผลิตภัณฑ์ชุมชนมีคุณภาพเพื่อเสริมสร้างโอกาสในการเพิ่มรายได้จากการท่องเที่ยว</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">3.5</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2.4</td>
                                    <td>สิทธิมนุษยชนในการท่องเที่ยวได้รับการให้ความสำคัญ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">1</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                    <td class="text-center"><strong>36</strong></td>
                                    <td class="text-center"><strong>10.5</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                    <td class="text-center"><strong>{{ number_format(10.5/4, 2) }}</strong></td>
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
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 2.1 การจัดสรรรายได้มีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 2.2 การส่งเสริมการยกระดับคุณภาพชีวิตที่ดีเป็นไปอย่างมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 2.3 ผลิตภัณฑ์ชุมชนมีคุณภาพเพื่อเสริมสร้างโอกาสในการเพิ่มรายได้จากการท่องเที่ยว</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 2.4 สิทธิมนุษยชนในการท่องเที่ยวได้รับการให้ความสำคัญ</li>
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
            'เกณฑ์ 2.1',
            'เกณฑ์ 2.2',
            'เกณฑ์ 2.3',
            'เกณฑ์ 2.4',
        ],
        datasets: [{
            label: 'ผลคะแนน',
            data: [2, 4, 3.5, 1],
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