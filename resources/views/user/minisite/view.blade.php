@extends('user.layouts.app')
@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp
@php
    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp

@section('title', $minisite->name)
@section('css')
    <style>




        .widget-subheading{
            color: #858a8e;
            font-size: 10px;
        }
        

        .scroll-area-sm {
            height: 400px;
            overflow-x: hidden;
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: 0.75rem 1.25rem;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .list-group-item:hover {
            background: #f2f2f2 !important;
            cursor: pointer;
            transition: 0.5s ease;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
        }

        .todo-indicator {
            position: absolute;
            width: 4px;
            height: 60%;
            border-radius: 0.3rem;
            left: 0.625rem;
            top: 20%;
            opacity: .6;
            transition: opacity .2s;
        }

        .bg-warning {
            background-color: #f7b924 !important;
        }

        .widget-content {
            padding: 1rem;
            flex-direction: row;
            align-items: center;
        }

        .widget-content .widget-content-wrapper {
            display: flex;
            flex: 1;
            position: relative;
            align-items: center;
        }

        .widget-content .widget-content-right.widget-content-actions {
            visibility: hidden;
            opacity: 0;
            transition: opacity .2s;
        }

        .widget-content .widget-content-right {
            margin-left: auto;
        }

       
        .small{
            color: #31353d !important;
        }











        .chat-message {
          padding-right: 20px;
        }

        .chat {
            list-style: none;
            margin: 0;
        }

        .chat-message{
            /*background: #f9f9f9;  */
        }

        .chat li img {
          width: 45px;
          height: 45px;
          border-radius: 50em;
          -moz-border-radius: 50em;
          -webkit-border-radius: 50em;
        }

        img {
          max-width: 100%;
        }

        .chat-body {
          padding-bottom: 20px;
        }

        .chat li.left .chat-body {
          margin-left: 70px;
          background-color: #f8f8f9;
        }
        .chat li.right .chat-body {
          background-color: #31353d;
        }

        .chat li .chat-body {
          position: relative;
          font-size: 11px;
          padding: 10px;
          border: 1px solid #f1f5fc;
          box-shadow: 0 5px 5px rgba(0,0,0,.05);
          -moz-box-shadow: 0 5px 5px rgba(0,0,0,.05);
          -webkit-box-shadow: 0 5px 5px rgba(0,0,0,.05);
        }

        .chat li .chat-body .header {
          padding-bottom: 5px;
          border-bottom: 1px solid #f1f5fc;
        }

        .chat li .chat-body p {
          margin: 0;
        }

        .chat li.left .chat-body:before {
          position: absolute;
          top: 10px;
          left: -8px;
          display: inline-block;
          background: #f8f8f9;
          width: 16px;
          height: 16px;
          border-top: 1px solid #f1f5fc;
          border-left: 1px solid #f1f5fc;
          content: '';
          transform: rotate(-45deg);
          -webkit-transform: rotate(-45deg);
          -moz-transform: rotate(-45deg);
          -ms-transform: rotate(-45deg);
          -o-transform: rotate(-45deg);
        }

        .chat li.right .chat-body:before {
          position: absolute;
          top: 10px;
          right: -8px;
          display: inline-block;
          background: #f0f0ff;
          width: 16px;
          height: 16px;
          border-top: 1px solid #f0f0ff;
          border-right: 1px solid #f0f0ff;
          content: '';
          transform: rotate(45deg);
          -webkit-transform: rotate(45deg);
          -moz-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          -o-transform: rotate(45deg);
        }

        .chat li {
          margin: 15px 0;
        }

        .chat li.right .chat-body {
          margin-right: 70px;
          background-color: #f0f0ff;
        }

        .chat-box {
        /*
          position: fixed;
          bottom: 0;
          left: 444px;
          right: 0;
        */
          padding: 15px;
          border-top: 1px solid #eee;
          transition: all .5s ease;
          -webkit-transition: all .5s ease;
          -moz-transition: all .5s ease;
          -ms-transition: all .5s ease;
          -o-transition: all .5s ease;
        }

        .bg-primary1{
          background: blue !important
        }

        
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
@endsection


@section('content')
    
    <!-- Main page content-->
    @include('user.minisite.include.header')


    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        @include('user.minisite.include.tabs')
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card-hover-shadow-2x mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-tasks"></i>&nbsp;Task Lists
                                        </div>
                                        <button class="btn btn-primary btn-sm float-right" href="javascript::" data-bs-toggle="modal" data-bs-target="#CreateToDo"><i class="me-1" data-feather="folder-plus"></i> &nbsp;Create</button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="CreateToDo">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="plus"></i> Create</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('/minisite/todo/store') }}">
                                                        @csrf
                                                        <input type="hidden" name="minisite_id" value="{{ $minisite->id }}">
                                                        <div class="row gx-3 mb-3">
                                                             <div class="col-md-12">
                                                                <label class="small mb-1">Task</label>
                                                                <input class="form-control" type="text" name="task" required />
                                                            </div>
                                                        </div>
                                                        <div class="row gx-3 mb-3">

                                                             <div class="col-md-12">
                                                                <label class="small mb-1">Priority</label>
                                                                <select class="form-control" name="priority">
                                                                    <option value="Yellow">Yellow</option>
                                                                    <option value="Blue">Blue</option>
                                                                    <option value="Red" selected>Red</option>
                                                                </select>
                                                            </div>

                                                           
                                                        </div>
                                                </div>
                                                 <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i> Opret</button>
                                            </div></form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="scroll-area-sm">
                                <perfect-scrollbar class="ps-show-limits">
                                    <div style="position: static;" class="ps ps--active-y">
                                        <div class="ps-content">
                                            <ul class=" list-group list-group-flush">
                                                @foreach ($todos as $todo)
                                                    <li class="list-group-item">
                                                        <div class="todo-indicator @if ($todo->priority == "Red") bg-danger @elseif ($todo->priority == "Blue")  bg-primary1 @elseif ($todo->priority == "Yellow")  bg-warning @elseif ($todo->priority == "Green")  bg-success  @endif"></div>
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">@if ($todo->priority == "Green") <del>{{ $todo->task }}</del> @else {{ $todo->task }}@endif
                                                                    </div>
                                                                    @php
                                                                        error_reporting(0);
                                                                        $toDoUser = DB::table('users')->where('id', $todo->user_id)->first();
                                                                    @endphp
                                                                    <div class="widget-subheading"><i>By {{ $toDoUser->name }}</i><small class="text-muted">  <i class="fa fa-clock-o"></i> {{ $todo->created_at->diffForHumans() }}</small></div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    @if (auth::user()->id == $todo->user_id)
                                                                        {{-- <a class="btn btn-datatable btn-icon btn-dark-dark" href="{{ url('/minisite/todo/done/'.$todo->id) }}"><i data-feather="check-square"></i></a>
                                                                        <a class="btn btn-datatable btn-icon btn-dark-dark me-2" href="javascript::" data-bs-toggle="modal" data-bs-target="#UpdateToDo{{ $todo->id }}"><i data-feather="edit"></i></a>
                                                                    

                                                                        <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-dark-dark" href="{{ url('/minisite/todo/delete/'.$todo->id) }}"><i data-feather="trash-2"></i></a> --}}

                                                                        <div class="dropdown">
                                                                          <button class="btn  btn-light rounded-circle " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fa fa-ellipsis-v" ></i>
                                                                          </button>
                                                                          <ul class="dropdown-menu">
                                                                            <li>
                                                                              <a class="dropdown-item" href="{{ url('/minisite/todo/done/'.$todo->id) }}"><i data-feather="check-square"></i> &nbsp;Complete</a>


                                                                              <a class="dropdown-item" href="javascript::" data-bs-toggle="modal" data-bs-target="#UpdateToDo{{ $todo->id }}"><i data-feather="edit"></i>&nbsp;Update</a>
                                                                              

                                                                              <a onclick="return confirm('Are you sure to delete ?')" class="dropdown-item" href="{{ url('/minisite/todo/delete/'.$todo->id) }}"><i data-feather="trash-2"></i>&nbsp; Delete</a>

                                                                          </ul>
                                                                        </div>
                                                                    @else
                                                                      <form method="post" action="{{ url('/minisite/todo/update/'.$todo->id) }}">
                                                                        @csrf
                                                                        <input type="hidden" name="task" value="{{ $todo->task }}" />
                                                                        <input type="hidden" name="priority" @if ($todo->priority == "Green") value="Blue" @else value="Green"@endif >
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input"  onchange="this.form.submit()" id="Check" type="checkbox" @if ($todo->priority == "Green") checked @endif>
                                                                            <label class="form-check-label" for="Check"></label>
                                                                        </div>  
                                                                      </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="UpdateToDo{{ $todo->id }}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="edit"></i> Update</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{ url('/minisite/todo/update/'.$todo->id) }}">
                                                                        @csrf
                                                                        <div class="row gx-3 mb-3">
                                                                             <div class="col-md-12">
                                                                                <label class="small mb-1">Task</label>
                                                                                <input class="form-control" type="text" name="task" value="{{ $todo->task }}" required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row gx-3 mb-3">

                                                                             <div class="col-md-12">
                                                                                <label class="small mb-1">Priority</label>
                                                                                <select class="form-control" name="priority">
                                                                                    <option value="Red"
                                                                                    @if ($todo->priority == "Red")
                                                                                        selected 
                                                                                    @endif
                                                                                    >Red</option>
                                                                                    <option value="Yellow"
                                                                                    @if ($todo->priority == "Yellow")
                                                                                        selected 
                                                                                    @endif
                                                                                    >Yellow</option>
                                                                                    <option value="Blue"
                                                                                    @if ($todo->priority == "Blue")
                                                                                        selected 
                                                                                    @endif
                                                                                    >Blue</option>
                                                                                </select>
                                                                            </div>

                                                                           
                                                                        </div>
                                                                </div>
                                                                 <div class="card-footer">
                                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i> Update</button>
                                                            </div></form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </perfect-scrollbar>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12 mb-4">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card-hover-shadow-2x mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="message-square"></i>&nbsp;Chats
                                        </div>
                                        <button class="btn btn-primary btn-sm float-right" href="javascript::" data-bs-toggle="modal" data-bs-target="#CreateChat"><i class="me-1" data-feather="send"></i> &nbsp;Send</button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="CreateChat">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title d-flex align-items-center justify-content-center"><i class="me-1" data-feather="message-square"></i> Chating</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('/minisite/chat/store') }}">
                                                      @csrf

                                                      <input type="hidden" name="minisite_id" value="{{ $minisite->id }}">
                                                        <div class="row gx-3 mb-3">
                                                             <div class="col-md-12">
                                                                <label class="small mb-1">Message</label>
                                                                <input class="form-control" type="text"  name="message" placeholder="Type your message here" required />
                                                            </div>
                                                        </div>
                                                        
                                                           
                                                </div>
                                                 <div class="card-footer">
                                                <button class="btn btn-sm" type="button" style="background-color: #8A8A8A; color: #fff;" data-bs-dismiss="modal" aria-label="Close">Annuller</button> 
                                                <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="send"></i> Send</button>
                                            </div></form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                
                            </div>
                            <div class="scroll-area-sm">
                                <perfect-scrollbar class="ps-show-limits">
                                    <div style="position: static;" class="ps ps--active-y">
                                        <div class="ps-content">
                                            <div class="bootstrap snippets">
                                                <div class="chat-message">
                                                    <ul class="chat">
                                                        
                                                        @foreach ($chats as $chat)
                                                        @php
                                                            error_reporting(0);
                                                            $user00 = DB::table('users')->where('id', $chat->user_id)->first();
                                                        @endphp
                                                            <li class="@if (auth::user()->id == $chat->user_id) right @else left @endif clearfix">
                                                                <span class="chat-img @if (auth::user()->id == $chat->user_id) pull-right @else pull-left @endif">
                                                                    {{-- <img src="https://bootdey.com/img/Content/user_3.jpg" alt="User Avatar"> --}}

                                                                    @if (!empty($user00->image))
                                                                        <img class="img-fluid" src="{{ asset('backend/profile/'.$user00->image) }}" />
                                                                    @else
                                                                        <img class="img-fluid" src="{{ asset('backend/placeholder.jpg') }}" />
                                                                    @endif


                                                                </span>
                                                                <div class="chat-body clearfix">
                                                                    <div class="header">
                                                                        <strong class="primary-font d-flex align-items-center justify-content-between">
                                                                            @if (auth::user()->id == $chat->user_id)
                                                                              <small class="pull-right text-muted">  <i class="fa fa-clock-o"></i> {{ $chat->created_at->diffForHumans() }}</small>
                                                                              <div>
                                                                                {{ $user00->name }} 
                                                                                @if (auth::user()->id == $chat->user_id)
                                                                                    <a class="justify-content-center" onclick="return confirm('Are you sure to delete ?')" href="{{ url('/minisite/chat/delete/'.$chat->id) }}"><i  data-feather="trash-2"></i></a>
                                                                                @endif
                                                                              </div>
                                                                            @else
                                                                              <div>
                                                                                {{ $user00->name }} 
                                                                                @if (auth::user()->id == $chat->user_id)
                                                                                    <a class="justify-content-center" onclick="return confirm('Are you sure to delete ?')" href="{{ url('/minisite/chat/delete/'.$chat->id) }}"><i  data-feather="trash-2"></i></a>
                                                                                @endif
                                                                              </div>
                                                                              <small class="pull-right text-muted">  <i class="fa fa-clock-o"></i> {{ $chat->created_at->diffForHumans() }}</small>
                                                                            @endif
                                                                            
                                                                        </strong>
                                                                        
                                                                    </div>
                                                                    <p class="@if (auth::user()->id == $chat->user_id) pull-right @else pull-left @endif">{{ $chat->message }}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach           
                                                    </ul>
                                                </div>
                                                       
                                            </div>
                                        </div>
                                        
                                    </div>
                                </perfect-scrollbar>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection


