@php
	use App\Category;

	$categories = Category::get();


    $array = auth::user()->permissions;
    $permission = explode(",", $array);
@endphp
<div>
    <div class="bg-light text-dark shadow-sm rounded px-4 py-3 mb-2">
    	<div class="row">
    	    <div class="col-md-5 d-flex align-items-center">
    	        <i data-feather="{{ $category->icon }}"></i>&nbsp;{{ $category->name }}
    	    </div>
    	    <div class="col-md-5">
    	        
    	     {{ $category->description }}
    	    </div>
    	    <div class="col-md-2 float-end" style="float: right !important;">
                @if (in_array("All", $permission) OR in_array("UserManageCategoryUpdate", $permission))
                    <a class="btn btn-datatable shadow-sm ml-5 btn-icon text-dark me-2 float-end" href="javascript::"  data-bs-toggle="modal" data-bs-target="#UpdateCategory{{ $category->id }}"><i data-feather="edit"></i></a>
                @endif

                @if (in_array("All", $permission) OR in_array("UserManageCategoryDelete", $permission))
    	           <a onclick="return confirm('Er du sikker på at du vil slette denne kategori ?')" class="btn btn-datatable shadow-sm ml-5 btn-icon text-dark float-end" href="{{ url('/category/delete/'.$category->id) }}"><i data-feather="trash-2"></i></a>
                @endif
    	    </div>
    	</div>



    	<div class="modal fade" id="UpdateCategory{{ $category->id }}">
    	    <div class="modal-dialog modal-lg modal-dialog-centered">
    	        <div class="modal-content">
    	            <div class="modal-header bg-light">
    	                <h5 class="modal-title">Rediger kategori</h5>
    	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    	            </div>
    	            <div class="modal-body">
    	                <form method="post" action="{{ url('/category/update/'.$category->id) }}">
    	                    @csrf


    	                  

    	                    @if ($category->parent_id != null)
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1">Placering</label>
                                        <select class="form-control" name="parent_id">
                                            <option value="">Vælg...</option>


                                            {{-- @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    @if ($cat->id == $category->id)
                                                        selected 
                                                    @endif
                                                >{{ $cat->name }}</option>

                                                @php
                                                    error_reporting(0);
                                                    $level2s = DB::table('categories')->where('parent_id', $cat->id)->get();
                                                @endphp
                                                @foreach ($level2s as $level2)
                                                    <option value="{{ $level2->id }}"
                                                        @if ($level2->id == $category->id)
                                                            selected 
                                                        @endif
                                                    >--{{ $level2->name }}</option>


                                                    @php
                                                        error_reporting(0);
                                                        $level3s = DB::table('categories')->where('parent_id', $level2->id)->get();
                                                    @endphp
                                                    @foreach ($level3s as $level3)
                                                        <option value="{{ $level3->id }}"
                                                            @if ($level3->id == $category->id)
                                                                selected 
                                                            @endif
                                                        >----{{ $level3->name }}</option>



                                                        @php
                                                            error_reporting(0);
                                                            $level4s = DB::table('categories')->where('parent_id', $level3->id)->get();
                                                        @endphp
                                                        @foreach ($level4s as $level4)
                                                            <option value="{{ $level4->id }}"
                                                                @if ($level4->id == $category->id)
                                                                    selected 
                                                                @endif
                                                            >------{{ $level4->name }}</option>

                                                            @php
                                                                error_reporting(0);
                                                                $level5s = DB::table('categories')->where('parent_id', $level4->id)->get();
                                                            @endphp
                                                            @foreach ($level5s as $level5)
                                                                <option value="{{ $level5->id }}"
                                                                    @if ($level5->id == $category->id)
                                                                        selected 
                                                                    @endif
                                                                >--------{{ $level5->name }}</option>


                                                                @php
                                                                    error_reporting(0);
                                                                    $level6s = DB::table('categories')->where('parent_id', $level5->id)->get();
                                                                @endphp
                                                                @foreach ($level6s as $level6)
                                                                    <option value="{{ $level6->id }}"
                                                                        @if ($level6->id == $category->id)
                                                                            selected 
                                                                        @endif
                                                                    >----------{{ $level6->name }}</option>
                                                                @endforeach
                                                            @endforeach

                                                        @endforeach
                                                    @endforeach
                                                @endforeach

                                                <x-category-option :category="$cat"/> 
                                            @endforeach --}}
                    
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    @if ($cat->id == $category->parent_id)
                                                        selected 
                                                    @endif
                                                >{{ $cat->name }}</option>
                                            @endforeach
                                            
                                        </select>

                                    </div>

                                    
                                </div>
                            @endif


    	                    <div class="row gx-3 mb-3">
    	                        <div class="col-md-6">
    	                            <label class="small mb-1">Kategori navn</label>
    	                            <input class="form-control" type="text" name="name" value="{{ $category->name }}" required />
    	                        </div>

    	                        <div class="col-md-6">
    	                            <label class="small mb-1">Ikon</label>
    	                            <input class="form-control" type="text" name="icon" value="{{ $category->icon }}" required />
    	                        </div>

    	                        

    	                        
    	                    </div>     

    	                    <div class="row gx-3 mb-3">
    	                        <div class="col-md-12">
    	                            <label class="small mb-1">Beskrivelse</label>
    	                            <textarea class="form-control" name="description" >{{ $category->description }}</textarea>
    	                        </div>
    	                        
    	                    </div>                                                 




    	                    <!-- Save changes button-->
    	                    <button class="btn btn-primary w-100 mb-2 mt-1" type="submit">Opdater kategori</button>
    	                </form>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    	
    </div>
    @foreach ($category->children as $child)
        <div class="ml-5">
            <x-category-item :category="$child"/>
        </div>
    @endforeach
</div>
