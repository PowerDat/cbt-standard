@extends('layouts.auth')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form class="theme-form login-form" method="POST" id="form">
                    @csrf

                    <h4>ยินดีต้อนรับ</h4>
                    <h6>ระบบประเมินมาตรฐานการบริหารจัดการแหล่งท่องเที่ยวโดยชุมชน</h6>

                    <div id="errors-list"></div>

                    <div class="form-group">
                        <label>ชื่อผู้ใช้</label>
                        <div class="input-group">
                            <input 
                                id="user_login" 
                                type="text"
                                class="form-control" 
                                name="user_login"
                                required
                            >
                            @if ($errors->has('user_login'))
                                <span class="text-danger">{{ $errors->first('user_login') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <div class="input-group">
                            <input 
                                id="password" 
                                type="password"
                                class="form-control" 
                                name="password"
                                required 
                            >
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
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

        $(document).on("submit", "#form", function() {
          var e = this;
  
          $(this).find("[type='submit']").html("เข้าสู่ระบบ...");
  
          $.ajax({
              url: "{{route('auth.post-login')}}",
              data: $(this).serialize(),
              type: "POST",
              dataType: 'json',
              success: function (data) {
  
                $(e).find("[type='submit']").html("เข้าสู่ระบบ");
  
                if (data.status) 
                {
                    window.location = data.redirect;
                }
                else
                {
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) 
                    {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
              }
          });
  
          return false;
      });

    });
</script>
@endpush
