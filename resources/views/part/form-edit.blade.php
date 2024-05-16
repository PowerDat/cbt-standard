@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลด้านเกณฑ์มาตรฐาน</li>
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
                            <div class="col-12 text-end">
                                <a href="{{route('part-target.createByPartId', $model->part_id)}}"
                                    class="btn btn-secondary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เป้าประสงค์
                                </a>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับด้านเกณฑ์มาตรฐาน</label>
                                    <input class="form-control" id="part_order" name="part_order" type="text" 
                                        value="{{ $model->part_order}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ข้อมูลด้านเกณฑ์มาตรฐาน</label>
                                    <input class="form-control" id="part_name" name="part_name" type="text" 
                                        value="{{$model->part_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียด(เพิ่มเติม)</label>
                                    <textarea class="form-control" id="part_detail" name="part_detail"rows="3">{{$model->part_detail}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('part.index')}}">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/form-validation-custom.js') }}"></script>
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
                success: (response) => {
                    if (response.success == 'success') {
                        window.location.reload();
                    }
                },
                error: function(response) {
                    $('#form').find(".print-error-msg").find("ul").html('');
                    $('#form').find(".print-error-msg").css('display', 'block');
                    $.each(response.responseJSON.errors, function(key, value) {
                        $('#form').find(".print-error-msg").find("ul").append(
                            '<li>' + '- ' + value + '</li>');
                    });
                }
            });
        });
    });
</script>
@endpush