@extends('user.layouts.app')

@section('title', 'Køretøjer  › Oversigt')
@section('css')
    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
         .chosen-container{width: 100% !important; height: 45px !important}
        .chosen-container-multi .chosen-choices{padding: 7px !important; border: 1px solid #c5ccd6 !important; background-color: #fff !important; border-radius: 5px !important;}
        .chosen-container .chosen-results li.highlighted {
            background-color: #f53b57 !important;
            background-image: -webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#3875d7),color-stop(90%,#e81500)) !important;
            background-image: -webkit-linear-gradient(#f53b57 20%,#e81500 90%) !important;
            background-image: -moz-linear-gradient(#f53b57 20%,#e81500 90%) !important;
            background-image: -o-linear-gradient(#f53b57 20%,#e81500 90%) !important;
            background-image: linear-gradient(#f53b57 20%,#e81500 90%) !important;
            color: #fff !important;
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
@endsection
@php
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
                            <div class="page-header-icon"><i data-feather="truck"></i></div>
                            Køretøjer
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
                                @if (in_array("All", $permission) OR in_array("UserCreate", $permission))
                            <button class="btn btn-primary btn-sm" href="javascript::" data-bs-toggle="modal" data-bs-target="#CreateUser"><i class="me-1" data-feather="folder-plus"></i> &nbsp;Opret Køretøjer</button>
                        @endif  
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="CreateUser">
                                <div class="modal-dialog modal-lg  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="me-1" data-feather="folder-plus"></i> Opret Køretøjer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('/vehicle/store') }}" enctype="multipart/form-data">
                                                @csrf


                                              
                                                 <div class="row gx-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="small mb-1">Køretøj</label>
                                                        <input class="form-control" type="text" name="name" value="" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">SINE nr.</label>
                                                        <input class="form-control" type="text" name="work_title" value="" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Telefon</label>
                                                        <input class="form-control" type="text" name="phone" value="" />
                                                    </div>

                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Email</label>
                                                        <input class="form-control" type="email" name="email" value="" />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Nummerplade</label>
                                                        <input class="form-control" type="text" name="bank_information" value="" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="small mb-1">Bemærkning</label>
                                                        <input class="form-control" type="text" name="note" value="" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Indregistreret</label>
                                                        <input class="form-control" type="date" name="employment_date" value="" />
                                                    </div>
                                                </div>
                                               

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Locations</label> <br>
                                                        <select style="width: 100%" id="location" name="location_id[]" multiple required >
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}">{{ $location->location }}</option>                          
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                         <div class="card-footer">
                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i> Opret</button>
                                    </div></form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="staffDatatable">
                            <thead>
                                <tr>
                                    <th>Billede</th>
                                    <th>Køretøj</th>
                                    <th>SINE nr.</th>
                                    <th>Kontaktinformation</th>
                                    <th>Afdelinger </th>
                                    <th>Nummerplade</th>
                                    <th>Indregistreret</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td style="width: 50px;" align="center">
                                            <a href="{{ url('/vehicle/view/'.$vehicle->id) }}">
                                                @if (!empty($vehicle->image))
                                                    <img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/profile/'.$vehicle->image) }}" />
                                                @else
                                                    <img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/placeholder.jpg') }}" />
                                                @endif
                                            </a>
                                        </td>
                                        <td><a href="{{ url('/vehicle/view/'.$vehicle->id) }}">{{ $vehicle->name }}</a></td>
                                        <td>{{ $vehicle->work_title }}</td>
                                        <td>
                                            @if ($vehicle->phone)
                                                <div><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="phone"></i>&nbsp; {{ $vehicle->phone }}</div>
                                            @endif
                                            @if ($vehicle->email)
                                                <div style="padding-top: 5px;"><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="mail"></i>&nbsp; <a href="mailto:{{ $vehicle->email }}">{{ $vehicle->email }}</a></div>
                                            @endif

                                        </td>
                                        <td>
                                            @php
                                                error_reporting(0);
                                                $locations_ids0 = $vehicle->location_id;
                                                $arr0 = explode(",", $locations_ids0);
                                                
                                                
                                            @endphp

                                            @if ($vehicle->location_id != null)
                                                
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
                                        <td>{{ $vehicle->bank_information }}</td>
                                        <td>{{ $vehicle->employment_date }}</td>
                                        

                                       
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#location").chosen({});
        $(".location").chosen({});
        
    });

    $(function () {
        

        new simpleDatatables.DataTable("#staffDatatable", {
            labels: {
                placeholder: "Søg efter Køretøjer...",
                perPage: "Køretøjer pr. side &nbsp;  {select}",
                noRows: "Ingen køretøjer matchede din søgning!",
                info: "Viser {start} til {end} af {rows} Køretøjer",
                noResults: "Ingen resultater matchede din søgning!"
            },
            // ...
        });


    });
</script>

@endsection

