@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp


<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                
                

                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">
                    <center>
                        <a href="{{ url('/dashboard') }}">
                            <img style="width: 150px; margin: 0 auto" src="{{ asset('backend/logo/'.$setting->logo) }}">
                        </a>
                    </center>
                </div>
                <!-- Sidenav Accordion (Dashboard)-->
                
                <!-- Sidenav Link (Tables)-->
                <a class="nav-link {{ (strpos(url()->full() , '/dashboard')) ? 'active' : ''  }}" href="{{ url('/dashboard') }}">
                    <div class="nav-link-icon"><i data-feather="home"></i></div>
                    Startside
                </a>

                @php
                    // dd($params);
                    $array = auth::user()->permissions;
                    $permission = explode(",", $array);


                @endphp


              
          
                @if (in_array("All", $permission) OR in_array("UserView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/user')) ? 'active' : ''  }}" href="{{ url('/user') }}">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        Personale
                    </a>
                @endif

                @if (in_array("All", $permission) OR in_array("UserView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/customer')) ? 'active' : ''  }}" href="{{ url('/customer') }}">
                        <div class="nav-link-icon"><i data-feather="briefcase"></i></div>
                        Kunder
                    </a>
                @endif

                @if (in_array("All", $permission) OR in_array("NewsView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/news')) ? 'active' : ''  }}" href="{{ url('/news') }}">
                        <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                        Nyheder
                    </a>
                @endif


                @if (in_array("All", $permission) OR in_array("UserView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/vehicle')) ? 'active' : ''  }}" href="{{ url('/vehicle') }}">
                        <div class="nav-link-icon"><i data-feather="truck"></i></div>
                        Køretøjer
                    </a>
                @endif

        





                <a class="nav-link {{ (strpos(url()->full(), '/schedule')) ? 'active' : 'collapsed'  }}" style="border-bottom: 2px solid #fff" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseSchedule" aria-expanded="false" aria-controls="collapseSchedule">
                    <div class="nav-link-icon"><i data-feather="calendar"></i></div>
                    Vagtplan
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse  {{ (strpos(url()->full(), '/schedule')) ? 'show' : ''  }}" id="collapseSchedule" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <a class="nav-link {{ request()->is('schedule/overview') ? 'text-primary font-weight-bolder' : '' }}" href="{{ url('/schedule/overview') }}" >Oversigt</a>
                        {{-- <a class="nav-link" href="#" >Min kalender</a> --}}
                        <a class="nav-link {{ (strpos(url()->full(), 'active='.request()->active)) ? 'text-primary font-weight-bolder' : ''  }}" href="{{ url('/schedule?week='.date('Y')."-W".date("W")).'&active=Customer' }}" >Administration</a>
                    </nav>
                </div>
               

                
        
        
                @if (in_array("All", $permission) OR in_array("UserDocumentListView", $permission) AND  in_array("UserDocumentGridView", $permission))
                    <a class="nav-link  {{ (strpos(url()->full(), '/wiki')) ? 'active' : 'collapsed'  }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDocuments" aria-expanded="false" aria-controls="collapseDocuments">
                        <div class="nav-link-icon"><i data-feather="file"></i></div>
                        PRI-Dokumenter
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ (strpos(url()->full(), '/wiki')) ? 'show' : ''  }}" id="collapseDocuments" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Pages -> Account)-->
                            <a class="nav-link {{ request()->is('wiki') ? 'text-primary font-weight-bolder' : '' }}" href="{{ url('/wiki') }}" >Oversigt</a>
                            <a class="nav-link {{ request()->is('wiki/list') ? 'text-primary font-weight-bolder' : '' }}" href="{{ url('/wiki/list') }}" >Administration</a>
                        </nav>
                    </div>
                @elseif (in_array("UserDocumentListView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/wiki/list')) ? 'active' : ''  }}" href="{{ url('/wiki/list') }}">
                        <div class="nav-link-icon"><i data-feather="file"></i></div>
                        PRI-Dokumenter
                    </a>
                @elseif (in_array("UserDocumentGridView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/wiki')) ? 'active' : ''  }}" href="{{ url('/wiki') }}">
                        <div class="nav-link-icon"><i data-feather="file"></i></div>
                        PRI-Dokumenter
                    </a>
                @endif



                @if (in_array("AdminSettingView", $permission) AND  in_array("MiniSiteView", $permission))
                    <a class="nav-link {{ (strpos(url()->full(), '/settings')) ? 'active' : 'collapsed'  }}" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseSetting" aria-expanded="false" aria-controls="collapseSetting">
                        <div class="nav-link-icon"><i data-feather="settings"></i></div>
                        Indstillinger
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ (strpos(url()->full(), '/settings')) ? 'show' : ''  }}" id="collapseSetting" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <a class="nav-link {{ request()->is('settings/app') ? 'text-primary font-weight-bolder' : '' }}" href="{{ url('/settings/app') }}" >Grundlæggende</a>
                            <a class="nav-link {{ request()->is('settings/minisite') ? 'text-primary font-weight-bolder' : '' }}" href="{{ url('/settings/minisite') }}" >MiniSite</a>
                        </nav>
                    </div>
                @elseif (in_array("AdminSettingView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/settings')) ? 'active' : ''  }}" href="{{ url('/settings/app') }}">
                        <div class="nav-link-icon"><i data-feather="settings"></i></div>
                        Grundlæggende
                    </a>
                @elseif (in_array("MiniSiteView", $permission))
                    <a class="nav-link {{ (strpos(url()->full() , '/settings')) ? 'active' : ''  }}" href="{{ url('/settings/minisite') }}">
                        <div class="nav-link-icon"><i data-feather="settings"></i></div>
                        MiniSite
                    </a>
                @endif


                


                <a class="nav-link {{ request()->is('/logout') ? 'active' : '' }}" href="{{ url('/logout') }}">
                    <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                    Log ud
                </a>


                <div class="sidenav-menu-heading">MiniSites</div>
                @php
                    error_reporting(0);
                    // echo ;
                    $location_ids = explode(",", auth::user()->location_id);
                    $minisites = DB::table('minisites')->whereIn('location_id', $location_ids)->get();

                @endphp


                @foreach ($minisites as $minisite)
                    <a class="nav-link {{ request()->is('minisite/'.$minisite->id) ? 'active' : '' }}" href="{{ url('/minisite/'.$minisite->id) }}">
                        <div class="nav-link-icon"><i data-feather="list"></i></div>
                        {{ $minisite->name }}
                    </a>
                @endforeach



            
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-title mt-2">{{ auth::user()->name }}</div>
                <p class="sidenav-footer-subtitle">{{ auth::user()->work_title }}</p>
            </div>
        </div>
    </nav>
</div>
