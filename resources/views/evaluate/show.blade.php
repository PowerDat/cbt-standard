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
                            {{'ชุมชน'.session()->get('community_name')}}
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
                        <div class="row">
                            <div class="col-sm-6">
                                @if (session()->has('community_name'))
                                <p><strong>ชุมชนที่ประเมิน: {{'ชุมชน'.session()->get('community_name')}}</strong></p>
                                @endif
                                <p><strong>ประเภทเกณฑ์มาตรฐาน: {{$part_type_name}}</strong></p>
                                <p><strong>{{ 'ด้าน ' . $part[0]->part_order . ' ' . $part[0]->part_name }}</strong></p>
                                <p><strong>{{ 'เป้าประสงค์ ' . $part_target[0]->part_target_order . ' ' . $part_target[0]->part_target_name }}</strong></p>
                            </div>
                            <div class="col-sm-6 text-end">
                                <p><span class="badge badge-info">ดูข้อมูล</span></p>
                            </div>
                        </div>
                    </div>

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
                                                                <input 
                                                                type="checkbox" 
                                                                name="chk_question_{{$target_sub->part_target_sub_id}}[]" 
                                                                value="{{$index_question->part_index_question_id}}"
                                                                @foreach ($ap_question as $question)
                                                                    @if ($target_sub->part_target_sub_id == $question->part_target_sub_id)
                                                                        @if ($index_question->part_index_question_id == $question->part_index_question_id)
                                                                            checked
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                               disabled>
                                                                <label for="">
                                                                    {{$index_question->part_index_question_desc}}
                                                                </label>        
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div>
                                                                    <label class="form-label text-danger">แนบเอกสาร (นามสกุล .pdf เท่านั้น)</label>
                                                                    @foreach ($ap_question as $question)
                                                                        @if ($index_question->part_index_question_id == $question->part_index_question_id)
                                                                            <p><a class="text-danger" href="{{asset('uploads/files/'.$question->file)}}" target="_blank"><u>{{$question->file}}</u> </a></p>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div>
                                                                    <label class="form-label text-danger">รูปภาพ (นามสกุล .png, .jpg เท่านั้น)</label>
                                                                    @foreach ($ap_question as $question)
                                                                    @if ($index_question->part_index_question_id == $question->part_index_question_id)
                                                                        <p><a class="text-danger" href="{{asset('uploads/files/'.$question->image)}}" target="_blank"><u>{{$question->image}}</u></a></p>
                                                                    @endif
                                                                @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div>
                                                                    <label class="form-label text-danger">ลิงค์วีดีโอ (youtube เท่านั้น)</label>
                                                                    @foreach ($ap_question as $question)
                                                                    @if ($index_question->part_index_question_id == $question->part_index_question_id)
                                                                        <p><a class="text-danger" href="{{asset('uploads/files/'.$question->link_url)}}" target="_blank"><u>{{$question->link_url}}</u></a></p>
                                                                    @endif
                                                                @endforeach
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
                                                
                                                @if ($ap_score->count() > 0)
                                                    @foreach ($ap_score as $score)
                                                        @if ($target_sub->part_target_sub_id == $score->part_target_sub_id)
                                                            @if ($score->appraisal_score_score != "")
                                                            <div class="col">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="4"
                                                                    @if ($score->appraisal_score_score == 4)
                                                                        checked
                                                                    @endif
                                                                    disabled>
                                                                    <label class="form-check-label" for="inlineRadio1">4</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="3"
                                                                    @if ($score->appraisal_score_score == 3)
                                                                        checked
                                                                    @endif
                                                                    disabled>
                                                                    <label class="form-check-label" for="inlineRadio2">3</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="2"
                                                                    @if ($score->appraisal_score_score == 2)
                                                                        checked
                                                                    @endif
                                                                    disabled>
                                                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="1"
                                                                    @if ($score->appraisal_score_score == 1)
                                                                        checked
                                                                    @endif
                                                                    disabled>
                                                                    <label class="form-check-label" for="inlineRadio2">1</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="rdo_{{$target_sub->part_target_sub_id}}" value="0"
                                                                    @if ($score->appraisal_score_score == 0)
                                                                        checked
                                                                    @endif
                                                                    disabled>
                                                                    <label class="form-check-label" for="inlineRadio2">0</label>
                                                                </div> 
                                                            </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">ความคิดเห็นเพิ่มเติม(เชิงคุณภาพ)</span></h5>
                                                <div class="col mb-3">
                                                    @if ($ap_score->count() > 0)
                                                        @foreach ($ap_score as $comment)
                                                            @if ($target_sub->part_target_sub_id == $comment->part_target_sub_id)
                                                            <textarea class="form-control" name="comment_{{$target_sub->part_target_sub_id}}" id="" rows="3" readonly>{{$comment->appraisal_score_comment}}</textarea>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                @endfor

                            @endforeach
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-light" href="{{route('evaluate.target', $part[0]->part_id)}}">กลับหน้าหลัก</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/form-wizard/form-wizard-two.js') }}"></script>
    <script src="{{ asset('js/form-wizard/jquery.backstretch.min.js') }}"></script>
    <script>
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

       $(document).ready(function(){

        let count = "{{count($part_target_sub)}}";

        $('#btn-step-1').removeClass( "btn-primary btn" ).addClass( "btn-primary btn btn-light" );
        $('#btn-step-' + count).removeClass( "btn-primary btn btn-light" ).addClass( "btn-primary btn" );

        $('#step-1').css('display', 'block');
        $('#step-' + count).css('display', 'none');
       });

   </script>
@endpush
