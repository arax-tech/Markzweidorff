<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Equipment;
use App\UserNote;
use App\User;
use Auth;
class UserSettingController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return view('user.user.setting.index', compact('user'));
    }

  


    public function status (Request $request, $id)
    {
        // dd($request->all());

        $user = User::find($id);
        $user->status = $request->status;
        $user->who_update_status = auth::user()->id;
        $user->save();
        return redirect()->back()->with('flash_message_success', $request->status.' Successfully...');
    }


    public function permission (Request $request, $id)
    {
        // dd($request->all());

        $user = User::find($id);
        if ($request->permission == null)
        {
            $user->permissions = null;
        }elseif ($request->permission == "All")
        {
            $user->permissions = null;
        }else{
            $user->permissions = implode(",", $request->permission);
        }
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Permission Update Successfully...');
    }

    public function app_access (Request $request, $id)
    {
        // dd($request->all());

        $user = User::find($id);
        $user->app_access = implode(",", $request->permission);
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Access Update Successfully...');
    }

 

    
    
}
