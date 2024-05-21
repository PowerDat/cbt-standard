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
                    @method('PUT')

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="card">

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{route('part-target.edit', $partTarget[0]->part_target_id)}}" class="btn btn-secondary">
                                    กลับหน้าเป้าประสงค์
                                </a>
                                </div>
                            </div>

                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="2"></div>
                                </div>
                                <div class="f1-step active">
                                    <div class="f1-step-icon">1</div>
                                    <p>ข้อมูลเกณฑ์การพิจารณา</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon">2</div>
                                    <p>ข้อมูลเกณฑ์การให้คะแนน</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <h6>{{'ด้าน '.$part[0]->part_order.' : '.$part[0]->part_name}}</h6>
                                        <h6>{{'เป้าประสงค์ '.$partTarget[0]->part_target_order.' : '.$partTarget[0]->part_target_name}}</h6>
                                    </div>
                                    <input type="hidden" name="part_target_id" value="{{$partTarget[0]->part_target_id}}">
                                </div>
                            </div>

                            {{-- ข้อมูลเกณฑ์การพิจารณา --}}
                            <fieldset>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">ลำดับเกณฑ์พิจารณา</label>
                                            <input class="form-control" id="part_target_sub_order"
                                                name="part_target_sub_order" type="text" required
                                                value="{{$partTargetSub->part_target_sub_order}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">ข้อมูลเกณฑ์พิจารณา</label>
                                            <textarea class="form-control" rows="5" id="part_target_sub_name" name="part_target_sub_name" required>{{$partTargetSub->part_target_sub_name}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">คำอธิบาย</label>
                                            <textarea class="form-control" rows="5" id="part_target_sub_desc" name="part_target_sub_desc" required>{{$partTargetSub->part_target_sub_desc}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="f1-buttons mt-3">
                                    <button class="btn btn-outline-primary btn-previous" type="button">ก่อนหน้า</button>
                                    <button class="btn btn-primary btn-next" type="button">ต่อไป</button>
                                    <a class="btn btn-info" id="btn-save">
                                        บันทึก
                                    </a>
                                </div>
                            </fieldset>

                            {{-- ข้อมูลเกณฑ์การให้คะแนน --}}
                            <fieldset>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <h6>{{'ลำดับเกณฑ์พิจารณา : '.$partTargetSub->part_target_sub_order}}</h6>
                                            <h6>{{'ข้อมูลเกณฑ์พิจารณา : '.$partTargetSub->part_target_sub_name}}</h6>
                                        </div>
                                        <input type="hidden" name="part_target_id" value="{{$partTarget[0]->part_target_id}}">
                                    </div>
                                </div>

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
                                                                <a href="javascript:void(0)"
                                                                    class="btn btn-primary btn-sm addRow">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_question">
                                                        @foreach ($question as $item)
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
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 4 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"
                                                    name="inputs_score[4][name_score]" required value="{{ ($score->count() > 0) ? $score[4]->part_index_score_desc : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 3 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"
                                                    name="inputs_score[3][name_score]" required value="{{($score->count() > 0) ? $score[3]->part_index_score_desc : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 2 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"
                                                    name="inputs_score[2][name_score]" required value="{{($score->count() > 0) ? $score[2]->part_index_score_desc : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 1 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"
                                                    name="inputs_score[1][name_score]" required value="{{($score->count() > 0) ? $score[1]->part_index_score_desc : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 0 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text"
                                                    name="inputs_score[0][name_score]" required value="{{($score->count() > 0) ? $score[0]->part_index_score_desc : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="f1-buttons mt-3">
                                    <button class="btn btn-outline-primary btn-previous" type="button">ก่อนหน้า</button>
                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                    <a href="{{route('part-target.edit', $partTarget[0]->part_target_id)}}" class="btn btn-secondary">
                                        กลับหน้าเป้าประสงค์
                                    </a>
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

        $(document).ready(function() {

            $('#form').submit(function(e) {
                e.preventDefault();

                var url = $(this).attr("action");
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: "{{ route('part-detail.update', $partTargetSub->part_target_sub_id) }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        alert('แก้ไขข้อมูลสำเร็จ');

                        let id = "{{$partTarget[0]->part_target_id}}";
                        let url = "{{ route('part-target.edit', ':id') }}";
                        url = url.replace(':id', id);
                        window.location = url;
                    },
                    error: function(response) {
                        $('#form').find(".print-error-msg").find("ul").html('');
                        $('#form').find(".print-error-msg").css('display', 'block');
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('#form').find(".print-error-msg").find("ul").append(
                                '<li>' + '- ' + value + '</li>');
                        });
                    }
                });
            });

            //เลือกข้อมูลด้านเพื่อมีคำตอบข้อมูลเป้าประสงค์
            $('#part_id').change(function(){
                $.ajax({
                    url: "{{route('part-detail.fetchPartTargetById')}}",
                    type: "POST",
                    data: {
                        part_id: $('#part_id').val(),
                    },
                    success: function (response) {
                        $('#part_target_id').html(response);
                    }
                });
            });

            // ข้อมูลเกณฑ์การให้คะแนน 
            $('thead').on('click', '.addRow', function() {
                var tr = `
                <tr>
                    <td><input class="form-control" type="text" name="name_question[]" required></td>
                    <td><a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                </tr>
            `;

                $('#tbody_question').append(tr);

            });

            $('#tbody_question').on('click', '.deleteRow', function() {
                $(this).parent().parent().remove();
            });

            //บันทึกข้อมูลเกณฑ์การพิจารณา
            $('#btn-save').click(function(){
                let sub_order = $('#part_target_sub_order').val();
                let sub_name = $('#part_target_sub_name').val();
                let sub_desc = $('#part_target_sub_desc').val();
                let sub_id = "{{$partTargetSub->part_target_sub_id}}";

                $.ajax({
                    type: 'post',
                    url: "{{ route('part-detail.saveTargetSub') }}",
                    data: {
                        sub_order: sub_order,
                        sub_name: sub_name,
                        sub_desc: sub_desc,
                        sub_id: sub_id,
                    },
                    success: (response) => {
                        if(response.success)
                        {
                            alert('แก้ไขข้อมูลสำเร็จ');
                            
                            window.location.reload();
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

        });
    </script>
@endpush
