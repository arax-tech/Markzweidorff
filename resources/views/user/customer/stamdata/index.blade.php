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
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
@endsection
@section('content')
    @include('user.customer.header')
    <!-- Main page content-->
    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            @include('user.customer.navbar')
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-lg-8">

                
                <div class="card mb-4">
                    <div class="card-header">
                        Documents {{-- {{ date('d M Y, H:i A',time()) }} --}}
                        <span class="float-end">

                            
                            @if (in_array("All", $permission) OR in_array("UserDocumentCreate", $permission) AND auth::user()->id != $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateDocument"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @elseif (in_array("AuthDocumentCreate", $permission) AND auth::user()->id == $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateDocument"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @endif


                    
                            <!-- Modal -->
                            <div class="modal fade" id="CreateDocument">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Upload dokument</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('customer/document/store/'.$user->id) }}" enctype="multipart/form-data">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Titel</label>
                                                        <input class="form-control" type="text" name="title" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Dokumentfil</label>
                                                        <input class="form-control" type="file" name="document" required />
                                                    </div>

                                                    
                                                </div>          

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Synlighed</label>
                                                        <select class="form-control" name="visibility">
                                                            <option value="Hidden">Skjult</option>
                                                            <option value="Visible">Synlig</option>                  
                                                        </select>
                                                    </div>

                                                    

                                                    
                                                </div>


                                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opret dokument</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>Titel</th>
                                    <th>Status</th>
                                    <th>Dato</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($documents as $key => $document)
                                    <tr>

                                        
                                       
                                        <td class="d-flex align-items-center">
                                            @php
                                                $extension = pathinfo(asset('/backend/documents/user/'.$document->document), PATHINFO_EXTENSION);
                                            @endphp
                                            @if ($extension == "pdf")
                                                <i style="font-size: 20px" class="fa fa-file-pdf"></i>
                                            @elseif ($extension == "jpg" OR $extension == "jpeg" OR $extension == "png" OR $extension == "gif")
                                                <i style="font-size: 20px" class="fa fa-file-image"></i>
                                            @elseif ($extension == "doc" OR $extension == "docs" )
                                                <i style="font-size: 20px" class="fa fa-file-word"></i>

                                             @elseif ($extension == "txt" )
                                                <i style="font-size: 20px" class="fa fa-file-lines"></i>
                                            @endif
                                            &nbsp;&nbsp;

                                            <a href="javascript::" data-bs-toggle="modal" data-bs-target="#ViewDocument{{ $document->id }}">{{ $document->title }}</a>
                                        </td>
                                        

                                        <td>
                                            @if ($document->status == "Read")
                                                 <span class="badge bg-teal text-white" data-toggle="tooltip" data-placement="bottom" title="{{ $document->read_at }}">Læst</span>
                                            @else
                                                 <span class="badge bg-pink text-white">Ulæst</span>
                                            @endif
                                        </td>
                                        
                                        
                                        <td>
                                            {{ $document->created_at->format('d M Y H:i') }}
                                        </td>

                                        <td>

                                            @if (in_array("All", $permission) OR in_array("UserDocumentUpdate", $permission) AND auth::user()->id != $user->id)
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateDocument{{ $document->id }}"><i data-feather="edit"></i></a>
                                            @elseif (in_array("AuthDocumentUpdate", $permission) AND auth::user()->id == $user->id)
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateDocument{{ $document->id }}"><i data-feather="edit"></i></a>
                                            @endif


                                            @if ($document->visibility == "Visible")
                                                 <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="#" data-toggle="tooltip" data-placement="bottom" title="Synlig"><i data-feather="eye"></i></a>
                                            @else
                                                 <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="#" data-toggle="tooltip" data-placement="bottom" title="Skjult"><i data-feather="eye-off"></i></a>
                                            @endif
                                            

                                        @php
                                            error_reporting(0);
                                            $admin = DB::table('users')->where('id', $document->admin_id)->first();
                                        @endphp
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/user/profile/'.$document->admin_id) }}" data-toggle="tooltip" data-placement="bottom" alt="{{ $admin->name }}" title="{{ $admin->name }}"><i data-feather="user"></i></a>
                                          
                                            

                                            @if (in_array("All", $permission) OR in_array("UserDocumentDelete", $permission) AND auth::user()->id != $user->id)
                                                <a onclick="return confirm('Er du sikker på at du vil slette dette dokument ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/customer/document/delete/'.$document->id) }}"><i data-feather="trash-2"></i></a>
                                            @elseif (in_array("AuthDocumentDelete", $permission) AND auth::user()->id == $user->id)
                                                <a onclick="return confirm('Er du sikker på at du vil slette dette dokument ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/customer/document/delete/'.$document->id) }}"><i data-feather="trash-2"></i></a>
                                            @endif
                                            
                                            
                                            
                                        </td>


                                    </tr>



                                    <div class="modal fade" id="UpdateDocument{{ $document->id }}">
                                        <div class="modal-dialog modal-lg  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title">Opdater Dokument</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('customer/document/update/'.$document->id) }}" enctype="multipart/form-data">
                                                        @csrf


                                                      <div class="row gx-3 mb-3">
                                                            <div class="col-md-6">
                                                                <label class="small mb-1">Titel</label>
                                                                <input class="form-control" type="text" name="title" value="{{ $document->title }}" required />
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="small mb-1">Dokumentfil</label>
                                                                <input class="form-control" type="file" name="document" />
                                                            </div>

                                                            
                                                        </div>          

                                                        <div class="row gx-3 mb-3">
                                                            <div class="col-md-12">
                                                                <label class="small mb-1">Synlighed</label>
                                                                <select class="form-control" name="visibility">
                                                                    <option value="Hidden"
                                                                    @if ($document->visibility == "Hidden")
                                                                        selected 
                                                                    @endif
                                                                    >Skjult</option>
                                                                    <option value="Visible"
                                                                    @if ($document->visibility == "Visible")
                                                                        selected 
                                                                    @endif
                                                                    >Synlig</option>                  
                                                                </select>
                                                            </div>

                                                           

                                                            
                                                        </div>


                                                        <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater dokument</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="ViewDocument{{ $document->id }}">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title">{{ $document->title }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe src="{{ asset('/backend/documents/user/'.$document->document) }}" style="width: 100%; min-height: 550px;"></iframe>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                




                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>







                <div class="card mb-4">
                    <div class="card-header">
                        Notes {{-- {{ date('d M Y, H:i A',time()) }} --}}
                        <span class="float-end">


                            @if (in_array("All", $permission) OR in_array("UserNoteCreate", $permission) AND auth::user()->id != $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateNote"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @elseif (in_array("AuthNoteCreate", $permission) AND auth::user()->id == $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateNote"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @endif



                            <!-- Modal -->
                            <div class="modal fade" id="CreateNote">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('customer/note/store/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Titel</label>
                                                        <input class="form-control" type="text" name="title" required />
                                                    </div>
                                                </div>          

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Notering</label>
                                                        <textarea name="content" required></textarea>
                                                    </div>
                                                </div>
                                               
                                            
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-sm" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                            <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opret</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach ($notes as $key => $note)
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        @php
                                            error_reporting(0);
                                            $admin = DB::table('users')->where('id', $note->admin_id)->first();
                                        @endphp

                                        
                                        <div class="timeline-item-marker-text">
                                            {{ $admin->name  }} <br>
                                            <span style="font-size: 10px !important">{{ $note->created_at->format('d M Y H:i') }}</span>
                                        </div>
                                        <div class="timeline-item-marker-indicator bg-primary-soft text-primary">
                                            @if (!empty($admin->image))
                                                <img style="width: 50px; height: 50px" class="img-account-profile rounded-circle mb-2" src="{{ asset('backend/profile/'.$admin->image) }}" />
                                            @else
                                                <img style="width: 50px; height: 50px" class="img-account-profile rounded-circle mb-2" src="{{ asset('backend/placeholder.jpg') }}" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="timeline-item-content pt-0">
                                        <div class="card shadow-sm">
                                            <div class="card-header">
                                                {{ $note->title }}
                                                
                                                  <span class="float-end">  
                                                     @if (in_array("All", $permission) OR in_array("UserNoteUpdate", $permission) AND auth::user()->id != $user->id)
                                                       <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/customer/note/edit/'.$user->id.'/'.$note->id) }}" ><i data-feather="edit"></i></a>
                                                    @elseif (in_array("AuthNoteUpdate", $permission) AND auth::user()->id == $user->id)
                                                       <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/customer/note/edit/'.$user->id.'/'.$note->id) }}" ><i data-feather="edit"></i></a>
                                                    @endif

                                                    @if (in_array("All", $permission) OR in_array("UserNoteDelete", $permission) AND auth::user()->id != $user->id)
                                                       <a onclick="return confirm('Er du sikker på at du vil slette denne note ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/customer/note/delete/'.$note->id) }}"><i data-feather="trash-2"></i></a>
                                                    @elseif (in_array("AuthNoteDelete", $permission) AND auth::user()->id == $user->id)
                                                        <a onclick="return confirm('Er du sikker på at du vil slette denne note ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/customer/note/delete/'.$note->id) }}"><i data-feather="trash-2"></i></a>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="card-body">                                        
                                                {!! $note->content !!}
                                            </div>


                                          
                                        </div>
                                    </div>
                                </div>

                                


                            @endforeach
                            
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
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Update Employment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('customer/stamdata/employment/update/'.$user->id) }}">
                                                @csrf


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

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Type</label>
                                                        <input class="form-control" type="text" name="type" value="{{ $user->type }}" />
                                                    </div>

                                                  
                                                    
                                                </div>          

                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100  mt-1" type="submit">Update</button>
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
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opdater Bank</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="{{ url('customer/stamdata/bank/store/'.$user->id) }}">
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
                                            <form method="post" enctype="multipart/form-data" action="{{ url('customer/stamdata/associated/store/'.$user->id) }}">
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
                                                <a onclick="return confirm('Er du sikker på at du vil slette ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/customer/stamdata/associated/delete/'.$associated->id) }}"><i data-feather="trash-2"></i></a>
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
                                                        <form method="post" enctype="multipart/form-data" action="{{ url('customer/stamdata/associated/update/'.$associated->id) }}">
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

@section('js')
    
    <script>
            CKEDITOR.replace( 'content' );
    </script>

@endsection