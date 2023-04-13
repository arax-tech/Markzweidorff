
<div>
    <option value="{{ $category->id }}">{{ $category->name }}</option>
    @foreach ($category->children as $child)
    	<x-category-option :category="$child"/>
    @endforeach
</div>
