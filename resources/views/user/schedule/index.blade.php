@extends('user.layouts.app')
@section('title', 'Vagtplan')
@include('user.schedule.include.css')
@php

    error_reporting(0);


    $array = auth::user()->permissions;
    $permission = explode(",", $array);

    $scheduleArray = auth::user()->schedule_settings;
    $schedulePermission = explode(",", $scheduleArray);

    use Carbon\Carbon;


    $vehicles = DB::table('vehicles')->get();

    $week = '';
    $year = '';
    $thisWeek = '';
    // dd(request()->week);
    if (request()->week)
    {
        $weekNumber = explode("-W", request()->week);
        $thisWeek = request()->week;
        $year = $weekNumber[0];
        $week = $weekNumber[1];
    }







    $currentYear = $year; // jahr means year
    $selectedWeek   = $week;   // kw contains week


    $weekBack['kw'] = date ("W", strtotime ($currentYear. 'W' . str_pad ($selectedWeek, 2, 0, STR_PAD_LEFT). ' -1 week'));
    $weekBack['jahr'] = date ("o", strtotime ($currentYear. 'W' . str_pad ($selectedWeek, 2, 0, STR_PAD_LEFT). ' -1 week'));

    $weekNext['kw'] = date ("W", strtotime ($currentYear. 'W' . str_pad ($selectedWeek, 2, 0, STR_PAD_LEFT). ' +1 week'));
    $weekNext['jahr'] = date ("o", strtotime ($currentYear. 'W' . str_pad ($selectedWeek, 2, 0, STR_PAD_LEFT). ' +1 week'));

    $previousWeek = $weekBack['jahr'] ."-W".$weekBack['kw'];
    $currentWeek = $currentYear."-W".$selectedWeek;
    $nextWeek = $weekNext['jahr']."-W".$weekNext['kw'];





    $lastWeekNumber = date( 'W', strtotime('last week'));
    $nextWeekNumber = date( 'W', strtotime('next week'));


    $AllUser = DB::table('users')->orderBy('name', 'ASC')->get();
    $AllCustomers = DB::table('customers')->orderBy('name', 'ASC')->get();

    if(request()->active == "Customer"){
        $scheduleUser = DB::table('customers')->orderBy('name', 'ASC')->get();
    }else{
        $scheduleUser = DB::table('users')->orderBy('name', 'ASC')->get();
    }

    $groups = DB::table('user_groups')->get();
    $locations = DB::table('user_locations')->get();

    function daysInWeek($weekNum)
    {
        $result = array();
        $datetime = new DateTime('00:00:00');
        $datetime->setISODate((int)$datetime->format('o'), $weekNum, 1);
        $interval = new DateInterval('P1D');
        $week = new DatePeriod($datetime, $interval, 6);

        foreach($week as $day){
            $result[] = $day->format('D-|-M-|-Y-|-d-|-m-|-l-|-j');
        }
        return $result;
    }




    $dateTime = new DateTime();
    $dateTime->setISODate($year, $week);
    $weekRange['start_date'] = $dateTime->format('Y-m-d');
    $dateTime->modify('+6 days');
    $weekRange['end_date'] = $dateTime->format('Y-m-d');


    $schedulesPending = DB::table('schedules')->where(['status' => 'Pending'])->whereBetween('date', $weekRange)->count();
    $schedulesAccepted = DB::table('schedules')->where(['status' => 'Accepted'])->whereBetween('date', $weekRange)->count();
    $schedulesDeclined = DB::table('schedules')->where(['status' => 'Declined'])->whereBetween('date', $weekRange)->count();
    $schedulesNotPublished = DB::table('schedules')->where(['visibility' => 'NotPublished'])->whereBetween('date', $weekRange)->count();
    $AllschedulesNotPublished = DB::table('schedules')->where(['visibility' => 'NotPublished'])->whereBetween('date', $weekRange)->get();
    $schedulesPublished = DB::table('schedules')->where(['visibility' => 'Published'])->whereBetween('date', $weekRange)->count();

    $total_weekly_hours = DB::table('schedules')->whereBetween('date', $weekRange)->sum('total_hours');
    $total_weekly_hours_amount = DB::table('schedules')->whereBetween('date', $weekRange)->sum('total_hourly_wags');


    // dd($thisWeek);

@endphp

