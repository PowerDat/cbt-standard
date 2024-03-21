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
                        <li class="breadcrumb-item active">หน้าแรก</li>
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
                        <h3>ด้านการบริหารจัดการการท่องเที่ยวโดยชุมชน</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>เป้าประสงค์</th>
                                        <th>ประเมิน</th>
                                        <th>สถานะ</th>
                                        <th>คะแนนดิบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>ประสิทธิภาพในการบริหารจัดการโดยชุมชน</td>
                                        <td class="text-center">
                                            <a href="{{route('evaluate.community.form-goal-first')}}" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-primary">สำเร็จ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>ประสิทธิภาพของข้อตกลงร่วมกันสำหรับการบริหารจัดการการท่องเที่ยวโดยชุมชน</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">กำลังทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>ประสิทธิภาพของข้อควรปฏิบัติสำหรับนักท่องเที่ยว</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>ประสิทธิภาพของกลุ่มบริหารจัดการการท่องเที่ยงโดยชุมชนในการพัฒนาบุคคลากรในกลุ่ม</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>ประสิทธิภาพของการส่งเสริมการมีส่วนร่วมของทุกฝ่าย</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>ประสิทธิภาพการมีส่วนร่วมของภาคีเครือข่าย</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>ประสิทธิภาพด้านการจัดการการตลาดและประชาสัมพันธ์การท่องเที่ยวโดยชุมชนอย่างยั่งยืน</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>ประสิทธิภาพของระบบบัญชี</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>การให้ความสำคัญกับเยาวชน</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-info btn-xs">
                                                <i data-feather="list"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">ยังไม่ทำ</span>
                                        </td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td><strong>คะแนนรวม</strong></td>
                                        <td class="text-center">0</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td><strong>คะแนนที่ได้</strong></td>
                                        <td class="text-center">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
