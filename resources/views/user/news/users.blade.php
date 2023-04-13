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
                            Users Readed
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
                        Users
                        <span class="float-end">
                            <div class="dropdown">
                                <a href="{{ url('/news') }}" class="btn btn-primary btn-sm"><i class="me-1" data-feather="arrow-left"></i> &nbsp;Back</a>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        @php
                            error_reporting(0);
                            $ids = explode(",", $new->views);
                            $users = DB::table('users')->whereIn('id', $ids)->get();
                            // dd($ids);
                        @endphp
                        <table class="table table-striped table-hover" id="newsDatatable">
                            <thead>
                                <tr>
                                    <th><center>Billede</center></th>
                                    <th>Navn </th>
                                    <th>Kontaktinformation</th>
                                    <th>Afdelinger </th>
                                    <th>Mikro note</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="width: 50px;" align="center">
                                            <a href="{{ url('/user/view/'.$user->id) }}">
                                                @if (!empty($user->image))
                                                    <img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/profile/'.$user->image) }}" />
                                                @else
                                                    <img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/placeholder.jpg') }}" />
                                                @endif
                                            </a>
                                        </td>
                                        <td style="min-width: 200px;">
                                            <a href="{{ url('/user/view/'.$user->id) }}">{{ $user->name }}</a> <br>
                                             @php
                                                error_reporting(0);
                                                $groups_ids = $user->group_id;
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
                                        </td>
                                        
                                        <td>
                                            @if ($user->phone)
                                                <div><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="smartphone"></i>&nbsp; {{ $user->phone }}</div>
                                            @endif
                                            @if ($user->bank_information)
                                                <div style="padding-top: 5px;"><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="phone"></i>&nbsp; {{ $user->bank_information }}</div>
                                            @endif
                                            @if ($user->email)
                                                <div style="padding-top: 5px;"><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="mail"></i>&nbsp; <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
                                            @endif

                                        </td>

                                        <td>
                                            @php
                                                error_reporting(0);
                                                $locations_ids0 = $user->location_id;
                                                $arr0 = explode(",", $locations_ids0);
                                                
                                                
                                            @endphp

                                            @if ($user->location_id != null)
                                                
                                                @foreach ($arr0 as $loca0)
                                                
                                                    @php

                                                        $location1 = DB::table('user_locations')->where('id',$loca0)->first();
                                                    @endphp
                                                        <label class="mb-1">
                                                            <span class="d-flex align-items-end badge text-dark bg-light mb-2"><i class="me-1" data-feather="map-pin" style="width: 12px; height: 12px;"></i> {{ $location1->location }}</span>
                                                        </label>
                                                            
                                                @endforeach
                                            @endif
                                        </td>
                                        <td><small>{{ $user->note }}</small></td>
                                        
                                      
                                        
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

