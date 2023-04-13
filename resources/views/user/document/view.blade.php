@extends('user.layouts.app')

@section('title', 'PRI › Vis dokument')





@section('css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{content: '' !important}
        .badge{
            display: inline-block !important;
            padding: 0.35em 0.65em !important;
            font-size: 0.75em !important;
            font-weight: 400 !important;
            line-height: 1 !important;
            text-align: center !important;
            white-space: nowrap !important;
            vertical-align: baseline !important;
            border-radius: 0.35rem !important;

        }
        .btn-secondary{background: #6900c7 !important; color: #fff !important}
        .btn-success{background: #009259 !important; color: #fff !important}
        .btn-danger{background: #e81500 !important; color: #fff !important}

    </style>
@endsection
@section('content')


    <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                         <h1 class="text-uppercase-expanded fw-500" style="color: #fff; font-size: 1.30rem;">
                            <button class="btn btn-light btn-icon" type="button" onclick="window.history.go(-1); return false;"><i data-feather="arrow-left"></i></button> 
                            {{ $document->title }}

                        </h1>

                    </div>
                </div>
               

                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0 d-flex align-items-center">
                        
                        <li class="breadcrumb-item">
                            <a class=" d-flex align-items-center" href="{{ url('/wiki') }}">
                                <i data-feather="file"></i>&nbsp;PRI-Dokumenter
                            </a>
                        </li>
                        <i data-feather="chevron-right"></i>


                        @if ($level_one_category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/wiki/'.$level_one_category->id) }}">
                                    <i data-feather="{{ $level_one_category->icon }}"></i>&nbsp;{{ $level_one_category->name }}
                                </a>
                            </li>
                            <i data-feather="chevron-right"></i>
                        @endif


                        @if ($level_two_category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/wiki/'.$level_two_category->id) }}">
                                    <i data-feather="{{ $level_two_category->icon }}"></i>&nbsp;{{ $level_two_category->name }}
                                </a>
                            </li>
                            <i data-feather="chevron-right"></i>
                        @endif



                        @if ($level_three_category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/wiki/'.$level_three_category->id) }}">
                                    <i data-feather="{{ $level_three_category->icon }}"></i>&nbsp;{{ $level_three_category->name }}
                                </a>
                            </li>
                            <i data-feather="chevron-right"></i>
                        @endif


                        @if ($category)
                            <li class="breadcrumb-item">
                                <a class=" d-flex align-items-center" href="{{ url('/wiki/'.$category->id) }}">
                                    <i data-feather="{{ $category->icon }}"></i>&nbsp;{{ $category->name }}
                                </a>
                            </li>
                        @endif

                    </ol>

                </nav>


            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <!-- Knowledge base article-->
        <div class="card mb-4">
           

            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard0-tab" href="#wizard0" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard0" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">PRI - Dokument</div>
                            <div class="wizard-step-text-details">Basis information</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Indstillinger</div>
                            <div class="wizard-step-text-details">Andre informationer</div>
                        </div>
                    </a>
                    

                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane  fade show active" id="wizard0" role="tabpanel"
                        aria-labelledby="wizard1-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-12 col-xl-12">
                                

                                <p class="lead">
                                    {!! $document->editor !!}
                                </p>
                                    
                                @php
                                    error_reporting(0);
                                   
                                    $user = DB::table('users')->where('id', $document->user_id)->first();
                                    $category = DB::table('categories')->where('id', $document->category)->first();
                                   
                                @endphp




                                


                                <iframe src="{{ asset('backend/documents/'.$document->pdf) }}" style="width: 100%; height: 1250px"></iframe>
                                    
                                   
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane  fade show " id="wizard1" role="tabpanel"
                        aria-labelledby="wizard1-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-12 col-xl-12">
                                <h5 class="card-title mb-4"></h5>

                                    <table class="table table-striped">
                                        <tr>
                                            <th style="width: 15% !important">E-doc ID:</th>
                                            <td class="d-flex align-items-center">
                                                <i data-feather="compass"></i>&nbsp;{{$document->subtitle }}
                                            </td>
                                        </tr>


                                        
                                        <tr>
                                            <th>Søgeord:</th>
                                            <td class="">
                                                @php
                                                    $array = explode(",", $document->keyword);
                                                    
                                                @endphp
                                                

                                                @foreach ($array as $key => $value)
                                                    <span class="badge d-flex align-items-center text-dark bg-light my-1 mx-1 shadow-sm"> <i style="margin-top: -2px !important" data-feather="tag"></i> {{ $value }}</span>
                                                @endforeach
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Skal læses?</th>
                                            <td>
                                                @if($document->must_read == "Disabled")
                                                    Nej
                                                @elseif($document->must_read == "Enabled")
                                                    Ja
                                                @endif
                                                </td>
                                        </tr>
                                        <tr>
                                            <th>Grupper:</th>
                                            <td>
                                                @php
                                                    error_reporting(0);
                                                    $groups_ids = $document->group_id;
                                                    $arr = explode(",", $groups_ids);
                                                    
                                                    
                                                @endphp


                                                @foreach ($arr as $gp)
                                                
                                                    @php

                                                        $group1 = DB::table('user_groups')->where('id',$gp)->first();
                                                    @endphp
                                                    
                                                        <span style="background: {{ $group1->background }} !important; color: {{ $group1->color }} !important;" class="badge">
                                                            {{ $group1->name }}
                                                           
                                                        </span>
                                                            
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                @php
                                                    error_reporting(0);
                                                   
                                                    $status = DB::table('document_status')->where(['document_id' => $document->id, 'user_id' => auth::user()->id])->first();
                                                   
                                                @endphp
                                                @if (count($status) == 0)
                                                    <span class="badge bg-red text-white mb-1">Ulæst</span>
                                                @elseif($status->status == "Read")
                                                    <span class="badge bg-blue text-white mb-1">Læst</span>
                                                @elseif($status->status == "Read Understood")
                                                    <span class="badge bg-green text-white mb-1">Læst og forstået</span>
                                                @elseif($status->status == "Read Not Understood")
                                                    <span class="badge bg-yellow text-white mb-1">Læst, ej forstået</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Set:</th>
                                            <td>{{ $document->counts }} visninger</td>
                                        </tr>


                                       
                                        
                                    </table>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>

                @if ($document->must_read == "Enabled")
                    <div class="row py-3 ">
                        <div class="col-md-6">
                            <form method="get" action="{{ url('/document/update/Read Understood/'.$document->id) }}">
                                <button type="submit" class="btn btn-success w-100" @if ($status->status == "Read Understood") disabled @endif>Læst og forstået @if ($status->status == "Read Understood") <br>({{ $document->updated_at->format('d M Y H:i') }}) @endif</button>
                            </form>

                        </div>

                        <div class="col-md-6">
                            
                            <button  data-bs-toggle="modal" data-bs-target="#ReadNotUnderstood" class="btn btn-yellow w-100" @if ($status->status == "Read Not Understood") disabled @endif>Læst, ej forstået! @if ($status->status == "Read Not Understood") <br>({{ $document->updated_at->format('d M Y H:i') }}) @endif</button>
                            

                        </div>



                        <!-- Modal -->
                        <div class="modal fade" id="ReadNotUnderstood">
                            <div class="modal-dialog modal-lg  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title"><i class="me-1" data-feather="life-buoy"></i> Læst, ej forstået!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="get" action="{{ url('/document/update/Read Not Understood/'.$document->id) }}">


                                          <div class="row gx-3 mb-3">
                                                <div class="col-md-12">
                                                    <label class="small mb-1">Vil du uddybe hvad du ikke forstår ?</label>
                                                    <textarea rows="4" class="form-control" type="text" name="reason" required /> </textarea>
                                                </div>
                                            </div>  
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                        <button class="btn btn-primary btn-sm float-end" type="submit" data-bs-target="#Loading"><i class="me-1" data-feather="help-circle"></i>&nbsp; Send</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>



        </div>
    </div>




    

@endsection


