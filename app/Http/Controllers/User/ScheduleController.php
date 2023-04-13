<?php

namespace App\Http\Controllers\User;

use App\CustomerAssignment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\ScheduleApplication;
use App\ScheduleNote;
use App\Customer;
use App\Schedule;
use App\NotWorkingSchedule;
use App\User;
use Auth;
use DB;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if($request->week){
            return view('user.schedule.index');
        }else{
            return redirect('/schedule?week='.date('Y')."-W".date("W").'&active=Customer');
        }
    }

    public function overview()
    {
        return view('user.schedule.overview');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $date1 = $request->start_time;
        $date2 = $request->end_time;
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);

        $total_hours0 = abs($timestamp2 - $timestamp1)/(60*60);
        $total_hours = number_format((float)$total_hours0, 2, '.', '');
        // dd($total_hours);


        $schedule = new Schedule();
        $schedule->type = $request->type;

        $schedule->customer_id = $request->customer_id;
        $schedule->customer_assignments = $request->assignment;
        if ($request->location_ids == null){}else{
            $schedule->customer_loactions = implode(",", $request->location_ids);
        }


        $schedule->staff_id = $request->staff_id;
        if ($request->group_ids == null){}else{
            $schedule->staff_groups = implode(",", $request->group_ids);
        }


        $schedule->hourly_wags = $request->hourly_wags;
        $schedule->vehicle_id = $request->vehicle_id;
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->total_hours = $total_hours;
        $schedule->total_hourly_wags = $total_hours * $request->hourly_wags;



        if ($request->customer_id == 0 OR $request->staff_id == 0) {
            $schedule->status = "Pending";
        }else{
            $schedule->status = $request->status;
        }
        $schedule->visibility = $request->visibility;
        $schedule->notes = $request->note;
        $schedule->save();
        return redirect()->back()->with('flash_message_success', 'Schedule Create Successfully...');

    }

    public function drag_update(Request $request, $id)
    {

        $schedule = Schedule::find($id);
        if ($request->type == "Customer") {
            $schedule->customer_id = $request->user_id;
        }else{
            $schedule->staff_id = $request->user_id;
        }


        $schedule->date = $request->date;

        if ($schedule->customer_id == 0 OR $schedule->staff_id == 0) {
            $schedule->status = "Pending";
        }else{
            $schedule->status = $schedule->status;
        }
        $schedule->save();
        return 'Schedule Update Successfully...';
    }



    public function copy_schedule_ajax(Request $request, $id)
    {

        // dd($request->all());
        $currentSchedule = Schedule::find($id);


        $schedule = new Schedule();

        if ($request->user == 00) {
            $schedule->customer_id = $currentSchedule->customer_id;
            $schedule->staff_id = $currentSchedule->staff_id;
        }else{
            if ($request->type == "Customer") {
                $schedule->customer_id = $request->user_id;
                $schedule->staff_id = $currentSchedule->staff_id;
            }else{
                $schedule->staff_id = $request->user_id;
                $schedule->customer_id = $currentSchedule->customer_id;
            }
        }
        

        
        $schedule->customer_assignments = $currentSchedule->customer_assignments;
        $schedule->customer_loactions = $currentSchedule->customer_loactions;
        $schedule->staff_groups = $currentSchedule->staff_groups;


        $schedule->type = $currentSchedule->type;
        $schedule->hourly_wags = $currentSchedule->hourly_wags;
        $schedule->date = $request->date;
        $schedule->start_time = $currentSchedule->start_time;
        $schedule->end_time = $currentSchedule->end_time;
        $schedule->total_hours = $currentSchedule->total_hours;
        $schedule->total_hourly_wags = $currentSchedule->total_hourly_wags;
        $schedule->notes = $currentSchedule->notes;
        $schedule->vehicle_id = $currentSchedule->vehicle_id;
        $schedule->visibility = $currentSchedule->visibility;
        $schedule->status = $currentSchedule->status;
        $schedule->save();


        return 'Schedule Copy Successfully...';
    }


    public function by_date_range(Request $request)
    {

        error_reporting(0);
        $schedules = Schedule::whereBetween('date', [$request->start_date, $request->end_date])->where('visibility', 'NotPublished')->get();
        foreach ($schedules as $key => $schedule)
        {
            $staff = User::find($schedule->staff_id);
            $customer = Customer::find($schedule->customer_id);
            $schedules[$key]->staff = $staff->name;
            $schedules[$key]->customer = $customer->name;
            $schedules[$key]->dateNew = date('d M Y', strtotime($schedule->date));
        }
        return response()->json($schedules);


    }



    public function update(Request $request, $id)
    {
        // dd($request->all());


        $date1 = $request->start_time;
        $date2 = $request->end_time;
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);

        $total_hours0 = abs($timestamp2 - $timestamp1)/(60*60);
        $total_hours = number_format((float)$total_hours0, 2, '.', '');
        // dd($total_hours);

        // dd($request->all());
        $schedule = Schedule::find($id);
        $schedule->customer_id = $request->customer_id;
        $schedule->customer_assignments = $request->assignment;
        if ($request->location_ids == null){}else{
            $schedule->customer_loactions = implode(",", $request->location_ids);
        }


        if ($request->staff_id == "undefined") {
            $schedule->staff_id = $schedule->staff_id;
        }else{
            $schedule->staff_id = $request->staff_id;

        }

        if ($request->group_ids == null){}else{
            $schedule->staff_groups = implode(",", $request->group_ids);
        }

        $schedule->hourly_wags = $request->hourly_wags;
        $schedule->vehicle_id = $request->vehicle_id;
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->total_hours = $total_hours;
        $schedule->total_hourly_wags = $total_hours * $request->hourly_wags;
        if ($request->customer_id == 0 OR $request->staff_id == 0) {
            if ($request->staff_id == "undefined") {
                $schedule->status = $schedule->status;
            }else{
                $schedule->status = "Pending";
                
            }
            
        }else{
            $schedule->status = $request->status;
        }
        $schedule->visibility = $request->visibility;
        $schedule->notes = $request->note;
        $schedule->save();
        return redirect()->back()->with('flash_message_success', 'Schedule Update Successfully...');
    }



    public function copy(Request $request, $id)
    {
        //  dd($request->all());
        error_reporting(0);
        $currentSchedule = Schedule::find($id);

        $data = $request->all();

        foreach ($request->scheduleCopy as $key => $value)
        {
            for ($i=0; $i < $data['numberOfCopies'][$key]; $i++) {
                $schedule = new Schedule();
                $schedule->customer_id = $currentSchedule->customer_id;
                $schedule->customer_assignments = $currentSchedule->customer_assignments;
                $schedule->customer_loactions = $currentSchedule->customer_loactions;
                if ($data['staff'][$key] == "Yes") {
                    $schedule->staff_id = $currentSchedule->staff_id;
                }else{
                    $schedule->staff_id = 0;
                }
                $schedule->staff_groups = $currentSchedule->staff_groups;

                $schedule->type = $currentSchedule->type;
                $schedule->hourly_wags = $currentSchedule->hourly_wags;
                $schedule->date = $value;
                $schedule->start_time = $currentSchedule->start_time;
                $schedule->end_time = $currentSchedule->end_time;
                $schedule->total_hours = $currentSchedule->total_hours;
                $schedule->total_hourly_wags = $currentSchedule->total_hourly_wags;
                $schedule->vehicle_id = $currentSchedule->vehicle_id;
                $schedule->notes = $currentSchedule->notes;
                $schedule->status = "Pending";
                $schedule->visibility = $data['visibility'][$key];
                $schedule->save();
            }
        }

        return redirect()->back()->with('flash_message_success', 'Schedules Copy Successfully...');
    }


    public function setting_update(Request $request)
    {
        $user = User::find(auth::user()->id);
        if ($request->schedule_settings != null) {
            $user->schedule_settings = implode(",", $request->schedule_settings);
        }else{
            $user->schedule_settings = null;            
        }
        $user->save();
        return redirect()->back()->with('flash_message_success', 'Schedule Setting Update Successfully...');
    }

    public function update_status_right_click($status, $id)
    {
        // dd($request->all());
        $schedule = Schedule::find($id);
        $schedule->status = $status;
        $schedule->save();
        return redirect()->back()->with('flash_message_success', 'Schedules Status Update Successfully...');
    }


    public function publish_shifts(Request $request)
    {
        Schedule::whereBetween('date', [$request->start_date, $request->end_date])
               ->update([
                   'visibility' => "Published"
                ]);
        return redirect()->back()->with('flash_message_success', 'Schedules Published Successfully...');
    }
    public function open_shift_store(Request $request)
    {
        // dd($request->all());



        $start_time = Carbon::parse($request->start_time);
        $end_time = Carbon::parse($request->end_time);

        $totalDuration = $end_time->diff($start_time);


        $total_hours = '';
        if ($totalDuration->i > 0)
        {
            $total_hours = $totalDuration->h.".5";
        }else{
            $total_hours = $totalDuration->h;
        }

        // dd($request->all());
            // dd($request->shift_slots);
        for ($i=$request->shift_slots; $i < $request->shift_slots; $i++) {
            $schedule = new Schedule();
            $schedule->type = $request->type;
            $schedule->user_id = $request->user_id;
            $schedule->hourly_wags = $request->hourly_wags;
            $schedule->date = $request->date;
            $schedule->start_time = $request->start_time;
            $schedule->end_time = $request->end_time;
            $schedule->total_hours = $total_hours;
            $schedule->total_hourly_wags = $total_hours * $request->hourly_wags;
            $schedule->status = $request->status;
            $schedule->visibility = $request->visibility;
            $schedule->vehicle_id = $request->vehicle_id;
            $schedule->save();
        }

        return redirect()->back()->with('flash_message_success', 'Open Shift Create Successfully...');
    }

    public function delete($id)
    {

        Schedule::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Schedule Delete Successfully...');
    }

    public function ajax_delete($id)
    {
        Schedule::find($id)->delete();
        return response()->json('Schedule Delete Successfully...');
    }






    public function get_schedule($id)
    {
        $schedule = Schedule::find($id);
        return response()->json($schedule);
    }

    public function get_notes($id)
    {
        $notes = ScheduleNote::where('schedule_id', $id)->get();
        return response()->json($notes);
    }

    public function get_application($id)
    {
        $applications = ScheduleApplication::where('schedule_id', $id)->orderBy('id', 'ASC')->get();
        error_reporting(0);
        foreach ($applications as $key => $application) {
            $user = User::find($application->user_id);
            $applications[$key]->user_id = $user->id;
            $applications[$key]->name = $user->name;
            $applications[$key]->email = $user->email;
            $applications[$key]->image = $user->image;
            $applications[$key]->created_at1 = date('d M Y : H:i', strtotime($application->created_at));
            $arrx = explode(",", $user->group_id);
            $groups = DB::table('user_groups')->whereIn('id', $arrx)->get();
            $applications[$key]->groups = $groups;
        }
        return response()->json($applications);
    }

    public function application_confirm($id)
    {
        $scheduleApplication = ScheduleApplication::find($id);
        $scheduleApplication->accepted = 1;
        $scheduleApplication->save();


        $schedule = Schedule::find($scheduleApplication->schedule_id);
        $schedule->staff_id = $scheduleApplication->user_id;
        $schedule->status = "Accepted";
        $schedule->save();
        return redirect()->back()->with('flash_message_success', 'Tildelt personale...');

    }


    public function customer_assignments($id)
    {
        error_reporting(0);
        $customer = Customer::find($id);
        // dd($customer);
        $assignments = CustomerAssignment::where('user_id',$id)->pluck('name','id');
        return response()->json([
            "assignments" => $assignments,
            "location_id" => $customer->location_id,
        ]);
    }

    public function staff_by_location($ids)
    {

        $array = explode(",", $ids);
        // dd($array);
        if ($ids == 0) {
            $users = DB::table('users')->get(['group_id','name','id']);
        }else{
            $users = DB::table('users')->whereIn('location_id',$array)->get(['group_id','name','id']);
        }


        foreach ($users as $key => $value)
        {
            if (strlen($value->group_id) > 1) {
                $arr = explode(",", $value->group_id);
                // dd($arr);
                foreach ($arr as $kk => $arrValue) {
                    // dd($arrValue);
                    $group = DB::table('user_groups')->where('id', $arrValue)->first();
                    $users[$key]->groups[] = $group->name;
                }
            }else{
                if ($value->group_id == null || $value->group_id == "") {
                    $users[$key]->groups = "";
                }else{
                    $group = DB::table('user_groups')->where('id', $value->group_id)->first();
                    $users[$key]->groups = $group->name;
                }
            }
        }


        // dd($users);
        return response()->json($users);
    }

    public function staff_by_location_and_group($group_ids_str, $locaction_ids_str)
    {
        if ($locaction_ids_str == 0 && $group_ids_str != 0) {
                $found_id = 0;
                $group_ids = explode(",", $group_ids_str);
                // $users = DB::table('users')->where('group_id','LIKE','%'.$group_ids.'%')->get('name','id');
                $users = DB::table('users')
                ->where(function ($query) use ($group_ids) {
                    foreach ($group_ids as $gid) {
                        $query->orWhere('group_id', 'LIKE', '%' . $gid . '%');
                    }
                })
                ->get(['group_id','name','id']);

            foreach ($users as $key => $value)
            {
                $arr = explode(",", $value->group_id);
                foreach ($group_ids as $g_id) {
                    if (in_array( $g_id ,$arr )) {
                        $found_id = 1;
                        break;
                    }else{
                        $found_id = 0;
                    }
                }
                if ($found_id == 1) {
                    if (strlen($value->group_id) > 1) {
                        // dd($arr);
                        foreach ($arr as $kk => $arrValue) {
                            // dd($arrValue);
                            $group = DB::table('user_groups')->where('id', $arrValue)->first();
                            $users[$key]->groups[] = $group->name;
                        }
                    }else{
                        if ($value->group_id == null || $value->group_id == "") {
                            $users[$key]->groups = "";
                        }else{
                            $group = DB::table('user_groups')->where('id', $value->group_id)->first();
                            $users[$key]->groups = $group->name;
                        }
                    }
                }else{
                    unset($users[$key]);
                }
            }
        } elseif ($group_ids_str == 0 && $locaction_ids_str != 0) {
            $locaction_ids = explode(",", $locaction_ids_str);
            $users = DB::table('users')
                ->where(function ($query) use ($locaction_ids) {
                    foreach ($locaction_ids as $id) {
                        $query->orWhere('location_id', 'LIKE', '%' . $id . '%');
                    }
                })
                ->get(['group_id','name','id']);
            // $users = DB::table('users')->where('location_id','LIKE','%'.$locaction_ids.'%')->get(['group_id','name','id']);
            foreach ($users as $key => $value)
            {
                if (strlen($value->group_id) > 1) {
                    $arr = explode(",", $value->group_id);
                    // dd($arr);
                    foreach ($arr as $kk => $arrValue) {
                        // dd($arrValue);
                        $group = DB::table('user_groups')->where('id', $arrValue)->first();
                        $users[$key]->groups[] = $group->name;
                    }
                }else{
                    if ($value->group_id == null || $value->group_id == "") {
                        $users[$key]->groups = "";
                    }else{
                        $group = DB::table('user_groups')->where('id', $value->group_id)->first();
                        $users[$key]->groups = $group->name;
                    }
                }
            }
        } elseif ($locaction_ids_str == 0 && $group_ids_str == 0) {
            $users = DB::table('users')->get(['group_id','name','id']);
            foreach ($users as $key => $value)
            {
                if (strlen($value->group_id) > 1) {
                    $arr = explode(",", $value->group_id);
                    // dd($arr);
                    foreach ($arr as $kk => $arrValue) {
                        // dd($arrValue);
                        $group = DB::table('user_groups')->where('id', $arrValue)->first();
                        $users[$key]->groups[] = $group->name;
                    }
                }else{
                    if ($value->group_id == null || $value->group_id == "") {
                        $users[$key]->groups = "";
                    }else{
                        $group = DB::table('user_groups')->where('id', $value->group_id)->first();
                        $users[$key]->groups = $group->name;
                    }
                }
            }
        } else {
            $found_id = 0;
            $group_ids = explode(",", $group_ids_str);
            $locaction_ids = explode(",", $locaction_ids_str);
            $users = DB::table('users')
            ->where(function ($query) use ($group_ids) {
                foreach ($group_ids as $id) {
                    $query->orWhere('group_id', 'like', '%' . $id . '%');
                }
            })
            ->where(function ($query) use ($locaction_ids) {
                foreach ($locaction_ids as $id) {
                    $query->orWhere('location_id', 'like', '%' . $id . '%');
                }
            })
            ->get(['group_id','name','id']);
            // $users = DB::table('users')->where('group_id','LIKE','%'.$group_ids.'%')->where('location_id','LIKE','%'.$locaction_ids.'%')->pluck('name','id');
            foreach ($users as $key => $value)
            {
                $arr = explode(",", $value->group_id);
                foreach ($group_ids as $g_id) {
                    if (in_array( $g_id ,$arr )) {
                        $found_id = 1;
                        break;
                    }else{
                        $found_id = 0;
                    }
                }
                if ($found_id == 1) {
                    if (strlen($value->group_id) > 1) {
                        // dd($arr);
                        foreach ($arr as $kk => $arrValue) {
                            // dd($arrValue);
                            $group = DB::table('user_groups')->where('id', $arrValue)->first();
                            $users[$key]->groups[] = $group->name;
                        }
                    }else{
                        if ($value->group_id == null || $value->group_id == "") {
                            $users[$key]->groups = "";
                        }else{
                            $group = DB::table('user_groups')->where('id', $value->group_id)->first();
                            $users[$key]->groups = $group->name;
                        }
                    }
                }else{
                    unset($users[$key]);
                }
            }
        }
        return response()->json($users);
    }


    public function note_store(Request $request, $id)
    {
        // dd($request->all());
        $note = new ScheduleNote();
        $note->user_id = auth::user()->id;
        $note->schedule_id = $id;
        $note->title = $request->title;
        $note->description = $request->description;
        $note->visibility = $request->visibility;
        $note->save();
        return response()->json(['message' => 'Note Added Successfully...']);

    }


    public function note_delete($id)
    {

        ScheduleNote::find($id)->delete();
        return response()->json(['message' => 'Note Delete Successfully...']);
    }



    public function note_working(Request $request)
    {
        // dd($request->all());

        $notWorking = new NotWorkingSchedule();
        $notWorking->customer_id = $request->customer_id;
        $notWorking->staff_id = $request->staff_id;
        if ($request->all_day == "Yes") {
            $notWorking->allDay ="All Day";
        }else{
            $notWorking->allDay ="Null";
        }
        $notWorking->date = $request->date;
        $notWorking->start_time = $request->start_time;
        $notWorking->end_time = $request->end_time;
        $notWorking->note = $request->note;
        $notWorking->status = $request->status;
        $notWorking->save();
        return redirect()->back()->with('flash_message_success', 'Not Working Schedule Create Successfully...');
    }


    public function note_working_update(Request $request, $id)
    {
        // dd($request->all());

        $notWorking = NotWorkingSchedule::find($id);
        $notWorking->customer_id = $request->customer_id;
        $notWorking->staff_id = $request->staff_id;
        if ($request->all_day == "Yes") {
            $notWorking->allDay ="All Day";
        }else{
            $notWorking->allDay ="Null";
        }
        $notWorking->date = $request->date;
        $notWorking->start_time = $request->start_time;
        $notWorking->end_time = $request->end_time;
        $notWorking->note = $request->note;
        $notWorking->status = $request->status;
        $notWorking->save();
        return redirect()->back()->with('flash_message_success', 'Not Working Schedule Update Successfully...');
    }


    public function note_working_delete($id)
    {
        // dd($request->all());

        NotWorkingSchedule::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Not Working Schedule Delete Successfully...');
    }

    public function getSingleNotWorkSchedule($id)
    {
        $notWorking = NotWorkingSchedule::find($id);
        return response()->json($notWorking);
    }
}
