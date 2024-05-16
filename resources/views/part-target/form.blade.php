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
                                            <select name="part_id" id="part_id" class="form-control">
                                                <option value="" selected disabled>เลือกข้อมูล</option>
                                                @foreach ($part as $item)
                                                    <option value="{{ $item->part_id }}"
                                                        @if ($item->part_id == $part_id) selected @endif>
                                                        {{ 'ด้าน ' . $item->part_order . ' : ' . $item->part_name }}
                                                    </option>
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
                            <a class="btn btn-light" href="{{ route('part.edit', $part_id) }}">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-12">
                <div class="default-according" id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa fa-angle-down"></i> เกณฑ์มาตรฐาน
                                </button>
                            </h5>
                        </div>
                        <div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordion">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">เกณฑ์มาตรฐาน</th>
                                                <th scope="col">เป้าประสงค์</th>
                                                <th scope="col">รายละเอียด</th>
                                                <th scope="col">แก้ไข</th>
                                                <th scope="col">ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($partTargetByPartId as $item)
                                                <tr>
                                                    <td>{{ $item->part->part_order }}</td>
                                                    <td>{{ $item->part_target_order }}</td>
                                                    <td>
                                                        <a href="{{ route('part-detail.createByTargetId', $item->part_target_id) }}"
                                                            class="btn btn-secondary">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('part-target.edit', $item->part_target_id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('part-target.destroy', $item->part_target_id) }}"
                                                            class="btn btn-light ">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
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
                    </div>
                </div>
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
