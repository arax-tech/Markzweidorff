<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserLocation;
use App\User;

class LoactionController extends Controller
{
    public function index()
    {
        Check("UserLocationView");
        $locations = UserLocation::get();
        return view('user.user.location.index', compact('locations'));
    }

 

    public function store (Request $request)
    {
        $location = New UserLocation();
        $location->location = $request->location;        
        $location->save();
        return redirect()->back()->with('flash_message_success', 'Location Create Successfully');
    }


    public function update (Request $request, $id)
    {
        // dd($request->all());

        $location = UserLocation::find($id);
        $location->location = $request->location;        
        $location->save();
        return redirect()->back()->with('flash_message_success', 'Location Update Successfully');
    }

    public function delete($id)
    {
        UserLocation::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Location Delete Successfully');
    }
    
}
