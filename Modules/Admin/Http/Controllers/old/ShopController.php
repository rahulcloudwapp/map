<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Admin;
use Hash;
use Session;
use App\Models\Shopcategory;
use App\Models\Shopbrand;
use App\Models\Shopmodel;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;

use Redirect;
use Auth;


class ShopController extends Controller
{
    
    public function __construct()
   {
        //   if (!empty(session()->has('admin_sess'))) {
                
        //     } else {
                
        //         return redirect('admin')->send();
        //     }
       
   }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
   
    public function index()
    {
        return view('admin::login');
    }
    
    // Category functions
    
    public function category()
    {
        
        $category = Shopcategory::where('status', '=', 1)->get();
        return view('admin::shopcategory',compact('category'));
    }
      public function addcategory(Request $request)
    {
        
        if($request->submit){
            // print_r($request->all());
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/img/category', $imageName);
              $imgpath = 'public/img/category/'.$imageName;
            }else{
              $imgpath = "";
            }
            $category= new Shopcategory;
            $category->name = $request->name;
           // $category->image = $imgpath;
            $category->status = 1;
            $category->save();
            if($category->id){
              return redirect('admin/shopcategory')->with('msg','Category added successfully.');  
            }else{
               return redirect('admin/shopcategory')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        return view('admin::shopcategoryadd');
    }
    
    public function catdelete($id)
    {
       
        $category= Shopcategory::find($id);
       
        $category->delete();
        return redirect('admin/shopcategory')->with("msg","Category deleted successfully");
    }
    
    public function catedit($id , Request $request)
    {
       
       if($request->submit){
            $cat = Shopcategory::where('id', '=', $id)->first();
           
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/img/category', $imageName);
              $imgpath = 'public/img/category/'.$imageName;
            }else{
              $imgpath = $cat->image;
            }
            $category= Shopcategory::find($id);
            $category->name = $request->name;
           // $category->image = $imgpath;
            $category->status = $cat->status;
           // $category->enable = $cat->enable;
            $category->save();
            if($category->id){
              return redirect('admin/shopcategory')->with('msg','Category Updated successfully.');  
            }else{
               return redirect('admin/shopcategory')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       $category = Shopcategory::where('id', '=', $id)->first();
       return view('admin::shopcategoryadd',compact('category'));
    }

   // Shopbrand functions 
   
    public function brand()
    {
       
        $view = Shopbrand::where('status', '=', 1)->get();
     
        return view('admin::shopbrand',compact('view'));
    }
      public function addbrand(Request $request)
    {
        
        if($request->submit){
            // print_r($request->all());
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/img/category', $imageName);
              $imgpath = 'public/img/category/'.$imageName;
            }else{
              $imgpath = "";
            }
            $Shopbrand= new Shopbrand;
            $Shopbrand->name = $request->name;
            $Shopbrand->image = $imgpath;
            $Shopbrand->status = 1;
            $Shopbrand->save();
            if($Shopbrand->id){
              return redirect('admin/shopbrand')->with('msg','Shopbrand added successfully.');  
            }else{
               return redirect('admin/shopbrand')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        return view('admin::shopbrandadd');
    }
    
    public function branddelete($id)
    {
       
        $Shopbrand= Shopbrand::find($id);
       
        $Shopbrand->delete();
        return redirect('admin/shopbrand')->with("msg","Shopbrand deleted successfully");
    }
    
    public function brandedit($id , Request $request)
    {
       if($request->submit){
            $subcat = Shopbrand::where('id', '=', $id)->first();
           
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/img/shopbrand', $imageName);
              $imgpath = 'public/img/shopbrand/'.$imageName;
            }else{
              $imgpath = $subcat->image;
            }
            $Shopbrand= Shopbrand::find($id);
            $Shopbrand->name = $request->name;
            $Shopbrand->image = $imgpath;
            $Shopbrand->save();
            if($Shopbrand->id){
              return redirect('admin/shopbrand')->with('msg','Shopbrand Updated successfully.');  
            }else{
               return redirect('admin/shopbrand')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       $records = Shopbrand::where('id', '=', $id)->first();
       return view('admin::shopbrandadd',compact('records'));
    }
    
    // Shop Product functions 
   
    public function product()
    {
        $view = Product::where('status', '=', 1)->get();
        return view('admin::product',compact('view'));
    }
      public function addproduct(Request $request)
    {
        
        if($request->submit){
            // echo "<pre>";
            //  print_r($request->all());print_r($_FILES); exit;
             if($request->hasFile('images'))
                {
                  foreach($request->file('images') as $image)
                  {
                    $imageName = Str::random(5).time().'.'.$image->extension();  
                    $image->move('public/img/product/', $imageName);
                    $imgpath[] = 'public/img/product/'.$imageName;
                  }
                
                $img = json_encode($imgpath);
                
                //$content->image = $allImages;
                
                }else{
                    $img = "";
                }
            $dis =   $request->actual_price - $request->discount_price; 
            $dis_per = ($dis*100)/$request->actual_price;
            $product= new Product;
            $product->name = $request->name;
            $product->brand_id = $request->brand_id;
            $product->cat_id = $request->cat_id;
            $product->actual_price = $request->actual_price;
            $product->discount_price = $request->discount_price;
            $product->dis_percent = $dis_per;
            $product->model_no = $request->model_no;
            $product->year = $request->year;
            $product->part_no = $request->part_no;
            $product->description = $request->description?:"";
            $product->images = $img;
            $product->status = 1;
            $product->save();
            if($product->id){
              return redirect('admin/product')->with('msg','Product added successfully.');  
            }else{
               return redirect('admin/product')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        $brand = Shopbrand::where('status', 1)->get();
        $category = Shopcategory::where('status', 1)->get();
        $page = "Add";
        return view('admin::productadd',compact('brand','category','page'));
    }
    
    public function productdelete($id)
    {
       
        $product= Product::find($id);
       
        $product->delete();
        return redirect('admin/product')->with("msg","Shopbrand deleted successfully");
    }
    
    public function productedit($id , Request $request)
    {
       $records = Product::where('id', '=', $id)->first();    
       if($request->submit){
            $subcat = Product::where('id', '=', $id)->first();
           
          if($request->hasFile('images'))
            {
              foreach($request->file('images') as $image)
              {
                $imageName = Str::random(5).time().'.'.$image->extension();  
                $image->move('public/img/product/', $imageName);
                $imgpath[] = 'public/img/product/'.$imageName;
            }
            $oldimg = json_decode($records->images);
            if(!empty($oldimg)){
               $imgpath = array_merge($oldimg,$imgpath); 
            }
            $img = json_encode($imgpath);
            
            //$content->image = $allImages;
            
            }else{
                $img = $records->images;
            }
            $product= Product::find($id);
            $product->name = $request->name;
            $product->brand_id = $request->brand_id;
            $product->cat_id = $request->cat_id;
            $product->actual_price = $request->actual_price;
            $product->discount_price = $request->discount_price;
            $product->model_no = $request->model_no;
            $product->year = $request->year;
            $product->part_no = $request->part_no;
            $product->description = $request->description?:"";;
            $product->images = $img;
            $product->save();
            if($product->id){
              return redirect('admin/product')->with('msg','Shopbrand Updated successfully.');  
            }else{
               return redirect('admin/product')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       
       $brand = Shopbrand::where('status', 1)->get();
       $category = Shopcategory::where('status', 1)->get();
       $page = "Edit";
       return view('admin::productadd',compact('records','brand','category','page'));
    }
    
    public function getproductimages(Request $request)
    {
         $id = $request->prod_id; 
         $product = Product::where('id',$id)->first();
         if($product && $product->images!=NULL){
              $view = json_decode($product->images);
              $page = "product";
             return view('admin::images',compact('view','page'));
         }
        
        
       
    }
    public function order($type)
    {
        if($type=="new"){
           $view = Order::where('status', 1)->orderBy('id', 'DESC')->get(); 
        }elseif($type=="process"){
           $view = Order::where('status', 2)->orderBy('id', 'DESC')->get(); 
        }elseif($type=="shipped"){
            $view = Order::where('status', 3)->orderBy('id', 'DESC')->get();
        }else{
            $view = Order::where('status', 4)->orderBy('id', 'DESC')->get();
        }
        
        return view('admin::orders',compact('view'));
    }
    
    public function changestatus(Request $request)
    {
         $id = $request->order_id; 
         $st = $request->status; 
         $orderdata = Order::where('id',$id)->first();
         if($orderdata){
             $ord= Order::find($id);
             $ord->status = $st; 
             $ord->save();
             if($ord){
                 $orderdata = Order::where('id',$id)->first();
                 echo $orderdata->status;
             }else{
                 echo "0";
             }
        }
        
        
       
    }
    
     public function popular(Request $request)
    {
         $brand_id = $request->brand_id;
         $popular = $request->br_val; 
         
         $branddata = Shopbrand::where('id',$brand_id)->first();
         if($popular==0){
            $popularbrand = Shopbrand::where('popular',1)->get();
         if(count($popularbrand)>0 && count($popularbrand)==8){
             echo count($popularbrand); exit;
         }  
         }
        
         if($branddata){
             if($popular==1){
                $pop = 0; 
             }else{
                 $pop = 1;  
             }
             $ord= Shopbrand::find($brand_id);
             $ord->popular = $pop; 
             $ord->save();
             if($ord){
                 $branddata = Shopbrand::where('id',$brand_id)->first();
                 echo $branddata->popular;
             }else{
                 echo "0";
             }
         }
        
        
       
    }
    
    public function orderview($id)
    {
        $view = Order::where('id', $id)->first();
        $admin = Admin::where('id', 1)->first();
        $userdata = User::where('id', $view->user_id)->first();
        $orderdetail = Orderdetail::where('order_id', $id)->get();
        return view('admin::orderview',compact('view','admin','userdata','orderdetail'));
    }
    
    
     
     
}
