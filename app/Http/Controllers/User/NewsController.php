<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use App\User;
use Auth;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::get();
        return view('user.news.index', compact('news'));
    }

    public function create()
    {
        $groups = DB::table('user_groups')->get();
        return view('user.news.create', compact('groups'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $news = new News();
        $news->author = auth::user()->name;
        $news->title = $request->title;
        $news->date = $request->date;
        $news->content = $request->content;
        $news->status = $request->status;
        $news->send_email = $request->send_email;
        
        if ($request->hasFile('document')) {
            $file1 = 'document-'.time().'.'.$request->document->extension();
            $request->document->storeAs('/news/document/', $file1, 'my_files');
            $news->document = $file1;
        }

        $news->groups = implode(",", $request->groups);
        $news->save();


        // Send Email
        if ($request->send_email) {
            
            $details = [
                'author' => auth::user()->name,
                'title' => $request->title,
                'date' => $request->date,
                'content' => $request->content,
            ];


            // Groups Users

            if ($request->status == "Specific Groups") {

                $group_ids = $request->groups;

                $users = User::where(function ($query) use ($group_ids) {
                    foreach ($group_ids as $gid) {
                        $query->orWhere('group_id', 'LIKE', '%' . $gid . '%');
                    }
                })->get();

            }else{
                $users = User::get();
            }
            foreach ($users as $key => $user) {
                // echo $user->email."<br>"; 
                // Mail::to($user->email)->send(new \App\Mail\NewsNotification($details));
            }
            // die();
        }
        return redirect('/news')->with('flash_message_success', 'News Create Successfully...');
    }

    public function edit($id)
    {
        $new = News::find($id);
        $groups = DB::table('user_groups')->get();
        return view('user.news.edit', compact('groups', 'new'));
    }
    public function view($id)
    {
        $new = News::find($id);
        $groups = DB::table('user_groups')->get();
        return view('user.news.users', compact('groups', 'new'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());

        $news = News::find($id);
        $news->author = auth::user()->name;
        $news->title = $request->title;
        $news->date = $request->date;
        $news->content = $request->content;
        $news->status = $request->status;
        
        if ($request->hasFile('document')) {
            $file1 = 'document-'.time().'.'.$request->document->extension();
            $request->document->storeAs('/news/document/', $file1, 'my_files');
            $news->document = $file1;
        }else{
            
            $news->document = $news->document;
        }

        $news->groups = implode(",", $request->groups);
        $news->save();
        return redirect('/news')->with('flash_message_success', 'News Update Successfully...');
    }

    public function delete($id)
    {
        News::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'News Delete Successfully...');
    }
}
