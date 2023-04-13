@if (request()->active == "Customer")
    @php
        $thisUserSchdule = DB::table('schedules')->whereBetween('date', $weekRange)->where('customer_id', $user000->id)->count();
    @endphp
    @if (in_array("CustomerWithSchedule", $schedulePermission))
        
        @if ($thisUserSchdule > 0)
            <div class="grid-row assignment-row">
                <div class="cell cell-header d-flex flex-row align-items-center " style="background: #f7f8fa !important;">
                    <div class="mr-3">
                        @if (!empty($user000->image))
                            <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/profile/'.$user000->image) }}" />
                        @else
                            <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/placeholder.jpg') }}" />
                        @endif
                    </div>
                    <div class="totals" style="margin-top: 2px !important">
                        <a class="title" style="word-wrap: break-word;" href="javascript::">{{ mb_strimwidth($user000->name, 0, 16, "...") }}</a>
                        @if (in_array("ShowMoney", $schedulePermission) && in_array("ShowTime", $schedulePermission))
                            <div class=""><small>{{ $total_hours0 }} timer / kr. {{ $total_hourly_amount0 }}</small></div>
                        @elseif(in_array("ShowMoney", $schedulePermission))
                            <div class=""><small>kr. {{ $total_hourly_amount0 }}</small></div>
                        @elseif(in_array("ShowTime", $schedulePermission))
                            <div class=""><small>{{ $total_hours0 }} timer </small></div>
                        @endif
                    </div>
                </div>


                @foreach (daysInWeek($week) as $key => $wk)
                    @php
                        error_reporting(0);
                        $arrx = explode("-|-", $wk);

                        $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];



                        if (request()->active == "Customer"){
                            $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                            $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                        }else{
                            $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                            $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                        }
                    @endphp


                    <div class="cell cells @if (date('d') === $arrx[3]) borderRL @endif">


                        {{-- Not Working Schedule For Staff --}}

                        @foreach ($MyNotschedules as $schedule0)

                            @php
                                $notScUsr = '';
                                if (request()->active == "Customer")
                                {
                                    $notScUsr = DB::table('customers')->where('id', $schedule0->customer_id)->first();
                                }else{
                                    $notScUsr = DB::table('users')->where('id', $schedule0->staff_id)->first();
                                }
                            @endphp


                            <a class="filtered  updateNotWork schedule-item @if ($schedule0->status == "NotWork") time-off @else time-on @endif" data-id={{ $schedule0->id }} >
                                <div class="heading">
                                    @if ($schedule0->status == "NotWork")
                                        <i data-feather="thumbs-down" style="margin-top: -3px !important"></i>&nbsp;
                                    @else
                                        <i data-feather="thumbs-up" style="margin-top: -3px !important"></i>&nbsp;
                                    @endif
                                    <div class="title" style="font-size: 0.74rem !important">
                                        @if ($schedule0->allDay == "Null")
                                            {{ $schedule0->start_time }} - {{ $schedule0->end_time }}
                                        @else
                                            All Day
                                        @endif
                                    <span class="time-in-org-tz"></span></div>
                                    @if ($schedule0->note)
                                        <div class="indicators">
                                            <i class="fa fa-info-circle" style="margin-top: -3px !important" data-toggle="tooltip" title="{{ $schedule0->note }}"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach



                        {{-- Working Schedule --}}

                        @foreach ($Myschedules as $schedule)



                            @php
                                $scUsr = '';
                                $staffUser = "";
                                $user_groups = "";
                                $staff_text = "";
                                if (request()->active == "Customer")
                                {
                                    $scUsr = DB::table('users')->where('id', $schedule->staff_id)->first();
                                }else{
                                    $scUsr = DB::table('customers')->where('id', $schedule->customer_id)->first();
                                };

                                if ($schedule->staff_id != 0)
                                {
                                    $staffUser = DB::table('users')->where('id', $schedule->staff_id)->first();

                                    if (strlen($staffUser->group_id) > 1) {
                                        $arr = explode(",", $staffUser->group_id);
                                        foreach ($arr as $key => $arrstaffUser) {
                                            $group = DB::table('user_groups')->where('id', $arrstaffUser)->first();
                                            $user_groups .= $group->name . ", ";
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



                            <a style="border: 1px solid lightgray !important" id="schedule{{ $schedule->id }}" ref="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" data-id="{{ $schedule->id }}" date="{{ $schedule->date }}" assignment-id="{{ $schedule->customer_assignments }}" vehicle_id={{ $schedule->vehicle_id }} staff-id="{{ $schedule->staff_id }}" staff-text="{{ $staff_text }}" user-id="{{ $user000->id }}" class="@if ($schedule->visibility == "NotPublished") not-published @else published @endif context-menu-one filtered UpdateScheduleFunction schedule-item schedule-dragable-item shift ui-draggable ui-draggable-handle">
                                <i class="color-border @if ($schedule->status == "Pending") bg-warning @elseif ($schedule->status == "Accepted") bg-success @elseif ($schedule->status == "Declined") bg-danger @endif"></i>
                                <div class="heading">
                                    <div class="title" style="font-size: 0.74rem !important;  overflow: initial !important;"><i style="margin-left: -2px !important; z-index: 1080 !important" data-feather="clock"></i> {{ $schedule->start_time }} - {{ $schedule->end_time }}<span class="time-in-org-tz"></span></div>
                                </div>
                                <div class="details" style="font-size: 0.74rem !important">
                                    @if ($scUsr->name)
                                        @if (request()->active == "Staff")<i data-feather="briefcase"></i>@else<i sty data-feather="user"></i>@endif {{ mb_strimwidth($scUsr->name, 0, 14, "...") }}<br>
                                    @endif
                                </div>
                                <div style="border-top: 1px solid lightgray"></div>
                                <div class="details py-1 d-flex flex-row" style="font-size: 0.74rem !important">
                                    @if ($schedule->notes != null)
                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $schedule->notes }}">
                                            <i data-feather="info"></i>
                                        </span>
                                    @endif
                                    &nbsp;
                                    @if ($schedule->customer_assignments)
                                        @php
                                            $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
                                        @endphp
                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $assignment->name }}">
                                            <i data-feather="list"></i>
                                        </span>
                                    @endif
                                    &nbsp;
                                    @if ($schedule->customer_loactions)
                                        @php
                                            $locationsArray = explode(",", $schedule->customer_loactions);
                                            $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();
                                        @endphp
                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($locations00 as $location) {{ $location->location }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                    @endif
                                    &nbsp;
                                    @if ($schedule->staff_groups)
                                        @php
                                            $groupsArray = explode(",", $schedule->staff_groups);
                                            $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                                        @endphp

                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($groups000 as $group) {{ $group->name }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                            <i data-feather="users"></i>
                                        </span>

                                    @endif

                                    &nbsp;
                                    @if ($schedule->vehicle_id)
                                        @php
                                            $vehicle = DB::table('vehicles')->where('id', $schedule->vehicle_id)->first();
                                        @endphp

                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $vehicle->name }}">
                                            <i data-feather="truck"></i>
                                        </span>

                                    @endif
                                </div>
                            </a>




                        @endforeach
                        <div user-id="{{ $user000->id }}" location="{{ $user000->location_id }}" group="{{ $user000->group_id }}" date="{{ $arrx[2]."-".$arrx[4]."-".$arrx[3] }}" ref-date="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" class="schedule-item-list ui-droppable OpenCreateModal context-menu-two" >

                        </div>

                    </div>







                @endforeach




            </div>
        @endif
        
    @else
        <div class="grid-row assignment-row">
            <div class="cell cell-header d-flex flex-row align-items-center " style="background: #f7f8fa !important;">
                <div class="mr-3">
                    @if (!empty($user000->image))
                        <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/profile/'.$user000->image) }}" />
                    @else
                        <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/placeholder.jpg') }}" />
                    @endif
                </div>
                <div class="totals" style="margin-top: 2px !important">
                    <a class="title" style="word-wrap: break-word;" href="javascript::">{{ mb_strimwidth($user000->name, 0, 16, "...") }}</a>
                    @if (in_array("ShowMoney", $schedulePermission) && in_array("ShowTime", $schedulePermission))
                        <div class=""><small>{{ $total_hours0 }} timer / kr. {{ $total_hourly_amount0 }}</small></div>
                    @elseif(in_array("ShowMoney", $schedulePermission))
                        <div class=""><small>kr. {{ $total_hourly_amount0 }}</small></div>
                    @elseif(in_array("ShowTime", $schedulePermission))
                        <div class=""><small>{{ $total_hours0 }} timer </small></div>
                    @endif
                </div>
            </div>


            @foreach (daysInWeek($week) as $key => $wk)
                @php
                    error_reporting(0);
                    $arrx = explode("-|-", $wk);

                    $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];



                    if (request()->active == "Customer"){
                        $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                        $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                    }else{
                        $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                        $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                    }
                @endphp


                <div class="cell cells @if (date('d') === $arrx[3]) borderRL @endif">


                    {{-- Not Working Schedule For Staff --}}

                    @foreach ($MyNotschedules as $schedule0)

                        @php
                            $notScUsr = '';
                            if (request()->active == "Customer")
                            {
                                $notScUsr = DB::table('customers')->where('id', $schedule0->customer_id)->first();
                            }else{
                                $notScUsr = DB::table('users')->where('id', $schedule0->staff_id)->first();
                            }
                        @endphp


                        <a class="filtered  updateNotWork schedule-item @if ($schedule0->status == "NotWork") time-off @else time-on @endif" data-id={{ $schedule0->id }} >
                            <div class="heading">
                                @if ($schedule0->status == "NotWork")
                                    <i data-feather="thumbs-down" style="margin-top: -3px !important"></i>&nbsp;
                                @else
                                    <i data-feather="thumbs-up" style="margin-top: -3px !important"></i>&nbsp;
                                @endif
                                <div class="title" style="font-size: 0.74rem !important">
                                    @if ($schedule0->allDay == "Null")
                                        {{ $schedule0->start_time }} - {{ $schedule0->end_time }}
                                    @else
                                        All Day
                                    @endif
                                <span class="time-in-org-tz"></span></div>
                                @if ($schedule0->note)
                                    <div class="indicators">
                                        <i class="fa fa-info-circle" style="margin-top: -3px !important" data-toggle="tooltip" title="{{ $schedule0->note }}"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach



                    {{-- Working Schedule --}}

                    @foreach ($Myschedules as $schedule)



                        @php
                            $scUsr = '';
                            $staffUser = "";
                            $user_groups = "";
                            $staff_text = "";
                            if (request()->active == "Customer")
                            {
                                $scUsr = DB::table('users')->where('id', $schedule->staff_id)->first();
                            }else{
                                $scUsr = DB::table('customers')->where('id', $schedule->customer_id)->first();
                            };

                            if ($schedule->staff_id != 0)
                            {
                                $staffUser = DB::table('users')->where('id', $schedule->staff_id)->first();

                                if (strlen($staffUser->group_id) > 1) {
                                    $arr = explode(",", $staffUser->group_id);
                                    foreach ($arr as $key => $arrstaffUser) {
                                        $group = DB::table('user_groups')->where('id', $arrstaffUser)->first();
                                        $user_groups .= $group->name . ", ";
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



                        <a style="border: 1px solid lightgray !important" id="schedule{{ $schedule->id }}" ref="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" data-id="{{ $schedule->id }}" date="{{ $schedule->date }}" assignment-id="{{ $schedule->customer_assignments }}" vehicle_id={{ $schedule->vehicle_id }} staff-id="{{ $schedule->staff_id }}" staff-text="{{ $staff_text }}" user-id="{{ $user000->id }}" class="@if ($schedule->visibility == "NotPublished") not-published @else published @endif context-menu-one filtered UpdateScheduleFunction schedule-item schedule-dragable-item shift ui-draggable ui-draggable-handle">
                            <i class="color-border @if ($schedule->status == "Pending") bg-warning @elseif ($schedule->status == "Accepted") bg-success @elseif ($schedule->status == "Declined") bg-danger @endif"></i>
                            <div class="heading">
                                <div class="title" style="font-size: 0.74rem !important;  overflow: initial !important;"><i style="margin-left: -2px !important; z-index: 1080 !important" data-feather="clock"></i> {{ $schedule->start_time }} - {{ $schedule->end_time }}<span class="time-in-org-tz"></span></div>
                            </div>
                            <div class="details" style="font-size: 0.74rem !important">
                                @if ($scUsr->name)
                                    @if (request()->active == "Staff")<i data-feather="briefcase"></i>@else<i sty data-feather="user"></i>@endif {{ mb_strimwidth($scUsr->name, 0, 14, "...") }}<br>
                                @endif
                            </div>
                            <div style="border-top: 1px solid lightgray"></div>
                            <div class="details py-1 d-flex flex-row" style="font-size: 0.74rem !important">
                                @if ($schedule->notes != null)
                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $schedule->notes }}">
                                        <i data-feather="info"></i>
                                    </span>
                                @endif
                                &nbsp;
                                @if ($schedule->customer_assignments)
                                    @php
                                        $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
                                    @endphp
                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $assignment->name }}">
                                        <i data-feather="list"></i>
                                    </span>
                                @endif
                                &nbsp;
                                @if ($schedule->customer_loactions)
                                    @php
                                        $locationsArray = explode(",", $schedule->customer_loactions);
                                        $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();
                                    @endphp
                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($locations00 as $location) {{ $location->location }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                        <i data-feather="map-pin"></i>
                                    </span>
                                @endif
                                &nbsp;
                                @if ($schedule->staff_groups)
                                    @php
                                        $groupsArray = explode(",", $schedule->staff_groups);
                                        $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                                    @endphp

                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($groups000 as $group) {{ $group->name }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                        <i data-feather="users"></i>
                                    </span>

                                @endif

                                &nbsp;
                                @if ($schedule->vehicle_id)
                                    @php
                                        $vehicle = DB::table('vehicles')->where('id', $schedule->vehicle_id)->first();
                                    @endphp

                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $vehicle->name }}">
                                        <i data-feather="truck"></i>
                                    </span>

                                @endif
                            </div>
                        </a>




                    @endforeach
                    <div user-id="{{ $user000->id }}" location="{{ $user000->location_id }}" group="{{ $user000->group_id }}" date="{{ $arrx[2]."-".$arrx[4]."-".$arrx[3] }}" ref-date="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" class="schedule-item-list ui-droppable OpenCreateModal context-menu-two" >

                    </div>

                </div>







            @endforeach




        </div>
    @endif

