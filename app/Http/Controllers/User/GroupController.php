<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserGroup;
use App\User;

class GroupController extends Controller
{
    public function index()
    {
        Check("UserGroupView");
        $groups = UserGroup::get();
        return view('user.group.index', compact('groups'));
    }

 

    public function store (Request $request)
    {
        $group = New UserGroup();
        $group->name = $request->name;        
        $group->background = $request->background;        
        $group->color = $request->color;        
        $group->save();
        return redirect()->back()->with('flash_message_success', 'Group Create Successfully');
    }


    public function update (Request $request, $id)
    {
        // dd($request->all());

        $group = UserGroup::find($id);
        $group->name = $request->name;        
        $group->background = $request->background;        
        $group->color = $request->color;        
        $group->save();
        return redirect()->back()->with('flash_message_success', 'Group Update Successfully');
    }

    public function delete($id)
    {
        UserGroup::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Group Delete Successfully');
    }
    
}
