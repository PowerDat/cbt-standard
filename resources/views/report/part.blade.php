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
                    <li class="breadcrumb-item active">ด้าน 1</li>
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
                    <h3>สรุปผลคะแนนรวม ด้าน 1 ด้านการบริหารจัดการการท่องเที่ยวโดยชุมชน</h3>
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
                                    <td class="text-center">1.1</td>
                                    <td>การบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.2</td>
                                    <td>ข้อตกลงร่วมกันสำหรับการบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.3</td>
                                    <td>ข้อควรปฏิบัติสำหรับนักท่องเที่ยวมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">3.5</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.4</td>
                                    <td>การพัฒนาบุคลากรในกลุ่มบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">1</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.5</td>
                                    <td>การส่งเสริมการมีส่วนร่วมของทุกฝ่ายมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.6</td>
                                    <td>การมีส่วนร่วมของภาคีเครือข่ายต่าง ๆ เป็นไปอย่างมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">3</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.7</td>
                                    <td>การจัดการการตลาดและประชาสัมพันธ์การท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">4</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.8</td>
                                    <td>ระบบบัญชี การเงินมีประสิทธิภาพ</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2</td>
                                </tr>
                                <tr>
                                    <td class="text-center">1.9</td>
                                    <td>เยาวชนได้รับการให้ความสำคัญในการท่องเที่ยวโดยชุมชน</td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">2.5</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                    <td class="text-center"><strong>36</strong></td>
                                    <td class="text-center"><strong>24</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                    <td class="text-center"><strong>{{ number_format(24/9, 2) }}</strong></td>
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
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.1 การบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.2 ข้อตกลงร่วมกันสำหรับการบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.3 ข้อควรปฏิบัติสำหรับนักท่องเที่ยวมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.4 การพัฒนาบุคลากรในกลุ่มบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.5 การส่งเสริมการมีส่วนร่วมของทุกฝ่ายมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.6 การมีส่วนร่วมของภาคีเครือข่ายต่าง ๆ เป็นไปอย่างมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.7 การจัดการการตลาดและประชาสัมพันธ์การท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.8 ระบบบัญชี การเงินมีประสิทธิภาพ</li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> เกณฑ์ 1.9 เยาวชนได้รับการให้ความสำคัญในการท่องเที่ยวโดยชุมชน</li>
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
            'เกณฑ์ 1.1',
            'เกณฑ์ 1.2',
            'เกณฑ์ 1.3',
            'เกณฑ์ 1.4',
            'เกณฑ์ 1.5',
            'เกณฑ์ 1.6',
            'เกณฑ์ 1.7',
            'เกณฑ์ 1.8',
            'เกณฑ์ 1.9',
        ],
        datasets: [{
            label: 'ผลคะแนน',
            data: [2, 4, 3.5, 1, 2, 3, 4, 2, 2.5],
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