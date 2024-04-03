@extends('agency.master')
@section('script')
@endsection
@section('content')
    <div class="main">
        <div class="d-flex align-items-center justify-content-between">
            <h4>لیست آگهی ها</h4>
            <a href="{{ route('advertises.create') }}" class="btn btn-blue">ایجاد آگهی جدید</a>
        </div>

        <div class="adv-items">
            @foreach ($advertises as $item)
                <div class="item">
                    <div class="img">
                        <img src="{{ $item->images }}" alt="">
                    </div>
                    <div class="detail">
                        <h5>{{ $item->title }}</h5>
                        <h6>{{$item->status == 'sale' ? 'قیمت' : 'رهن'}}: {{number_format($item->price)}} تومان</h6>
                        @if ($item->rent != null)
                        <h6>اجاره: {{number_format($item->rent)}} تومان</h6>
                        @endif
                        <div class="location d-flex">
                            <i class="fa fa-map-marker"></i>
                            <span>{{ $item->city->name }} , {{ $item->area }}</span>
                        </div>
                        <div class="foot d-flex justify-content-between w-100">
                            <h6 class="text-secondary">نوع ملک : {{ $item->type }}</h6>
                            <h6><i class="fa fa-square-o"></i> مشاوره املاک {{$item->agency->name}}</h6>
                        </div>
                        <div class="btn-control d-flex">
                            <a href="{{route('advertises.edit',$item->id)}}" class="btn btn-outline-secondary mx-2">ویرایش</a>
                            <a target="_blank" href="{{route('home.advertise.show',$item->id)}}" class="btn btn-outline-secondary">مشاهده</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
