<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
    
                    <div class="card-header text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <a href="{{route('part.create')}}" class="btn btn-primary">เพิ่มข้อมูล</a>
                        </div>
                    </div>
    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ด้านเกณฑ์มาตรฐาน</th>
                                        <th>จำนวนเป้าประสงค์</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part_order}}</td>
                                        <td>{{$item->part_name}}</td>
                                        <td class="text-center">{{$item->partTarget->count()}}</td>
                                        <td class="text-center">
                                            <a href="{{route('part.edit', $item->part_id)}}" class="btn btn-primary ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="deleteById({{$item->part_id}})" class="btn btn-light">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination Links --}}
                        <div class="m-t-30">
                            {{$model->links()}}
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>
