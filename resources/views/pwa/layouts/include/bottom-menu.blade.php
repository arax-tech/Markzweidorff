<div class="menubar-area">
	<div class="toolbar-inner menubar-nav">


		<a href="{{ url('/pwa')}}" class="nav-link {{ request()->is('pwa') ? 'active' : '' }}">
			<i class="{{ request()->is('pwa') ? 'text-primary0' : '' }}" data-feather="home"></i>
		</a>
		<a href="{{ url('/pwa/schedule')}}" class="nav-link {{ (strpos(url()->full() , '/pwa/schedule')) ? 'active' : ''  }}">
			<i class="{{ (strpos(url()->full() , '/pwa/schedule')) ? 'text-primary0' : ''  }}" data-feather="calendar"></i>
		</a>
		
		<a href="{{ url('/pwa/news')}}" class="nav-link {{ (strpos(url()->full() , '/pwa/news')) ? 'active' : ''  }}">
			<i class="{{ (strpos(url()->full() , '/pwa/news')) ? 'text-primary0' : ''  }}" data-feather="book-open"></i>
		</a>
		<a href="{{ url('/pwa/pri/document')}}" class="nav-link {{ (strpos(url()->full() , '/pwa/pri/document')) ? 'active' : ''  }}">
			<i class="{{ (strpos(url()->full() , '/pwa/pri/document')) ? 'text-primary0' : ''  }}" data-feather="file"></i>
		</a>
		
	</div>
</div>