@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลด้านเกณฑ์มาตรฐาน</li>
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

                <form class="form theme-form needs-validation" method="POST" action="{{isset($model) ? route('part.update', $model->part_id) : route('part.store')}}" novalidate>
                    @csrf
                    @if (isset($model))
                        @method('put')
                    @endif

                    <div class="card-body">
                        {{-- @if (isset($model))
                        <div class="row">
                            <div class="col text-end">
                                <a href="{{route('part-target.create-from-part', $model->part_id)}}" class="btn btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> รายละเอียด
                                </a>
                            </div>
                        </div>
                        @endif --}}
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับด้านเกณฑ์มาตรฐาน</label>
                                    <input class="form-control" id="part_order" name="part_order" type="number" required
                                    value="{{ isset($model) ? $model->part_order : $count_order}}" min="1">
                                    <div class="invalid-feedback">กรอกข้อมูลลำดับ</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ข้อมูลด้านเกณฑ์มาตรฐาน</label>
                                    <input class="form-control" id="part_name" name="part_name" type="text" required
                                    value="{{isset($model) ? $model->part_name : ''}}">
                                    <div class="invalid-feedback">กรอกข้อมูลด้าน</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">รายละเอียด</label>
                                    <textarea class="form-control" id="part_detail" name="part_detail" rows="3">{{isset($model) ? $model->part_detail : ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('part.index')}}">ยกเลิก</a>
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