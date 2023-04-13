@extends('user.layouts.app')

@php
    $title = $user->name.' › Indstillinger';
    $array0 = auth::user()->permissions;
    $permission0 = explode(",", $array0);
@endphp
@section('title', $title)
@section('css')
    <style>
        label{cursor: pointer;}
        .small { color: #31353d !important; }
        td{vertical-align: middle !important; font-size: 0.8rem !important;}

        th{
             font-size: 0.8rem !important;
             font-weight: 600
        }
    </style>    
    @if (in_array("All", $permission0))
    @elseif (in_array("UserSettingUpdatePermission", $permission0) AND auth::user()->id != $user->id)
    @elseif (in_array("AuthSettingUpdatePermission", $permission0) AND auth::user()->id == $user->id)


    @elseif (in_array("UserSettingView", $permission0) AND auth::user()->id != $user->id)
       <style type="text/css">
           
           input[type="checkbox"] {
             opacity: 0.5;
             pointer-events: none !important;
           }
           input[type="button"] {
             opacity: 0.5;
             pointer-events: none !important;
           }
       </style>

      

    @elseif (in_array("AuthSettingView", $permission0) AND auth::user()->id == $user->id)
        <style type="text/css">
            
            input[type="checkbox"] {
              opacity: 0.5;
              pointer-events: none !important;
            }
            input[type="button"] {
              opacity: 0.5;
              pointer-events: none !important;
            }
        </style>
    @endif
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

                @php
                    $array = $user->permissions;
                    $permission = explode(",", $array);
                @endphp
                <form method="post" action="{{ url('/customer/setting/permission/update/'.$user->id) }}">
                   
                    @csrf
                    
                

 <div class="card mb-4">
                    <div class="card-header">
                        Brugerprofil

                        <span class="float-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="All" value="All" @if (in_array("All", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                <label class="form-check-label" for="All">Alle rettigheder</label>
                            </div>
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-billing-history">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="40%">Funktion</th>
                                        <th>Vis</th>
                                        <th>Opret</th>
                                        <th>Rediger</th>
                                        <th>Slet</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td width="40%" valign="middle">Brugerprofil</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="ViewAuthProfile" value="ViewAuthProfile" @if (in_array("ViewAuthProfile", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="ViewAuthProfile"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="UpdateAuthProfile" value="UpdateAuthProfile" @if (in_array("UpdateAuthProfile", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="UpdateAuthProfile"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">Adgangskode</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="UserUpdatePassword" value="UserUpdatePassword" @if (in_array("UserUpdatePassword", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="UserUpdatePassword"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">Stamdata</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthStamDataView" value="AuthStamDataView" @if (in_array("AuthStamDataView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthStamDataView"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthStamDataCreate" value="AuthStamDataCreate" @if (in_array("AuthStamDataCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthStamDataCreate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthStamDataUpdate" value="AuthStamDataUpdate" @if (in_array("AuthStamDataUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthStamDataUpdate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthStamDataDelete" value="AuthStamDataDelete" @if (in_array("AuthStamDataDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthStamDataDelete"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">Udstyr & Materiel</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthEquipmentView" value="AuthEquipmentView" @if (in_array("AuthEquipmentView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthEquipmentView"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthEquipmentCreate" value="AuthEquipmentCreate" @if (in_array("AuthEquipmentCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthEquipmentCreate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthEquipmentUpdate" value="AuthEquipmentUpdate" @if (in_array("AuthEquipmentUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthEquipmentUpdate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthDocumentDelete" value="AuthDocumentDelete" @if (in_array("AuthDocumentDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthDocumentDelete"></label>
                                            </div>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td valign="middle">Dokumenter</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthDocumentView" value="AuthDocumentView" @if (in_array("AuthDocumentView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthDocumentView"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthDocumentCreate" value="AuthDocumentCreate" @if (in_array("AuthDocumentCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthDocumentCreate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthDocumentUpdate" value="AuthDocumentUpdate" @if (in_array("AuthDocumentUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthDocumentUpdate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthDocumentDelete" value="AuthDocumentDelete" @if (in_array("AuthDocumentDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthDocumentDelete"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">Noteringer</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthNoteView" value="AuthNoteView" @if (in_array("AuthNoteView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthNoteView"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthNoteCreate" value="AuthNoteCreate" @if (in_array("AuthNoteCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthNoteCreate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthNoteUpdate" value="AuthNoteUpdate" @if (in_array("AuthNoteUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthNoteUpdate"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthNoteDelete" value="AuthNoteDelete" @if (in_array("AuthNoteDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthNoteDelete"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">Indstillinger</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthSettingView" value="AuthSettingView" @if (in_array("AuthSettingView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthSettingView"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthSettingUpdateStatus" value="AuthSettingUpdateStatus" @if (in_array("AuthSettingUpdateStatus", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthSettingUpdateStatus"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td valign="middle">Indstillinger › Rettigheder</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthSettingUpdatePermission" value="AuthSettingUpdatePermission" @if (in_array("AuthSettingUpdatePermission", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthSettingUpdatePermission"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" id="AuthSettingDeleteAccount" value="AuthSettingDeleteAccount" @if (in_array("AuthSettingDeleteAccount", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                <label class="form-check-label" for="AuthSettingDeleteAccount"></label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




 <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header"> 
                         <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="personale-tab" data-bs-toggle="tab" data-bs-target="#personale" type="button" role="tab" aria-controls="personale" aria-selected="true">Personale</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pri-dok-tab" data-bs-toggle="tab" data-bs-target="#pri-dok" type="button" role="tab" aria-controls="pri-dok" aria-selected="false">Pri-Dokumenter</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="sys-adm-tab" data-bs-toggle="tab" data-bs-target="#sys-adm" type="button" role="tab" aria-controls="sys-adm" aria-selected="false">System indstillinger</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content" id="myTabContent">
                           
                            <!-- Personale -->
                            <div class="tab-pane fade show active" id="personale" role="tabpanel" aria-labelledby="personale-tab" tabindex="0">
                                <div class="table-responsive table-billing-history">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Funktion</th>
                                                <th>Vis</th>
                                                <th>Opret</th>
                                                <th>Rediger</th>
                                                <th>Slet</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td width="40%" valign="middle">Administration</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserView" value="UserView" @if (in_array("UserView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserCreate" value="UserCreate" @if (in_array("UserCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserUpdate" value="UserUpdate" @if (in_array("UserUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDelete" value="UserDelete" @if (in_array("UserDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Grupper</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserGroupView" value="UserGroupView" @if (in_array("UserGroupView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserGroupView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserGroupCreate" value="UserGroupCreate" @if (in_array("UserGroupCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserGroupCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserGroupUpdate" value="UserGroupUpdate" @if (in_array("UserGroupUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserGroupUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserGroupDelete" value="UserGroupDelete" @if (in_array("UserGroupDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserGroupDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Profil</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="ViewUserProfile" value="ViewUserProfile" @if (in_array("ViewUserProfile", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="ViewUserProfile"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UpdateUserProfile" value="UpdateUserProfile" @if (in_array("UpdateUserProfile", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UpdateUserProfile"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Stamdata</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserStamDataView" value="UserStamDataView" @if (in_array("UserStamDataView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserStamDataView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserStamDataCreate" value="UserStamDataCreate" @if (in_array("UserStamDataCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserStamDataCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserStamDataUpdate" value="UserStamDataUpdate" @if (in_array("UserStamDataUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserStamDataUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserStamDataDelete" value="UserStamDataDelete" @if (in_array("UserStamDataDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserStamDataDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Udstyr & Materiel</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserEquipmentView" value="UserEquipmentView" @if (in_array("UserEquipmentView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserEquipmentView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserEquipmentCreate" value="UserEquipmentCreate" @if (in_array("UserEquipmentCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserEquipmentCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserEquipmentUpdate" value="UserEquipmentUpdate" @if (in_array("UserEquipmentUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserEquipmentUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserEquipmentDelete" value="UserEquipmentDelete" @if (in_array("UserEquipmentDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserEquipmentDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Dokumenter</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentView" value="UserDocumentView" @if (in_array("UserDocumentView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentCreate" value="UserDocumentCreate" @if (in_array("UserDocumentCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentUpdate" value="UserDocumentUpdate" @if (in_array("UserDocumentUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentDelete" value="UserDocumentDelete" @if (in_array("UserDocumentDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Noteringer</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserNoteView" value="UserNoteView" @if (in_array("UserNoteView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserNoteView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserNoteCreate" value="UserNoteCreate" @if (in_array("UserNoteCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserNoteCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserNoteUpdate" value="UserNoteUpdate" @if (in_array("UserNoteUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserNoteUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserNoteDelete" value="UserNoteDelete" @if (in_array("UserNoteDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserNoteDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Indstillinger</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserSettingView" value="UserSettingView" @if (in_array("UserSettingView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserSettingView"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserSettingUpdateStatus" value="UserSettingUpdateStatus" @if (in_array("UserSettingUpdateStatus", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserSettingUpdateStatus"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserSettingDeleteAccount" value="UserSettingDeleteAccount" @if (in_array("UserSettingDeleteAccount", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserSettingDeleteAccount"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Nulstil adgangskode</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserSettingResetPassword" value="UserSettingResetPassword" @if (in_array("UserSettingResetPassword", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserSettingResetPassword"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Rettigheder</td>
                                                <td>
                                                    
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserSettingUpdatePermission" value="UserSettingUpdatePermission" @if (in_array("UserSettingUpdatePermission", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserSettingUpdatePermission"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- PRI-Dokumenter -->
                            <div class="tab-pane fade" id="pri-dok" role="tabpanel" aria-labelledby="pri-dok-tab" tabindex="1">
                                <div class="table-responsive table-billing-history">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Funktion</th>
                                                <th>Vis</th>
                                                <th>Opret</th>
                                                <th>Rediger</th>
                                                <th>Slet</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td width="40%" valign="middle">Wikipedia</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentGridView" value="UserDocumentGridView" @if (in_array("UserDocumentGridView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentGridView"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Administration</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentListView" value="UserDocumentListView" @if (in_array("UserDocumentListView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentListView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentListCreate" value="UserDocumentListCreate" @if (in_array("UserDocumentListCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentListCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentListUpdate" value="UserDocumentListUpdate" @if (in_array("UserDocumentListUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentListUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserDocumentListDelete" value="UserDocumentListDelete" @if (in_array("UserDocumentListDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserDocumentListDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle">Kategorier</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserManageCategoryView" value="UserManageCategoryView" @if (in_array("UserManageCategoryView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserManageCategoryView"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserManageCategoryCreate" value="UserManageCategoryCreate" @if (in_array("UserManageCategoryCreate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserManageCategoryCreate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserManageCategoryUpdate" value="UserManageCategoryUpdate" @if (in_array("UserManageCategoryUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserManageCategoryUpdate"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="UserManageCategoryDelete" value="UserManageCategoryDelete" @if (in_array("UserManageCategoryDelete", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="UserManageCategoryDelete"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- PRI-Dokumenter -->
                            <div class="tab-pane fade" id="sys-adm" role="tabpanel" aria-labelledby="sys-adm-tab" tabindex="2">
                                <div class="table-responsive table-billing-history">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Funktion</th>
                                                <th>Vis</th>
                                                <th>Opret</th>
                                                <th>Rediger</th>
                                                <th>Slet</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td width="40%" valign="middle">Indstillinger</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="AdminSettingView" value="AdminSettingView" @if (in_array("AdminSettingView", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="AdminSettingView"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" id="AdminSettingUpdate" value="AdminSettingUpdate" @if (in_array("AdminSettingUpdate", $permission)) checked  @endif type="checkbox" name="permission[]" />
                                                        <label class="form-check-label" for="AdminSettingUpdate"></label>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    





                   

             
                                        @php
                                            // dd($permission0);
                                        @endphp
                                        @if (in_array("All", $permission0))
                                            <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater rettigheder</button>
                                        @elseif (in_array("UserSettingUpdatePermission", $permission0) AND auth::user()->id != $user->id)
                                            <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater rettigheder</button>
                                        @elseif (in_array("AuthSettingUpdatePermission", $permission0) AND auth::user()->id == $user->id)
                                            <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater rettigheder</button>
                                        @elseif (in_array("UserSettingView", $permission0) AND auth::user()->id != $user->id)
                                            <button disabled class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater rettigheder</button>
                                        @elseif (in_array("AuthSettingView", $permission0) AND auth::user()->id == $user->id)
                                            <button disabled class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater rettigheder</button>
                                        @endif


                                
                </form>
            </div>
            <div class="col-lg-4">
                <!-- Two factor authentication card-->
                <div class="card mb-4">
                    <div class="card-header">Nulstil adgangskode</div>
                    <div class="card-body">

                        


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                Nulstillingslink er sendt til personalets e-mail: <b>{{ $user->email }}</b>
                            </div>
                        @endif
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <p>Klik på knappen nedenfor for at sende et nulstillingslink til personalets e-mail. Bemærk at linket kun er aktivt i 60 minutter.</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <input type="email" hidden="" name="email" value="{{ $user->email }}">

                            @if (in_array("All", $permission0))
                                <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="key"></i>&nbsp;Nulstil adgangskode</button>
                            @elseif (in_array("UserSettingResetPassword", $permission0) AND auth::user()->id != $user->id)
                                <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="key"></i>&nbsp;Nulstil adgangskode</button>
                            @elseif (in_array("AuthSettingResetPassword", $permission0) AND auth::user()->id == $user->id)
                                <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="key"></i>&nbsp;Nulstil adgangskode</button>
                            @else
                                <button disabled= type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="key"></i>&nbsp;Nulstil adgangskode</button>
                            @endif


                            
                        </form>


                        
                    </div>
                </div>



                <div class="card mb-4">
                    <div class="card-header">Adgang</div>
                    <div class="card-body">

                        


                       

                        <p>Klik på knappen nedenfor for at blokere/åbne personalets adgang.</p>
                        @if ($user->who_update_status != null)
                            @php
                                error_reporting(0);
                                $who_block = DB::table('users')->where('id', $user->who_update_status)->first();
                            @endphp
                            <p>
                                <b>{{ $who_block->name }}</b> {{ $user->status }} denne personale den <b>{{ date('d M Y H:i', strtotime($user->updated_at)) }}</b>
                            </p>

                        @endif
                        <form method="POST" action="{{ url('/user/setting/status/update/'.$user->id) }}">
                            @csrf
                            @if ($user->status == "Active")
                                <input type="text" hidden="" name="status" value="Block">

                                @if (in_array("All", $permission0))
                                    <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-danger-soft text-danger"><i class="me-1" data-feather="lock"></i>&nbsp;Deaktiver personale adgang</button>
                                @elseif (in_array("UserSettingUpdateStatus", $permission0) AND auth::user()->id != $user->id)
                                    <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-danger-soft text-danger"><i class="me-1" data-feather="lock"></i>&nbsp;Deaktiver personale adgang</button>
                                @elseif (in_array("AuthSettingUpdateStatus", $permission0) AND auth::user()->id == $user->id)
                                    <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-danger-soft text-danger"><i class="me-1" data-feather="lock"></i>&nbsp;Deaktiver personale adgang</button>
                                @else
                                    <button disabled type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-danger-soft text-danger"><i class="me-1" data-feather="lock"></i>&nbsp;Deaktiver personale adgang</button>
                                @endif

                                
                            @else 
                                <input type="text" hidden="" name="status" value="Active">
                                
                                @if (in_array("All", $permission0))
                                    <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="unlock"></i>&nbsp;Aktiver personale adgang</button>
                                @elseif (in_array("UserSettingUpdateStatus", $permission0) AND auth::user()->id != $user->id)
                                    <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="unlock"></i>&nbsp;Aktiver personale adgang</button>
                                @elseif (in_array("AuthSettingUpdateStatus", $permission0) AND auth::user()->id == $user->id)
                                    <button type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="unlock"></i>&nbsp;Aktiver personale adgang</button>
                                @else
                                    <button  disabled type="submit"  data-bs-toggle="modal" data-bs-target="#Loading" class="btn btn-success-soft text-success"><i class="me-1" data-feather="unlock"></i>&nbsp;Aktiver personale adgang</button>
                                @endif


                                
                            @endif
                            
                        </form>


                        
                    </div>
                </div>
                <!-- Delete account card-->
                <div class="card mb-4">
                    <div class="card-header">Slet personale </div>
                    <div class="card-body">
                        <p>Sletning af personalets brugerkonto vil være permanent og det er ikke muligt at gendanne slettet persondata.</p>
                        @if (in_array("All", $permission0))
                            <a class="btn btn-danger-soft text-danger Delete" rel="{{ $user->id }}" rel1="user/delete"  href="javascript::"><i class="me-1" data-feather="user-x"></i>&nbsp;Slet personale konto</a>
                        @elseif (in_array("UserSettingDeleteAccount", $permission0) AND auth::user()->id != $user->id)
                            <a class="btn btn-danger-soft text-danger Delete" rel="{{ $user->id }}" rel1="user/delete"  href="javascript::"><i class="me-1" data-feather="user-x"></i>&nbsp;Slet personale konto</a>
                        @elseif (in_array("AuthSettingDeleteAccount", $permission0) AND auth::user()->id == $user->id)
                            <a class="btn btn-danger-soft text-danger Delete" rel="{{ $user->id }}" rel1="user/delete"  href="javascript::"><i class="me-1" data-feather="user-x"></i>&nbsp;Slet personale konto</a>
                        @else
                            <a  class="btn btn-danger-soft text-danger disabled"  href="javascript::"><i class="me-1" data-feather="user-x"></i>&nbsp;Slet personale konto</a>
                        @endif

                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    



@endsection
@section('js')
<script type="text/javascript">
    $("#All").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endsection


