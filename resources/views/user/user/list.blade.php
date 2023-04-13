@extends('user.layouts.app')
@php
    $title = $user->name.' › PRI - Oversigt';
    $array = auth::user()->permissions;
    $permission = explode(",", $array);

    $documentsNotifications = DB::table('documents')->get();
    $documents1 = DB::table('document_status')->where(['user_id' => $user->id])->whereIn('status' , ['Read', 'UnRead', 'Read Understood', 'Read Not Understood'])->get();
    
    $documentRead = DB::table('document_status')->where(['user_id' => $user->id, 'status' => 'Read'])->get();
    $documentUnRead = DB::table('document_status')->where(['user_id' => $user->id, 'status' => 'UnRead'])->get();
    $documentReadUnderstood = DB::table('document_status')->where(['user_id' => $user->id, 'status' => 'Read Understood'])->get();
    $documentReadNotUnderstood = DB::table('document_status')->where(['user_id' => $user->id, 'status' => 'Read Not Understood'])->get();
@endphp
@section('title', $title)
@section('css')
    <style>
        .small { color: #31353d !important; }
        .nav-link { color: #31353d !important; }
        .active { color: #f53b57 !important; }
        td{vertical-align: middle !important;}
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
@endsection
@section('content')
@include('user.user.header')
<!-- Main page content-->
<div class="container-fluid px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        @include('user.user.navbar')
    </nav>
    <hr class="mt-0 mb-4" />
    <div class="row">
        <div class="col-xl-4 mb-4">
            <div class="card card-header-actions">
                <div class="card-header">Statistik</div>
                <div class="card-body">
                    <div class="chart-bar">
                        <div id="piechart" style="width: 100%; "></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card card-header-actions">
                <div class="card-header">Overblik</div>
                <div class="card-body p-0">
                    <div class="table-responsive table-billing-history">
                        <table class="table table-striped table-billing-history mb-0">
                            <thead>
                                <tr>
                                    <th class="border-gray-200" scope="col"><span class="badge bg-light">&nbsp;</span></th>
                                    <th class="border-gray-200" scope="col">Status</th>
                                    <th class="border-gray-200" scope="col">Antal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-blue">&nbsp;</span></td>
                                    <td>Læst</td>
                                    <td>{{ count($documentRead) }}</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-red">&nbsp;</span></td>
                                    <td>Ulæst</td>
                                    <td>{{ count($documentsNotifications) - count($documents1) + count($documentUnRead) }}</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-green">&nbsp;</span></td>
                                    <td>Læst og forstået</td>
                                    <td>{{ count($documentReadUnderstood) }}</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-yellow">&nbsp;</span></td>
                                    <td>Læst, ej forstået</td>
                                    <td>{{ count($documentReadNotUnderstood) }}</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-dark">&nbsp;</span></td>
                                    <td><b>Alle dokumenter</b></td>
                                    <td><b>{{ count($documentRead) + count($documentsNotifications) - count($documents1) + count($documentUnRead) +count($documentReadUnderstood) + count($documentReadNotUnderstood) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card mb-4">
                <div class="card-header">Reset PRI-documents</div>
                <div class="card-body">
                    <p>Click on below button to reset all PRI-documents associated with this user.</p>
                        
                    <a href="{{ url('/user/pir/all/reset/'.$user->id) }}" class="btn btn-danger-soft w-100 text-danger">I understand, reset all PRI-documents for USERS NAME!</a>
                        
                    
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="read-tab" data-bs-toggle="tab" data-bs-target="#read-tab-pane" type="button" role="tab" aria-controls="read-tab-pane" aria-selected="true">Læst</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="UnRead-tab" data-bs-toggle="tab" data-bs-target="#UnRead-tab-pane" type="button" role="tab" aria-controls="UnRead-tab-pane" aria-selected="false">Ulæst</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="documentReadUnderstood-tab" data-bs-toggle="tab" data-bs-target="#documentReadUnderstood-tab-pane" type="button" role="tab" aria-controls="documentReadUnderstood-tab-pane" aria-selected="false">Læst og forstået</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="documentReadNotUnderstood-tab" data-bs-toggle="tab" data-bs-target="#documentReadNotUnderstood-tab-pane" type="button" role="tab" aria-controls="documentReadNotUnderstood-tab-pane" aria-selected="false">Læst, ej forstået</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-content" id="myTabContent">
                        <div class="table-responsive tab-pane fade show active" id="read-tab-pane" role="tabpanel" aria-labelledby="read-tab" tabindex="0">
                            <table class="table table-striped table-billing-history mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 100px !important;">Status</th>
                                        <th width="40%">Titel</th>
                                        <th width="30%">Mappe</th>
                                        <th style="min-width: 130px !important;">&nbsp;</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($documentRead as $key => $doc)
                                    @php
                                    $document = DB::table('documents')->where('id', $doc->document_id)->first();
                                    @endphp
                                    <tr>
                                        <td valign="center">
                                            <span class="badge bg-blue text-white mb-1">Læst</span>
                                        </td>
                                        <td>
                                            <a href="{{ url('/wiki/view/'.$document->id) }}">
                                                <i data-feather="{{ $document->icon }}"></i>&nbsp;{{ mb_strimwidth($document->title, 0, 50, "...") }}
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                            $check = DB::table('categories')->where('id', $document->category)->count();
                                            @endphp
                                            @if ($check > 0)
                                            <a href="{{ url('/wiki/category') }}">
                                                @php
                                                error_reporting(0);
                                                
                                                $category = DB::table('categories')->where('id', $document->category)->first();
                                                @endphp
                                                <small><i data-feather="{{ $category->icon }}"></i>&nbsp;
                                                {{ $category->name }}
                                            </a></small>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td align="right"><a class="btn btn-danger-soft text-danger btn-sm" href="{{ url('/user/pir/single/reset/'.$document->id.'/'.$user->id) }}"><i data-feather="eye-off"></i>&nbsp; Nulstil</a></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       
                        <div class="tab-pane fade pt-4" id="UnRead-tab-pane" role="tabpanel" aria-labelledby="UnRead-tab" tabindex="0">
                            <table class="table table-striped table-hover"  id="">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Titel</th>
                                        <th>Mappe</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                
                                <tbody>

                                    @foreach ($documentsNotifications as $key => $doc)
                                    @php
                                        $documentStatus = DB::table('document_status')->where(['document_id' => $doc->id, 'user_id' => $user->id])->first();
                                    @endphp
                                        @if ($documentStatus->document_id != $doc->id)
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn badge bg-red text-white">Ulæst</button>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/wiki/view/'.$doc->id) }}">
                                                        <i data-feather="{{ $doc->icon }}"></i>&nbsp;{{ mb_strimwidth($doc->title, 0, 40, "...") }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @php
                                                    $check = DB::table('categories')->where('id', $document->category)->count();
                                                    @endphp
                                                    @if ($check > 0)
                                                    <a href="{{ url('/wiki/category') }}">
                                                        @php
                                                        error_reporting(0);
                                                        
                                                        $category = DB::table('categories')->where('id', $document->category)->first();
                                                        @endphp
                                                        <i data-feather="{{ $category->icon }}"></i>&nbsp;
                                                        {{ $category->name }}
                                                    </a>
                                                    @else
                                                    N/A
                                                    @endif
                                                </td>
                                                {{-- <td><a class="btn btn-danger-soft text-danger" href="{{ url('/user/pir/single/reset/'.$document->id.'/'.$user->id) }}">Reset</a></td> --}}
                                                
                                                
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade pt-4" id="documentReadUnderstood-tab-pane" role="tabpanel" aria-labelledby="documentReadUnderstood-tab" tabindex="0">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Titel</th>
                                        <th>Mappe</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($documentReadUnderstood as $key => $doc)
                                    @php
                                    $document = DB::table('documents')->where('id', $doc->document_id)->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            <form action="{{ url('/user/wiki/reset/'.$doc->id) }}">
                                                @if($doc->status == "Read")
                                                    <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-blue text-white">Læst</button>
                                                @elseif($doc->status == "Read Understood")
                                                    <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-green text-white">Læst & forstået</button>
                                                @elseif($doc->status == "Read Not Understood")
                                                    <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-yellow text-white">Læst, ej forstået</button>
                                                @else
                                                    <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-red text-white">Ulæst</button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ url('/wiki/view/'.$document->id) }}">
                                                <i data-feather="{{ $document->icon }}"></i>&nbsp;{{ mb_strimwidth($document->title, 0, 30, "...") }}
                                            </a>
                                        </td>
                                        <td class="small">
                                            @php
                                            $check = DB::table('categories')->where('id', $document->category)->count();
                                            @endphp
                                            @if ($check > 0)
                                            <a href="{{ url('/document/category') }}">
                                                @php
                                                error_reporting(0);
                                                
                                                $category = DB::table('categories')->where('id', $document->category)->first();
                                                @endphp
                                                <i data-feather="{{ $category->icon }}"></i>&nbsp;
                                                {{ $category->name }}
                                            </a>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td><a class="btn btn-danger-soft text-danger" href="{{ url('/user/pir/single/reset/'.$document->id.'/'.$user->id) }}">Reset</a></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade pt-4" id="documentReadNotUnderstood-tab-pane" role="tabpanel" aria-labelledby="documentReadNotUnderstood-tab" tabindex="0">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Titel</th>
                                        <th>Mappe</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($documentReadNotUnderstood as $key => $doc)
                                    @php
                                    $document = DB::table('documents')->where('id', $doc->document_id)->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            <form action="{{ url('/user/wiki/reset/'.$doc->id) }}">
                                                @if($doc->status == "Read")
                                                <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-blue text-white">Læst</button>
                                                @elseif($doc->status == "Read Understood")
                                                <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-green text-white">Læst & forstået</button>
                                                @elseif($doc->status == "Read Not Understood")
                                                <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-yellow text-white">Læst, ej forstået</button>
                                                @else
                                                <button onclick="return confirm('Er du sikker på at du vil nulstille ?')" type="submit" class="btn badge bg-red text-white">Ulæst</button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ url('/wiki/view/'.$document->id) }}">
                                                <i data-feather="{{ $document->icon }}"></i>&nbsp;{{ mb_strimwidth($document->title, 0, 30, "...") }}
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                            $check = DB::table('categories')->where('id', $document->category)->count();
                                            @endphp
                                            @if ($check > 0)
                                            <a href="{{ url('/document/category') }}">
                                                @php
                                                error_reporting(0);
                                                
                                                $category = DB::table('categories')->where('id', $document->category)->first();
                                                @endphp
                                                <i data-feather="{{ $category->icon }}"></i>&nbsp;
                                                {{ $category->name }}
                                            </a>
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td><a class="btn btn-danger-soft text-danger" href="{{ url('/user/pir/single/reset/'.$document->id.'/'.$user->id) }}">Reset</a></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#group").chosen({});
        $(".group").chosen({});
        
    });
</script>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', ''],
      ['Læst',     {{ count($documentRead) }}],
      ['Ulæst', {{ count($documentsNotifications) - count($documents1) + count($documentUnRead) }}],
      ['Læst & forstået',  {{ count($documentReadUnderstood) }}],
      ['Læst, ej forstået',    {{ count($documentReadNotUnderstood) }}]
    ]);

    var options = {
        legend: 'none',
        chartArea:{width:'100%',height:'100%'},
        colors: ['#0061f2','#e81500', '#00ac69', '#f4a100'],
    };


    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>
@endsection