@php
	error_reporting(0);

    $array = auth::user()->permissions;
    $permission = explode(",", $array);
    $url = request()->fullUrl();
@endphp

{{-- <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 fixed-top" style=" top: 58px !important;"> --}}
<header id="leftMargin" class="page-header page-header-compact page-header-light border-bottom bg-white mb-4  fixed-top" style="@if (auth::user()->sidebar == "Show") padding-left: 240px !important; @endif top: 58px !important;">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="truck"></i></div>
                        Køretøjer › {{ $user->name }} ›  
                        @if (strpos($url, 'profile') !== false)
                            Information
                        @elseif (strpos($url, 'view') !== false)
                            Information
                        @elseif (strpos($url, 'stamdata') !== false)
                            StamData
                        @elseif (strpos($url, 'equipment') !== false)
                            Udstyr
                        @elseif (strpos($url, 'doc') !== false)
                            Dokumenter
                        @elseif (strpos($url, 'pri') !== false)
                            PRI-Status
                        @elseif (strpos($url, 'note') !== false)
                            Noter
                        @elseif (strpos($url, 'setting') !== false)
                            Indstillinger
                        @endif
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="{{ url('/vehicle') }}" >
                        <i class="me-1" data-feather="arrow-left"></i>
                        &nbsp;Oversigt
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<br><br>
