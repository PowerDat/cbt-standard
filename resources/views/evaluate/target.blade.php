@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">แบบประเมิน</li>
                        <li class="breadcrumb-item active">
                            @if (session()->has('community_name'))
                            {{'ชุมชน'.session()->get('community_name')}}
                            @endif
                        </li>
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
                                            @php
                                                $status = DB::select("SELECT appraisal_transaction_status FROM appraisal_transaction WHERE part_target_id = $item->part_target_id");
                                                if(!empty($status)){
                                                    foreach ($status as $value) {
                                                        if($value->appraisal_transaction_status == '2'){
                                                            echo "<a href='/evaluate/show/$item->part_target_id' class='btn btn-primary btn-xs'><i data-feather='eye'></i></a>";
                                                        }
                                                        elseif($value->appraisal_transaction_status == '1'){
                                                            echo "<a href='/evaluate/form/$item->part_target_id' class='btn btn-info btn-xs'><i data-feather='edit'></i></a>";
                                                        }
                                                    }
                                                }
                                                else{
                                                    echo "<a href='/evaluate/form/$item->part_target_id' class='btn btn-warning btn-xs'><i data-feather='edit'></i></a>";
                                                }
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $status = DB::select("SELECT appraisal_transaction_status FROM appraisal_transaction WHERE part_target_id = $item->part_target_id");
                                                if(!empty($status)){
                                                    foreach ($status as $value) {
                                                        if($value->appraisal_transaction_status == '1'){
                                                            echo '<span class="badge badge-info">แบบร่าง</span>';
                                                        }
                                                        elseif($value->appraisal_transaction_status == '2'){
                                                            echo "<span class='badge badge-primary'>สำเร็จ</span>";
                                                        }
                                                    }
                                                }
                                                else{
                                                    echo "<span class='badge badge-warning'>ยังไม่ทำ</span>";
                                                }
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            @php
                                                // if($item->part_target_id == ){
                                                $value = DB::select("   SELECT sum(appraisal_score_score) as score 
                                                                        FROM appraisal_score 
                                                                        INNER JOIN appraisal_transaction ON appraisal_score.part_target_id = appraisal_transaction.part_target_id
                                                                        WHERE appraisal_score.part_target_id = $item->part_target_id 
                                                                            AND appraisal_transaction.appraisal_transaction_status = 2
                                                                    ");
                                                echo $value[0]->score;
                                                // }
                                                
                                            @endphp 
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
