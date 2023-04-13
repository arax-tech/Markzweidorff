<?php

namespace App\Http\Controllers\PWA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FavoriteDocument;
use App\News;
use App\Schedule;
use Auth;

class PWAController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('date', '>=', date('Y-m-d'))->where(['staff_id' => auth::user()->id, 'visibility' => 'Published'])->orderBy('date', 'asc')->limit(5)->get();
        // $schedules = Schedule::where('staff_id', auth::user()->id)->limit(5)->get();
   		$schedulesCounts = Schedule::where('staff_id', auth::user()->id)->count();
   		$news = News::orderBy('date', 'desc')->limit(5)->get();
        $FavoritDocuments = FavoriteDocument::where('user_id', auth::user()->id)->count();
   		return view('pwa.index', compact('schedules', 'schedulesCounts', 'news', 'FavoritDocuments'));
    }

    public function news_view($id)
    {
    	$news = News::find($id);
    	$array = explode(",", $news->views);
    	if (!in_array(auth::user()->id, $array)) {
	    	$news->views = $news->views.auth::user()->id.",";
	    	$news->save();
    	}

    	return view('pwa.news.view', compact('news'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('flash_message_success', 'Logout Successfully...');
    }
}
