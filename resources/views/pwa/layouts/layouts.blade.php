@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp


<!DOCTYPE html>
<html lang="da">
<head>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Title -->
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Racing+Sans+One&display=swap" rel="stylesheet">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('assets/manifest.json') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    @yield('css')
    <style type="text/css">
        .tata-title{color: #fff !important};
    </style>

</head>   
<body>
<div class="page-wraper" data-theme-color="color-red">

    <!-- Preloader -->
    {{-- <div id="preloader">
        <div class="spinner"></div>
    </div> --}}
    <div class="loader-screen" id="splashscreen">
        <div class="main-screen"></div>
        <div class="logo-icon">
            <div class="wow slideInDown" data-wow-duration="10.5s" data-wow-delay="10.5s">
                <img style="width: 150px; margin: 0 auto" src="{{ asset('backend/logo/'.$setting->logo) }}">
            </div>
        </div>
    </div>
    <!-- Preloader end-->

    @yield('content')
</div>
<!--**********************************
    Scripts
***********************************-->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>


<script src="{{ asset('/toaster/dist/tata.js') }}"></script>

@yield('js')
    
@if (Session::has('flash_message_error'))
    <script>
        tata.error('Fejl...', '{!! session('flash_message_error') !!}', {
          position: 'tr',
          duration: 7000,
          animate: 'slide'
        })
    </script>
@endif

@if (Session::has('flash_message_success'))
    <script>
        tata.success('Udført...', '{!! session('flash_message_success') !!}', {
          position: 'tr',
          duration: 7000,
          animate: 'slide'
        })

    </script>
@endif
</body>
</html>