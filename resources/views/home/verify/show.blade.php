@extends('home.master')
@section('script')
@endsection
@section('content')
        <div>
            <div class="d-lg-flex">
                <div class="col-lg-6 order-lg-2 d-lg-block">
                    @php
                        $user = auth()->user();
                    @endphp
                    @if ($user->level == 'agency')
                    <div style="background: url({{ asset('img/image/agency-login.png') }})center/cover no-repeat;"
                    class="login-image"></div>
                    @else
                    <div style="background: url({{ asset('img/image/user-login.png') }})center/cover no-repeat;"
                    class="login-image"></div>
                    @endif
                    
                </div>
                <div class="col-lg-6 order-lg-1 mt-4 mt-lg-0 mb-4 mb-lg-0">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <div class="col-9">
                            <div class="title text-center">
                                <h5 style="font-weight:900;font-size:25px"> تایید شماره موبایل </h5>
                            </div>
                            <form method="POST" action="{{ route('home.verify') }}">
                                @csrf
                                <div class="mt-4">
                                    <div class="form-style">
                                        <input name="code" type="text" placeholder="کد تایید *">
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="mt-4 btn btn-primary w-100"
                                    style="background-color: #3863bf;height:45px">تایید</button>
                                <div class="pt-3">
                                    {{-- <a href="/register?level=agency">اگر ثبت نام نکردید روی این دکمه کلیک
                                        کنید</a> --}}
                                        <h6>کدتایید شما: {{$code}}</h6>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
