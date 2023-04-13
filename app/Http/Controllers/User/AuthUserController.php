<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Schedule;
use App\Document;
use Auth;
use DB;
class AuthUserController extends Controller
{
    public function dashboard()
    {


    	return view('user.dashboard');
    }

    public function account()
    {
        return view('account');
    }


    public function logout()
    {
    	Auth::logout();
    	return redirect('/login')->with('flash_message_success', 'Logout Successfully...');
    }
    public function toggle_sidebar (Request $request)
    {
    	$user = User::find(auth::user()->id);
    	$user->sidebar = $request->sidebar;
    	$user->save();
    	return response()->json($request->sidebar);
    }


}
