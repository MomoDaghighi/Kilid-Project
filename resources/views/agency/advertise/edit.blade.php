@extends('agency.master')
@section('script')
    <script>
        function settype(params) {
            $(".all-form").css('display','none');
            $("#"+params+"-div").css('display','block');
            $(".select-type a").removeClass('active');
            $(".btn-"+params).addClass('active');
        }
        $('#options-sale').select2({
            'placeholder': 'امکانات را انتخاب کنید',
            tags: true,

        });
        $('#conditions-sale').select2({
            'placeholder': 'شرایط را انتخاب کنید',
            tags: true,

        });

        $('#options').select2({
            'placeholder': 'امکانات را انتخاب کنید',
            tags: true,

        });
        $('#conditions').select2({
            'placeholder': 'شرایط را انتخاب کنید',
            tags: true,

        });
    </script>
    <script>
        function uploadimgsale() {
            $("#uploadform-sale").submit();
        }
        $("#uploadform-sale").submit(function(e) {
            e.preventDefault();
            var img = $("#imagessale")[0].files[0];
            var form = $(this);
            var actionUrl = form.attr('action');
            let formData = new FormData();
            $.each(form.serializeArray(), function(key, input) {
                formData.append(input.name, input.value);
            });
            formData.append('images', img);

            $.ajax({
                type: "POST",
                url: actionUrl,
                //data: form.serialize(), // serializes the form's elements.
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var imgnumber = $("#imagenumber-sale").val();
                    $("#images-list-sale").append(`
                    <div style="width:150px" class="text-center">
                    <img src="`+data+`" class="w-100" alt="">
                    <input type="hidden" name="images[`+imgnumber+`]" value="`+data+`">
                    <input class="mt-2" type="radio" name="main" value="`+data+`">
                    </div>
                    `);
                    $("#imagenumber-sale").val(parseInt(imgnumber)+1);
                    // console.log(data);
                },
                error: function(data) {
                    //     $("#form-user-edit-status").children().remove();
                    //     $.each(data['responseJSON'], function(indexInArray, valueOfElement) {
                    //         $("#form-user-edit-status").append(`
                // <h6 class="text-danger mt-2">` + valueOfElement + `</h6>
                // `);
                    //     });
                },

            });

        });

        function uploadimg() {
            $("#uploadform").submit();
        }
        $("#uploadform").submit(function(e) {
            e.preventDefault();
            var img = $("#images")[0].files[0];
            var form = $(this);
            var actionUrl = form.attr('action');
            let formData = new FormData();
            $.each(form.serializeArray(), function(key, input) {
                formData.append(input.name, input.value);
            });
            formData.append('images', img);

            $.ajax({
                type: "POST",
                url: actionUrl,
                //data: form.serialize(), // serializes the form's elements.
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var imgnumber = $("#imagenumber").val();
                    $("#images-list").append(`
                    <div style="width:150px" class="text-center">
                    <img src="`+data+`" class="w-100" alt="">
                    <input type="hidden" name="images[`+imgnumber+`]" value="`+data+`">
                    <input class="mt-2" type="radio" name="main" value="`+data+`">
                    </div>
                    `);
                    $("#imagenumber").val(parseInt(imgnumber)+1);
                    // console.log(data);
                },
                error: function(data) {
                    //     $("#form-user-edit-status").children().remove();
                    //     $.each(data['responseJSON'], function(indexInArray, valueOfElement) {
                    //         $("#form-user-edit-status").append(`
                // <h6 class="text-danger mt-2">` + valueOfElement + `</h6>
                // `);
                    //     });
                },

            });

        });

        $("#fullprice").change(function(e) {
            var status = $("#fullprice").is(":checked");
            if (status == true) {
                $("#rent-div #rent").prop('disabled', true);
                $("#rent-div #rent").val('');

                $("#rent-div #rent").css('background-color', 'rgb(241, 241, 241)');
            } else {
                $("#rent-div #rent").prop('disabled', false);
                $("#rent-div #rent").css('background-color', 'transparent');
            }


        });
    </script>
