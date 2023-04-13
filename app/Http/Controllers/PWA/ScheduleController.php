<?php

namespace App\Http\Controllers\PWA;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\ScheduleApplication;
use Carbon\Carbon;
use App\Schedule;
use Auth;
use DB;

class ScheduleController extends Controller
{
   public function index()
   {
        $schedules = Schedule::where(['staff_id' => auth::user()->id, 'visibility' => 'Published'])->orderBy('date', 'asc')->get();
        $upcommingSchedules = Schedule::where('date', '>=', date('Y-m-d'))->where(['staff_id' => auth::user()->id, 'visibility' => 'Published'])->orderBy('date', 'asc')->get();
   		// $openSchedules = Schedule::where('date', '>=', date('Y-m-d'))->where(['visibility' => 'Published', 'staff_id' => 0])->orderBy('date', 'asc')->get();


        $locaction_ids_str = auth::user()->location_id;
        $group_ids_str = auth::user()->group_id;

        
        $group_ids = explode(",", $group_ids_str);
        $openSchedules = DB::table('schedules')
            ->where('date', '>=', date('Y-m-d'))->where(['visibility' => 'Published', 'staff_id' => 0])
            ->orderBy('date', 'asc')->where(function ($query) use ($group_ids) {
                foreach ($group_ids as $gid) {
                    $query->orWhere('staff_groups', 'LIKE', '%' . $gid . '%');
                }
            })
        ->get();            
        


   		return view('pwa.schedule.index', compact('schedules', 'upcommingSchedules', 'openSchedules'));
   }

   public function view($id)
   {
   		error_reporting(0);
   		$schedule = Schedule::find($id);
   		$assignment = DB::table('customer_assignments')->where('id', $schedule->customer_assignments)->first();
   		$response = Http::get('https://nominatim.openstreetmap.org/search?q='.$assignment->street_no.'+'.$assignment->street_navn.',+'.$assignment->city_name.'&format=json&polygon=1&addressdetails=1') ;
      $AlreadyApplied = ScheduleApplication::where(['user_id' => auth::user()->id, 'schedule_id' => $id])->count();
   		return view('pwa.schedule.view', compact('schedule', 'response', 'AlreadyApplied'));
   }

   public function update_status($status, $id)
    {
        $schedule = Schedule::find($id);
        if ($schedule->staff_id == 0) {
            $schedule->staff_id = auth::user()->id;
        }
        $schedule->status = $status;
        $schedule->save();
        return redirect()->back()->with('flash_message_success', 'Status Update Successfully...');
    }

    public function apply($id)
    {
        $check = ScheduleApplication::where(['user_id' => auth::user()->id, 'schedule_id' => $id])->count();
        if ($check > 0) {
            return redirect()->back()->with('flash_message_error', 'Already Applied...');
        }
        $apply = new ScheduleApplication();
        $apply->user_id = auth::user()->id;
        $apply->schedule_id = $id;
        $apply->save();

        return redirect()->back()->with('flash_message_success', 'Apply Schedule Successfully...');
    }
    
}
