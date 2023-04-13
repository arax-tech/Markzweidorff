@extends('user.layouts.app')
@php
    // error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@php

    error_reporting(0);

    if (request()->filter == "Pending") {
        $schedules = DB::table('schedules')->where('status', 'Pending')->where('date', '>=', date('Y-m-d'))->orderBy('date')->get();
    }else if (request()->filter == "Accepted") {
        $schedules = DB::table('schedules')->where('status', 'Accepted')->where('date', '>=', date('Y-m-d'))->orderBy('date')->get();
    }else if (request()->filter == "Declined") {
        $schedules = DB::table('schedules')->where('status', 'Declined')->where('date', '>=', date('Y-m-d'))->orderBy('date')->get();
    }else if (request()->filter == "NotPublished") {
        $schedules = DB::table('schedules')->where('visibility', 'NotPublished')->where('date', '>=', date('Y-m-d'))->orderBy('date')->get();
    }else{
        $schedules = DB::table('schedules')->where('date', '>=', date('Y-m-d'))->orderBy('date')->get();
    }


    $array = auth::user()->permissions;
    $permission = explode(",", $array);




    $documentsNotifications = DB::table('documents')->get();
    $documents1 = DB::table('document_status')->where(['user_id' => auth::user()->id])->whereIn('status' , ['Read', 'Read Understood', 'Read Not Understood'])->get();

    $documentRead = DB::table('document_status')->where(['user_id' => auth::user()->id, 'status' => 'Read'])->count();
    $documentUnRead = DB::table('document_status')->where(['user_id' => auth::user()->id, 'status' => 'UnRead'])->count();
    $documentReadUnderstood = DB::table('document_status')->where(['user_id' => auth::user()->id, 'status' => 'Read Understood'])->count();
    $documentReadNotUnderstood = DB::table('document_status')->where(['user_id' => auth::user()->id, 'status' => 'Read Not Understood'])->count();


    $schedulesPending = DB::table('schedules')->where('date', '>=', date('Y-m-d'))->where(['status' => 'Pending'])->count();
    $schedulesAccepted = DB::table('schedules')->where('date', '>=', date('Y-m-d'))->where(['status' => 'Accepted'])->count();
    $schedulesDeclined = DB::table('schedules')->where('date', '>=', date('Y-m-d'))->where(['status' => 'Declined'])->count();
    $schedulesNotPublished = DB::table('schedules')->where('date', '>=', date('Y-m-d'))->where(['visibility' => 'NotPublished'])->count();

@endphp
@section('title', 'Startside')
@section('css')
    <style>
        td{vertical-align: middle !important;}
        .dropdown-icon{color: #a7aeb8 !important; height: 0.9em; width: 0.9em;}
        .dropdown-divider{ margin: 0.1rem 0 !important;}
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



        <!-- Example Colored Cards for Dashboard Demo-->
        {{-- <div class="row">
            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Brugere</div>
                                <div class="text-lg fw-bold">{{ DB::table('users')->count() }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="users"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ url('/user') }}">Vis</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>


           

            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">PRI - Mapper</div>
                                <div class="text-lg fw-bold">{{ DB::table('categories')->count() }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="list"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ url('/wiki/category') }}">Vis</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Udleveret udstyr</div>
                                <div class="text-lg fw-bold">{{ DB::table('user_equipment')->count() }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="archive"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ url('/user/equipment/'.auth::user()->id) }}">Vis</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">PRI - Dokumenter</div>
                                <div class="text-lg fw-bold">{{ DB::table('documents')->count() }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="file"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="{{ url('/wiki') }}">Vis</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>


        </div> --}}


        <div class="row">
            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <a href="{{ url('/dashboard?filter=Declined') }}" class="card bg-danger text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Afvist</div>
                                <div class="text-lg fw-bold">{{ $schedulesDeclined }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="alert-circle"></i>
                        </div>
                    </div>
                </a>
            </div>


           

            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <a href="{{ url('/dashboard?filter=Pending') }}" class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Afventer</div>
                                <div class="text-lg fw-bold">{{ $schedulesPending }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="help-circle"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <a href="{{ url('/dashboard?filter=Accepted') }}" class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Accepteret</div>
                                <div class="text-lg fw-bold">{{ $schedulesAccepted }}</div>
                            </div>
                            <i class="feather-xl text-white-50" data-feather="check-circle"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-xl-3 mb-4 col-sm-6">
                <a href="{{ url('/dashboard?filter=NotPublished') }}" class="card bg-light h-100" style="background-image: repeating-linear-gradient(-45deg, white, white 5px, #eff4f8 5px, #eff4f8 10px) !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small text-dark" style="color: #000 !important">Skjult</div>
                                <div class="text-lg fw-bold"  style="color: #000 !important">{{ $schedulesNotPublished }}</div>
                            </div>
                            <i class="feather-xl text-white-50"  style="color: #000 !important" data-feather="eye-off"></i>
                        </div>
                    </div>
                </a>
            </div>


        </div>

        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Kommende vagter
                        <span class="float-end">

                            <div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="me-1" data-feather="filter"></i>
                                    <span>Sorter</span> 
                                </button>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/dashboard') }}"><i class="dropdown-item-icon dropdown-icon" data-feather="circle"></i> Alle</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/dashboard?filter=Pending') }}"><i class="dropdown-item-icon dropdown-icon" data-feather="help-circle"></i> Afventer</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/dashboard?filter=Accepted') }}"><i class="dropdown-item-icon dropdown-icon" data-feather="check-circle"></i> Accepteret</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/dashboard?filter=Declined') }}"><i class="dropdown-item-icon dropdown-icon" data-feather="alert-circle"></i> Afvist</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/dashboard?filter=NotPublished') }}"><i class="dropdown-item-icon dropdown-icon" data-feather="eye-off"></i> Skjult</a></li>
                                    
                                </ul>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Status </th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer</th>
                                    <th>Staff</th>
                                    <th>Assignments</th>
                                    <th class="text-center"><i data-feather="activity"></i></th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach ($schedules as $key => $schedule)
                                    @php
                                        $staff = DB::table('users')->where('id', $schedule->staff_id)->first();
                                        $customer = DB::table('customers')->where('id', $schedule->customer_id)->first();

                                        $assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
                                    @endphp
                                    <tr>
                                       
                                        <td>
                                            <a class="btn btn-sm @if ($schedule->status == 'Pending') bg-warning @elseif ($schedule->status == 'Accepted') bg-success @else bg-danger @endif me-2" href="javascript::">
                                                @if ($schedule->status == "Pending") 
                                                    <i style="color: #fff; width:  15px; height: 15px" data-feather="help-circle"></i>
                                                @elseif ($schedule->status == "Accepted")
                                                    <i style="color: #fff; width:  15px; height: 15px" data-feather="check-circle"></i>
                                                @else
                                                    <i style="color: #fff; width:  15px; height: 15px" data-feather="alert-circle"></i> 
                                                @endif
                                            </a>
                                            {{ $schedule->status }}
                                        </td>
                                        <td>{{ date('d M Y', strtotime($schedule->date)) }}</td>
                                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $staff->name }}</td>
                                        <td>@if ($assignment)
                                            
                                             {{ $assignment->name }} 
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::" data-toggle="tooltip" data-placement="bottom" title="{{ $assignment->co_line }} {{ $assignment->street_navn }} {{ $assignment->street_no }} {{ $assignment->street_level }} <br>
                                            {{ $assignment->po_code }} {{ $assignment->city_name }} <br>
                                            {{ $assignment->country }}"><i data-feather="info"></i></a>
                                        @else
                                        --
                                        @endif
                                            
                                        </td>
                                        
                                        <td class="text-center">
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="me-1" data-feather="more-vertical"></i>
                                            </button>
                                              <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Status</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon dropdown-icon" data-feather="help-circle"></i> Afventer</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon dropdown-icon" data-feather="check-circle"></i> Accepteret</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon dropdown-icon" data-feather="alert-circle"></i> Afvist</a></li>

                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="#">Visiblity</a></li>
                                                <div class="dropdown-divider"></div>

                                                <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon dropdown-icon" data-feather="eye-off"></i> Skjult</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon dropdown-icon" data-feather="eye"></i> Udgivet</a></li>

                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="#">Other</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a class="dropdown-item" href="#"><i class="dropdown-item-icon dropdown-icon" data-feather="user"></i> Remove Staff</a></li>
                                                
                                            </ul>
                                            

                                        </td>
                                        
                                    </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            
            <div class="col-xl-8 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">Oversigt</div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <div id="top_x_div" style="width: 100%; "></div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-4 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">Statistik</div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <div id="piechart" style="width: 100%; "></div>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

