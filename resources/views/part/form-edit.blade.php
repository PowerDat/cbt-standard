@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลลำดับเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item active">แก้ไขข้อมูล</li>
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
            <form id="form" method="POST">
                @csrf
                @if (isset($model))
                @method('put')
                @endif

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับเกณฑ์มาตรฐาน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="part_order" name="part_order" type="text"
                                        value="{{ $model->part_order}}">
                                    <span class="text-danger error-text part_order_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อลำดับเกณฑ์มาตรฐาน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="part_name" name="part_name" type="text"
                                        value="{{$model->part_name}}">
                                    <span class="text-danger error-text part_name_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียดลำดับเกณฑ์มาตรฐาน(เพิ่มเติม)</label>
                                    <textarea class="form-control" id="part_detail" name="part_detail"
                                        rows="3">{{$model->part_detail}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('part-target.createByPartId', $model->part_id)}}"
                                    class="btn btn-secondary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เป้าประสงค์
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" type="submit">บันทึก</button>
                                <a class="btn btn-light" href="{{route('part.index')}}">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if ($partTarget->count() > 0)
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">
                    <h5>รายการเป้าประสงค์</h5>
                    <p class="card-text">
                        <strong>เกณฑ์มาตรฐาน</strong> {{$partTarget[0]->part->part_order.'
                        '.$partTarget[0]->part->part_name}}
                    </p>

                    @foreach ($partTarget as $item)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-10">
                                    <strong>เป้าประสงค์</strong> {{$item->part_target_order.'
                                    '.$item->part_target_name}}
                                </div>
                                <div class="col-sm-1">
                                    <a href="{{route('part-target.edit', $item->part_target_id)}}"
                                        class="btn btn-primary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-sm-1">
                                    <a href="{{route('part-target.destroy', $item->part_target_id)}}"
                                        class="btn btn-light ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach

                </div>
            </div>

        </div>
        @endif


    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $('#form').submit(function(e) {
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: "{{ route('part.update', $model->part_id) }}",
                data: formData,
                contentType: false,
                processData: false,
                dataType:'json',
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: (response) => {
                    if(response.status == 0){
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                    else{
                        Swal.fire({
                            title: 'สำเร็จ',
                            text: response.msg,
                            icon: 'success',
                            width: '450px',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        window.location.reload();
                    }
                },
            });
        });
    });
</script>
@endpush