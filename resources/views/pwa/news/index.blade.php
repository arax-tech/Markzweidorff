@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'Nyheder')
@section('header-title', 'Nyheder')
@section('css')
<style type="text/css">
    .home-main-icon{width: 60px; height: 60px}
    .schedule-status-container{padding: 12px; border-radius: 10px}
    .schedule-status-icon{color: #fff; width: 40px; height: 40px}
    .schedule-details{font-size: 0.74rem !important; border-top: 1px solid #f2f2f2; padding-top: 5px; margin-top: 5px}
    .schedule-detail-icon{width: 15px; height: 15px}
    .mb-70{margin-bottom: 70px}
</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container"> 
            <div class="serach-area"> 
                

                <div class="list item-list recent-jobs-list mb-70">
                      <ul>
                        @foreach ($news as $new)
                            @php
                                $array = explode(",", $new->views);
                            @endphp
                            <a href="{{ url('/pwa/news/view/'.$new->id) }}">
                              <li>
                                <div class="item-content">
                                  <div class="item-media">
                                    <div class="schedule-status-container bg-info">
                                        <i class="schedule-status-icon" data-feather="book-open"></i>
                                    </div>
                                  </div>
                                
                                  <div class="item-inner" style="color : gray !important">
                                    <div class="item-title-row">
                                        <h6 class="item-title">{{ $new->title }}</h6>
                                    </div>
                                    <div class="d-flex align-items-center mb-1" style="color : gray !important; margin-top:  -8px;">
                                        <i style="width: 20px; height : 20px"  data-feather="clock"></i>
                                        <div class="item-price">{{ date('d M Y', strtotime($new->date)) }}</div>
                                    </div>
                                    <div class="d-flex align-items-center" style="color : gray !important">
                                        @if (in_array(auth::user()->id, $array))
                                            <i style="width: 20px; height : 20px"  data-feather="eye"></i>
                                        @else
                                            <i style="width: 20px; height : 20px"  data-feather="eye-off"></i>
                                        @endif
                                        
                                        <div class="item-price">
                                            @if (in_array(auth::user()->id, $array))
                                                <span class="ms-2 price-item">Læst</span>
                                            @else
                                                <span class="ms-2 price-item">Ulæst</span>
                                            @endif
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="sortable-handler"></div>
                              </li>
                            </a>
                        @endforeach
                      </ul>
                </div>
                <!-- Job List -->                    
            </div>    
        </div>
    </div>
    
@endsection