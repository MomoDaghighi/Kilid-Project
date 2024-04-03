<header>
    <div class="container d-flex justify-content-between align-items-center py-2">
        <div class="link">
            <a href="/">خانه</a>
        </div>
        <div class="logo col-5 d-none d-md-block">
            <img src="{{ asset('img/logo/logo.png') }}" alt="">
        </div>
        <div class="d-flex align-items-center">
            @if (auth()->user())
                @if (auth()->user()->level == 'agency')
                    <div class="d-flex login-link">
                        <a href="/agency">ورود به پنل آزانس</a>
                    </div>
                @else
                    <div class="d-flex login-link">
                        <a href="/panel">ورود به پنل کاربری</a>
                    </div>
                @endif
            @else
                <div class="d-flex login-link">
                    <a href="/login">ورود</a>
                    <span>/</span>
                    <a href="/register">ثبت نام</a>
                </div>
            @endif

            @if (auth()->user())
                @if (auth()->user()->level == 'agency')
                    <a href="/agency/advertises" class="btn btn-outline-secondary" style="margin-right: 30px">ثبت آگهی
                        مشاورین</a>
                @endif
            @else
                <a href="/login?level=agency" class="btn btn-outline-secondary" style="margin-right: 30px">ثبت آگهی
                    مشاورین</a>
            @endif

        </div>
    </div>
</header>
