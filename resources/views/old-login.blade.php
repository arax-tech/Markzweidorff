@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('layouts.app')

@section('title', 'Log ind')
@section('css')
    <style>
        body {
            background-color: #d0324a !important;
            background: url(/backend/staffering.png) bottom center repeat-x;
        }
    </style>
    <style type="text/css">
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgb(247 88 112 / 30%) !important;
        }
    </style>
@endsection

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row vh-100 d-flex justify-content-center align-items-center">
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
                                    <form method="POST" action="{{ url('/login') }}">
                                        @csrf
                                        
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="text-gray-600 small">E-mail</label>
                                            <input class="form-control form-control-solid" type="email" name="email"
                                                required />
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="mb-3">
                                            <label class="text-gray-600 small">Adgangskode</label>
                                            <input class="form-control form-control-solid" type="password"
                                                name="password" />
                                        </div>
                                        <!-- Form Group (forgot password link)-->
                                        <div class="mb-3"><a class="small" href="{{ url('password/reset') }}">Glemt adgangskode?</a></div>
                                        <!-- Form Group (login box)-->
                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                            <div class="form-check">

                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Log ind</button>
                                        </div>
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
