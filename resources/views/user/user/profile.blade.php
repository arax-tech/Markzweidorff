@extends('user.layouts.app')

@php
    error_reporting(0);
    $title = $user->name.' › Information';

    $array = auth::user()->permissions;
    $permission = explode(",", $array);


@endphp
@section('title', $title)
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
     <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

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
    </style>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
@endsection

@section('content')
    @include('user.user.header')
    <!-- Main page content-->
    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        @include('user.user.navbar')
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profilbillede
                        <span class="float-end">
                            @if (in_array("All", $permission) OR in_array("UpdateUserProfile", $permission))
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><label style="cursor: pointer;" class="dropdown-item" href="javascript::" for="profile_image"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera"></i> Opdater billede</label></li>
                                    <li><a class="dropdown-item" href="{{ url('/user/remove/picture/'.$user->id) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera-off"></i> Fjern billede</a></li>
                                  </ul>
                                </div>
                            @elseif (in_array("UpdateAuthProfile", $permission) AND auth::user()->id == $user->id)
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><label style="cursor: pointer;" class="dropdown-item" href="javascript::" for="profile_image"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera"></i> Opdater billede</label></li>
                                    <li><a class="dropdown-item" href="{{ url('/user/remove/picture/'.$user->id) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera-off"></i> Fjern billede</a></li>
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

                        <form action="{{ url('user/picture/'.$user->id) }}" id="profile_form"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="profile_cover_base64" id="profile_cover_base64">
                            <input type="file" name="profile" hidden id="profile_image" type="file"  {{-- onchange="this.form.submit()" --}}>
                           
                        </form>

                    </div>
                </div>


                <div class="card mb-4 mb-xl-0 mt-3">
                    


                    <div class="card-header" style="padding: 19px !important">Adresse
                        <span class="float-end">
                           
                            <a href="{{ url('/user/view/map/'.$user->id) }}" class="btn btn-primary btn-sm"> &nbsp;<i class="me-1" data-feather="maximize-2"></i></a>
                           
                           
                        </span>


                       

                    </div>


                      <div class="card-body small mb-0">
                        <div id="map"></div>
                    </div>
            
                
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    
                    <div class="card-header">Profil information
                        <span class="float-end">
                            
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                           @if (in_array("All", $permission) OR in_array("UpdateUserProfile", $permission))
                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUser"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="edit-3"></i> Rediger bruger</a></li>
                            @elseif (in_array("UpdateAuthProfile", $permission) AND auth::user()->id == $user->id)
                                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUser"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="edit-3"></i> Rediger bruger</a></li>
                            @endif
                          @if (in_array("All", $permission) OR in_array("UpdateUserProfile", $permission))
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUserAddress"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="map-pin"></i> Rediger adresse</a></li>
                            @elseif (in_array("UpdateAuthProfile", $permission) AND auth::user()->id == $user->id)
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#UpdateUserAddress"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="map-pin"></i> Rediger adresse</a></li>
                            @endif
                            </ul>
                                </div>
                        </span>
                    

                


                        <!-- Modal Update START -->
                        <div class="modal fade" id="UpdateUserAddress">
                            <div class="modal-dialog modal-m modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title"><i class="me-1" data-feather="edit-3"></i> Opdater adresse</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('user/update_adderss/'.$user->id) }}">
                                            @csrf
                                            
                                                
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Co/linje</label>
                                                        <input class="form-control" type="text" name="co_line" value="{{ $user->co_line }}" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Gade navn</label>
                                                        <input class="form-control" type="text" name="street_navn" value="{{ $user->street_navn }}" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Gade nr.</label>
                                                        <input class="form-control" type="text" name="street_no" value="{{ $user->street_no }}" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Sal/etage</label>
                                                        <input class="form-control" type="text" name="street_level" value="{{ $user->street_level }}" />
                                                    </div>

                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Post nr.</label>
                                                        <input class="form-control" type="text" name="po_code" value="{{ $user->po_code }}" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">By</label>
                                                        <input class="form-control" type="text" name="city_name" value="{{ $user->city_name }}" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Land</label>
                                                        <input class="form-control" type="text" name="country" value="{{ $user->country ?? "Danmark" }}" required />
                                                    </div>
                                                </div>



                                                <div class="row gx-3 mb-3">

                                                    @php
                                                        error_reporting(0);
                                                        $locations_idss = $user->location_id;
                                                        $arrays = explode(",", $locations_idss);
                                                        
                                                        
                                                    @endphp

                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Locations</label> <br>
                                                        <select style="width: 100%" class="group" name="location_id[]" multiple required >
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}"
                                                                    @if (in_array($location->id, $arrays))
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


                        <!-- Modal Update START -->
                        <div class="modal fade" id="UpdateUser">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title"><i class="me-1" data-feather="edit-3"></i> Rediger bruger</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('user/update/'.$user->id) }}">
                                            @csrf
                                            
                                                
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="small mb-1">Navn</label>
                                                        <input class="form-control" type="text" name="name" value="{{ $user->name }}" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Jobtitel</label>
                                                        <input class="form-control" type="text" name="work_title" value="{{ $user->work_title }}" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Mobil</label>
                                                        <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Telefon</label>
                                                        <input class="form-control" type="text" name="bank_information" value="{{ $user->bank_information }}" />
                                                    </div>

                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Email</label>
                                                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-8">
                                                        <label class="small mb-1">Bemærkning</label>
                                                        <input class="form-control" type="text" name="note" value="{{ $user->note }}" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Fødselsdato</label>
                                                        <input class="form-control" type="date" name="employment_date" value="{{ $user->employment_date }}" />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">

                                                    @php
                                                        error_reporting(0);
                                                        $groups_idss = $user->group_id;
                                                        $arrs = explode(",", $groups_idss);
                                                        
                                                        
                                                    @endphp

                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Group</label> <br>
                                                        <select style="width: 100%" class="group" name="group_id[]" multiple required >
                                                            @foreach ($groups as $group)
                                                                <option value="{{ $group->id }}"
                                                                    @if (in_array($group->id, $arrs))
                                                                        selected 
                                                                    @endif
                                                                >{{ $group->name }}</option>                          
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
                                <label class="mb-1 text-xs text-gray-600 fw-200">Navn</label><br>
                                <label class="mb-1">{{ $user->name }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Jobtitel</label><br>
                                <label class="mb-1">{{ $user->work_title }}</label>
                            </div>

                        </div>
                  

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Mobil</label><br>
                                <label class="mb-1">{{ $user->phone }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">E-mail</label><br>
                                <label class="mb-1"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></label>
                            </div>
                        </div>


                        
                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Telefon</label><br>
                                <label class="mb-1">{{ $user->bank_information }} </label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Fødselsdato</label><br>
                                <label class="mb-1">{{  date('d M Y', strtotime($user->employment_date)) }}</label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Mikro note</label><br>
                                <label class="mb-1"><small>{{ $user->note }}</small></label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Adresse</label><br>
                                <label class="mb-1">{{ $user->co_line }} {{ $user->street_navn }} {{ $user->street_no }} {{ $user->street_level }} <br>
                                    {{ $user->po_code }} {{ $user->city_name }}<br>{{ $user->country }}</label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Brugergrupper</label><br>
                                 @php
                                            error_reporting(0);
                                            $groups_ids = $user->group_id;
                                            $arr = explode(",", $groups_ids);
                                            
                                            
                                        @endphp


                                        @foreach ($arr as $gp)
                                        
                                            @php

                                                $group1 = DB::table('user_groups')->where('id',$gp)->first();
                                            @endphp
                                            
                                                <span style="background: {{ $group1->background }} !important; color: {{ $group1->color }} !important; margin-bottom: 4px;" class="badge">
                                                    {{ $group1->name }}
                                                   
                                                </span>
                                                    
                                        @endforeach
                            </div>
                             <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Lokationer</label><br>



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
                                                <span class="badge text-dark bg-light mb-2"><i class="me-1" data-feather="map-pin" style="width: 12px; height: 12px;"></i> {{ $location1->location }}</span>
                                            </label>
                                                
                                    @endforeach
                                @endif



                                
                            </div>
                        </div>

                        

                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header">
                        Notering
                        <span class="float-end">


                            <span class="float-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ProfileUpdateNote"><i class="me-1" data-feather="edit"></i></button>
                            </span>
                            


                            <!-- Modal -->
                            <div class="modal fade" id="ProfileUpdateNote">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Rediger notering</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/profile_note/'.$user->id) }}">
                                                @csrf

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <textarea name="profile_note" required>{!! $user->profile_note !!}</textarea>
                                                    </div>
                                                </div>
                                               
                                            
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                            <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">
                                <label class="mb-1">{!! $user->profile_note !!}</label>
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


            let mapOptions = {
                center : [{{ $response[0]['lat'] }}, {{ $response[0]['lon'] }}],
                zoom : 17
            }

            let map = new L.map('map', mapOptions);

            let layer = new L.TileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
            map.addLayer(layer);

            let marker = new L.Marker([{{ $response[0]['lat'] }}, {{ $response[0]['lon'] }}],
                {alt: '{{ $user->country }}' }).addTo(map) // "Denmark" is the accessible name of this marker
                .bindPopup('{{ $response[0]['display_name'] }}');
            marker.addTo(map)





            /*Crop Profile Image */
            $("#profile_image").on("change", function(event) {

                // alert('sadf');
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


    <script>
            CKEDITOR.replace( 'profile_note' );
    </script>



@endsection

