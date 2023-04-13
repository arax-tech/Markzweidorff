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

               <div class="dz-tab ">
                   <div class="tab-slide-effect">
                       <ul class="nav nav-tabs" id="myTab2" role="tablist">
                           <li class="tab-active-indicator"></li>
                           <li class="nav-item active" role="presentation">
                               <button class="nav-link active" id="home-tab2" data-bs-toggle="tab" data-bs-target="#pri-document2" type="button" role="tab" aria-controls="pri-document" aria-selected="true">Kort version</button>
                           </li>
                           <li class="nav-item" role="presentation">
                               <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#information2" type="button" role="tab" aria-controls="information" aria-selected="false">Andre informationer</button>
                           </li>
                           
                       </ul>
                   </div>
                   <div class="tab-content" id="myTabContent2">
                       <div class="tab-pane fade show active" id="pri-document2" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                           <div class="box mb-3">
                               
                                <div class="p-3">
                                     {!! $document->editor !!}
                                        
                                    @php
                                        error_reporting(0);                                  
                                        $user = DB::table('users')->where('id', $document->user_id)->first();
                                        $category = DB::table('categories')->where('id', $document->category)->first();
                                       
                                    @endphp                              


                                    {{-- <iframe src="{{ asset('backend/documents/'.$document->pdf) }}" style="width: 100%; height: 1250px"></iframe> --}}


                                    <div class="container">
                                        <div class="footer-btn d-flex align-items-center">
                                            <div class="form-check checkmark">
                                                <form method="get" id="FavoriteForm" action="{{ url('/pwa/pri/document/add-to-favorite/'.$document->id) }}">
                                                    
                                                    <input class="form-check-input d-none" type="checkbox" id="checkBox">
                                                    <label class="form-check-label" for="checkBox" style="margin-left: -20px; margin-right: 10px; cursor: pointer;">
                                                       <i data-feather="bookmark" id="favorit" style="color: #673ab7; @if ($FavoriteDocument > 0) fill:  #673ab7 @else fill:#fff;  @endif"></i>
                                                    </label>
                                                </form>
                                            </div>
                                            {{-- <a href="{{ url('/pwa/pri/document/download/pdf/'.$document->id) }}" class="btn btn-primary w-100 btn-rounded flex-1"><i style="width: 18px; height: 18px" data-feather="download"></i>&nbsp;Download Document</a> --}}
                                            <a href="{{ url('/pwa/pri/document/pdf/'.$document->id) }}" class="btn btn-primary w-100 btn-rounded flex-1"><i style="width: 18px; height: 18px" data-feather="download"></i>&nbsp;Download Document</a>
                                        </div>
                                    </div>
                                </div>
                           </div>


                            

                       </div>
                       <div class="tab-pane fade" id="information2" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <div class="box mb-3">
                                <div class="border-bottom">
                                    <div class="d-flex align-items-center p-3">
                                        
                                        <div class="">
                                            <span class="d-block mb-2 text-primary section-title" >E-doc ID</span>
                                            <div class="swiper-containers tag-group team-swiper-4">
                                                <div class="d-flex align-content-center flex-row flex-wrap">
                                                    <i style="width: 15px; height: 15px" data-feather="compass"></i>&nbsp;{{$document->subtitle }}
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box mb-3">
                                <div class="border-bottom">
                                    <div class="d-flex align-items-center p-3">
                                        
                                        <div class="">
                                            <span class="d-block mb-2 text-primary section-title" >Søgeord</span>
                                            <div class="swiper-containers tag-group team-swiper-4">
                                                <div class="d-flex align-content-center flex-row flex-wrap">
                                                    @php
                                                        $array = explode(",", $document->keyword);
                                                        
                                                    @endphp
                                                    @foreach ($array as $key => $value)
                                                        <span class="badge text-dark bg-light my-1 mx-1 shadow-sm"> <i style="width: 12px; height: 12px" data-feather="tag"></i> {{ $value }}</span>
                                                    @endforeach
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="box mb-3">
                                <div class="border-bottom">
                                    <div class="d-flex align-items-center p-3">
                                        
                                        <div class="">
                                            <span class="d-block mb-2 text-primary section-title" >Skal læses</span>
                                            <div class="swiper-containers tag-group team-swiper-4">
                                                <div class="d-flex align-content-center flex-row flex-wrap">
                                                    @if($document->must_read == "Disabled")
                                                        Nej
                                                    @elseif($document->must_read == "Enabled")
                                                        Ja
                                                    @endif
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box mb-3">
                                <div class="border-bottom">
                                    <div class="d-flex align-items-center p-3">
                                        
                                        <div class="">
                                            <span class="d-block mb-2 text-primary section-title" >Kompetenceniveau</span>
                                            <div class="swiper-containers tag-group team-swiper-4">
                                                <div class="d-flex align-content-center flex-row flex-wrap">
                                                    @php
                                                        error_reporting(0);
                                                        $groups_ids = $document->group_id;
                                                        $arr = explode(",", $groups_ids);
                                                        
                                                        
                                                    @endphp


                                                    @foreach ($arr as $gp)
                                                    
                                                        @php

                                                            $group1 = DB::table('user_groups')->where('id',$gp)->first();
                                                        @endphp
                                                        
                                                            <span style="background: {{ $group1->background }} !important; color: {{ $group1->color }} !important;" class="badge my-1 mx-1">
                                                                {{ $group1->name }}
                                                               
                                                            </span>
                                                                
                                                    @endforeach
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="box mb-3">
                                <div class="border-bottom">
                                    <div class="d-flex align-items-center p-3">
                                        
                                        <div class="">
                                            <span class="d-block mb-2 text-primary section-title" >Status</span>
                                            <div class="swiper-containers tag-group team-swiper-4">
                                                <div class="d-flex align-content-center flex-row flex-wrap">
                                                    @php
                                                        error_reporting(0);
                                                       
                                                        $status = DB::table('document_status')->where(['document_id' => $document->id, 'user_id' => auth::user()->id])->first();
                                                       
                                                    @endphp
                                                    @if (count($status) == 0)
                                                        <span class="badge bg-red text-white mb-1">Ulæst</span>
                                                    @elseif($status->status == "Read")
                                                        <span class="badge bg-blue text-white mb-1">Læst</span>
                                                    @elseif($status->status == "Read Understood")
                                                        <span class="badge bg-green text-white mb-1">Læst og forstået -- ({{ $document->updated_at->format('d M Y H:i') }})</span>
                                                    @elseif($status->status == "Read Not Understood")
                                                        <span class="badge bg-yellow text-white mb-1">Læst, ej forstået -- ({{ $document->updated_at->format('d M Y H:i') }})</span>
                                                    @endif
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box mb-3">
                                <div class="border-bottom">
                                    <div class="d-flex align-items-center p-3">
                                        
                                        <div class="">
                                            <span class="d-block mb-2 text-primary section-title" >Set</span>
                                            <div class="swiper-containers tag-group team-swiper-4">
                                                <div class="d-flex align-content-center flex-row flex-wrap">
                                                    {{ $document->counts }} visninger
                                                </div>
                                            </div>                  
                                        </div>
                                    </div>
                                </div>
                            </div>

                               
                       </div>
                      
                   </div>
               </div>

               @if ($document->must_read == "Enabled")
                    <a class="btn btn-primary w-100 btn-rounded flex-1" href="javascript::" data-bs-toggle="offcanvas" data-bs-target="#StatusModal">Status</a>
               @endif
                

                
            </div>    
        </div>
    </div>

    <!-- Option Bar -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="StatusModal">
        <div class="container">
            <div class="offcanvas-body small text-center">
                <i class="fa fa-4x fa-info-circle text-primary"></i>
                <h5 class="m-t15 m-b10">Update Status</h5>
                <p>Choose Ready Read Understood or Read Understood</p>
                <div class="text-center m-t20 d-flex flex-row align-items-center justify-content-center">
                    <form method="get" action="{{ url('/pwa/pri/document/update/Read Understood/'.$document->id) }}">
                        <button type="submit" class="btn btn-sm btn-success me-3" @if ($status->status == "Read Understood") disabled @endif>Læst og forstået</button>
                    </form>

                    <form method="get" action="{{ url('/pwa/pri/document/update/Read Not Understood/'.$document->id) }}">
                        <button type="submit" class="btn btn-sm btn-warning me-3" @if ($status->status == "Read Not Understood") disabled @endif>Læst, ej forstået!</button>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    

    
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
            $("#FavoriteForm").submit();
        });
    });
</script>
@endsection