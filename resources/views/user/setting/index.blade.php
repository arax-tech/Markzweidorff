@extends('user.layouts.app')
@php
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp
@section('title', 'Indstillinger  › App')
@section('css')
     <style>
        @if (in_array("All", $permission))

        @elseif (in_array("AdminSettingUpdate", $permission))
        @elseif (in_array("AdminSettingView", $permission))
           <style type="text/css">
               
               input[type="input"] {
                 opacity: 0.5;
                 pointer-events: none !important;
               }
               button[type="submit"] {
                 opacity: 0.5;
                 pointer-events: none !important;
               }
           </style>
        @endif

    </style>
@endsection

@section('content')
 <form method="post" action="{{ url('/setting/app/update/1') }}" enctype="multipart/form-data">
                            @csrf
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="padding-left: 240px !important; top: 60px !important;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="settings"></i></div>
                            Indstillinger
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater / Gem</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br><br><br>
   
    <!-- Main page content-->
    <div class="container-fluid px-4">


        <div class="row">
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Applikation</div>
                    <div class="card-body">
                       


                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Virksomhedsnavn</label>
                                    <input class="form-control" type="text" name="welcome_heading" required value="{{ $setting->welcome_heading }}" />
                                </div>
                            
                                <div class="col-md-6">
                                    <label class="small mb-1">Bund tekst</label>
                                    <input class="form-control" type="text" name="copyright" required value="{{ $setting->copyright }}" />
                                </div>
                                
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1">Startside</label>
                                    <textarea class="form-control" type="text" name="welcome_sub_heading" rows="4" required>{{ $setting->welcome_sub_heading }}</textarea>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Notifikation</div>
                    <div class="card-body">
                       


                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1">Kontaktperson #1</label>
                                    <input class="form-control" type="text" name="status_reciving_name" value="" />
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="small mb-1">E-mail</label>
                                    <input class="form-control" type="text" name="status_reciving_email" required value="{{ $setting->status_reciving_email }}" />
                                </div>

                                 <div class="col-md-4">
                                    <label class="small mb-1">Meddelelser</label>
                                    <select class="form-control" name="status_reciving_notification">
                                        <option>All messages</option>
                                        <option>PRI status messages</option>
                                        <option>System information</option> 
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1">Kontaktperson #2</label>
                                    <input class="form-control" type="text" name="status_reciving_name2" value="" />
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="small mb-1">E-mail</label>
                                    <input class="form-control" type="text" name="status_reciving_email2" value="" />
                                </div>

                                 <div class="col-md-4">
                                    <label class="small mb-1">Meddelelser</label>
                                    <select class="form-control" name="status_reciving_notification2">
                                        <option>All messages</option>
                                        <option>PRI status messages</option>
                                        <option>System information</option> 
                                    </select>
                                </div>
                            </div>
                             <hr>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1">Kontaktperson #3</label>
                                    <input class="form-control" type="text" name="status_reciving_name3" value="" />
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="small mb-1">E-mail</label>
                                    <input class="form-control" type="text" name="status_reciving_email3" value="" />
                                </div>

                                 <div class="col-md-4">
                                    <label class="small mb-1">Meddelelser</label>
                                    <select class="form-control" name="status_reciving_notification3">
                                        <option>All messages</option>
                                        <option>PRI status messages</option>
                                        <option>System information</option> 
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
           


            <div class="col-xl-4">
                
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Logo
                        <span class="float-end">
                            
                                <div class="dropdown">
                                  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="edit"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><label style="cursor: pointer;" class="dropdown-item" href="javascript::" for="profile_image"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera"></i> Opdater logo</label></li>
                                    <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="camera-off"></i> Fjern logo</a></li>
                                  </ul>
                                </div>
                            
                        </span>
                    </div>
                    <div class="card-body text-center">
                       
                            <img class="img-account-profile rounded-circle mb-2" src="https://intranet.eventmedical.dk/backend/logo/logo-1666079759.png" />
                    

                        <form action="#" id="profile_form"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="profile_cover_base64" id="profile_cover_base64">
                            <input type="file" name="profile" hidden id="profile_image" type="file"  {{-- onchange="this.form.submit()" --}}>
                           
                        </form>

                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <label class="small mb-1">Logo</label>
                            <input class="form-control" type="file" name="logo"  />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </form>

  <!-- ProfileImageModal -->
    <div class="modal" id="ProfileImageModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-light">
                    <h6 class="modal-title">Beskær/tilpas og upload logo</h6>
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

    <script type="text/javascript">
        $(function() {

       

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


@endsection

