<div class="side">
    <div class="profile d-flex align-items-center">
        <div class="img">
            <img src="{{asset('img/image/person-icon.png')}}" alt="">
        </div>
        @php
            $user = auth()->user()
        @endphp
        <div>
            <h6>{{$user->fname ? $user->fname : 'کاربر عزیز'}}</h6>
            <h6>{{$user->phone}}</h6>
        </div>
    </div>
    <a href="/panel" class="link">
        <i class="fa fa-dashboard"></i>
        <span>داشبورد</span>
    </a>
    <a href="{{route('panel.user.edit')}}" class="link">
        <i class="fa fa-edit"></i>
        <span>ویرایش اطلاعات کاربری</span>
    </a>
    {{-- <a href="#" class="link">
        <i class="fa fa-bookmark-o"></i>
        <span>آگهی‌های نشان شده</span>
    </a> --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <a onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" class="link">
        <i class="fa fa-sign-out"></i>
        <span>خروج</span>
    </a>
</div>