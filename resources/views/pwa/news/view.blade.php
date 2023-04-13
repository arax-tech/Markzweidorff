@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

@extends('pwa.layouts.app')
@section('title', 'Nyheder')
@section('header-title', "Nyhed")
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
        <div class="content-body mb-70" >
            <div class="container"> 
                <div class="border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="title">{{ $news->title }}</h5>
                            <span class="d-block my-2 d-flex align-items-center">
                                <i style="width: 15px; height: 15px" data-feather="calendar"></i>&nbsp;{{ date('d M Y', strtotime($news->date)) }}
                            </span>
                            <span class="d-block my-2 d-flex align-items-center">
                                <i style="width: 15px; height: 15px" data-feather="user"></i>&nbsp;{{ $news->author }}
                            </span>
                        </div>
                        <div class="ms-3">
                            <div class="schedule-status-container bg-info">
                                @php
                                    error_reporting(0);
                                    $array = explode(",", $news->views);
                                @endphp
                                    <i class="schedule-status-icon" style="color: white !important" data-feather="book-open"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-btn-center-lr">
                        
                    </div>
                </div>

                <div class="border-bottom">
                    <div class="d-flex align-items-center my-4">
                       
                        <div class="">
                            <span class="d-block mb-2 text-primary" style="font-size: 10px; letter-spacing: 1px;">KOMPETENCENIVEAU</span>
                            <div class="swiper-container tag-group team-swiper-4">
                                <div class="swiper-wrapper">
                                    @php
                                        $groupsArray = explode(",", $news->groups);
                                        $groups = DB::table('user_groups')->whereIn('id', $groupsArray)->get();
                                    @endphp
                                    @foreach ($groups as $group) 
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0);" class="tag-btn" style="background: {{ $group->background }} !important; color : {{ $group->color }} !important; font-size: 10px !important">{{ $group->name }}</a>                                    
                                        </div>
                                    @endforeach
                                </div>
                            </div>                  
                        </div>
                    </div>


                </div>

                <div class="mt-4 mb-2">
                    {{-- <h5 class="mb-3">Content</h5> --}}
                    <p class="para-title">
                        {!! $news->content !!}
                    </p>
                </div>
                <div id="map"></div>
                @if ($news->document !== null)
                    <a class="btn btn-primary mb-5 mt-3 w-100 btn-rounded" target="_blank" href="{{ asset('backend/news/document/'.$news->document) }}">Download PDF</a>
                @endif
            </div>    
        </div>
    </div>

    
@endsection

@section('js')

@endsection