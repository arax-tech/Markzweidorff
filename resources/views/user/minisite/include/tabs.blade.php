@php
    error_reporting(0);

    $array = auth::user()->permissions;
    $permission = explode(",", $array);


@endphp

<nav class="nav nav-borders">
    <a class="nav-link {{ (strpos(url()->full() , '/minisite/'.$minisite->id)) ? 'active' : ''  }} ms-0" href="{{ url('minisite/'.$minisite->id) }}">Overblik</a>
    <a class="nav-link {{ (strpos(url()->full() , '/minisite/information')) ? 'active' : ''  }} ms-0" href="{{ url('minisite/information/'.$minisite->id) }}">Information</a>
    <a class="nav-link {{ (strpos(url()->full() , '/minisite/instrukser')) ? 'active' : ''  }} ms-0" href="{{ url('minisite/instrukser/'.$minisite->id) }}">Instrukser</a>
    <a class="nav-link {{ (strpos(url()->full() , '/minisite/team')) ? 'active' : ''  }} ms-0" href="{{ url('minisite/team/'.$minisite->id) }}">Team</a>
    
</nav>