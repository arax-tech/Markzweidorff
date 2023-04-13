<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\DocumentStatus;
use App\Category;
use App\Document;
use App\UserGroup;
use App\User;
use Auth;
use DB;

use \ConvertApi\ConvertApi;


class DocumentController extends Controller
{
    public function index()
    {
        Check("UserDocumentListView");
        $documents = Document::get();
        return view('user.document.index', compact('documents'));
    }

    public function create()
    {
        
        $groups = UserGroup::get();
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('user.document.create', compact('groups', 'categories'));
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


            Mail::to($setting->status_reciving_email)->send(new \App\Mail\StatusUpdate($details));
        }
        // dd($request->all());
        
        $status = DocumentStatus::firstOrNew(array('user_id' => auth::user()->id, 'document_id' => $id));
        $status->document_id = $id;
        $status->user_id = auth::user()->id;
        $status->status = $request->status;
        $status->reason = $request->reason;
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


    public function store (Request $request)
    {

        $validatedData = $request->validate([
            'group_id' => 'required',
            'category' => 'required',
            'title' => 'required',
            'must_read' => 'required',
        ]);


        // dd($request->all());
        $document = New Document();
        $document->group_id = implode(",", $request->group_id);
        $document->category = $request->category;
        $document->title = $request->title;
        $document->subtitle = $request->subtitle;
        $document->keyword = $request->keyword;
        $document->must_read = $request->must_read;
        $document->editor = $request->editor;
        $document->period = $request->period;
        $document->icon = $request->icon;
        // $document->status = "UnRead";
        

        $random8 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));
        $random4 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4A = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4B = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random12 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12));
        $unique_id = $random8."-".$random4."-".$random4A."-".$random4B."-".$random12;
        
        if ($request->hasFile('pdf')) 
        {
            $file1 = $unique_id.'.'.$request->pdf->extension();
            $request->pdf->storeAs('/documents/', $file1, 'my_files');
            $document->pdf = $file1;
        }
        else
        {
            $document->pdf = '';
        }

        $document->save();

        return redirect('/wiki/list')->with('flash_message_success', 'Document Create Successfully...');
    }



    public function edit($id)
    {
        $groups = UserGroup::get();
        $categories = Category::get();
        // dd($categories);
        $document = Document::find($id);
        return view('user.document.update', compact('groups', 'categories', 'document'));
    }

    public function view($id)
    {
        error_reporting(0);

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
        return view('user.document.view', compact('users', 'categories', 'document', 'category', 'parnet_category', 'level_one_category', 'level_two_category', 'level_three_category'));
    }

 

    public function update (Request $request, $id)
    {

        $validatedData = $request->validate([
            'group_id' => 'required',
            'category' => 'required',
            'title' => 'required',
            'must_read' => 'required',
        ]);


        // dd($request->all());
        $document = Document::find($id);
        $document->group_id = implode(",", $request->group_id);
        $document->category = $request->category;
        $document->title = $request->title;
        $document->subtitle = $request->subtitle;
        $document->keyword = $request->keyword;
        $document->must_read = $request->must_read;
        $document->editor = $request->editor;
        $document->period = $request->period;
        $document->icon = $request->icon;
        if ($request->status)
        {
            $docs = DocumentStatus::where('document_id', $id)->get();
            foreach ($docs as $key => $value)
            {
                // dd($value->id);
                $doc = DocumentStatus::find($value->id);
                $doc->status = $request->status;
                $doc->save();
            }

        }
        
        // 6F9619FF-8B86-D011-B42D-00C04FC964FF
        $random8 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8));
        $random4 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4A = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random4B = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 4));
        $random12 = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12));
        $unique_id = $random8."-".$random4."-".$random4A."-".$random4B."-".$random12;
        // dd($unique_id);


        if ($request->hasFile('pdf')) 
        {
            $file1 = $unique_id.'.'.$request->pdf->extension();
            $request->pdf->storeAs('/documents/', $file1, 'my_files');
            $document->pdf = $file1;
        }
        else
        {
            $document->pdf = $document->pdf;
        }

        $document->save();

        return redirect('/wiki/list')->with('flash_message_success', 'Document Update Successfully...');
    }
    public function delete($id)
    {
        Document::find($id)->delete();
        return redirect()->back()->with('flash_message_error', 'User Document Successfully...');
    }





    public function reset($id)
    {
        // dd($id)
        $document = DocumentStatus::find($id)->delete();
        return redirect()->back()->with('flash_message_success', 'Status Reset Successfully...');
    }







    public function status()
    {
        $documents = DocumentStatus::get();
        return view('user.document.status', compact('documents'));
    }



    public function autocomplete(Request $request){

     


        return Document::select('title')
        ->where('title','LIKE','%'.$request->get('query').'%')
        ->pluck('title');
    }

    public function autocompleteSubtitle(Request $request){
        return Document::select('subtitle')
        ->where('subtitle','LIKE','%'.$request->get('query').'%')
        ->pluck('subtitle');
    }

    public function autocompleteKeyword(Request $request){
        return Document::select('keyword')
        ->where('keyword','LIKE','%'.$request->get('query').'%')
        ->pluck('keyword');

       

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

        
    
        return view('user.document.search', compact('search'));
    }




    public function wiki()
    {
        $categories = Category::whereNull('parent_id')->orderBy('name', 'ASC')->get();
        return view('user.document.wiki', compact('categories'));
    }

    public function level_two_category ($id)
    {
        $category = Category::find($id);
        $sub_categories = Category::where('parent_id', $id)->orderBy('name', 'ASC')->get();
        $documents = Document::where('category', $id)->orderBy('title', 'ASC')->get();
        return view('user.document.level-two-category', compact('sub_categories', 'documents', 'category'));
    }

    public function level_three_category ($id)
    {
        $category = Category::find($id);
        $parnet_category = Category::where('id', $category->parent_id)->first();
        $sub_categories = Category::where('parent_id', $id)->orderBy('name', 'ASC')->get();
        $documents = Document::where('category', $id)->orderBy('title', 'ASC')->get();
        return view('user.document.level-three-category', compact('sub_categories', 'documents', 'category', 'parnet_category'));
    }

    public function level_four_category ($id)
    {
        $category = Category::find($id);

        $level_three_category = Category::where('id', $category->parent_id)->first();
        $level_two_category = Category::where('id', $level_three_category->parent_id)->first();
        // dd($level_one_category->name);

        $sub_categories = Category::where('parent_id', $id)->orderBy('name', 'ASC')->get();
        $documents = Document::where('category', $id)->orderBy('title', 'ASC')->get();
        return view('user.document.level-four-category', compact('sub_categories', 'documents', 'category', 'level_two_category', 'level_three_category'));
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
        return view('user.document.wiki_by_category', compact('documents', 'sub_categories', 'category', 'parnet_category', 'level_one_category', 'level_two_category', 'level_three_category'));
    }










    public function pdf(Request $request)
    {
        if ($request->isMethod('post'))
        {

            if ($request->hasFile('formFile')) 
            {
                $file1 = time().'.'.$request->formFile->extension();
                $request->formFile->storeAs('/pdf/', $file1, 'my_files');
            }


            $dir = public_path().'/backend/pdf/'.$file1;

            ConvertApi::setApiSecret('qyZspH6QNJ1vHVUg');
            
            $result = ConvertApi::convert('png',['File' => $dir,],'pdf');


            $result->saveFiles(public_path().'/backend/pdf/');


            return redirect()->back()->with('flash_message_success', 'Converted Successfully');

              
        }

        // $dir = public_path().'/backend/pdf/1669490571.pdf';

        // $pdf = new Spatie\PdfToImage\Pdf($pathToPdf);
        // $pdf->saveImage($pathToWhereImageShouldBeStored);
        return view('pdf');
    }
    
}
