@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">จัดการข้อมูลผู้ประเมิน</li>
                    <li class="breadcrumb-item active">เปลี่ยนรหัสผ่าน</li>
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

                <div class="card">
                    
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อผู้ใช้</label>
                                    <input class="form-control" value="{{$user->name}}" type="text" readonly> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">อีเมล</label>
                                    <input class="form-control" value="{{$user->email}}" type="text" readonly> 
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รหัสผ่านเดิม <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="current_password" name="current_password" type="password"> 
                                    <span class="text-danger error-text current_password_error"></span>
                                </div>
                            </div>
                        </div> --}}

                        <div >
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่านใหม่ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                        <input class="form-control" id="new_password" name="new_password" type="password">
                                        <span class="text-danger error-text new_password_error"></span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">เปลี่ยนรหัสผ่าน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                        <input class="form-control" id="new_confirm_password" name="new_confirm_password" type="password">
                                        <span class="text-danger error-text new_confirm_password_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('committee.index')}}">ยกเลิก</a>
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
                url: "{{ route('committee.save-change-password') }}",
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

                        let url = "{{route('committee.index')}}";
                        window.location = url;
                    }
                },
            });
        });
    });
</script>
@endpush