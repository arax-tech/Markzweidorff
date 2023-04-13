<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (auth::check())
        {
            $appAccess = auth::user()->app_access;
            $app_permission = explode(",", $appAccess);
            // dd($app_permission);
            if(in_array("Admin", $app_permission) && in_array("PWA", $app_permission)){
                return redirect('/account');
            }else if(in_array("Admin", $app_permission)){
                return redirect('/dashboard');
            }else if(in_array("PWA", $app_permission)){
                return redirect('/pwa');
            }else{
                return redirect('/pwa');                
            }
        }
    	if ($request->isMethod("POST"))
    	{
    		// dd($request->all());
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'Active']))
            {
                $appAccess = auth::user()->app_access;
                $app_permission = explode(",", $appAccess);
                // dd($app_permission);
                if(in_array("Admin", $app_permission) && in_array("PWA", $app_permission)){
                    return redirect('/account');
                }else if(in_array("Admin", $app_permission)){
                    return redirect('/dashboard');
                }else if(in_array("PWA", $app_permission)){
                    return redirect('/pwa');
                }else{
                    return redirect('/pwa');                
                }
            }
            else if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'Block'])) 
            {
                Auth::logout();
                return redirect()->back()->with('flash_message_error', 'Your account is block, please contact to admin...');
            }
            else
            {
                return redirect()->back()->with('flash_message_error', 'Invalid Email OR Password, Please try Again...');
            }    		
    	}

        

    	return view('login');
    }
}
