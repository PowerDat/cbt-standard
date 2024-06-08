@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ตั้งค่าระบบ</li>
                    <li class="breadcrumb-item">จัดการเมนูย่อย</li>
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
                                    <label class="form-label">เมนู <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <select class="form-control" disabled>
                                        @foreach ($menu as $item)
                                        <option value="{{$item->menu_id}}"
                                        @if ($menu_id == $item->menu_id)
                                            selected
                                        @endif    
                                        >{{$item->menu_order.' - '.$item->menu_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text menu_order_error"></span>
                                    <input type="hidden" name="menu_id" value="{{$menu_id}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับเมนูย่อย <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="sub_menu_order" name="sub_menu_order" type="text"> 
                                    <span class="text-danger error-text sub_menu_order_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อเมนูย่อย <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="sub_menu_name" name="sub_menu_name" type="text"> 
                                    <span class="text-danger error-text sub_menu_name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Route <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="sub_menu_route" name="sub_menu_route" type="text"> 
                                    <span class="text-danger error-text sub_menu_route_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">สถานะ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="sub_menu_status" value="Y" >
                                        <label class="form-check-label" >แสดง</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="sub_menu_status" value="N" >
                                        <label class="form-check-label" >ไม่แสดง</label>
                                    </div>
                                    <span class="text-danger error-text sub_menu_status_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('menu.edit', $menu_id)}}">ย้อยกลับหน้าเมนู</a>
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

            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: "{{ route('sub-menu.store') }}",
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
                        let url = "{{route('menu.edit', ':id')}}";
                        url = url.replace(':id', id);
                        window.location = url;
                    }
                },
            });
        });
    });
</script>
@endpush