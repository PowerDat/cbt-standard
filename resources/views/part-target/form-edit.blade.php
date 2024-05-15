@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลรายละเอียด</li>
                    <li class="breadcrumb-item active">แก้ไขข้อมูล</li>
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
            <form id="form" class="f1" method="post">
                @csrf

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <input type="hidden" name="part_target_id" value="{{ isset( $partTarget) ? $partTarget->part_target_id : ''}}">
                <div class="card">

                    <div class="card-body">

                        <div class="f1-steps">
                            <div class="f1-progress">
                                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                            </div>
                            <div class="f1-step active">
                                <div class="f1-step-icon">1</div>
                                <p>ข้อมูลเป้าประสงค์</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">2</div>
                                <p>ข้อมูลเกณฑ์การพิจารณา</p>
                            </div>
                            <div class="f1-step">
                                <div class="f1-step-icon">3</div>
                                <p>ข้อมูลเกณฑ์การให้คะแนน</p>
                            </div>
                        </div>

                        {{-- ข้อมูลเป้าประสงค์ --}}
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลด้าน</label>
                                        <select 
                                            name="part_id" 
                                            id="part_id"
                                            class="form-control" 
                                        >
                                            <option value="" selected disabled>เลือกข้อมูล</option>
                                            @foreach ($part as $item)
                                            <option value="{{$item->part_id}}" 
                                            @if(isset($partTarget))
                                                @if($partTarget->part_id == $item->part_id)
                                                selected
                                                @endif
                                            @endif
                                            >{{$item->part_order.' - '.$item->part_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="part_id" id="part_id" value="{{$partTarget->part_id}}"> --}}
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ลำดับเป้าประสงค์(เฉพาะตัวเลขเท่านั้น)</label>
                                        <input 
                                            class="form-control"
                                            id="part_target_order" 
                                            name="part_target_order" 
                                            type="text" 
                                            required
                                            value="{{isset($partTarget) ? $partTarget->part_target_order : ''}}"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                        <input 
                                            class="form-control"
                                            id="part_target_name" 
                                            name="part_target_name" 
                                            type="text" 
                                            required
                                            value="{{isset($partTarget) ? $partTarget->part_target_name : ''}}"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="f1-buttons">
                                <button class="btn btn-primary btn-next" type="button">ต่อไป</button>
                            </div>
                        </fieldset>

                        {{-- ข้อมูลเกณฑ์การพิจารณา --}}
                        <fieldset>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 95%">รายละเอียด</th>
                                        <th style="width: 5%">
                                            <button type="button" name="add_part_target_sub" id="add_part_target_sub" class="btn btn-success">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_part_target_sub">
                                    @foreach ($partTargetSub as $targetSub)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">ลำดับเกณฑ์พิจารณา(เฉพาะตัวเลขเท่านั้น)</label>
                                                        <input 
                                                            class="form-control" 
                                                            id="part_target_sub_order" 
                                                            name="part_target_sub_order[]" 
                                                            type="text" 
                                                            required
                                                            value="{{$targetSub->part_target_sub_order}}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">ข้อมูลเกณฑ์พิจารณา</label>
                                                        <input 
                                                            class="form-control" 
                                                            id="part_target_sub_name" 
                                                            name="part_target_sub_name[]" 
                                                            type="text" 
                                                            required
                                                            value="{{$targetSub->part_target_sub_name}}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">คำอธิบาย</label>
                                                        <textarea class="form-control" rows="5" id="part_target_sub_desc" name="part_target_sub_desc[]" required>{{$targetSub->part_target_sub_desc}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" name="remove_part_target_sub" id="" class="btn btn-danger remove_part_target_sub">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="f1-buttons mt-3">
                                <button class="btn btn-outline-primary btn-previous" type="button">ก่อนหน้า</button>
                                <button class="btn btn-primary btn-next" type="button">ต่อไป</button>
                            </div>
                        </fieldset>

                        {{-- ข้อมูลเกณฑ์การให้คะแนน --}}
                        <fieldset>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <div table-responsive>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            คำถามในการประเมิน
                                                        </th>
                                                        <th style="width: 50px;">
                                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm addRow">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_question">
                                                    @foreach ($partIndexQuestion as $item)
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="text" name="name_question[]" required
                                                            value="{{$item->part_index_question_desc}}">
                                                        </td>
                                                        <td style="width: 50px;">
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow">
                                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <p><strong>เกณฑ์การให้คะแนน</strong></p>
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 4 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[4][name_score]" required
                                            value="{{$partIndexScore[4]->part_index_score_desc}}">
                                        </div>
                                    </div>    
                                </div>            
                            </div>
    
                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 3 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[3][name_score]" required
                                            value="{{$partIndexScore[3]->part_index_score_desc}}">
                                        </div>
                                    </div>    
                                </div>            
                            </div>
    
                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 2 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[2][name_score]" required
                                            value="{{$partIndexScore[2]->part_index_score_desc}}">
                                        </div>
                                    </div>    
                                </div>            
                            </div>
    
                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 1 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[1][name_score]" required
                                            value="{{$partIndexScore[1]->part_index_score_desc}}">
                                        </div>
                                    </div>    
                                </div>            
                            </div>
    
                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 0 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[0][name_score]" required
                                            value="{{$partIndexScore[0]->part_index_score_desc}}">
                                        </div>
                                    </div>    
                                </div>            
                            </div>

                            {{-- <input type="hidden" name="part_target_id" value="{{$partTarget->part_target_id}}"> --}}

                            <div class="f1-buttons mt-3">
                                <button class="btn btn-outline-primary btn-previous" type="button">ก่อนหน้า</button>
                                <button class="btn btn-primary" type="submit">บันทึก</button>
                                <a class="btn btn-light" href="{{route('part-target.index')}}">ยกเลิก</a>
                            </div>
                        </fieldset>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@push('scripts')
<script src="{{ asset('js/form-wizard/form-wizard-three.js') }}"></script>
<script src="{{ asset('js/form-wizard/jquery.backstretch.min.js') }}"></script>
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
                url: "{{route('part-target.updated', $partTarget->part_target_id)}}",
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

        // ข้อมูลเกณฑ์การให้คะแนน 
        $('thead').on('click', '.addRow', function(){
            var tr = `
                <tr>
                    <td><input class="form-control" type="text" name="name_question[]" required></td>
                    <td><a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                </tr>
            `;

            $('#tbody_question').append(tr);

        });

        $('#tbody_question').on('click', '.deleteRow', function(){
            $(this).parent().parent().remove();
        });

        // ข้อมูลเกณฑ์การพิจารณา
        var count = "{{$countTargetSub}}";

        $(document).on('click', '#add_part_target_sub', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove_part_target_sub', function(){
            count--;
            $(this).closest("tr").remove();
        });

    });

    function dynamic_field(number)
    {
        html = `
        <tr>
            <td>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">ลำดับเกณฑ์พิจารณา(เฉพาะตัวเลขเท่านั้น)</label>
                            <input 
                                class="form-control" 
                                id="part_target_sub_order" 
                                name="part_target_sub_order[]" 
                                type="text" 
                                required
                            >
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">ข้อมูลเกณฑ์พิจารณา</label>
                            <input 
                                class="form-control" 
                                id="part_target_sub_name" 
                                name="part_target_sub_name[]" 
                                type="text" 
                                required
                            >
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">คำอธิบาย</label>
                            <textarea class="form-control" rows="5" id="part_target_sub_desc" name="part_target_sub_desc[]" required></textarea>
                        </div>
                    </div>
                </div>
            </td>
        `;
        
        if(number > 1)
        {
            html += `   
                <td>
                    <button type="button" name="remove_part_target_sub" id="" class="btn btn-danger remove_part_target_sub">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>`;
            $('#tbody_part_target_sub').append(html);
        }
    }

</script>
@endpush