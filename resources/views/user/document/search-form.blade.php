@section('css')
<style type="text/css">
    
    .page-header.page-header-dark .page-header-search .input-group-joined:focus-within {
      box-shadow: 0 0 0 0.25rem rgba(0, 97, 242, 0.25) !important;;
      /*border-color: transparent;*/
      height: 4rem !important;
    }
</style>
@endsection

@php
    error_reporting(0);
    $query = $_REQUEST['query'];
@endphp

<div class="page-header-search mt-4">
        <form action="{{ url('/wiki/search') }}">
    <div class="input-group input-group-joined">
            <div class="row g-0 w-100">
                <div class="col-11 col-sm-10">
                    <input style="border-bottom-right-radius: 0px !important; border-top-right-radius: 0px !important" class="typeahead title subtitle keyword form-control" type="text" name="query" placeholder="Søgning..." autofocus="" @if (isset($_REQUEST['query'])) value="{{ $query }}" @endif autocomplete="off" />
                    {{-- <input class="typeahead form-control" type="text"> --}}
                </div>
                
                <div class="col-1 col-sm-2">
                    <button  type="submit" style="height: 4rem !important; align-items: center; border-bottom-left-radius: 0px !important; border-top-left-radius: 0px !important" class="btn btn-light text-dark btn-block w-100"><i data-feather="search"></i></button>
                </div>
            </div>


    </div>
        </form>
</div>
