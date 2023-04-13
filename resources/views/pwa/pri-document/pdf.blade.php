@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'PRI-dokumenter')
@section('header-title', 'PRI-dokumenter')
@section('css')
<style type="text/css">

    .home-main-icon{width: 60px; height: 60px}
    .schedule-status-container{padding: 12px; border-radius: 10px}
    .schedule-status-icon{color: #fff; width: 40px; height: 40px}
    .schedule-details{font-size: 0.74rem !important; border-top: 1px solid #f2f2f2; padding-top: 5px; margin-top: 5px}
    .schedule-detail-icon{width: 15px; height: 15px}
    .mb-70{margin-bottom: 70px}
    #map { height: 25vh; border-radius: 8px !important}
    .box{box-shadow: 0 2px 10px rgba(0, 0, 0, 0.13) !important; padding: 0px 5px !important; border-radius: 8px !important}
    .dz-tab .tab-content{padding: 0px !important; box-shadow: none !important; border-radius: 0px !important;}
    .leaflet-touch .leaflet-control-layers, .leaflet-touch .leaflet-bar{
        display: none !important;
    }
    .section-title{font-size: 10px; letter-spacing: 1px; text-transform: uppercase;}
    .box{background: #fff !important}
    .pdf-box{width: 100%; height: 1250px; }

</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="content-body mb-70" >
            <div class="container"> 
                <div class="border-bottom mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <h5 class="title">
                                {{ $document->title }}
                            </h5>
                            <div class="d-flex align-items-center mt-2">
                                <span>{{ $document->subtitle }} </span>
                            </div>
                        </div>
                        <div class="ms-3">
                            <div class="schedule-status-container bg-primary">
                                <i class="schedule-status-icon" data-feather="{{ $document->icon }}"></i> 
                                
                            </div>
                        </div>
                    </div>
                    <div class="swiper-btn-center-lr">
                        
                    </div>
                </div>

                   
               @php
                   error_reporting(0);                                  
                   $user = DB::table('users')->where('id', $document->user_id)->first();
                   $category = DB::table('categories')->where('id', $document->category)->first();
                  
               @endphp                              


               <iframe src="{{ asset('backend/documents/'.$document->pdf) }}" class="pdf-box"></iframe>

                

                
            </div>    
        </div>
    </div>
    
@endsection
@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $('#checkBox').change(function() {
            if(this.checked) {
                $("#favorit").css({"fill":"#673ab7"});
            }else{
                $("#favorit").css({"fill":"#fff"});                
            }
        });
    });
</script>
@endsection