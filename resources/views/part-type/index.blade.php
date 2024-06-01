@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ประเภทเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item active">หน้าแรก</li>
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
            <div class="card">

                <div class="card-header text-end">
                    <div class="col-sm-9 offset-sm-3">
                        <a href="{{route('part-type.create')}}" class="btn btn-primary">เพิ่มข้อมูล</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th>ประเภทเกณฑ์มาตรฐาน</th>
                                    <th>จำนวนเกณฑ์มาตรฐาน</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $item)
                                <tr>
                                    <td class="text-center">{{$item->part_type_name}}</td>
                                    <td class="text-center">{{$item->part->count()}}</td>
                                    <td class="text-center">
                                        <a href="{{route('part-type.edit', $item->part_type_id)}}" class="btn btn-primary ">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a onclick="deleteById({{$item->part_type_id}})" class="btn btn-light">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination Links --}}
                    <div class="m-t-30">
                        {{-- {{$model->links()}} --}}
                    </div>
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
                    url: "{{ route('part-type.delete') }}",
                    data: {
                        part_type_id: id,
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