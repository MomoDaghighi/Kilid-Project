@extends('home.master')
@section('script')
    <script>
        function settext(params,param) {
            $("#search").val(params);
            $("#kind").val(param);
        }
        function searchajax() {
            var text = $("#search").val();
            $("#result").show();
            $.ajax({
                type: "get",
                url: "/search/ajax",
                data: {
                    text: text
                },
                // dataType: "dataType",
                success: function(response) {
                    // console.log(response[0]);
                    $("#result .inner-res").children().remove();
                    $.each(response[0], function(index, item) {
                        $("#result .inner-res").append(
                            `
                            <a onclick="settext('` + item + `','area')"><i class="fa fa-map-marker mx-2 text-dark"></i>محله ` + item + `</a>
                            `
                        );
                    });

                    $.each(response[1], function(index, item) {
                        $("#result .inner-res").append(
                            `
                            <a onclick="settext('` + item.name + `','city')"><i class="fa fa-map-marker mx-2 text-dark"></i>شهر ` + item.name + `</a>
                            `
                        );
                    });

                }
            });
        }


        var res = document.getElementById("result");
        var input = document.getElementById("search");

        window.onclick = function(event) {
            if (event.target != res && event.target != input) {
                res.style.display = "none";
            }
        }

        function settypesearch(params) {
            $(".search-box .type span").removeClass('active');
            $("."+params+"-btn").addClass('active');
            $("#type").val(params);
        }
    </script>
@endsection
@section('content')
    <div class="container mt-5">
        <div style="background: url({{ asset('img/image/kilid-home.webp') }})top/cover no-repeat;" class="search-cover">
            <div class="cover w-100">
                <div class="w-100">
                    <div class="title">
                        <h5 class="text-light">مسکن، یک تصمیم کیلیدی</h5>
                        <h6 class="text-light mt-3">خانه دلخواه‌تان را به کمک مشاورین متخصص کیلید پیدا کنید.</h6>
                    </div>
                    <div class="d-flex justify-content-center w-100">
                        <div class="search-box mt-4 col-xl-6 col-lg-7 col-md-10 col-11">
                            <div class="type d-flex justify-content-center">
                                <span onclick="settypesearch('sale')" class="sale-btn active">خرید</span>
                                <span class="rent-btn" onclick="settypesearch('rent')">رهن و اجاره</span>
                            </div>
                            <div class="search mt-4 w-100">
                                <label for="">شهر، منطقه یا محله را وارد کنید</label>
                                <div class="d-flex justify-content-between align-items-center w-100 mt-3">
                                    <form action="/avertises" class="d-flex justify-content-between align-items-center w-100">
                                        <input type="hidden" name="type" id="type" value="sale">
                                        <input type="hidden" name="kind" id="kind" value="">
                                        <input name="name" id="search" onkeyup="searchajax()" placeholder="مثال: نیاوران , تهران"
                                            type="text">
                                        <button>جستجو</button>
                                        <div id="result" class="result" style="display: none">
                                            <div class="inner-res w-100">
                                                {{-- <a href=""><i class="fa fa-map-marker mx-2 text-dark"></i> اصفهان</a> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
