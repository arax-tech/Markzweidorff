<?php

namespace App\Http\Controllers\User\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Equipment;
use App\CustomerNote;
use App\Customer;
use Auth;
class CustomerNoteController extends Controller
{
    public function index($id)
    {
        // dd($id);
        $user = Customer::find($id);
        // dd($user);
        $notes = CustomerNote::where('user_id', $id)->get();
        return view('user.customer.note.index', compact('notes', 'user'));
    }

    public function edit($user_id, $id)
    {
        $user = Customer::find($user_id);
        $note = CustomerNote::find($id);
        return view('user.customer.note.update', compact('note', 'user'));
    }

    public function store (Request $request, $id)
    {
        // dd($request->all());     

        $note = New CustomerNote();
        $note->user_id = $id;
        $note->admin_id = auth::user()->id;
        $note->title = $request->title;       
        $note->content = $request->content;       
        $note->save();

        return redirect()->back()->with('flash_message_success', 'Note Create Successfully...');
    }


    public function update (Request $request, $user_id, $id)
    {
        // dd($request->all());

        $note = CustomerNote::find($id);
        $note->title = $request->title;       
        $note->content = $request->content;       
        $note->save();
        

        return redirect('/customer/stamdata/'.$user_id)->with('flash_message_success', 'Note Update Successfully...');
    }

    public function delete($id)
    {
        CustomerNote::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Note Delete Successfully...');
    }
    
}
