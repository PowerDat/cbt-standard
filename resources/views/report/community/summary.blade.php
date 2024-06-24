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

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน : @if (session()->has('community_name'))
                        {{session()->get('community_name')}} @endif</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-light" href="{{route('report.community.index')}}">
                                ประเมินตนเอง
                            </a>
                            <a class="btn btn-light" href="{{route('report.community.committee')}}">
                                กรรมการประเมิน
                            </a>
                            <a class="btn btn-primary active" href="{{route('report.community.summary')}}">
                                สรุปผลการประเมิน
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-end">
                    {{-- <a class="btn btn btn-primary" href="{{route('report.community.pdf')}}" target="_blank">พิมพ์</a> --}}
                    {{-- <button class="btn btn btn-primary" type="button" onclick="printDivSection('print_setion')">พิมพ์</button> --}}
                </div>
                <div class="card-body">

                    <div id="print_setion">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="text-center">
                                    <td colspan="6"><h5>เกณฑ์มาตรฐานการบริหารจัดการแหล่งท่องเที่ยวโดยชุมชน</h5></td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="6"><h5>องค์การบริหารการพัฒนาพื้นที่พิเศษเพื่อการท่องเที่ยวอย่างยั่งยืน (อพท.)</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>ชื่อชุมชน</strong> {{session()->get('community_name')}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>ตำบล</strong></td>
                                    <td colspan="2"><strong>อำเภอ</strong></td>
                                    <td colspan="2"><strong>จังหวัด</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>เขตพื้นที่องค์กรปกครองส่วนท้องถิ่น (อบต./เทศบาล)</strong></td>
                                    <td colspan="3"><strong>ในเขตพื้นที่พิเศษ</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>คณะผู้ตรวจประเมิน</strong></td>
                                </tr>
                                <tr>
                                    @if(count($user_evaluate) > 0)
                                        @foreach ($user_evaluate as $key => $item)
                                        <td>{{($key + 1).'. '.$item->full_name}}</td>
                                        @endforeach
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>เจ้าหน้าที่อพท.</strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>วันที่ตรวจประเมิน</strong> {{$date_thai}}</td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>ครั้งที่ได้รับการตรวจประเมิน</strong></td>
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

@push('scripts')
<script>
    function printDivSection(setion_id) {
     var Contents_Section = document.getElementById(setion_id).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = Contents_Section;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endpush