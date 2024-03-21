@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ประเมินผล</li>
                    <li class="breadcrumb-item">ด้านการบริหารจัดการการท่องเที่ยวโดยชุมชน</li>
                    <li class="breadcrumb-item active">เป้าประสงค์ 1.1</li>
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
                    <h5>เป้าประสงค์ 1.1: การบริหารจัดการการท่องเที่ยวโดยชุมชนมีประสิทธิภาพ</h5>
                </div>
                <div class="card-body">

                    {{-- stepwizard --}}
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a class="btn btn-primary" href="#step-1">1</a>
                            </div>
                            <div class="stepwizard-step">
                                <a class="btn btn-light" href="#step-2">2</a>
                            </div>
                            <div class="stepwizard-step">
                                <a class="btn btn-light" href="#step-3">3</a>
                            </div>
                            <div class="stepwizard-step">
                                <a class="btn btn-light" href="#step-4">4</a>
                            </div>
                            <div class="stepwizard-step">
                                <a class="btn btn-light" href="#step-5">5</a>
                            </div>
                        </div>
                    </div>

                    <form method="post">

                        {{-- step-1 --}}
                        <div class="setup-content" id="step-1">

                            <div class="row">
                                <div class="col-xs-12">
                                    <p>
                                        (1)
                                        มีการจัดตั้งกลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนซึ่งได้รับการรับรองจากหน่วยงานภาครัฐและมีโครงสร้างการทำงาน
                                        แบ่งบทบาทหน้าที่และความรับผิดชอบของแต่ละหน้าที่
                                    </p>
                                    <p>
                                        <strong>คำอธิบาย:</strong>
                                        สมาชิกร่วมกันจัดตั้งกลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนโดยเฉพาะ
                                        พร้อมทั้งมีการรับรองการจัดตั้งกลุ่มฯ จากหน่วยงานภาครัฐ เช่น เทศบาล อบต.
                                        เป็นลายลักษณ์อักษร เช่น คำสั่ง
                                        หรือ ประกาศแต่งตั้งกลุ่มฯ เพื่อให้มีการเชื่อมโยงระหว่างกลุ่มฯ และท้องถิ่น
                                        ทั้งนี้ กลุ่มฯ ดังกล่าวควรมีโครงสร้างการ์ทำงานที่ชัดเจน
                                        โดยแบ่งบทบาทหน้าที่และรายละเอียดความรับผิดชอบ
                                        ของแต่ละหน้าที่ไว้อย่างชัดเจนเป็นลายลักษณ์อักษร
                                    </p>
                                    <h5><span class="badge bg-info">ข้อการประเมิน</span></h5>

                                    <div class="col">
                                        <div class="form-group m-t-15">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox21" type="checkbox">
                                                <label for="checkbox21">
                                                    มีการจัดตั้งกลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนเพื่อการบริหารจัดการการท่องเที่ยวโดยเฉพาะโดยมีตัวแทนจากภาครัฐ
                                                    ภาคเอกชนและตัวแทน ของชุมชน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox22" type="checkbox">
                                                <label for="checkbox22">
                                                    กลุ่มดังกล่าวมีคำสั่งหรือ
                                                    ประกาศแต่งตั้งที่ได้รับการรับรองจากหน่วยงานภาครัฐ เช่น เทศบาล อบต.
                                                    เป็นต้น
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox23" type="checkbox">
                                                <label for="checkbox23">
                                                    กลุ่มฯ มีโครงสร้างการทำงาน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox24" type="checkbox">
                                                <label for="checkbox24">
                                                    กลุ่มมีการแบ่งบทบาทหน้าที่ความรับผิดชอบของแต่ละหน้าที่
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5><span class="badge bg-info">เกณฑ์การให้คะแนน</span></h5>
                                    <p>คะแนน 4 = มีคุณสมบัติครบทั้ง 4 ดัชนี | คะแนน 3 = มีคุณสมบัติ 3 ดัชนี | คะแนน 2 =
                                        มีคุณสมบัติ 2 ดัชนี | คะแนน 1 = มีคุณสมบัติ 1 ดัชนี | คะแนน 0 =
                                        ไม่มีคุณสมบัติข้อใดเลย</p>
                                    <div class="col-sm-12">
                                        <h5><span class="badge bg-info">คะแนนการประเมิน</span></h5>
                                    </div>
                                    <div class="col">
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                            <div class="radio radio-primary">
                                                <input id="radioinline4" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline4">
                                                    <span class="digits">4</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline3" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline3">
                                                    <span class="digits">3</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline2" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline2">
                                                    <span class="digits">2</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline1" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline1">
                                                    <span class="digits">1</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline0" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline0">
                                                    <span class="digits">0</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-3">
                                        <h5><span class="badge bg-info">ความคิดเห็นเพิ่มเติม(เชิงคุณภาพ)</span></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                                    </div>

                                    <button class="btn btn-primary nextBtn pull-right" type="button">ต่อไป</button>
                                </div>
                            </div>
                        </div>

                        {{-- step-2 --}}
                        <div class="setup-content" id="step-2">

                            <div class="row">
                                <div class="col-xs-12">
                                    <p>
                                        (2)
                                        มีกรรมการกลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนที่เป็นคนในชุมชนเเละมีบทบาทในการจัดทำเเละขับเคลื่อนเเผนการพัฒนาการท่องเที่ยวโดยชุมชน
                                    </p>
                                    <p>
                                        <strong>คำอธิบาย:</strong>
                                        กลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนประกอบด้วยกรรมการที่เป็นคนในชุมชน
                                        เพื่อให้เป็นการบริหารจัดการโดยคนท้องถิ่นเพื่อคนในท้องถิ่นอีกทั้งสมาชิกกลุ่มฯ
                                        ได้เข้ามามีส่วนร่วมในการจัดทำเเละขับเคลื่อนเเผนการพัฒนาการท่องเที่ยวโดยชุมชนเพื่อให้เป็นไปตามความต้องการของชุมชนอย่างเเท้จริง
                                    </p>
                                    <h5><span class="badge bg-info">ข้อการประเมิน</span></h5>

                                    <div class="col">
                                        <div class="form-group m-t-15">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox25" type="checkbox">
                                                <label for="checkbox25">
                                                    กรรมการกลุ่มฯ เป็นคนในชุมชน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox26" type="checkbox">
                                                <label for="checkbox26">
                                                    กรรมการเเละสมาชิกกลุ่มฯ มีส่วนร่วมในการจัดทำเเผนการพัฒนาการท่องเที่ยวโดยชุมชน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox27" type="checkbox">
                                                <label for="checkbox27">
                                                    กรรมการเเละสมาชิกกลุ่มฯ มีส่วนร่วมในการขับเคลื่อนเเละปรับปรุงเเผนการพัฒนาการท่องเที่ยวโดยชุมชน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox28" type="checkbox">
                                                <label for="checkbox28">
                                                    กลุ่มมีการจัดทำเวทีเพื่อให้สมาชิกกลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนร่วมกันกำหนดเป้าหมายเเละเเผนการดำเนินงานอย่างน้อยปีละ 1 ครั้ง
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5><span class="badge bg-info">เกณฑ์การให้คะแนน</span></h5>
                                    <p>คะแนน 4 = มีคุณสมบัติครบทั้ง 4 ดัชนี | คะแนน 3 = มีคุณสมบัติ 3 ดัชนี | คะแนน 2 =
                                        มีคุณสมบัติ 2 ดัชนี | คะแนน 1 = มีคุณสมบัติ 1 ดัชนี | คะแนน 0 =
                                        ไม่มีคุณสมบัติข้อใดเลย</p>
                                    <div class="col-sm-12">
                                        <h5><span class="badge bg-info">คะแนนการประเมิน</span></h5>
                                    </div>
                                    <div class="col">
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                            <div class="radio radio-primary">
                                                <input id="radioinline24" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline24">
                                                    <span class="digits">4</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline23" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline23">
                                                    <span class="digits">3</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline22" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline22">
                                                    <span class="digits">2</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline21" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline21">
                                                    <span class="digits">1</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline20" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline20">
                                                    <span class="digits">0</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-3">
                                        <h5><span class="badge bg-info">ความคิดเห็นเพิ่มเติม(เชิงคุณภาพ)</span></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                                    </div>

                                    <button class="btn btn-primary nextBtn pull-right" type="button">ต่อไป</button>
                                </div>
                            </div>
                        </div>

                        {{-- step-3 --}}
                        <div class="setup-content" id="step-3">

                            <div class="row">
                                <div class="col-xs-12">
                                    <p>
                                        (3) กลุ่มส่งเสริมการท่องเที่ยวโดยชุมชนมีวิสัยทัศน์ เป้าหมาย พันธกิจ ยุทธศาสตร์ เเละเเผนการดำเนินงานที่ครอบคลุมทั้ง 3 มิติ คือ เศรษฐกิจ สังคม สิ่งเเวดล้อม
                                    </p>
                                    <p>
                                        <strong>คำอธิบาย:</strong>
                                        กลุ่มส่งเสริมการท่องเที่ยวมีแผนการดำเนินงานที่ประกอบไปด้วยวิสัยทัศน์ เป้าหมาย พันธกิจ ยุทธศาสตร์ และแผนการดำเนินงานที่ครอบคลุมทั้ง 3 มิติ คือ เศรษฐกิจ สังคม และสิ่งแวดล้อม โดยมีการบูรณาการการดำเนินงานทั้ง 3 มิติ เพื่อคำนึงถึงความสมดุลของความยั่งยืน และ สมาชิกกลุ่มฯ มีส่วนร่วมในการกำหนดเป้าหมาย และ แผนการดำเนินงานร่วมกัน
                                    </p>
                                    <h5><span class="badge bg-info">ข้อการประเมิน</span></h5>

                                    <div class="col">
                                        <div class="form-group m-t-15">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox29" type="checkbox">
                                                <label for="checkbox29">
                                                    กลุ่มฯ มีวิสัยทัศน์ เป้าหมาย พันธกิจ ยุทธศาสตร์ และแผนการดำเนินงานและติดตามผลด้านเศรษฐกิจและการจัดการคุณภาพ
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox30" type="checkbox">
                                                <label for="checkbox30">
                                                    กลุ่มฯ มีวิสัยทัศน์ เป้าหมาย พันธกิจ ยุทธศาสตร์ และแผนการดำเนินงานและติดตามผลด้านสังคม วัฒนธรรม
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox31" type="checkbox">
                                                <label for="checkbox31">
                                                    กลุ่มฯ มีวิสัยทัศน์ เป้าหมาย พันธกิจ ยุทธศาสตร์ และแผนการดำเนินงานและติดตามผลด้านสิ่งแวดล้อมและการจัดการงานศิลป์
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox32" type="checkbox">
                                                <label for="checkbox32">
                                                    กลุ่มฯ มีการบูรณาการแผนยุทธศาสตร์ที่มีการดำเนินงานและติดตามผล 3 มิติ คือ เศรษฐกิจ สังคม และสิ่งแวดล้อมเข้าด้วยกัน ทำให้เกิดความสมดุลในการพัฒนาการท่องเที่ยวในชุมชนมากขึ้น โดยดูได้จากโครงการที่นำไปปฏิบัติจริง
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox33" type="checkbox">
                                                <label for="checkbox33">
                                                    แผนบูรณาการมีการคำนึง ถึงความปลอดภัยและสุขภาวะ
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox34" type="checkbox">
                                                <label for="checkbox34">
                                                    แผนบูรณาการมีระบบในการติดตามผลกระทบจากการท่องเที่ยวและวางแผนในการให้ข้อมูลต่อสาธารณะ
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox35" type="checkbox">
                                                <label for="checkbox35">
                                                    แผนบูรณาการมีการวางแผน ร่วมกับการมีส่วนร่วมของชุมชน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox36" type="checkbox">
                                                <label for="checkbox36">
                                                    มีการประชาสัมพันธ์แผนสู่สาธารณะ
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox37" type="checkbox">
                                                <label for="checkbox37">
                                                    แผนได้นำไปปฏิบัติ
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox38" type="checkbox">
                                                <label for="checkbox38">
                                                    แผนมีระบบในการติดตาม ประเมินผลกระทบด้านสิ่งแวดล้อม สังคม วัฒนธรรม และสิทธิมนุษยชน
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox39" type="checkbox">
                                                <label for="checkbox39">
                                                    แผนมีการกำหนดแนวทางในการตอบสนองต่อประเด็น ต่างๆ ที่เกิดขึ้นนำมาบริหารจัดการให้ดีขึ้น
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox40" type="checkbox">
                                                <label for="checkbox40">
                                                    แผนบูรณาการและแผนติดตามผลมีการปรับปรุงอย่างสม่ำเสมอ
                                                </label>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">แนบเอกสาร</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">รูปภาพ</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <p class="text-danger">วีดีโอ</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5><span class="badge bg-info">เกณฑ์การให้คะแนน</span></h5>
                                    <p>คะแนน 4 = มีคุณสมบัติครบทั้ง 4 ดัชนี | คะแนน 3 = มีคุณสมบัติ 3 ดัชนี | คะแนน 2 =
                                        มีคุณสมบัติ 2 ดัชนี | คะแนน 1 = มีคุณสมบัติ 1 ดัชนี | คะแนน 0 =
                                        ไม่มีคุณสมบัติข้อใดเลย</p>
                                    <div class="col-sm-12">
                                        <h5><span class="badge bg-info">คะแนนการประเมิน</span></h5>
                                    </div>
                                    <div class="col">
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                            <div class="radio radio-primary">
                                                <input id="radioinline34" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline34">
                                                    <span class="digits">4</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline33" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline33">
                                                    <span class="digits">3</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline32" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline32">
                                                    <span class="digits">2</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline31" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline31">
                                                    <span class="digits">1</span></label>
                                            </div>
                                            <div class="radio radio-primary">
                                                <input id="radioinline30" type="radio" name="radio1" value="option1">
                                                <label class="mb-0" for="radioinline30">
                                                    <span class="digits">0</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-3">
                                        <h5><span class="badge bg-info">ความคิดเห็นเพิ่มเติม(เชิงคุณภาพ)</span></h5>
                                    </div>
                                    <div class="col mb-3">
                                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                                    </div>

                                    <button class="btn btn-primary nextBtn pull-right" type="button">ต่อไป</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/form-wizard/form-wizard-two.js') }}"></script>
@endpush