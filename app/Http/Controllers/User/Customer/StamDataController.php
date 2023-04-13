<?php

namespace App\Http\Controllers\User\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\CustomerContact;
use App\UserCourse;
use App\CustomerBank;
use App\CustomerAssociated;
use App\CustomerDocument;
use App\CustomerAssignment;
use App\UserLicense;
use App\CustomerNote;
use App\Equipment;
use App\Customer;
use Auth;
class StamDataController extends Controller
{
    public function index($id)
    {
        $user = Customer::find($id);
        $contacts = CustomerContact::where('user_id', $id)->get();
        $bank = CustomerBank::where('user_id', $id)->first();
        $associateds = CustomerAssociated::where('user_id', $id)->get();
        $licenses = UserLicense::where('user_id', $id)->get();
        $documents = CustomerDocument::where('user_id', $id)->get();
        $notes = CustomerNote::where('user_id', $id)->get();
        return view('user.customer.stamdata.index', compact('contacts','bank', 'associateds','licenses', 'user', 'documents', 'notes'));
    }

    public function assignment_all($id)
    {
        $user = Customer::find($id);
        $contacts = CustomerContact::where('user_id', $id)->get();
        $assignments = CustomerAssignment::where('user_id', $id)->get();
        return view('user.customer.assignment.index', compact('assignments', 'user', 'contacts'));
    }










 

    public function contact_store (Request $request, $id)
    {
        // dd($request->all());     

        $contact = New CustomerContact();
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

        $contact = CustomerContact::find($id);
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
        CustomerContact::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Contact Delete Successfully...');
    }

















    public function bank_store (Request $request, $id)
    {
        // dd($id);  
        $check = CustomerBank::where('user_id', $id)->count();
        if ($check > 0) {
            $bank = CustomerBank::where('user_id', $id)->first();
        }else{
            $bank = New CustomerBank();
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
        CustomerBank::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Bank Delete Successfully...');
    }

















    public function associated_store (Request $request, $id)
    {
        // dd($request->all());     

        $associated = New CustomerAssociated();
        $associated->user_id = $id;
        $associated->name = $request->name;
        $associated->note = $request->note;
        $associated->save();

        return redirect()->back()->with('flash_message_success', 'Associated Create Successfully...');
    }


    public function associated_update (Request $request, $id)
    {
        // dd($request->all()); 
        $associated = CustomerAssociated::find($id);
        $associated->name = $request->name;
        $associated->note = $request->note;
        $associated->save();    

    

        return redirect()->back()->with('flash_message_success', 'Associated Update Successfully...');
    }


    public function associated_delete($id)
    {
        CustomerAssociated::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Associated Delete Successfully...');
    }











    public function assignment_store (Request $request, $id)
    {
        // dd($request->all());     

        $assignment = New CustomerAssignment();
        $assignment->user_id = $id;
        $assignment->contact_person_id = $request->contact_person_id;
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
        $assignment = CustomerAssignment::find($id);
        $assignment->contact_person_id = $request->contact_person_id;
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
        CustomerAssignment::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Assignment Delete Successfully...');
    }











    public function license_store (Request $request, $id)
    {
        // dd($request->all());     

        $license = New UserLicense();
        $license->user_id = $id;
        $license->number = $request->number;       
        $license->type = $request->type;
        $license->expiry = $request->expiry;
        $license->category = $request->category;

        if ($request->hasFile('front_image')) 
        {
            $file1 = 'license-front-'.time().'.'.$request->front_image->extension();
            $request->front_image->storeAs('/stamdata/license/', $file1, 'my_files');
            $license->front_image = $file1;
        }
        else
        {
            $license->front_image = '';
        }


        if ($request->hasFile('back_image')) 
        {
            $file1 = 'license-back-'.time().'.'.$request->back_image->extension();
            $request->back_image->storeAs('/stamdata/license/', $file1, 'my_files');
            $license->back_image = $file1;
        }
        else
        {
            $license->back_image = '';
        }


        $license->save();

        return redirect()->back()->with('flash_message_success', 'License Create Successfully...');
    }


    public function license_update (Request $request, $id)
    {
        // dd($request->all());     

        $license = UserLicense::find($id);
        $license->number = $request->number;       
        $license->type = $request->type;
        $license->expiry = $request->expiry;
        $license->category = $request->category;

        if ($request->hasFile('front_image')) 
        {
            $file1 = 'license-front-'.time().'.'.$request->front_image->extension();
            $request->front_image->storeAs('/stamdata/license/', $file1, 'my_files');
            $license->front_image = $file1;
        }
        else
        {
            $license->front_image = $license->front_image;
        }


        if ($request->hasFile('back_image')) 
        {
            $file1 = 'license-back-'.time().'.'.$request->back_image->extension();
            $request->back_image->storeAs('/stamdata/license/', $file1, 'my_files');
            $license->back_image = $file1;
        }
        else
        {
            $license->back_image = $license->back_image;
        }


        $license->save();

        return redirect()->back()->with('flash_message_success', 'License Update Successfully...');
    }


    public function license_delete($id)
    {
        UserLicense::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'License Delete Successfully...');
    }













    public function employment_update(Request $request, $id)
    {
        // dd($request->all());
        $user = Customer::find($id);
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->type = $request->type;
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Employment Update Successfully...');
    }







    public function update (Request $request, $id)
    {
        // dd($request->all());

        $equipment = Equipment::find($id);
        $equipment->name = $request->name;       
        $equipment->note = $request->note;
        $equipment->status = $request->status;
        $equipment->save();

        return redirect()->back()->with('flash_message_success', 'Equipment Update Successfully...');
    }

    public function delete($id)
    {
        Equipment::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Equipment Delete Successfully...');
    }
    
}
