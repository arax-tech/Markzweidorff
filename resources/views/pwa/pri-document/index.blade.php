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
    .dz-tab .tab-content{padding: 0px !important; box-shadow: none !important; border-radius: 0px !important;}
    .schedule-detail-icon{width: 15px; height: 15px}
    .mb-70{margin-bottom: 70px}
</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container"> 
            <div class="serach-area"> 
                @include('pwa.pri-document.search-form')
                <div class="dz-tab ">
                    <div class="tab-slide-effect">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="tab-active-indicator"></li>
                            
                            <li class="nav-item @if (!request()->active) active @endif" role="presentation">
                                <button class="nav-link @if (!request()->active) active @endif" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#pri-document2" type="button" role="tab" aria-controls="pri-document" aria-selected="false">Oversigt</button>
                            </li>
                            <li class="nav-item @if (request()->active) active @endif" role="presentation">
                                <button class="nav-link @if (request()->active) active @endif" id="content-tab2" data-bs-toggle="tab" data-bs-target="#Favoritter2" type="button" role="tab" aria-controls="Favoritter" aria-selected="false">Favoritter</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent2">
                        

                        <div class="tab-pane fade  @if (!request()->active) show active @endif" id="pri-document2" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                             <div class="list item-list recent-jobs-list mb-70">
                                 <ul class="mb-70">
                                     @foreach ($categories as $category)
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
                                                             <div class="item-price">{{ DB::Table('categories')->whereIn('parent_id', [$category->id])->count() }} sub categories</div>
                                                         </div> --}}
                                                     </div>
                                                 </div>
                                                 <div class="sortable-handler"></div>
                                             </li>
                                         </a>
                                     @endforeach

                                </ul>
                             </div>
                        </div>
                        <div class="tab-pane fade @if (request()->active) show  active @endif" id="Favoritter2" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <div class="list item-list recent-jobs-list mb-70">
                                <ul>
                                      
                                    @if ($FavoritDocuments)
                                        <h4 class="mb-0 mt-5">Favoritter Dokumenter</h4>
                                        <hr class="mt-2 mb-4" />
                                        @foreach ($FavoritDocuments as $key => $doc)
                                            @php
                                                $document = DB::table('documents')->where('id', $doc->document_id)->first();
                                            @endphp
                                            @include('pwa/pri-document.document-row')
                                        @endforeach
                                    @endif
                                      
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Job List -->                    
            </div>    
        </div>
    </div>
    
@endsection