@extends('panel.master')
@section('script')
@endsection
@section('content')
    <div class="main">
       <h4>ویرایش اطلاعات کاربری</h4>
       <form action="{{route('panel.user.update',$user->id)}}" method="POST" class="mt-5">
           @csrf
           @method('patch')
        <div class="form-style mt-3">
            <label for="">نام</label>
            <input style="margin-top: 5px" value="{{$user->fname}}" type="text" name="fname">
            @error('fname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-style mt-3">
            <label for="">نام خانوادگی</label>
            <input style="margin-top: 5px" value="{{$user->lname}}" type="text" name="lname">
            @error('lname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-style mt-3">
            <label for="">ایمیل</label>
            <input style="margin-top: 5px" value="{{$user->email}}" type="email" name="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-style mt-3">
            <label for="">شماره موبایل</label>
            <input style="margin-top: 5px" value="{{$user->phone}}" type="text" name="phone">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-purple mt-3">ویرایش</button>
       </form>
    </div>
@endsection
