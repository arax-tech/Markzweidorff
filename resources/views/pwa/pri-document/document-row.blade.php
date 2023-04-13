@section('css')
<style type="text/css">
    .recent-jobs-list ul li .item-content .item-inner .item-price{
        margin-left: 0px !important;
    }
</style>
@endsection

<a  href="{{ url('pwa/pri/document/view/'.$document->id) }}">
    <li>
        <div class="item-content">
            <div class="item-media">
                <div class="schedule-status-container bg-primary">
                    <i class="schedule-status-icon" data-feather="{{ $document->icon }}"></i>
                </div>
            </div>
            <div class="item-inner w-100">
                <div class="item-title-row">
                    <h6 class="item-title">
                        @if (strpos(url()->full() , '/pwa/pri/document/search'))
                            {{ mb_strimwidth($document->title, 0, 50, "...") }}
                        @else
                            {{ $document->title }}
                        @endif
                    </h6>
                    {{-- <div class="item-subtitle">{{ $category->description }}</div> --}}
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    {{-- <i data-feather="grid"></i> --}}
                    <div class="item-price" style="margin-left: 0px !important">
                        @php
                            error_reporting(0);
                           
                            $status = DB::table('document_status')->where(['document_id' => $document->id, 'user_id' => auth::user()->id])->first();
                           
                        @endphp
                        @if (count($status) == 0)
                            <span class="badge bg-red text-white">Ulæst</span>
                        @elseif($status->status == "Read")
                            <span class="badge bg-blue text-white">Læst</span>
                        @elseif($status->status == "Read Understood")
                            <span class="badge bg-green text-white">Læst og forstået</span>
                        @elseif($status->status == "Read Not Understood")
                            <span class="badge bg-yellow text-white">Læst, ej forstået</span>
                        @else
                            <span class="badge bg-red text-white">Ulæst</span>
                        @endif
                        
                    </div>
                    @php
                        $favorite = DB::table('favorite_documents')->where(['document_id' => $document->id, 'user_id' => auth::user()->id])->count();
                    @endphp
                    @if ($favorite)
                        <div><i class="text-warning float-right" style="fill: #ffc600" data-feather="heart"></i></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="sortable-handler"></div>
    </li>
</a>