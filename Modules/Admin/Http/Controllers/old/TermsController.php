<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\Term;
use Hash;
use Session;



use Redirect;
use Auth;


class TermsController extends Controller
{
    
   public function __construct()
   {
        //   if (!empty(session()->has('admin_sess'))) {
                
        //     } else {
                
        //         return redirect('admin')->send();
        //     }
       
   }
    
    public function index(Request $request)
    {
         $view = Term::first();
         if($request->submit){
             
            if(!empty($view))
            {
              
                $term= Term::find($view->id);
                $msg ="updated";
            }else{
                
                $term= new Term;
                $msg ="added";
            }
                
                $term->description = $request->description;
                $term->lat_description = $request->lat_description;
                $term->rus_description = $request->rus_description;
               
                $term->save();
            
            if($term->id){
              return redirect('admin/terms')->with('msg',"Term $msg successfully.");  
            }else{
               return redirect('admin/terms')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        return view('admin::Terms.terms',compact('view'));
    }
    
   
    
    
    
    
     
}
