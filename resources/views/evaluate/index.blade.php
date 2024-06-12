@extends('layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">แบบประเมิน</li>
                        <li class="breadcrumb-item active">
                            @if (session()->has('community_name'))
                            {{'ชุมชน'.session()->get('community_name')}}
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

            <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>มาตรฐานการประเมิน</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชุมชนทีประเมิน</label>
                                    <select  class="form-control" id="evaluate_community" 
                                    @if ($session_api_community_id != "")
                                        disabled
                                    @endif
                                    >
                                        <option value="" selected disabled>เลือกชุมชน</option>
                                       @for ($i=0; $i < count($response_community); $i++)
                                       <option value="{{$response_community[$i]['community_id']}}"
                                       @if ($session_api_community_id != "")
                                            @if ($session_api_community_id == $response_community[$i]['community_id'])
                                                selected
                                            @endif
                                       @endif
                                       >
                                            {{$response_community[$i]['community_name']}}
                                        </option>
                                       @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ประเภทเกณฑ์มาตรฐานทีประเมิน</label>
                                    <br>
                                    @foreach ($part_type as $type)
                                        <a href="{{route('evaluate.getPartType', $type->part_type_id)}}" class="btn btn-light">
                                            {{$type->part_type_name}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
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

        $('#evaluate_community').change(function(){           
            $.ajax({
                type: 'post',
                url: "{{ route('evaluate.save-community') }}",
                data: {
                    evaluate_community:  $('#evaluate_community').val()
                },
                success: (response) => {
                    
                },
            });
        });

    });
</script>
@endpush
