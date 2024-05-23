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
                                        <label class="form-label">ข้อมูลด้านเกณฑ์มาตรฐาน <span class="text-danger" style="font-size: 20px;">*</span></label>
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
                                        <label class="form-label">ลำดับเป้าประสงค์ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                        <input class="form-control" id="part_target_order" name="part_target_order"
                                            type="text">
                                        <span class="text-danger error-text part_target_order_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลเป้าประสงค์ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                        <input class="form-control" id="part_target_name" name="part_target_name"
                                            type="text">
                                        <span class="text-danger error-text part_target_name_error"></span>
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

    </div>
</div>
<!-- Container-fluid Ends-->
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
                    url: "{{ route('part-target.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
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

                            let id = response.part_target_id;
                            let url = "{{ route('part-target.edit', ':id') }}";
                            url = url.replace(':id', id);
                            window.location = url;
                        }
                    }
                });
            });
        });
</script>
@endpush