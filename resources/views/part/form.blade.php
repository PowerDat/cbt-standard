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
                    <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
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

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                <div class="card">
                    
                    <div class="card-body">

                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับเกณฑ์มาตรฐาน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="part_order" name="part_order" type="text"> 
                                    <span class="text-danger error-text part_order_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อลำดับเกณฑ์มาตรฐาน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="part_name" name="part_name" type="text">
                                    <span class="text-danger error-text part_name_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียดลำดับเกณฑ์มาตรฐาน(เพิ่มเติม)</label>
                                    <textarea class="form-control" id="part_detail" name="part_detail"rows="3"></textarea>
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
                url: "{{ route('part.store') }}",
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

                        let id = response.part_id;
                        let url = "{{route('part.edit', ':id')}}";
                        url = url.replace(':id', id);
                        window.location = url;
                    }
                },
            });
        });
    });
</script>
@endpush