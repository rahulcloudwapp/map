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
use App\Models\User_lot;
use Hash;
use Session;



use Redirect;
use Auth;


class AuctionrequestController extends Controller
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
        $view = User_lot::orderBy('id',"desc")->get();
        return view('admin::Requestauction.auction_request_list',compact("view"));
    }
    
    public function add(Request $request)
    {
        $id = base64_decode($_GET['Riz']);
        $view = User_lot::where('id',"$id")->first();
        if(empty($view)){ return redirect('admin/auction_request')->with('errmsg','Something went wrong.Please try after sometime'); }
      
        $category = Category::where("status","1")->get();
        
       
            
        if($request->submit){
            
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
            $auction->request_by = $view->user_id;
            $auction->status = 1;
            $auction->save();
            if($auction->id){
                
                $user_lot= User_lot::find($id);
                $user_lot->status=1;
                $user_lot->save();
                
                if($view->image!=""){
                    $imageslist = explode(",",$view->image);
                    foreach($imageslist as $img){
                        $file= new File;
                        $file->auction_id = $auction->id;
                        $file->path = $img;
                        $file->save();
                    }
                }
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
               
              return redirect('admin/auction_request')->with('msg','Auction Request Add successfully.');  
            }else{
               return redirect('admin/auction-request-add?Riz='.base64_encode($id))->with('errmsg','Something went wrong.Please try after sometime');   
            }
        }
        return view('admin::Requestauction.requestdd',compact("view","category"));
    }
    
    
    
     
}
