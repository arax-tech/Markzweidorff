@extends('user.layouts.app')

@section('title', 'News')
@section('css')
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
                            <div class="page-header-icon"><i data-feather="volume-2"></i></div>
                            News
                        </h1>
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
                            <div class="dropdown">
                                @if (in_array("All", $permission) OR in_array("NewsCreate", $permission))
                                    <a href="{{ url('/news/create') }}" class="btn btn-primary btn-sm"><i class="me-1" data-feather="folder-plus"></i> &nbsp;Create News</a>
                                @endif  
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="newsDatatable">
                            <thead>
                                <tr>
                                    <th>Pdf</th>
                                    <th>Author</th>
                                    <th>Title </th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Send Email</th>
                                    <th>Groups </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($news as $new)
                                    <tr>                                       
                                        <td>
                                            @if ($new->document !== null)
                                                <a target="_blank" href="{{ asset('backend/news/document/'.$new->document) }}">View</a>
                                            @else
                                                Null
                                            @endif
                                        </td>
                                        <td>{{ $new->author }}</td>
                                        <td>{{ $new->title }}</td>
                                        <td>{{ date('d M Y', strtotime($new->date)) }}</td>
                                        <td>{{ $new->status }}</td>
                                        <td>{{ $new->send_email == "" ? "No" : "Yes" }}</td>
                                        <td>
                                            @if ($new->status == "All Groups")
                                                --
                                            @else
                                                @php
                                                    error_reporting(0);
                                                    $groups_ids = $new->groups;
                                                    $arr = explode(",", $groups_ids);
                                                @endphp


                                                @foreach ($arr as $gp)
                                                
                                                    @php

                                                        $group1 = DB::table('user_groups')->where('id',$gp)->first();
                                                    @endphp
                                                    
                                                        <span style="background: {{ $group1->background }} !important; color: {{ $group1->color }} !important; margin-top: 5px;" class="badge">
                                                            {{ $group1->name }}
                                                           
                                                        </span>
                                                            
                                                @endforeach
                                            @endif
                                        </td>                                        
                                        <td>
                                            @if (in_array("All", $permission) OR in_array("NewsUpdate", $permission))
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/news/edit/'.$new->id) }}"><i data-feather="edit"></i></a>
                                            @endif
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/news/view/'.$new->id) }}"><i data-feather="eye"></i></a>
                                            @if (in_array("All", $permission) OR in_array("NewsDelete", $permission))
                                                <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/news/delete/'.$new->id) }}"><i data-feather="trash-2"></i></a>
                                            @endif
                                        </td>                                        
                                    </tr>



                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
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
@endsection

