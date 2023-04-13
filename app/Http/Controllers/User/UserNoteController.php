<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Equipment;
use App\UserNote;
use App\User;
use Auth;
class UserNoteController extends Controller
{
    public function index($id)
    {
        // dd($id);
        $user = User::find($id);
        // dd($user);
        $notes = UserNote::where('user_id', $id)->get();
        return view('user.user.note.index', compact('notes', 'user'));
    }

    public function edit($user_id, $id)
    {
        $user = User::find($user_id);
        $note = UserNote::find($id);
        return view('user.user.note.update', compact('note', 'user'));
    }

    public function store (Request $request, $id)
    {
        // dd($request->all());     

        $note = New UserNote();
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

        $note = UserNote::find($id);
        $note->title = $request->title;       
        $note->content = $request->content;       
        $note->save();
        

        return redirect('/user/note/'.$user_id)->with('flash_message_success', 'Note Update Successfully...');
    }

    public function delete($id)
    {
        UserNote::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Note Delete Successfully...');
    }
    
}
