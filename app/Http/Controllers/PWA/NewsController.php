<?php

namespace App\Http\Controllers\PWA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\News;
use App\Schedule;
use Auth;

class NewsController extends Controller
{
    public function index()
    {
   		$news = News::orderBy('date', 'desc')->get();
   		return view('pwa.news.index', compact('news'));
    }

    public function view($id)
    {
    	$news = News::find($id);
    	$array = explode(",", $news->views);
    	if (!in_array(auth::user()->id, $array)) {
	    	$news->views = $news->views.auth::user()->id.",";
	    	$news->save();
    	}

    	return view('pwa.news.view', compact('news'));
    }
}
