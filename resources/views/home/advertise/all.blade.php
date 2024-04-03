@extends('home.master')
@section('script')
    <script>
        function toggleitems(params) {
            var status = $(".body-side #item-" + params + " .inner").css('display');
            if (status == 'none') {
                $(".body-side .item .inner").hide();
               $(".body-side #item-" + params + " .inner").show();
            } else {
                $(".body-side .item .inner").hide();
            }
        }
    </script>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="d-lg-flex align-items-center justify-content-between">
            <h3>نتیجه جستجو</h3>
            <h5>
                (
                @if (request('name') && request('kind'))
                    @if (request('kind') == 'area')
                        محله {{ request('name') }} -
                    @else
                        شهر {{ request('name') }} -
                    @endif
                @endif
                {{ request('type') == 'sale' ? 'خرید' : 'رهن و اجاره' }}
                )
            </h5>
        </div>
        <div class="d-lg-flex justify-content-between mt-5">
            <div class="body-side">
                <h5>فیلتر آگهی ها</h5>
                <form action="/avertises" method="get">
                    <input type="hidden" name="kind" value="{{ request('kind') }}">
                    <input type="hidden" name="name" value="{{ request('name') }}">
                    <input type="hidden" name="type" value="{{ request('type') }}">

                    <div class="item" id="item-1">
                        <div class="head" onclick="toggleitems(1)">
                            <span>متراژ</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="inner" style="display: {{ request('min-meter') != null ? 'block' : 'none' }}">
                            <div
                                class="inputs d-flex justify-content-between">
                                <input class="col-5" name="min-meter" value="{{ request('min-meter') }}"
                                    placeholder="حداقل متراژ" type="number">
                                <span>تا</span>
                                <input class="col-5" name="max-meter" value="{{ request('max-meter') }}"
                                    placeholder="حداکثر متراژ" type="number">
                            </div>
                        </div>
                    </div>

                    <div class="item" id="item-2">
                        <div class="head" onclick="toggleitems(2)">
                            <span>نوع کاربری</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="inner" style="display: {{ request('typee') != null ? 'block' : 'none' }}">
                            <div class="inputs radio-box">
                                <div class="d-flex mt-3">
                                    <input {{request('typee') == '' ? 'checked' : ''}} type="radio" name="typee" value="">
                                    <span style="margin-right: 5px;margin-top:5px">همه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('typee') == 'مسکونی' ? 'checked' : ''}} type="radio" name="typee" value="مسکونی">
                                    <span style="margin-right: 5px;margin-top:5px">مسکونی</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('typee') == 'تجاری' ? 'checked' : ''}} type="radio" name="typee" value="تجاری">
                                    <span style="margin-right: 5px;margin-top:5px">تجاری</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('typee') == 'اداری' ? 'checked' : ''}} type="radio" name="typee" value="اداری">
                                    <span style="margin-right: 5px;margin-top:5px">اداری</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('typee') == 'صنعتی' ? 'checked' : ''}} type="radio" name="typee" value="صنعتی">
                                    <span style="margin-right: 5px;margin-top:5px">صنعتی</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item" id="item-3">
                        <div class="head" onclick="toggleitems(3)">
                            <span>تعداد خواب</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="inner" style="display: {{ request('room') != null ? 'block' : 'none' }}">
                            <div class="inputs radio-box">
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '' ? 'checked' : ''}} type="radio" name="room" value="">
                                    <span style="margin-right: 5px;margin-top:5px">همه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '0' ? 'checked' : ''}} type="radio" name="room" value="0">
                                    <span style="margin-right: 5px;margin-top:5px">0 خوابه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '1' ? 'checked' : ''}} type="radio" name="room" value="1">
                                    <span style="margin-right: 5px;margin-top:5px">1 خوابه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '2' ? 'checked' : ''}} type="radio" name="room" value="2">
                                    <span style="margin-right: 5px;margin-top:5px">2 خوابه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '3' ? 'checked' : ''}} type="radio" name="room" value="3">
                                    <span style="margin-right: 5px;margin-top:5px">3 خوابه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '4' ? 'checked' : ''}} type="radio" name="room" value="4">
                                    <span style="margin-right: 5px;margin-top:5px">4 خوابه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '5' ? 'checked' : ''}} type="radio" name="room" value="5">
                                    <span style="margin-right: 5px;margin-top:5px">5 خوابه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('room') == '+6' ? 'checked' : ''}} type="radio" name="room" value="+6">
                                    <span style="margin-right: 5px;margin-top:5px">+6 خوابه</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item" id="item-4">
                        <div class="head" onclick="toggleitems(4)">
                            <span>امکانات</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="inner" style="display: {{ request('options') != null ? 'block' : 'none' }}">
                            <div class="inputs radio-box">
                                <div class="d-flex mt-3">
                                    <input {{request('options') == '' ? 'checked' : ''}} type="radio" name="options" value="">
                                    <span style="margin-right: 5px;margin-top:5px">همه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'پارکینگ' ? 'checked' : ''}} type="radio" name="options" value="پارکینگ">
                                    <span style="margin-right: 5px;margin-top:5px">پارکینگ</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'لابی' ? 'checked' : ''}} type="radio" name="options" value="لابی">
                                    <span style="margin-right: 5px;margin-top:5px">لابی</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'انباری' ? 'checked' : ''}} type="radio" name="options" value="انباری">
                                    <span style="margin-right: 5px;margin-top:5px">انباری</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'آسانسور' ? 'checked' : ''}} type="radio" name="options" value="آسانسور">
                                    <span style="margin-right: 5px;margin-top:5px">آسانسور</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'استخر' ? 'checked' : ''}} type="radio" name="options" value="استخر">
                                    <span style="margin-right: 5px;margin-top:5px">استخر</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'سونا' ? 'checked' : ''}} type="radio" name="options" value="سونا">
                                    <span style="margin-right: 5px;margin-top:5px">سونا</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'سالن ورزش' ? 'checked' : ''}} type="radio" name="options" value="سالن ورزش">
                                    <span style="margin-right: 5px;margin-top:5px">سالن ورزش</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'نگهبان' ? 'checked' : ''}} type="radio" name="options" value="نگهبان">
                                    <span style="margin-right: 5px;margin-top:5px">نگهبان</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'بالکن' ? 'checked' : ''}} type="radio" name="options" value="بالکن">
                                    <span style="margin-right: 5px;margin-top:5px">بالکن</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('options') == 'تهویه مطبوع' ? 'checked' : ''}} type="radio" name="options" value="تهویه مطبوع">
                                    <span style="margin-right: 5px;margin-top:5px">تهویه مطبوع</span>
                                </div> <div class="d-flex mt-3">
                                    <input {{request('options') == 'سالن اجتماعات' ? 'checked' : ''}} type="radio" name="options" value="سالن اجتماعات">
                                    <span style="margin-right: 5px;margin-top:5px">سالن اجتماعات</span>
                                </div> <div class="d-flex mt-3">
                                    <input {{request('options') == 'جکوزی' ? 'checked' : ''}} type="radio" name="options" value="جکوزی">
                                    <span style="margin-right: 5px;margin-top:5px">جکوزی</span>
                                </div> <div class="d-flex mt-3">
                                    <input {{request('options') == 'آنتن مرکزی' ? 'checked' : ''}} type="radio" name="options" value="آنتن مرکزی">
                                    <span style="margin-right: 5px;margin-top:5px">آنتن مرکزی</span>
                                </div> <div class="d-flex mt-3">
                                    <input {{request('options') == 'درب ریموت' ? 'checked' : ''}} type="radio" name="options" value="درب ریموت">
                                    <span style="margin-right: 5px;margin-top:5px">درب ریموت</span>
                                </div> <div class="d-flex mt-3">
                                    <input {{request('options') == 'روف گاردن' ? 'checked' : ''}} type="radio" name="options" value="روف گاردن">
                                    <span style="margin-right: 5px;margin-top:5px">روف گاردن</span>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="item" id="item-5">
                        <div class="head" onclick="toggleitems(5)">
                            <span>شرایط</span>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="inner" style="display: {{ request('conditions') != null ? 'block' : 'none' }}">
                            <div class="inputs radio-box">
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == '' ? 'checked' : ''}} type="radio" name="conditions" value="">
                                    <span style="margin-right: 5px;margin-top:5px">همه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'مشارکتی' ? 'checked' : ''}} type="radio" name="conditions" value="مشارکتی">
                                    <span style="margin-right: 5px;margin-top:5px">مشارکتی</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'معاوضه' ? 'checked' : ''}} type="radio" name="conditions" value="معاوضه">
                                    <span style="margin-right: 5px;margin-top:5px">معاوضه</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'قابل تبدیل' ? 'checked' : ''}} type="radio" name="conditions" value="قابل تبدیل">
                                    <span style="margin-right: 5px;margin-top:5px">قابل تبدیل</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'پیش فروش' ? 'checked' : ''}} type="radio" name="conditions" value="پیش فروش">
                                    <span style="margin-right: 5px;margin-top:5px">پیش فروش</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'موقعیت اداری' ? 'checked' : ''}} type="radio" name="conditions" value="موقعیت اداری">
                                    <span style="margin-right: 5px;margin-top:5px">موقعیت اداری</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'وام دار' ? 'checked' : ''}} type="radio" name="conditions" value="وام دار">
                                    <span style="margin-right: 5px;margin-top:5px">وام دار</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'نوساز' ? 'checked' : ''}} type="radio" name="conditions" value="نوساز">
                                    <span style="margin-right: 5px;margin-top:5px">نوساز</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'قدر السهم' ? 'checked' : ''}} type="radio" name="conditions" value="قدر السهم">
                                    <span style="margin-right: 5px;margin-top:5px">قدر السهم</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'پاساژ' ? 'checked' : ''}} type="radio" name="conditions" value="پاساژ">
                                    <span style="margin-right: 5px;margin-top:5px">پاساژ</span>
                                </div>
                                <div class="d-flex mt-3">
                                    <input {{request('conditions') == 'مال' ? 'checked' : ''}} type="radio" name="conditions" value="مال">
                                    <span style="margin-right: 5px;margin-top:5px">مال</span>
                                </div>

                               
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-purple mt-3">اعمال فیلتر</button>

                </form>

            </div>
            <div class="body-main adv-items">
                @foreach ($advertises as $item)
                    <a href="{{route('home.advertise.show',$item->id)}}" class="item">
                        <div class="img">
                            <img src="{{ $item->images }}" alt="">
                        </div>
                        <div class="detail">
                            <h5>{{ $item->title }}</h5>
                            <h6>{{ $item->status == 'sale' ? 'قیمت' : 'رهن' }}: {{ number_format($item->price) }}</h6>
                            @if ($item->rent != null)
                                <h6>اجاره: {{ number_format($item->rent) }}</h6>
                            @endif
                            <div class="location d-flex">
                                <i class="fa fa-map-marker"></i>
                                <span>{{ $item->city->name }} , {{ $item->area }}</span>
                            </div>
                            <div class="foot d-flex justify-content-between w-100">
                                <h6 class="text-secondary">نوع ملک : {{ $item->type }}</h6>
                                <h6><i class="fa fa-square-o"></i> مشاوره املاک {{ $item->agency->name }}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
@endsection
