@extends('user.layouts.app')

@php
    error_reporting(0);

    $array = auth::user()->permissions;
    $permission = explode(",", $array);

    // dd($permission);

    $title = $user->name.' › Udstyr';
@endphp
@section('title', $title)
@section('css')
    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
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
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">
                        Oversigt
                        <span class="float-end">


                            @if (in_array("All", $permission) OR in_array("UserEquipmentCreate", $permission) AND auth::user()->id != $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateEquipment"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @elseif (in_array("AuthEquipmentCreate", $permission) AND auth::user()->id == $user->id)
                                <span class="float-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateEquipment"><i class="me-1" data-feather="plus"></i> &nbsp;Opret</button>
                                </span>
                            @endif
                            

                            <!-- Modal -->
                            <div class="modal fade" id="CreateEquipment">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">Opret udstyr</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ url('user/equipment/store/'.$user->id) }}">
                                                @csrf


                                              <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Udstyr</label>
                                                        <input class="form-control" type="text" name="name" required />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="small mb-1">Note</label>
                                                        <input class="form-control" type="text" name="note" required />
                                                    </div>

                                                    
                                                </div>          

                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-12">
                                                        <label class="small mb-1">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="Provided">Udleveret</option>
                                                            <option value="Returned">Returneret</option>                  
                                                        </select>
                                                    </div>

                                                    
                                                </div>


                                                                                     




                                                <!-- Save changes button-->
                                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opret udstyr</button>
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
                                    <th width="35%">Udstyr</th>
                                    <th width="35%">Note</th>
                                    <th>Status</th>
                                    <th>Dato</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($equipments as $key => $equipment)
                                    <tr>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->note }}</td>
                                        <td>
                                            @if ($equipment->status == "Provided")
                                                 <span class="badge bg-blue text-white">Udleveret</span>
                                            @else
                                                 <span class="badge bg-teal text-white">Returneret</span>
                                            @endif
                                        </td>
                                        <td>{{ $equipment->created_at->format('d M Y H:i') }}</td>

                                        <td>
                                            @if (in_array("All", $permission) OR in_array("UserEquipmentUpdate", $permission) AND auth::user()->id != $user->id)
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateEquipment{{ $equipment->id }}"><i data-feather="edit"></i></a>
                                            @elseif (in_array("AuthEquipmentUpdate", $permission) AND auth::user()->id == $user->id)
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateEquipment{{ $equipment->id }}"><i data-feather="edit"></i></a>
                                            @endif


                                            @php
                                                error_reporting(0);
                                                $admin = DB::table('users')->where('id', $equipment->admin_id)->first();
                                            @endphp
                                            <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="/user/profile/{{ $equipment->admin_id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $admin->name }}"><i data-feather="user"></i></a>


                                            @if (in_array("All", $permission) OR in_array("UserEquipmentDelete", $permission) AND auth::user()->id != $user->id)
                                                <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/equipment/delete/'.$equipment->id) }}"><i data-feather="trash-2"></i></a>
                                            @elseif (in_array("AuthEquipmentDelete", $permission) AND auth::user()->id == $user->id)
                                                <a onclick="return confirm('Are you sure to delete ?')" class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/user/equipment/delete/'.$equipment->id) }}"><i data-feather="trash-2"></i></a>
                                            @endif
                                            
                                            
                                        </td>


                                    </tr>




                                    <!-- Modal -->
                                    <div class="modal fade" id="UpdateEquipment{{ $equipment->id }}">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title">Opdater udstyr</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ url('user/equipment/update/'.$equipment->id) }}">
                                                        @csrf


                                                      <div class="row gx-3 mb-3">
                                                            <div class="col-md-6">
                                                                <label class="small mb-1">Udstyr</label>
                                                                <input class="form-control" type="text" name="name" value="{{ $equipment->name }}" required />
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="small mb-1">Note</label>
                                                                <input class="form-control" type="text" name="note" value="{{ $equipment->note }}" required />
                                                            </div>

                                                            
                                                        </div>          

                                                        <div class="row gx-3 mb-3">
                                                            <div class="col-md-12">
                                                                <label class="small mb-1">Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="Provided"
                                                                    @if ($equipment->status == "Provided")
                                                                        selected 
                                                                    @endif
                                                                    >Udleveret</option>
                                                                    <option value="Returned"
                                                                    @if ($equipment->status == "Returned")
                                                                        selected 
                                                                    @endif
                                                                    >Returneret</option>                  
                                                                </select>
                                                            </div>

                                                            
                                                        </div>


                                                                                             




                                                        <!-- Save changes button-->
                                                        <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater udstyr</button>
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
        </div>
    </div>

@endsection

