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
    @include('user.customer.header')
    <!-- Main page content-->
    <div class="container-fluid px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            @include('user.customer.navbar')
        </nav>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Opdater Note </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/customer/note/update/'.$user->id.'/'.$note->id) }}" enctype="multipart/form-data">
                            @csrf

                          <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1">Titel</label>
                                    <input class="form-control" type="text" name="title" value="{{ $note->title }}" required />
                                </div>
                            </div>          

                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1">Notering</label>
                                    <textarea name="content" required>{{ $note->content }}</textarea>
                                </div>
                            </div>
                    </div>
                     <div class="card-footer">
                        <a class="btn btn-sm" style="background-color: #8A8A8A; color: #fff;" href="{{ url('/customer/note/'.$user->id.'/') }}">Annuller</a> 
                        <button class="btn btn-primary btn-sm float-end" type="submit"><i class="me-1" data-feather="save"></i>&nbsp; Opdater</button>
                    </div>
                    </form>
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