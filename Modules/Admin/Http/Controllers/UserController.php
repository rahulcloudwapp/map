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
    
    public function useradd(Request $request)
    {
        if($request->submit){
            //echo "<pre>";print_r($request->all());die();
            $validateData = $request->validate([
                   'name' => 'required',
                   'email'    =>'required|email|unique:users',
                   'mobile' => 'required',
                ]);
                
            $password = $this->randomPassword();
            $user = new User;
            $user->name= $request->name;
            $user->email= $request->email;
            $user->mobile= $request->mobile;
            $user->password= Hash::make($password);
            $user->email_verified_status='0';
            $user->status='1';
            $user->image= '';
            $user->save();
            
            if($user->id){
                $this->email($password,$user->id);
                return redirect('admin/users-list')->with('message','User has been added successfully.');
            }else{
                return back()->with('errmessage','Something went wrong.Please try again later');
            }

        }
        return view('admin::Users.user_add');
    }
    
    
    public function email($password,$id)
    {
        $user = User::where("id",$id)->first();
        if(!empty($user)){
            $name =  $user->name;
            
            $to = $user->email;
            $subject = "Welcome to News ";
            
            $message =  view('admin::Users.email',compact('password','user'));
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <clouldiz>' . "\r\n";
            
            mail($to,$subject,$message,$headers);
                 
        }
    }
    
    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    
    
    
     
}
