@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ตั้งค่าระบบ</li>
                    <li class="breadcrumb-item">จัดการบทบาท</li>
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
                @if (isset($role))
                    @method('put')
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อบทบาท <span class="text-danger" style="font-size: 20px;">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{$role->name}}"> 
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียด(เพิ่มเติม)</label>
                                    <input class="form-control" id="detail" name="detail" type="text" value="{{$role->detail}}"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('role.index')}}">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-12">
            <form id="form-assignPermission" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="row mt-3">
                            <div class="col">
                                <h5>กำหนดสิทธิ์</h5>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                      <tr>
                                        <th>เมนู</th>
                                        <th>View</th>
                                        <th>Create</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $item)
                                            @if (count($item->submenus) > 0)
                                                @foreach ($item->submenus as $submenu)
                                                <tr>
                                                    <td><p>{{$item->menu_name.' - '.$submenu->sub_menu_name}}</p></td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'view'.'-'.$submenu->sub_menu_route}}"
                                                        @checked($role->hasPermission('view-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'create'.'-'.$submenu->sub_menu_route}}"
                                                        @checked($role->hasPermission('create-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'update'.'-'.$submenu->sub_menu_route}}"
                                                        @checked($role->hasPermission('update-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'delete'.'-'.$submenu->sub_menu_route}}"
                                                        @checked($role->hasPermission('delete-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'view-'.str_replace('.index', '', $submenu->sub_menu_route)}}"
                                                        @checked($role->hasPermission('view-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'create-'.str_replace('.index', '', $submenu->sub_menu_route)}}"
                                                        @checked($role->hasPermission('create-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'update-'.str_replace('.index', '', $submenu->sub_menu_route)}}"
                                                        @checked($role->hasPermission('update-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td>
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'delete-'.str_replace('.index', '', $submenu->sub_menu_route)}}"
                                                        @checked($role->hasPermission('delete-'.str_replace('.index', '', $submenu->sub_menu_route)))>
                                                    </td> --}}
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td><p>{{$item->menu_name}}</p></td>
                                                {{-- <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'view-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('view-'.$item->menu_route))>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'create-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('create-'.$item->menu_route))>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'update-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('update-'.$item->menu_route))>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'delete-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('delete-'.$item->menu_route))>
                                                </td> --}}
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'view-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('view-'.str_replace('.index', '', $item->menu_route)))>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'create-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('create-'.str_replace('.index', '', $item->menu_route)))>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'update-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('update-'.str_replace('.index', '', $item->menu_route)))>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox"  name="permission_name[]" value="{{'delete-'.$item->menu_route}}"
                                                    @checked($role->hasPermission('delete-'.str_replace('.index', '', $item->menu_route)))>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Assign Permissions</button>
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
                url: "{{ route('role.update', $role->id) }}",
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
                            timer: 3000
                        });

                        let url = "{{route('role.index')}}";
                        window.location = url;
                    }
                },
            });
        });

        $('#form-assignPermission').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: "{{ route('role.assign-permission', $role->id) }}",
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
                            timer: 3000
                        });

                        window.location.reload();
                    }
                },
            });
        });
    });
</script>
@endpush