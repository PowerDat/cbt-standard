@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                        <li class="breadcrumb-item">รายละเอียดแต่ละด้าน</li>
                        <li class="breadcrumb-item active">หน้าแรก</li>
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

                    <div class="card-header text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <a href="{{route('part-detail.create')}}" class="btn btn-primary">เพิ่มข้อมูล</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับเกณฑ์มาตรฐาน</th>
                                        <th>ลำดับเป้าประสงค์</th>
                                        <th>ลำดับเกณฑ์พิจารณา</th>
                                        <th>แก้ไข</th>
                                        {{-- <th>ลบ</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_order}}</td>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td class="text-center">{{$item->part_target_sub_order}}</td>
                                        <td class="text-center">
                                            <a href="{{route('part-detail.edit', $item->part_target_sub_id)}}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        {{-- <td class="text-center">
                                            <form action="{{route('part-target.destroy', $item->part_target_id)}}"
                                                method="post" class="delete_form">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-light btn-sm">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination Links --}}
                        <div class="m-t-30">
                            {{$datas->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $('.delete_form').on('submit', function() {
                if (confirm("ต้องการลบข้อมูลหรือไม่?")) {
                    return true;
                } else {
                    return false;
                }
            });

            setTimeout(function(){
                $("div.alert").remove();
            }, 5000 ); // 5 secs
        });
    </script>
@endpush
