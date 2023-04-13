@extends('user.layouts.app')

@section('title', 'Skift adgangskode')
@section('css')
    <style>

    </style>
@endsection

@section('content')
  


    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="lock"></i></div>
                            {{ auth::user()->role . ' rettighed' }}
                        </h1>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">


        <div class="row">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Skift adgangskode</div>
                    <div class="card-body">
                        <form method="post" action="{{ url('/update_password') }}">
                            @csrf


                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1">Nuværende adgangskode</label>
                                    <input class="form-control" type="text" name="current_password" id="current_password" required value="{{old('current_password')}}" />
                                </div>
                                <span id="change"></span>

                            </div>

                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Ny adgangskode</label>
                                    <input class="form-control" type="text" name="new_password" required  value="{{old('new_password')}}" />
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1">Bekræft ny adgangskode</label>
                                    <input class="form-control" type="text" name="confirm_password" required  value="{{old('confirm_password')}}"/>
                                </div>

                               
                            </div>

                            
                           

                            <!-- Save changes button-->
                            <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script type="text/javascript">
        $("#current_password").on('change', function() {
            var current_password = $(this).val();
            // alert(current_password);
            var url = "{{ url('/check-pwd') }}";
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    current_password: current_password
                },
                success: function(resp) {
                    $("#change").html(resp);
                },
                error: function(resp) {
                    alert("Opps Try Agian...");
                }
            });
        });
    </script>
@endsection
