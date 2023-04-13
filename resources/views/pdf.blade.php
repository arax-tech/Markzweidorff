@extends('user.layouts.app')

@php
  error_reporting(0);
    
@endphp
@section('title', 'PDF')
@section('content')

  <div class="container py-2">
    <div class="row">
      <div class="col-lg-12 mx-auto">
        <div class="card border p-4 rounded bg-white">
          <div class="card-body">
            <h3 class="card-title mb-3">PDF to PNG converter</h3>
       
            <form action="{{ url('/pdf') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="mb-3">
                <label for="formFile" class="form-label">Browse your file</label>
                <input class="form-control" type="file" id="formFile" name="formFile" required>
              </div>
              <button class="btn btn-primary" name="submit">Convert Now</button>
            </form>
            <img src="{{ $output }}" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection