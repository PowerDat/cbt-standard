@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลเป้าประสงค์</li>
                    <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
                </ol>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<!-- content -->
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form id="form" method="post">
                @csrf

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                <div class="card">
                    <div class="card-body">

                        {{-- ข้อมูลเป้าประสงค์ --}}
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลด้านเกณฑ์มาตรฐาน</label>
                                        <select 
                                            name="part_id" 
                                            id="part_id" 
                                            class="form-control" 
                                        >
                                            <option value="" selected disabled>เลือกข้อมูล</option>
                                            @foreach ($part as $item)
                                            <option value="{{$item->part_id}}">
                                                {{'ด้าน '.$item->part_order.' : '.$item->part_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ลำดับเป้าประสงค์(เฉพาะตัวเลข)</label>
                                        <input class="form-control" id="part_target_order" name="part_target_order"
                                            type="text"
                                            value="{{isset($partTarget) ? $partTarget->part_target_order : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                        <input class="form-control" id="part_target_name" name="part_target_name"
                                            type="text"
                                            value="{{isset($partTarget) ? $partTarget->part_target_name : ''}}">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('part-target.index')}}">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('#form').submit(function(e){
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: "{{route('part-target.store')}}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response.success == 'success')
                    {
                        window.location = "{{ route('part-target.index') }}";
                    }
                },
                error: function(response){
                    $('#form').find(".print-error-msg").find("ul").html('');
                    $('#form').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#form').find(".print-error-msg").find("ul").append('<li>'+ '- ' + value +'</li>');
                    });
                }
            });
        });
    });

</script>
@endpush