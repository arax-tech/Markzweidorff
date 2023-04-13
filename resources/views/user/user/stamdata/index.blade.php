@extends('user.layouts.app')

@php
    $title = $user->name.' › Stamdata';
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp
@section('title', $title)
@section('css')
    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important; font-size: 0.8rem !important;}

        th{
             font-size: 0.8rem !important;
             font-weight: 600
        }
    </style>    
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
            <div class="col-lg-8">

                <div class="card mb-4">
                    <div class="card-header">
                        Kontaktpersoner

                        <span class="float-end">


                            @if (in_array("All", $permission) OR in_array("UserStamDataCreate", $permission) AND auth::user()->id != $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateStamData"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @elseif (in_array("AuthStamDataCreate", $permission) AND auth::user()->id == $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateStamData"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @endif
                            

                            <!-- Modal -->
                            <div class="modal fade" id="CreateStamData">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret kontaktperson</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/stamdata/contact/store/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Navn</label>
                                                        <input class="form-control" type="text" name="name" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Telefon</label>
                                                        <input class="form-control" type="text" name="phone" />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Relation</label>
                                                        <input class="form-control" type="text" name="relation" />
                                                    </div>                                                    
                                                </div>          

                                                </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                                    </div>
                                                </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-billing-history">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        
                                        <th width="35%">Navn</th>
                                        <th width="25%">Telefon</th>
                                        <th width="25%">Relation</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($contacts as $key => $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->relation }}</td>
                                            

                                            <td align="right">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateContact{{ $contact->id }}"><i data-feather="edit"></i></a>
                                                <a onclick="return confirm('Er du sikker på at du vil slette denne kontaktperson ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/stamdata/contact/delete/'.$contact->id) }}"><i data-feather="trash-2"></i></a>
                                            </td>


                                        </tr>




                                        <!-- Modal -->
                                        <div class="modal fade" id="UpdateContact{{ $contact->id }}">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Opdater kontaktperson</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ url('user/stamdata/contact/update/'.$contact->id) }}">
                                                            @csrf


                                                          <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Navn</label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $contact->name }}" required />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Telefon</label>
                                                                    <input class="form-control" type="text" name="phone" value="{{ $contact->phone }}" required />
                                                                </div>

                                                                
                                                            </div>    
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="small mb-1">Relation</label>
                                                                    <input class="form-control" type="text" name="relation" value="{{ $contact->relation }}" />
                                                                </div>
                                                            </div>          
                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="card mb-4">
                    <div class="card-header">
                        Kurser & Certifikater

                        <span class="float-end">

                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CosesCreate"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="CosesCreate">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret Kursus/Certifikat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/course/store/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Titel</label>
                                                        <input class="form-control" type="text" name="title" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Dato</label>
                                                        <input class="form-control" type="date" name="date" required />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Udløbsdato</label>
                                                        <input class="form-control" type="date" name="expiry" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Kursusbevis</label>
                                                        <input class="form-control" type="file" name="document" />
                                                    </div>
                                                    
                                                </div>          

                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-billing-history">
                            <table class="table table-striped table-hover mb-0" id="example1">
                                <thead>
                                    <tr>
                                        <th width="35%">Titel</th>
                                        <th width="25%">Dato</th>
                                        <th width="25%">Udløb</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($courses as $key => $course)
                                        <tr>
                                            <td>
                                                @if ($course->document)
                                                    <a target="_blank" href="{{ asset('/backend/stamdata/document/'.$course->document) }}">{{ $course->title }}</a>
                                                @else
                                                    {{ $course->title }}
                                                @endif
                                            </td>
                                            <td>{{ date('d M Y', strtotime($course->date)) }}</td>
                                            <td>{{ $course->expiry  && date('d M Y', strtotime($course->expiry)) }}</td>
                                            

                                            <td align="right">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateCose{{ $course->id }}"><i data-feather="edit"></i></a>
                                                <a onclick="return confirm('Er du sikker på at du vil slette ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/stamdata/course/delete/'.$course->id) }}"><i data-feather="trash-2"></i></a>
                                            </td>
                                        </tr>


                                        <!-- Modal -->
                                        <div class="modal fade" id="UpdateCose{{ $course->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Opdater Kursus/Certifikat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/course/update/'.$course->id) }}">
                                                    @csrf

                                                  <div class="row gx-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="small mb-1">Titel</label>
                                                            <input class="form-control" type="text" name="title" value="{{ $course->title }}" required />
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="small mb-1">Dato</label>
                                                            <input class="form-control" type="date" name="date" value="{{ $course->date }}" required />
                                                        </div>
                                                    </div>

                                                    <div class="row gx-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="small mb-1">Udløbsdato</label>
                                                            <input class="form-control" type="date" name="expiry" value="{{ $course->expiry }}" />
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="small mb-1">Kursusbevis</label>
                                                            <input class="form-control" type="file" name="document" />
                                                        </div>
                                                    </div>          

                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                    <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                                </div>
                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="card mb-4">
                    <div class="card-header">
                        Autorisation

                        <span class="float-end">

                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AuthorizationCreate"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="AuthorizationCreate">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret Autorisation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/authorization/store/'.$user->id) }}">
                                                @csrf


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Aut Id</label>
                                                        <input class="form-control" type="text" name="auth_id" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Faggruppe</label>
                                                      
                                                        <select class="form-control" type="text" name="subject_group" required />>
                                                            <option value=""></option>

                                                            <option>Ambulancebehandler</option>
                                                            <option>Læge</option>
                                                            <option>Sygeplejerske</option>

                                                            <optgroup label="Andre faggrupper">
                                                                <option>Bandagist</option>
                                                                <option>Behandlerfarmaceut</option>
                                                                <option>Bioanalytiker</option>
                                                                <option>Ergoterapeut</option>
                                                                <option>Fodterapeut</option>
                                                                <option>Fysioterapeut</option>
                                                                <option>Jordemoder</option>
                                                                <option>Kiropraktor</option>
                                                                <option>Klinisk diætist</option>
                                                                <option>Klinisk tandtekniker</option>
                                                                <option>Optiker og Optometrist</option>
                                                                <option>Osteopat</option>
                                                                <option>Radiograf</option>
                                                                <option>Social- og sundhedsassistent</option>
                                                                <option>Tandlæge</option>
                                                                <option>Tandplejer</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Speciale</label>
                                                        <input class="form-control" type="text" name="thesis" />
                                                    </div>

                                                    {{-- <div class="col-md-6">
                                                        <label class="small mb-1">Kursusbevis</label>
                                                        <input class="form-control" type="datetime-local" name="last_validate"/>
                                                    </div> --}}
                                                    
                                                </div>          

                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-billing-history">
                            <table class="table table-striped table-hover mb-0" id="example1">
                                <thead>
                                    <tr>
                                        <th width="15%">Aut Id</th>
                                        <th width="20%">Faggruppe</th>
                                        <th width="25%">Speciale</th>
                                        <th width="25%">Valideret</th>
                                        <th style="min-width: 100px !important;">&nbsp;</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($authorizations as $key => $authorization)
                                        <tr data-bs-toggle="modal" data-bs-target="#ViewAuthorization{{ $authorization->id }}" style="cursor: pointer;">
                                            <td>{{ $authorization->auth_id }}</td>
                                            <td>{{ $authorization->subject_group }}</td>
                                            <td>{{ $authorization->thesis }}</td>
                                            @php
                                                error_reporting(0);
                                                $user000 = DB::table('users')->where('id', $authorization->last_validate_by)->first();
                                            @endphp
                                            <td>
                                                <div><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="user"></i>&nbsp; <small>{{ $user000->name }}</small></div>
                                                <div style="padding-top: 5px;"><i class="dropdown-item-icon" style="color: #69707A !important; height: 0.95em; width: 0.95em;" data-feather="calendar"></i>&nbsp; <small>{{ $authorization->last_validate ? $authorization->last_validate : 'Ej valideret!'  }}</small></div>
                                            </td>

                                            <td align="right">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateAuthorization{{ $authorization->id }}"><i data-feather="edit"></i></a>
                                                <a onclick="return confirm('Er du sikker på at du vil slette ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/stamdata/authorization/delete/'.$authorization->id) }}"><i data-feather="trash-2"></i></a>
                                            </td>
                                        </tr>


                                        <!-- View Modal -->
                                        <div class="modal fade" id="ViewAuthorization{{ $authorization->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Vis Autorisation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="background-color: #F3F3F4;">
                                                        <iframe width="100%" height="360px" src="https://autregweb.sst.dk/AuthorizationSearchResult.aspx?authorizationId={{ $authorization->auth_id }}" title="description"></iframe>
                                                    </div>
                                                    
                                                        <div class="card-footer">
                                                            <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/authorization/validate/'.$authorization->id) }}">
                                                            <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                                @csrf
                                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="check"></i>&nbsp; Valider gyldig autorisation</button>
                                                        </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Modal -->
                                        <div class="modal fade" id="UpdateAuthorization{{ $authorization->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Opdater Autorisation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/authorization/update/'.$authorization->id) }}">
                                                    @csrf

                                                    <div class="row gx-3 mb-3">
                                                        <div class="col-md-6">
                                                            <label class="small mb-1">Aut Id</label>
                                                            <input class="form-control" type="text" readonly="" name="auth_id" value="{{ $authorization->auth_id }}" required />
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="small mb-1">Faggruppe</label>
                                                            <input class="form-control" type="text" readonly="" name="subject_group" value="{{ $authorization->subject_group }}" required />
                                                        </div>

                                                        
                                                    </div>    
                                                    <div class="row gx-3 mb-3">
                                                        <div class="col-md-12">
                                                            <label class="small mb-1">Speciale</label>
                                                            <input class="form-control" type="text" name="thesis" value="{{ $authorization->thesis }}" />
                                                        </div>

                                                        {{-- <div class="col-md-6">
                                                            <label class="small mb-1">Kursusbevis</label>
                                                            <input class="form-control" type="datetime-local" name="last_validate" value="{{ $authorization->last_validate }}" />
                                                        </div> --}}
                                                        
                                                    </div> 

                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                    <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                                </div>
                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="card mb-4">
                    <div class="card-header">
                        Kørekort

                        <span class="float-end">


                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#LincenceCreate"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                            

                            <!-- Modal -->
                            <div class="modal fade" id="LincenceCreate">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret kørekort</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/stamdata/license/store/'.$user->id) }}" enctype="multipart/form-data">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Nummer</label>
                                                        <input class="form-control" type="text" name="number" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Kategori</label>
                                                        <input class="form-control" type="text" name="category" required />
                                                    </div>

                                                    
                                                </div>

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Type</label>
                                                        <input class="form-control" type="text" name="type" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Udløb</label>
                                                        <input class="form-control" type="date" name="expiry" required />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Billede - forside</label>
                                                        <input class="form-control" type="file" name="front_image" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Billede - bagside</label>
                                                        <input class="form-control" type="file" name="back_image" />
                                                    </div>
                                                </div>          
                                                          
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body P-0">
                        <div class="table-responsive table-billing-history">
                            <table class="table table-striped table-hover MB-0" id="example1">
                                <thead>
                                    <tr>
                                        
                                        <th width="15%">Type</th>
                                        <th width="20%">Nummer</th>
                                        <th width="25%">Kategori</th>
                                        <th width="25%">Udløb</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ($licenses as $key => $license)
                                        <tr data-bs-toggle="modal" data-bs-target="#View{{ $license->id }}" style="cursor: pointer;">
                                            <td>{{ $license->type }}</td>
                                            <td>{{ $license->number }}</td>
                                            <td>{{ $license->category }}</td>
                                            <td>{{ date('d M Y', strtotime($license->expiry)) }}</td>

                                            <td align="right">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateLicense{{ $license->id }}"><i data-feather="edit"></i></a>
                                                <a onclick="return confirm('Er du sikker på at du vil slette ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/stamdata/license/delete/'.$license->id) }}"><i data-feather="trash-2"></i></a>
                                            </td>

                                        </tr>




                                        <!-- Modal -->
                                        <div class="modal fade" id="View{{ $license->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Vis kørekort</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                                                            <div class="col-md-6">
                                                                <label class="mb-1 text-xs text-gray-600 fw-200">Nummer</label><br>
                                                                <label class="mb-1">{{ $license->number }}</label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="mb-1 text-xs text-gray-600 fw-200">Kategori</label><br>
                                                                <label class="mb-1">{{ $license->category }}</label>
                                                            </div>
                                                        </div>

                                                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                                                            <div class="col-md-6">
                                                                <label class="mb-1 text-xs text-gray-600 fw-200">Type</label><br>
                                                                <label class="mb-1">{{ $license->type }}</label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="mb-1 text-xs text-gray-600 fw-200">Udløb</label><br>
                                                                <label class="mb-1">{{ date('d M Y', strtotime($license->expiry)) }}</label>
                                                            </div>
                                                        </div>

                                                        


                                                        <div class="row gx-3 mb-3">
                                                            <div class="col-md-6">
                                                                <label class="mb-1 text-xs text-gray-600 fw-200">Forside</label><br>
                                                                <img style="width: 100%" src="{{ asset('/backend/stamdata/license/'.$license->front_image) }}">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="mb-1 text-xs text-gray-600 fw-200">Bagside</label><br>
                                                                <img style="width: 100%" src="{{ asset('/backend/stamdata/license/'.$license->back_image) }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#UpdateLicense{{ $license->id }}"><i class="me-1" data-feather="edit"></i>&nbsp; Opdater</button>            
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>




                                        <div class="modal fade" id="UpdateLicense{{ $license->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Opdater kørekort</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ url('user/stamdata/license/update/'.$license->id) }}" enctype="multipart/form-data">
                                                            @csrf


                                                          <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Nummer</label>
                                                                    <input class="form-control" type="text" name="number" value="{{ $license->number }}" required />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Kategori</label>
                                                                    <input class="form-control" type="text" name="category" value="{{ $license->category }}" required />
                                                                </div>

                                                                
                                                            </div>    
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Type</label>
                                                                    <input class="form-control" type="text" name="type" value="{{ $license->type }}" required />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Udløb</label>
                                                                    <input class="form-control" type="date" name="expiry" value="{{ $license->expiry }}" required />
                                                                </div>
                                                            </div>    
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Billede - forside</label>
                                                                    <input class="form-control" type="file" name="front_image" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Billede - bagside</label>
                                                                    <input class="form-control" type="file" name="back_image" />
                                                                </div> 
                                                            </div>          

                                                          </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
      

                <div class="card mb-4">
                    <div class="card-header">
                        Ansættelse

                        <span class="float-end">


                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#UpdateEmployment"><i class="me-1" data-feather="edit"></i> &nbsp;Opdater</button>
                            

                            <!-- Modal -->
                            <div class="modal fade" id="UpdateEmployment">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opdater ansættelse</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/stamdata/employment/update/'.$user->id) }}">
                                                @csrf


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">CPR-nr.</label>
                                                        <input class="form-control" placeholder="ddmmåå-xxxx" data-toggle="tooltip" data-placement="top" title="ddmmåå-xxxx" type="text" name="birthday_cdr_control" value="{{ $user->birthday_cdr_control }}" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Type</label>
                                                        <input class="form-control" type="text" name="type" value="{{ $user->type }}" />
                                                    </div>
                                                    
                                                </div>
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Start Date </label>
                                                        <input class="form-control" type="date" name="start_date" value="{{ $user->start_date }}" required />
                                                    </div>

                                                    

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">End Date</label>
                                                        <input class="form-control" type="date" name="end_date" value="{{ $user->end_date }}" />
                                                    </div>
                                                    
                                                </div>        

                                             

                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100  mt-1" type="submit">Opdater</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>


                    </div>
                    <div class="card-body">

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">CPR-nr.</label><br>
                                <label class="mb-1">{{ $user->birthday_cdr_control }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Ansættelsestype</label><br>
                                <label class="mb-1">{{ $user->type }}</label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Ansættelsesstart</label><br>
                                <label class="mb-1">{{ $user->start_date ? date('d M Y', strtotime($user->start_date)) : "" }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Ansættelsesophør</label><br>
                                <label class="mb-1">{{  $user->end_date ? date('d M Y', strtotime($user->end_date)) : "" }}</label>
                            </div>
                        </div>

                        
                        
                    </div>
                </div>



                <div class="card mb-4">
                    <div class="card-header">
                        Bank

                        <span class="float-end">


                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#UpdateBank{{ $bank->id }}"><i class="me-1" data-feather="edit"></i> &nbsp;Opdater</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="UpdateBank{{ $bank->id }}">
                                <div class="modal-dialog modal-m modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opdater Bank</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/bank/store/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-3">
                                                        <label class="small mb-1">Danløn nr.</label>
                                                        <input class="form-control" type="text" name="payrol_number" value="{{ $bank->payrol_number }}" />
                                                    </div>

                                                    <div class="col-md-9">
                                                        <label class="small mb-1">Bank Navn</label>
                                                        <input class="form-control" type="text" name="bank_name" value="{{ $bank->bank_name }}" />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-3">
                                                        <label class="small mb-1">Reg-nr.</label>
                                                        <input class="form-control" type="text" name="rit_number" value="{{ $bank->rit_number }}" />
                                                    </div>

                                                    <div class="col-md-9">
                                                        <label class="small mb-1">Konto nr.</label>
                                                        <input class="form-control" type="text" name="account_number" value="{{ $bank->account_number }}" />
                                                    </div>
                                                </div>    
                                                <div class="row gx-3 mb-3">    
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">IBAN nr. / Swift adresse</label>
                                                        <input class="form-control" type="text" name="swift_number" value="{{ $bank->swift_number }}" />
                                                    </div>
                                                </div>          

                                                          

                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater Bank</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                        </span>


                    </div>
                    <div class="card-body">

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Danløn nr.</label><br>
                                <label class="mb-1">{{ $bank->payrol_number ? $bank->payrol_number : '' }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Bank Navn</label><br>
                                <label class="mb-1">{{ $bank->bank_name ? $bank->bank_name : ''}}</label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Reg-nr.</label><br>
                                <label class="mb-1">{{  $bank->rit_number ? $bank->rit_number : '' }}</label>
                            </div>
                        
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Konto nr.</label><br>
                                <label class="mb-1">{{ $bank->account_number ? $bank->account_number : ''}}</label>
                            </div>

                            
                        </div>

                        <div class="row gx-3 mb-3">

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">IBAN nr. / Swift adresse</label><br>
                                <label class="mb-1">{{  $bank->swift_number ? $bank->swift_number : '' }}</label>
                            </div>
                        
                           
                            
                        </div>

                        
                        
                    </div>
                </div>



                 <div class="card mb-4">
                    <div class="card-header">
                        Andre systemer

                        <span class="float-end">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CosesAssociated"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>                            

                            <!-- Modal -->
                            <div class="modal fade" id="CosesAssociated">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret Andre systemer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/associated/store/'.$user->id) }}">
                                                @csrf

                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Navn</label>
                                                        <input class="form-control" type="text" name="name" required />
                                                    </div>
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Note</label>
                                                        <input class="form-control" type="text" name="note" required />
                                                    </div>
                                                </div>         

                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body P-0">
                        <div class="table-responsive table-billing-history">
                            <table class="table table-striped table-hover MB-0" id="example1">
                                
                                <tbody>
                                    @foreach ($associateds as $key => $associated)
                                        <tr>
                                            <td><strong>{{ $associated->name }}</strong><br>{{ $associated->note }}</td>
                                            <td align="right">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateAssociated{{ $associated->id }}"><i data-feather="edit"></i></a>
                                                <a onclick="return confirm('Er du sikker på at du vil slette ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/stamdata/associated/delete/'.$associated->id) }}"><i data-feather="trash-2"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="UpdateAssociated{{ $associated->id }}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Opdater Andre systemer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="{{ url('user/stamdata/associated/update/'.$associated->id) }}">
                                                            @csrf


                                                          <div class="row gx-3 mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="small mb-1">Navn</label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $associated->name }}" required />
                                                                </div>
                                                            </div>    
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="small mb-1">Note</label>
                                                                    <input class="form-control" type="text" name="note" value="{{ $associated->note }}" required />
                                                                </div>
                                                                
                                                            </div>         

                                                    </div>
                                                    <div class="card-footer">
                                                        <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





                {{-- <div class="card mb-4">
                    <div class="card-header">
                        Driving License

                        <span class="float-end">


                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#LincenceCreate"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                            

                            <!-- Modal -->
                            <div class="modal fade" id="LincenceCreate">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Create Lincense</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/stamdata/license/store/'.$user->id) }}" enctype="multipart/form-data">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Number</label>
                                                        <input class="form-control" type="text" name="number" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Category</label>
                                                        <input class="form-control" type="text" name="category" required />
                                                    </div>

                                                    
                                                </div>

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Type</label>
                                                        <input class="form-control" type="text" name="type" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Expiry</label>
                                                        <input class="form-control" type="date" name="expiry" required />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Font Image</label>
                                                        <input class="form-control" type="file" name="front_image" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Back Image</label>
                                                        <input class="form-control" type="file" name="back_image" required />
                                                    </div>

                                                  
                                                    
                                                </div>          

                                                          




                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Create License</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>


                    </div>
                    <div class="card-body">


                       


                        @foreach ($licenses as $license)
                            <a href="javascript::" data-bs-toggle="modal" data-bs-target="#View{{ $license->id }}">
                                <img class="img-thumbnail mb-1" style="width: 32%" src="{{ asset('/backend/stamdata/license/'.$license->front_image) }}">
                            </a>


                            <!-- Modal -->
                            <div class="modal fade" id="View{{ $license->id }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered d-flex justify-content-center"">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">View Lincense</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                                                <div class="col-md-6">
                                                    <label class="mb-1 text-uppercase-expanded text-xs text-gray-600 fw-200">License Number</label><br>
                                                    <label class="mb-1">{{ $license->number }}</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="mb-1 text-uppercase-expanded text-xs text-gray-600 fw-200">License Categoy</label><br>
                                                    <label class="mb-1">{{ $license->category }}</label>
                                                </div>
                                            </div>

                                            <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                                                <div class="col-md-6">
                                                    <label class="mb-1 text-uppercase-expanded text-xs text-gray-600 fw-200">License Type</label><br>
                                                    <label class="mb-1">{{ $license->type }}</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="mb-1 text-uppercase-expanded text-xs text-gray-600 fw-200">License Expiry</label><br>
                                                    <label class="mb-1">{{ date('d M Y', strtotime($license->expiry)) }}</label>
                                                </div>
                                            </div>

                                            


                                            <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                                                <div class="col-md-6">
                                                    <label class="mb-1 text-uppercase-expanded text-xs text-gray-600 fw-200">Front Image</label><br>
                                                    <img style="width: 100%" src="{{ asset('/backend/stamdata/license/'.$license->front_image) }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="mb-1 text-uppercase-expanded text-xs text-gray-600 fw-200">Back Image</label><br>
                                                    <img style="width: 100%" src="{{ asset('/backend/stamdata/license/'.$license->back_image) }}">
                                                </div>
                                            </div>

                                            


                                           
                                        </div>

                                        <div class="modal-footer bg-light">
                                          <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateLicense{{ $license->id }}"><i data-feather="edit"></i></a>
                                          <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/stamdata/license/delete/'.$license->id) }}"><i data-feather="trash-2"></i></a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>




                            <div class="modal fade" id="UpdateLicense{{ $license->id }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Update Lincense</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/stamdata/license/update/'.$license->id) }}" enctype="multipart/form-data">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Number</label>
                                                        <input class="form-control" type="text" name="number" value="{{ $license->number }}" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Category</label>
                                                        <input class="form-control" type="text" name="category" value="{{ $license->category }}" required />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Type</label>
                                                        <input class="form-control" type="text" name="type" value="{{ $license->type }}" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Expiry</label>
                                                        <input class="form-control" type="date" name="expiry" value="{{ $license->expiry }}" required />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Font Image</label>
                                                        <input class="form-control" type="file" name="front_image" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Back Image</label>
                                                        <input class="form-control" type="file" name="back_image" />
                                                    </div>

                                                  
                                                    
                                                </div>          

                                                          




                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Update License</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                        


                        


                        

                        
                    </div>
                </div> --}}



            </div>
        </div>
    </div>



    



@endsection


