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
                    action="{{ isset($model) ? route('part-target.update', $model->part_target_id) : route('part-target.store')}}" 
                    novalidate>
                    @csrf
                    @if (isset($model))
                        @method('put')
                    @endif
                    <div class="card-body">
                       
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ข้อมูลด้าน</label>
                                    <select name="part_id" id="part_id" class="form-control" required>
                                        <option value="" selected disabled>เลือกข้อมูล</option>
                                        @foreach ($part as $item)
                                            <option value="{{$item->part_id}}"
                                                @if (isset($model))
                                                    @if ($model->part_id == $item->part_id)
                                                        selected
                                                    @endif
                                                @endif>{{$item->part_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">เลือกข้อมูลด้าน</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับเป้าประสงค์</label>
                                    <input class="form-control" id="part_target_order" name="part_target_order" type="number" required
                                        min="1" step="0.1" value="{{isset($model) ? $model->part_target_order : ''}}">
                                    <div class="invalid-feedback">กรอกข้อมูลลำดับ</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ข้อมูลเป้าประสงค์</label>
                                    <input class="form-control" id="part_target_name" name="part_target_name" type="text" required
                                    value="{{isset($model) ? $model->part_target_name : ''}}">
                                    <div class="invalid-feedback">กรอกข้อมูลเป้าประสงค์</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('part-target.index')}}">ยกเลิก</a>
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