@section('content')
@section('content')
<header id="leftMargin" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="@if (auth::user()->sidebar == "Show") padding: 0px 20px 0px 260px ; @else padding: 0px 20px 0px 20px; @endif top: 58px ;">

    <div class="page-controls d-flex align-items-center justify-content-between">
        <div class="left-controls">

            <div class="page-filters mb-2 mt-2" >



                <div class="filter-scopes my-2">


                    <a data-toggle="tooltip" title="Afvist" class="scope shift-confirmed bg-danger text-white" href="#"><i data-feather="alert-circle" style="margin-top: 2px"></i>
                        <span class="count">{{ $schedulesDeclined }}</span>
                    </a>

                    <a data-toggle="tooltip" title="Afventer" class="scope bg-warning text-white" href="#">
                        <i data-feather="help-circle" style="margin-top: 2px"></i>
                        <span class="count">{{ $schedulesPending }}</span>
                    </a>

                    <a data-toggle="tooltip" title="Accepteret" class="scope bg-success text-white" href="#">
                        <i data-feather="check-circle" style="margin-top: 2px"></i>
                        <span class="count">{{ $schedulesAccepted }}</span>
                    </a>

                    <a data-toggle="tooltip" title="Skjult" class="scope" style="background-image: repeating-linear-gradient(-45deg, white, white 5px, #eff4f8 5px, #eff4f8 10px) !important;" href="#">
                        <i data-feather="eye-off" style="margin-top: 2px"></i>
                        <span class="count">{{ $schedulesNotPublished }}</span>
                    </a>

                    <a data-toggle="tooltip" title="Udgivet" class="scope" style="background: #f2f2f2 !important; color: #31353d !important" href="#">
                        <i data-feather="eye" style="margin-top: 2px"></i>
                        <span class="count">{{ $schedulesPublished }}</span>
                    </a>&nbsp;&nbsp;


                </div>



            </div>
        </div>

        <div style="">
            <div class="date-range-picker btn-group">
                <a style="background-color: #f2f6fc;" class="angle-left btn btn-default" href="{{ url('/schedule?week='.$previousWeek.'&active='.request()->active) }}">
                    <i data-feather="chevron-left" style="margin-top: 2px;"></i>

                </a>

                <a style="background-color: #f2f6fc;" class="picker btn btn-default"  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#DatePicker">
                    <i data-feather="calendar" style="margin-top: 1px;"></i>

                    @foreach (daysInWeek($week) as $key => $value)
                        @php
                            error_reporting(0);
                            $AllArray = explode("-|-", $value);
                        @endphp


                        <span data-target="layouts--date-range-picker.pickerText">
                            @if ($key == 0) {{ $AllArray[6] }}. @if ($AllArray[1] == "Jan") Januar @elseif($AllArray[1] == "Feb") Februar @elseif($AllArray[1] == "Mar") Marts @elseif($AllArray[1] == "Apr") April @elseif($AllArray[1] == "May") Maj @elseif($AllArray[1] == "Jun") Juni @elseif($AllArray[1] == "Jul") Juli @elseif($AllArray[1] == "Aug") August @elseif($AllArray[1] == "Sep") September @elseif($AllArray[1] == "Oct") Oktober @elseif($AllArray[1] == "Nov") November @elseif($AllArray[1] == "Dec") December    @endif @endif
                            <span style="margin-right: -2.5px">@if ($key==0)-@endif</span>
                            @if($key == 6){{ $AllArray[3] }}. @if ($AllArray[1] == "Jan") Januar @elseif($AllArray[1] == "Feb") Februar @elseif($AllArray[1] == "Mar") Marts @elseif($AllArray[1] == "Apr") April @elseif($AllArray[1] == "May") Maj @elseif($AllArray[1] == "Jun") Juni @elseif($AllArray[1] == "Jul") Juli @elseif($AllArray[1] == "Aug") August @elseif($AllArray[1] == "Sep") September @elseif($AllArray[1] == "Oct") Oktober @elseif($AllArray[1] == "Nov") November @elseif($AllArray[1] == "Dec") December    @endif {{ $currentYear }} @endif
                        </span>
                    @endforeach


                </a>

                <a style="background-color: #f2f6fc;" class="picker btn btn-default"  href="{{ url('/schedule?week='.date('Y')."-W".date("W").'&active='.request()->active) }}">
                    <span data-target="layouts--date-range-picker.pickerText">
                        I dag
                    </span>
                </a>

                <div class="dropdown">
                <a data-toggle="dropdown" data-target="#" class="btn btn-default" href="javascript:void(0);" style="width: 100px; background-color: #f2f6fc;">Uge</a>
                    <div class="dropdown-menu week-topbar-dropdown-menu" style="width: 200px;">
                        <div class="dropdown-menu-inner">
                            <a class="dropdown-item" href="{{ url('/schedule?week='.$thisWeek.'&active='.request()->active) }}"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="calendar"></i> Uge</a>
                        </div>
                        <div class="dropdown-menu-inner">
                            <a class="dropdown-item" href="#"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="calendar"></i> 14 dage</a>
                        </div>
                        <div class="dropdown-menu-inner">
                            <a class="dropdown-item" href="#"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="calendar"></i> Måned</a>
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <a data-toggle="dropdown" data-target="#" class="btn btn-default" href="javascript:void(0);" style="width: 140px; background-color: #f2f6fc;">{{ request()->active === "Staff" ? "Personale" : "Kunder" }}</a>
                    <div class="dropdown-menu week-topbar-dropdown-menu" style="width: 200px;">
                        <div class="dropdown-menu-inner">
                            <a class="dropdown-item {{ request()->active === "Customer" ? "active" : "" }}" href="{{ url('/schedule?week='.$thisWeek.'&active=Customer') }}" ><i class="dropdown-item-icon" style="color: {{ request()->active === "Customer" ? "#fff" : "#a7aeb8" }} !important; height: 0.9em; width: 0.9em;" data-feather="briefcase"></i> Kunder</a>
                        </div>
                        <div class="dropdown-menu-inner">
                            <a class="dropdown-item  {{ request()->active === "Staff" ? "active" : "" }}" href="{{ url('/schedule?week='.$thisWeek.'&active=Staff') }}"><i class="dropdown-item-icon" style="color: {{ request()->active === "Staff" ? "#fff" : "#a7aeb8" }} !important; height: 0.9em; width: 0.9em;" data-feather="user"></i> Personale</a>
                        </div>
                    </div>
                </div>



                <a style="background-color: #f2f6fc;" class="angle-right btn btn-default btn-right-arrow" href="{{ url('/schedule?week='.$nextWeek.'&active='.request()->active) }}">
                    <i data-feather="chevron-right" style="margin-top: 2px;"></i>
                </a>
            </div>

        </div>


        <div class="d-flex flex-row">


            <div class="page-filters mb-2 mt-2" >


                <div class="filter-scopes my-2">

                    <button class="btn btn-sm btn-primary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="me-1" data-feather="menu"></i>  &nbsp;Funktioner&nbsp;
                    </button>&nbsp;
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item CanNotWorkModal" href="javascript::"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="thumbs-up"></i> Tilgængelighed</a></li>
                        <li><a class="dropdown-item"  href="javascript::" data-bs-toggle="modal" data-bs-target="#PublishAll"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="check"></i> Udgiv vagtplan</a></li>
                        <li><a class="dropdown-item"  href="javascript::" data-bs-toggle="modal" data-bs-target="#ScheduleSetting"><i class="dropdown-item-icon" style="color: #a7aeb8 !important; height: 0.9em; width: 0.9em;" data-feather="sliders"></i> Indstillinger</a></li>
                    </ul>

                </div>



            </div>





        </div>
    </div>


</header>
<br><br><br>