@else
    @php
        $thisUserSchdule = DB::table('schedules')->whereBetween('date', $weekRange)->where('staff_id', $user000->id)->count();
    @endphp
    @if (in_array("StaffWithSchedule", $schedulePermission))
        
        @if ($thisUserSchdule > 0)
            <div class="grid-row assignment-row">
                <div class="cell cell-header d-flex flex-row align-items-center " style="background: #f7f8fa !important;">
                    <div class="mr-3">
                        @if (!empty($user000->image))
                            <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/profile/'.$user000->image) }}" />
                        @else
                            <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/placeholder.jpg') }}" />
                        @endif
                    </div>
                    <div class="totals" style="margin-top: 2px !important">
                        <a class="title" style="word-wrap: break-word;" href="javascript::">{{ mb_strimwidth($user000->name, 0, 16, "...") }}</a>
                        @if (in_array("ShowMoney", $schedulePermission) && in_array("ShowTime", $schedulePermission))
                            <div class=""><small>{{ $total_hours0 }} timer / kr. {{ $total_hourly_amount0 }}</small></div>
                        @elseif(in_array("ShowMoney", $schedulePermission))
                            <div class=""><small>kr. {{ $total_hourly_amount0 }}</small></div>
                        @elseif(in_array("ShowTime", $schedulePermission))
                            <div class=""><small>{{ $total_hours0 }} timer </small></div>
                        @endif
                    </div>
                </div>


                @foreach (daysInWeek($week) as $key => $wk)
                    @php
                        error_reporting(0);
                        $arrx = explode("-|-", $wk);

                        $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];



                        if (request()->active == "Customer"){
                            $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                            $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                        }else{
                            $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                            $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                        }
                    @endphp


                    <div class="cell cells @if (date('d') === $arrx[3]) borderRL @endif">


                        {{-- Not Working Schedule For Staff --}}

                        @foreach ($MyNotschedules as $schedule0)

                            @php
                                $notScUsr = '';
                                if (request()->active == "Customer")
                                {
                                    $notScUsr = DB::table('customers')->where('id', $schedule0->customer_id)->first();
                                }else{
                                    $notScUsr = DB::table('users')->where('id', $schedule0->staff_id)->first();
                                }
                            @endphp


                            <a class="filtered  updateNotWork schedule-item @if ($schedule0->status == "NotWork") time-off @else time-on @endif" data-id={{ $schedule0->id }} >
                                <div class="heading">
                                    @if ($schedule0->status == "NotWork")
                                        <i data-feather="thumbs-down" style="margin-top: -3px !important"></i>&nbsp;
                                    @else
                                        <i data-feather="thumbs-up" style="margin-top: -3px !important"></i>&nbsp;
                                    @endif
                                    <div class="title" style="font-size: 0.74rem !important">
                                        @if ($schedule0->allDay == "Null")
                                            {{ $schedule0->start_time }} - {{ $schedule0->end_time }}
                                        @else
                                            All Day
                                        @endif
                                    <span class="time-in-org-tz"></span></div>
                                    @if ($schedule0->note)
                                        <div class="indicators">
                                            <i class="fa fa-info-circle" style="margin-top: -3px !important" data-toggle="tooltip" title="{{ $schedule0->note }}"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach



                        {{-- Working Schedule --}}

                        @foreach ($Myschedules as $schedule)



                            @php
                                $scUsr = '';
                                $staffUser = "";
                                $user_groups = "";
                                $staff_text = "";
                                if (request()->active == "Customer")
                                {
                                    $scUsr = DB::table('users')->where('id', $schedule->staff_id)->first();
                                }else{
                                    $scUsr = DB::table('customers')->where('id', $schedule->customer_id)->first();
                                };

                                if ($schedule->staff_id != 0)
                                {
                                    $staffUser = DB::table('users')->where('id', $schedule->staff_id)->first();

                                    if (strlen($staffUser->group_id) > 1) {
                                        $arr = explode(",", $staffUser->group_id);
                                        foreach ($arr as $key => $arrstaffUser) {
                                            $group = DB::table('user_groups')->where('id', $arrstaffUser)->first();
                                            $user_groups .= $group->name . ", ";
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



                            <a style="border: 1px solid lightgray !important" id="schedule{{ $schedule->id }}" ref="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" data-id="{{ $schedule->id }}" date="{{ $schedule->date }}" assignment-id="{{ $schedule->customer_assignments }}" vehicle_id={{ $schedule->vehicle_id }} staff-id="{{ $schedule->staff_id }}" staff-text="{{ $staff_text }}" user-id="{{ $user000->id }}" class="@if ($schedule->visibility == "NotPublished") not-published @else published @endif context-menu-one filtered UpdateScheduleFunction schedule-item schedule-dragable-item shift ui-draggable ui-draggable-handle">
                                <i class="color-border @if ($schedule->status == "Pending") bg-warning @elseif ($schedule->status == "Accepted") bg-success @elseif ($schedule->status == "Declined") bg-danger @endif"></i>
                                <div class="heading">
                                    <div class="title" style="font-size: 0.74rem !important;  overflow: initial !important;"><i style="margin-left: -2px !important; z-index: 1080 !important" data-feather="clock"></i> {{ $schedule->start_time }} - {{ $schedule->end_time }}<span class="time-in-org-tz"></span></div>
                                </div>
                                <div class="details" style="font-size: 0.74rem !important">
                                    @if ($scUsr->name)
                                        @if (request()->active == "Staff")<i data-feather="briefcase"></i>@else<i sty data-feather="user"></i>@endif {{ mb_strimwidth($scUsr->name, 0, 14, "...") }}<br>
                                    @endif
                                </div>
                                <div style="border-top: 1px solid lightgray"></div>
                                <div class="details py-1 d-flex flex-row" style="font-size: 0.74rem !important">
                                    @if ($schedule->notes != null)
                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $schedule->notes }}">
                                            <i data-feather="info"></i>
                                        </span>
                                    @endif
                                    &nbsp;
                                    @if ($schedule->customer_assignments)
                                        @php
                                            $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
                                        @endphp
                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $assignment->name }}">
                                            <i data-feather="list"></i>
                                        </span>
                                    @endif
                                    &nbsp;
                                    @if ($schedule->customer_loactions)
                                        @php
                                            $locationsArray = explode(",", $schedule->customer_loactions);
                                            $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();
                                        @endphp
                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($locations00 as $location) {{ $location->location }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                    @endif
                                    &nbsp;
                                    @if ($schedule->staff_groups)
                                        @php
                                            $groupsArray = explode(",", $schedule->staff_groups);
                                            $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                                        @endphp

                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($groups000 as $group) {{ $group->name }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                            <i data-feather="users"></i>
                                        </span>

                                    @endif

                                    &nbsp;
                                    @if ($schedule->vehicle_id)
                                        @php
                                            $vehicle = DB::table('vehicles')->where('id', $schedule->vehicle_id)->first();
                                        @endphp

                                        <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $vehicle->name }}">
                                            <i data-feather="truck"></i>
                                        </span>

                                    @endif
                                </div>
                            </a>




                        @endforeach
                        <div user-id="{{ $user000->id }}" location="{{ $user000->location_id }}" group="{{ $user000->group_id }}" date="{{ $arrx[2]."-".$arrx[4]."-".$arrx[3] }}" ref-date="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" class="schedule-item-list ui-droppable OpenCreateModal context-menu-two" >

                        </div>

                    </div>







                @endforeach




            </div>
        @endif
        
    @else
        <div class="grid-row assignment-row">
            <div class="cell cell-header d-flex flex-row align-items-center " style="background: #f7f8fa !important;">
                <div class="mr-3">
                    @if (!empty($user000->image))
                        <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/profile/'.$user000->image) }}" />
                    @else
                        <img style="width: 40px !important; margin-right: 8px !important" class="img-thumbnail rounded-circle" data-toggle="tooltip" title="{{ $user000->note }}" src="{{ asset('backend/placeholder.jpg') }}" />
                    @endif
                </div>
                <div class="totals" style="margin-top: 2px !important">
                    <a class="title" style="word-wrap: break-word;" href="javascript::">{{ mb_strimwidth($user000->name, 0, 16, "...") }}</a>
                    @if (in_array("ShowMoney", $schedulePermission) && in_array("ShowTime", $schedulePermission))
                        <div class=""><small>{{ $total_hours0 }} timer / kr. {{ $total_hourly_amount0 }}</small></div>
                    @elseif(in_array("ShowMoney", $schedulePermission))
                        <div class=""><small>kr. {{ $total_hourly_amount0 }}</small></div>
                    @elseif(in_array("ShowTime", $schedulePermission))
                        <div class=""><small>{{ $total_hours0 }} timer </small></div>
                    @endif
                </div>
            </div>


            @foreach (daysInWeek($week) as $key => $wk)
                @php
                    error_reporting(0);
                    $arrx = explode("-|-", $wk);

                    $queryDate = $arrx[2]."-".$arrx[4]."-".$arrx[3];



                    if (request()->active == "Customer"){
                        $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                        $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'customer_id' => $user000->id])->get();
                    }else{
                        $Myschedules = DB::table('schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                        $MyNotschedules = DB::table('not_working_schedules')->where(['date' => $queryDate])->where([ 'staff_id' => $user000->id])->get();
                    }
                @endphp


                <div class="cell cells @if (date('d') === $arrx[3]) borderRL @endif">


                    {{-- Not Working Schedule For Staff --}}

                    @foreach ($MyNotschedules as $schedule0)

                        @php
                            $notScUsr = '';
                            if (request()->active == "Customer")
                            {
                                $notScUsr = DB::table('customers')->where('id', $schedule0->customer_id)->first();
                            }else{
                                $notScUsr = DB::table('users')->where('id', $schedule0->staff_id)->first();
                            }
                        @endphp


                        <a class="filtered  updateNotWork schedule-item @if ($schedule0->status == "NotWork") time-off @else time-on @endif" data-id={{ $schedule0->id }} >
                            <div class="heading">
                                @if ($schedule0->status == "NotWork")
                                    <i data-feather="thumbs-down" style="margin-top: -3px !important"></i>&nbsp;
                                @else
                                    <i data-feather="thumbs-up" style="margin-top: -3px !important"></i>&nbsp;
                                @endif
                                <div class="title" style="font-size: 0.74rem !important">
                                    @if ($schedule0->allDay == "Null")
                                        {{ $schedule0->start_time }} - {{ $schedule0->end_time }}
                                    @else
                                        All Day
                                    @endif
                                <span class="time-in-org-tz"></span></div>
                                @if ($schedule0->note)
                                    <div class="indicators">
                                        <i class="fa fa-info-circle" style="margin-top: -3px !important" data-toggle="tooltip" title="{{ $schedule0->note }}"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach



                    {{-- Working Schedule --}}

                    @foreach ($Myschedules as $schedule)



                        @php
                            $scUsr = '';
                            $staffUser = "";
                            $user_groups = "";
                            $staff_text = "";
                            if (request()->active == "Customer")
                            {
                                $scUsr = DB::table('users')->where('id', $schedule->staff_id)->first();
                            }else{
                                $scUsr = DB::table('customers')->where('id', $schedule->customer_id)->first();
                            };

                            if ($schedule->staff_id != 0)
                            {
                                $staffUser = DB::table('users')->where('id', $schedule->staff_id)->first();

                                if (strlen($staffUser->group_id) > 1) {
                                    $arr = explode(",", $staffUser->group_id);
                                    foreach ($arr as $key => $arrstaffUser) {
                                        $group = DB::table('user_groups')->where('id', $arrstaffUser)->first();
                                        $user_groups .= $group->name . ", ";
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



                        <a style="border: 1px solid lightgray !important" id="schedule{{ $schedule->id }}" ref="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" data-id="{{ $schedule->id }}" date="{{ $schedule->date }}" assignment-id="{{ $schedule->customer_assignments }}" vehicle_id={{ $schedule->vehicle_id }} staff-id="{{ $schedule->staff_id }}" staff-text="{{ $staff_text }}" user-id="{{ $user000->id }}" class="@if ($schedule->visibility == "NotPublished") not-published @else published @endif context-menu-one filtered UpdateScheduleFunction schedule-item schedule-dragable-item shift ui-draggable ui-draggable-handle">
                            <i class="color-border @if ($schedule->status == "Pending") bg-warning @elseif ($schedule->status == "Accepted") bg-success @elseif ($schedule->status == "Declined") bg-danger @endif"></i>
                            <div class="heading">
                                <div class="title" style="font-size: 0.74rem !important;  overflow: initial !important;"><i style="margin-left: -2px !important; z-index: 1080 !important" data-feather="clock"></i> {{ $schedule->start_time }} - {{ $schedule->end_time }}<span class="time-in-org-tz"></span></div>
                            </div>
                            <div class="details" style="font-size: 0.74rem !important">
                                @if ($scUsr->name)
                                    @if (request()->active == "Staff")<i data-feather="briefcase"></i>@else<i sty data-feather="user"></i>@endif {{ mb_strimwidth($scUsr->name, 0, 14, "...") }}<br>
                                @endif
                            </div>
                            <div style="border-top: 1px solid lightgray"></div>
                            <div class="details py-1 d-flex flex-row" style="font-size: 0.74rem !important">
                                @if ($schedule->notes != null)
                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $schedule->notes }}">
                                        <i data-feather="info"></i>
                                    </span>
                                @endif
                                &nbsp;
                                @if ($schedule->customer_assignments)
                                    @php
                                        $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
                                    @endphp
                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $assignment->name }}">
                                        <i data-feather="list"></i>
                                    </span>
                                @endif
                                &nbsp;
                                @if ($schedule->customer_loactions)
                                    @php
                                        $locationsArray = explode(",", $schedule->customer_loactions);
                                        $locations00 = DB::table('user_locations')->whereIn('id', $locationsArray)->get();
                                    @endphp
                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($locations00 as $location) {{ $location->location }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                        <i data-feather="map-pin"></i>
                                    </span>
                                @endif
                                &nbsp;
                                @if ($schedule->staff_groups)
                                    @php
                                        $groupsArray = explode(",", $schedule->staff_groups);
                                        $groups000 = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                                    @endphp

                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="@foreach ($groups000 as $group) {{ $group->name }}{{ $loop->last ? '' : ', ' }}@endforeach">
                                        <i data-feather="users"></i>
                                    </span>

                                @endif

                                &nbsp;
                                @if ($schedule->vehicle_id)
                                    @php
                                        $vehicle = DB::table('vehicles')->where('id', $schedule->vehicle_id)->first();
                                    @endphp

                                    <span class="schedule-icon" data-toggle="tooltip" data-placement="bottom" title="{{ $vehicle->name }}">
                                        <i data-feather="truck"></i>
                                    </span>

                                @endif
                            </div>
                        </a>




                    @endforeach
                    <div user-id="{{ $user000->id }}" location="{{ $user000->location_id }}" group="{{ $user000->group_id }}" date="{{ $arrx[2]."-".$arrx[4]."-".$arrx[3] }}" ref-date="@if ($arrx[0] == "Mon") Mandag @elseif ($arrx[0] == "Tue") Tirsdag @elseif ($arrx[0] == "Wed") Onsdag @elseif ($arrx[0] == "Thu") Torsdag @elseif ($arrx[0] == "Fri") Fredag @elseif ($arrx[0] == "Sat") Lørdag @elseif ($arrx[0] == "Sun") Søndag @endif den {{ $arrx[6] }}. @if ($arrx[1] == "Jan") Januar @elseif($arrx[1] == "Feb") Februar @elseif($arrx[1] == "Mar") Marts @elseif($arrx[1] == "Apr") April @elseif($arrx[1] == "May") Maj @elseif($arrx[1] == "Jun") Juni @elseif($arrx[1] == "Jul") Juli @elseif($arrx[1] == "Aug") August @elseif($arrx[1] == "Sep") September @elseif($arrx[1] == "Oct") Oktober @elseif($arrx[1] == "Nov") November @elseif($arrx[1] == "Dec") December    @endif {{ $arrx[2] }}" class="schedule-item-list ui-droppable OpenCreateModal context-menu-two" >

                    </div>

                </div>







            @endforeach




        </div>
    @endif
@endif

