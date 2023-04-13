<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Category;
use App\Setting;
use App\User;

class SettingController extends Controller
{
    public function setting($id = 1)
    {
        Check("AdminSettingView");
        $setting = Setting::find(1);
        return view('user.setting.index', compact('setting'));
    }

 

    public function update (Request $request)
    {
        
        // dd($request->all());
        

        $setting = Setting::find(1);
        $setting->welcome_heading = $request->welcome_heading;
        $setting->welcome_sub_heading = $request->welcome_sub_heading;
        $setting->status_reciving_email = $request->status_reciving_email;
        $setting->copyright = $request->copyright;
        if ($request->hasFile('logo')) 
        {
            if ($setting->logo != null)
            {
                unlink(public_path().'/backend/logo/'.$setting->logo);
            }
            
            $file1 = 'logo-'.time().'.'.$request->logo->extension();
            $request->logo->storeAs('/logo/', $file1, 'my_files');
            $setting->logo = $file1;
        }
        else
        {
            $setting->logo = $setting->logo;
        }
        $setting->save();

        return redirect()->back()->with('flash_message_success', 'Setting Update Successfully...');
    }
    
    
}
