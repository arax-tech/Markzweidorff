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
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
@endsection
@section('content')
    @include('user.vehicle.header')
    <!-- Main page content-->
    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            @include('user.vehicle.navbar')
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-lg-8">

                
                <div class="card mb-4">
                    <div class="card-header">
                        Assignment

                        <span class="float-end">


                            @if (in_array("All", $permission) OR in_array("UserStamDataCreate", $permission) AND auth::user()->id != $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateAssignment"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @elseif (in_array("AuthStamDataCreate", $permission) AND auth::user()->id == $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateAssignment"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @endif
                            

                            <!-- Modal -->
                            <div class="modal fade" id="CreateAssignment">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret Assignment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('vehicle/stamdata/assignment/store/'.$user->id) }}" method="POST">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Name</label>
                                                        <input class="form-control" type="text" name="name" required />
                                                    </div>

                                                   

                                                    
                                                </div>   

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Co Line</label>
                                                        <input class="form-control" type="text" name="co_line" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Street Navn</label>
                                                        <input class="form-control" type="text" name="street_navn" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Street No</label>
                                                        <input class="form-control" type="text" name="street_no" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Street Level</label>
                                                        <input class="form-control" type="text" name="street_level" />
                                                    </div>

                                                     <div class="col-md-4">
                                                        <label class="small mb-1">Po Code</label>
                                                        <input class="form-control" type="text" name="po_code" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">City Name</label>
                                                        <input class="form-control" type="text" name="city_name" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Country</label>
                                                        <input class="form-control" type="text" name="country" value="Denmark" required />
                                                    </div>
                                                </div>


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">information</label>
                                                        <textarea rows="4" class="form-control" name="information"></textarea>
                                                    </div>

                                                   

                                                    
                                                </div> 


                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option selected disabled value="">Choose...</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Disabled">Disabled</option>
                                                        </select>
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
                                <tr>
                                    <td>Name</td>
                                    <td>Address</td>
                                    <td>information</td>
                                    <td></td>
                                </tr>
                        
                                    @foreach ($assignments as $key => $assignment)
                                        <tr>
                                            

                                            <td>{{ $assignment->name }}</td>
                                            <td>
                                                {{ $assignment->co_line }} {{ $assignment->street_navn }} {{ $assignment->street_no }} {{ $assignment->street_level }} <br>
                                                {{ $assignment->po_code }} {{ $assignment->city_name }} <br>
                                                {{ $assignment->country }}
                                            </td>
                                            <td>{!! $assignment->information !!}</td>
                                         
                                            

                                            <td align="right" class="btn-group">
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateAssignment{{ $assignment->id }}"><i data-feather="edit"></i></a>
                                                <a onclick="return confirm('are you sure to delete Assignment ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/vehicle/stamdata/assignment/delete/'.$assignment->id) }}"><i data-feather="trash-2"></i></a>
                                            </td>


                                        </tr>




                                        <!-- Modal -->
                                        <div class="modal fade" id="UpdateAssignment{{ $assignment->id }}">
                                            <div class="modal-dialog  modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Opdater Assignment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('vehicle/stamdata/assignment/update/'.$assignment->id) }}"  method="POST">
                                                            @csrf


                                                          <div class="row gx-3 mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="small mb-1">Name</label>
                                                                    <input class="form-control" type="text" name="name" value="{{ $assignment->name }}" required />
                                                                </div>
                                                                
                                                            </div>    


                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Co Line</label>
                                                                    <input class="form-control" type="text" name="co_line" value="{{ $assignment->co_line }}" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Street Navn</label>
                                                                    <input class="form-control" type="text" name="street_navn" value="{{ $assignment->street_navn }}" required />
                                                                </div>
                                                            </div>


                                                            <div class="row gx-3 mb-3">
                                                                 <div class="col-md-4">
                                                                    <label class="small mb-1">Street No</label>
                                                                    <input class="form-control" type="text" name="street_no" value="{{ $assignment->street_no }}" required />
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="small mb-1">Street Level</label>
                                                                    <input class="form-control" type="text" name="street_level" value="{{ $assignment->street_level }}" />
                                                                </div>

                                                                 <div class="col-md-4">
                                                                    <label class="small mb-1">Po Code</label>
                                                                    <input class="form-control" type="text" name="po_code" value="{{ $assignment->po_code }}" required />
                                                                </div>
                                                            </div>


                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">City Name</label>
                                                                    <input class="form-control" type="text" name="city_name" value="{{ $assignment->city_name }}" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1">Country</label>
                                                                    <input class="form-control" type="text" name="country" value="{{ $assignment->country }}" required />
                                                                </div>
                                                            </div>

                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="small mb-1">information</label>
                                                                    <textarea rows="4" class="form-control" name="information">{!! $assignment->information !!}</textarea>
                                                                </div>




                                                               

                                                                
                                                            </div>    
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-12">
                                                                    <label class="small mb-1">Status</label>
                                                                    <select class="form-control" name="status">
                                                                        <option selected disabled value="">Choose...</option>
                                                                        <option value="Active"
                                                                        @if ($assignment->status == "Active")
                                                                            selected 
                                                                        @endif
                                                                        >Active</option>
                                                                        <option value="Disabled"
                                                                        @if ($assignment->status == "Disabled")
                                                                            selected 
                                                                        @endif
                                                                        >Disabled</option>
                                                                    </select>
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
                            </table>
                        </div>
                    </div>
                </div>



            
            </div>
            <div class="col-lg-4">
      

                <div class="card mb-4">
                    <div class="card-header">
                        Syn

                        <span class="float-end">


                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#UpdateEmployment"><i class="me-1" data-feather="edit"></i> &nbsp;Opdater</button>
                            <!-- Modal -->
                            <div class="modal fade" id="UpdateEmployment">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opdater Syn</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('vehicle/stamdata/employment/update/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Sidste syn </label>
                                                        <input class="form-control" type="date" name="start_date" value="{{ $user->start_date }}" required />
                                                    </div>

                                                    

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Næste syn</label>
                                                        <input class="form-control" type="date" name="end_date" value="{{ $user->end_date }}" />
                                                    </div>

                                                  
                                                    
                                                </div>        

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Syns status</label>
                                                        <input class="form-control" type="text" name="type" value="{{ $user->type }}" />
                                                    </div>

                                                  
                                                    
                                                </div>          

                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100  mt-1" type="submit">Opdater Syn</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>


                    </div>
                    <div class="card-body">

                        <div class="row gx-3 mb-3" style="border-bottom: 1px solid rgba(33, 40, 50, 0.125);">
                            <div class="col-md-12">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Syns status</label><br>
                                <label class="mb-1">{{ $user->type }}</label>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Sidste syn</label><br>
                                <label class="mb-1">{{ $user->start_date ? date('d M Y', strtotime($user->start_date)) : "" }}</label>
                            </div>

                            <div class="col-md-6">
                                <label class="mb-1 text-xs text-gray-600 fw-200">Næste syn</label><br>
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
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opdater Bank</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="{{ url('vehicle/stamdata/bank/store/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Danløn nr.</label>
                                                        <input class="form-control" type="text" name="payrol_number" value="{{ $bank->payrol_number }}" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Bank Navn</label>
                                                        <input class="form-control" type="text" name="bank_name" value="{{ $bank->bank_name }}" required />
                                                    </div>

                                                    
                                                </div>    
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Reg-nr.</label>
                                                        <input class="form-control" type="text" name="rit_number" value="{{ $bank->rit_number }}" required />
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="small mb-1">Konto nr.</label>
                                                        <input class="form-control" type="text" name="account_number" value="{{ $bank->account_number }}"  required />
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label class="small mb-1">IBAN nr. / Swift adresse</label>
                                                        <input class="form-control" type="text" name="swift_number" value="{{ $bank->swift_number }}" required  />
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

                        <div class="row gx-3 mb-3">

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
                                            <form method="post" enctype="multipart/form-data" action="{{ url('vehicle/stamdata/associated/store/'.$user->id) }}">
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
                                                <a onclick="return confirm('Er du sikker på at du vil slette ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/vehicle/stamdata/associated/delete/'.$associated->id) }}"><i data-feather="trash-2"></i></a>
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
                                                        <form method="post" enctype="multipart/form-data" action="{{ url('vehicle/stamdata/associated/update/'.$associated->id) }}">
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







            </div>
        </div>
    </div>



    



@endsection

