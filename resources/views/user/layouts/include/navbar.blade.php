@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();

    $array = auth::user()->permissions;
    $permission = explode(",", $array);




    $documentsNotifications = DB::table('documents')->get();
    $documents1 = DB::table('document_status')->where(['user_id' => auth::user()->id])->whereIn('status' , ['Read', 'Read Understood', 'Read Not Understood'])->get();
    $documentUnRead = DB::table('document_status')->where(['user_id' => auth::user()->id, 'status' => 'UnRead'])->count();

@endphp


<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start" style="background: #3E445E !important" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    
        <input type="hidden" name="sidebar" value="@if (auth::user()->sidebar == "Show") Hide @else Show @endif">

        <button type="button" id="sidebarToggle" class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" ><i class="text-white" data-feather="sidebar"></i></button>
        
        
   
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a style="width: 10px !important" class="navbar-brand pe-3 ps-4 ps-lg-2 text-white " href="{{ url('/dashboard') }}">{{ $setting->welcome_heading }}</a>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->
    <div class="offset-3">
        <form autocomplete="off" class="form-inline me-auto d-none d-lg-block me-3 " style="width: 200% !important; "  action="{{ url('/wiki/search') }}">
            <div class="input-group input-group-joined joined input-group-solid" style="margin-top: 15px !important; background: #5B6076 !important">
                <input class="typeahead title subtitle keyword form-control pe-0 text-white" type="search" placeholder="Søgning..." aria-label="Search"  name="query" @if (isset($_REQUEST['query'])) value="{{ $query }}" autocomplete="off" @endif/>
                <button style="outline: none; border:none; border-radius: 0rem 0.4375rem 0.4375rem 0rem; background: #5B6076 !important"><div class="input-group-text"><i class="text-white" data-feather="search"></i></div></button>
            </div>
        </form>
    </div>
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        <!-- Documentation Dropdown-->
    

        @if (in_array("All", $permission) OR in_array("UserDocumentListView", $permission) OR  in_array("UserDocumentGridView", $permission))
            <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle shadow-md" style="background: #5B6076 !important" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell" class="myBell text-white"></i> </a>
                <span style="margin-left: -1% !important; position: fixed !important; padding: 7px; border-radius: 50% " class="badge bg-primary">{{ count($documentsNotifications) - count($documents1)  +   $documentUnRead }}</span>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="me-2" data-feather="bell"></i>
                        ({{ count($documentsNotifications) - count($documents1)  +  $documentUnRead }}) UnRead Documents
                    </h6>
                    <!-- Example Alert 1-->
                    @foreach ($documentsNotifications as $key => $document)
                        
                        @php
                            $check = DB::table('document_status')->where('document_id', $document->id)->count();
                            $i = 1;
                        @endphp
                            @if ($check == 0)
                                <a class="dropdown-item dropdown-notifications-item" href="{{ url('/wiki/view/'.$document->id) }}">
                                    <div class="dropdown-notifications-item-icon bg-primary"><i data-feather="{{ $document->icon }}"></i></div>
                                    <div class="dropdown-notifications-item-content">
                                        <div class="dropdown-notifications-item-content-details"> {{ date('d M Y H:i', strtotime($document->created_at)) }}</div>
                                        <div class="dropdown-notifications-item-content-text">{{ $document->title }}</div>
                                    </div>
                                </a>
                            @endif
                       
                    @endforeach

                    <a class="dropdown-item dropdown-notifications-footer" href="{{ url('/wiki') }}">View All Documents</a>
                </div>
            </li>
        @endif


        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle shadow-sm" id="navbarDropdownUserImage"
                href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">

                @if (!empty(auth::user()->image))
                    <img class="img-fluid" src="{{ asset('backend/profile/'.auth::user()->image) }}" />
                @else
                    <img class="img-fluid" src="{{ asset('backend/placeholder.jpg') }}" />
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">

                    @if (!empty(auth::user()->image))
                        <img class="dropdown-user-img" src="{{ asset('backend/profile/'.auth::user()->image) }}" />
                    @else
                        <img class="dropdown-user-img" src="{{ asset('backend/placeholder.jpg') }}" />
                    @endif

                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">{{ auth::user()->name }}</div>
                        <div class="dropdown-user-details-email">
                            <p>{{ auth::user()->work_title }}</p>
                        </div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                {{-- <a class="dropdown-item" href="{{ url('/dashboard') }}">
                    <div class="dropdown-item-icon"><i data-feather="home"></i></div>
                    Startside
                </a> --}}

                @php
                    // dd($params);
                    $array = auth::user()->permissions;
                    $permission = explode(",", $array);


                @endphp

                @if (in_array("All", $permission) OR in_array("ViewAuthProfile", $permission))
                    <a class="dropdown-item" href="{{ url('/user/view/'.auth::user()->id) }}">
                        <div class="dropdown-item-icon"><i data-feather="user"></i></div>
                        Mine Oplysninger
                    </a>
                @endif
                @if (in_array("All", $permission) OR in_array("UserUpdatePassword", $permission))
                    <a class="dropdown-item" href="{{ url('/password') }}">
                        <div class="dropdown-item-icon"><i data-feather="lock"></i></div>
                        Skift adgangskode
                    </a>
                @endif
                <a class="dropdown-item" href="{{ url('/logout') }}">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Log ud
                </a>
            </div>
        </li>
    </ul>
</nav>


