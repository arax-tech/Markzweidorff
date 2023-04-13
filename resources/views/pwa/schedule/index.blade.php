@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'Vagtplan overblik')
@section('header-title', 'Vagtplan overblik')
@section('css')
<style type="text/css">
    .home-main-icon{width: 60px; height: 60px}
    .schedule-status-container{padding: 12px; border-radius: 10px}
    .schedule-status-icon{color: #fff; width: 40px; height: 40px}
    .schedule-details{font-size: 0.74rem !important; border-top: 1px solid #f2f2f2; padding-top: 5px; margin-top: 5px}
    .schedule-detail-icon{width: 15px; height: 15px}
    .dz-tab .tab-content{padding: 0px !important; box-shadow: none !important; border-radius: 0px !important;}
    .mb-70{margin-bottom: 70px}
    .bg-primary0{background: #673ab7ad !important}
</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container"> 
            <div class="serach-area"> 
                <div class="dz-tab ">
                    <div class="tab-slide-effect">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="tab-active-indicator"></li>
                            
                            <li class="nav-item  @if (!request()->type) active @endif" role="presentation">
                                <button class="nav-link @if (!request()->type) active @endif" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#upcomming-schedules2" type="button" role="tab" aria-controls="upcomming-schedules" aria-selected="false">Kommende</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="content-tab2" data-bs-toggle="tab" data-bs-target="#open-schedules2" type="button" role="tab" aria-controls="open-schedules" aria-selected="false">Ledige</button>
                            </li>
                            @if (request()->type)
                              <li class="nav-item @if (request()->type) active @endif" role="presentation">
                                  <button class="nav-link @if (request()->type) active @endif" id="home-tab2" data-bs-toggle="tab" data-bs-target="#all-schedules2" type="button" role="tab" aria-controls="all-schedules" aria-selected="true">Alle</button>
                              </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent2">
                        

                        <div class="tab-pane fade  @if (!request()->type) show active @endif" id="upcomming-schedules2" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            @if (request()->type)
                                <a class="tag-btn" href="{{ url('/pwa/schedule') }}">Gå tilbage</a>
                            @else
                                <a class="tag-btn" href="{{ url('/pwa/schedule?type=All') }}">Vis alle vagter</a>
                            @endif
                             <div class="list item-list recent-jobs-list mb-70">
                                
                                 <ul>
                                       
                                     @foreach ($upcommingSchedules as $schedule)
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
                                                     <h6 class="item-title" style="margin-bottom: -8px; font-size: 14px">
                                                         @if ($day == "Mon") Mandag @elseif ($day == "Tue") Tirsdag @elseif ($day == "Wed") Onsdag @elseif ($day == "Thu") Torsdag @elseif ($day == "Fri") Fredag @elseif ($day == "Sat") Lørdag @elseif ($day == "Sun") Søndag @endif den {{ $date }}. @if ($month == "Jan") Januar @elseif($month == "Feb") Februar @elseif($month == "Mar") Marts @elseif($month == "Apr") April @elseif($month == "May") Maj @elseif($month == "Jun") Juni @elseif($month == "Jul") Juli @elseif($month == "Aug") August @elseif($month == "Sep") September @elseif($month == "Oct") Oktober @elseif($month == "Nov") November @elseif($month == "Dec") December    @endif {{ $year }}
                                                     </h6>
                                                 </div>
                                                 <div class="d-flex align-items-center mb-1" style="color : gray !important">
                                                     <i style="width: 20px; height : 20px" data-feather="clock"></i>
                                                     <div class="item-price">{{ $schedule->start_time }} - {{ $schedule->end_time }}</div>
                                                 </div>
                                                 <div class="d-flex align-items-center" style="color : gray !important">
                                                     <i style="width: 20px; height : 20px" data-feather="briefcase"></i>
                                                     <div class="item-price">{{ mb_strimwidth($customer->name, 0, 23, "...") }}</div>
                                                 </div>
                                               </div>
                                             </div>
                                             <div class="sortable-handler"></div>
                                           </li>
                                         </a>
                                     @endforeach
                                       
                                 </ul>
                             </div>
                        </div>
                        <div class="tab-pane fade" id="open-schedules2" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <div class="list item-list recent-jobs-list mb-70">
                                <ul>
                                      
                                    @foreach ($openSchedules as $schedule)
                                        @php
                                            $staff = DB::table('users')->where('id', $schedule->staff_id)->first();
                                            $customer = DB::table('customers')->where('id', $schedule->customer_id)->first();

                                            $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();

                                            $locationsArray = explode(",", $schedule->customer_loactions);
                                            $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();

                                            $groupsArray = explode(",", $schedule->staff_groups);
                                            $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();


                                            $ifApplied = DB::table('schedule_applications')->where(['schedule_id' => $schedule->id, 'user_id' => auth::user()->id])->count();

                                        @endphp
                                        <a href="{{ url('/pwa/schedule/view/'.$schedule->id) }}">
                                          <li>
                                            <div class="item-content">
                                              <div class="item-media">
                                                <div class="schedule-status-container @if ($ifApplied > 0) bg-primary0 @else bg-info @endif">
                                                    <i class="schedule-status-icon" data-feather="circle"></i>                                            
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
                                                    <h6 class="item-title" style="margin-bottom: -8px; font-size: 14px">
                                                        @if ($day == "Mon") Mandag @elseif ($day == "Tue") Tirsdag @elseif ($day == "Wed") Onsdag @elseif ($day == "Thu") Torsdag @elseif ($day == "Fri") Fredag @elseif ($day == "Sat") Lørdag @elseif ($day == "Sun") Søndag @endif den {{ $date }}. @if ($month == "Jan") Januar @elseif($month == "Feb") Februar @elseif($month == "Mar") Marts @elseif($month == "Apr") April @elseif($month == "May") Maj @elseif($month == "Jun") Juni @elseif($month == "Jul") Juli @elseif($month == "Aug") August @elseif($month == "Sep") September @elseif($month == "Oct") Oktober @elseif($month == "Nov") November @elseif($month == "Dec") December    @endif {{ $year }}
                                                    </h6>
                                                </div>
                                                <div class="d-flex align-items-center mb-1" style="color : gray !important">
                                                    <i style="width: 20px; height : 20px" data-feather="clock"></i>
                                                    <div class="item-price">{{ $schedule->start_time }} - {{ $schedule->end_time }}</div>
                                                </div>
                                                <div class="d-flex align-items-center" style="color : gray !important">
                                                    <i style="width: 20px; height : 20px" data-feather="briefcase"></i>
                                                    <div class="item-price">{{ mb_strimwidth($customer->name, 0, 23, "...") }}</div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="sortable-handler"></div>
                                          </li>
                                        </a>
                                    @endforeach
                                      
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade @if (request()->type) show active @endif" id="all-schedules2" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            @if (request()->type)
                                <a class="tag-btn" href="{{ url('/pwa/schedule') }}">Gå tilbage</a>
                            @else
                                <a class="tag-btn" href="{{ url('/pwa/schedule?type=All') }}">Vis alle vagter</a>
                            @endif
                            <div class="list item-list recent-jobs-list mb-70">
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
                                                    <h6 class="item-title" style="margin-bottom: -8px; font-size: 14px">
                                                        @if ($day == "Mon") Mandag @elseif ($day == "Tue") Tirsdag @elseif ($day == "Wed") Onsdag @elseif ($day == "Thu") Torsdag @elseif ($day == "Fri") Fredag @elseif ($day == "Sat") Lørdag @elseif ($day == "Sun") Søndag @endif den {{ $date }}. @if ($month == "Jan") Januar @elseif($month == "Feb") Februar @elseif($month == "Mar") Marts @elseif($month == "Apr") April @elseif($month == "May") Maj @elseif($month == "Jun") Juni @elseif($month == "Jul") Juli @elseif($month == "Aug") August @elseif($month == "Sep") September @elseif($month == "Oct") Oktober @elseif($month == "Nov") November @elseif($month == "Dec") December    @endif {{ $year }}
                                                    </h6>
                                                </div>
                                                <div class="d-flex align-items-center mb-1" style="color : gray !important">
                                                    <i style="width: 20px; height : 20px" data-feather="clock"></i>
                                                    <div class="item-price">{{ $schedule->start_time }} - {{ $schedule->end_time }}</div>
                                                </div>
                                                <div class="d-flex align-items-center" style="color : gray !important">
                                                    <i style="width: 20px; height : 20px" data-feather="briefcase"></i>
                                                    <div class="item-price">{{ mb_strimwidth($customer->name, 0, 23, "...") }}</div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="sortable-handler"></div>
                                          </li>
                                        </a>
                                    @endforeach
                                      
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- Job List -->                    
            </div>    
        </div>
    </div>
    
@endsection