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
                            {{session()->get('community_name')}}
                            @endif

                            @if (session()->has('session_community_by_select_option'))
                            {{session()->get('session_community_by_select_option')}}
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
                    <div class="card-header pb-0">
                        <h5>มาตรฐานการประเมิน</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชุมชนที่ประเมิน</label>
                                    {{--ชุมชน --}}
                                    @if ($role_name == 'community') 
                                        <select  class="form-control" id="evaluate_community" 
                                        {{-- ถ้าเป็นผู้ใช้ประเภทชุมชน --}}
                                        @if ($session_community_id_by_api != "") 
                                            disabled
                                        @endif
                                        >
                                            <option value="" selected disabled>เลือกชุมชน</option>
                                            @for ($i=0; $i < count($response_community_by_api); $i++)
                                            <option value="{{$response_community_by_api[$i]['community_id']}}"
                                            {{-- ถ้าเป็นผู้ใช้ประเภทชุมชน --}}
                                            @if ($session_community_id_by_api != "")
                                                @if ($session_community_id_by_api == $response_community_by_api[$i]['community_id'])
                                                    selected
                                                @endif
                                            @endif
                                            >
                                            {{$response_community_by_api[$i]['community_name']}}
                                            </option>
                                        @endfor
                                        </select>
                                    @endif

                                    {{-- กรรมการ --}}
                                    @if ($role_name == 'committee')
                                        <select  class="form-control" id="evaluate_community">
                                            <option value="" selected disabled>เลือกชุมชน</option>
                                            @foreach ($array_community as $com)
                                                @for ($i=0; $i < count($response_community_by_api); $i++)
                                                    @if ($com == $response_community_by_api[$i]['community_id'])
                                                    <option value="{{$response_community_by_api[$i]['community_id']}}"
                                                    @if (session()->has('session_community_by_select_option')) 
                                                        @if (session()->get('session_community_by_select_option') == $response_community_by_api[$i]['community_name'])
                                                        selected
                                                        @endif
                                                    @endif
                                                    >
                                                    {{$response_community_by_api[$i]['community_name']}}
                                                    </option>
                                                    @endif
                                                @endfor
                                            @endforeach
                                        </select>
                                    @endif
                                    
                                    {{-- นักวิจัย --}}
                                    @if ($role_name == 'researcher')
                                    <select  class="form-control" id="evaluate_community">
                                        <option value="" selected disabled>เลือกชุมชน</option>
                                        @foreach ($array_community as $com)
                                            @for ($i=0; $i < count($response_community_by_api); $i++)
                                                @if ($com == $response_community_by_api[$i]['community_id'])
                                                <option value="{{$response_community_by_api[$i]['community_id']}}"
                                                @if (session()->has('session_community_by_select_option')) 
                                                    @if (session()->get('session_community_by_select_option') == $response_community_by_api[$i]['community_name'])
                                                    selected
                                                    @endif
                                                @endif
                                                >
                                                {{$response_community_by_api[$i]['community_name']}}
                                                </option>
                                                @endif
                                            @endfor
                                        @endforeach
                                    </select>
                                    @endif

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
                    if(response.status == 1){
                        window.location.reload();
                    }
                },
            });
        });

    });
</script>
@endpush
