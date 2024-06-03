@extends('layouts.auth')

{{-- @push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/loading.css') }}">
@endpush --}}

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form class="theme-form login-form" method="POST" id="form">
                    @csrf

                    <h4>ยินดีต้อนรับ</h4>
                    <h6>ระบบประเมินมาตรฐานการบริหารจัดการแหล่งท่องเที่ยวโดยชุมชน</h6>

                    <section id="loading">
                        <div id="loading-content"></div>
                    </section>

                    <div class="alert alert-danger" id="login_error">
                        ชื่อหรือรหัสผ่านไม่ถูกต้อง
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">ชื่อผู้ใช้</label>
                                <input class="form-control" id="user_login" name="user_login" type="text"> 
                                <span class="text-danger error-text user_login_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
                    </div>

                </form>
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

    $(document).ready(function() {

        $('#login_error').hide();

        $(document).on("submit", "#form", function() {
          var e = this;
  
            // $('#loading').addClass('loading');
            // $('#loading-content').addClass('loading-content');
  
            $.ajax({
                url: "{{route('auth.post-login')}}",
                data: $(this).serialize(),
                type: "POST",
                dataType: 'json',
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {

                    // $('#loading').removeClass('loading');
                    // $('#loading-content').removeClass('loading-content');

                    if(response.status == 0)
                    {
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                    else if(response.status == 403)
                    {
                        $('#login_error').show();
                    }
                    else if(response.status == 1)
                    {
                        window.location = response.redirect;
                    }
                }
            });
  
            return false;
      });

    });
</script>
@endpush
