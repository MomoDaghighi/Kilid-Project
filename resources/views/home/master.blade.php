<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    @yield('css')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Animate.css -->
    {{-- <link rel="stylesheet" href="{{ asset('css/animate.css') }}
 "> --}}

    <!-- font.css -->
    {{-- <link rel="stylesheet" href="{{ asset('css/font.css') }}
  "> --}}

    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}
 ">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}
 ">


    <!-- select -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}
 ">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}
 ">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}
 ">


    <link rel="stylesheet" href="http://127.0.0.1:8000/css/custom.css">


    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">

    <!-- Pricing -->
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/please-wait/0.0.5/please-wait.min.css" integrity="sha512-qHOnOjE4dPoo197XSBBgRB4bcqwiJkbZhvtvX/djtgkzEYLZtI4aods6PRPTNe8Yok1/O0CZnH0SkAvXQx4Vdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> --}}

    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>


    <!-- select -->
    <!-- lighter slider-->
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">


    <title>پروژه ملک</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">


</head>


<body dir="rtl" style="background-color: rgb(255, 255, 255)">


    <div id="app">


        @include('home.section.header')

        @yield('content')



    </div>


    @include('home.section.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}


    @yield('script')


</body>

</html>
