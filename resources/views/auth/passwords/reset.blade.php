@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('layouts.app')

@section('title', 'Reset Password')
@section('css')
   
    <style>
        body {
            background-color: #d0324a !important;
            background: url(/backend/staffering.png) bottom center repeat-x;
        }
    </style>
@endsection

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row  vh-100 d-flex justify-content-center align-items-center ">
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                            <!-- Social login form-->
                            <div class="card my-5">
                                <div class="card-header justify-content-center">
                                    <center>
                                        <img style="width: 150px; margin: 0 auto" src="{{ asset('backend/logo/'.$setting->logo) }}">
                                    </center>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body p-5">
                                    <!-- Login form-->
                                    
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">



                                        <div class="mb-3">
                                            <label class="text-gray-600 small">E-Mail Address</label>
                                            <input id="email" readonly type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label class="text-gray-600 small">Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>

                                        <div class="mb-3">
                                            <label class="text-gray-600 small">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>




                                   
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection