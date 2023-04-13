@extends('user.layouts.app')

@php
    $title = $user->name.' › Information';

    $array = auth::user()->permissions;
    $permission = explode(",", $array);


@endphp
@section('title', $title)
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

    <style>
    #map { height: 60vh; }

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
            <div class="col-xl-12">
                

                <div class="card mb-4 mb-xl-0 mt-3">
                    


                    <div class="card-header" style="padding: 19px !important">Adresse
                        <span class="float-end">
                           
                            <a href="{{ url('/user/view/'.$user->id) }}" class="btn btn-primary btn-sm"> &nbsp;<i class="me-1" data-feather="arrow-left"></i></a>
                           
                            
                        </span>


                       

                    </div>


                      <div class="card-body small" style="border-top: 1px solid rgba(33, 40, 50, 0.125);">
                        <div id="map"></div>
                    </div>
            
                
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


@endsection

