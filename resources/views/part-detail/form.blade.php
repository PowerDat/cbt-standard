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
                <form id="form" class="f1" method="post">
                    @csrf

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="card">

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{route('part-target.edit', $partTarget->part_target_id)}}" class="btn btn-secondary">
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

                            {{-- <div class="f1-steps">
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
                            </div> --}}

                            {{-- ข้อมูลเป้าประสงค์ --}}
                            {{-- <fieldset>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">ข้อมูลเกณฑ์มาตรฐาน</label>
                                            <select name="part_id" id="part_id" class="form-control" >
                                                <option value="{{ $part[0]->part_id }}">
                                                    {{'ด้าน '.$part[0]->part_order.' : '.$part[0]->part_name}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                            <select name="part_target_id" id="part_target_id" class="form-control" >
                                                <option value="{{ $partTarget->part_target_id }}">
                                                    {{'เป้าประสงค์ '.$partTarget->part_target_order.' : '.$partTarget->part_target_name}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="f1-buttons">
                                    <button class="btn btn-primary btn-next" type="button">ต่อไป</button>
                                </div>
                            </fieldset> --}}

                            {{-- ข้อมูลเกณฑ์การพิจารณา --}}
                            <fieldset>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <h6>{{'ด้าน '.$part[0]->part_order.' : '.$part[0]->part_name}}</h6>
                                            <h6>{{'เป้าประสงค์ '.$partTarget->part_target_order.' : '.$partTarget->part_target_name}}</h6>
                                        </div>
                                        <input type="hidden" name="part_target_id" value="{{$partTarget->part_target_id}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">ลำดับเกณฑ์พิจารณา <span class="text-danger" style="font-size: 20px;">*</span></label>
                                            <input class="form-control" id="part_target_sub_order" name="part_target_sub_order" type="text" required>
                                            <span class="text-danger error-text part_target_sub_order_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">ข้อมูลเกณฑ์พิจารณา <span class="text-danger" style="font-size: 20px;">*</span></label>
                                            <textarea class="form-control" rows="2" id="part_target_sub_name" name="part_target_sub_name" required></textarea>
                                            <span class="text-danger error-text part_target_sub_name_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">คำอธิบาย <span class="text-danger" style="font-size: 20px;">*</span></label>
                                            <textarea class="form-control" rows="3" id="part_target_sub_desc" name="part_target_sub_desc" required></textarea>
                                            <span class="text-danger error-text part_target_sub_desc_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="f1-buttons mt-3">
                                    <button class="btn btn-primary btn-next" id="btn-1" type="button">ต่อไป</button>
                                </div>
                            </fieldset>

                            {{-- ข้อมูลเกณฑ์การให้คะแนน --}}
                            <fieldset>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <h6>{{'ด้าน '.$part[0]->part_order.' : '.$part[0]->part_name}}</h6>
                                            <h6>{{'เป้าประสงค์ '.$partTarget->part_target_order.' : '.$partTarget->part_target_name}}</h6>
                                        </div>
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
                                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm addRow">
                                                                    เพิ่ม
                                                                </a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_question">
                                                        {{-- <tr>
                                                            <td>
                                                                <input class="form-control" type="text" name="name_question[]">
                                                            </td>
                                                            <td style="width: 50px;"></td>
                                                        </tr> --}}
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
                                                <input class="form-control" type="text" name="inputs_score[4][name_score]">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 3 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="inputs_score[3][name_score]" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 2 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="inputs_score[2][name_score]" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 1 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="inputs_score[1][name_score]" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col">
                                        <div class="row">
                                            <label for="" class="col-sm-2 col-form-label text-end">คะแนน 0 =</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="inputs_score[0][name_score]" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="f1-buttons mt-3">
                                    <button class="btn btn-outline-primary btn-previous" type="button">ก่อนหน้า</button>
                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                    <a href="{{route('part-target.edit', $partTarget->part_target_id)}}" class="btn btn-secondary">
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

                var url = $(this).attr("action");
                let formData = new FormData(this);

                $.ajax({
                    type: 'post',
                    url: "{{ route('part-detail.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success: (response) => {
                        if(response.status == 0){
                            $.each(response.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }
                        else if(response.status == 1)
                        {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: response.msg,
                                icon: 'success',
                                width: '450px',
                                showConfirmButton: false,
                                timer: 5000
                            });

                            let id = "{{$partTarget->part_target_id}}";
                            let url = "{{ route('part-target.edit', ':id') }}";
                            url = url.replace(':id', id);
                            window.location = url;
                        }
                    },
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
                    <td><input class="form-control" type="text" name="name_question[]"></td>
                    <td><a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow">ลบ</a></td>
                </tr>
            `;

                $('#tbody_question').append(tr);

            });

            $('#tbody_question').on('click', '.deleteRow', function() {
                $(this).parent().parent().remove();
            });


        });
    </script>
@endpush
