@extends('user.layouts.app')

@section('title', 'Documents')
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
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            PRI-Dokumenter
                        </h1>
                        <div class="page-header-subtitle">PRI-systemet Event Medical Services dokumentstyrings- og håndteringssystem til retningsgivende dokumenter. PRI står for Politikker, Retningslinjer og Instrukser.</div>
                    </div>
                </div>
                @include('user.document.search-form')

                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0 d-flex align-items-center">
                        
                        <li class="breadcrumb-item">
                            <a class=" d-flex align-items-center" href="{{ url('/wiki') }}">
                                <i data-feather="file"></i>&nbsp;PRI-Dokumenter
                            </a>
                        </li>
                        <i data-feather="chevron-right"></i>


                        @if ($level_one_category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/document/level-two/category/'.$level_one_category->id) }}">
                                    <i data-feather="{{ $level_one_category->icon }}"></i>&nbsp;{{ $level_one_category->name }}
                                </a>
                            </li>
                            <i data-feather="chevron-right"></i>
                        @endif


                        @if ($level_two_category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/document/level-three/category/'.$level_two_category->id) }}">
                                    <i data-feather="{{ $level_two_category->icon }}"></i>&nbsp;{{ $level_two_category->name }}
                                </a>
                            </li>
                            <i data-feather="chevron-right"></i>
                        @endif



                        @if ($level_three_category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/document/level-four/category/'.$level_three_category->id) }}">
                                    <i data-feather="{{ $level_three_category->icon }}"></i>&nbsp;{{ $level_three_category->name }}
                                </a>
                            </li>
                            <i data-feather="chevron-right"></i>
                        @endif


                        @if ($category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/document/by/category/'.$category->id) }}">
                                    <i data-feather="{{ $category->icon }}"></i>&nbsp;{{ $category->name }}
                                </a>
                            </li>
                        @endif

                    </ol>
                </nav>


            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <h2 class="mb-0 mt-5">Documents</h2>
        <hr class="mt-2 mb-4" />
        <!-- Knowledge base item-->
        @foreach ($documents as $key => $document)
            @include('user/document.document-row')
        @endforeach
    </div>

@endsection
