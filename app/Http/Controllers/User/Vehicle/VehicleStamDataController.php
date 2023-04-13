<?php

namespace App\Http\Controllers\User\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\VehicleContact;
use App\UserCourse;
use App\VehicleBank;
use App\VehicleAssociated;
use App\VehicleAssignment;
use App\Vehicle;
use Auth;
class VehicleStamDataController extends Controller
{
    public function index($id)
    {
        $user = Vehicle::find($id);
        $contacts = VehicleContact::where('user_id', $id)->get();
        $assignments = VehicleAssignment::where('user_id', $id)->get();
        $bank = VehicleBank::where('user_id', $id)->first();
        $associateds = VehicleAssociated::where('user_id', $id)->get();
        return view('user.vehicle.stamdata.index', compact('contacts', 'assignments', 'bank', 'associateds', 'user'));
    }










 

    public function contact_store (Request $request, $id)
    {
        // dd($request->all());     

        $contact = New VehicleContact();
        $contact->user_id = $id;
        $contact->name = $request->name;       
        $contact->phone = $request->phone;
        $contact->email = $request->email;

        if ($request->hasFile('picture')) 
        {
            $file1 = 'contact-'.time().'.'.$request->picture->extension();
            $request->picture->storeAs('/stamdata/contact/', $file1, 'my_files');
            $contact->picture = $file1;
        }
        else
        {
            $contact->picture = '';
        }


        $contact->position = $request->position;
        $contact->save();

        return redirect()->back()->with('flash_message_success', 'Contact Create Successfully...');
    }


    public function contact_update (Request $request, $id)
    {
        // dd($request->all());     

        $contact = VehicleContact::find($id);
        $contact->name = $request->name;       
        $contact->phone = $request->phone;
        $contact->email = $request->email;

        if ($request->hasFile('picture')) 
        {
            $file1 = 'contact-'.time().'.'.$request->picture->extension();
            $request->picture->storeAs('/stamdata/contact/', $file1, 'my_files');
            $contact->picture = $file1;
        }
        else
        {
            $contact->picture = $contact->picture;
        }


        $contact->position = $request->position;
        $contact->save();

        return redirect()->back()->with('flash_message_success', 'Contact Update Successfully...');
    }


    public function contact_delete($id)
    {
        VehicleContact::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Contact Delete Successfully...');
    }

















    public function bank_store (Request $request, $id)
    {
        // dd($id);  
        $check = VehicleBank::where('user_id', $id)->count();
        if ($check > 0) {
            $bank = VehicleBank::where('user_id', $id)->first();
        }else{
            $bank = New VehicleBank();
        }
        $bank->user_id = $id;
        $bank->payrol_number = $request->payrol_number;
        $bank->bank_name = $request->bank_name;
        $bank->rit_number = $request->rit_number;
        $bank->account_number = $request->account_number;
        $bank->swift_number = $request->swift_number;
        $bank->save();

        return redirect()->back()->with('flash_message_success', 'Bank Update Successfully...');
    }


 

    public function bank_delete($id)
    {
        VehicleBank::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Bank Delete Successfully...');
    }

















    public function associated_store (Request $request, $id)
    {
        // dd($request->all());     

        $associated = New VehicleAssociated();
        $associated->user_id = $id;
        $associated->name = $request->name;
        $associated->note = $request->note;
        $associated->save();

        return redirect()->back()->with('flash_message_success', 'Associated Create Successfully...');
    }


    public function associated_update (Request $request, $id)
    {
        // dd($request->all()); 
        $associated = VehicleAssociated::find($id);
        $associated->name = $request->name;
        $associated->note = $request->note;
        $associated->save();    

    

        return redirect()->back()->with('flash_message_success', 'Associated Update Successfully...');
    }


    public function associated_delete($id)
    {
        VehicleAssociated::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Associated Delete Successfully...');
    }











    public function assignment_store (Request $request, $id)
    {
        // dd($request->all());     

        $assignment = New VehicleAssignment();
        $assignment->user_id = $id;
        $assignment->name = $request->name;
        $assignment->co_line = $request->co_line;
        $assignment->street_navn = $request->street_navn;
        $assignment->street_no = $request->street_no;
        $assignment->street_level = $request->street_level;
        $assignment->po_code = $request->po_code;
        $assignment->city_name = $request->city_name;
        $assignment->country = $request->country;
        $assignment->information = $request->information;
        $assignment->status = $request->status;
        $assignment->save();

        return redirect()->back()->with('flash_message_success', 'Assignment Create Successfully...');
    }


    public function assignment_update (Request $request, $id)
    {
        // dd($request->all()); 
        $assignment = VehicleAssignment::find($id);
        $assignment->name = $request->name;
        $assignment->co_line = $request->co_line;
        $assignment->street_navn = $request->street_navn;
        $assignment->street_no = $request->street_no;
        $assignment->street_level = $request->street_level;
        $assignment->po_code = $request->po_code;
        $assignment->city_name = $request->city_name;
        $assignment->country = $request->country;
        $assignment->information = $request->information;
        $assignment->status = $request->status;
        $assignment->save();    

    

        return redirect()->back()->with('flash_message_success', 'Assignment Update Successfully...');
    }


    public function assignment_delete($id)
    {
        VehicleAssignment::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Assignment Delete Successfully...');
    }
















    public function employment_update(Request $request, $id)
    {
        // dd($request->all());
        $user = Vehicle::find($id);
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->type = $request->type;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Employment Update Successfully...');
    }





    
}
