@extends('user.layouts.app')

@section('title', 'Create News')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
        .dataTable-search {
            float: left !important;
        }
        .dataTable-input {
           width: 300px;
           background-color: #F8F8F9;
        }
        .dataTable-dropdown {
           float: right !important;
        }
    </style>    
    <style type="text/css">

        .select2-container--default .select2-selection--single{
          background-color: #fff !important;
          border: 0.0625rem solid #f8f8f8 !important;
          padding: 0.1rem 1.25rem !important;
          color: #6e6e6e !important;
          height: 2.88rem !important;
          border: 1px solid #c5ccd6 !important;

          border-radius: 0rem 0.35rem 0.35rem 0rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered{
          line-height: 40px !important;
          color: #69707a;
          font-size: 0.9rem !important;
        }
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
          color: #69707a !important;
          font-size: 0.9rem !important;
        }
        .select2-results__option{
          color: #69707a !important;
          font-size: 0.9rem !important;
        }
        .select2-results__option--selectable{
          color: #000 !important;
          font-size: 0.9rem !important;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
            background: #f53b57 !important;
            color: #fff !important;
        }
        .select2-container .select2-selection--single .select2-selection__rendered{
          padding-left: 0px !important
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
          top: 10px !important;
          right: 13px !important;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field{
            outline: none !important;
        }




        .select2-container--default.select2-container--focus .select2-selection--multiple{
          background-color: #fff !important;
          border: 0.0625rem solid #f8f8f8 !important;
          padding: 0.1rem 1.25rem !important;
          color: #6e6e6e !important;
          height: 2.88rem !important;
          border: 1px solid #c5ccd6 !important;

          border-radius: 0.35rem !important;
        }
        .select2-container .select2-selection--multiple{
          background-color: #fff !important;
          border: 0.0625rem solid #f8f8f8 !important;
          padding: 0.1rem 1.25rem !important;
          color: #6e6e6e !important;
          height: 2.88rem !important;
          border: 1px solid #c5ccd6 !important;

          border-radius: 0.35rem !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            margin-top: 10px !important;
            background-color: #f2f2f2 !important;
            border: 1px solid lightgray !important;
            font-size: 12px !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice:first-child{
            margin-left: -10px !important;
        }
        .input{padding: 1rem 1.125rem !important;}
    </style>
    

@endsection
@php
    error_reporting(0);
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp


@section('content')    
    <header id="leftMargin" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="@if (auth::user()->sidebar == "Show") padding-left: 240px ; @endif top: 58px ;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="plus"></i></div>
                            Create News
                        </h1>
                    </div>                    
                </div>
            </div>
        </div>
    </header>
    <br><br><br>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Create News
                        <span class="float-end">
                            <div class="dropdown">
                                <a href="{{ url('/news') }}" class="btn btn-primary btn-sm"><i class="me-1" data-feather="arrow-left"></i> &nbsp;Back</a>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('news/store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row gx-3 mb-3">
                            
                                <div class="col-md-6">
                                    <label class="small mb-1">Title</label>
                                    <input class="form-control input" type="text" name="title" required />
                                </div>
                           
                                <div class="col-md-2">
                                    <label class="small mb-1">Date</label>
                                    <input class="form-control" type="date" name="date" required />
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1">Status</label>
                                    <select class="form-control input" name="status" required>
                                        <option value="All Groups">All Groups</option>
                                        <option value="Specific Groups">Specific Groups</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1">Send Email ?</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" id="Send" value="Yes" type="checkbox" name="send_email">
                                        <label class="form-check-label" for="Send">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Document</label>
                                    <input class="form-control" style="padding: 0.95rem 1.125rem !important;" type="file" name="document" />
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Groups</label>
                                    <select class="form-control custom-select" name="groups[]" id="groups" multiple>
                                        @foreach ($groups as $group)
                                            <option  value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1">Content</label>
                                    <textarea name="content" required></textarea>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"><i class="me-1" data-feather="plus"></i> &nbsp;Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.custom-select').select2();
        });
    </script>
    <script>
        $(function () {
            new simpleDatatables.DataTable("#newsDatatable", {
                labels: {
                    placeholder: "Søg efter news...",
                    perPage: "News pr. side &nbsp;  {select}",
                    noRows: "Ingen news matchede din søgning!",
                    info: "Viser {start} til {end} af {rows} news",
                    noResults: "Ingen resultater matchede din søgning!"
                },
            });
        });
    </script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
    
    
@endsection

