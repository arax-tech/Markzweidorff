<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\User;
use App\UserLocation;
use App\UserGroup;
use Auth;
use Image;
use DB;
class UserController extends Controller
{
    public function index()
    {
        Check("UserView");
        $users = User::where('role', 'User')->orderBy('name', 'ASC')->get();
        $groups = UserGroup::get();
        return view('user.user.index', compact('users','groups'));
    }

 

    public function remove_profile($id)
    {
        error_reporting(0);
        $user = User::find($id);
        unlink(public_path().'/backend/profile/'.$user->image);
        $user->image = Null;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Profile Image Removed Successfully...');
    }

    public function profile_picture(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        
        if ($request->profile_cover_base64 || $request->profile_cover_base64 != '0') {

            if ($user->image != null)
            {
                error_reporting(0);
                unlink(public_path().'/backend/profile/'.$user->image);
            }


            $folderPath = 'backend/profile/';
            
            $base64Image = explode(";base64,", $request->profile_cover_base64);
            $explodeImage = explode("image/", $base64Image[0]);
            $imageType = $explodeImage[1];
            $image_base64 = base64_decode($base64Image[1]);
            $file = "profile-".time() . '.'.$imageType;
            
            file_put_contents(public_path().'/backend/profile/'.$file, $image_base64);


            $user->image = $file;
        }
        else
        {
            $user->image = $user->image;
        }


        $user->save();
        return redirect()->back()->with('flash_message_success', 'Profile Image Updated Successfully...');
    }


    public function profile_note(Request $request, $id)
    {
        // dd($request->all());
        $user = User::find($id);
        $user->profile_note = $request->profile_note;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Note Updated Successfully...');
    }





    public function store (Request $request)
    {
        Check("UserCreate");
        // dd($request->all());

        /*Check Email*/
        $user_count = User::where('email',$request->email)->count();
        if ($user_count>0)
        {
            return redirect()->back()->with('flash_message_error','Email is Already Taken Please Use Another Email...');
        }

        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->note = $request->note;
        $user->role = "User";
        $user->bank_information = $request->bank_information;
        $user->ice_contact = $request->ice_contact;
        $user->group_id = implode(",", $request->group_id);
        $user->employment_date = $request->employment_date;
        $user->status = "Active";
        $user->work_title = $request->work_title;

        if ($request->hasFile('profile')) 
        {
            $file1 = 'user-'.time().'.'.$request->profile->extension();
            $request->profile->storeAs('/profile/', $file1, 'my_files');
            $user->image = $file1;
        }
        else
        {
            $user->image = '';
        }

        $user->save();

        if ($request->ViewProfile) {
            $user_id = DB::getPdo()->lastInsertId();
            return redirect('/user/view/'.$user_id)->with('flash_message_success', 'User Create Successfully...');
        }else{
            return redirect()->back()->with('flash_message_success', 'User Create Successfully...');
        }

    }


    public function profile($id)
    {
        Check("ViewAuthProfile");
        CheckAuthUser($id, "ViewUserProfile");

        $groups = UserGroup::get();
        $locations = UserLocation::get();
        $user = User::find($id);
        
        $response = Http::get('https://nominatim.openstreetmap.org/search?q='.$user->street_no.'+'.$user->street_navn.',+'.$user->city_name.'&format=json&polygon=1&addressdetails=1') ;




        return view('user.user.profile', compact('user', 'groups', 'response', 'locations'));
    }


    public function map($id)
    {

        $groups = UserGroup::get();
        $user = User::find($id);
        
        $response = Http::get('https://nominatim.openstreetmap.org/search?q='.$user->street_no.'+'.$user->street_navn.',+'.$user->city_name.'&format=json&polygon=1&addressdetails=1') ;
        
        return view('user.user.map', compact('user', 'groups', 'response'));
    }

   

    public function update (Request $request, $id)
    {
        // dd($request->all());

        Check("UpdateAuthProfile");
        CheckAuthUser($id, "UpdateUserProfile");


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->note = $request->note;
        $user->bank_information = $request->bank_information;
        $user->ice_contact = $request->ice_contact;
        $user->group_id = implode(",", $request->group_id);
        $user->employment_date = $request->employment_date;
        $user->work_title = $request->work_title;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Profile Update Successfully...');
    }

    public function update_adderss (Request $request, $id)
    {
        // dd($request->all());
        Check("UpdateAuthProfile");
        CheckAuthUser($id, "UpdateUserProfile");
        $user = User::find($id);
        
        
        $user->co_line = $request->co_line;
        $user->street_navn = $request->street_navn;
        $user->street_no = $request->street_no;
        $user->street_level = $request->street_level;
        $user->po_code = $request->po_code;
        $user->city_name = $request->city_name;
        $user->country = $request->country;
        $user->location_id = implode(",", $request->location_id);

        $user->save();

        return redirect()->back()->with('flash_message_success', 'Address Update Successfully...');
    }

    public function delete($id)
    {
        Check("UserDelete");
        User::find($id)->delete();
        return redirect('/user')->with('flash_message_error', 'Account Successfully...');
    }
    
}
