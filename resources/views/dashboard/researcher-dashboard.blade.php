<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h3>ข้อมูลกรรมการ</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3 text-center">
                        <img class="rounded-circle" src="{{session()->get('user_image_cover')}}" alt="" style="width: 150px;height:150px;">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{session()->get('user_name')}}" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label">นามสกุล</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="{{session()->get('user_surname')}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">อีเมล</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
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
                            <div class="col-xl-12 col-md-12 box-col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                                                    <canvas id="myRadarGraph"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 m-t-50">
                                                <ul class="list-group" style="font-size: 12px;">
                                                    <li class="list-group-item"><i class="fa fa-circle"></i> ด้าน 1 บริหารจัดการการท่องเที่ยว</li>
                                                    <li class="list-group-item"><i class="fa fa-circle"></i> ด้าน 2 จัดการเศรษฐกิจ สังคม และคุณภาพชีวิต</li>
                                                    <li class="list-group-item"><i class="fa fa-circle"></i> ด้าน 3 อนุรักษ์และส่งเสริมมรดกทางวัฒนธรรม</li>
                                                    <li class="list-group-item"><i class="fa fa-circle"></i> ด้าน 4 จัดการทรัพยากรธรรมชาติและสิ่งแวดล้อม</li>
                                                    <li class="list-group-item"><i class="fa fa-circle"></i> ด้าน 5 บริการและความปลอดภัย</li>
                                                </ul>
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