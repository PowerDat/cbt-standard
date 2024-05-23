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
                    <li class="breadcrumb-item active">หน้าแรก</li>
                </ol>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<!-- content -->
@livewire('part.index')

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
                    url: "{{ route('part.delete') }}",
                    data: {
                        part_id: id,
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