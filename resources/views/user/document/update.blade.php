@extends('user.layouts.app')

@section('title', 'Update Document')
@section('css')
    <style>
        .small {
            color: #31353d !important;
        }

        td {
            vertical-align: middle !important;
        }
    </style>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    </head>
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #0d6efd;
            padding: 0.2rem;
        }

        .bootstrap-tagsinput {
            width: 100% !important;
            height: 43px !important;
            line-height: 35px !important
        }
    </style>


    <style>
        .small { color: #31353d !important; }
        td{vertical-align: middle !important;}
        .chosen-container{width: 100% !important; height: 45px !important}
        .chosen-container-multi .chosen-choices{padding: 7px !important; border: 1px solid #c5ccd6 !important; background-color: #fff !important; border-radius: 5px !important;}
    </style>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
@endsection

@section('content')
   

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 w-100 fixed-top" style="padding-left: 240px !important; top: 58px !important;">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            Update Document
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ url('/wiki/list') }}" >
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back
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
                            <div class="wizard-step-text-name">Basic Setup</div>
                            <div class="wizard-step-text-details">Basic details and information</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Editor Setup</div>
                            <div class="wizard-step-text-details">Editor information</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab"
                        aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Other Details</div>
                            <div class="wizard-step-text-details">Other details and information</div>
                        </div>
                    </a>

                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('/wiki/list/update/'.$document->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content" id="cardTabContent">
                        <!-- Wizard tab pane item 1-->
                        <div class="tab-pane  fade show active" id="wizard0" role="tabpanel"
                            aria-labelledby="wizard1-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-12 col-xl-12">
                                    <h3 class="text-primary">Step 1</h3>
                                    <h5 class="card-title mb-4">Basic Information</h5>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1">Title</label>
                                            <input class="form-control" type="text" name="title" value="{{ $document->title }}" />
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1">Select Category</label>
                                            <select class="form-control" name="category">
                                                <option value="">Choose...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($document->category == $category->id)
                                                            selected 
                                                        @endif
                                                    >{{ $category->name }}</option>

                                                    {{-- Level 2 --}}
                                                    @php
                                                        error_reporting(0);
                                                        $level2s = DB::table('categories')->where('parent_id', $category->id)->get();
                                                    @endphp
                                                    @foreach ($level2s as $level2)
                                                        <option value="{{ $level2->id }}"
                                                            @if ($document->category == $level2->id)
                                                                selected 
                                                            @endif
                                                        >--{{ $level2->name }}</option>


                                                        {{-- Level 3 --}}
                                                        @php
                                                            error_reporting(0);
                                                            $level3s = DB::table('categories')->where('parent_id', $level2->id)->get();
                                                        @endphp
                                                        @foreach ($level3s as $level3)
                                                            <option value="{{ $level3->id }}"
                                                                @if ($document->category == $level3->id)
                                                                    selected 
                                                                @endif
                                                            >----{{ $level3->name }}</option>



                                                            {{-- Level 4 --}}
                                                            @php
                                                                error_reporting(0);
                                                                $level4s = DB::table('categories')->where('parent_id', $level3->id)->get();
                                                            @endphp
                                                            @foreach ($level4s as $level4)
                                                                <option value="{{ $level4->id }}"
                                                                    @if ($document->category == $level4->id)
                                                                        selected 
                                                                    @endif
                                                                >------{{ $level4->name }}</option>

                                                                {{-- Level 5 --}}
                                                                @php
                                                                    error_reporting(0);
                                                                    $level5s = DB::table('categories')->where('parent_id', $level4->id)->get();
                                                                @endphp
                                                                @foreach ($level5s as $level5)
                                                                    <option value="{{ $level5->id }}"
                                                                        @if ($document->category == $level5->id)
                                                                            selected 
                                                                        @endif
                                                                    >--------{{ $level5->name }}</option>


                                                                    {{-- Level 6 --}}
                                                                    @php
                                                                        error_reporting(0);
                                                                        $level6s = DB::table('categories')->where('parent_id', $level5->id)->get();
                                                                    @endphp
                                                                    @foreach ($level6s as $level6)
                                                                        <option value="{{ $level6->id }}"
                                                                            @if ($document->category == $level6->id)
                                                                                selected 
                                                                            @endif
                                                                        >----------{{ $level6->name }}</option>
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
                                            <label class="small mb-1">SubTitle</label>
                                            <input class="form-control" type="text" name="subtitle" value="{{ $document->subtitle }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1">PDF</label>
                                            <input class="form-control" type="file" name="pdf" />
                                        </div>


                                    </div>

                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            @php
                                                error_reporting(0);
                                                $groups_idss = $document->group_id;
                                                $arrs = explode(",", $groups_idss);
                                                
                                                
                                            @endphp


                                            <label class="small mb-1">Select Groups</label>
                                            <select style="width: 100%" class="group" name="group_id[]" multiple required >
                                                @foreach ($groups as $group)
                                                    <option value="{{ $group->id }}"
                                                        @if (in_array($group->id, $arrs))
                                                            selected 
                                                        @endif
                                                    >{{ $group->name }}</option>                          
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Keyword</label>
                                            <br>
                                            <input class="form-control" type="text" id="keyword" name="keyword" value="{{ $document->keyword }}" 
                                                data-role="tagsinput" />
                                        </div>



                                        


                                        


                                    </div>

                                    
                                </div>
                            </div>
                        </div>



                        <div class="tab-pane  fade show" id="wizard1" role="tabpanel"
                            aria-labelledby="wizard1-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-12 col-xl-12">
                                    <h3 class="text-primary">Step 2</h3>
                                    <h5 class="card-title mb-4">Editor Information</h5>
                                    

                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Editor</label>
                                            <textarea name="editor">{{ $document->editor }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Wizard tab pane item 2-->
                        <div class="tab-pane  fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                            <div class="row justify-content-center">
                                <div class="col-xxl-12 col-xl-12">
                                    <h3 class="text-primary">Step 3</h3>
                                    <h5 class="card-title mb-4">Other details and information</h5>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Must Read ?</label>
                                            <select class="form-control" name="must_read">
                                                <option value="Enabled"
                                                @if ($document->must_read == "Enabled")
                                                    selected 
                                                @endif
                                                >Enabled</option>
                                                <option value="Disabled"
                                                @if ($document->must_read == "Disabled")
                                                    selected 
                                                @endif
                                                >Disabled</option>
                                            </select>
                                        </div>



                                    </div>


                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Period</label>
                                            <input class="form-control" name="period" value="{{ $document->period }}" type="text" />
                                        </div>



                                    </div>

                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Icon&nbsp; <a target="_blank" href="https://feathericons.com/">https://feathericons.com/</a></label>
                                            <input class="form-control" name="icon" value="{{ $document->icon }}" type="text" />
                                        </div>



                                    </div>


                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-12">
                                            <label class="small mb-1">Status</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" id="checkProductNew" type="checkbox"
                                                    value="UnRead" name="status">
                                                <label class="form-check-label" for="checkProductNew">UnRead</label>
                                            </div>
                                        </div>



                                    </div>

                                    
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-xxl-12 col-xl-12">
                                <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Update
                                        Document</button>
                                
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



    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
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
