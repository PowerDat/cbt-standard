@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">ข้อมูลชุมชนการท่องเที่ยว</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container-fluid">

        @if (Auth::user()->role_id == 1)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>ข้อมูลชุมชนการท่องเที่ยว</h3>
                    </div>
                    <div class="card-body">

                        <div class="mb-3 row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-1 col-form-label">ชื่อชุมชน</label>
                                    <div class="col-sm-11">
                                        <input class="form-control" type="text" value="ชุมชนบ้านปรางค์" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-1 col-form-label">ตำบล</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="text" value="หินดาด" readonly>
                                    </div>
                                    <label class="col-sm-1 col-form-label">อำเภอ</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="text" value="ห้วยแถลง" readonly>
                                    </div>
                                    <label class="col-sm-1 col-form-label">จังหวัด</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="text" value="นครราชสีมา" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-1 col-form-label">ละติจูด</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" value="15.4919163" readonly>
                                    </div>
                                    <label class="col-sm-1 col-form-label">ลองติจูด</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" type="text" value="101.4889272" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <div class="row">
                                    <label
                                        class="col-sm-5 col-form-label">เขตพื้นที่องค์กรปกครองส่วนท้องถิ่น(อบต./เทศบาล)</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" value="หินดาด" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">ในเขตพื้นที่พิเศษ</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="ชุมชนบ้านปรางค์" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (Auth::user()->role_id == 2)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>ข้อมูลกรรมการ</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-3 text-center">
                                <img class="rounded-circle" src="{{asset('images/user/6.jpg')}}" alt="" style="width: 150px;height:150px;">
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">ชื่อ</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" value="นพดล" readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label">นามสกุล</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" value="อุทัย" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">อีเมล</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" value="researcher@mail.com" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>ผลการประเมิน</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-primary" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    href="#home" role="tab" aria-controls="home" aria-selected="true">
                                    รวมคะแนนทั้งหมด
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tabs" data-bs-toggle="tab"
                                    href="#profile" role="tab" aria-controls="profile"
                                    aria-selected="false">
                                    การนำผลคะแนนไปใช้ในการวางแผนพัฒนา
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive mt-5">
                                    <table class="table table-bordered ">
                                        <thead class="bg-light text-center">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ด้าน</th>
                                                <th>คะแนนที่ได้ (เต็ม4)</th>
                                                <th>ระดับคะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>ด้านการบริหารจัดการการท่องเที่ยวโดยชุมชน</td>
                                                <td class="text-center">2</td>
                                                <td class="text-center">พอใช้</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>ด้านการจัดการเศรษฐกิจ สังคม และคุณภาพชีวิตที่ดี</td>
                                                <td class="text-center">3</td>
                                                <td class="text-center">ดี</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>ด้านการอนุรักษ์และส่งเสริมมรดกทางวัฒนธรรม</td>
                                                <td class="text-center">2.5</td>
                                                <td class="text-center">ดี</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>ด้านการจัดการทรัพยากรธรรมชาติและสิ่งแวดล้อมอย่างเป็นระบบและยั่งยืน</td>
                                                <td class="text-center">4</td>
                                                <td class="text-center">ดีเยี่ยม</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>ด้านบริการและความปลอดภัย</td>
                                                <td class="text-center">1</td>
                                                <td class="text-center">ควรปรับปรุง</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-6">
                                                        <div class="chart-container" style="position: relative; height:70vh; width:140vw">
                                                            <canvas id="myRadarGraph"></canvas>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3"></div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-sm-12">
                                                        <p>
                                                            ด้าน 1 บริหารจัดการการท่องเที่ยว | ด้าน 2 จัดการเศรษฐกิจ สังคม และคุณภาพชีวิต | ด้าน 3 อนุรักษ์และส่งเสริมมรดกทางวัฒนธรรม
                                                            | ด้าน 4 จัดการทรัพยากรธรรมชาติและสิ่งแวดล้อม | ด้าน 5 บริการและความปลอดภัย
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="{{asset('js/chart.js')}}"></script>
    <script>
        const data = {
            labels: [
                'ด้าน 1',
                'ด้าน 2',
                'ด้าน 3',
                'ด้าน 4',
                'ด้าน 5',
            ],
            datasets: [{
                label: 'ผลคะแนน',
                data: [2, 3, 2.5, 4, 1],
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
