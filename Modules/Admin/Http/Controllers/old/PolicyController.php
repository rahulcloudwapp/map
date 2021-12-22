<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\Policy;
use Hash;
use Session;



use Redirect;
use Auth;


class PolicyController extends Controller
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
         $view = Policy::first();
         if($request->submit){
             
            if(!empty($view))
            {
              
                $policy= Policy::find($view->id);
                $msg ="updated";
            }else{
                
                $policy= new Policy;
                $msg ="added";
            }
                
                $policy->description = $request->description;
                $policy->lat_description = $request->lat_description;
                $policy->rus_description = $request->rus_description;
               
                $policy->save();
            
            if($policy->id){
              return redirect('admin/policy')->with('msg',"Policy $msg successfully.");  
            }else{
               return redirect('admin/policy')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        return view('admin::Policy.policy',compact('view'));
    }
    
    
    
    
    
    
     
}
