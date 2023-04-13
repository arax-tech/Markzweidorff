<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Equipment;
use App\User;
use Auth;
class EquipmentController extends Controller
{
    public function index($id)
    {
        Check("AuthEquipmentView");
        $user = User::find($id);
        $equipments = Equipment::where('user_id', $id)->get();
        return view('user.user.equipment.index', compact('equipments', 'user'));
    }

 

    public function store (Request $request, $id)
    {
        // dd($request->all());     

        $equipment = New Equipment();
        $equipment->admin_id = auth::user()->id;
        $equipment->user_id = $id;
        $equipment->name = $request->name;       
        $equipment->note = $request->note;
        $equipment->status = $request->status;
        $equipment->save();

        return redirect()->back()->with('flash_message_success', 'Equipment Create Successfully...');
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
        return redirect()->back()->with('flash_message_error', 'Equipment Delete Successfully...');
    }
    
}
