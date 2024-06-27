@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ตั้งค่าระบบ</li>
                    <li class="breadcrumb-item">จัดการเมนู</li>
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
                
                <div class="card">
                    
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับเมนู <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="menu_order" name="menu_order" type="text" value="{{$model->menu_order}}"> 
                                    <span class="text-danger error-text menu_order_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อเมนู <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="menu_name" name="menu_name" type="text" value="{{$model->menu_name}}"> 
                                    <span class="text-danger error-text menu_name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Route <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="menu_route" name="menu_route" type="text" value="{{$model->menu_route}}"> 
                                    <span class="text-danger error-text menu_route_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">สถานะ <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="menu_status" value="Y" 
                                        @if ($model->menu_status == 'Y')
                                            checked
                                        @endif
                                        >
                                        <label class="form-check-label" >แสดง</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="menu_status" value="N" 
                                        @if ($model->menu_status == 'N')
                                            checked
                                        @endif
                                        >
                                        <label class="form-check-label" >ไม่แสดง</label>
                                    </div>
                                    <span class="text-danger error-text menu_status_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('sub-menu.createByMenuId', $model->menu_id)}}"
                                    class="btn btn-secondary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> เมนูย่อย
                                </a>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary" type="submit">บันทึก</button>
                                <a class="btn btn-light" href="{{route('menu.index')}}">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5>รายการเมนูย่อย</h5>

                    @foreach ($sub_menu as $item)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-10">
                                    <strong>เมนูย่อย</strong> {{$item->sub_menu_order.' '.$item->sub_menu_name}}
                                </div>
                                <div class="col-sm-1">
                                    <a href="{{route('sub-menu.edit', $item->sub_menu_id)}}"
                                        class="btn btn-primary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="col-sm-1">
                                    <a onclick="deleteById({{$item->sub_menu_id}})" class="btn btn-light">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
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
                url: "{{ route('menu.update', $model->menu_id) }}",
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

                        window.location.reload();
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
                    url: "{{ route('sub-menu.delete') }}",
                    data: {
                        sub_menu_id: id,
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