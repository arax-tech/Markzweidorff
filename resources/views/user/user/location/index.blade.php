@extends('user.layouts.app')

@section('title', 'Personale › Brugergruppe')
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
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            Personale › Location
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ url('/user') }}" >
                            <i class="me-1" data-feather="arrow-left"></i>
                            &nbsp;Oversigt
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br><br>


    
    <!-- Main page content-->
    <div class="container-fluid px-4 ">


        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Oversigt
                        <span class="float-end">
                            
                            @if (in_array("All", $permission) OR in_array("UserLocationCreate", $permission))
                                <a class="btn btn-sm btn-primary" href="javascript::" data-bs-toggle="modal"
                                        data-bs-target="#CreateGroup">
                                    <i class="me-1" data-feather="plus"></i>
                                    &nbsp;Opret gruppe
                                </a>
                            @endif


                            <!-- Modal -->
                            <div class="modal fade" id="CreateGroup">
                                <div class="modal-dialog modal-dialog-centered"">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret Location</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/location/store') }}">
                                                @csrf
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Location</label>
                                                        <input class="form-control" type="text" name="location" required />
                                                    </div>
                                                </div>
                                                
                                        </div>
                                         <div class="card-footer">
                                            <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                            <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    {{-- <th>S#</th> --}}
                                    <th>Location </th>
                                    <th>Antal brugere</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($locations as $key => $location)
                                    <tr>
                                       
                                        <td>{{ $location->location }}</td>
                                        <td>
                                            @php
                                                error_reporting(0);
                                                $users1 = DB::table('users')->where('location_id','LIKE','%'.$location->id.'%')->count();
                                            @endphp
                                            {{ $users1 }}
                                        </td>
                                        
                                        <td>
                                            @if (in_array("All", $permission) OR in_array("UserLocationUpdate", $permission))
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::" data-bs-toggle="modal" data-bs-target="#UpdateGroup{{ $location->id }}"><i data-feather="edit"></i></a>
                                            @endif
                                            @if (in_array("All", $permission) OR in_array("UserLocationDelete", $permission))
                                                <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/location/delete/'.$location->id) }}"><i data-feather="trash-2"></i></a>
                                            @endif
                                        </td>
                                        
                                    </tr>


                                    <div class="modal fade" id="UpdateGroup{{ $location->id }}">
                                        <div class="modal-dialog modal-dialog-centered"">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title">Opdater gruppe</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('user/location/update/'.$location->id) }}">
                                                        @csrf
                                                        <div class="row gx-3 mb-3">
                                                            <div class="col-md-12">
                                                                <label class="small mb-1">Location</label>
                                                                <input class="form-control" type="text" name="location" value="{{ $location->location }}" required />
                                                            </div>
                                                        </div>
                                                        
                                    
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                    <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>


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