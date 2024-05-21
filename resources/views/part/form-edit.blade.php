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
                                    <label class="form-label">ลำดับเกณฑ์มาตรฐาน</label>
                                    <input class="form-control" id="part_order" name="part_order" type="text" 
                                        value="{{ $model->part_order}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อลำดับเกณฑ์มาตรฐาน</label>
                                    <input class="form-control" id="part_name" name="part_name" type="text" 
                                        value="{{$model->part_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียดลำดับเกณฑ์มาตรฐาน(เพิ่มเติม)</label>
                                    <textarea class="form-control" id="part_detail" name="part_detail"rows="3">{{$model->part_detail}}</textarea>
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

        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">
                    <h5>รายการเป้าประสงค์</h5>
                    <p class="card-text">
                        <strong>เกณฑ์มาตรฐาน</strong> {{$partTarget[0]->part->part_order.' '.$partTarget[0]->part->part_name}}
                    </p>
                    @if ($partTarget->count() > 0)
                        @foreach ($partTarget as $item)
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <strong>เป้าประสงค์</strong> {{$item->part_target_order.' '.$item->part_target_name}}
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="{{route('part-target.edit', $item->part_target_id)}}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="{{route('part-target.destroy', $item->part_target_id)}}" class="btn btn-light ">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
                    <div class="row">
                        <h5>รายการเป้าประสงค์</h5>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">เกณฑ์มาตรฐาน</th>
                                    <th scope="col">ชื่อลำดับเกณฑ์มาตรฐาน</th>
                                    <th scope="col">เป้าประสงค์</th>
                                    <th scope="col">ชื่อเป้าประสงค์</th>
                                    <th scope="col">แก้ไข</th>
                                    <th scope="col">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partTarget as $item)
                                <tr>
                                    <td class="text-center">{{$item->part->part_order}}</td>
                                    <td>{{$item->part->part_name}}</td>
                                    <td class="text-center">{{$item->part_target_order}}</td>
                                    <td>{{$item->part_target_name}}</td>
                                    <td class="text-center">
                                        <a href="{{route('part-target.edit', $item->part_target_id)}}" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('part-target.destroy', $item->part_target_id)}}" class="btn btn-light ">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
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