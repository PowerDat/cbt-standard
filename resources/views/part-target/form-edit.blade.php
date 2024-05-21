@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลเป้าประสงค์</li>
                    <li class="breadcrumb-item active">แก้ไขข้อมูล</li>
                </ol>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<!-- content -->
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12">
            
            <form id="form" method="post">
                @csrf
                @method('PUT')

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                <div class="card">
                    <div class="card-body">

                        {{-- ข้อมูลเป้าประสงค์ --}}
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลด้าน</label>
                                        <select 
                                            name="part_id" 
                                            id="part_id" 
                                            class="form-control" 
                                            disabled
                                        >
                                            <option value="" selected disabled>เลือกข้อมูล</option>
                                            @foreach ($part as $item)
                                            <option value="{{$item->part_id}}" 
                                                @if($partTarget->part_id == $item->part_id)
                                                    selected
                                                @endif
                                                >{{'ด้าน '.$item->part_order.' : '.$item->part_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ลำดับเป้าประสงค์</label>
                                        <input class="form-control" id="part_target_order" name="part_target_order"
                                            type="text"
                                            value="{{isset($partTarget) ? $partTarget->part_target_order : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                        <input class="form-control" id="part_target_name" name="part_target_name"
                                            type="text"
                                            value="{{isset($partTarget) ? $partTarget->part_target_name : ''}}">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('part-detail.createByTargetId', $partTarget->part_target_id)}}"
                                    class="btn btn-secondary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> คำถามการประเมินและเกณฑ์การให้คะแนน
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" type="submit">บันทึก</button>
                                <a class="btn btn-light" href="{{route('part.edit', $partTarget->part_id)}}">กลับหน้าเกณฑ์มาตรฐาน</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>รายการเกณฑ์พิจารณา</h5>
                    <p class="card-text">
                        <strong>เกณฑ์มาตรฐาน</strong> {{$partTargetByPartId[0]->part_order.' '.$partTargetByPartId[0]->part_name}}
                    </p>
                    <p class="card-text">
                        <strong>เป้าประสงค์</strong> {{$partTargetByPartId[0]->part_target_order.' '.$partTargetByPartId[0]->part_target_name}}
                    </p>
                    @if ($partTargetByPartId->count() > 0)
                        @foreach ($partTargetByPartId as $item)
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <strong>เกณฑ์พิจารณา</strong> {{$item->part_target_sub_order.' '.$item->part_target_sub_name}}
                                    </div>
                                    <div class="col-sm-2 text-end">
                                        @if (isset($item->part_target_sub_id))
                                        <a href="{{route('part-detail.edit', $item->part_target_sub_id)}}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    @endif
                </div>
            </div>
            
            {{-- <div class="card">
                <div class="card-body">
                    
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>ลำดับเกณฑ์มาตรฐาน</th>
                                    <th>ชื่อลำดับเกณฑ์มาตรฐาน</th>
                                    <th>ลำดับเป้าประสงค์</th>
                                    <th>ชื่อลำดับเป้าประสงค์</th>
                                    <th>ลำดับเกณฑ์พิจารณา</th>
                                    <th>ชื่อลำดับเกณฑ์พิจารณา</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($partTargetByPartId->count() > 0)
                                @foreach ($partTargetByPartId as $item)
                                <tr>
                                    <td class="text-center">{{$item->part_order}}</td>
                                    <td>{{$item->part_name}}</td>
                                    <td class="text-center">{{$item->part_target_order}}</td>
                                    <td>{{$item->part_target_name}}</td>
                                    <td class="text-center">{{$item->part_target_sub_order}}</td>
                                    <td>{{$item->part_target_sub_name}}</td>
                                    <td class="text-center">
                                        @if (isset($item->part_target_sub_id))
                                        <a href="{{route('part-detail.edit', $item->part_target_id)}}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach 
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="m-t-30 text-end">
                        {{$partTargetByPartId->links()}}
                    </div>
                </div>
            </div> --}}

        </div>

    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('#form').submit(function(e){
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: "{{route('part-target.update', $partTarget->part_target_id)}}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response.success == 'success')
                    {
                        window.location.reload();
                    }
                },
                error: function(response){
                    $('#form').find(".print-error-msg").find("ul").html('');
                    $('#form').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#form').find(".print-error-msg").find("ul").append('<li>'+ '- ' + value +'</li>');
                    });
                }
            });
        });
    });
</script>
@endpush