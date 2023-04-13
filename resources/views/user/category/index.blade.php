@extends('user.layouts.app')
@php
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp


@section('title', 'PRI › Kategorier')
@section('css')
    <style>
        .small {
            color: #31353d !important;
        }

        td {
            vertical-align: middle !important;
        }

        .border-1 {
            border: 1px solid #f2f2f2;
        }

        .bg-primary {
            background: #f53b57 !important;
        }

        .ml-5 {
            margin-left: 5% !important
        }

        .ml-10 {
            margin-left: 10% !important;
        }

        .ml-15 {
            margin-left: 15% !important;
        }

        .ml-20 {
            margin-left: 20% !important;
        }
    </style>
@endsection

@section('content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="@if (auth::user()->sidebar == "Show") padding-left: 240px !important; @endif top: 58px !important;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            PRI - Dokumenter › Kategorier
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        
                        <a class="btn btn-sm btn-light text-primary" href="{{ url('/wiki/list') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Tilbage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br><br>
    <!-- Main page content-->
    <div class="container-fluid px-4">


        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Oversigt
                        <span class="float-end">
                            @if (in_array("All", $permission) OR in_array("UserManageCategoryCreate", $permission))
                            <a class="btn btn-sm btn-primary" href="javascript::" data-bs-toggle="modal" data-bs-target="#CreateCategory">
                                <i class="me-1" data-feather="plus"></i>
                                Opret
                            </a>
                        @endif
                        </span>

                            <!-- Modal -->
                            <div class="modal fade" id="CreateCategory">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('category/store') }}">
                                                @csrf




                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Placering</label>
                                                        <select class="form-control" name="parent_id">
                                                            <option value="">Vælg...</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                                                                {{-- Level 2 --}}
                                                                @php
                                                                    error_reporting(0);
                                                                    $level2s = DB::table('categories')->where('parent_id', $category->id)->get();
                                                                @endphp
                                                                @foreach ($level2s as $level2)
                                                                    <option value="{{ $level2->id }}">--{{ $level2->name }}</option>


                                                                    {{-- Level 3 --}}
                                                                    @php
                                                                        error_reporting(0);
                                                                        $level3s = DB::table('categories')->where('parent_id', $level2->id)->get();
                                                                    @endphp
                                                                    @foreach ($level3s as $level3)
                                                                        <option value="{{ $level3->id }}">----{{ $level3->name }}</option>



                                                                        {{-- Level 4 --}}
                                                                        @php
                                                                            error_reporting(0);
                                                                            $level4s = DB::table('categories')->where('parent_id', $level3->id)->get();
                                                                        @endphp
                                                                        @foreach ($level4s as $level4)
                                                                            <option value="{{ $level4->id }}">------{{ $level4->name }}</option>

                                                                            {{-- Level 5 --}}
                                                                            @php
                                                                                error_reporting(0);
                                                                                $level5s = DB::table('categories')->where('parent_id', $level4->id)->get();
                                                                            @endphp
                                                                            @foreach ($level5s as $level5)
                                                                                <option value="{{ $level5->id }}">--------{{ $level5->name }}</option>


                                                                                {{-- Level 6 --}}
                                                                                @php
                                                                                    error_reporting(0);
                                                                                    $level6s = DB::table('categories')->where('parent_id', $level5->id)->get();
                                                                                @endphp
                                                                                @foreach ($level6s as $level6)
                                                                                    <option value="{{ $level6->id }}">----------{{ $level6->name }}</option>
                                                                                @endforeach
                                                                            @endforeach

                                                                        @endforeach
                                                                    @endforeach
                                                                @endforeach

                                                                {{-- <x-category-option :category="$category"/> --}}
                                                            @endforeach

                
                                                        </select>

                                                    </div>


                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Kategori navn</label>
                                                        <input class="form-control" type="text" name="name" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Ikon</label>
                                                        <input class="form-control" type="text" name="icon" value="folder" required />
                                                    </div>

                                                   

                                                </div>

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Beskrivelse</label>
                                                        <textarea class="form-control" name="description"></textarea>
                                                    </div>

                                                </div>





                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opret kategori</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                      

                        <div class="w-100">
                            @foreach ($categories as $category)
                                <x-category-item :category="$category"/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
