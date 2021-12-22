<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\Auction;
use App\Models\Category;
use App\Models\File;
use Hash;
use Session;
use DB;


use Redirect;
use Auth;


class AuctionController extends Controller
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
        $view = Auction::orderBy('id',"desc")->get();
        return view('admin::Auction.auctionlist',compact("view"));
    }
    
    public function add(Request $request)
    {
        if($request->submit){
             //echo "<pre>";print_r($request->all());die();
             
            $startdatetime =$request->start_date.' '.$request->start_time;
            $end_datetime = $request->end_date.' '.$request->end_time;
            if(strtotime($startdatetime) >= strtotime($end_datetime)){ return back()->with('errmsg','Start date should not be greater than Enddate'); }
            
            $auction= new Auction;
            $auction->category_id = $request->category_id;
            $auction->unique_no = time();
            $auction->title = $request->title;
            $auction->lat_title = $request->lat_title;
            $auction->rus_title = $request->rus_title;
            $auction->description = $request->description;
            $auction->lat_description = $request->lat_description;
            $auction->rus_description = $request->rus_description;
            $auction->starting_price = $request->starting_price;
            $auction->start_datetime = date("Y-m-d H:i:s",strtotime($startdatetime));
            $auction->end_datetime = date("Y-m-d H:i:s",strtotime($end_datetime));
            $auction->lastbid_datetime = date("Y-m-d H:i:s", strtotime('+10 minutes', strtotime($request->start_datetime)));
            $auction->status = 1;
            $auction->save();
            if($auction->id){
                if($request->hasFile('images'))
                {
                  foreach($request->file('images') as $image)
                  {
                    $imageName = Str::random(5).time().'.'.$image->extension();  
                    $image->move('public/upload/auction/', $imageName);
                    $imgpath = 'public/upload/auction/'.$imageName;
                    $file= new File;
                    $file->auction_id = $auction->id;
                    $file->path = $imgpath;
                    $file->save();
                }
                
                
                }
                $this->auction_start_mail($auction->id);
              return redirect('admin/auction')->with('msg','Auction added successfully.');  
            }else{
               return redirect('admin/auction')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        $category = Category::where("status","1")->get();
        return view('admin::Auction.auctionadd',compact('category'));
    }
    
    public function edit(Request $request)
    {
        $id = base64_decode($_GET['Aiz']);
        $view = Auction::where('id', '=', $id)->first();
        if(empty($view)){ return redirect('admin/auction')->with('errmsg','Something went wrong.Please try after sometime');    }
         if($request->submit){
            //echo "<pre>"; print_r($request->all());die();
           
           //$startdatetime =$request->start_date.' '.$request->start_time;
           //$end_datetime = $request->end_date.' '.$request->end_time;
           //if(strtotime($startdatetime) >= strtotime($end_datetime)){ return back()->with('errmessage','Start date should not be greater than Enddate'); }
            $auction= Auction::find($id);
            $auction->category_id = $request->category_id;
            $auction->title = $request->title;
            $auction->lat_title = $request->lat_title;
            $auction->rus_title = $request->rus_title;
            $auction->description = $request->description;
            $auction->lat_description = $request->lat_description;
            $auction->rus_description = $request->rus_description;
            $auction->starting_price = $request->starting_price;
            //$auction->start_datetime = date("Y-m-d H:i:s",strtotime($startdatetime));
            //$auction->end_datetime = date("Y-m-d H:i:s",strtotime($end_datetime));
            //$auction->lastbid_datetime = date("Y-m-d H:i:s", strtotime('+10 minutes', strtotime($request->start_datetime)));
            $auction->save();
            if($auction->id){
                if($request->hasFile('images'))
                {
                    foreach($request->file('images') as $image)
                    {
                        $imageName = Str::random(5).time().'.'.$image->extension();  
                        $image->move('public/upload/auction/', $imageName);
                        $imgpath = 'public/upload/auction/'.$imageName;
                        $file= new File;
                        $file->auction_id = $id;
                        $file->path = $imgpath;
                        $file->save();
                    }
                
                }
              return redirect('admin/auction')->with('msg','Auction Updated successfully.');  
            }else{
               return redirect('admin/editauction?Aiz='.base64_encode($id))->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        $category = Category::where("status","1")->get();
        $imageslist = File::where("auction_id","$id")->get();
        return view('admin::Auction.auctionadd',compact('view','category','imageslist'));
    }
    
    public function deleteauctionfile(Request $request)
    {
        $id = base64_decode($_GET['Fiz']);
        $view = File::where('id', '=', $id)->first();
        if(empty($view)){ 
            return redirect('admin/auction')->with('errmsg','Something went wrong.Please try after sometime');
        }else{
            $file= File::find($id);
            $file->delete();
            return redirect('admin/editauction?Aiz='.base64_encode($view->auction_id))->with('msg','Delete successfully');
        }
    }
    
    public function ajax_updatepopular($status,$auction_id)
    {
        $auctiontotal = Auction::where("is_popular","1")->count();
        //echo $auctiontotal;exit;
        $auction= Auction::find($auction_id);
        if($status==0){
            $auction->is_popular = 0;
            $auction->save();
            echo 1;
        }else{
           if($auctiontotal<3){
            $auction->is_popular = 1;
            $auction->save();
            echo 1;
            
            }else{
                echo "100";
            }
        }
    }
    //EMAIl
    public function auction_start_mail($auction_id)
    {
        $auction = Auction::where("id",$auction_id)->first();
        if(!empty($auction)){
            $useremails = collect(DB::select("SELECT GROUP_CONCAT(email) as email FROM `users` WHERE email_verified_status=1 "))->first();
           
            $to = "$useremails->email";
            $subject = "Artavenue - Auction Start";
            
            $message =  view('admin::Email.auction_start',compact('auction'));
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <info@cloudwapp.in>' . "\r\n";
            //$headers .= 'From: <info@artavenueauction.com>' . "\r\n";
            
            mail($to,$subject,$message,$headers);
                 
        }
    }
    
     
}
