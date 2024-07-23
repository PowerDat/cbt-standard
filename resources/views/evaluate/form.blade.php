@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">แบบประเมิน</li>
                        <li class="breadcrumb-item active">
                            @if (session()->has('community_name'))
                            {{session()->get('community_name')}}
                            @endif

                            @if (session()->has('evaluate_community'))
                            {{session()->get('evaluate_community')}}
                            @endif
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header pb-0">
                        @if (session()->has('session_community_by_select_option'))
                        <p><strong>ชุมชนที่ประเมิน: {{session()->get('session_community_by_select_option')}}</strong></p>
                        @elseif (session()->has('community_name'))
                        <p><strong>ชุมชนที่ประเมิน: {{session()->get('community_name')}}</strong></p>
                        @endif
                        <p><strong>{{ 'ด้าน ' . $part[0]->part_order . ' ' . $part[0]->part_name }}</strong></p>
                        <p><strong>{{ 'เป้าประสงค์ ' . $part_target[0]->part_target_order . ' ' . $part_target[0]->part_target_name }}</strong></p>
                    </div>
                <form id="form" enctype="multipart/form-data" method="POST">
                    @csrf

                    <input type="hidden" name="part_target_id" value="{{$part_target_id}}">
                    <input type="hidden" name="part_id" value="{{$part_target[0]->part_id}}">

                    

                        <div class="card-body">
                            
                            <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    @for ($i=1; $i <= count($part_target_sub); $i++)
                                    <div class="stepwizard-step">
                                        <a id="btn-step-{{$i}}" class="btn btn-primary" href="#step-{{$i}}">ข้อ {{$i + $part_target_sub[0]->part_target_sub_order - 1}}</a>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            @foreach ($part_target_sub as $target_sub)

                                @for ($i=1; $i <= count($part_target_sub); $i++)
                                {{-- {{dd(count($part_target_sub))}} --}}
                                    @if ($target_sub->part_target_sub_order == ($i + $part_target_sub[0]->part_target_sub_order - 1))
                                    <div class="setup-content" id="step-{{$i}}">
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <p>
                                                    {{'('.$target_sub->part_target_sub_order.') '.$target_sub->part_target_sub_name}} 
                                                </p>
                                                <p>
                                                    <strong>คำอธิบาย:</strong>
                                                    {{$target_sub->part_target_sub_desc}}
                                                </p>
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">ข้อการประเมิน</span></h5>
                                                @foreach ($part_index_question as $index_question)
                                                    @if ($index_question->part_target_sub_id == $target_sub->part_target_sub_id)
                                                        <div class="col">
                                                            <div class="form-group m-t-15">
                                                                <input type="checkbox" name="chk_question_{{$target_sub->part_target_sub_id}}[]" value="{{$index_question->part_index_question_id}}"
                                                                @if (in_array($index_question->part_index_question_id, old("chk_question_$target_sub->part_target_sub_id", [])))
                                                                    checked
                                                                @endif>
                                                                <label for="">
                                                                    {{$index_question->part_index_question_desc}}
                                                                </label>        
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div>
                                                                    <label class="form-label text-danger">แนบเอกสาร (นามสกุล .pdf เท่านั้น)</label>
                                                                    <input type="file" class="form-control" name="file_{{$index_question->part_index_question_id}}">
                                                                    <span class="text-danger error-text file_{{$index_question->part_index_question_id}}_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div>
                                                                    <label class="form-label text-danger">รูปภาพ (นามสกุล .png, .jpg เท่านั้น)</label>
                                                                    <input type="file" class="form-control" name="image_{{$index_question->part_index_question_id}}">
                                                                    <span class="text-danger error-text image_{{$index_question->part_index_question_id}}_error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div>
                                                                    <label class="form-label text-danger">ลิงค์วีดีโอ (youtube เท่านั้น)</label>
                                                                    <input type="text" class="form-control" name="link_url_{{$index_question->part_index_question_id}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">เกณฑ์การให้คะแนน</span></h5>
                                                @foreach ($part_index_score as $index_score)
                                                    @if ($index_score->part_target_sub_id == $target_sub->part_target_sub_id)
                                                    <p>{{'คะแนน '.($index_score->part_index_score_order - 1).' = '.$index_score->part_index_score_desc}}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">คะแนนการประเมิน</span></h5>
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="4">
                                                        <label class="form-check-label" for="inlineRadio1">4</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="3">
                                                        <label class="form-check-label" for="inlineRadio2">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="2">
                                                        <label class="form-check-label" for="inlineRadio2">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="1">
                                                        <label class="form-check-label" for="inlineRadio2">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="0">
                                                        <label class="form-check-label" for="inlineRadio2">0</label>
                                                    </div>
                                                </div>
                                                <span class="text-danger error-text rdo_{{$target_sub->part_target_sub_id}}_error"></span>
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">ความคิดเห็นเพิ่มเติม(เชิงคุณภาพ)</span></h5>
                                                <div class="col mb-3">
                                                    <textarea class="form-control" name="comment_{{$target_sub->part_target_sub_id}}" id="" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endfor

                            @endforeach
                        </div>
                        <div class="card-footer text-end">
                            {{-- <a id="draft" class="btn btn-secondary">บันทึกร่าง</a> --}}
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                            <a class="btn btn-light" href="{{route('evaluate.target', $part[0]->part_id)}}">ยกเลิก</a>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/form-wizard/form-wizard-two.js') }}"></script>
    <script src="{{ asset('js/form-wizard/jquery.backstretch.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
                    url: "{{route('evaluate.store')}}",
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

                                Swal.fire({
                                    icon: 'error',
                                    text: val[0],
                                    width: '450px',
                                });
                            });
                        }
                        else if(response.status == 2){
                            $.each(response.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);

                                Swal.fire({
                                    icon: 'error',
                                    text: val[0],
                                    width: '450px',
                                });
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

                            let id = "{{$part_target[0]->part_id}}";
                            let url = "{{route('evaluate.target', ':id')}}";
                            url = url.replace(':id', id);
                            window.location = url;
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });

            $('#draft').click(function(e){
                e.preventDefault();

                var form = $('#form')[0];
                let data = new FormData(form);

                $.ajax({
                    type: 'post',
                    url: "{{ route('evaluate.save-draft') }}",
                    data: data,
                    processData : false,
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(response){
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

                            let id = "{{$part_target[0]->part_id}}";
                            let url = "{{route('evaluate.target', ':id')}}";
                            url = url.replace(':id', id);
                            window.location = url;
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            });

            let count = "{{count($part_target_sub)}}";

            if(count > 1){
                $('#btn-step-1').removeClass( "btn-primary btn" ).addClass( "btn-primary btn btn-light" );
                $('#btn-step-' + count).removeClass( "btn-primary btn btn-light" ).addClass( "btn-primary btn" );

                $('#step-1').css('display', 'block');
                $('#step-' + count).css('display', 'none');
            }
            

        });

    </script>
@endpush
