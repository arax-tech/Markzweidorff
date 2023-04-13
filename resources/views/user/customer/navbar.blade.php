@php
	error_reporting(0);

    $array = auth::user()->permissions;
    $permission = explode(",", $array);


@endphp

<nav class="nav nav-borders">
	
    
   
    @if (in_array("All", $permission) OR in_array("ViewUserProfile", $permission) AND auth::user()->id != $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/customer/view')) ? 'active' : ''  }} ms-0" href="{{ url('customer/view/'.$user->id) }}">Information</a>
	@elseif (in_array("ViewAuthProfile", $permission) AND auth::user()->id == $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/customer/view')) ? 'active' : ''  }} ms-0" href="{{ url('customer/view/'.$user->id) }}">Information</a>
	@endif
    



    @if (in_array("All", $permission) OR in_array("UserStamDataView", $permission) AND auth::user()->id != $user->id)
    	<a class="nav-link {{ request()->is('customer/stamdata/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/stamdata/'.$user->id) }}">Stamdata</a>
	@elseif (in_array("AuthStamDataView", $permission) AND auth::user()->id == $user->id)
    	<a class="nav-link {{ request()->is('customer/stamdata/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/stamdata/'.$user->id) }}">Stamdata</a>
	@endif




	@if (in_array("All", $permission) OR in_array("UserDocumentView", $permission) AND auth::user()->id != $user->id)
    	<a class="nav-link {{ request()->is('customer/assignment/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/assignment/'.$user->id) }}">Assignment</a>
	@elseif (in_array("AuthDocumentView", $permission) AND auth::user()->id == $user->id)
    	<a class="nav-link {{ request()->is('customer/assignment/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/assignment/'.$user->id) }}">Assignment</a>
	@endif

	{{-- @if (in_array("All", $permission) OR in_array("UserDocumentView", $permission) AND auth::user()->id != $user->id)
    	<a class="nav-link {{ request()->is('customer/doc/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/doc/'.$user->id) }}">Dokumenter</a>
	@elseif (in_array("AuthDocumentView", $permission) AND auth::user()->id == $user->id)
    	<a class="nav-link {{ request()->is('customer/doc/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/doc/'.$user->id) }}">Dokumenter</a>
	@endif


	@if (in_array("All", $permission) OR in_array("UserNoteView", $permission) AND auth::user()->id != $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/customer/note')) ? 'active' : ''  }}" href="{{ url('customer/note/'.$user->id) }}">Noteringer</a>
	@elseif (in_array("AuthNoteView", $permission) AND auth::user()->id == $user->id)
	    <a class="nav-link {{ (strpos(url()->full() , '/customer/note')) ? 'active' : ''  }}" href="{{ url('customer/note/'.$user->id) }}">Noteringer</a>
	@endif --}}

{{-- 
	@if (in_array("All", $permission) OR in_array("UserEquipmentView", $permission) AND auth::user()->id != $user->id)
	    <a class="nav-link {{ request()->is('customer/equipment/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/equipment/'.$user->id) }}">Udstyr & Materiel</a>
	@elseif (in_array("AuthEquipmentView", $permission) AND auth::user()->id == $user->id)
	    <a class="nav-link {{ request()->is('customer/equipment/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/equipment/'.$user->id) }}">Udstyr & Materiel</a>
	@endif --}}



	{{-- @if (in_array("All", $permission))
	    <a class="nav-link {{ request()->is('customer/pri/'.$user->id) ? 'active' : '' }} " href="{{ url('customer/pri/'.$user->id) }}">PRI - Overblik</a>
	@endif



	@if (in_array("All", $permission) OR in_array("UserSettingView", $permission) AND auth::user()->id != $user->id)
	     <a class="nav-link {{ request()->is('customer/setting/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/setting/'.$user->id) }}">Indstillinger</a>
	@elseif (in_array("AuthSettingView", $permission) AND auth::user()->id == $user->id)
	     <a class="nav-link {{ request()->is('customer/setting/'.$user->id) ? 'active' : '' }}" href="{{ url('customer/setting/'.$user->id) }}">Indstillinger</a>
	@endif --}}
</nav>