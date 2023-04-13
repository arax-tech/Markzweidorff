<style type="text/css">
    .card-icon .card-icon-aside i, .card-icon .card-icon-aside svg, .card-icon .card-icon-aside .feather{height: 2rem !important}
    .bg-primary {background-color: #f53b57 !important}
    .btn-blue {background-color: #0061f2 !important}
</style>


<a class="card card-icon lift lift-sm mb-4" href="{{ url('wiki/view/'.$document->id) }}">
    <div class="row g-0">
        <div class="col-auto card-icon-aside bg-primary py-1 px-3">
            <i class="text-white" data-feather="{{ $document->icon }}"></i>
        </div>
        <div class="col">
            <div class="card-body d-flex justify-content-center">
                <div class="h5 card-title mb-0 w-100">

                    <div class="row mt-1 mb-2">

                        @if (strpos(url()->full() , '/wiki/search'))
                            <div class="col-md-6 d-flex align-items-center text-primary">
                        @else
                            <div class="col-md-9 d-flex align-items-center text-primary">
                        @endif
                                
                            @if (strpos(url()->full() , '/wiki/search'))
                                {{ mb_strimwidth($document->title, 0, 50, "...") }}
                            @else
                                {{ $document->title }}
                            @endif
                        </div>
                        
                        @if (strpos(url()->full() , '/wiki/search'))
                            
                            

                            <div class="col-md-4  d-flex align-items-center">


                                @php
                                    $check = DB::table('categories')->where('id', $document->category)->count();
                                @endphp
                                @if ($check > 0)
                                    @php
                                        error_reporting(0);
                                       
                                        $category = DB::table('categories')->where('id', $document->category)->first();
                                       
                                    @endphp

                                    <span class="small"><i data-feather="{{ $category->icon }}"></i>&nbsp;{{ $category->name }}</span>
                                @else
                                    N/A
                                @endif



                                
                            </div>
                        @else
                            
                        
                        @endif
                        
                        @if (strpos(url()->full() , '/wiki/search'))
                            <div class="col-md-2  d-flex align-items-center">
                        @else
                            <div class="col-md-3  d-flex align-items-center">
                        @endif
                            @php
                                error_reporting(0);
                               
                                $status = DB::table('document_status')->where(['document_id' => $document->id, 'user_id' => auth::user()->id])->first();
                               
                            @endphp
                            @if (count($status) == 0)
                                <span class="badge bg-red text-white mb-1">Ulæst</span>
                            @elseif($status->status == "Read")
                                <span class="badge bg-blue text-white mb-1">Læst</span>
                            @elseif($status->status == "Read Understood")
                                <span class="badge bg-green text-white mb-1">Læst og forstået</span>
                            @elseif($status->status == "Read Not Understood")
                                <span class="badge bg-yellow text-white mb-1">Læst, ej forstået</span>
                            @else
                                <span class="badge bg-red text-white mb-1">Ulæst</span>
                            @endif

                            
                        </div>
                    </div>

                    @if (strpos(url()->full() , '/wiki/search'))
                        <div class="row mt-1">
                            <div class="col text-wrap">
                                
                                @php
                                    $array = explode(",", $document->keyword);
                                @endphp
                                

                                @foreach ($array as $key => $value)
                                   
                                    <span class="badge text-dark bg-light mb-2"> <i style="margin-top: -2px !important" data-feather="tag"></i> {{ $value }}</span> &nbsp;
                                    
                                @endforeach
                            </div>
                        </div>
                    @endif
                    

                    
                    

                </div>
            </div>
        </div>
    </div>
</a>