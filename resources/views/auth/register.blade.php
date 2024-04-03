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
                                <h5 style="font-weight:900;font-size:25px">ثبت نام مشاورین املاک</h5>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="level" value="agency">
                                <div class="mt-4">
                                    <label for="" style="font-weight: 900"> اطلاعات آژانس </label>
                                    <div class="form-style">
                                        <input type="text" name="agencyname" placeholder="نام آژانس *">
                                        @error('agencyname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-style">
                                        <input type="text" name="agencyphone" placeholder="تلفن آژانس">
                                        @error('agencyphone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-style">
                                        <input type="text" name="agencycity" placeholder="شهر حوزه فعالیت *">
                                        @error('agencycity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="" style="font-weight: 900"> اطلاعات مدیر </label>
                                    <div class="d-lg-flex">
                                        <div class="col-lg-6 col-12 input-padding-left">
                                            <div class="form-style">
                                                <input name="fname" type="text" placeholder="نام *">
                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 input-padding-right">
                                            <div class="form-style">
                                                <input name="lname" type="text" placeholder="نام خانوادگی **">
                                                @error('lname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-style">
                                        <input name="phone" type="text" placeholder="شماره تلفن همراه *">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="" style="font-weight: 900"> تعیین رمز عبور </label>
                                    <div class="form-style">
                                        <input type="password" id="password" name="password" placeholder="رمز عبور *">
                                        <i onclick="changeinputtype()" class="fa fa-eye"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-style">
                                        <input type="password" required name="password_confirmation"
                                            placeholder="تکرار رمز عبور *">
                                    </div>
                                </div>
                                <button class="mt-4 btn btn-primary w-100" style="background-color: #3863bf;height:45px">ثبت
                                    نام</button>
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
                                <h5 style="font-weight:900;font-size:25px">ثبت نام</h5>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
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
                                    <div class="form-style">
                                        <input type="password" required name="password_confirmation"
                                            placeholder="تکرار رمز عبور *">
                                    </div>
                                </div>

                                <button class="mt-4 btn btn-secondary w-100"
                                    style="background-color: #931d4f;height:45px">ثبت نام</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif
@endsection
