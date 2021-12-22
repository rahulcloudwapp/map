<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\Contact;
use Hash;
use Session;



use Redirect;
use Auth;


class ContactController extends Controller
{
    
   public function __construct()
   {
        //   if (!empty(session()->has('admin_sess'))) {
                
        //     } else {
                
        //         return redirect('admin')->send();
        //     }
       
   }
    
    public function index()
    {
         $view = Contact::orderBy('id','desc')->get();
        return view('admin::Contact.contactlist',compact('view'));
    }
    
    
    
    
    
     
}
