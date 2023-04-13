<?php

namespace App\Http\Controllers\User\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Equipment;
use App\CustomerDocument;
use App\DocumentStatus;
use App\Document;
use App\Customer;
use Auth;
class CustomerDocumentController extends Controller
{
    public function index($id)
    {
        $user = Customer::find($id);
        $documents = CustomerDocument::where('user_id', $id)->get();
        return view('user.customer.document.index', compact('documents', 'user'));
    }

    public function wiki($id)
    {
        $user = Customer::find($id);
        $documentsStatus = DocumentStatus::where(['status' => 'Read', 'user_id' => $user->id])->pluck('document_id');
        $documentsStatus = DocumentStatus::where(['status' => 'Read', 'user_id' => $user->id])->pluck('document_id');
        // dd($documentsStatus);
        $documents = Document::whereIn('id', $documentsStatus)->get();
        // dd($documents);
        return view('user.customer.list', compact('documents', 'user'));
    }

 

    public function store (Request $request, $id)
    {
        // dd($request->all());     

        $document = New CustomerDocument();
        $document->user_id = $id;
        $document->admin_id = auth::user()->id;
        $document->title = $request->title;       
        $document->visibility = $request->visibility;
        $document->status = "UnRead";

        $random8 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));
        $random4 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4A = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4B = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random12 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12));
        $unique_id = $random8."-".$random4."-".$random4A."-".$random4B."-".$random12;
        
        if ($request->hasFile('document')) 
        {
            $file1 = $unique_id.'.'.$request->document->extension();
            $request->document->storeAs('/documents/user/', $file1, 'my_files');
            $document->document = $file1;
        }
        else
        {
            $document->document = '';
        }


        $document->save();

        return redirect()->back()->with('flash_message_success', 'Document Create Successfully...');
    }


    public function update (Request $request, $id)
    {
        // dd($request->all());

        $document = CustomerDocument::find($id);
        $document->title = $request->title;       
        $document->visibility = $request->visibility;

        $random8 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));
        $random4 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4A = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4B = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random12 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12));
        $unique_id = $random8."-".$random4."-".$random4A."-".$random4B."-".$random12;
        
        if ($request->hasFile('document')) 
        {
            $file1 = $unique_id.'.'.$request->document->extension();
            $request->document->storeAs('/documents/user/', $file1, 'my_files');
            $document->document = $file1;
        }
        else
        {
            $document->document = $document->document;
        }


        $document->save();

        return redirect()->back()->with('flash_message_success', 'Document Update Successfully...');
    }



    public function signle_reset($document_id, $user_id)
    {
        DocumentStatus::where(['document_id' => $document_id, 'user_id' => $user_id])->delete();
        return redirect()->back()->with('flash_message_success', 'Status Reset Successfully...');
    }

    public function all_reset($user_id)
    {
        // dd($user_id);
        DocumentStatus::where(['user_id' => $user_id])->delete();
        return redirect()->back()->with('flash_message_success', 'All Status Reset Successfully...');
    }


    public function delete($id)
    {
        CustomerDocument::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Document Delete Successfully...');
    }
    
}