@endsection
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">



    $(function () {
      new simpleDatatables.DataTable("#example", {
            labels: {
               placeholder: "Søg efter Vagter...",
               perPage: "Vagter pr. side&nbsp;  {select}",
               noRows: "Intet Vagter matchede din søgning!",
               info: "Viser {start} til {end} af {rows} personaler",
               noResults: "Ingen resultater matchede din søgning!"
            },
            // ...
        });
    })
    /*
    
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.arrayToDataTable([
            ['Opening Move', 'Percentage'],
            ["Read", {{ $documentRead }}],
            ["UnRead", {{ count($documentsNotifications) - count($documents1) }}],
            ["Read Understood ", {{ $documentReadUnderstood }}],
            ["Read Not Understood", {{ $documentReadNotUnderstood }}]
          ]);

          var options = {
            legend: { position: 'none' },
            bars: 'vertical', // Required for Material Bar Charts.
            axes: {
              x: {
                0: { side: 'bottom', label: ''} // Top x-axis.
              }
            },
            bar: { groupWidth: "90%" },
          };

          var chart = new google.charts.Bar(document.getElementById('top_x_div'));
          chart.draw(data, options);
    
    */
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawStuff);

  function drawStuff() {
    
    var data = google.visualization.arrayToDataTable([
        ["", "", { role: "style" } ],
        ["Læst, ej forstået", {{ $documentReadNotUnderstood }}, "#f4a100"],
        ["Læst & forstået", {{ $documentReadUnderstood }}, "#00ac69"],
        ["Læst", {{ $documentRead }}, "#0061f2"],
        ["Ulæst", {{ count($documentsNotifications) - count($documents1) + $documentUnRead }}, "#e81500"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      // var options = {
      //   title: "Density of Precious Metals, in g/cm^3",
      //   bars: 'vertical',
      //   legend: { position: "none" },
      // };


       var options = {
        vAxis: { direction:-1 },
        bar: {groupWidth: "90%"},
        legend: { position: "none" }
      };


      var chart = new google.visualization.BarChart(document.getElementById("top_x_div"));
      chart.draw(view, options);
  };
</script>


<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', ''],
      ['Læst',     {{ $documentRead }}],
      ['Ulæst',      {{ count($documentsNotifications) - count($documents1) +  $documentUnRead }}],
      ['Læst & forstået',  {{ $documentReadUnderstood }}],
      ['Læst, ej forstået',    {{ $documentReadNotUnderstood }}]
    ]);

    var options = {
        legend: 'none',
        chartArea:{width:'100%',height:'100%'},
        colors: ['#0061f2','#e81500', '#00ac69', '#f4a100']
    };


    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>
@endsection
