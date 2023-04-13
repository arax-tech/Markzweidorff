@extends('user.layouts.app')

@section('title', 'Indstillinger  › MiniSites')
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


    
    <header id="leftMargin" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="@if (auth::user()->sidebar == "Show") padding-left: 240px ; @endif top: 58px ;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="settings"></i></div>
                            Indstillinger  › MiniSites
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
                        MiniSites
                        <span class="float-end">
                            <div class="dropdown">
                                @if (in_array("All", $permission) OR in_array("MiniSiteCreate", $permission))
                            <button class="btn btn-primary btn-sm" href="javascript::" data-bs-toggle="modal" data-bs-target="#CreateMiniSite"><i class="me-1" data-feather="folder-plus"></i> &nbsp;Create MiniSites</button>
                        @endif  
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="CreateMiniSite">
                                <div class="modal-dialog modal-lg  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title d-flex align-items-center justify-content-center" id="exampleModalLabel"><i class="me-1" data-feather="settings"></i> Create MiniSite</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('/setting/minisite/store') }}" enctype="multipart/form-data">
                                                @csrf


                                              
                                                 <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Select Location</label>
                                                        <select class="form-control" name="location_id">
                                                            <option selected disabled value="">Choose...</option>
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}">{{ $location->location }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Name</label>
                                                        <input class="form-control" type="text" name="name" value="" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-6">
                                                        <label class="small mb-1">Logo</label>
                                                        <input class="form-control" type="file" name="logo" value="" required />
                                                    </div>

                                                     <div class="col-md-6">
                                                        <label class="small mb-1">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option selected disabled value="">Choose...</option>
                                                            <option value="Active">Active</option>
                                                            <option value="DeActivated">DeActivated</option>
                                                        </select>
                                                    </div>

                                                   
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Description</label>
                                                        <textarea class="form-control" name="description"></textarea>
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
                                    <th>Logo</th>
                                    <th>Name </th>
                                    <th>Location </th>
                                    <th>Description </th>
                                    <th>Status </th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($minisites as $minisite)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/customer/view/'.$minisite->id) }}">
                                                @if (!empty($minisite->logo))
                                                    <img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/minisite/logo/'.$minisite->logo) }}" />
                                                @else
                                                    <img style="width: 50px !important" class="img-thumbnail" src="{{ asset('backend/placeholder.jpg') }}" />
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{ $minisite->name }}</td>
                                        <td>
                                            @php
                                                $loaction1 = DB::table('user_locations')->where('id',$minisite->location_id)->first();
                                            @endphp
                                            

                                            <label class="mb-1">
                                                <span class="d-flex align-items-end badge text-dark bg-light mb-2"><i class="me-1" data-feather="map-pin" style="width: 12px; height: 12px;"></i> {{ $loaction1->location }}</span>
                                            </label>
                                        </td>
                                       

                                        <td>{{ $minisite->description }}</td>
                                        
                                        

                                        <td>
                                            @if ($minisite->status == "Active")
                                                <span class="badge bg-teal text-white">Active</span>
                                            @else
                                                <span class="badge bg-pink text-white">DeActivated</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if (in_array("All", $permission) OR in_array("MiniSiteUpdate", $permission))
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::" data-bs-toggle="modal" data-bs-target="#UpdateMiniSite{{ $minisite->id }}"><i data-feather="edit"></i></a>
                                            @endif
                                            @if (in_array("All", $permission) OR in_array("MiniSiteDelete", $permission))
                                                <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/setting/minisite/delete/'.$minisite->id) }}"><i data-feather="trash-2"></i></a>
                                            @endif
                                        </td>
                                        
                                    </tr>



                                    <!-- Modal -->
                                    <div class="modal fade" id="UpdateMiniSite{{ $minisite->id }}">
                                        <div class="modal-dialog modal-lg  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title d-flex align-items-center justify-content-center" id="exampleModalLabel"><i class="me-1" data-feather="settings"></i> Update MiniSite</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('/setting/minisite/update/'.$minisite->id) }}" enctype="multipart/form-data">
                                                        @csrf


                                                      
                                                         <div class="row gx-3 mb-3">
                                                            <div class="col-md-6">
                                                                <label class="small mb-1">Select Location</label>
                                                                <select class="form-control" name="location_id">
                                                                    <option selected disabled value="">Choose...</option>
                                                                    @foreach ($locations as $location)
                                                                        <option value="{{ $location->id }}"
                                                                            @if ($minisite->location_id == $location->id)
                                                                                selected 
                                                                            @endif
                                                                        >{{ $location->location }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="small mb-1">Name</label>
                                                                <input class="form-control" type="text" name="name" value="{{ $minisite->name }}" required />
                                                            </div>
                                                        </div>


                                                        <div class="row gx-3 mb-3">
                                                             <div class="col-md-6">
                                                                <label class="small mb-1">Logo</label>
                                                                <input class="form-control" type="file" name="logo" />
                                                            </div>

                                                             <div class="col-md-6">
                                                                <label class="small mb-1">Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option selected disabled value="">Choose...</option>
                                                                    <option value="Active"
                                                                    @if ($minisite->status == "Active")
                                                                        selected 
                                                                    @endif
                                                                    >Active</option>
                                                                    <option value="DeActivated"
                                                                    @if ($minisite->status == "DeActivated")
                                                                        selected 
                                                                    @endif
                                                                    >DeActivated</option>
                                                                </select>
                                                            </div>

                                                           
                                                        </div>


                                                        <div class="row gx-3 mb-3">
                                                            <div class="col-md-12">
                                                                <label class="small mb-1">Description</label>
                                                                <textarea class="form-control" name="description">{{ $minisite->description }}</textarea>
                                                            </div>
                                                            
                                                        </div>
                                                       

                                                       
                                                    
                                                </div>
                                                 <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i> Update</button>
                                            </div></form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#group").chosen({});
        $(".group").chosen({});
        
    });

    $(function () {
        

        new simpleDatatables.DataTable("#staffDatatable", {
            labels: {
                placeholder: "Søg efter minisite...",
                perPage: "{select} minisite pr. side",
                noRows: "Ingen minisite matchede din søgning!",
                info: "Viser {start} til {end} af {rows} minisite",
                noResults: "Ingen resultater matchede din søgning!"
            },
            // ...
        });


    });
</script>

@endsection

