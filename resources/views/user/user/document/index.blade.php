@extends('user.layouts.app')

@php
    $title = $user->name.' › Dokumenter';
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp
@section('title', $title)
@section('css')
    <style>
    .small { color: #31353d !important; }
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
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Oversigt {{-- {{ date('d M Y, H:i A',time()) }} --}}
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
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Upload dokument</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/document/store/'.$user->id) }}" enctype="multipart/form-data">
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
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="/user/profile/{{ $document->admin_id }}" data-toggle="tooltip" data-placement="bottom" alt="{{ $admin->name }}" title="{{ $admin->name }}"><i data-feather="user"></i></a>
                                          
                                            

                                            @if (in_array("All", $permission) OR in_array("UserDocumentDelete", $permission) AND auth::user()->id != $user->id)
                                                <a onclick="return confirm('Er du sikker på at du vil slette dette dokument ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/document/delete/'.$document->id) }}"><i data-feather="trash-2"></i></a>
                                            @elseif (in_array("AuthDocumentDelete", $permission) AND auth::user()->id == $user->id)
                                                <a onclick="return confirm('Er du sikker på at du vil slette dette dokument ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/document/delete/'.$document->id) }}"><i data-feather="trash-2"></i></a>
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
                                                    <form method="post" action="{{ url('user/document/update/'.$document->id) }}" enctype="multipart/form-data">
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
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#group").chosen({});
        $(".group").chosen({});
        
    });
</script>

@endsection

