@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ตั้งค่าระบบ</li>
                    <li class="breadcrumb-item">จัดการผู้ใช้</li>
                    <li class="breadcrumb-item">รายละเอียดบุคคล</li>
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
                @if (isset($user_profile))
                    @method('put')
                @endif

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

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อจริง <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="user_profile_name" name="user_profile_name" type="text"
                                    value="{{$user_profile[0]->user_profile_name}}"> 
                                    <span class="text-danger error-text user_profile_name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">นามสกุล <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="user_profile_lastname" name="user_profile_lastname" type="text"
                                    value="{{$user_profile[0]->user_profile_lastname}}"> 
                                    <span class="text-danger error-text user_profile_lastname_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">เบอร์โทรศัพท์ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="user_profile_tel" name="user_profile_tel" type="text"
                                    value="{{$user_profile[0]->user_profile_tel}}"> 
                                    <span class="text-danger error-text user_profile_tel_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">หน่วยงาน/สถาบัน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="user_profile_organization" name="user_profile_organization" type="text"
                                    value="{{$user_profile[0]->user_profile_organization}}"> 
                                    <span class="text-danger error-text user_profile_organization_error"></span>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{$user->id}}">

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('user.edit', $user->id)}}">กลับหน้าจัดการผู้ใช้</a>
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
                url: "{{ route('user-profile.update', $user_profile[0]->user_profile_id) }}",
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

                        let id = response.id;
                        let url = "{{route('user.edit', ':id')}}";
                        url = url.replace(':id', id);
                        window.location = url;
                    }
                },
            });
        });
    });
</script>
@endpush