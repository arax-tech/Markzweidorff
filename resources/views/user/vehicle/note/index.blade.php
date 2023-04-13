@extends('user.layouts.app')

@php
    $title = $user->name.' › Noter';
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp
@section('title', $title)
@section('css')
    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
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
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Oversigt {{-- {{ date('d M Y, H:i A',time()) }} --}}
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
                                            <form method="post" action="{{ url('vehicle/note/store/'.$user->id) }}">
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
                                                       <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/vehicle/note/edit/'.$user->id.'/'.$note->id) }}" ><i data-feather="edit"></i></a>
                                                    @elseif (in_array("AuthNoteUpdate", $permission) AND auth::user()->id == $user->id)
                                                       <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="{{ url('/vehicle/note/edit/'.$user->id.'/'.$note->id) }}" ><i data-feather="edit"></i></a>
                                                    @endif

                                                    @if (in_array("All", $permission) OR in_array("UserNoteDelete", $permission) AND auth::user()->id != $user->id)
                                                       <a onclick="return confirm('Er du sikker på at du vil slette denne note ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/vehicle/note/delete/'.$note->id) }}"><i data-feather="trash-2"></i></a>
                                                    @elseif (in_array("AuthNoteDelete", $permission) AND auth::user()->id == $user->id)
                                                        <a onclick="return confirm('Er du sikker på at du vil slette denne note ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/vehicle/note/delete/'.$note->id) }}"><i data-feather="trash-2"></i></a>
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
        </div>
    </div>

@endsection



@section('js')
    
    <script>
            CKEDITOR.replace( 'content' );
    </script>

@endsection