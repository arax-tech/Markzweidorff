<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;


class PasswordController extends Controller
{

    public function password()
    {
        Check("UserUpdatePassword");
        return view('user.password');

    }
    public function check(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_password'];
        // $check_password = Auth::User()->first();
        if (Hash::check($current_password, Auth::user()->password))
        {
            echo "<p style='color: green'>Current Password is Correct...</p>";
        }
        else
        {
            echo "<p style='color: rgba(244, 12, 67);'> Current Password is Incorrect...</p>";
        }
    }

    public function update_password(Request $request)
    {
        //dd($request->all());
        if (!(Hash::check($request->get('current_password'),Auth::user()->password)))
        {
            return redirect()->back()->with('flash_message_error','Current Password is Incorrect...');
        }

        if (strcmp($request->get('current_password'), $request->get('new_password'))==0)
        {
            return redirect()->back()->with('flash_message_error','Your new password can not be same...');
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->back()->with('flash_message_success','Password Update Successfully...');

    }

    
}
