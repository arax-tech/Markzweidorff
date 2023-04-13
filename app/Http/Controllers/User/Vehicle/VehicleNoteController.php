<?php

namespace App\Http\Controllers\User\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Equipment;
use App\VehicleNote;
use App\Vehicle;
use Auth;
class VehicleNoteController extends Controller
{
    public function index($id)
    {
        // dd($id);
        $user = Vehicle::find($id);
        // dd($user);
        $notes = VehicleNote::where('user_id', $id)->get();
        return view('user.vehicle.note.index', compact('notes', 'user'));
    }

    public function edit($user_id, $id)
    {
        $user = Vehicle::find($user_id);
        $note = VehicleNote::find($id);
        return view('user.vehicle.note.update', compact('note', 'user'));
    }

    public function store (Request $request, $id)
    {
        // dd($request->all());     

        $note = New VehicleNote();
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

        $note = VehicleNote::find($id);
        $note->title = $request->title;       
        $note->content = $request->content;       
        $note->save();
        

        return redirect('/vehicle/note/'.$user_id)->with('flash_message_success', 'Note Update Successfully...');
    }

    public function delete($id)
    {
        VehicleNote::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'Note Delete Successfully...');
    }
    
}
