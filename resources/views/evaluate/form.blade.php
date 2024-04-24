@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">แบบประเมิน</li>
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
                        <p><strong>{{ 'ด้าน ' . $part[0]->part_order . ' ' . $part[0]->part_name }}</strong></p>
                        <p><strong>{{ 'เป้าประสงค์ ' . $part_target[0]->part_target_order . ' ' . $part_target[0]->part_target_name }}</strong></p>
                    </div>

                    <form action="{{route('evaluate.store')}}" method="post">
                        @csrf

                        <input type="hidden" name="part_target_id" value="{{$part_target_id}}">

                        <div class="card-body">
                            
                            <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    @for ($i=1; $i <= count($part_target_sub); $i++)
                                    <div class="stepwizard-step">
                                        <a class="btn btn-primary" href="#step-{{$i}}">{{$i}}</a>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            @foreach ($part_target_sub as $target_sub)

                                @for ($i=1; $i <= count($part_target_sub); $i++)
                                    @if ($target_sub->rowNum == $i)
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
                                                                <input type="checkbox" name="chk_question_{{$target_sub->part_target_sub_id}}[]" id="" value="{{$index_question->part_index_question_id}}">
                                                                <label for="">
                                                                    {{$index_question->part_index_question_desc}}
                                                                </label>        
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
        
                                        {{-- <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">เกณฑ์การให้คะแนน</span></h5>
                                                @foreach ($part_index_score as $index_score)
                                                    @if ($index_score->part_target_sub_id == $target_sub->part_target_sub_id)
                                                    <p>{{'คะแนน '.($index_score->part_index_score_order - 1).' = '.$index_score->part_index_score_desc}}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div> --}}
        
                                        {{-- <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">คะแนนการประเมิน</span></h5>
                                                <div class="col">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$i}}" value="4">
                                                        <label class="form-check-label" for="inlineRadio1">4</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$i}}" value="3">
                                                        <label class="form-check-label" for="inlineRadio2">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$i}}" value="2">
                                                        <label class="form-check-label" for="inlineRadio2">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$i}}" value="1">
                                                        <label class="form-check-label" for="inlineRadio2">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rdo_{{$i}}" value="0">
                                                        <label class="form-check-label" for="inlineRadio2">0</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-xs-12">
                                                <h5><span class="badge bg-info">ความคิดเห็นเพิ่มเติม(เชิงคุณภาพ)</span></h5>
                                                <div class="col mb-3">
                                                    <textarea class="form-control" name="comment_{{$i}}" id="" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    @endif
                                @endfor

                                
                            @endforeach
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                            <a class="btn btn-light" href="{{route('evaluate.target', $part[0]->part_id)}}">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/form-wizard/form-wizard-two.js') }}"></script>
    <script src="{{ asset('js/form-wizard/jquery.backstretch.min.js') }}"></script>
@endpush
