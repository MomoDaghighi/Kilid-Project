@extends('home.master')
@section('script')
<script>
    function changeinputtype(params) {
        var type = $('#password').attr('type');
        if (type == 'text') {
            $('#password').attr('type', 'password');
        } else {
            $('#password').attr('type', 'text');

        }
    }
</script>
@endsection
@section('content')
    @if (request('level') == 'agency')
        <div>
            <div class="d-lg-flex">
                <div class="col-lg-6 order-lg-2 d-lg-block">
                    <div style="background: url({{ asset('img/image/agency-login.png') }})center/cover no-repeat;"
                        class="login-image"></div>
                </div>
                <div class="col-lg-6 order-lg-1 mt-4 mt-lg-0 mb-4 mb-lg-0">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <div class="col-9">
                            <div class="title text-center">
                                <h5 style="font-weight:900;font-size:25px"> سامانه مشاورین کیلید </h5>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mt-4">

                                    <div class="form-style">
                                        <input name="phone" type="text" placeholder="شماره تلفن همراه *">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-style">
                                        <input type="password" id="password" name="password" placeholder="رمز عبور *">
                                        <i onclick="changeinputtype()" class="fa fa-eye"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="mt-4 btn btn-primary w-100"
                                    style="background-color: #3863bf;height:45px">ورود</button>
                                <div class="pt-3">
                                    <a href="/register?level=agency">اگر ثبت نام نکردید روی این دکمه کلیک
                                        کنید</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        <div>
            <div class="d-lg-flex">
                <div class="col-lg-6 order-lg-2 d-lg-block">
                    <div style="background: url({{ asset('img/image/user-login.png') }})center/cover no-repeat;"
                        class="login-image"></div>
                </div>
                <div class="col-lg-6 order-lg-1 mt-4 mt-lg-0 mb-4 mb-lg-0">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <div class="col-9">
                            <div class="title text-center">
                                <h5 style="font-weight:900;font-size:25px">ورود</h5>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="level" value="user">
                                <div class="mt-4">
                                    <div class="form-style">
                                        <input type="text" name="phone" placeholder="شماره تلفن همراه *">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-style">
                                        <input type="password" id="password" name="password" placeholder="رمز عبور *">
                                        <i onclick="changeinputtype()" class="fa fa-eye"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <button class="mt-4 btn btn-secondary w-100"
                                    style="background-color: #931d4f;height:45px">ورود</button>
                                <div class="pt-3">
                                    <a href="/register">اگر ثبت نام نکردید روی این دکمه کلیک
                                        کنید</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif
@endsection
