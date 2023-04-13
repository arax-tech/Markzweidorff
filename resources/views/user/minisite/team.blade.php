@extends('user.layouts.app')
@php
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp

@section('title', $minisite->name." - Team")
@section('css')


@endsection


@section('content')
    
    <!-- Main page content-->
    @include('user.minisite.include.header')

    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        @include('user.minisite.include.tabs')
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <h2>Comming Soon</h2>
            </div>

        </div>
    </div>


@endsection


