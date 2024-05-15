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
                    <li class="breadcrumb-item active">ดูข้อมูล</li>
                </ol>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="f1">

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
                                        <select class="form-control" disabled>
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
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ลำดับเป้าประสงค์(เฉพาะตัวเลขเท่านั้น)</label>
                                        <input class="form-control" id="part_target_order" name="part_target_order"
                                            type="text" required
                                            value="{{isset($partTarget) ? $partTarget->part_target_order : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                        <input class="form-control" id="part_target_name" name="part_target_name"
                                            type="text" required
                                            value="{{isset($partTarget) ? $partTarget->part_target_name : ''}}">
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
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partTargetSub as $targetSub)
                                    <tr>
                                        <td style="width: 180px;">ลำดับ(เฉพาะตัวเลข)</td>
                                        <td>
                                            <input class="form-control" id="part_target_sub_order"
                                                name="part_target_sub_order" type="text" required
                                                value="{{ $targetSub->part_target_sub_order }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 180px;">ข้อมูลเกณฑ์พิจารณา</td>
                                        <td>
                                            <input class="form-control" id="part_target_sub_order"
                                                name="part_target_sub_order" type="text" required
                                                value="{{ $targetSub->part_target_sub_name }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 180px;">คำอธิบาย</td>
                                        <td>
                                            <textarea class="form-control" rows="5" id="part_target_sub_desc"
                                                name="part_target_sub_desc"
                                                required>{{ $targetSub->part_target_sub_desc }}</textarea>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="f1-buttons">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($partIndexQuestion as $item)
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="text"
                                                                name="name_question[]" required
                                                                value="{{$item->part_index_question_desc}}">
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
                                            <input class="form-control" type="text" name="inputs_score[4][name_score]"
                                                required value="{{$partIndexScore[4]->part_index_score_desc}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 3 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[3][name_score]"
                                                required value="{{$partIndexScore[3]->part_index_score_desc}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 2 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[2][name_score]"
                                                required value="{{$partIndexScore[2]->part_index_score_desc}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 1 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[1][name_score]"
                                                required value="{{$partIndexScore[1]->part_index_score_desc}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col">
                                    <div class="row">
                                        <label for="" class="col-sm-2 col-form-label text-end">คะแนน 0 = </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="inputs_score[0][name_score]"
                                                required value="{{$partIndexScore[0]->part_index_score_desc}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="part_target_id" value="{{$partTarget->part_target_id}}">

                            <div class="f1-buttons mt-3">
                                <button class="btn btn-outline-primary btn-previous" type="button">ก่อนหน้า</button>
                                <a class="btn btn-light" href="{{route('part-target.index')}}">ย้อนกลับ</a>
                            </div>
                        </fieldset>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    });
</script>
@endpush