<!-- Main page content-->
<div class="container-fluid text m-auto p-4" >

    <div class="modal fade" id="DatePicker">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="calendar"></i> Vælg uge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ url('/schedule?week='.$thisWeek.'&active='.request()->active) }}">


                        <div class="input-group">
                            <label for="date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="me-1" data-feather="calendar"></i></span>
                                </div>
                            </label>
                            <input type="week" class="form-control input" name="week" onfocus="this.showPicker()" id="date" required value="{{ $thisWeek }}"  onchange="this.form.submit()">
                        </div>
                        <input type="hidden" name="active" value="{{ request()->active }}" class="form-control">
                    </form>
                </div>
                <div class="card-footer bg-light">
                    <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CanNotWork"  data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="post" id="NotWorkingForm" action="{{ url('/schedule/not/working') }}">
                    @csrf


                    <div class="modal-header bg-light">
                        <h5 class="modal-title d-flex align-items-center justify-content-center NotWorkingModalTitlle"><i class="me-1" data-feather="thumbs-up"></i> Tilgængelighed</h5>
                        <button type="button" class="btn-close NotWorkingModalClose"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row gx-3 mb-3">
                            <div class="col-md-12">

                                <label class="small mb-1">Vælg personale</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="{{ request()->active == "Staff" ? "user" : "briefcase" }}"></i></span>
                                    </div>

                                    <select class="form-control w-100 custom-select staff_id" name="staff_id" id="staff_id0" required>
                                        @foreach ($AllUser as $user92)
                                            <option  value="{{ $user92->id }}" >{{ $user92->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="customer_id" value="0">



                                </div>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-2">
                                <label class="small mb-1">Hele dagen </label>
                                <div class="form-check form-switch pt-2">
                                    <input class="form-check-input all-days-switch" id="all-days-switch" value="Yes" type="checkbox" name="all_day" checked="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1">Dato </label>
                                <div class="input-group mb-3">
                                    <label for="date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="me-1" data-feather="calendar"></i></span>
                                        </div>
                                    </label>
                                    <input type="date" class="form-control input" name="date" onfocus="this.showPicker()" id="date0" required value="{{ $schedule->date }}">
                                </div>
                            </div>

                            <div class="col-md-3 time_not_working">
                                <label class="small mb-1">Start tid </label>
                                <div class="input-group mb-3">
                                    <label for="start_time_not">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="me-1" data-feather="clock"></i></span>
                                        </div>
                                    </label>
                                    <input type="time" class="form-control input" name="start_time"  id="start_time_not" onfocus="this.showPicker()" id="" value="08:00">
                                </div>
                            </div>
                            <div class="col-md-3 time_not_working">
                                <label class="small mb-1">Slut tid</label>
                                <div class="input-group mb-3">
                                    <label for="end_time_not">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="me-1" data-feather="clock"></i></span>
                                        </div>
                                    </label>
                                    <input type="time" class="form-control input" name="end_time" onfocus="this.showPicker()" value="17:00" id="end_time_not">
                                </div>


                            </div>

                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-8">
                                <label class="small mb-1">Note </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light" style="height: 2.88rem !important;""><i class="me-1" data-feather="file-plus"></i></span>
                                    </div>
                                    <input type="text" class="form-control input" name="note" id="note0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1">Status </label>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light" id="CanNotWorkStatus" style=" height: 2.88rem !important;""><i class="me-1" data-feather="thumbs-down"></i></span>
                                    </div>

                                    <select class="form-control" name="status" id="status0" required>
                                        <option value="NotWork">Kan ikke arbejde</option>
                                        <option value="Work">Kan arbejde</option>
                                        <option value="Vactions">Ferie</option>
                                    </select>



                                </div>
                            </div>


                        </div>




                    </div>
                    <div class="card-footer bg-light" style="margin-bottom: -32px !important">
                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button>
                        <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center notWorkingActionButton" type="submit"><i class="me-1" data-feather="plus"></i> Opret</button>
                        <span class="notWorkingActionDelete">
                            <a id="notWorkingActionA" class="btn btn-danger btn-sm float-end d-flex align-items-center justify-content-center" href="" style="margin-right: 10px !important" onclick="return confirm('Are you sure to delete ?')"><i class="me-1" data-feather="trash-2"></i> Delete</a>
                        </span>

                    </div>
                </form>
                <div id="NotWorkingLoading" style="padding: 100px">
                    <center>
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="PublishAll">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="post" action="{{ url('/schedule/publish/shifts') }}">
                    @csrf


                    <div class="modal-header bg-light">
                        <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="calendar"></i> Udgiv vagter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row gx-3 mb-3">
                            @foreach (daysInWeek($week) as $key => $value9)
                                @php
                                    error_reporting(0);
                                    $AllArray9 = explode("-|-", $value9);
                                @endphp

                                @if ($key == 0)
                                    <div class="col-md-6">
                                        <label class="small mb-1">Start dato </label>
                                        <div class="input-group mb-3">
                                            <label for="start_date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="me-1" data-feather="calendar"></i></span>
                                                </div>
                                            </label>
                                            <input type="date" onfocus="this.showPicker()" class="form-control input" name="start_date" id="start_date" required value="{{ $AllArray9[2]."-".$AllArray9[4]."-".$AllArray9[3] }}">
                                        </div>
                                    </div>
                                @endif

                                @if($key == 6)
                                    <div class="col-md-6">
                                        <label class="small mb-1">Slut dato </label>
                                        <div class="input-group mb-3">
                                            <label for="end_date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="me-1" data-feather="calendar"></i></span>
                                                </div>
                                            </label>
                                            <input type="date" onfocus="this.showPicker()" class="form-control input" name="end_date" id="end_date" required value="{{ $AllArray9[2]."-".$AllArray9[4]."-".$AllArray9[3] }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>



                        <label class="w-100 font-weight-bolder" style="margin:10px 0px;padding: 10px 5px !important; border-bottom: 2px solid #f2f2f2; border-top: 2px solid #f2f2f2;">Omfattede vagter <span class="badge btn-primary float-right" style="float: right !important;" id="totalShifts">{{ count($AllschedulesNotPublished) }}</span></label>

                            {{-- AllschedulesNotPublished --}}


                            <div id="schedule_list" style="max-height: 300px; overflow-x: hidden; overflow-y: scroll;">
                                @foreach ($AllschedulesNotPublished as $NotPublishedSch)

                                    @php
                                        $scUsr = '';
                                        $scUsr1 = DB::table('users')->where('id', $NotPublishedSch->staff_id)->first();

                                        $scUsr2 = DB::table('customers')->where('id', $NotPublishedSch->customer_id)->first();
                                    @endphp


                                    <a class="not-published schedule-item shift ">
                                        <i class="color-border @if ($NotPublishedSch->status == "Pending") bg-warning @elseif ($NotPublishedSch->status == "Accepted") bg-success @elseif ($NotPublishedSch->status == "Declined") bg-danger @endif"></i>
                                        <div class="heading">
                                            <div class="title" style="font-size: 0.74rem !important;">{{ $NotPublishedSch->start_time }} - {{ $NotPublishedSch->end_time }}<span class="time-in-org-tz"></span></div>

                                            </div>
                                            @if ($scUsr1)
                                                <div class="details" style="font-size: 0.74rem !important;"><i data-toggle="tooltip" title="Personale" class="me-1" data-feather="user"></i> {{ $scUsr1->name }}</div>
                                            @endif
                                            @if ($scUsr2)
                                                <div class="details" style="font-size: 0.74rem !important;"><i data-toggle="tooltip" title="Kunder" class="me-1" data-feather="briefcase"></i> {{ $scUsr2->name }}</div>
                                            @endif
                                            <div class="details" style="font-size: 0.74rem !important;"><i class="me-1" data-feather="calendar"></i> {{ date('d M Y', strtotime($NotPublishedSch->date)) }}</div>

                                    </a>
                                @endforeach
                            </div>
                    </div>
                    <div class="card-footer bg-light" style="margin-bottom: -32px !important">
                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button>
                        <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center" type="submit"><i class="me-1" data-feather="check"></i> Udgiv</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ScheduleSetting">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ url('/schedule/setting/update') }}">
                    @csrf


                    <div class="modal-header bg-light">
                        <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="sliders"></i> Schedule Setting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped">
                            <tr>
                                <th>Module</th>
                                <th>Toggle</th>
                            </tr>

                            @php
                                $scheduleSettingArray = explode(",", auth::user()->schedule_settings);
                            @endphp
                            <tr>
                                <td style="vertical-align: middle;">Declined Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="AcceptedSchedule" value="AcceptedSchedule" @if (in_array("AcceptedSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="AcceptedSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Pending Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="PendingSchedule" value="PendingSchedule" @if (in_array("PendingSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="PendingSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Declined Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="DeclinedSchedule" value="DeclinedSchedule" @if (in_array("DeclinedSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="DeclinedSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">NotPublished Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="NotPublishedSchedule" value="NotPublishedSchedule" @if (in_array("NotPublishedSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="NotPublishedSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Published Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="PublishedSchedule" value="PublishedSchedule" @if (in_array("PublishedSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="PublishedSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Staff With Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="StaffWithSchedule" value="StaffWithSchedule" @if (in_array("StaffWithSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="StaffWithSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Customer With Schedule</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="CustomerWithSchedule" value="CustomerWithSchedule" @if (in_array("CustomerWithSchedule", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="CustomerWithSchedule">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Show Money</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="ShowMoney" value="ShowMoney" @if (in_array("ShowMoney", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="ShowMoney">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">Show Time</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="ShowTime" value="ShowTime" @if (in_array("ShowTime", $scheduleSettingArray)) checked="" @endif type="checkbox" name="schedule_settings[]">
                                        <label class="form-check-label" style="margin-top: 3px !important" for="ShowTime">Toggle</label>
                                    </div>
                                </td>
                            </tr>
                        </table>


                    </div>
                    <div class="card-footer bg-light" style="margin-bottom: -32px !important">
                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button>
                        <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center" type="submit"><i class="me-1" data-feather="save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="page-body" style="background: #f2f6fc !important">
        <div class="grid-wrapper assignments week">
            <div class="grid-header">
                <div class="cell cell-header" style="background: #f7f8fa !important;">
                    <div class="filter-extras">
                        <div class="totals">
                            <div>
                                <span class="title" style="color: #F53B54 !important; font-weight: 600; font-size: 0.9rem !important;">Uge
                                    @if ($week < 10)
                                        @php
                                            $week00 = explode(0, $week);
                                            echo $week00[1];
                                        @endphp
                                    @else
                                        {{ $week }}

                                    @endif
                                </span> <br>

                                @if (in_array("ShowMoney", $schedulePermission) && in_array("ShowTime", $schedulePermission))
                                    <small>{{ $total_weekly_hours }} timer / kr. {{ $schedulePermission }}</small>
                                @elseif(in_array("ShowMoney", $schedulePermission))
                                    <small>kr. {{ $schedulePermission }}</small>
                                @elseif(in_array("ShowTime", $schedulePermission))
                                    <small>{{ $total_weekly_hours }} timer </small>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @foreach (daysInWeek($week) as $schvalue)
                    @php
                        $arr = explode("-|-", $schvalue);
                        $queryDate0 = $arr[2]."-".$arr[4]."-".$arr[3];

                        $total_hours = DB::table('schedules')->where(['date' => $queryDate0])->sum('total_hours');
                        $total_hourly_amount = DB::table('schedules')->where(['date' => $queryDate0])->sum('total_hourly_wags');

                    @endphp
                    <div class="cell cell-header @if (date('d') === $arr[3] && date('M') === $arr[1]) borderAH @endif">
                        <div class="title" style="@if (date('d') === $arr[3] && date('M') === $arr[1]) color : #f53b57 !important; @endif">
                            <span class="m-0 p-0" style="margin-bottom: -5px">{{ $arr[6] }}. @if ($arr[1] == "Jan") Januar @elseif($arr[1] == "Feb") Februar @elseif($arr[1] == "Mar") Marts @elseif($arr[1] == "Apr") April @elseif($arr[1] == "May") Maj @elseif($arr[1] == "Jun") Juni @elseif($arr[1] == "Jul") Juli @elseif($arr[1] == "Aug") August @elseif($arr[1] == "Sep") September @elseif($arr[1] == "Oct") Oktober @elseif($arr[1] == "Nov") November @elseif($arr[1] == "Dec") December    @endif
                            <br>
                        @if ($arr[0] == "Mon") Mandag @elseif ($arr[0] == "Tue") Tirsdag @elseif ($arr[0] == "Wed") Onsdag @elseif ($arr[0] == "Thu") Torsdag @elseif ($arr[0] == "Fri") Fredag @elseif ($arr[0] == "Sat") Lørdag @elseif ($arr[0] == "Sun") Søndag @endif</span>
                        </div>
                        <div class="totals">
                            @if (in_array("ShowMoney", $schedulePermission) && in_array("ShowTime", $schedulePermission))
                                <div class=""><small>{{ $total_hours }} timer / kr. {{ $total_hourly_amount }}</small></div>
                            @elseif(in_array("ShowMoney", $schedulePermission))
                                <div class=""><small>kr. {{ $total_hourly_amount }}</small></div>
                            @elseif(in_array("ShowTime", $schedulePermission))
                                <div class=""><small>{{ $total_hours }} timer </small></div>
                            @endif
                        </div>
                    </div>

                @endforeach

            </div>


            <div class="grid drag-container">

                {{-- open Shift --}}
                @if (request()->active == "Customer")
                    <div class="grid-row no-assignment">


                        <div class="cell cell-header" style="background: #f7f8fa !important;">
                            <div class="title" style="margin-top: 15px" data-toggle="tooltip" title="Tilgængelighed.">
                                Tilgængelighed
                                <i data-feather="help-circle"></i>
                            </div>
                            <div class="totals">

                              {{-- <div class=""><small>0 timer</small></div> --}}
                            </div>
                        </div>




                            @foreach (daysInWeek($week) as $key => $wk)
                                @php
                                    error_reporting(0);
                                    $arrx = explode("-|-", $wk);

                                    $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];


                                    $MyNotschedules0 = DB::table('not_working_schedules')->where(['date' => $queryDate])->get();
                                @endphp


                                
                                <div class="cell cells @if (date('d') === $arrx[3] && date('M') === $arrx[1]) borderRL @endif">




                                    @foreach ($MyNotschedules0 as $schedule01)

                                        @php
                                            $notScUsr = DB::table('users')->where('id', $schedule01->staff_id)->first();
                                        @endphp


                                        <a class="filtered schedule-item  updateNotWork schedule-item @if ($schedule01->status == "NotWork") time-off @elseif ($schedule01->status == "Work") time-on @else alert alert-primary @endif" data-id={{ $schedule01->id }}>
                                            <div class="heading">
                                                @if ($schedule01->status == "NotWork")
                                                    <i data-feather="thumbs-down" style="margin-top: -3px !important"></i>&nbsp;
                                                @elseif ($schedule01->status == "Work")
                                                    <i data-feather="thumbs-up" style="margin-top: -3px !important"></i>&nbsp;
                                                @else
                                                    <i data-feather="coffee" style="margin-top: -3px !important"></i>&nbsp;
                                                @endif
                                                <div class="title" style="font-size: 0.74rem !important">
                                                    @if ($schedule01->allDay == "Null")
                                                        {{ $schedule01->start_time }} - {{ $schedule01->end_time }}
                                                    @else
                                                        Hele dagen
                                                    @endif
                                                <span class="time-in-org-tz"></span></div>

                                            </div>
                                            <div class="details">
                                                @if ($schedule01->note)
                                                    <div class="indicators">
                                                        <i class="fa fa-info-circle" style="margin-top: -3px !important" data-toggle="tooltip" title="{{ $schedule01->note }}"></i>&nbsp;{{ mb_strimwidth($notScUsr->name, 0, 14, "...") }}
                                                    </div>
                                                @endif
                                                
                                            </div>
                                        </a>
                                    @endforeach


                                </div>







                            @endforeach


                    </div>
                @endif

                @if (request()->active == "Staff")
                    <div class="grid-row no-assignment">


                        <div class="cell cell-header" style="background: #f7f8fa !important;">
                            <div class="title" data-toggle="tooltip" title="Vagter i denne række er ikke tildelt nogen specifik {{ request()->active }} endnu.">
                                Åbne vagter
                                <i data-feather="help-circle"></i>
                            </div>
                            <div class="totals">
                              <div class=""><small>0 timer / kr. 0</small></div>
                            </div>
                        </div>




                            @foreach (daysInWeek($week) as $key => $wk)
                                @php
                                    error_reporting(0);
                                    $arrx = explode("-|-", $wk);

                                    $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];


                                    if (request()->active == "Customer"){
                                        $Openschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'customer_id' => 0])->get();
                                    }else{
                                        $Openschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'staff_id' => 0])->get();
                                    }
                                @endphp


                                <div class="cell cells @if (date('d') === $arrx[3] && date('M') === $arrx[1]) borderRL @endif">
                                    @foreach ($Openschedules as $schedule0)


                                        @php
                                            $scUsr = '';
                                            $staffUser = "";
                                            $user_groups = "";
                                            $staff_text = "";
                                            if (request()->active == "Customer")
                                            {
                                                $scUsr = DB::table('users')->where('id', $schedule0->staff_id)->first();
                                            }else{
                                                $scUsr = DB::table('customers')->where('id', $schedule0->customer_id)->first();
                                            }

                                            if ($schedule0->staff_id != 0)
                                            {
                                                $staffUser = DB::table('users')->where('id', $schedule0->staff_id)->first();

                                                if (strlen($staffUser->group_id) > 1) {
                                                    $arr = explode(",", $staffUser->group_id);
                                                    foreach ($arr as $key => $arrstaffUser) {
                                                        $group = DB::table('user_groups')->where('id', $arrstaffUser)->first();
                                                        $user_groups .= "," . $group->name;
                                                    }
                                                    $user_groups = rtrim($user_groups,', ');
                                                }else{
                                                    if ($staffUser->group_id == null || $staffUser->group_id == "") {
                                                        $user_groups = "Åbne vagter";
                                                    }else{
                                                        $group = DB::table('user_groups')->where('id', $staffUser->group_id)->first();
                                                        $user_groups = $group->name;
                                                    }
                                                }
                                                $staff_text = $staffUser->name . " || " . $user_groups;
                                            } else {
                                                $staff_text = "Åbne vagter";
                                            }

                                        @endphp



                                        
                                        <a style="border: 1px solid lightgray !important" ref="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" data-id="{{ $schedule0->id }}" date="{{ $schedule0->date }}" assignment-id="{{ $schedule->customer_assignments }}" staff-id="{{ $schedule0->staff_id }}" staff-text="{{ $staff_text }}" user-id="{{ $user000->id }}" class="@if ($schedule0->visibility == "NotPublished") not-published @else published @endif context-menu-one filtered UpdateScheduleFunction schedule-item schedule-dragable-item shift ui-draggable ui-draggable-handle">
                                            <i class="color-border @if ($schedule0->status == "Pending") bg-warning @elseif ($schedule0->status == "Accepted") bg-success @elseif ($schedule0->status == "Declined") bg-danger @endif"></i>
                                            <div class="heading">
                                                <div class="title" style="font-size: 0.74rem !important;">{{ $schedule0->start_time }} - {{ $schedule0->end_time }}<span class="time-in-org-tz"></span></div>
                                            </div>
                                            <div class="details" style="font-size: 0.74rem !important">
                                                {{ mb_strimwidth($scUsr->name, 0, 14, "...") }}<br>
                                                @if ($schedule0->notes)
                                                    <i class="fa fa-info-circle" style="" data-toggle="tooltip" title="{{ $schedule0->notes }}"></i>
                                                @endif
                                            </div>
                                        </a>



                                    @endforeach

                                    <div user-id="0" location="{{ $user000->location_id }}" group="{{ $user000->group_id }}" date="{{ $arrx[2]."-".$arrx[4]."-".$arrx[3] }}" ref-date="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" class="schedule-item-list ui-droppable OpenCreateModal context-menu-two" >

                                    </div>

                                </div>







                            @endforeach
                    </div>
                @endif
                @foreach ($scheduleUser as $user000)

                    @php

                        if (request()->active == "Customer") {
                            $assignments = DB::table("customer_assignments")->where('user_id', $user000->id)->get();
                            $total_hours0 = DB::table('schedules')->whereBetween('date', $weekRange)->where('customer_id', $user000->id)->sum('total_hours');
                            $total_hourly_amount0 = DB::table('schedules')->whereBetween('date', $weekRange)->where('customer_id', $user000->id)->sum('total_hourly_wags');

                        }else{
                            $total_hours0 = DB::table('schedules')->whereBetween('date', $weekRange)->where('staff_id', $user000->id)->sum('total_hours');
                            $total_hourly_amount0 = DB::table('schedules')->whereBetween('date', $weekRange)->where('staff_id', $user000->id)->sum('total_hourly_wags');
                        }
                     

                    @endphp

                    @include('user.schedule.include.main-row')
                @endforeach

                @if (request()->active == "Customer")
                    <div class="grid-row no-assignment">



                        <div class="cell cell-header d-flex flex-row align-items-center " style="background: #f7f8fa !important;">
                            <div class="mr-3">
                                
                                    {{-- <img data-toggle="tooltip" title="" src="{{ asset('backend/placeholder.jpg') }}" /> --}}

                                {{-- <span class="img-thumbnail rounded-circle"></span> --}}
                                    <i style="width: 40px; height: 40px; margin-right: 10px;" data-feather="plus-circle"></i>
                             
                            </div>
                            <div class="title">
                                Ny vagt
                                {{-- <i data-feather="help-circle"></i> --}}
                            </div>
                        </div>




                        {{-- - [ ] Schedule -> Ny vagt: remove info icon and time/money. add feather icon “plus-circle” same size as user-circle and valign center.' --}}




                            @foreach (daysInWeek($week) as $key => $wk)
                                @php
                                    error_reporting(0);
                                    $arrx = explode("-|-", $wk);

                                    $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];


                                    if (request()->active == "Customer"){
                                        $Openschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'customer_id' => 0])->get();
                                    }else{
                                        $Openschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'staff_id' => 0])->get();
                                    }
                                @endphp


                                <div class="cell cells @if (date('d') === $arrx[3] && date('M') === $arrx[1]) borderRL @endif">
                                    @foreach ($Openschedules as $schedule0)


                                        @php
                                            $scUsr = '';
                                            $staffUser = "";
                                            $user_groups = "";
                                            $staff_text = "";
                                            if (request()->active == "Customer")
                                            {
                                                $scUsr = DB::table('users')->where('id', $schedule0->staff_id)->first();
                                            }else{
                                                $scUsr = DB::table('customers')->where('id', $schedule0->customer_id)->first();
                                            }
                                            if ($schedule0->staff_id != 0)
                                            {
                                                $staffUser = DB::table('users')->where('id', $schedule0->staff_id)->first();

                                                if (strlen($staffUser->group_id) > 1) {
                                                    $arr = explode(",", $staffUser->group_id);
                                                    foreach ($arr as $key => $arrstaffUser) {
                                                        $group = DB::table('user_groups')->where('id', $arrstaffUser)->first();
                                                        $user_groups .= "," . $group->name;
                                                    }
                                                    $user_groups = rtrim($user_groups,', ');
                                                }else{
                                                    if ($staffUser->group_id == null || $staffUser->group_id == "") {
                                                        $user_groups = "Åbne vagter";
                                                    }else{
                                                        $group = DB::table('user_groups')->where('id', $staffUser->group_id)->first();
                                                        $user_groups = $group->name;
                                                    }
                                                }
                                                $staff_text = $staffUser->name . " || " . $user_groups;
                                            } else {
                                                $staff_text = "Åbne vagter";
                                            }

                                        @endphp




                                        <a style="border: 1px solid lightgray !important" ref="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" data-id="{{ $schedule0->id }}" date="{{ $schedule0->date }}" assignment-id="{{ $schedule->customer_assignments }}" staff-id="{{ $schedule0->staff_id }}" staff-text="{{ $staff_text }}" user-id="{{ $user000->id }}" class="@if ($schedule0->visibility == "NotPublished") not-published @else published @endif context-menu-one filtered UpdateScheduleFunction schedule-item schedule-dragable-item shift ui-draggable ui-draggable-handle">
                                            <i class="color-border @if ($schedule0->status == "Pending") bg-warning @elseif ($schedule0->status == "Accepted") bg-success @elseif ($schedule0->status == "Declined") bg-danger @endif"></i>
                                            <div class="heading">
                                                <div class="title" style="font-size: 0.74rem !important;">{{ $schedule0->start_time }} - {{ $schedule0->end_time }}<span class="time-in-org-tz"></span></div>
                                            </div>
                                            <div class="details" style="font-size: 0.74rem !important">
                                                {{ mb_strimwidth($scUsr->name, 0, 14, "...") }}<br>
                                                @if ($schedule0->notes)
                                                    <i class="fa fa-info-circle" style="" data-toggle="tooltip" title="{{ $schedule0->notes }}"></i>
                                                @endif
                                            </div>
                                        </a>



                                    @endforeach

                                    <div user-id="00" location="{{ $user000->location_id }}" group="{{ $user000->group_id }}" date="{{ $arrx[2]."-".$arrx[4]."-".$arrx[3] }}" ref-date="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" class="schedule-item-list ui-droppable OpenCreateModal context-menu-two" >

                                    </div>

                                </div>







                            @endforeach
                    </div>
                @endif

                <div class="modal fade" id="CreateSchedule" data-bs-keyboard="false" data-bs-backdrop="static"  tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <form method="post" action="{{ url('/schedule/store') }}">
                                @csrf

                                <input type="hidden" name="type" @if (request()->active == "Customer") value="Customer" @else value="Staff" @endif>

                                <div class="modal-header bg-light">
                                    <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="calendar"></i> <span id="CreateScheduleHeader">Vagt  </span></h5>
                                    <button data-item="" type="button" class="btn-close CreateClose" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">


                                    <div class="row gx-3 mb-3">


                                        <div class="col-md-8">
                                            <label class="small mb-1">Kunde</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="briefcase"></i></span>
                                                </div>
                                                <select class="form-control w-100 custom-select" name="customer_id" id="customer_id11" required>
                                                    <option selected disabled value="">Vælg...</option>
                                                    @foreach ($AllCustomers as $customer001)
                                                        <option  value="{{ $customer001->id }}">{{ $customer001->name }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <label class="small mb-1">Opgaver</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style="height: 2.88rem !important;"><i class="me-1" data-feather="list"></i></span>
                                                </div>
                                                <select class="form-control w-100 custom-select" name="assignment" id="assignment1"></select>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1">Afdelinger</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="map-pin"></i></span>
                                                </div>
                                                <select class="form-control w-100 custom-select" name="location_ids[]" id="location_ids" multiple>

                                                    @foreach ($locations as $location)
                                                        <option  value="{{ $location->id }}">{{ $location->location }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1">Kompetenceniveau</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="users"></i></span>
                                                </div>
                                                <select class="form-control w-100 custom-select" name="group_ids[]" id="group_ids" multiple>
                                                    @foreach ($groups as $group)
                                                        <option  value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>



                                    </div>


                                     <div class="row gx-3 mb-3">

                                        <div class="col-md-8">
                                            <label class="small mb-1">Personale</label> <span style="font-size: 0.5rem; border-radius: 50%" class="bg-primary p-2 text-white" id="PersonaleLength"></span>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="user"></i></span>
                                                </div>
                                                <select class="form-control w-100 custom-select staff_id" name="staff_id" id="staff_id1" required>
                                                    <option value="0">Åbne vagter</option>
                                                    @foreach ($AllUser as $user91)
                                                        <option  value="{{ $user91->id }}">
                                                            {{ $user91->name }}  ||
                                                             @php
                                                                error_reporting(0);
                                                                $groups_ids = $user91->group_id;
                                                                $arr = explode(",", $groups_ids);
                                                            @endphp
                                                            @foreach ($arr as $key => $gp)
                                                                @php
                                                                    $group1 = DB::table('user_groups')->where('id',$gp)->first();
                                                                @endphp
                                                                {{ $group1->name }}{{$loop->last?'':','}}
                                                            @endforeach

                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                         {{-- <div class="col-md-4">
                                            <label class="small mb-1">Time sats</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="me-1" data-feather="dollar-sign"></i></span>
                                                </div>
                                                <input type="number" name="hourly_wags" id="hourly_wags" required class="form-control input">
                                            </div>
                                        </div> --}}
                                        <input type="hidden" name="hourly_wags" value="1">

                                        <div class="col-md-4">
                                            <label class="small mb-1">Offentligtgjort </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style="height: 2.88rem !important;" id="visibility_icon1"><i class="me-1" data-feather="eye"></i></span>
                                                </div>
                                                <select class="form-control" name="visibility" required>
                                                    <option value="Published">Udgivet</option>
                                                    <option value="NotPublished">Skjult</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-4">
                                            <label class="small mb-1">Dato </label>
                                            <div class="input-group mb-3">
                                                <label for="date1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="me-1" data-feather="calendar"></i></span>
                                                    </div>
                                                </label>
                                                <input type="date" class="form-control input" onfocus="this.showPicker()" name="date" id="date1" required value="">
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <label class="small mb-1">Start tid </label>
                                            <div class="input-group mb-3">
                                                <label for="start_time1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="me-1" data-feather="clock"></i></span>
                                                    </div>
                                                </label>
                                                <input type="time" class="form-control input" onfocus="this.showPicker()" name="start_time" id="start_time1" value="08:00" required>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <label class="small mb-1">Slut tid </label>
                                            <div class="input-group mb-3">
                                                <label for="end_time1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="me-1" data-feather="clock"></i></span>
                                                    </div>
                                                </label>
                                                <input type="time" class="form-control input" onfocus="this.showPicker()" name="end_time" id="end_time1" value="13:30" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="small mb-1">Status </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"  id="status_icon1"  style="height: 2.88rem !important;""><i class="me-1" data-feather="help-circle"></i></span>
                                                </div>
                                                <select class="form-control" name="status" required>
                                                    <option value="Pending">Afventer</option>
                                                    <option value="Accepted">Accepteret</option>
                                                    <option value="Declined">Afvist</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row gx-3 mb-1">
                                        <div class="col-md-8">
                                            <label class="small mb-1">Bemærkning </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style="height: 2.88rem !important;""><i class="me-1" data-feather="file-plus"></i></span>
                                                </div>
                                                <input type="text" class="form-control input" name="note">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small mb-1">Køretøjer</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light" style="height: 2.88rem !important;"><i class="me-1" data-feather="truck"></i></span>
                                                </div>
                                                <select class="form-control w-100 custom-select" name="vehicle_id">
                                                        <option value="">Vælg</option>  
                                                    @foreach ($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>  
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer bg-light" style="margin-bottom: -32px !important">
                                    <button class="btn btn-sm CreateClose" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button>
                                    <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center" type="submit"><i class="me-1" data-feather="save"></i> Opret</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="UpdateSchedule" data-bs-keyboard="false" data-bs-backdrop="static" >
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content update-modal-content">

                            <div class="modal-header bg-light">
                                <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="calendar"></i>
                                    <span id="UpdateScheduleHeader">Opdater vagt</span></h5>
                                <button data-item="" type="button" class="btn-close UpdateClose" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <ul class="nav nav-pills bg-light" id="pills-tab" role="tablist" style="border-bottom: 1px solid #d5dce6;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-detail-tab{{ $schedule->id }}" data-bs-toggle="pill" data-bs-target="#pills-detail{{ $schedule->id }}" type="button" role="tab" aria-controls="pills-detail" aria-selected="true">Detaljer</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-copy-tab{{ $schedule->id }}" data-bs-toggle="pill" data-bs-target="#pills-copy{{ $schedule->id }}" type="button" role="tab" aria-controls="pills-copy" aria-selected="false">Kopier</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-note-tab{{ $schedule->id }}" data-bs-toggle="pill" data-bs-target="#pills-note{{ $schedule->id }}" type="button" role="tab" aria-controls="pills-note" aria-selected="false">Noter</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-applied-tab{{ $schedule->id }}" data-bs-toggle="pill" data-bs-target="#pills-applied{{ $schedule->id }}" type="button" role="tab" aria-controls="pills-applied" aria-selected="false">Vist interesse</button>
                                </li>
                            </ul>
                            <div class="modal-body">



                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-detail{{ $schedule->id }}" role="tabpanel" aria-labelledby="pills-detail-tab{{ $schedule->id }}">
                                        <form class="pt-3" method="post" id="MyUpdateScheduleForm" action="{{ url('/schedule/update/'.$schedule->id) }}">
                                            @csrf

                                            <div class="row gx-3 mb-3">


                                                <div class="col-md-8">
                                                    <label class="small mb-1">Kunder</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style=" height: 2.88rem !important;"><i class="me-1" data-feather="briefcase"></i></span>
                                                        </div>
                                                        <select class="form-control w-100 custom-select" name="customer_id" id="customer_id" required>
                                                            <option selected disabled value="">Vælg...</option>
                                                            @foreach ($AllCustomers as $customer001)
                                                                <option  value="{{ $customer001->id }}">{{ $customer001->name }}</option>
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </div>




                                                <div class="col-md-4">
                                                    <label class="small mb-1">Opgaver</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="list"></i></span>
                                                        </div>
                                                        <select class="form-control w-100 custom-select" name="assignment" id="assignment10"></select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row gx-3 mb-3">

                                                <div class="col-md-6">
                                                    <label class="small mb-1">Afdelinger</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="map-pin"></i></span>
                                                        </div>
                                                        <select class="form-control w-100 custom-select" name="location_ids[]" id="location_ids0" multiple>

                                                            @foreach ($locations as $location)
                                                                <option  value="{{ $location->id }}">{{ $location->location }}</option>
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <label class="small mb-1">Kompetenceniveau</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style=" height: 2.88rem !important;""><i class="me-1" data-feather="users"></i></span>
                                                        </div>
                                                        <select class="form-control w-100 custom-select" name="group_ids[]" id="group_ids0" multiple>
                                                            @foreach ($groups as $group)
                                                                <option  value="{{ $group->id }}">{{ $group->name }}</option>
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </div>



                                                {{-- <div class="col-md-4">
                                                    <label class="small mb-1">Time sats</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="me-1" data-feather="dollar-sign"></i></span>
                                                        </div>
                                                        <input type="number" name="hourly_wags" id="hourly_wags" required class="form-control input" value="{{ $schedule->hourly_wags }}">
                                                    </div>
                                                </div> --}}
                                                <input type="hidden" name="hourly_wags" value="1">



                                            </div>


                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-8">
                                                    <label class="small mb-1">Personale</label> <span style="font-size: 0.5rem; border-radius: 50%" class="bg-primary p-2 text-white" id="PersonaleLength1"></span>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style=" height: 2.88rem !important;"><i class="me-1" data-feather="user"></i></span>
                                                        </div>
                                                        <select class="form-control w-100 custom-select staff_id" name="staff_id" id="staff_id" required>
                                                            @foreach ($AllUser as $user91)
                                                                <option  value="{{ $user91->id }}">{{ $user91->name }}</option>
                                                            @endforeach
                                                        </select>
                                                            <span id="close_staff" class="input-group-text bg-light" style="cursor: pointer; margin-left: 2px; border-radius: 4px !important; height: 2.88rem !important;"><i class="me-1" data-feather="x"></i></span>


                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <label class="small mb-1">Offentligtgjort</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style=" height: 2.88rem !important;" id="visibility_icon"><i class="me-1" data-feather="eye"></i></span>
                                                        </div>
                                                        <select class="form-control" name="visibility" id="visibility" required>
                                                            <option value="Published">Udgivet</option>
                                                            <option value="NotPublished">Skjult</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-4">
                                                    <label class="small mb-1">Dato </label>
                                                    <div class="input-group mb-3">
                                                        <label for="date001">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light"><i class="me-1" data-feather="calendar"></i></span>
                                                            </div>
                                                        </label>
                                                        <input type="date" class="form-control input" name="date" onfocus="this.showPicker()" id="date001" required value="{{ $schedule->date }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">Start tid </label>


                                                    <div class="input-group mb-3">
                                                        <label for="start_time">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light"><i class="me-1" data-feather="clock"></i></span>
                                                            </div>
                                                        </label>
                                                        <input type="time" class="form-control input" name="start_time" onfocus="this.showPicker()" id="start_time" value="{{ $schedule->start_time }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">Slut tid</label>
                                                    <div class="input-group mb-3">
                                                        <label for="end_time">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light"><i class="me-1" data-feather="clock"></i></span>
                                                            </div>
                                                        </label>
                                                        <input type="time" class="form-control input" name="end_time" onfocus="this.showPicker()" id="end_time" value="{{ $schedule->end_time }}" required>
                                                    </div>


                                                </div>

                                                <div class="col-md-4">
                                                    <label class="small mb-1">Status </label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"  id="status_icon"  style=" height: 2.88rem !important;""><i class="me-1" data-feather="help-circle"></i></span>
                                                        </div>
                                                        <select class="form-control" name="status" id="status" required>
                                                            <option value="Pending">Afventer</option>
                                                            <option value="Accepted">Accepteret</option>
                                                            <option value="Declined">Afvist</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row gx-3 mb-1">

                                                <div class="col-md-8">
                                                    <label class="small mb-1">Bemærkning </label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style="height: 2.88rem !important;""><i class="me-1" data-feather="file-plus"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control input" id="note01" name="note">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="small mb-1">Køretøjer</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light" style="height: 2.88rem !important;"><i class="me-1" data-feather="truck"></i></span>
                                                        </div>
                                                        <select class="form-control w-100 custom-select" name="vehicle_id" id="vehicle_id">
                                                                <option value="">Vælg</option>  
                                                            @foreach ($vehicles as $vehicle)
                                                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>  
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bg-light" style="padding: 18px !important; margin: 12px -16px -32px -16px !important; border-radius: 0 0px 10px 10px;">
                                                <a id="DeleteSchedule" href="{{ url('/schedule/delete/'.$schedule->id) }}" onclick="return confirm('Er du sikker på at du vil slette denne vagt ?')" class="btn btn-danger btn-sm" >Slet</a>
                                                <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center" type="submit"><i class="me-1" data-feather="edit"></i> Opdater</button>
                                            </div>


                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-copy{{ $schedule->id }}" role="tabpanel" aria-labelledby="pills-copy-tab{{ $schedule->id }}">
                                        <form class="pt-3" method="post" id="MyCopyScheduleForm" action="{{ url('/schedule/copy/'.$schedule->id) }}">
                                            @csrf

                                            <input type="hidden" name="type" value="{{ request()->active }}">
                                            <table class="table  table-hover">
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="CheckAllDays" value="Yes" type="checkbox">
                                                            <label class="form-check-label mt-1" for="CheckAllDays">Day</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="ToggleVisibility" value="Yes" type="checkbox">
                                                            <label class="form-check-label mt-1" for="ToggleVisibility">Visibility</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" id="SameStaff" value="Yes" type="checkbox">
                                                            <label class="form-check-label mt-1" for="SameStaff">Same Staff ?</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <label class="form-check-label mt-1" for="SameStaff">Number Of Copies</label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                @foreach (daysInWeek($week) as $key =>  $value)
                                                    @php
                                                        error_reporting(0);
                                                        $arrxday = explode("-|-", $value);
                                                    @endphp
                                                    <tr>
                                                        <td style="vertical-align: middle !important">
                                                            <div class="form-check form-switch pt-2">
                                                                <input class="form-check-input DayCheckBox" id="{{ $arrxday[5] }}" value="{{ $arrxday[2]."-".$arrxday[4]."-".$arrxday[3] }}" data-row="date-{{ $arrxday[3] }}" type="checkbox" name="scheduleCopy[]">
                                                                <label class="form-check-label" style="margin-top: 3px !important" for="{{ $arrxday[5] }}">{{ $arrxday[5] }} ({{ $arrxday[3]."-".$arrxday[4]."-".$arrxday[2] }})</label>
                                                            </div>
                                                        </td>
                                                        {{-- <td style="vertical-align: middle !important">
                                                            <input type="number" name="copies[]" class="form-control" style="padding: 0.5rem 1rem !important;">
                                                        </td> --}}
                                                        <td style="vertical-align: middle !important">
                                                            <select class="form-control ToggleVisibilityValue" name="visibility[]" data-row="date-{{ $arrxday[3] }}" style="padding: 0.61rem 1rem !important;">
                                                                <option value="Published">Udgivet</option>
                                                                <option value="NotPublished">Skjult</option>
                                                            </select>
                                                        </td>
                                                        <td style="vertical-align: middle !important">
                                                            <div class="form-check form-switch pt-2">
                                                                <input class="form-check-input SameStaffBox" id="CurrentStaff{{ $arrxday[2] }}" value="Yes" data-row="date-{{ $arrxday[3] }}" type="checkbox" name="staff[]">

                                                            </div>
                                                        </td>
                                                        <td style="vertical-align: middle !important">
                                                            <select class="form-control CopyValue" name="numberOfCopies[]" data-row="date-{{ $arrxday[3] }}" style="padding: 0.61rem 1rem !important;">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>





                                            <div class="bg-light" style="padding: 18px !important; margin: 12px -16px 0px -16px !important; bottom: 0px !important; position: absolute !important; width: 100% !important; border-radius: 0 0px 10px 10px;">
                                                <a  id="DeleteSchedule" href="{{ url('/schedule/delete/'.$schedule->id) }}" onclick="return confirm('Er du sikker på at du vil slette denne vagt ?')" class="btn btn-danger btn-sm">Slet</a>
                                                <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center" type="submit"><i class="me-1" data-feather="copy"></i> Kopier</button>
                                            </div>


                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-note{{ $schedule->id }}" role="tabpanel" aria-labelledby="pills-note-tab{{ $schedule->id }}">
                                        <div class="CreateNoteContainer">
                                            <form method="post" id="MyNoteScheduleForm">

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-10">
                                                        <label class="small mb-1">Titel</label>
                                                        <input type="text" name="title" id="title" class="form-control" required>
                                                        <input type="hidden" name="schedule_id000" id="schedule_id000">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="small mb-1">Show In PWA </label>
                                                        <div class="form-check form-switch pt-2">
                                                            <input class="form-check-input" id="visibility000" value="Yes" type="checkbox" name="visibility">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Beskrivelse</label>
                                                        <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                                                    </div>
                                                </div>


                                                <a href="javascript::" class="btn btn-secondary btn-sm CreateNoteClose" >Annuller</a>
                                                <button class="btn btn-primary btn-sm float-end d-flex align-items-center justify-content-center" type="submit"><i class="me-1" data-feather="save"></i> Opret</button>


                                            </form>
                                            <br clear="all">
                                        </div>
                                        <div class="container">
                                            <a href="javascript::" class="font-weight-bolder CreateNoteBtn" style="float: right !important;">Opret Note</a>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Note</th>
                                                        <th>Show in PWA</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="notes_list">
                                                    @php
                                                        $notes = DB::table('schedule_notes')->where('schedule_id', $schedule->id)->get();
                                                    @endphp

                                                    @foreach ($notes as $note)
                                                        <tr>
                                                            <td class="w-50 text-center">
                                                                <b>{{ $note->title }}</b> <br>
                                                                {{ $note->description }}
                                                            </td>
                                                            <td class="w-25 text-center" >{{ $note->visibility }}</td>
                                                            <td class="w-25 text-center" style="vertical-align: middle !important;">
                                                                <a onclick="return confirm('Er du sikker på at du vil slette denne note ?')" class="btn-datatable btn-icon btn-transparent-dark" href="{{ url('/schedule/note/delete/'.$note->id) }}"><i data-feather="trash-2"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-applied{{ $schedule->id }}" role="tabpanel" aria-labelledby="pills-applied-tab{{ $schedule->id }}">
                                        
                                        <div class="container">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Personale</th>
                                                        <th>Ansøgt dato</th>
                                                        <th>Funktion</th>

                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="applied_list"></tbody>
                                            </table>                                        
                                        </div>
                                    </div>
                                </div>



                                <div id="UpdateScheduleLoading" style="padding: 100px">
                                    <center>
                                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                                    </center>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>






            </div>
        </div>
    </div>
</div>



@endsection
@endsection
@include('user.schedule.include.js')
