@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์ย่อย</li>
                    <li class="breadcrumb-item active">
                        @if (isset($model))
                        แก้ไขข้อมูล
                        @else
                        เพิ่มข้อมูล
                        @endif
                    </li>
                </ol>
            </div>
            <div class="col-sm-6"></div>
        </div>
    </div>
</div>

<!-- content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <form class="form theme-form needs-validation" method="POST" 
                    action="{{ isset($model) ? route('part-target-sub.update', $model->part_target_sub_id) : route('part-target-sub.store')}}" 
                    novalidate>
                    @csrf
                    @if (isset($model))
                        @method('put')
                    @endif
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ข้อมูลด้าน-เป้าประสงค์</label>
                                    <select name="part_target_id" id="part_target_id" class="form-control" required>
                                        <option value="" selected disabled>เลือกข้อมูล</option>
                                        @foreach ($part as $item)
                                            <option value="{{$item->part_target_id}}"
                                                @if (isset($model))
                                                    @if ($model->part_target_id == $item->part_target_id)
                                                        selected
                                                    @endif
                                                @endif>{{$item->part_target_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">เลือกข้อมูลด้าน-เป้าประสงค์</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับเกณฑ์ย่อย</label>
                                    <input class="form-control" id="part_target_sub_order" name="part_target_sub_order" type="number" required
                                        min="1" value="{{isset($model) ? $model->part_target_sub_order : ''}}">
                                    <div class="invalid-feedback">กรอกข้อมูลลำดับ</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ข้อมูลเกณฑ์ย่อย</label>
                                    <input class="form-control" id="part_target_sub_name" name="part_target_sub_name" type="text" required
                                    value="{{isset($model) ? $model->part_target_sub_name : ''}}">
                                    <div class="invalid-feedback">กรอกข้อมูลเกณฑ์ย่อย</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">คำอธิบาย</label>
                                    <textarea class="form-control" rows="5" id="part_target_sub_desc" name="part_target_sub_desc" required>{{(isset($model)) ? $model->part_target_sub_desc : ''}}</textarea>
                                    <div class="invalid-feedback">กรอกข้อมูลคำอธิบาย</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('part-target-sub.index')}}">ยกเลิก</a>
                      </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/form-validation-custom.js') }}"></script>
@endpush