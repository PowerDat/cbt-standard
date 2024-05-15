@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                        <li class="breadcrumb-item">ข้อมูลด้านเกณฑ์มาตรฐาน</li>
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
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $('.delete_form').on('submit', function() {
                if (confirm("ต้องการลบข้อมูลหรือไม่?")) {
                    return true;
                } else {
                    return false;
                }
            });

            setTimeout(function(){
                $("div.alert").remove();
            }, 5000 ); // 5 secs
        });
    </script>
@endpush
