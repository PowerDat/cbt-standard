@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ประเภทเกณฑ์มาตรฐาน</li>
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

                <div class="card">
                    
                    <div class="card-body">

                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ประเภทเกณฑ์มาตรฐาน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="part_type_name" name="part_type_name" type="text"
                                    value="{{$model->part_type_name}}"> 
                                    <span class="text-danger error-text part_type_name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียดประเภทเกณฑ์มาตรฐาน(เพิ่มเติม)</label>
                                    <textarea class="form-control" id="part_type_detail" name="part_type_detail"rows="3">{{ $model->part_type_detail}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('part.createByPartTypeId', $model->part_type_id)}}"
                                    class="btn btn-secondary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เกณฑ์มาตรฐาน
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" type="submit">บันทึก</button>
                                <a class="btn btn-light" href="{{route('part-type.index')}}">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if ($part->count() > 0)
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">
                    <h5>รายการเกณฑ์มาตรฐาน</h5>
                    <p class="card-text">
                        <strong>ประเภทเกณฑ์มาตรฐาน</strong> {{$model->part_type_name}}
                    </p>

                    @foreach ($part as $item)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-10">
                                    <strong>เกณฑ์มาตรฐาน</strong> {{$item->part_order.' '.$item->part_name}}
                                </div>
                                <div class="col-sm-1">
                                    <a href="{{route('part.edit', $item->part_id)}}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-sm-1">
                                    <a onclick="deleteById({{$item->part_id}})" class="btn btn-light btn-sm">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach
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
                url: "{{ route('part-type.update', $model->part_type_id) }}",
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
                            timer: 5000
                        });

                        window.location.reload();
                    }
                },
            });
        });
    });

    function deleteById(id)
    {
        // console.log('part_target_id: ', id);
        Swal.fire({
            title: "ต้องการลบข้อมูลหรือไม่?",
            showCancelButton: true,
            confirmButtonText: "ลบข้อมูล",
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('part.delete') }}",
                    data: {
                        part_id: id,
                    },
                    success: (result) => {
                        if(result.status == 0){
                            Swal.fire({
                                title: 'ไม่สำเร็จ',
                                text: result.msg,
                                icon: 'error',
                                width: '450px',
                                showConfirmButton: false,
                                timer: 5000
                            });
                        }
                        else{
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: result.msg,
                                icon: 'success',
                                width: '450px',
                                showConfirmButton: false,
                                timer: 5000
                            });

                            window.location.reload();
                        }
                    },
                });
            } 
        });
    }
</script>
@endpush