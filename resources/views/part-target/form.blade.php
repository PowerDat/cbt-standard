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
                    <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
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

        <div class="col-sm-12 mt-3">
            <form id="form" method="post">
                @csrf

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
                                        <label class="form-label">ข้อมูลด้านเกณฑ์มาตรฐาน</label>
                                        <select disabled class="form-control">
                                            <option value="" selected disabled>เลือกข้อมูล</option>
                                            @foreach ($part as $item)
                                            <option value="{{ $item->part_id }}" 
                                                @if ($item->part_id == $part_id)
                                                    selected 
                                                @endif>
                                                {{ 'ด้าน ' . $item->part_order . ' : ' . $item->part_name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <input type="hidden" name="part_id" value="{{$part_id}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ลำดับเป้าประสงค์</label>
                                        <input class="form-control" id="part_target_order" name="part_target_order"
                                            type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                        <input class="form-control" id="part_target_name" name="part_target_name"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{ route('part.edit', $part_id) }}">กลับหน้าเกณฑ์มาตรฐาน</a>
                    </div>
                </div>
            </form>
        </div>

        {{-- <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6"><h5>รายละเอียดเกณฑ์พิจารณา</h5></div>
                        <div class="col-sm-6 text-end"></div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered ">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th>ลำดับเกณฑ์มาตรฐาน</th>
                                    <th>ลำดับเป้าประสงค์</th>
                                    <th>ลำดับเกณฑ์พิจารณา</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partTargetByPartId as $item)
                                <tr>
                                    <td class="text-center">{{$item->part_order}}</td>
                                    <td class="text-center">{{$item->part_target_order}}</td>
                                    <td class="text-center">{{$item->part_target_sub_order}}</td>
                                    <td class="text-center">
                                        <a href="{{route('part-detail.edit', $item->part_target_sub_id)}}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{route('part-target.destroy', $item->part_target_id)}}"
                                            method="post" class="delete_form">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-light btn-sm">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-t-30 text-end">
                        {{ $partTargetByPartId->links() }}
                    </div>
                </div>
            </div>
        </div> --}}
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

        $(document).ready(function() {
            $('#form').submit(function(e) {
                e.preventDefault();

                var url = $(this).attr("action");
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: "{{ route('part-target.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response.success == 'success') {
                            let id = response.part_target_id;
                            let url = "{{ route('part-target.edit', ':id') }}";
                            url = url.replace(':id', id);
                            window.location = url;
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