<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\User;
use Hash;
use Session;



use Redirect;
use Auth;


class UserController extends Controller
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
         $view = User::where('status', '=', 1)->get();
        return view('admin::Users.userlist',compact('view'));
    }
    
    
    
    
    
     
}
