<!-- content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>ข้อมูลผู้ดูแลระบบ</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-3 text-center">
                            <img class="rounded-circle" src="{{asset('images/user/6.jpg')}}" alt=""
                                style="width: 150px;height:150px;">
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">ชื่อผู้ใช้</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label">สิทธิ์</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" value="{{$role_name}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">อีเมล</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" value="{{Auth::user()->email}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
