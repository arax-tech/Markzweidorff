@extends('user.layouts.app')
@php
    // error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@php
    use Carbon\Carbon;

    error_reporting(0);

    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(7);
    // dd($endDate);
    $schedules = DB::table('schedules')->whereBetween('date', [$startDate, $endDate])->get();

    // $schedules = DB::table('schedules')->where('date', '>=', date('Y-m-d'))->orderBy('date')->get();
    $shifts = DB::table('schedule_applications')->where('accepted', 0)->get();


    $array = auth::user()->permissions;
    $permission = explode(",", $array);






@endphp
@section('title', 'Startside')
@section('css')
    <style>
        td{vertical-align: middle !important;}
        .dropdown-icon{color: #a7aeb8 !important; height: 0.9em; width: 0.9em;}
        .dropdown-divider{ margin: 0.1rem 0 !important;}
        .bg-primary0{background: #673ab7ad !important}
        .bg-info0{background: #58bad7 !important}
    </style>
@endsection

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-fluid px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            Startside
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>


    
    <!-- Main page content-->
    <div class="container-fluid px-4 mt-n10">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-8 justify-content-start">
                                <div class="text-start  mb-4 mb-xl-0 mb-xxl-4">
                                    <h1 class="text-primary">
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
                                        <span>{{ $greeting }}</span>, {{ auth::user()->name }}
                                    </h1>
                                    <p class="text-gray-700 mb-0">
                                        {{ $setting->welcome_sub_heading }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-4 text-center"><img class="img-fluid"
                                    src="{{ asset('dashboard1.gif') }}"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-xl-6">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Vagter (7 dage)
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Status </th>
                                    <th>Dato</th>
                                    <th>Kunde</th>
                                    <th>Personale</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach ($schedules as $key => $schedule)
                                    @php
                                        $staff = DB::table('users')->where('id', $schedule->staff_id)->first();
                                        $customer = DB::table('customers')->where('id', $schedule->customer_id)->first();
                                    @endphp
                                    <tr>
                                       
                                        <td>


                                            @if ($schedule->staff_id == 0)
                                                <a class="btn btn-sm @if ($schedule->status == 'Pending') bg-info0 @elseif ($schedule->status == 'Accepted') bg-success @else bg-danger @endif me-2" href="javascript::">
                                                    @if ($schedule->status == "Pending") 
                                                        <i style="color: #fff; width:  15px; height: 15px" data-feather="circle"></i>
                                                    @elseif ($schedule->status == "Accepted")
                                                        <i style="color: #fff; width:  15px; height: 15px" data-feather="check-circle"></i>
                                                    @else
                                                        <i style="color: #fff; width:  15px; height: 15px" data-feather="alert-circle"></i> 
                                                    @endif
                                                </a>
                                                

                                            @else
                                                <a class="btn btn-sm @if ($schedule->status == 'Pending') bg-warning @elseif ($schedule->status == 'Accepted') bg-success @else bg-danger @endif me-2" href="javascript::">
                                                    @if ($schedule->status == "Pending") 
                                                        <i style="color: #fff; width:  15px; height: 15px" data-feather="help-circle"></i>
                                                    @elseif ($schedule->status == "Accepted")
                                                        <i style="color: #fff; width:  15px; height: 15px" data-feather="check-circle"></i>
                                                    @else
                                                        <i style="color: #fff; width:  15px; height: 15px" data-feather="alert-circle"></i> 
                                                    @endif
                                                </a>
                                            @endif

                                                
                                            
                                            @if ($schedule->status == "Pending") 
                                                Ledig
                                            @elseif ($schedule->status == "Accepted")
                                                Accepteret
                                            @else
                                                Afvist
                                            @endif
                                        </td>
                                        <td>{{ date('d M Y', strtotime($schedule->date)) }}</td>
                                        <td>{{ mb_strimwidth($customer->name, 0, 15, "...") }}</td>
                                        <td>{{ mb_strimwidth($staff->name, 0, 15, "...") }}</td>
                                        
                                    </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-xl-6">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Vagtanmodninger
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Status </th>
                                    <th>Dato</th>
                                    <th>Kunde</th>
                                    <th>Personale</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach ($shifts as $key => $shift)
                                    @php
                                        $schedule = DB::table("schedules")->where('id', $shift->schedule_id)->first();
                                        $customer = DB::table('customers')->where('id', $schedule->customer_id)->first();
                                        $user = DB::table('users')->where('id', $shift->user_id)->first();
                                    @endphp
                                    <tr>
                                       
                                        <td>
                                            <a class="btn btn-sm bg-primary0 me-2" href="javascript::">
                                                <i style="color: #fff; width:  15px; height: 15px" data-feather="plus-circle"></i>
                                            </a>
                                            Anmodet
                                        </td>
                                        <td>{{ date('d M Y', strtotime($schedule->date)) }}</td>
                                        <td>{{ mb_strimwidth($customer->name, 0, 15, "...") }}</td>
                                        <td>{{ mb_strimwidth($staff->name, 0, 15, "...") }}</td>
                                    </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



@endsection
@section('js')


@endsection
