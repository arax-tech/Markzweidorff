@extends('user.layouts.app')

@section('title', 'Documen Sub Category')
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
                            <a class=" d-flex align-items-center" href="{{ url('/document/categories') }}">
                                <i data-feather="file"></i>&nbsp;PRI-Dokumenter
                            </a>
                        </li>
                        <i data-feather="chevron-right"></i>
                        <li class="breadcrumb-item">
                            <a class=" d-flex align-items-center" href="{{ url('/document/level-two/category/'.$parnet_category->id) }}">
                                <i data-feather="{{ $parnet_category->icon }}"></i>&nbsp;{{ $parnet_category->name }}
                            </a>
                        </li>
                        <i data-feather="chevron-right"></i>
                        <li class="breadcrumb-item active d-flex align-items-center"> <i data-feather="{{ $category->icon }}"></i>&nbsp;{{ $category->name }}</li>

                    </ol>
                </nav>

                
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <h4 class="mb-0 mt-5">Categories</h4>
        <hr class="mt-2 mb-4" />


        <div class="row">

            @foreach ($sub_categories as $category)
                <div class="col-lg-4 mb-4">
                    <!-- Knowledge base category card 1-->
                    <a class="card lift lift-sm h-100" href="{{ url('/document/level-four/category/' . $category->id) }}">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-2">
                                <i class="me-2" data-feather="{{ $category->icon }}"></i>
                                {{ $category->name }}
                            </h5>
                            <p class="card-text mb-1">{{ $category->description }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="small text-muted">
                                {{ DB::Table('categories')->whereIn('parent_id', [$category->id])->count() }} sub categories & {{ DB::Table('documents')->where('category', $category->id)->count() }} documents  

                                {{-- {{ DB::Table('documents')->where('category', $category->id)->count() }} documents in this --}}
                                category 
                                
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach



            <div class="ol-lg-12 mb-4"">
                @if ($documents)
                    <h2 class="mb-0 mt-5">Documents</h2>
                    <hr class="mt-2 mb-4" />
                    <!-- Knowledge base item-->
                    @foreach ($documents as $key => $document)
                        @include('user/document.document-row')
                    @endforeach
                @endif
            </div>





            


        </div>

        

    </div>

@endsection
