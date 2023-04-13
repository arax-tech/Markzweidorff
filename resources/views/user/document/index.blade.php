@extends('user.layouts.app')

@section('title', 'PRI - Dokumenter')
@section('css')
    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
    </style>
@endsection
@php
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp
@section('content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="padding-left: 240px !important; top: 58px !important;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            PRI - Dokumenter
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        @if (in_array("All", $permission) OR in_array("UserManageCategoryView", $permission))
                        <a class="btn btn-sm btn-light text-primary" href="{{ url('/wiki/category') }}" >
                            <i class="me-1" data-feather="list"></i>
                            Kategorier
                        </a>
                        @endif

                        
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
                            @if (in_array("All", $permission) OR in_array("UserDocumentListCreate", $permission))
                                <a class="btn btn-sm btn-primary" href="{{ url('/wiki/list/create') }}" >
                                    <i class="me-1" data-feather="plus"></i>
                                    Opret
                                </a>
                            @endif
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>

                                    <th>Titel</th>
                                    <th>Kategori</th>
                                    <th>Brugergrupper</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($documents as $key => $document)
                                    <tr>
                                         <td>
                                            <a href="{{ url('/wiki/view/'.$document->id) }}">
                                                <i data-feather="{{ $document->icon }}"></i>&nbsp;{{ mb_strimwidth($document->title, 0, 50, "...") }}
                                            </a>
                                        </td>

                                        <td>
                                            @php
                                                $check = DB::table('categories')->where('id', $document->category)->count();
                                            @endphp
                                            @if ($check > 0)
                                                <a href="{{ url('/document/category') }}">
                                                    @php
                                                        error_reporting(0);
                                                       
                                                        $category = DB::table('categories')->where('id', $document->category)->first();
                                                    @endphp
                                                    <i data-feather="{{ $category->icon }}"></i>&nbsp;
                                                    {{ $category->name }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>
                                            

                                            @php
                                                error_reporting(0);
                                                $groups_ids = $document->group_id;
                                                $arr = explode(",", $groups_ids);
                                                
                                                
                                            @endphp


                                            @foreach ($arr as $gp)
                                            
                                                @php

                                                    $group1 = DB::table('user_groups')->where('id',$gp)->first();
                                                @endphp
                                                
                                                    <span style="background: {{ $group1->background }} !important; color: {{ $group1->color }} !important;" class="badge">
                                                        {{ $group1->name }}
                                                       
                                                    </span>
                                                        
                                            @endforeach


                                        </td>
                                        {{-- <td><i data-feather="{{ $document->icon }}"></i></td> --}}
                                        {{-- <td>
                                            @if ($document->status == "Read Understood")
                                                 <span class="badge bg-success text-white rounded-pill p-1">{{ $document->status }}</span>
                                            @elseif ($document->status == "Read Not Understood")
                                                 <span class="badge bg-danger text-white rounded-pill p-1">{{ $document->status }}</span>
                                            @else
                                                 <span class="badge bg-secondary text-white rounded-pill p-1">{{ $document->status }}</span>
                                            @endif
                                        </td> --}}

                                        <td>
                                            @if (in_array("All", $permission) OR in_array("UserDocumentListUpdate", $permission))
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/wiki/list/edit/'.$document->id) }}"><i data-feather="edit"></i></a>
                                            @endif
                                             
                                             
                                            @if (in_array("All", $permission) OR in_array("UserDocumentListDelete", $permission))
                                                <a onclick="return confirm('Er du sikker på at du vil slette dette dokument ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/wiki/list/delete/'.$document->id) }}"><i data-feather="trash-2"></i></a>
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
<script type="text/javascript">


    $(function () {
      new simpleDatatables.DataTable("#asdffsdfdsf", {
            labels: {
                placeholder: "Søg...",
                perPage: "{select} pr. side",
                noRows: "Ingen resultater matchede din søgning!",
                info: "Viser {start} til {end} af {rows}",
                noResults: "Ingen resultater matchede din søgning!"
            },
            // ...
        });
    })
</script>
@endsection

