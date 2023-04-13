@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.layouts')
@section('title', 'Vælg interface')
@section('content')
    <!-- Welcome Start -->
    <div class="content-body">
        <div class="container vh-100">
            <div class="welcome-area">
                <div class="welcome-logo">
                    <img style="width: 150px; margin: 0 auto" src="{{ asset('backend/logo/'.$setting->logo) }}">
                </div>
                <div class="join-area">
                    <div class="started">
                        <h2>Vælg interface</h2>
                        <p>Du skal her vælge hvilket interface du ønsker at indlæse.</p>
                    </div>

                    <a href="{{ url('/pwa') }}" class="card h-auto">
                        <div class="d-flex align-items-center">
                            <img style="width: 60px !important; height: 60px !important" src="{{ asset('assets/images/welcome/smartphone.png') }}" alt="">
                            <div class="ms-4">
                                <h5>Mobilapplikation</h5>
                                <p>Dette er vores mobil optimerede interface.</p>
                            </div>
                        </div>    
                    </a>

                    <a href="{{ url('/dashboard') }}" class="card h-auto">
                        <div class="d-flex align-items-center">
                            <img style="width: 60px !important; height: 60px !important" src="{{ asset('assets/images/welcome/desktop-icon.png') }}" alt="">
                            <div class="ms-4">
                                <h5>Administration</h5>
                                <p>Dette er administrationsinterfacet.</p>
                            </div>
                        </div>
                    </a>
                    <a href="javascript::" class="card h-auto">
                        <div class="d-flex align-items-center">
                            <img style="width: 60px !important; height: 60px !important" src="{{ asset('assets/images/welcome/medical.png') }}" alt="">
                            <div class="ms-4">
                                <h5>Præhospital Patientjournal</h5>
                                <p>Dette er vores PPJ interface.</p>
                            </div>
                        </div>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Welcome End -->
@endsection