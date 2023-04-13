@section('css')
<style type="text/css">
    .w-90{width: 90% !important}
    .w-10{width: 10% !important}
</style>
@endsection

@php
    error_reporting(0);
    $query = $_REQUEST['query'];
@endphp

<div class="input-group search-input">
    <form action="{{ url('/pwa/pri/search/') }}" class="w-100">
        <div class="input-group">
            <input style="border-bottom-right-radius: 0px !important; border-top-right-radius: 0px !important" autofocus="" autocomplete="off" type="text" name="query" @if (isset($_REQUEST['query'])) value="{{ $query }}" @endif  placeholder="Søg PRI-dokumenter..." class="form-control style-1 main-in w-90">
            {{-- <a href="javascript:void(0);" class="btn-close" style="margin-right: 10% !important"><i class="fa-solid fa-xmark"></i></a> --}}
            <input style="border-bottom-right-radius: 30px !important; border-top-right-radius: 30px !important" class="btn btn-primary custom-button-search w-10" type="submit" value="Søg">
        </div>
    </form>
</div>
