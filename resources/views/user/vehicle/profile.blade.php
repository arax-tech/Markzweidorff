@extends('user.layouts.app')

@php
    error_reporting(0);

    $title = $user->name.' › Information';

    $array = auth::user()->permissions;
    $permission = explode(",", $array);



@endphp
@section('title', $title)
@section('css')
    <style>
    #map { height: 300px; }

        .small { color: #31353d !important; }
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
        td{vertical-align: middle !important; font-size: 0.8rem !important;}

        th{
             font-size: 0.8rem !important;
             font-weight: 600
        }
        .timeline.timeline-xs .timeline-item .timeline-item-marker .timeline-item-marker-text{width: 5rem !important}
    </style>    


    <style>




        .widget-subheading{
            color: #858a8e;
            font-size: 10px;
        }
        

        .scroll-area-sm {
            height: 400px;
            overflow-x: hidden;
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: 0.75rem 1.25rem;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .list-group-item:hover {
            background: #f2f2f2 !important;
            cursor: pointer;
            transition: 0.5s ease;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
        }

        .todo-indicator {
            position: absolute;
            width: 4px;
            height: 60%;
            border-radius: 0.3rem;
            left: 0.625rem;
            top: 20%;
            opacity: .6;
            transition: opacity .2s;
        }

        .bg-warning {
            background-color: #f7b924 !important;
        }

        .widget-content {
            padding: 1rem;
            flex-direction: row;
            align-items: center;
        }

        .widget-content .widget-content-wrapper {
            display: flex;
            flex: 1;
            position: relative;
            align-items: center;
        }

        .widget-content .widget-content-right.widget-content-actions {
            visibility: hidden;
            opacity: 0;
            transition: opacity .2s;
        }

        .widget-content .widget-content-right {
            margin-left: auto;
        }

       
        .small{
            color: #31353d !important;
        }











        .chat-message {
          padding-right: 20px;
        }

        .chat {
            list-style: none;
            margin: 0;
        }

        .chat-message{
            /*background: #f9f9f9;  */
        }

        .chat li img {
          width: 45px;
          height: 45px;
          border-radius: 50em;
          -moz-border-radius: 50em;
          -webkit-border-radius: 50em;
        }

        img {
          max-width: 100%;
        }

        .chat-body {
          padding-bottom: 20px;
        }

        .chat li.left .chat-body {
          margin-left: 70px;
          background-color: #f8f8f9;
        }
        .chat li.right .chat-body {
          background-color: #31353d;
        }

        .chat li .chat-body {
          position: relative;
          font-size: 11px;
          padding: 10px;
          border: 1px solid #f1f5fc;
          box-shadow: 0 5px 5px rgba(0,0,0,.05);
          -moz-box-shadow: 0 5px 5px rgba(0,0,0,.05);
          -webkit-box-shadow: 0 5px 5px rgba(0,0,0,.05);
        }

        .chat li .chat-body .header {
          padding-bottom: 5px;
          border-bottom: 1px solid #f1f5fc;
        }

        .chat li .chat-body p {
          margin: 0;
        }

        .chat li.left .chat-body:before {
          position: absolute;
          top: 10px;
          left: -8px;
          display: inline-block;
          background: #f8f8f9;
          width: 16px;
          height: 16px;
          border-top: 1px solid #f1f5fc;
          border-left: 1px solid #f1f5fc;
          content: '';
          transform: rotate(-45deg);
          -webkit-transform: rotate(-45deg);
          -moz-transform: rotate(-45deg);
          -ms-transform: rotate(-45deg);
          -o-transform: rotate(-45deg);
        }

        .chat li.right .chat-body:before {
          position: absolute;
          top: 10px;
          right: -8px;
          display: inline-block;
          background: #f0f0ff;
          width: 16px;
          height: 16px;
          border-top: 1px solid #f0f0ff;
          border-right: 1px solid #f0f0ff;
          content: '';
          transform: rotate(45deg);
          -webkit-transform: rotate(45deg);
          -moz-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          -o-transform: rotate(45deg);
        }

        .chat li {
          margin: 15px 0;
        }

        .chat li.right .chat-body {
          margin-right: 70px;
          background-color: #f0f0ff;
        }

        .chat-box {
        /*
          position: fixed;
          bottom: 0;
          left: 444px;
          right: 0;
        */
          padding: 15px;
          border-top: 1px solid #eee;
          transition: all .5s ease;
          -webkit-transition: all .5s ease;
          -moz-transition: all .5s ease;
          -ms-transition: all .5s ease;
          -o-transition: all .5s ease;
        }

        .bg-primary1{
          background: blue !important
        }

        
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
@endsection

@section('content')
    @include('user.vehicle.header')
    <!-- Main page content-->
    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        @include('user.vehicle.navbar')
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Billede
                        <span class="float-end">
                            @if (in_array("All", $permission) OR in_array("UpdateUserProfile", $permission))
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><label style="cursor: pointer;" class="dropdown-item" href="javascript::" for="profile_image"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera"></i> Opdater billede</label></li>
                                    <li><a class="dropdown-item" href="{{ url('/vehicle/remove/picture/'.$user->id) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera-off"></i> Fjern billede</a></li>
                                  </ul>
                                </div>
                            @elseif (in_array("UpdateAuthProfile", $permission) AND auth::user()->id == $user->id)
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><label style="cursor: pointer;" class="dropdown-item" href="javascript::" for="profile_image"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera"></i> Opdater billede</label></li>
                                    <li><a class="dropdown-item" href="{{ url('/vehicle/remove/picture/'.$user->id) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera-off"></i> Fjern billede</a></li>
                                  </ul>
                                </div>
                            @endif
                        </span>
                    </div>
                    <div class="card-body text-center">
                        @if (!empty($user->image))
                            <img style="width: 300px !important" class="img-thumbnail" src="{{ asset('backend/profile/'.$user->image) }}" />
                        @else
                            <img style="width: 300px !important" class="img-thumbnail" src="{{ asset('backend/placeholder.jpg') }}" />
                        @endif

                        <form action="{{ url('vehicle/picture/'.$user->id) }}" id="profile_form"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="profile_cover_base64" id="profile_cover_base64">
                            <input type="file" name="profile" hidden id="profile_image" type="file"  {{-- onchange="this.form.submit()" --}}>
                           
                        </form>

                    </div>
                </div>

                
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    
                    <div class="card-header">Køretøjer information
                        <span class="float-end">
                            
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                           @if (in_array("All", $permission) OR in_array("UpdateUserProfile", $permission))
                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUser"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="edit-3"></i> Rediger køretøj</a></li>
                            @elseif (in_array("UpdateAuthProfile", $permission) AND auth::user()->id == $user->id)
                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUser"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="edit-3"></i> Rediger køretøj</a></li>
                            @endif
                          @if (in_array("All", $permission) OR in_array("UpdateUserProfile", $permission))
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUserAddress"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="truck"></i> Rediger bil info</a></li>
                            @elseif (in_array("UpdateAuthProfile", $permission) AND auth::user()->id == $user->id)
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUserAddress"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="truck"></i> Rediger bil info</a></li>
                            @endif
                            </ul>
                                </div>
                        </span>
                    

                


                        <!-- Modal Update START -->
                        <div class="modal fade" id="UpdateUserAddress">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title"><i class="me-1" data-feather="truck"></i> Opdater bil info</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('vehicle/update_adderss/'.$user->id) }}">
                                            @csrf
                                            
                                                
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Stelnummer</label>
                                                        <input class="form-control" type="text" name="co_line" value="{{ $user->co_line }}" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Mærke & Model</label>
                                                        <input class="form-control" type="text" name="street_navn" value="{{ $user->street_navn }}" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Variant</label>
                                                        <input class="form-control" type="text" name="street_no" value="{{ $user->street_no }}" />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Art</label>
                                                        <input class="form-control" type="text" name="street_level" value="{{ $user->street_level }}" />
                                                    </div>

                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Model år</label>
                                                        <input class="form-control" type="text" name="po_code" value="{{ $user->po_code }}" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Anvendelse</label>
                                                        <input class="form-control" type="text" name="city_name" value="{{ $user->city_name }}" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Drivkraft</label>
                                                        <input class="form-control" type="text" name="country" value="{{ $user->country }}" />
                                                    </div>
                                                </div>

                                                



                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                    </div></form>
                                </div>
                            </div>
                        </div>


                        <!-- Modal Update START -->
                        <div class="modal fade" id="UpdateUser">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title"><i class="me-1" data-feather="edit-3"></i> Rediger køretøj</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('vehicle/update/'.$user->id) }}">
                                            @csrf
                                            
                                                
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="small mb-1">Køretøj</label>
                                                        <input class="form-control" type="text" name="name" value="{{ $user->name }}" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">SINE nr.</label>
                                                        <input class="form-control" type="text" name="work_title" value="{{ $user->work_title }}" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Telefon</label>
                                                        <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" />
                                                    </div>
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Email</label>
                                                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Nummerplade</label>
                                                        <input class="form-control" type="text" name="bank_information" value="{{ $user->bank_information }}" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="small mb-1">Bemærkning</label>
                                                        <input class="form-control" type="text" name="note" value="{{ $user->note }}" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Indregistreret</label>
                                                        <input class="form-control" type="date" name="employment_date" value="{{ $user->employment_date }}" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">

                                                    @php
                                                        error_reporting(0);
                                                        $locations_idss = $user->location_id;
                                                        $arrs = explode(",", $locations_idss);
                                                        
                                                        
                                                    @endphp

                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Afdelinger</label> <br>
                                                        <select style="width: 100%" class="group" name="location_id[]" multiple required >
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}"
                                                                    @if (in_array($location->id, $arrs))
                                                                        selected 
                                                                    @endif
                                                                >{{ $location->location }}</option>                          
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                    </div></form>
                                </div>
                            </div>
                        </div>
                    </div>



                   
                    <div class="card-body">
                        
                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Køretøj</label><br>
                                <label class="mb-1">{{ $user->name }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">SINE nr.</label><br>
                                <label class="mb-1">{{ $user->work_title }}</label>
                            </div>

                        </div>
                  

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Telefon</label><br>
                                <label class="mb-1">{{ $user->phone }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">E-mail</label><br>
                                <label class="mb-1">{{ $user->email }}</label>
                            </div>
                        </div>


                        
                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Nummerplade</label><br>
                                <label class="mb-1">{{ $user->bank_information }} </label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Indregistreret</label><br>
                                <label class="mb-1">{{ $user->employment_date }} </label>
                            </div>

                        </div>

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Stelnummer</label><br>
                                <label class="mb-1">{{ $user->co_line }} </label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Anvendelse / Drivkraft</label><br>
                                <label class="mb-1">{{ $user->city_name }}, {{ $user->country }} </label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Mærke & Model</label><br>
                                <label class="mb-1">{{ $user->street_navn }} </label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Variant / Art / Model år</label><br>
                                <label class="mb-1">{{ $user->street_no }}, {{ $user->street_level }}, {{ $user->po_code }} </label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Bemærkninger</label><br>
                                <label class="mb-1">{{ $user->note }} </label>
                            </div>
                        </div>

                        

                    </div>
                </div>

                


            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 mb-4">
                <!-- Dashboard activity timeline example-->
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Kørte kilometer
                        
                        <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#UpdateMillage"><i class="dropdown-item-icon" style="color: #fff !important; height: 0.9em; width: 0.9em;" data-feather="plus"></i></a>
                        <!-- Modal Update START --> 
                        <div class="modal fade" id="UpdateMillage">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title"><i class="me-1" data-feather="plus"></i> Registrer kilometer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('vehicle/millage/store/'.$user->id) }}">
                                            @csrf
                                            
                                                
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Dato</label>
                                                        <input class="form-control" type="date" name="date" />
                                                    </div>

                                                    
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-12">
                                                        <label class="small mb-1">Kilometer tal</label>
                                                        <input class="form-control" type="number" name="mileage_number" required />
                                                    </div>

                                                    
                                                </div>


                                                



                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                    </div></form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-xs">
                            <!-- Timeline Item 1-->
                            @foreach ($millages as $millage)
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">{{ date('d M Y', strtotime($millage->date)) }}</div>
                                        <div class="timeline-item-marker-indicator bg-primary"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        @php
                                            error_reporting(0);
                                            $millageCreator = DB::table('users')->where('id', $millage->who_has_updated)->first();
                                        @endphp
                                        <a class="fw-bold text-dark">{{ $millage->mileage_number }}</a> km tilføjet af {{ $millageCreator->name }}.
                                        
                                </div></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        

                        <div class="d-flex align-items-center justify-content-between">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="Active-tab" data-bs-toggle="tab" data-bs-target="#Active-tab-pane" type="button" role="tab" aria-controls="Active-tab-pane" aria-selected="true">Åbne opgaver</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="Close-tab" data-bs-toggle="tab" data-bs-target="#Close-tab-pane" type="button" role="tab" aria-controls="Close-tab-pane" aria-selected="false" tabindex="-1">Afsluttede opgaver</button>
                                </li>
                               
                            </ul>
                            <button class="btn btn-primary btn-sm float-right" href="javascript::" data-bs-toggle="modal" data-bs-target="#CreateToDo"><i class="me-1" data-feather="plus"></i></button>



                            <!-- Modal -->
                            <div class="modal fade" id="CreateToDo">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="plus"></i> Opret opgave</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('/vehicle/todo/store/'.$user->id) }}">
                                                @csrf
                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-12">
                                                        <label class="small mb-1">Opgave</label>
                                                        <input class="form-control" type="text" name="task" required />
                                                    </div>
                                                </div>
                                                <div class="row gx-3 mb-3">

                                                     <div class="col-md-12">
                                                        <label class="small mb-1">Prioritet</label>
                                                        <select class="form-control" name="priority">
                                                            <option value="Yellow">Gul</option>
                                                            <option value="Blue">Blå</option>
                                                            <option value="Red" selected>Rød</option>
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
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="Active-tab-pane" role="tabpanel" aria-labelledby="Active-tab" tabindex="0">
                                <div class="scroll-area-sm">
                                    <perfect-scrollbar class="ps-show-limits">
                                        <div style="position: static;" class="ps ps--active-y">
                                            <div class="ps-content">
                                                <ul class=" list-group list-group-flush">
                                                    @php
                                                        error_reporting(0);
                                                    @endphp
                                                    @foreach ($todos as $todo)
                                                        @if ($todo->priority != "Green")
                                                            <li class="list-group-item">
                                                                <div class="todo-indicator @if ($todo->priority == "Red") bg-danger @elseif ($todo->priority == "Blue")  bg-primary1 @elseif ($todo->priority == "Yellow")  bg-warning @elseif ($todo->priority == "Green")  bg-success  @endif"></div>
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">@if ($todo->priority == "Green") <del>{{ $todo->task }}</del> @else {{ $todo->task }}@endif
                                                                            </div>
                                                                            @php
                                                                                error_reporting(0);
                                                                                $toDoUser = DB::table('users')->where('id', $todo->minisite_id)->first();
                                                                            @endphp
                                                                            <div class="widget-subheading"><i>Af {{ $toDoUser->name }}</i><small class="text-muted">  <i class="fa fa-clock-o"></i> {{ $todo->created_at->diffForHumans() }}</small></div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="dropdown">
                                                                              <button class="btn  btn-light rounded-circle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-v" ></i>
                                                                              </button>
                                                                              <ul class="dropdown-menu">
                                                                                <li>
                                                                                  <a class="dropdown-item" href="{{ url('/vehicle/todo/done/'.$todo->id) }}"><i style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="check-square"></i>&nbsp;Afslut</a>


                                                                                  <a class="dropdown-item" href="javascript::" data-bs-toggle="modal" data-bs-target="#UpdateToDo{{ $todo->id }}"><i style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="edit"></i>&nbsp;Rediger</a>
                                                                                  

                                                                                  <a onclick="return confirm('Er du sikker på at du vil slette denne opgave ?')" class="dropdown-item" href="{{ url('/vehicle/todo/delete/'.$todo->id) }}"><i style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="trash-2"></i>&nbsp;Slet</a>

                                                                              </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>


                                                            <!-- Modal -->
                                                            <div class="modal fade" id="UpdateToDo{{ $todo->id }}">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="edit"></i> Rediger</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" action="{{ url('/vehicle/todo/update/'.$todo->id) }}">
                                                                                @csrf
                                                                                <div class="row gx-3 mb-3">
                                                                                     <div class="col-md-12">
                                                                                        <label class="small mb-1">Task</label>
                                                                                        <input class="form-control" type="text" name="task" value="{{ $todo->task }}" required />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row gx-3 mb-3">

                                                                                     <div class="col-md-12">
                                                                                        <label class="small mb-1">Priority</label>
                                                                                        <select class="form-control" name="priority">
                                                                                            <option value="Red"
                                                                                            @if ($todo->priority == "Red")
                                                                                                selected 
                                                                                            @endif
                                                                                            >Red</option>
                                                                                            <option value="Yellow"
                                                                                            @if ($todo->priority == "Yellow")
                                                                                                selected 
                                                                                            @endif
                                                                                            >Yellow</option>
                                                                                            <option value="Blue"
                                                                                            @if ($todo->priority == "Blue")
                                                                                                selected 
                                                                                            @endif
                                                                                            >Blue</option>
                                                                                        </select>
                                                                                    </div>

                                                                                   
                                                                                </div>
                                                                        </div>
                                                                         <div class="card-footer">
                                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i> Opdater</button>
                                                                    </div></form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif


                                                    @endforeach
                                                    
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </perfect-scrollbar>
                                </div>
                            </div>



                            
                            <div class="tab-pane fade" id="Close-tab-pane" role="tabpanel" aria-labelledby="Close-tab" tabindex="0">
                                <div class="scroll-area-sm">
                                    <perfect-scrollbar class="ps-show-limits">
                                        <div style="position: static;" class="ps ps--active-y">
                                            <div class="ps-content">
                                                <ul class=" list-group list-group-flush">
                                                    @php
                                                        error_reporting(0);
                                                    @endphp
                                                    @foreach ($todos as $todo)
                                                        @if ($todo->priority == "Green")
                                                            <li class="list-group-item">
                                                                <div class="todo-indicator @if ($todo->priority == "Red") bg-danger @elseif ($todo->priority == "Blue")  bg-primary1 @elseif ($todo->priority == "Yellow")  bg-warning @elseif ($todo->priority == "Green")  bg-success  @endif"></div>
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">@if ($todo->priority == "Green") <del>{{ $todo->task }}</del> @else {{ $todo->task }}@endif
                                                                            </div>
                                                                            @php
                                                                                error_reporting(0);
                                                                                $toDoUser = DB::table('users')->where('id', $todo->minisite_id)->first();
                                                                            @endphp
                                                                            <div class="widget-subheading"><i>Af {{ $toDoUser->name }}</i><small class="text-muted">  <i class="fa fa-clock-o"></i> {{ $todo->created_at->diffForHumans() }}</small></div>
                                                                        </div>
                                                                        <div class="widget-content-right">
                                                                            <div class="dropdown">
                                                                              <button class="btn  btn-light rounded-circle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-v" ></i>
                                                                              </button>

                                                                              <ul class="dropdown-menu">
                                                                                <li>
                                                                                  <a class="dropdown-item" href="{{ url('/vehicle/todo/done/'.$todo->id) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="check-square"></i>&nbsp;Afslut</a>


                                                                                  <a class="dropdown-item" href="javascript::" data-bs-toggle="modal" data-bs-target="#UpdateToDo{{ $todo->id }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="edit"></i>&nbsp;Rediger</a>
                                                                                  

                                                                                  <a onclick="return confirm('Er du sikker på at du vil slette denne opgave?')" class="dropdown-item" href="{{ url('/vehicle/todo/delete/'.$todo->id) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="trash-2"></i>&nbsp;Slet</a>

                                                                              </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>


                                                            <!-- Modal -->
                                                            <div class="modal fade" id="UpdateToDo{{ $todo->id }}">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-light">
                                                                            <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="edit"></i> Rediger</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" action="{{ url('/vehicle/todo/update/'.$todo->id) }}">
                                                                                @csrf
                                                                                <div class="row gx-3 mb-3">
                                                                                     <div class="col-md-12">
                                                                                        <label class="small mb-1">Opgave</label>
                                                                                        <input class="form-control" type="text" name="task" value="{{ $todo->task }}" required />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row gx-3 mb-3">

                                                                                     <div class="col-md-12">
                                                                                        <label class="small mb-1">Prioritet</label>
                                                                                        <select class="form-control" name="priority">
                                                                                            <option value="Red"
                                                                                            @if ($todo->priority == "Red")
                                                                                                selected 
                                                                                            @endif
                                                                                            >Red</option>
                                                                                            <option value="Yellow"
                                                                                            @if ($todo->priority == "Yellow")
                                                                                                selected 
                                                                                            @endif
                                                                                            >Yellow</option>
                                                                                            <option value="Blue"
                                                                                            @if ($todo->priority == "Blue")
                                                                                                selected 
                                                                                            @endif
                                                                                            >Blue</option>
                                                                                        </select>
                                                                                    </div>

                                                                                   
                                                                                </div>
                                                                        </div>
                                                                         <div class="card-footer">
                                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i> Opdater</button>
                                                                    </div></form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif


                                                    @endforeach
                                                    
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </perfect-scrollbar>
                                </div>
                            </div>
                           
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- ProfileImageModal -->
    <div class="modal" id="ProfileImageModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-light">
                    <h6 class="modal-title">Beskær/tilpas og upload billede</h6>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="profile_image1"></div>
                    <button class="btn rotateproimag1 float-start" data-deg="90" > 
                    <i class="fas fa-undo"></i></button>
                    <button class="btn rotateproimag1 float-end" data-deg="-90" > 
                    <i class="fas fa-redo"></i></button>
                    <hr>
                    <button class="btn btn-primary btn-sm float-end" id="ProfileImage1Upload" > 
                    Upload</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>


    <script type="text/javascript">
        $(function() {


        





            /*Crop Profile Image */
            $("#profile_image").on("change", function(event) {

                $("#ProfileImageModal").modal("show"); 
                var croppie = null;
                var el = document.getElementById('profile_image1');
                $.getImage = function(input, croppie) {
                    if (input.files && input.files[0])
                    {
                        var reader = new FileReader();
                        reader.onload = function(e)
                        {  
                            croppie.bind({
                                url: e.target.result,
                                });
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                
                $("#ProfileImageModal").modal();
                // Initailize croppie instance and assign it to global variable
                croppie = new Croppie(el, {
                    viewport: {
                        width: 160,
                        height: 160,
                        type: 'rectangle'
                        },
                        boundary: {
                            width: 200,
                            height: 200
                            },
                        enableOrientation: true
                    });
                $.getImage(event.target, croppie); 
                


                /*Assign the Value of Crop Image into Input*/
                $("#ProfileImage1Upload").on("click", function() {
                    croppie.result('base64').then(function(base64) {
                        // alert(base64);
                        $('#profile_cover_base64').val(base64);
                        $("#ProfileImageModal").modal("hide"); 
                        $("#profile_form").submit();
                    });
                });



                // To Rotate Image Left or Right
                $(".rotateproimag1").on("click", function() {
                    croppie.rotate(parseInt($(this).data('deg'))); 
                });

                $('#ProfileImageModal').on('hidden.bs.modal', function (e) {
                    // This function will call immediately after model close
                    // To ensure that old croppie instance is destroyed on every model close
                    setTimeout(function() { croppie.destroy(); }, 100);
                });
            });










            
        });
    </script>


@endsection

