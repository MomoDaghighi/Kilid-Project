@extends('home.master')
@section('script')
@endsection
@section('content')
    <div class="container mt-5 show-adver">
        <div class="d-lg-flex justify-content-between">

            <div id="carouselExampleIndicators" class="carousel slide col-lg-8" data-ride="carousel">
                <ol class="carousel-indicators">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($advertise->galleries as $item)
                        @php
                            $newi = $i++;
                        @endphp
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $newi }}"
                            class="{{ $newi == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @php
                        $ii = 0;
                    @endphp
                    @foreach ($advertise->galleries as $item)
                        @php
                            $newii = $ii++;
                        @endphp
                        <div class="carousel-item {{ $newii == 0 ? 'active' : '' }}">
                            <img class="carousel-img d-block w-100" src="{{ $item->images }}"
                                alt="First slide">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="col-lg-3 mt-4 mt-lg-5">
                <div class="agency">
                    <h6 style="font-weight: 900">آژانس املاک : {{ $advertise->agency->name }}</h6>
                    <h6>شهر: {{ $advertise->agency->city }}</h6>
                    <h6>کد آگهی: {{ $advertise->id }}</h6>
                    <a href="" class="mt-3 btn btn-purple w-100">شماره تماس: {{ $advertise->user->phone }}</a>

                </div>
            </div>

        </div>

        <div>
            <div class="py-4" style="border-bottom: 1px solid rgb(218, 218, 218)">
                <h5 style="font-weight: 900">{{ $advertise->title }}</h5>
                <p class="my-3">{{ $advertise->description }}</p>
                <h5><i class="fa fa-map-marker"></i>&nbsp;
                    {{ $advertise->city->name }} - {{ $advertise->area }}
                </h5>
                <div class="price my-4">
                    <h5>{{ $advertise->status == 'sale' ? 'قیمت' : 'رهن' }} :
                        {{ number_format($advertise->price) }} تومان</h5>
                    @if ($advertise->status == 'rent' && $advertise->rent != null)
                        <h5>اجاره :
                            {{ number_format($advertise->rent) }} تومان</h5>
                    @endif
                </div>
                <div class="d-flex complete-item">
                    <h6>نوع کاربری: <span>{{ $advertise->type }}</span></h6>
                    <h6>متراژ: <span>{{ $advertise->meter }} متر</span></h6>
                    <h6>تعداد اتاق خواب: <span>{{ $advertise->room }} خوابه</span></h6>
                </div>
            </div>
            <div class="py-4" style="border-bottom: 1px solid rgb(218, 218, 218)">
                <h5 style="font-weight: 900">امکانات</h5>
                <div class="row justify-content-around mt-4">
                    @foreach ($advertise->options as $item)
                        <h6 style="font-size: 18px" class="col-6"><i class="fa fa-check"></i>&nbsp; {{$item->option}}</h6>
                    @endforeach
                </div>
            </div>
            <div class="py-4">
                <h5 style="font-weight: 900">توضیحات</h5>
                <p style="font-size: 16px" class="mt-3 text-dark">{{$advertise->description}}</p>
            </div>
        </div>
    </div>
@endsection
