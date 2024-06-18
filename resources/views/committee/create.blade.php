@extends('layouts.master')

@push('css')
<link href="{{asset('css/select2.css')}}" rel="stylesheet" />   
@endpush

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">จัดการข้อมูลผู้ประเมิน</li>
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

                <div class="card">
                    
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อผู้ใช้ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text"> 
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">อีเมล <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="email" name="email" type="email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">บทบาท <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <select  class="form-control" name="role_id" id="role_id">
                                        @foreach ($roleCommittee as $item)
                                            <option value="{{$item->id}}" selected>{{$item->name.' - '.$item->detail}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <span class="text-danger error-text role_id_error"></span>
                                </div>
                            </div>
                        </div>

                        
                            <div class="row" >
                                <div class="col">
                                    <div class="mb-3" id="div_community">
                                        <label class="form-label">ชุมชนที่ประเมิน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                        <select  class="form-control select2" id="community" name="community[]" multiple>
                                            {{-- <option value="" selected disabled>เลือกชุมชน</option> --}}
                                            @for ($i=0; $i < count($response_community_by_api); $i++)
                                            <option value="{{$response_community_by_api[$i]['community_id']}}">
                                            {{$response_community_by_api[$i]['community_name']}}
                                            </option>
                                           @endfor
                                        </select>

                                        <span class="text-danger error-text community_error"></span>
                                    </div>
                                </div>
                            </div>
                        
                        

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รหัสผ่าน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="password" name="password" type="password">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ยืนยันรหัสผ่าน <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="confirm_password">
                                    <span class="text-danger error-text confirm_password_error"></span>
                                </div>
                            </div>
                        </div>

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
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $('.select2').select2();

        $('#form').submit(function(e) {
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: "{{ route('committee.store') }}",
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
                        let url = "{{route('committee.edit', ':id')}}";
                        url = url.replace(':id', id);
                        window.location = url;
                    }
                },
            });
        });
    });
</script>
@endpush