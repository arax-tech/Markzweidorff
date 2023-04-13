@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'PRI-dokumenter')
@section('header-title', 'PRI-dokumenter')
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
                        @foreach ($sub_categories as $category)
                            <a href="{{ url('/pwa/pri/document/' . $category->id) }}">
                                <li>
                                    <div class="item-content">
                                        <div class="item-media">
                                            <div class="schedule-status-container bg-primary">
                                                <i class="schedule-status-icon" data-feather="{{ $category->icon }}"></i>                                            
                                            </div>
                                        </div>
                                        <div class="item-inner">
                                            <div class="item-title-row">
                                                <h6 class="item-title">{{ $category->name }}</h6>
                                                <div class="item-subtitle">{{ $category->description }}</div>
                                            </div>
                                            {{-- <div class="d-flex align-items-center mb-2">
                                                <i data-feather="grid"></i>
                                                <div class="item-price">
                                                    {{ DB::Table('categories')->whereIn('parent_id', [$category->id])->count() }} sub categories & {{ DB::Table('documents')->where('category', $category->id)->count() }} documents  
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="sortable-handler"></div>
                                </li>
                            </a>
                        @endforeach

                        @if ($documents)
                            <h4 class="mb-0 mt-5">Dokumenter</h4>
                            <hr class="mt-2 mb-4" />
                            @foreach ($documents as $key => $document)
                                @include('pwa/pri-document.document-row')
                            @endforeach
                        @endif

                   </ul>
                </div>
                <!-- Job List -->                    
            </div>    
        </div>
    </div>
    
@endsection