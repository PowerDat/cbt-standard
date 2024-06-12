@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">สรุปรายงาน</li>
                    <li class="breadcrumb-item active">ประเมนตนเอง</li>
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
                    <h5>สรุปรายงานการประเมินตามเกณฑ์มาตรฐาน</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary active" href="report.self">
                                ประเมนตนเอง
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
    </div>

    <div class="row">
        <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @foreach ($part as $item)
                            @if ($item->part_id == $part_id)
                            <a class="btn btn-light" href="{{route('report.part', $item->part_id)}}">
                                {{'ด้าน '.$item->part_order}}
                            </a> 
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($data))
        @include('report.part')
    @endif

</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function part(id)
    {
        let part_id = id;
        console.log(part_id);
    }

</script>
@endpush