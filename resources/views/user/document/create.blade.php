@extends('user.layouts.app')

@section('title', 'PRI › Opret dokument')
@section('css')
    <style>
        .small {
            color: #31353d !important;
        }

        td {
            vertical-align: middle !important;
        }
    </style>


    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
        .chosen-container{width: 100% !important; height: 45px !important}
        .chosen-container-multi .chosen-choices{padding: 7px !important; border: 1px solid #c5ccd6 !important; background-color: #fff !important; border-radius: 5px !important;}
        .chosen-container .chosen-results li.highlighted {
            background-color: #f53b57 !important;
            background-image: -webkit-gradient(linear,50% 0,50% 100%,color-stop(20%,#3875d7),color-stop(90%,#e81500)) !important;
            background-image: -webkit-linear-gradient(#f53b57 20%,#e81500 90%) !important;
            background-image: -moz-linear-gradient(#f53b57 20%,#e81500 90%) !important;
            background-image: -o-linear-gradient(#f53b57 20%,#e81500 90%) !important;
            background-image: linear-gradient(#f53b57 20%,#e81500 90%) !important;
            color: #fff !important;
        }
    </style>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    </head>
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #f53b57 !important;
            padding: 0.2rem;
        }

        .bootstrap-tagsinput {
            width: 100% !important;
            height: 43px !important;
            line-height: 35px !important
        }
    </style>
@endsection

@section('content')
    

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="padding-left: 240px !important; top: 58px !important;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            PRI - Dokumenter › Opret dokument
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ url('/wiki/list') }}" >
                            <i class="me-1" data-feather="arrow-left"></i>
                            Tilbage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br><br>


    <!-- Main page content-->
    <div class="container-fluid px-4">
        <!-- Wizard card example with navigation-->
        <div class="card">
            
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard0-tab" href="#wizard0" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard0" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Generelt</div>
                            <div class="wizard-step-text-details">Basale informationer</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Tekst</div>
                            <div class="wizard-step-text-details">Tekst information</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Indstillinger</div>
                            <div class="wizard-step-text-details">Andre detaljer og informationer</div>
                        </div>
                    </a>

                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('/wiki/list/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content" id="cardTabContent">
                        <!-- Wizard tab pane item 1-->
                        <div class="tab-pane  fade show active" id="wizard0" role="tabpanel"
                            aria-labelledby="wizard1-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-12 col-xl-12">
                                    
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1">Titel</label>
                                                <input class="form-control" type="text" name="title" value="{{ old('title') }}" />
                                            </div>

                                            <div class="col-md-6">
                                                <label class="small mb-1">Kategori</label>
                                                <select class="form-control" name="category">
                                                    <option value="">Vælg...</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>

                                                        {{-- Level 2 --}}
                                                        @php
                                                            error_reporting(0);
                                                            $level2s = DB::table('categories')->where('parent_id', $category->id)->get();
                                                        @endphp
                                                        @foreach ($level2s as $level2)
                                                            <option value="{{ $level2->id }}">--{{ $level2->name }}</option>


                                                            {{-- Level 3 --}}
                                                            @php
                                                                error_reporting(0);
                                                                $level3s = DB::table('categories')->where('parent_id', $level2->id)->get();
                                                            @endphp
                                                            @foreach ($level3s as $level3)
                                                                <option value="{{ $level3->id }}">----{{ $level3->name }}</option>



                                                                {{-- Level 4 --}}
                                                                @php
                                                                    error_reporting(0);
                                                                    $level4s = DB::table('categories')->where('parent_id', $level3->id)->get();
                                                                @endphp
                                                                @foreach ($level4s as $level4)
                                                                    <option value="{{ $level4->id }}">------{{ $level4->name }}</option>

                                                                    {{-- Level 5 --}}
                                                                    @php
                                                                        error_reporting(0);
                                                                        $level5s = DB::table('categories')->where('parent_id', $level4->id)->get();
                                                                    @endphp
                                                                    @foreach ($level5s as $level5)
                                                                        <option value="{{ $level5->id }}">--------{{ $level5->name }}</option>


                                                                        {{-- Level 6 --}}
                                                                        @php
                                                                            error_reporting(0);
                                                                            $level6s = DB::table('categories')->where('parent_id', $level5->id)->get();
                                                                        @endphp
                                                                        @foreach ($level6s as $level6)
                                                                            <option value="{{ $level6->id }}">----------{{ $level6->name }}</option>
                                                                        @endforeach
                                                                    @endforeach

                                                                @endforeach
                                                            @endforeach
                                                        @endforeach

                                                        {{-- <x-category-option :category="$category"/> --}}
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>


                                        <div class="row gx-3 mb-3">
                                            
                                            <div class="col-md-6">
                                                <label class="small mb-1">E-doc ID</label>
                                                <input class="form-control" type="text" name="subtitle" value="{{ old('subtitle') }}" />
                                            </div>

                                            <div class="col-md-6">
                                                <label class="small mb-1">PDF-fil</label>
                                                <input class="form-control" type="file" name="pdf" />
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1">Brugergrupper</label>
                                                


                                                <select style="width: 100%" id="group" name="group_id[]" multiple  >
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}">{{ $group->name }}</option>                          
                                                    @endforeach
                                                </select>

                                            </div>
                                            
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1">Søgeord</label>
                                                <br>
                                                <input class="form-control" type="text" id="keyword" name="keyword" value="{{ old('keyword') }}"
                                                    data-role="tagsinput" />
                                            </div>
                                            
                                        </div>
                                       
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane  fade show " id="wizard1" role="tabpanel"
                            aria-labelledby="wizard1-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-12 col-xl-12">
        
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-12">
                                                <label class="small mb-1">Teksteditor</label>
                                                <textarea name="editor">{{ old('editor') }}</textarea>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Wizard tab pane item 2-->
                        <div class="tab-pane  fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-12 col-xl-12">
                              
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1">Skal læses ?</label>
                                            <select class="form-control" name="must_read">
                                                <option value="Enabled">Aktiv</option>
                                                <option selected value="Disabled">Deaktiveret</option>
                                            </select>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="small mb-1">Periode</label>
                                            <select class="form-control" name="period">
                                                <option value="1-M">1 mdr.</option>
                                                <option value="3-M">3 mdr.</option>
                                                <option value="6-M">6 mdr.</option>
                                                <option value="1-Y" selected>1 år</option>
                                                <option value="2-Y">2 år</option>
                                                <option value="3-Y">3 år</option>
                                            </select>
                                        </div>



                                    </div>

                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1">Ikon&nbsp; <a target="_blank" href="https://feathericons.com/">https://feathericons.com/</a></label>
                                            <input class="form-control" name="icon" value="file-text" type="text" />
                                        </div>



                                    </div>


                                    {{-- <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Status</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="checkProductNew" type="checkbox"
                                                    value="UnRead" name="status">
                                                <label class="form-check-label" for="checkProductNew">UnRead</label>
                                            </div>
                                        </div>



                                    </div> --}}

                                    
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-xxl-12 col-xl-12">
                                <button class="btn btn-primary w-100 mb-2 mt-2 ml-5 mr-5" type="submit">Opret dokument</button>
                                
                            </div>
                        </div>
                        
                    </div>

                </form>
            </div>


            <div style="padding: 5px 25px !important">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(function() {
            $('input')
                .on('change', function(event) {
                    var $element = $(event.target);
                    var $container = $element.closest('.example');

                    if (!$element.data('tagsinput')) return;

                    var val = $element.val();
                    if (val === null) val = 'null';
                    var items = $element.tagsinput('items');

                    $('code', $('pre.val', $container)).html(
                        $.isArray(val) ?
                        JSON.stringify(val) :
                        '"' + val.replace('"', '\\"') + '"'
                    );
                    $('code', $('pre.items', $container)).html(
                        JSON.stringify($element.tagsinput('items'))
                    );
                })
                .trigger('change');
        });
    </script>









@endsection
