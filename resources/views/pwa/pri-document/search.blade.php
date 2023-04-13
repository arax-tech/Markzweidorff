@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'PRI Søgning')
@section('header-title', 'PRI Søgning')
@section('css')
<style type="text/css">
    .home-main-icon{width: 60px; height: 60px}
    .schedule-status-container{padding: 12px; border-radius: 10px}
    .schedule-status-icon{color: #fff; width: 40px; height: 40px}
    .schedule-details{font-size: 0.74rem !important; border-top: 1px solid #f2f2f2; padding-top: 5px; margin-top: 5px}
    .schedule-detail-icon{width: 15px; height: 15px}
    .mb-70{margin-bottom: 70px}
</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container"> 
            <div class="serach-area"> 
                @include('pwa.pri-document.search-form')
                <div class="list item-list recent-jobs-list">
                    <ul class="mb-70">
                        <h4 class="mb-0 mt-5">Resultat(er)</h4>
                        <hr class="mt-2 mb-4" />
                        @foreach ($search as $key => $document)
                            @include('pwa/pri-document.document-row')
                        @endforeach

                   </ul>
                </div>
                <!-- Job List -->                    
            </div>    
        </div>
    </div>
    
@endsection