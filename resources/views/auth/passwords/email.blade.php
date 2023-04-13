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
                                <div class="card-body p-5">
                                    <!-- Login form-->


                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif



                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="text-gray-600 small">E-mail adresse</label>
                                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                           @error('email')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror
                                        </div>


                                  

                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Send nulstillingslink') }}
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













