<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{
    public function index()
    {
        Check("UserManageCategoryView");
        $categories = Category::whereNull('parent_id')->with('children')->get();

        // dd($categories)
        // $categories = json_encode(json_decode($categories));
        // echo "<pre>"; print_r($categories);  die();
     

        return view('user.category.index', compact('categories'));
    }

    private static function formatCategory($categories, $allCategories)
    {
        foreach ($categories as $category)
        {
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty())
            {
                self::formatCategory($category->children, $allCategories);
            }
        }
    }


    public function getSubCategories($id)
    {
        $categories = DB::table('categories')->where('parent_id',$id)->pluck('name','id');
        return json_encode($categories);
    }





 

    public function store (Request $request)
    {
       
        $category = New Category();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;       
        $category->description = $request->description;
        $category->icon = $request->icon;
        $category->save();

        return redirect()->back()->with('flash_message_success', 'Category Create Successfully...');
    }


    public function update (Request $request, $id)
    {
        // dd($request->all());
        $category = Category::find($id);
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;       
        $category->description = $request->description;       
        $category->icon = $request->icon;
        $category->save();

        return redirect()->back()->with('flash_message_success', 'Category Update Successfully...');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Category Delete Successfully...');
    }
    
}
