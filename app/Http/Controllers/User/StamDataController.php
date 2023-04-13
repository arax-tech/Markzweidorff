<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserAuthorization;
use App\UserContact;
use App\UserCourse;
use App\UserBank;
use App\UserAssociated;
use App\UserLicense;
use App\Equipment;
use App\User;
use Auth;
class StamDataController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $contacts = UserContact::where('user_id', $id)->get();
        $courses = UserCourse::where('user_id', $id)->get();
        $bank = UserBank::where('user_id', $id)->first();
        $associateds = UserAssociated::where('user_id', $id)->get();
        $licenses = UserLicense::where('user_id', $id)->get();
        $authorizations = UserAuthorization::where('user_id', $id)->get();
        return view('user.user.stamdata.index', compact('contacts', 'courses', 'bank', 'associateds','licenses', 'user', 'authorizations'));
    }










 

    public function contact_store (Request $request, $id)
    {
        // dd($request->all());     

        $contact = New UserContact();
        $contact->user_id = $id;
        $contact->name = $request->name;       
        $contact->phone = $request->phone;
        $contact->relation = $request->relation;
        $contact->save();

        return redirect()->back()->with('flash_message_success', 'Contact Create Successfully...');
    }


    public function contact_update (Request $request, $id)
    {
        // dd($request->all());     

        $contact = UserContact::find($id);
        $contact->name = $request->name;       
        $contact->phone = $request->phone;
        $contact->relation = $request->relation;
        $contact->save();

        return redirect()->back()->with('flash_message_success', 'Contact Update Successfully...');
    }


    public function contact_delete($id)
    {
        UserContact::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Contact Delete Successfully...');
    }






    public function authorization_store (Request $request, $id)
    {
        // dd($request->all());     

        $authorization = New UserAuthorization();
        $authorization->user_id = $id;
        $authorization->auth_id = $request->auth_id;       
        $authorization->subject_group = $request->subject_group;
        $authorization->thesis = $request->thesis;
        $authorization->last_validate = $request->last_validate;
        $authorization->save();

        return redirect()->back()->with('flash_message_success', 'Authorization Create Successfully...');
    }


    public function authorization_update (Request $request, $id)
    {
        // dd($request->all());     

        $authorization = UserAuthorization::find($id);
        // $authorization->auth_id = $request->auth_id;       
        // $authorization->subject_group = $request->subject_group;
        $authorization->thesis = $request->thesis;
        $authorization->last_validate = $request->last_validate;
        $authorization->save();

        return redirect()->back()->with('flash_message_success', 'Authorization Update Successfully...');
    }

    public function authorization_validate (Request $request, $id)
    {
        // dd($request->all());     

        $authorization = UserAuthorization::find($id);
        $authorization->last_validate_by = auth::user()->id;       
        $authorization->last_validate = date('d M Y, H:i');
        $authorization->save();

        return redirect()->back()->with('flash_message_success', 'Authorization Update Successfully...');
    }


    public function authorization_delete($id)
    {
        UserAuthorization::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Authorization Delete Successfully...');
    }











    public function course_store (Request $request, $id)
    {
        // dd($request->all());     

        $cose = New UserCourse();
        $cose->user_id = $id;
        $cose->title = $request->title;       
        $cose->date = $request->date;
        $cose->expiry = $request->expiry;

        if ($request->hasFile('document')) 
        {
            $file1 = 'document-'.time().'.'.$request->document->extension();
            $request->document->storeAs('/stamdata/course/', $file1, 'my_files');
            $cose->document = $file1;
        }
        else
        {
            $cose->document = '';
        }


        $cose->save();

        return redirect()->back()->with('flash_message_success', 'Cose Create Successfully...');
    }


    public function course_update (Request $request, $id)
    {
        // dd($request->all());     

        $cose = UserCourse::find($id);
        $cose->title = $request->title;       
        $cose->date = $request->date;
        $cose->expiry = $request->expiry;

        if ($request->hasFile('document')) 
        {
            $file1 = 'document-'.time().'.'.$request->document->extension();
            $request->document->storeAs('/stamdata/course/', $file1, 'my_files');
            $cose->document = $file1;
        }
        else
        {
            $cose->document = $cose->document;
        }


        $cose->save();
        return redirect()->back()->with('flash_message_success', 'Cose Update Successfully...');
    }


    public function course_delete($id)
    {
        UserCourse::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Cose Delete Successfully...');
    }













    public function bank_store (Request $request, $id)
    {
        // dd($id);  
        $check = UserBank::where('user_id', $id)->count();
        if ($check > 0) {
            $bank = UserBank::where('user_id', $id)->first();
        }else{
            $bank = New UserBank();
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
        UserBank::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Bank Delete Successfully...');
    }

















    public function associated_store (Request $request, $id)
    {
        // dd($request->all());     

        $associated = New UserAssociated();
        $associated->user_id = $id;
        $associated->name = $request->name;
        $associated->note = $request->note;
        $associated->save();

        return redirect()->back()->with('flash_message_success', 'Associated Create Successfully...');
    }


    public function associated_update (Request $request, $id)
    {
        // dd($request->all()); 
        $associated = UserAssociated::find($id);
        $associated->name = $request->name;
        $associated->note = $request->note;
        $associated->save();    

    

        return redirect()->back()->with('flash_message_success', 'Associated Update Successfully...');
    }


    public function associated_delete($id)
    {
        UserAssociated::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Associated Delete Successfully...');
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
        $user = User::find($id);
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->type = $request->type;
        $user->birthday_cdr_control = $request->birthday_cdr_control;
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
