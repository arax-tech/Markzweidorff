<?php

namespace App\Http\Controllers\PWA;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\FavoriteDocument;
use App\DocumentStatus;
use Carbon\Carbon;
use App\Category;
use App\Document;
use App\User;
use Auth;
use File;
use Response;
use DB;


class PriDocumentController extends Controller
{
    public function index()
    {
        error_reporting(0);
        $categories = Category::whereNull('parent_id')->orderBy('name', 'ASC')->get();
        $FavoritDocuments = FavoriteDocument::where('user_id', auth::user()->id)->get();
        return view('pwa.pri-document.index', compact('categories', 'FavoritDocuments'));
    }


    public function document_by_category ($id)
    {
        error_reporting(0);
        $category = Category::find($id);
        $level_three_category = Category::where('id', $category->parent_id)->first();
        $level_two_category = Category::where('id', $level_three_category->parent_id)->first();
        $level_one_category = Category::where('id', $level_two_category->parent_id)->first();
        
        // dd($level_one_category->name."|".$level_one_category->parent_id);
        $parnet_category = Category::where('id', $category->parent_id)->first();
        $sub_categories = Category::where('parent_id', $id)->orderBy('name', 'ASC')->get();
        $documents = Document::where('category', $id)->orderBy('title', 'ASC')->get();
        return view('pwa.pri-document.document_by_category', compact('documents', 'sub_categories', 'category', 'parnet_category', 'level_one_category', 'level_two_category', 'level_three_category'));
    }

    public function view($id)
    {
        error_reporting(0);
        $FavoriteDocument = FavoriteDocument::where(['user_id' => auth::user()->id, 'document_id' => $id])->count();
        $status = DocumentStatus::where(['document_id' => $id, 'user_id' => auth::user()->id])->first();
        if(count($status) == 0)
        {
            $status = new DocumentStatus();
            $status->document_id = $id;
            $status->user_id = auth::user()->id;
            $status->status = "Read";
            $status->save();
        }

        $users = User::get();
        $categories = Category::whereNull('parent_id')->get();
        
        $document = Document::find($id);
        $document->counts = $document->counts +1;
        $document->save();
        
        $category = Category::find($document->category);
        $level_three_category = Category::where('id', $category->parent_id)->first();
        $level_two_category = Category::where('id', $level_three_category->parent_id)->first();
        $level_one_category = Category::where('id', $level_two_category->parent_id)->first();

        $parnet_category = Category::where('id', $category->parent_id)->first();
        return view('pwa.pri-document.view', compact('users', 'categories', 'document', 'category', 'parnet_category', 'level_one_category', 'level_two_category', 'level_three_category', 'FavoriteDocument'));
    }

    public function pdf($id)
    {
        error_reporting(0);
        $document = Document::find($id);
        return view('pwa.pri-document.pdf', compact('document'));
    }

    public function download_pdf($id)
    {
        $document = Document::find($id);
        // return response()->download(asset('/backend/documents/'.$document->pdf));
        $filepath = public_path('backend/documents/'.$document->pdf);
        return Response::download($filepath); 
    }

    public function add_to_favorite($id)
    {
        $check = FavoriteDocument::where(['user_id' => auth::user()->id, 'document_id' => $id])->count();
        if ($check > 0) {
            FavoriteDocument::where(['user_id' => auth::user()->id, 'document_id' => $id])->delete();
            return redirect()->back()->with('flash_message_error', 'Document Removed from Favorite List...');
        }
        $favorite = new FavoriteDocument();
        $favorite->user_id = auth::user()->id;
        $favorite->document_id = $id;
        $favorite->save();

        return redirect()->back()->with('flash_message_success', 'Document Added in Favorite List...');
    }


    public function update_status (Request $request, $status, $id)
    {
        $document = Document::find($id);

        if ($status == "Read Not Understood")
        {
            // dd($request->all());
            $user = User::find(auth::user()->id);

            $details = [
                    'userName' => $user->name,
                    'userEmail' => $user->email,
                    'userPhone' => $user->phone,
                    'userAddress' => $user->address,
                    'title' => $document->title,
                    'reason' => $request->reason,
                    'subtitle' => $document->subtitle,
                    'status' => $status,
                ];
               
            error_reporting(0);
            $setting = DB::table('settings')->where('id', 1)->first();


            // Mail::to($setting->status_reciving_email)->send(new \App\Mail\StatusUpdate($details));
        }
        // dd($request->all());
        
        $status = DocumentStatus::firstOrNew(array('user_id' => auth::user()->id, 'document_id' => $id));
        $status->document_id = $id;
        $status->user_id = auth::user()->id;
        $status->status = $request->status;
        // $status->reason = $request->reason;
        if ($request->reason) 
        {
            $status->reason = $request->reason;
        }else
        {
            $status->reason = null;
        }
        $status->save();
        return redirect()->back()->with('flash_message_success', 'Status Updated Successfully...');
    }


    public function search(Request $request)
    {

        $search = Document::where('title','LIKE','%'.$request->get('query').'%')
            ->orWhere('subtitle','LIKE','%'.$request->get('query').'%')
            ->orWhere('keyword','LIKE','%'.$request->get('query').'%')
            ->orderBy('title', 'ASC')
            ->get();

        

        // $search = json_encode(json_decode($search));
        // echo "<pre>"; print_r($search); die();

        
    
        return view('pwa.pri-document.search', compact('search'));
    }
    
}
