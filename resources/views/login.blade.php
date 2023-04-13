@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp


@extends('pwa.layouts.layouts')
@section('title', 'Log ind')
@section('content')
<!-- Page Content -->
<div class="page-content">
    
    <!-- Banner -->
    <div class="banner-wrapper shape-1">
        <div class="container inner-wrapper">
            <h2 class="dz-title">Log ind</h2>
            <p class="mb-0">Velkommen til Event Medical Services intranet</p>
        </div>
    </div>
    <!-- Banner End -->
    
    <div class="container">
        <div class="account-area">
             <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="input-group">
                    <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Adgangskode" name="password" value="{{ old('password') }}" id="dz-password" class="form-control be-0" required="">
                    <span class="input-group-text show-pass"> 
                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
                <a href="{{ url('password/reset') }}" class="btn-link text-center">Glemt adgangskode ?</a>

                <center>
                    <img style="width: 250px; margin: 0 auto" src="{{ asset('backend/logo/'.$setting->logo) }}">
                </center>

                <div class="input-group d-none">
                    <button id="login" type="submit" class="btn mt-2 btn-primary w-100 btn-rounded">Login</a>
                </div>
            </form>
            {{-- <div class="text-center p-tb20">
                <span class="saprate">Or sign in with</span>
            </div>
            <div class="social-btn-group text-center">
                <a href="https://www.google.com/" target="_blank" class="social-btn"><img src="assets/images/social/google.png" alt="socila-image"></a>
                <a href="https://www.facebook.com/" target="_blank" class="social-btn ms-3"><img src="assets/images/social/facebook.png" alt="social-image"></a>
            </div> --}}
        </div>
    </div>
</div>
<!-- Page Content End -->

<!-- Footer -->
<footer class="footer fixed">
    <div class="container">
        <label for="login" class="btn mt-2 btn-primary w-100 btn-rounded d-block">Log ind</label>
    </div>
</footer>
<!-- Footer End -->
@endsection