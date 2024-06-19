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
                    <li class="breadcrumb-item">ตั้งค่าระบบ</li>
                    <li class="breadcrumb-item">จัดการผู้ใช้</li>
                    <li class="breadcrumb-item active">แก่ไขข้อมูล</li>
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
                @if (isset($user))
                    @method('put')
                @endif

                <div class="card">
                    
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อผู้ใช้ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{$user->name}}"> 
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">อีเมล <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="email" name="email" type="email" value="{{$user->email}}">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">บทบาท <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <select  class="form-control" name="role_id" id="role_id">
                                        <option value="" selected disabled>เลือกบทบาท</option>
                                        @foreach ($roles as $item)
                                            <option value="{{$item->id}}"
                                                @if ($user_role_id == $item->id)
                                                    selected
                                                @endif
                                            >{{$item->name.' - '.$item->detail}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text role_id_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชุมชนที่ประเมิน</label>
                                    <select  class="form-control select2" id="community" name="community[]" multiple>
                                        {{-- <option value="" selected disabled>เลือกชุมชน</option> --}}
                                        @for ($i=0; $i < count($response_community_by_api); $i++)
                                        <option value="{{$response_community_by_api[$i]['community_id']}}"
                                        {{ in_array($response_community_by_api[$i]['community_id'], $array_community) ? 'selected' : '' }}
                                        >
                                        {{$response_community_by_api[$i]['community_name']}}
                                        </option>
                                       @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                @if($user->userProfile != "")

                                @else
                                <a href="{{route('user-profile.createById', $user->id)}}"
                                    class="btn btn-secondary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> รายละเอียดบุคคล
                                </a>
                                @endif
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" type="submit">บันทึก</button>
                                <a class="btn btn-light" href="{{route('user.index')}}">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if($user->userProfile != "")
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-light text-center">
                            <tr>
                                <th>ชื่อจริง</th>
                                <th>นามสกุล</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>หน่วยงาน/สถาบัน</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$user->userProfile->user_profile_name}}</td>
                                <td>{{$user->userProfile->user_profile_lastname}}</td>
                                <td>{{$user->userProfile->user_profile_tel}}</td>
                                <td>{{$user->userProfile->user_profile_organization}}</td>
                                <td class="text-center">
                                    <a href="{{route('user-profile.edit', $user->id)}}" class="btn btn-primary ">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a onclick="deleteById({{$user->userProfile->user_profile_id}})" class="btn btn-light">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        @endif
        
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
                url: "{{ route('user.update', $user->id) }}",
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

                        let url = "{{route('user.index')}}";
                        window.location = url;
                    }
                },
            });
        });
    });

    function deleteById(id)
    {
        Swal.fire({
            title: "ต้องการลบข้อมูลหรือไม่?",
            showCancelButton: true,
            confirmButtonText: "ลบข้อมูล",
            cancelButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('user-profile.delete') }}",
                    data: {
                        user_profile_id: id,
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
                                timer: 3000
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