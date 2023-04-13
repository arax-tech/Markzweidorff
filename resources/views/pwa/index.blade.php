@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'Velkommen')
@section('css')
<style type="text/css">
    .home-main-icon{width: 60px; height: 60px}
    .schedule-status-container{padding: 12px; border-radius: 10px}
    .schedule-status-icon{color: #fff; width: 40px; height: 40px}
    .schedule-details{font-size: 0.74rem !important; border-top: 1px solid #f2f2f2; padding-top: 5px; margin-top: 5px}
    .schedule-detail-icon{width: 15px; height: 15px}
</style>
@endsection
@php
    $date = date("G");
    // echo $date;

    

    if ($date >= 6 AND $date <= 9)
    {
        $greeting = "Godmorgen";
    }
    else if($date >= 9 AND $date <= 12){
        $greeting = "God formiddag";
    }

    else if($date >= 12 AND $date <= 13){
        $greeting = "God middag";            
    }

    else if($date >= 13 AND $date <= 18){
        $greeting = "God eftermiddag";
    }

    else if($date >= 18 AND $date <= 23){
        $greeting = "God aften";
    }

    else if($date >= 23 OR $date <= 6){
        $greeting = "God nat";
    }
        
@endphp
@section('content')
    <!-- Banner -->
    <div class="banner-wrapper author-notification">
        <div class="container inner-wrapper">
            <div class="dz-info">
                <span>{{ $greeting }}</span>
                <h2 class="name mb-0">{{ auth::user()->name }}</h2>
            </div>
            <div class="dz-media media-45 rounded-circle">
                <a href="profile.html">
                    @if (!empty(auth::user()->image))
                        <img class="rounded-circle" src="{{ asset('backend/profile/'.auth::user()->image) }}" />
                    @else
                        <img class="rounded-circle" src="{{ asset('backend/placeholder.jpg') }}" />
                    @endif
                </a>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <div class="page-content">
        
        <div class="content-inner pt-0">
            <div class="container fb">
                <!-- Search -->
                {{-- <form class="m-b30">
                    <div class="input-group">
                        <span class="input-group-text"> 
                            <a href="javascript:void(0);" class="search-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20.5605 18.4395L16.7528 14.6318C17.5395 13.446 18 12.0262 18 10.5C18 6.3645 14.6355 3 10.5 3C6.3645 3 3 6.3645 3 10.5C3 14.6355 6.3645 18 10.5 18C12.0262 18 13.446 17.5395 14.6318 16.7528L18.4395 20.5605C19.0245 21.1462 19.9755 21.1462 20.5605 20.5605C21.1462 19.9748 21.1462 19.0252 20.5605 18.4395ZM5.25 10.5C5.25 7.605 7.605 5.25 10.5 5.25C13.395 5.25 15.75 7.605 15.75 10.5C15.75 13.395 13.395 15.75 10.5 15.75C7.605 15.75 5.25 13.395 5.25 10.5Z" fill="#B9B9B9"/>
                                </svg>
                            </a>
                        </span>
                        <input type="text" placeholder="Søg PRI-dokumenter..." class="form-control ps-0 bs-0">
                    </div>
                </form> --}}
                @include('pwa.pri-document.search-form')
                
                <!-- Dashboard Area -->
                <div class="dashboard-area">
                    <!-- Features -->
                    <div class="features-box">
                        <div class="row m-b20 g-3">
                            <div class="col">
                                <a href="{{ url('/pwa/schedule') }}">
                                    <div class="card card-bx card-content bg-primary">
                                        <div class="card-body">
                                            <i class="text-white home-main-icon" data-feather="calendar"></i>
                                            <div class="card-info">
                                                <h4 class="title">{{ $schedulesCounts }}</h4>
                                                <p>Vagtplan</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{ url('/pwa/pri/document?active=Favoritter') }}">
                                    <div class="card card-bx card-content bg-info">
                                        <div class="card-body">
                                            <i class="text-white home-main-icon" data-feather="star"></i>
                                            <div class="card-info">
                                                <h4 class="title">{{ $FavoritDocuments }}</h4>
                                                <p>Favoritter</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                              
                        </div>    
                    </div>
                    <!-- Features End -->
                    
        

                    
                    <!-- Recomended Jobs -->
                    <div class="m-b10">
                        <div class="title-bar">
                            <h5 class="dz-title">Nyheder</h5>
                            <div class="swiper-defult-pagination pagination-dots style-1 p-0"></div>
                        </div>
                        <div class="swiper-btn-center-lr">
                            <div class="swiper-container tag-group mt-4 dz-swiper recomand-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($news as $new)
                                        <div class="swiper-slide">
                                            <div class="card job-post">
                                                <a href="{{ url('/pwa/news/view/'.$new->id) }}">
                                                    <div class="card-body">
                                                        <div class="media media-60">
                                                            <div class="schedule-status-container bg-info">
                                                                @php
                                                                    $array = explode(",", $new->views);
                                                                @endphp
                                                                <i class="schedule-status-icon" style="color: white !important" data-feather="book-open"></i>
                                                            </div>
                                                        </div>
                                                        <div class="card-info">
                                                            <h6 class="title">{{ mb_strimwidth($new->title, 0, 17) }}</h6>
                                                            <span style="color: gray !important" class="location">{{ date('d M Y', strtotime($new->date)) }}</span>
                                                            <div class="d-flex align-items-center" style="color: gray !important; margin-top:  -10px;">
                                                                <i style="width: 20px; height : 20px" data-feather="eye"></i>
                                                                @if (in_array(auth::user()->id, $array))
                                                                    <span class="ms-2 price-item">Læst</span>
                                                                @else
                                                                    <span class="ms-2 price-item">Ulæst</span>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>       
                                        </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recomended Jobs End -->
                    
                    <!-- Recent Jobs -->
                    <div class="title-bar">
                        <h5 class="dz-title">Kommende vagter</h5>
                        <a class="btn btn-sm text-primary" href="{{ url('/pwa/schedule') }}">Vis alle</a>
                    </div>
                    <div class="list item-list recent-jobs-list">
                        @if (count($schedules) > 0)
                        <ul>
                            
                            @foreach ($schedules as $schedule)
                            @php
                              $staff = DB::table('users')->where('id', $schedule->staff_id)->first();
                              $customer = DB::table('customers')->where('id', $schedule->customer_id)->first();

                              $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();

                              $locationsArray = explode(",", $schedule->customer_loactions);
                              $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();

                              $groupsArray = explode(",", $schedule->staff_groups);
                              $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                            @endphp
                              <a href="{{ url('/pwa/schedule/view/'.$schedule->id) }}">
                                <li>
                                  <div class="item-content">
                                    <div class="item-media">
                                      <div class="schedule-status-container @if ($schedule->status == "Pending") bg-warning @elseif($schedule->status == "Accepted") bg-success @else bg-danger @endif">
                                          @if ($schedule->status == "Pending") <i class="schedule-status-icon" data-feather="help-circle"></i> @elseif($schedule->status == "Accepted") <i class="schedule-status-icon" data-feather="check-circle"></i> @else <i class="schedule-status-icon" data-feather="alert-circle"></i> @endif                                            
                                      </div>
                                    </div>
                                  
                                    <div class="item-inner" style="color : gray !important">
                                      <div class="item-title-row">
                                        @php
                                            $day = date('D', strtotime($schedule->date));
                                            $month = date('M', strtotime($schedule->date));
                                            $date = date('j', strtotime($schedule->date));
                                            $year = date('Y', strtotime($schedule->date));
                                        @endphp
                                          <h6 class="item-title" style="margin-bottom: -8px">
                                              @if ($day == "Mon") Mandag @elseif ($day == "Tue") Tirsdag @elseif ($day == "Wed") Onsdag @elseif ($day == "Thu") Torsdag @elseif ($day == "Fri") Fredag @elseif ($day == "Sat") Lørdag @elseif ($day == "Sun") Søndag @endif den {{ $date }}. @if ($month == "Jan") Januar @elseif($month == "Feb") Februar @elseif($month == "Mar") Marts @elseif($month == "Apr") April @elseif($month == "May") Maj @elseif($month == "Jun") Juni @elseif($month == "Jul") Juli @elseif($month == "Aug") August @elseif($month == "Sep") September @elseif($month == "Oct") Oktober @elseif($month == "Nov") November @elseif($month == "Dec") December    @endif {{ $year }}
                                          </h6>
                                      </div>
                                      <div class="d-flex align-items-center mb-1" style="color : gray !important">
                                          <i style="width: 20px; height : 20px" data-feather="clock"></i>
                                          <div class="item-price">{{ $schedule->start_time }} - {{ $schedule->end_time }}</div>
                                      </div>
                                      <div class="d-flex align-items-center" style="color : gray !important">
                                          <i style="width: 20px; height : 20px" data-feather="briefcase"></i>
                                          <div class="item-price">{{ $customer->name }}</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="sortable-handler"></div>
                                </li>
                              </a>
                            @endforeach
                            
                        </ul>
                        <a href="{{ url('/pwa/schedule') }}" class="btn btn-primary mb-5 mt-3 w-100 btn-rounded">Vis alle vagter</a>
                        @else
                            <p style="color: gray; text-align: center;">You don't have Kommende vagter...</p>
                        @endif
                    </div>
                    <!-- Recent Jobs End -->
                    
                </div>
            </div>    
        </div>
        
    </div>    
    
@endsection