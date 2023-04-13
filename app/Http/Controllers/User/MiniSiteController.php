<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserLocation;
use App\MiniSite;
use App\User;
use App\ToDo;
use App\Chat;
use DB;
use Auth;


class MiniSiteController extends Controller
{
    public function index()
    {
        error_reporting(0);
        Check("MiniSiteView");
        $minisites = MiniSite::get();
        $locations = UserLocation::get();
        return view('user.minisite.index', compact('minisites', 'locations'));
    }

 

   public function store(Request $request)
   {
        Check("MiniSiteCreate");
       $minisite = new MiniSite();
       $minisite->location_id = $request->location_id;
       $minisite->name = $request->name;
       $minisite->status = $request->status;
       $minisite->description = $request->description;
       
       if ($request->hasFile('logo')) 
       {
           
           $file1 = 'logo-'.time().'.'.$request->logo->extension();
           $request->logo->storeAs('/minisite/logo/', $file1, 'my_files');
           $minisite->logo = $file1;
       }
       $minisite->save();

       return redirect()->back()->with('flash_message_success', 'MiniSite Create Successfully...');
       

   }


   public function update(Request $request, $id)
   {
        Check("MiniSiteUpdate");
       $minisite = MiniSite::find($id);
       $minisite->location_id = $request->location_id;
       $minisite->name = $request->name;
       $minisite->status = $request->status;
       $minisite->description = $request->description;
       
       if ($request->hasFile('logo')) 
       {
           
           $file1 = 'logo-'.time().'.'.$request->logo->extension();
           $request->logo->storeAs('/minisite/logo/', $file1, 'my_files');
           $minisite->logo = $file1;
       }else{
        $minisite->logo = $minisite->logo;
       }
       $minisite->save();

       return redirect()->back()->with('flash_message_success', 'MiniSite Update Successfully...');
       

   }


   public function delete(Request $request, $id)
   {
    Check("MiniSiteDelete");
       MiniSite::find($id)->delete();
       return redirect()->back()->with('flash_message_success', 'MiniSite Delete Successfully...');
   }









   public function minisite($id)
   {
        $location_ids = explode(",", auth::user()->location_id);
        $minisites = DB::table('minisites')->whereIn('location_id', $location_ids)->count();
        if ($minisites > 0)
        {
          $minisite = MiniSite::find($id);
          $todos = ToDo::where('minisite_id', $id)->orderBy('id', 'DESC')->get();
          $chats = Chat::where('minisite_id', $id)->orderBy('id', 'DESC')->get();
          return view('user.minisite.view', compact('minisite', 'todos', 'chats'));
        }else{
          return redirect()->back()->with('flash_message_error', 'Your don`t have access for this resources...');
        }
   }

   public function minisite_information($id)
   {
        $location_ids = explode(",", auth::user()->location_id);
        $minisites = DB::table('minisites')->whereIn('location_id', $location_ids)->count();
        if ($minisites > 0)
        {
          $minisite = MiniSite::find($id);
          return view('user.minisite.information', compact('minisite'));
        }else{
          return redirect()->back()->with('flash_message_error', 'Your don`t have access for this resources...');
        }
   }

   public function minisite_instrukser($id)
   {
        $location_ids = explode(",", auth::user()->location_id);
        $minisites = DB::table('minisites')->whereIn('location_id', $location_ids)->count();
        if ($minisites > 0)
        {
          $minisite = MiniSite::find($id);
          return view('user.minisite.instrukser', compact('minisite'));
        }else{
          return redirect()->back()->with('flash_message_error', 'Your don`t have access for this resources...');
        }
   }


   public function minisite_team($id)
   {
        $location_ids = explode(",", auth::user()->location_id);
        $minisites = DB::table('minisites')->whereIn('location_id', $location_ids)->count();
        if ($minisites > 0)
        {
          $minisite = MiniSite::find($id);
          return view('user.minisite.team', compact('minisite'));
        }else{
          return redirect()->back()->with('flash_message_error', 'Your don`t have access for this resources...');
        }
   }







   public function store_todo(Request $request)
   {
       $todo = new ToDo();
       $todo->user_id = auth::user()->id;
       $todo->minisite_id = $request->minisite_id;
       $todo->task = $request->task;
       $todo->priority = $request->priority;
       $todo->done = "No";
       $todo->save();
       return redirect()->back()->with('flash_message_success', 'ToDo Create Successfully...');
   }

   public function update_todo(Request $request, $id)
   {
       $todo = ToDo::find($id);
       $todo->task = $request->task;
       $todo->priority = $request->priority;
       $todo->save();
       return redirect()->back()->with('flash_message_success', 'ToDo Update Successfully...');
   }


   public function done_todo(Request $request, $id)
   {
       $todo = ToDo::find($id);
       $todo->done = "Yes";
       $todo->priority = "Green";
       $todo->save();
       return redirect()->back()->with('flash_message_success', 'ToDo Complete Successfully...');
   }
    
    public function delete_todo(Request $request, $id)
   {
       $todo = ToDo::find($id)->delete();
       return redirect()->back()->with('flash_message_success', 'ToDo Delete Successfully...');
   }


   public function store_chat(Request $request)
   {
       $chat = new Chat();
       $chat->user_id = auth::user()->id;
       $chat->minisite_id = $request->minisite_id;
       $chat->message = $request->message;
       $chat->save();
       return redirect()->back()->with('flash_message_success', 'Message Send Successfully...');
   }

   public function delete_chat(Request $request, $id)
   {
       $chat =Chat::find($id)->delete();
       return redirect()->back()->with('flash_message_success', 'Message Delete Successfully...');
   }
    
    
}