@endsection
@section('content')
    <div class="main">

        <form action="/agency/image/upload" id="uploadform" method="post">
            @csrf
        </form>

        <form action="/agency/image/upload" id="uploadform-sale" method="post">
            @csrf
        </form>

        <h4>ویرایش آگهی</h4>

        @if ($advertise->status == 'sale')
       
        <form action="{{ route('advertises.update',$advertise->id) }}" method="POST" class="all-form mt-5" style="display: block" id="sale-div">
            @csrf
            @method('patch')
            <input type="hidden" name="status" value="sale">
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">شهر</label>
                    <select style="margin-top: 5px" type="text" name="city_id">
                        @foreach (\App\Models\City::get() as $item)
                            <option {{$advertise->city_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">محله</label>
                    <input value="{{$advertise->area}}" style="margin-top: 5px" placeholder="محله را وارد کنید" type="text" name="area">
                    @error('area')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">قیمت</label>
                    <input style="margin-top: 5px" placeholder="قیمت کل به تومان" type="text" name="price" value="{{$advertise->price}}">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">متراژ</label>
                    <input style="margin-top: 5px" type="text" name="meter" value="{{$advertise->meter}}">
                    @error('meter')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">نوع کاربری</label>
                    <select style="margin-top: 5px" type="text" name="type">
                        <option {{$advertise->type == 'مسکونی' ? 'selected' : ''}} value="مسکونی">مسکونی</option>
                        <option {{$advertise->type == 'تجاری' ? 'selected' : ''}} value="تجاری">تجاری</option>
                        <option {{$advertise->type == 'اداری' ? 'selected' : ''}} value="اداری">اداری</option>
                        <option {{$advertise->type == 'صنعتی' ? 'selected' : ''}} value="صنعتی">صنعتی</option>

                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">تعداد خواب</label>
                    <select style="margin-top: 5px" type="text" name="room">
                        <option {{$advertise->room == '0' ? 'selected' : ''}} value="0">0 خوابه</option>
                        <option {{$advertise->room == '1' ? 'selected' : ''}} value="1">1 خوابه</option>
                        <option {{$advertise->room == '2' ? 'selected' : ''}} value="2">2 خوابه</option>
                        <option {{$advertise->room == '3' ? 'selected' : ''}} value="3">3 خوابه</option>
                        <option {{$advertise->room == '4' ? 'selected' : ''}} value="4">4 خوابه</option>
                        <option {{$advertise->room == '5' ? 'selected' : ''}} value="5">5 خوابه</option>
                        <option {{$advertise->room == '+6' ? 'selected' : ''}} value="+6">6+ خوابه</option>


                    </select>
                    @error('room')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">امکانات</label>
                    <select style="margin-top: 5px" id="options-sale" name="options[]" multiple>
                        <option {{$advertise->checkoption('پارکینگ')}} value="پارکینگ">پارکینگ</option>
                        <option {{$advertise->checkoption('لابی')}} value="لابی">لابی</option>
                        <option {{$advertise->checkoption('انباری')}} value="انباری">انباری</option>
                        <option {{$advertise->checkoption('آسانسور')}} value="آسانسور">آسانسور</option>
                        <option {{$advertise->checkoption('استخر')}} value="استخر">استخر</option>
                        <option {{$advertise->checkoption('سونا')}} value="سونا">سونا</option>
                        <option {{$advertise->checkoption('سالن ورزش')}} value="سالن ورزش">سالن ورزش</option>
                        <option {{$advertise->checkoption('نگهبان')}} value="نگهبان">نگهبان</option>
                        <option {{$advertise->checkoption('بالکن')}} value="بالکن">بالکن</option>
                        <option {{$advertise->checkoption('تهویه مطبوع')}} value="تهویه مطبوع">تهویه مطبوع</option>
                        <option {{$advertise->checkoption('سالن اجتماعات')}} value="سالن اجتماعات">سالن اجتماعات</option>
                        <option {{$advertise->checkoption('جکوزی')}} value="جکوزی">جکوزی</option>
                        <option {{$advertise->checkoption('آنتن مرکزی')}} value="آنتن مرکزی">آنتن مرکزی</option>
                        <option {{$advertise->checkoption('درب ریموت')}} value="درب ریموت">درب ریموت</option>
                        <option {{$advertise->checkoption('روف گاردن')}} value="روف گاردن">روف گاردن</option>
                    </select>
                    @error('options')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">شرایط</label>
                    <select style="margin-top: 5px" id="conditions-sale" name="conditions[]" multiple>
                        <option {{$advertise->checkcondition('مشارکتی')}} value="مشارکتی">مشارکتی</option>
                        <option {{$advertise->checkcondition('معاوضه')}} value="معاوضه">معاوضه</option>
                        <option {{$advertise->checkcondition('قابل تبدیل')}} value="قابل تبدیل">قابل تبدیل</option>
                        <option {{$advertise->checkcondition('پیش فروش')}} value="پیش فروش">پیش فروش</option>
                        <option {{$advertise->checkcondition('موقعیت اداری')}} value="موقعیت اداری">موقعیت اداری</option>
                        <option {{$advertise->checkcondition('وام دار')}} value="وام دار">وام دار</option>
                        <option {{$advertise->checkcondition('نوساز')}} value="نوساز">نوساز</option>
                        <option {{$advertise->checkcondition('قدر السهم')}} value="قدر السهم">قدر السهم</option>
                        <option {{$advertise->checkcondition('پاساژ')}} value="پاساژ">پاساژ</option>
                        <option {{$advertise->checkcondition('مال')}} value="مال">مال</option>
                    </select>
                    @error('conditions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">عنوان</label>
                    <input style="margin-top: 5px" placeholder="عنوان آگهی" type="text" name="title" value="{{$advertise->title}}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">توضیحات</label>
                    <textarea name="description" id="description" cols="30" rows="5">{{$advertise->description}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-style col-lg-6 mt-3 d-flex align-items-center">
                <label for="">تصاویر</label>
                <label for="imagessale" class="choose-img">
                    <div class="text-center">
                        <i class="fa fa-file-image-o"></i>
                        <span>افزودن تصویر</span>
                    </div>
                </label>
                <input type="file" onchange="uploadimgsale()" style="display: none" name="images" id="imagessale">
                <input type="hidden"  id="imagenumber-sale" value="{{count($advertise->galleries)}}">
            </div>
            <div class="row justify-content-around mt-3" id="images-list-sale">
                @foreach ($advertise->galleries as $item)
                <div style="width:150px" class="text-center">
                    <img src="{{$item->images}}" class="w-100" alt="">
                    <input type="hidden" name="images[{{$loop->index}}]" value="{{$item->images}}">
                    <input {{$item->main == 'yes' ? 'checked' : ''}} class="mt-2" type="radio" name="main" value="{{$item->images}}">
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-blue mt-3">ویرایش</button>
            </div>
        </form>

        @else

        <form action="{{ route('advertises.update',$advertise->id) }}" method="POST" class="all-form mt-5" style="display: block" id="rent-div">
            @csrf
            @method('patch')
            <input type="hidden" name="status" value="rent">
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">شهر</label>
                    <select style="margin-top: 5px" type="text" name="city_id">
                        @foreach (\App\Models\City::get() as $item)
                            <option {{$advertise->city_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">محله</label>
                    <input style="margin-top: 5px" placeholder="محله خود را وارد کنید" type="text" name="area" value="{{$advertise->area}}">
                    @error('area')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-style col-lg-6 mt-3 input-padding-left">
                <label for="">رهن</label>
                <div class="d-flex">
                    <input style="margin-top: 5px" placeholder="قیمت کل به تومان" type="text" name="price" value="{{$advertise->price}}">
                    <div class="d-flex col-3 align-items-center" style="margin-right: 5px">
                        <input style="width: 20px" type="checkbox" class="checkbox-s" value="fullprice" id="fullprice"
                            name="fullprice" {{$advertise->rent == null ? 'checked' : ''}}>
                        <span>رهن کامل</span>
                    </div>
                </div>
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">اجاره</label>
                    <input style="margin-top: 5px" placeholder="اجاره ماهیانه به تومان" type="text" name="rent" value="{{$advertise->rent}}"
                        id="rent" {{$advertise->rent == null ? 'disabled' : ''}}>
                    @error('rent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">متراژ</label>
                    <input style="margin-top: 5px" type="text" name="meter" value="{{$advertise->meter}}">
                    @error('meter')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">نوع کاربری</label>
                    <select style="margin-top: 5px" type="text" name="type">
                        <option {{$advertise->type == 'مسکونی' ? 'selected' : ''}} value="مسکونی">مسکونی</option>
                        <option {{$advertise->type == 'تجاری' ? 'selected' : ''}} value="تجاری">تجاری</option>
                        <option {{$advertise->type == 'اداری' ? 'selected' : ''}} value="اداری">اداری</option>
                        <option {{$advertise->type == 'صنعتی' ? 'selected' : ''}} value="صنعتی">صنعتی</option>

                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">تعداد خواب</label>
                    <select style="margin-top: 5px" type="text" name="room">
                        <option {{$advertise->room == '0' ? 'selected' : ''}} value="0">0 خوابه</option>
                        <option {{$advertise->room == '1' ? 'selected' : ''}} value="1">1 خوابه</option>
                        <option {{$advertise->room == '2' ? 'selected' : ''}} value="2">2 خوابه</option>
                        <option {{$advertise->room == '3' ? 'selected' : ''}} value="3">3 خوابه</option>
                        <option {{$advertise->room == '4' ? 'selected' : ''}} value="4">4 خوابه</option>
                        <option {{$advertise->room == '5' ? 'selected' : ''}} value="5">5 خوابه</option>
                        <option {{$advertise->room == '+6' ? 'selected' : ''}} value="+6">6+ خوابه</option>


                    </select>
                    @error('room')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">امکانات</label>
                    <select style="margin-top: 5px" id="options" name="options[]" multiple>
                        <option {{$advertise->checkoption('پارکینگ')}} value="پارکینگ">پارکینگ</option>
                        <option {{$advertise->checkoption('لابی')}} value="لابی">لابی</option>
                        <option {{$advertise->checkoption('انباری')}} value="انباری">انباری</option>
                        <option {{$advertise->checkoption('آسانسور')}} value="آسانسور">آسانسور</option>
                        <option {{$advertise->checkoption('استخر')}} value="استخر">استخر</option>
                        <option {{$advertise->checkoption('سونا')}} value="سونا">سونا</option>
                        <option {{$advertise->checkoption('سالن ورزش')}} value="سالن ورزش">سالن ورزش</option>
                        <option {{$advertise->checkoption('نگهبان')}} value="نگهبان">نگهبان</option>
                        <option {{$advertise->checkoption('بالکن')}} value="بالکن">بالکن</option>
                        <option {{$advertise->checkoption('تهویه مطبوع')}} value="تهویه مطبوع">تهویه مطبوع</option>
                        <option {{$advertise->checkoption('سالن اجتماعات')}} value="سالن اجتماعات">سالن اجتماعات</option>
                        <option {{$advertise->checkoption('جکوزی')}} value="جکوزی">جکوزی</option>
                        <option {{$advertise->checkoption('آنتن مرکزی')}} value="آنتن مرکزی">آنتن مرکزی</option>
                        <option {{$advertise->checkoption('درب ریموت')}} value="درب ریموت">درب ریموت</option>
                        <option {{$advertise->checkoption('روف گاردن')}} value="روف گاردن">روف گاردن</option>
                    </select>
                    @error('options')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">شرایط</label>
                    <select style="margin-top: 5px" id="conditions" name="conditions[]" multiple>
                        <option {{$advertise->checkcondition('مشارکتی')}} value="مشارکتی">مشارکتی</option>
                        <option {{$advertise->checkcondition('معاوضه')}} value="معاوضه">معاوضه</option>
                        <option {{$advertise->checkcondition('قابل تبدیل')}} value="قابل تبدیل">قابل تبدیل</option>
                        <option {{$advertise->checkcondition('پیش فروش')}} value="پیش فروش">پیش فروش</option>
                        <option {{$advertise->checkcondition('موقعیت اداری')}} value="موقعیت اداری">موقعیت اداری</option>
                        <option {{$advertise->checkcondition('وام دار')}} value="وام دار">وام دار</option>
                        <option {{$advertise->checkcondition('نوساز')}} value="نوساز">نوساز</option>
                        <option {{$advertise->checkcondition('قدر السهم')}} value="قدر السهم">قدر السهم</option>
                        <option {{$advertise->checkcondition('پاساژ')}} value="پاساژ">پاساژ</option>
                        <option {{$advertise->checkcondition('مال')}} value="مال">مال</option>
                    </select>
                    @error('conditions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">عنوان</label>
                    <input style="margin-top: 5px" placeholder="عنوان آگهی" type="text" name="title" value="{{$advertise->title}}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">توضیحات</label>
                    <textarea name="description" id="description" cols="30" rows="5">{{$advertise->description}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-style col-lg-6 mt-3 d-flex align-items-center">
                <label for="">تصاویر</label>
                <label for="images" class="choose-img">
                    <div class="text-center">
                        <i class="fa fa-file-image-o"></i>
                        <span>افزودن تصویر</span>
                    </div>
                </label>
                <input type="file" onchange="uploadimg()" style="display: none" name="images" id="images">
                <input type="hidden"  id="imagenumber" value="{{count($advertise->galleries)}}">
                {{-- @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
            <div class="row justify-content-around" id="images-list">
                @foreach ($advertise->galleries as $item)
                <div style="width:150px" class="text-center">
                    <img src="{{$item->images}}" class="w-100" alt="">
                    <input type="hidden" name="images[{{$loop->index}}]" value="{{$item->images}}">
                    <input {{$item->main == 'yes' ? 'checked' : ''}} class="mt-2" type="radio" name="main" value="{{$item->images}}">
                </div>
                @endforeach
                
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-blue mt-3">ثبت</button>
            </div>
        </form>

        @endif


    </div>
@endsection
