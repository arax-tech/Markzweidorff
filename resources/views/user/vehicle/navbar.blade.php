@php
	error_reporting(0);

    $array = auth::user()->permissions;
    $permission = explode(",", $array);


@endphp

<nav class="nav nav-borders">
	
    
   
    @if (in_array("All", $permission) OR in_array("ViewUserProfile", $permission) AND auth::user()->id != $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/vehicle/view')) ? 'active' : ''  }} ms-0" href="{{ url('vehicle/view/'.$user->id) }}">Information</a>
	@elseif (in_array("ViewAuthProfile", $permission) AND auth::user()->id == $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/vehicle/view')) ? 'active' : ''  }} ms-0" href="{{ url('vehicle/view/'.$user->id) }}">Information</a>
	@endif
    



    @if (in_array("All", $permission) OR in_array("UserStamDataView", $permission) AND auth::user()->id != $user->id)
    	<a class="nav-link {{ request()->is('vehicle/stamdata/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/stamdata/'.$user->id) }}">Stamdata</a>
	@elseif (in_array("AuthStamDataView", $permission) AND auth::user()->id == $user->id)
    	<a class="nav-link {{ request()->is('vehicle/stamdata/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/stamdata/'.$user->id) }}">Stamdata</a>
	@endif




	@if (in_array("All", $permission) OR in_array("UserDocumentView", $permission) AND auth::user()->id != $user->id)
    	<a class="nav-link {{ request()->is('vehicle/doc/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/doc/'.$user->id) }}">Dokumenter</a>
	@elseif (in_array("AuthDocumentView", $permission) AND auth::user()->id == $user->id)
    	<a class="nav-link {{ request()->is('vehicle/doc/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/doc/'.$user->id) }}">Dokumenter</a>
	@endif


	@if (in_array("All", $permission) OR in_array("UserNoteView", $permission) AND auth::user()->id != $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/vehicle/note')) ? 'active' : ''  }}" href="{{ url('vehicle/note/'.$user->id) }}">Noteringer</a>
	@elseif (in_array("AuthNoteView", $permission) AND auth::user()->id == $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/vehicle/note')) ? 'active' : ''  }}" href="{{ url('vehicle/note/'.$user->id) }}">Noteringer</a>
	@endif

{{-- 
	@if (in_array("All", $permission) OR in_array("UserEquipmentView", $permission) AND auth::user()->id != $user->id)
	    <a class="nav-link {{ request()->is('vehicle/equipment/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/equipment/'.$user->id) }}">Udstyr & Materiel</a>
	@elseif (in_array("AuthEquipmentView", $permission) AND auth::user()->id == $user->id)
	    <a class="nav-link {{ request()->is('vehicle/equipment/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/equipment/'.$user->id) }}">Udstyr & Materiel</a>
	@endif --}}



	{{-- @if (in_array("All", $permission))
	    <a class="nav-link {{ request()->is('vehicle/pri/'.$user->id) ? 'active' : '' }} " href="{{ url('vehicle/pri/'.$user->id) }}">PRI - Overblik</a>
	@endif



	@if (in_array("All", $permission) OR in_array("UserSettingView", $permission) AND auth::user()->id != $user->id)
	     <a class="nav-link {{ request()->is('vehicle/setting/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/setting/'.$user->id) }}">Indstillinger</a>
	@elseif (in_array("AuthSettingView", $permission) AND auth::user()->id == $user->id)
	     <a class="nav-link {{ request()->is('vehicle/setting/'.$user->id) ? 'active' : '' }}" href="{{ url('vehicle/setting/'.$user->id) }}">Indstillinger</a>
	@endif --}}
</nav>