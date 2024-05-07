@extends('layouts.master')

@section('content')
<!-- breadcrumb -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์มาตรฐาน</li>
                    <li class="breadcrumb-item">ข้อมูลเกณฑ์การให้คะแน</li>
                    <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
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
                @foreach ($model as $item)
                <div class="card-header">
                    <p><strong>ด้าน</strong>{{' '.$item->part_order.' '.$item->part_name}}</p>
                    <p><strong>เป้าประสงค์</strong>{{' '.$item->part_target_order.' '.$item->part_target_name}}</p>
                    <p><strong>เกณฑ์ย่อย</strong>{{' '.$item->part_target_sub_order.' '.$item->part_target_sub_name}}</p>
                </div> 
                @endforeach
                
                <form class="form theme-form needs-validation" method="POST" 
                        action="{{ route('part-index.store')}}" 
                        novalidate>
                    @csrf

                    <div class="card-body">
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
                                                    <th style="width: 50px;">
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm addRow">เพิ่ม</a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" name="name_question[]" required>
                                                    </td>
                                                    <td style="width: 50px;"></td>
                                                </tr>
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
                                        <input class="form-control" type="text" name="inputs_score[4][name_score]" required>
                                    </div>
                                </div>    
                            </div>            
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label for="" class="col-sm-2 col-form-label text-end">คะแนน 3 = </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="inputs_score[3][name_score]" required>
                                    </div>
                                </div>    
                            </div>            
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label for="" class="col-sm-2 col-form-label text-end">คะแนน 2 = </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="inputs_score[2][name_score]" required>
                                    </div>
                                </div>    
                            </div>            
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label for="" class="col-sm-2 col-form-label text-end">คะแนน 1 = </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="inputs_score[1][name_score]" required>
                                    </div>
                                </div>    
                            </div>            
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label for="" class="col-sm-2 col-form-label text-end">คะแนน 0 = </label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="inputs_score[0][name_score]" required>
                                    </div>
                                </div>    
                            </div>            
                        </div>
                        
                        @foreach ($model as $item)
                        <input type="hidden" name="part_target_sub_id" value="{{$item->part_target_sub_id}}">
                        @endforeach
                     </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a class="btn btn-light" href="{{route('part-index.index')}}">ยกเลิก</a>
                      </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/form-validation-custom.js') }}"></script>
<script>
    $(document).ready(function(){

        $('thead').on('click', '.addRow', function(){
            var tr = `
                <tr>
                    <td><input class="form-control" type="text" name="name_question[]" required></td>
                    <td><a href="javascript:void(0)" class="btn btn-danger btn-sm deleteRow">ลบ</a></td>
                </tr>
            `;

            $('tbody').append(tr);

        });

        $('tbody').on('click', '.deleteRow', function(){
            $(this).parent().parent().remove();
        });

        // add_question
        // let i = 0;

        // $('#add_question').click(function(){
        //     ++i;
        //     $('#table_question').append(
        //         `<tr>
        //             <td class="text-end">`+ (i+1) +`</td>
        //             <td>
        //                 <input class="form-control" type="text" name="inputs_question[`+i+`][name_question]" required> 
        //             </td>
        //             <td style="width: 50px;">
        //                 <button class="btn btn-light remove-table-row-question" type="button">ลบ</button>
        //             </td>
        //         </tr>`
        //     );
        // });

        // $(document).on('click', '.remove-table-row-question', function(){
        //     $(this).parents('tr').remove();
        // });

    });
    
</script>
@endpush