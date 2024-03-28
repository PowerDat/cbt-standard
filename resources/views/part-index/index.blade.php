@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                        <li class="breadcrumb-item">ข้อมูลดัชนี</li>
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

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับด้าน</th>
                                        <th>ลำดับเป้าประสงค์</th>
                                        <th>ลำดับเกณฑ์ย่อย</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model as $item)
                                        <tr>
                                            <td class="text-center">{{$item->part_order}}</td>
                                            <td class="text-center">{{$item->part_target_order}}</td>
                                            <td class="text-center">{{$item->part_target_sub_order}}</td>
                                            <td class="text-center">
                                                <a href="{{route('part-index.createById', $item->part_target_sub_id)}}" class="btn btn-primary">
                                                    <i data-feather="edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination Links --}}
                        <div class="m-t-30">
                            {{$model->links('pagination::bootstrap-5')}}
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
