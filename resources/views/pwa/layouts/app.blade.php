
@php
    $date = date("G");
    // echo $date;
    // dd($date);

    

    if ($date >= 6 AND $date <= 9)
    {
        $greeting = "Godmorgen";
    }
    else if($date >= 9 AND $date <= 12){
        $greeting = "God formiddag";
    }

    else if($date >= 12 AND $date <= 13){
        $greeting = "God middag";            
    }

    else if($date >= 13 AND $date <= 18){
        $greeting = "God eftermiddag";
    }

    else if($date >= 18 AND $date <= 23){
        $greeting = "God aften";
    }

    else if($date >= 23 OR $date <= 3){
        $greeting = "God nat";
    }
        
@endphp

<!DOCTYPE html>
<html lang="da">
<head>
    
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    
	<!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicons Icon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
	
	<!-- PWA Version -->
    <link rel="manifest" href="{{ asset('assets/manifest.json') }}">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    	
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style type="text/css">
    	.menubar-area{
    		height: 74px !important;

    	}
    	.menubar-area .toolbar-inner .nav-link.active:after, .menubar-area .toolbar-inner .menu-toggler.active:after{
    		bottom: -26px !important;
    	}
    	.menubar-area .toolbar-inner .nav-link.active svg path, .menubar-area .toolbar-inner .menu-toggler.active svg path { fill: #fff !important;
		}
    	.text-primary0{
    		color: #ff3b30 !important;
    	}
    	.tata-title{color: #fff !important};
    	.custom-sidebar-icon-box{
    		background: #ff3b3047 !important
    	}
    	.sidebar--icon{
    		width: 13px; height: 13px; margin-left: 2px; color: #ff3b30 !important
    	}
    	.sidebar .nav-label{
    		font-size: 13px !important
    	}
    </style>
    @yield('css')
</head>   
<body {{-- @if ($date >= 18 OR $date <= 6) class="theme-dark" @endif --}}>
<div class="page-wraper"  data-theme-color="color-red">
    @php
    	$url = request()->fullUrl();
    @endphp
    <!-- Header -->
    @if (strpos($url, 'pwa/schedule') !== false)
		@include('pwa.layouts.include.header1')
	@elseif (strpos($url, 'pwa/pri/document/pdf') !== false)
		@include('pwa.layouts.include.header2')
	@elseif (strpos($url, 'pwa/news/view') !== false)
		@include('pwa.layouts.include.header1')
	@elseif (strpos($url, 'pwa/pri') !== false)
		@include('pwa.layouts.include.header1')
	@elseif (strpos($url, 'pwa/news') !== false)
		@include('pwa.layouts.include.header1')
    @else
		@include('pwa.layouts.include.header')
    @endif
    <!-- Header End -->
    
    <!-- Preloader -->
	<div id="preloader">
		<div class="spinner"></div>
	</div>
    <!-- Preloader end-->
    
	<!-- Sidebar -->
    <div class="sidebar">
    	


		<div class="author-box bg-primary">
			<div class="dz-media">
				@if (!empty(auth::user()->image))
				    <img class="rounded-circle" src="{{ asset('backend/profile/'.auth::user()->image) }}" />
				@else
				    <img class="rounded-circle" src="{{ asset('backend/placeholder.jpg') }}" />
				@endif
			</div>
			<div class="dz-primary">
				<h5 class="name">{{ auth::user()->name }}</h5>
				{{-- <span>{{ $greeting }}</span> --}}
				<span>{{ auth::user()->work_title }}</span>
			</div>
		</div>
		<ul class="nav navbar-nav">	
			<li class="nav-label">Menu</li>

			<li>
				<a class="nav-link" href="{{ url('/pwa') }}">
					<span class="dz-icon custom-sidebar-icon-box" style="background: #ff3b3047 !important">
						<i class="text-dark sidebar--icon" data-feather="home"></i>
					</span>
					<span>Velkommen</span>
				</a>
			</li>
			
			<li>
				<a class="nav-link" href="{{ url('/pwa/schedule') }}">
					<span class="dz-icon custom-sidebar-icon-box" style="background: #ff3b3047 !important">
						<i class="text-dark sidebar--icon" data-feather="calendar"></i>
					</span>
					<span>Vagtplan</span>
				</a>
			</li>
			<li>
				<a class="nav-link" href="{{ url('/pwa/news') }}">
					<span class="dz-icon custom-sidebar-icon-box" style="background: #ff3b3047 !important">
						<i class="text-dark sidebar--icon" data-feather="book-open"></i>
					</span>
					<span>Nyheder</span>
				</a>
			</li>



			<li>
				<a class="nav-link" href="{{ url('/pwa/pri/document') }}">
					<span class="dz-icon custom-sidebar-icon-box" style="background: #ff3b3047 !important">
						<i class="text-dark sidebar--icon" data-feather="file"></i>
					</span>
					<span>PRI-dokumenter</span>
				</a>
			</li>


			<li>
				<a class="nav-link" href="{{ url('/pwa/logout') }}">
					<span class="dz-icon custom-sidebar-icon-box" style="background: #ff3b3047 !important">
						<i class="text-dark sidebar--icon" data-feather="log-out"></i>
					</span>
					<span>Logud</span>
				</a>
			</li>

            <li class="nav-label">INDSTILLERINGER</li>
            <li>
                <div class="mode">
                    <span class="dz-icon bg-green light" style="background: #ff3b3047 !important">
                        <i class="fa-solid fa-moon sidebar--icon"></i>
                    </span>					
                    <span>Mørk tilstand</span>
                    <div class="custom-switch">
                        <input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
                        <label class="custom-switch-label" for="toggle-dark-menu"></label>
                    </div>
                </div>
            </li>


            @php
            	$appAccess = auth::user()->app_access;
            	$app_permission = explode(",", $appAccess);
            @endphp
            @if ((in_array("Admin", $app_permission) && in_array("PWA", $app_permission)))
            <li class="nav-label">ANDRE SYSTEMER</li>
        

			<li>
				<a class="nav-link" href="{{ url('/dashboard') }}">
					<span class="dz-icon custom-sidebar-icon-box" style="background: #ff3b3047 !important">
						<i class="text-dark sidebar--icon" data-feather="monitor"></i>
					</span>
					<span>Administration</span>
				</a>
			</li>
            @endif
		</ul>
		{{-- <div class="sidebar-bottom">
			<h6 class="name">{{ auth::user()->name }}</h6>
			<p>{{ auth::user()->work_title }}</p>
        </div> --}}
    </div>
    <!-- Sidebar End -->
    
    
    
    <!-- Page Content -->
    @yield('content')
    <!-- Page Content End-->
    
    <!-- Menubar -->
    @if (!strpos($url, 'schedule/view') !== false)
		@include('pwa.layouts.include.bottom-menu')
	@endif
	<!-- Menubar -->
	
</div>  
<script src="{{ asset('assets/index.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dz.carousel.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>



<script>
  feather.replace()
</script>

@yield('js')

<script src="{{ asset('/toaster/dist/tata.js') }}"></script>    
	<script type="text/javascript">
		(function($) {
		    "use strict"
			dzThemeSettings();

		    @if ($date >= 18 OR $date <= 6) 
		    	// setCookie('themeVersion_value', 'theme-dark'); 
		    @endif
		    
		    
	
		    
		    /* Set Theme By Cookie */
		    setThemePanel();
			
		})(jQuery);
	</script>
	@if (Session::has('flash_message_error'))
	    <script>
	        tata.error('Fejl...', '{!! session('flash_message_error') !!}', {
	          position: 'tr',
	          duration: 7000,
	          animate: 'slide'
	        })
	    </script>
	@endif

	@if (Session::has('flash_message_success'))
	    <script>
	        tata.success('Udført...', '{!! session('flash_message_success') !!}', {
	          position: 'tr',
	          duration: 7000,
	          animate: 'slide'
	        })

	    </script>
	    
	@endif
	<script>
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>