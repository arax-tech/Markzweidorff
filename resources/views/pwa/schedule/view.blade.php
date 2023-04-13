@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'Vagtplan')
@section('header-title', "Vagtplan")
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
    .bg-primary0{background: #673ab7ad !important}
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

@endsection

@php
    error_reporting(0);
    $staff = DB::table('users')->where('id', $schedule->staff_id)->first();
    $customer = DB::table('customers')->where('id', $schedule->customer_id)->first();
    $notes = DB::table('schedule_notes')->where(['schedule_id' => $schedule->id, 'visibility' => "Yes"])->get();

    $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
    $vehicle = DB::table('vehicles')->where('id', $schedule->vehicle_id)->first();

    $locationsArray = explode(",", $schedule->customer_loactions);
    $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();

    $groupsArray = explode(",", $schedule->staff_groups);
    $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
@endphp

@section('content')
    <div class="page-content">
        <div class="content-body mb-70" >
            <div class="container"> 
                <div class="border-bottom mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            @php
                                $day = date('D', strtotime($schedule->date));
                                $month = date('M', strtotime($schedule->date));
                                $date = date('j', strtotime($schedule->date));
                                $year = date('Y', strtotime($schedule->date));
                            @endphp
                            <h5 class="title">
                                @if ($day == "Mon") Mandag @elseif ($day == "Tue") Tirsdag @elseif ($day == "Wed") Onsdag @elseif ($day == "Thu") Torsdag @elseif ($day == "Fri") Fredag @elseif ($day == "Sat") Lørdag @elseif ($day == "Sun") Søndag @endif den {{ $date }}. @if ($month == "Jan") Januar @elseif($month == "Feb") Februar @elseif($month == "Mar") Marts @elseif($month == "Apr") April @elseif($month == "May") Maj @elseif($month == "Jun") Juni @elseif($month == "Jul") Juli @elseif($month == "Aug") August @elseif($month == "Sep") September @elseif($month == "Oct") Oktober @elseif($month == "Nov") November @elseif($month == "Dec") December    @endif {{ $year }}
                            </h5>
                            <div class="d-flex align-items-center mt-2">
                                <i style="width: 15px; height: 15px; margin-right: 3px" data-feather="clock"></i> 
                                <span>{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                            </div>
                            <div class="d-flex align-items-center mt-1">
                                <i style="width: 15px; height: 15px; margin-right: 3px" data-feather="briefcase"></i> 
                                <span>{{ $customer->name }}</span>
                            </div>
                        </div>
                        <div class="ms-3">
                            @if ($AlreadyApplied > 0) 
                                <div class="schedule-status-container bg-primary0">
                                    <i class="schedule-status-icon" data-feather="plus-circle"></i>
                                </div>
                            @else 
                                <div class="schedule-status-container @if ($schedule->status == "Pending") bg-info @elseif($schedule->status == "Accepted") bg-success @else bg-danger @endif">
                                    @if ($schedule->status == "Pending") <i class="schedule-status-icon" data-feather="circle"></i> @elseif($schedule->status == "Accepted") <i class="schedule-status-icon" data-feather="check-circle"></i> @else <i class="schedule-status-icon" data-feather="alert-circle"></i> @endif
                                    
                                </div>
                            @endif
                            
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
                               <button class="nav-link active" id="home-tab2" data-bs-toggle="tab" data-bs-target="#home-tab-pane2" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Info</button>
                           </li>
                           <li class="nav-item" role="presentation">
                               <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#profile-tab-pane2" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Noter</button>
                           </li>
                           <li class="nav-item" role="presentation">
                               <button class="nav-link" id="content-tab2" data-bs-toggle="tab" data-bs-target="#contact-tab-pane2" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Kontakt</button>
                           </li>
                       </ul>
                   </div>
                   <div class="tab-content" id="myTabContent2">
                       <div class="tab-pane fade show active" id="home-tab-pane2" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                           <div class="box mb-3">
                               <div class="border-bottom">
                                   <div class="d-flex align-items-center p-3">
                                       
                                       <div class="">
                                           <span class="d-block mb-2 text-primary" style="font-size: 10px; letter-spacing: 1px;">KOMPETENCENIVEAU</span>
                                           <div class="swiper-containers tag-group team-swiper-4">
                                               <div class="d-flex align-content-center flex-row flex-wrap">
                                                   @php
                                                       $groupsArray = explode(",", $schedule->staff_groups);
                                                       $groups = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                                                   @endphp
                                                   @foreach ($groups as $group) 
                                                       <div class="swiper-slide mr-2" style="margin-right: 10px; margin-bottom: 10px">
                                                           <a href="javascript:void(0);" class="tag-btn" style="background: {{ $group->background }} !important; color : {{ $group->color }} !important; font-size: 10px !important">{{ $group->name }}</a>                                    
                                                       </div>
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
                                           <span class="d-block mb-2 text-primary" style="font-size: 10px;  letter-spacing: 1px;">AFDELING</span>
                                           <div class="swiper-container tag-group team-swiper-4">
                                               <div class="swiper-wrapper">
                                                   @php
                                                       $locationsArray = explode(",", $schedule->customer_loactions);
                                                       $locations = DB::table('user_locations')->whereIn('id', $locationsArray)->get();
                                                   @endphp
                                                   @foreach ($locations as $location) 
                                                       <div class="swiper-slide">
                                                           <a href="javascript:void(0);" class="tag-btn" style="font-size: 10px !important">{{ $location->location }}</a>                                    
                                                       </div>
                                                   @endforeach
                                               </div>
                                           </div>                  
                                       </div>
                                   </div>
                               </div>
                           </div>

                           <div class="box mb-3">
                              @if ($vehicle)
                                  <div class="p-3">
                                <span class="d-block mb-2 text-primary" style="font-size: 10px;  letter-spacing: 1px;">KØRETØJ</span>
                                  <h5 class="mb-2">{{ $vehicle->name }}</h5>
                                          
                                      <p class="para-title">
                                          {{ $vehicle->work_title }} <br>
                                          {{ $vehicle->bank_information }}
                                      </p>
                                  </div>
                              @endif
                           </div>
                           <div class="box mb-3">
                              @if ($assignment)
                                  <div class="p-3">
                                <span class="d-block mb-2 text-primary" style="font-size: 10px;  letter-spacing: 1px;">ADRESSE</span>
                                  <h5 class="mb-2">{{ $assignment->name }}</h5>
                                          
                                      <p class="para-title">
                                          {{ $assignment->co_line }} {{ $assignment->street_navn }} {{ $assignment->street_no }} {{ $assignment->street_level }} <br>
                                          {{ $assignment->po_code }} {{ $assignment->city_name }} <br>
                                          {{ $assignment->country }}
                                          <br>
                                        <i>{{ $assignment->information }}</i>
                                      </p>
                                  </div>
                              @endif
                           </div>

                           <div class="box mb-3" style="padding: 0px !important">
                              @if ($assignment)
                                  <div id="map"></div>
                              @endif
                           </div>


                           <a class="btn btn-info w-100 btn-rounded flex-1" href="https://www.google.com/maps/place/{{ $assignment->street_navn }}+{{ $assignment->street_no }}+{{ $assignment->po_code }}+{{ $assignment->city_name }}+{{ $assignment->country }}"><i style="width: 18px; height: 18px" data-feather="navigation"></i>&nbsp;Google Maps</a>
                       </div>
                       <div class="tab-pane fade" id="profile-tab-pane2" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            @if (count($notes) > 0)
                                @foreach ($notes as $note)
                                @php
                                    $user = DB::table('users')->where('id', $note->user_id)->first();
                                @endphp
                                   <div class="box mb-3">
                                       <div class="p-3">
                                           <span class="d-block mb-1 text-primary" style="font-size: 10px;  letter-spacing: 1px;">{{ $user->name }}&nbsp; ({{ date('d M Y, H:i A', strtotime($note->created_at)) }})</span>
                                           
                                           <p class="para-title" style="font-weight: bold !important; margin-bottom: -5px">{{ $note->title }}</p>
                                           <p class="mb-0">{{ $note->description }}</p>
                                       </div>
                                   </div>
                                @endforeach
                            @endif
                       </div>
                       <div class="tab-pane fade" id="contact-tab-pane2" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">


                            @if ($assignment->contact_person_id)
                                @php
                                    $contact_person = DB::table('customer_contacts')->where('id', $assignment->contact_person_id)->first();
                                @endphp

                                 <div class="box mb-3">
                                     <br>
                                     <span class=" mb-2 text-primary" style="font-size: 10px; display: block; padding: 0px 16px !important;  margin-bottom: 12px !important; letter-spacing: 1px; text-transform: uppercase;">KONTAKTPERSON HOS KUNDEN</span>
                                    <div class="container company-detail">
                                     <div class="detail-content" style="margin-bottom: -18px !important; border-bottom: none !important;">
                                         <div class="flex-1">
                                             <h4>{{ $contact_person->name }}</h4>
                                             <p>{{ $contact_person->position }}</p>
                                         </div>
                                     </div>
                                        <ul class="contact-box">
                                            <li class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="contact-icon">
                                                    <svg class="text-primary" width="24" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M26.2806 19.775C26.2089 19.7181 21 15.9635 19.5702 16.233C18.8877 16.3538 18.4975 16.8193 17.7144 17.7511C17.5884 17.9016 17.2856 18.2621 17.0503 18.5185C16.5553 18.3571 16.0726 18.1606 15.6056 17.9305C13.1955 16.7571 11.2481 14.8098 10.0747 12.3996C9.84451 11.9327 9.648 11.45 9.48675 10.955C9.744 10.7188 10.1045 10.416 10.2585 10.2865C11.186 9.50775 11.6524 9.1175 11.7731 8.43325C12.0208 7.01575 8.26875 1.771 8.22937 1.72375C8.05914 1.48056 7.83698 1.27825 7.57896 1.13147C7.32095 0.984676 7.03353 0.897075 6.7375 0.875C5.21675 0.875 0.875 6.50737 0.875 7.45587C0.875 7.511 0.954625 13.1145 7.8645 20.1434C14.8864 27.0454 20.489 27.125 20.5441 27.125C21.4935 27.125 27.125 22.7832 27.125 21.2625C27.1032 20.9675 27.0161 20.681 26.8701 20.4238C26.724 20.1666 26.5227 19.945 26.2806 19.775Z" fill="#40189D"/>
                                                    </svg>
                                                </a>
                                                <div class="ms-3">
                                                    <p class="mb-2">Telefon</p>    
                                                    <h6><a href="javascript:void(0);">{{ $contact_person->phone }}</a></h6>    
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center my-3">
                                                <a href="javascript:void(0);" class="contact-icon">
                                                    <svg class="text-primary" width="24" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M27.0761 6.24662C26.9621 5.48439 26.5787 4.78822 25.9955 4.28434C25.4123 3.78045 24.6679 3.50219 23.8972 3.5H4.10295C3.33223 3.50219 2.58781 3.78045 2.00462 4.28434C1.42143 4.78822 1.03809 5.48439 0.924072 6.24662L14.0001 14.7079L27.0761 6.24662Z" fill="#40189D"/>
                                                        <path d="M14.4751 16.485C14.3336 16.5765 14.1686 16.6252 14 16.6252C13.8314 16.6252 13.6664 16.5765 13.5249 16.485L0.875 8.30025V21.2721C0.875926 22.1279 1.2163 22.9484 1.82145 23.5535C2.42659 24.1587 3.24707 24.4991 4.10288 24.5H23.8971C24.7529 24.4991 25.5734 24.1587 26.1786 23.5535C26.7837 22.9484 27.1241 22.1279 27.125 21.2721V8.29938L14.4751 16.485Z" fill="#40189D"/>
                                                    </svg>
                                                </a>
                                                <div class="ms-3">
                                                    <p class="mb-2">E-mail</p>    
                                                    <h6><a href="javascript:void(0);">{{ $contact_person->email }}</a></h6>    
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            @endif


                            @php
                              $sameSchedules = DB::table('schedules')->where(['start_time' => $schedule->start_time, 'end_time' => $schedule->end_time, 'date' => $schedule->date, 'vehicle_id' => $schedule->vehicle_id, 'status' => 'Accepted' ])->get();
                            @endphp
                            @if ($sameSchedules)
                                
                                @foreach ($sameSchedules as $schedule00)
                                    @php
                                        $uuser = DB::table('users')->where('id', $schedule00->staff_id)->first();
                                    @endphp
                                    @if ($schedule->staff_id != $schedule00->staff_id)
                                      <div class="box mb-3">
                                           <br>
                                           <span class=" mb-2 text-primary" style="font-size: 10px; display: block; padding: 0px 16px !important;  margin-bottom: 12px !important; letter-spacing: 1px; text-transform: uppercase;">KOLLEGA PÅ KØRETØJET</span>
                                          <div class="container company-detail">
                                           <div class="detail-content" style="margin-bottom: -18px !important; border-bottom: none !important;">
                                               <div class="flex-1">
                                                   <h4>{{ $uuser->name }}</h4>
                                                   <p>{{ $uuser->note }}</p>
                                               </div>
                                           </div>
                                              <ul class="contact-box">
                                                  <li class="d-flex align-items-center">
                                                      <a href="javascript:void(0);" class="contact-icon">
                                                          <svg class="text-primary" width="24" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                              <path d="M26.2806 19.775C26.2089 19.7181 21 15.9635 19.5702 16.233C18.8877 16.3538 18.4975 16.8193 17.7144 17.7511C17.5884 17.9016 17.2856 18.2621 17.0503 18.5185C16.5553 18.3571 16.0726 18.1606 15.6056 17.9305C13.1955 16.7571 11.2481 14.8098 10.0747 12.3996C9.84451 11.9327 9.648 11.45 9.48675 10.955C9.744 10.7188 10.1045 10.416 10.2585 10.2865C11.186 9.50775 11.6524 9.1175 11.7731 8.43325C12.0208 7.01575 8.26875 1.771 8.22937 1.72375C8.05914 1.48056 7.83698 1.27825 7.57896 1.13147C7.32095 0.984676 7.03353 0.897075 6.7375 0.875C5.21675 0.875 0.875 6.50737 0.875 7.45587C0.875 7.511 0.954625 13.1145 7.8645 20.1434C14.8864 27.0454 20.489 27.125 20.5441 27.125C21.4935 27.125 27.125 22.7832 27.125 21.2625C27.1032 20.9675 27.0161 20.681 26.8701 20.4238C26.724 20.1666 26.5227 19.945 26.2806 19.775Z" fill="#40189D"/>
                                                          </svg>
                                                      </a>
                                                      <div class="ms-3">
                                                          <p class="mb-2">Telefon</p>    
                                                          <h6><a href="javascript:void(0);">{{ $uuser->phone }}</a></h6>    
                                                      </div>
                                                  </li>
                                                  <li class="d-flex align-items-center my-3">
                                                      <a href="javascript:void(0);" class="contact-icon">
                                                          <svg class="text-primary" width="24" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                              <path d="M27.0761 6.24662C26.9621 5.48439 26.5787 4.78822 25.9955 4.28434C25.4123 3.78045 24.6679 3.50219 23.8972 3.5H4.10295C3.33223 3.50219 2.58781 3.78045 2.00462 4.28434C1.42143 4.78822 1.03809 5.48439 0.924072 6.24662L14.0001 14.7079L27.0761 6.24662Z" fill="#40189D"/>
                                                              <path d="M14.4751 16.485C14.3336 16.5765 14.1686 16.6252 14 16.6252C13.8314 16.6252 13.6664 16.5765 13.5249 16.485L0.875 8.30025V21.2721C0.875926 22.1279 1.2163 22.9484 1.82145 23.5535C2.42659 24.1587 3.24707 24.4991 4.10288 24.5H23.8971C24.7529 24.4991 25.5734 24.1587 26.1786 23.5535C26.7837 22.9484 27.1241 22.1279 27.125 21.2721V8.29938L14.4751 16.485Z" fill="#40189D"/>
                                                          </svg>
                                                      </a>
                                                      <div class="ms-3">
                                                          <p class="mb-2">E-mail</p>    
                                                          <h6><a href="javascript:void(0);">{{ $uuser->email }}</a></h6>    
                                                      </div>
                                                  </li>
                                                  
                                              </ul>
                                          </div>
                                      </div>
                                    @endif
                                @endforeach
                                
                            @endif

                            
                       </div>
                   </div>
               </div>

                

                
            </div>    
        </div>
    </div>

    <!-- Footer -->

    @if ($schedule->staff_id == "0")
        @if ($AlreadyApplied > 0)
            @include('pwa.layouts.include.bottom-menu')
        @else
            <div class="footer fixed bg-white">
                <div class="container">
                    <div class="footer-btn d-flex align-items-center">
                        {{-- <a  href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#ApplyModal" class="btn @if ($AlreadyApplied > 0) bg-primary0 text-white @else btn-success @endif btn-rounded flex-1 ms-2 @if ($AlreadyApplied > 0) disabled @endif">@if ($AlreadyApplied > 0) <i class="" data-feather="plus-circle"></i>&nbsp; Anmodet om denne vagt @else Anmod om vagt @endif </a> --}}

                        <a class="btn bg-primary0 text-white w-100 btn-rounded flex-1" href="javascript::" data-bs-toggle="offcanvas" data-bs-target="#ApplyModal"><i style="width: 18px; height: 18px" data-feather="plus-circle"></i>&nbsp;Anmod om vagt</a>
                    </div>
                </div>
            </div>
        @endif
    @elseif ($schedule->status == "Pending")

        <div class="footer fixed bg-white">
            <div class="container">
                <div class="footer-btn d-flex align-items-center">
                    <a  href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#StatusModal" class="btn btn-primary btn-rounded flex-1 ms-2">Accepter eller Afvis</a>
                </div>
            </div>
        </div>
    @else
        @include('pwa.layouts.include.bottom-menu')
    @endif

    <!-- Option Bar -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="StatusModal">
        <div class="container">
            <div class="offcanvas-body small text-center">
                <i class="fa fa-4x fa-info-circle text-primary"></i>
                <h5 class="m-t15 m-b10">Skift status på vagten</h5>
                <p>Du skal vælge om du vil acceptere eller afvise denne vagt!</p>
                <div class="text-center m-t20">
                    {{-- <a href="{{ url('/pwa/schedule/status/Pending/'.$schedule->id) }}" class="btn btn-sm btn-info me-2">Pending</a> --}}
                    <a href="{{ url('/pwa/schedule/status/Accepted/'.$schedule->id) }}" class="btn btn-sm btn-success me-3" style="width:130px">Accepter</a>
                    <a href="{{ url('/pwa/schedule/status/Declined/'.$schedule->id) }}" class="btn btn-sm btn-danger me-2" style="width:130px">Afvis</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->



    <!-- Appyu Now Bar -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="ApplyModal">
        <div class="container">
            <div class="offcanvas-body small text-center">
                <i class="fa fa-4x fa-info-circle text-primary"></i>
                <h5 class="m-t15 m-b10">Apply for Shift</h5>
                <p>Apply fot this shift when admin approve you will got email notification!</p>
                <div class="text-center m-t20">
                    {{-- <a href="{{ url('/pwa/schedule/status/Pending/'.$schedule->id) }}" class="btn btn-sm btn-info me-2">Pending</a> --}}
                    <a href="{{ url('/pwa/schedule/apply/'.$schedule->id) }}" class="btn btn-sm btn-success me-3 @if ($AlreadyApplied > 0) disabled @endif" style="width:130px">Apply Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    
@endsection

@section('js')
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>


    <script type="text/javascript">
        $(function() {


            let mapOptions = {
                center : [{{ $response[0]['lat'] }}, {{ $response[0]['lon'] }}],
                zoom : 100
            }

            let map = new L.map('map', mapOptions);

            let layer = new L.TileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
            map.addLayer(layer);

            let marker = new L.Marker([{{ $response[0]['lat'] }}, {{ $response[0]['lon'] }}],
                {alt: '{{ $response[0]['address']['country'] }}' }).addTo(map) // "Denmark" is the accessible name of this marker
                .bindPopup('{{ $response[0]['display_name'] }}');
            marker.addTo(map)

            
        });
    </script>


@endsection