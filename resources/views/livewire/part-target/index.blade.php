<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <a href="{{route('part-target.create')}}" class="btn btn-primary">เพิ่มข้อมูล</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered ">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th>ลำดับด้าน</th>
                                        <th>ลำดับเป้าประสงค์</th>
                                        <th>เป้าประสงค์</th>
                                        <th>ดูข้อมูล</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partTarget as $item)
                                    <tr>
                                        <td class="text-center">{{$item->part->part_order}}</td>
                                        <td class="text-center">{{$item->part_target_order}}</td>
                                        <td>{{$item->part_target_name}}</td>
                                        <td class="text-center">
                                            @foreach ($partTargetSub as $target_sub)
                                            @if ($target_sub->part_target_id == $item->part_target_id)
                                            <a href="{{route('part-target.show', $item->part_target_id)}}"
                                                class="btn btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('part-target.create-by-id', $item->part_target_id)}}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{route('part-target.destroy', $item->part_target_id)}}"
                                                method="post" class="delete_form">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-light btn-sm">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination Links --}}
                        <div class="m-t-30">
                            {{$partTarget->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>