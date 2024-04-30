@extends('layouts.app')

@section('content')
<section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <h4>เข้าสู่ระบบ</h4>
                        <h6>การบริหารจัดการแหล่งท่องเที่ยวโดยชุมชน</h6>
                        <div class="form-group">
                            <label>อีเมล</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" name="email" type="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>รหัสผ่าน</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required>
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
</section>
@endsection