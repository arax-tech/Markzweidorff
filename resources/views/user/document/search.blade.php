@extends('user.layouts.app')

@section('title', 'PRI › Søgning')
@section('css')
    <style>
    .breadcrumb-item + .breadcrumb-item::before{content: '' !important}

    </style>
@endsection

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="text-uppercase-expanded fw-500" style="color: #fff; font-size: 1.55rem;">
                            <button class="btn btn-light btn-icon" type="button" onclick="window.history.go(-1); return false;"><i data-feather="arrow-left"></i></button> 
                            
                            PRI-Søgning
                        </h1>
                    </div>
                </div>
                @include('user.document.search-form')

                


            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <h2 class="mb-0 mt-5">Resultat(er)</h2>
        <hr class="mt-2 mb-4" />
        <!-- Knowledge base item-->
        @foreach ($search as $key => $document)
            @include('user/document.document-row')
        @endforeach
    </div>

@endsection
