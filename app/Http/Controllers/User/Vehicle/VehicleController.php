<?php

namespace App\Http\Controllers\User\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Vehicle;
use App\VehicleContact;
use App\UserGroup;
use App\UserLocation;
use App\VehicleMileage;
use App\ToDo;
use Auth;
use Image;
class VehicleController extends Controller
{
    public function index()
    {
        Check("UserView");
        $vehicles = Vehicle::orderBy('name', 'ASC')->get();
        $locations = UserLocation::get();
        // dd($locations);
        return view('user.vehicle.index', compact('vehicles','locations'));
    }

 

    public function remove_profile($id)
    {
        error_reporting(0);
        $user = Vehicle::find($id);
        unlink(public_path().'/backend/profile/'.$user->image);
        $user->image = Null;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Profile Image Removed Successfully...');
    }

    public function profile_picture(Request $request, $id)
    {
        // dd($request->all());
        $user = Vehicle::find($id);
        
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





    public function store (Request $request)
    {
        Check("UserCreate");
        // dd($request->all());

        /*Check Email*/
        $user_count = Vehicle::where('email',$request->email)->count();
        if ($user_count>0)
        {
            return redirect()->back()->with('flash_message_error','Email is Already Taken Please Use Another Email...');
        }

        $user = New Vehicle();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->note = $request->note;
        $user->bank_information = $request->bank_information;
        $user->ice_contact = $request->ice_contact;
        $user->location_id = implode(",", $request->location_id);
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

        return redirect()->back()->with('flash_message_success', 'Vehicle Create Successfully...');
    }


    public function profile($id)
    {
        error_reporting(0);
        // dd($id);
        Check("ViewAuthProfile");
        CheckAuthUser($id, "ViewUserProfile");

        $locations = UserLocation::get();
        $user = Vehicle::find($id);
        $millages = VehicleMileage::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $contacts = VehicleContact::where('user_id', $id)->get();


        $todos = ToDo::where(['user_id' => $id])->get();


        return view('user.vehicle.profile', compact('user', 'locations', 'contacts', 'millages', 'todos'));
    }


   

   

    public function update (Request $request, $id)
    {
        // dd($request->all());

        Check("UpdateAuthProfile");
        CheckAuthUser($id, "UpdateUserProfile");


        $user = Vehicle::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->note = $request->note;
        $user->bank_information = $request->bank_information;
        $user->ice_contact = $request->ice_contact;
        $user->location_id = implode(",", $request->location_id);
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
        $user = Vehicle::find($id);
        
        
        $user->co_line = $request->co_line;
        $user->street_navn = $request->street_navn;
        $user->street_no = $request->street_no;
        $user->street_level = $request->street_level;
        $user->po_code = $request->po_code;
        $user->city_name = $request->city_name;
        $user->country = $request->country;

        $user->save();

        return redirect()->back()->with('flash_message_success', 'Address Update Successfully...');
    }


    public function millage(Request $request, $id)
    {
        // dd($request->all());
        $millage = new VehicleMileage();
        $millage->user_id = $id;
        $millage->who_has_updated = auth::user()->id;
        $millage->date = $request->date;
        $millage->mileage_number = $request->mileage_number;
        $millage->save();
        return redirect()->back()->with('flash_message_success', 'Millage Added Successfully...');
    }


    public function vehicle_store_todo(Request $request, $id)
    {
        $todo = new ToDo();
        $todo->user_id = $id;
        $todo->minisite_id = auth::user()->id;
        $todo->task = $request->task;
        $todo->priority = $request->priority;
        $todo->done = "No";
        $todo->save();
        return redirect()->back()->with('flash_message_success', 'ToDo Create Successfully...');
    }



    public function vehicle_update_todo(Request $request, $id)
    {
        $todo = ToDo::find($id);
        $todo->task = $request->task;
        $todo->priority = $request->priority;
        $todo->save();
        return redirect()->back()->with('flash_message_success', 'ToDo Update Successfully...');
    }


    public function vehicle_done_todo(Request $request, $id)
    {
        $todo = ToDo::find($id);
        $todo->done = "Yes";
        $todo->priority = "Green";
        $todo->save();
        return redirect()->back()->with('flash_message_success', 'ToDo Complete Successfully...');
    }
     
     public function vehicle_delete_todo(Request $request, $id)
    {
        $todo = ToDo::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'ToDo Delete Successfully...');
    }

    public function delete($id)
    {
        Check("UserDelete");
        Vehicle::find($id)->delete();
        return redirect('/vehicle')->with('flash_message_error', 'Vehicle Successfully...');
    }
    
}
