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
                    <input class="mt-2" checked type="radio" name="main" value="`+data+`">
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
                    <input class="mt-2" checked type="radio" name="main" value="`+data+`">
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

        <h4>ایجاد آگهی جدید</h4>
        <div class="d-flex justify-content-center mt-4 select-type">
            <a onclick="settype('sale')" style="cursor: pointer" class="btn-sale active">فروش</a>
            <a onclick="settype('rent')" style="cursor: pointer" class="btn-rent">رهن و اجاره</a>
        </div>
        <form action="{{ route('advertises.store') }}" method="POST" class="all-form mt-5" style="display: block" id="sale-div">
            @csrf
            <input type="hidden" name="status" value="sale">
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">شهر</label>
                    <select style="margin-top: 5px" type="text" name="city_id">
                        @foreach (\App\Models\City::get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                    <input style="margin-top: 5px" placeholder="محله را وارد کنید" type="text" name="area">
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
                    <input style="margin-top: 5px" placeholder="قیمت کل به تومان" type="text" name="price">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">متراژ</label>
                    <input style="margin-top: 5px" type="text" name="meter">
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
                        <option value="مسکونی">مسکونی</option>
                        <option value="تجاری">تجاری</option>
                        <option value="اداری">اداری</option>
                        <option value="صنعتی">صنعتی</option>

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
                        <option value="0">0 خوابه</option>
                        <option value="1">1 خوابه</option>
                        <option value="2">2 خوابه</option>
                        <option value="3">3 خوابه</option>
                        <option value="4">4 خوابه</option>
                        <option value="5">5 خوابه</option>
                        <option value="+6">6+ خوابه</option>


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
                        <option value="پارکینگ">پارکینگ</option>
                        <option value="لابی">لابی</option>
                        <option value="انباری">انباری</option>
                        <option value="آسانسور">آسانسور</option>
                        <option value="استخر">استخر</option>
                        <option value="سونا">سونا</option>
                        <option value="سالن ورزش">سالن ورزش</option>
                        <option value="نگهبان">نگهبان</option>
                        <option value="بالکن">بالکن</option>
                        <option value="تهویه مطبوع">تهویه مطبوع</option>
                        <option value="سالن اجتماعات">سالن اجتماعات</option>
                        <option value="جکوزی">جکوزی</option>
                        <option value="آنتن مرکزی">آنتن مرکزی</option>
                        <option value="درب ریموت">درب ریموت</option>
                        <option value="روف گاردن">روف گاردن</option>
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
                        <option value="مشارکتی">مشارکتی</option>
                        <option value="معاوضه">معاوضه</option>
                        <option value="قابل تبدیل">قابل تبدیل</option>
                        <option value="پیش فروش">پیش فروش</option>
                        <option value="موقعیت اداری">موقعیت اداری</option>
                        <option value="وام دار">وام دار</option>
                        <option value="نوساز">نوساز</option>
                        <option value="قدر السهم">قدر السهم</option>
                        <option value="پاساژ">پاساژ</option>
                        <option value="مال">مال</option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
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
                    <input style="margin-top: 5px" placeholder="عنوان آگهی" type="text" name="title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">توضیحات</label>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
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
                <input type="hidden"  id="imagenumber-sale" value="0">
                {{-- @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
            <div class="row justify-content-around" id="images-list-sale">
                {{-- <div style="width:150px" class="text-center">
                    <img src="{{asset('img/logo/logo.png')}}" class="w-100" alt="">
                    <input type="hidden" name="images[0]" value="">
                    <input class="mt-2" type="radio" value="">
                </div> --}}
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-blue mt-3">ثبت</button>
            </div>
        </form>

        <form action="{{ route('advertises.store') }}" method="POST" class="all-form mt-5" style="display: none" id="rent-div">
            @csrf
            <input type="hidden" name="status" value="rent">
            <div class="d-lg-flex">
                <div class="form-style col-lg-6 mt-3 input-padding-left">
                    <label for="">شهر</label>
                    <select style="margin-top: 5px" type="text" name="city_id">
                        @foreach (\App\Models\City::get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                    <input style="margin-top: 5px" placeholder="محله خود را وارد کنید" type="text" name="area">
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
                    <input style="margin-top: 5px" placeholder="قیمت کل به تومان" type="text" name="price">
                    <div class="d-flex col-3 align-items-center" style="margin-right: 5px">
                        <input style="width: 20px" type="checkbox" class="checkbox-s" value="fullprice" id="fullprice"
                            name="fullprice">
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
                    <input style="margin-top: 5px" placeholder="اجاره ماهیانه به تومان" type="text" name="rent"
                        id="rent">
                    @error('rent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">متراژ</label>
                    <input style="margin-top: 5px" type="text" name="meter">
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
                        <option value="مسکونی">مسکونی</option>
                        <option value="تجاری">تجاری</option>
                        <option value="اداری">اداری</option>
                        <option value="صنعتی">صنعتی</option>

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
                        <option value="0">0 خوابه</option>
                        <option value="1">1 خوابه</option>
                        <option value="2">2 خوابه</option>
                        <option value="3">3 خوابه</option>
                        <option value="4">4 خوابه</option>
                        <option value="5">5 خوابه</option>
                        <option value="+6">6+ خوابه</option>


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
                        <option value="پارکینگ">پارکینگ</option>
                        <option value="لابی">لابی</option>
                        <option value="انباری">انباری</option>
                        <option value="آسانسور">آسانسور</option>
                        <option value="استخر">استخر</option>
                        <option value="سونا">سونا</option>
                        <option value="سالن ورزش">سالن ورزش</option>
                        <option value="نگهبان">نگهبان</option>
                        <option value="بالکن">بالکن</option>
                        <option value="تهویه مطبوع">تهویه مطبوع</option>
                        <option value="سالن اجتماعات">سالن اجتماعات</option>
                        <option value="جکوزی">جکوزی</option>
                        <option value="آنتن مرکزی">آنتن مرکزی</option>
                        <option value="درب ریموت">درب ریموت</option>
                        <option value="روف گاردن">روف گاردن</option>
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
                        <option value="مشارکتی">مشارکتی</option>
                        <option value="معاوضه">معاوضه</option>
                        <option value="قابل تبدیل">قابل تبدیل</option>
                        <option value="پیش فروش">پیش فروش</option>
                        <option value="موقعیت اداری">موقعیت اداری</option>
                        <option value="وام دار">وام دار</option>
                        <option value="نوساز">نوساز</option>
                        <option value="قدر السهم">قدر السهم</option>
                        <option value="پاساژ">پاساژ</option>
                        <option value="مال">مال</option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
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
                    <input style="margin-top: 5px" placeholder="عنوان آگهی" type="text" name="title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-style col-lg-6 mt-3 input-padding-right">
                    <label for="">توضیحات</label>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
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
                <input type="hidden"  id="imagenumber" value="0">
                {{-- @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
            <div class="row justify-content-around" id="images-list">
                {{-- <div style="width:150px" class="text-center">
                    <img src="{{asset('img/logo/logo.png')}}" class="w-100" alt="">
                    <input type="hidden" name="images[0]" value="">
                    <input class="mt-2" type="radio" value="">
                </div> --}}
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-blue mt-3">ثبت</button>
            </div>
        </form>


    </div>
@endsection
