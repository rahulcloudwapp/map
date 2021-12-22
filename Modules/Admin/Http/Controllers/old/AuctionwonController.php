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


class AuctionwonController extends Controller
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
        $currdate = date("Y-m-d H:i:s");
           
            $view = DB::table('auctions')->select('auctions.*','t2.user_id')->join(DB::raw("(SELECT *,MAX(amount) FROM `auction_bids` where 1 GROUP by auction_id)  t2"), 
            function($join)
            {
               $join->on('auctions.id', '=', 't2.auction_id');
            });
            $view = $view->where('auctions.lastbid_datetime', '<',"$currdate")->get();
            //echo "<pre>";print_r($view);exit;
        return view('admin::Auctionwon.auctionwon',compact("view"));
    }
    public function auctionwon_detail()
    {
        $id = base64_decode($_GET['Aiz']);
       
        $currdate = date("Y-m-d H:i:s");
           
            $view = DB::table('auctions')->select('auctions.*','t2.user_id','t2.amount as wonamt','t2.created_at as wondatetime')->join(DB::raw("(SELECT *,MAX(amount) FROM `auction_bids` where 1 GROUP by auction_id)  t2"), 
            function($join)
            {
               $join->on('auctions.id', '=', 't2.auction_id');
            });
            $view = $view->where('auctions.id', $id);
            $view = $view->where('auctions.lastbid_datetime', '<',"$currdate")->first();
          // echo "<pre>";print_r($view);exit;
            if(empty($view)){ return redirect('admin/auctionwon')->with('errmsg','Something went wrong.Please try after sometime');    }
        return view('admin::Auctionwon.auctionwon_detail',compact("view"));
    }
    
   
     
}
