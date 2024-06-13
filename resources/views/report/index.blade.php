@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">สรุปรายงาน</li>
                    <li class="breadcrumb-item active">
                        @if (session()->has('community_name'))
                        {{session()->get('community_name')}}
                        @endif
                    </li>
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
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน : @if (session()->has('community_name')) {{session()->get('community_name')}} @endif</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-light" href="{{route('report.self')}}">
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

        {{-- <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                        @foreach ($parts as $part)
                        <li class="nav-item">
                            <a class="nav-link {{($part->part_order == '1') ? 'active' : ''}}" id="pills-{{$part->part_order}}-tab" data-bs-toggle="pill"
                                href="#pills-{{$part->part_order}}" role="tab" aria-controls="pills-{{$part->part_order}}"
                                aria-selected="true">
                                ด้าน {{$part->part_order}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-warningtabContent">
                        @foreach ($parts as $part)
                        <div class="tab-pane fade {{($part->part_order == '1') ? 'show active' : ''}}" id="pills-{{$part->part_order}}" role="tabpanel"
                            aria-labelledby="pills-{{$part->part_order}}-tab">
                            

                            <div class="table-responsive">
                                <p class="mt-3 mb-3"><strong>{{'ด้าน '.$part->part_order.' : '.$part->part_name}}</strong></p>
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
                                        @foreach ($score as $item)
                                        <tr>
                                            <td class="text-center">{{$item->part_target_order}}</td>
                                            <td>{{$item->part_target_name}}</td>
                                            <td class="text-center">4</td>
                                            <td class="text-center">{{$item->sum_score}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                                            <td class="text-center"><strong>36</strong></td>
                                            <td class="text-center"><strong>{{number_format($total, 2)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                                            <td class="text-center"><strong>{{ number_format($total/count($score), 2) }}</strong>
                                            </td>
                                            <td class="text-center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        let parts = "{{$parts}}";
        console.log(parts);
        // for (let index = 0; index < parts.length; index++) {
        //     const element = parts[0]['part_order'];
        //     console.log(element);
        // }

        // $('#pills-1-tab').on('click', function(){
        //     alert('pills-1');
        // });

    });
</script>
@endpush