<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;

use Hash;
use Session;



use Redirect;
use Auth;


class AdminController extends Controller
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
        //return view('admin::login');
    }
    public function profile(Request $request)
    {
        
        if($request->submit){
             $records = Admin::where('id', '=', 1)->first();
            $request->validate([
                    'name'=>'required',
                    'phone'=>'required',
                ]);
            
             if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/upload/admin', $imageName);
              $imgpath = 'public/upload/admin/'.$imageName;
            }else{
              $imgpath = $records->image;
            }
            $admin= new Admin;
            $admin= Admin::find(1);
            $admin->name = $request->name;
            $admin->phone = $request->phone;
            //$admin->email = $request->email;
            $admin->image = $imgpath;
            
            $admin->save();
            if($admin){
              return redirect('admin/profile')->with('message','Profile updated successfully.');  
            }else{
               return redirect('admin/profile')->with('errmessage','Something went wrong.Please try after sometime');   
            }
           
        }
        
        
         if($request->changepassword){
             $records = Admin::where('id', '=', 1)->first();
                $request->validate([
                    'old_pass'=>'required',
                    'newpass'=>'required|min:6',
                    'cnewpass'=>'required|min:6|same:newpass'
                ],[
                    'old_pass.required'=>'The Old Password field is required.',
                    'newpass.required'=>'The New Password field is required.',
                    'cnewpass.required'=>'The Confirm New Password field is required.',
                    'newpass.min'=>'The New Password  must be at least 6 characters.',
                    'cnewpass.min'=>'The Confirm New Password  must be at least 6 characters.',
                    'cnewpass.same'=>'The Confirm New Password and New Password must match.',
                    ]);
               //echo Hash::make($request->old_pass); 
                if(Hash::check($request->old_pass,$records->password)){
                   $admin= new Admin;
                   $admin = Admin::find($records->id);
                   $admin->password = Hash::make($request->newpass);
                   $admin->save();
                   if($admin){
                      return redirect('admin/profile')->with('message','Password changed successfully.');  
                    }else{
                       return redirect('admin/profile')->with('errmessage','Something went wrong.Please try after sometime');   
                    } 
                }else{
                    return redirect('admin/profile')->with('errmessage','Old Password Not Match');
                }
           
        } 
        $view = Admin::where('id',1)->first();
         return view('admin::Profile.profile',compact('view'));;
    }
    
    
    public function dashboard()
    {
       //  return Auth::guard('admin')->user();
        //$users = User::count(); 
         
        return view('admin::dashboard');
    }
    
     public function logout()
    {
        // session()->forget('admin_sess');
        Auth::guard('admin')->logout();
        return  redirect('admin/');
    }
    
      // Car Brands functions
    
    public function brands()
    {
        $view = Brand::where('status', '=', 1)->get();
     
        return view('admin::brand',compact('view'));
    }
      public function addbrand(Request $request)
    {
        
        if($request->submit){
            // print_r($request->all());
             if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();  
              $request->image->move('public/img/brand/', $imageName);
              $imgpath = 'public/img/brand/'.$imageName;
            }else{
              $imgpath = "";
            }
            $brand= new Brand;
            $brand->name = $request->name;
            $brand->logo = $imgpath;
            $brand->status = 1;
            $brand->save();
            if($brand->id){
              return redirect('admin/brands')->with('msg','Car Brand added successfully.');  
            }else{
               return redirect('admin/brands')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        return view('admin::brandadd');
    }
    
    public function branddelete($id)
    {
       
        $brand= Brand::find($id);
       
        $brand->delete();
        return redirect('admin/brands')->with("msg","Car brand deleted successfully");
    }
    
    public function brandedit($id , Request $request)
    {
       if($request->submit){
            $brand = Brand::where('id', '=', $id)->first();
           
             if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();  
              $request->image->move('public/img/brand/', $imageName);
              $imgpath = 'public/img/brand/'.$imageName;
            }else{
              $imgpath = $brand->logo;
            }
            $brand= Brand::find($id);
            $brand->name = $request->name;
            $brand->logo = $imgpath;
            $brand->status = $brand->status;
            $brand->save();
            if($brand->id){
              return redirect('admin/brands')->with('msg','Car Brand Updated successfully.');  
            }else{
               return redirect('admin/brands')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       $records = Brand::where('id', '=', $id)->first();
       return view('admin::brandadd',compact('records'));
    }
    
    
   // Car Model functions 
   
    public function carmodels()
    {
        $view = Model::where('status', '=', 1)->get();
     
        return view('admin::model',compact('view'));
    }
      public function addmodel(Request $request)
    {
        
        if($request->submit){
            // print_r($request->all());
           
            $model =  new Model;
            $model->brand_id = $request->brand_id;
            $model->name = $request->name;
            $model->status = 1;
            $model->save();
            if($model->id){
              return redirect('admin/carmodels')->with('msg','Car Model has been added successfully.');  
            }else{
               return redirect('admin/carmodels')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        $brands = Brand::where('status', '=', 1)->get();
        return view('admin::modeladd',compact('brands'));
    }
    
    public function modeldelete($id)
    {
       
        $model= Model::find($id);
       
        $model->delete();
        return redirect('admin/carmodels')->with("msg","'Car Model has been deleted successfully");
    }
    
    public function modeledit($id , Request $request)
    {
       if($request->submit){
            $model = Model::where('id', '=', $id)->first();
           
           
            $model= Model::find($id);
            $model->brand_id = $request->brand_id;
            $model->name = $request->name;
            $model->status = $model->status;
            $model->save();
            if($model->id){
              return redirect('admin/carmodels')->with('msg','Car Model Updated successfully.');  
            }else{
               return redirect('admin/carmodels')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       $records = Model::where('id', '=', $id)->first();
       $brands = Brand::where('status', '=', 1)->get();
       return view('admin::modeladd',compact('records','brands'));
    }


    public function cars()
    {
        $view = Car::where('status', 1)->orderBy('id','DESC')->get();
     
        return view('admin::cars',compact('view'));
    }
      public function addcar(Request $request)
    {
        
        if($request->submit){
         //   echo "<pre>"; print_r($request->all());exit;
         //return $request->all();   
         if($request->hasFile('images'))
         {
          foreach($request->file('images') as $image)
          {
            $imageName = Str::random(5).time().'.'.$image->extension();  
            $image->move('public/img/car/', $imageName);
            $imgpath[] = 'public/img/car/'.$imageName;
         }
         $img = json_encode($imgpath);
        }else{
            $img = "";
        }
        
            // if(count($request->links)>0){
            //     $links = json_encode($request->links); 
            // }
            $car= new Car;
            $car->brand_id = $request->brand_id;
            $car->model_id = $request->model_id;
            $car->title = $request->title;
            $car->description = $request->description;
            $car->importer_price = $request->importer_price;
            $car->licence_price = $request->licence_price;
            $car->opinion = $request->opinion;
            //$car->links = $links;
            $car->images = $img;
            $car->status = 1;
            $car->save();
            if($car->id){
              $sptitle = $request->sptitle;
              $detail = $request->detail;
              if(!empty($sptitle[0]) && count($sptitle)>0){
                foreach($sptitle as $k=>$sp){
                 $spec = new Specification;
                 $spec->car_id = $car->id;
                 $spec->title = $sp;
                 $spec->detail = $detail[$k];
                 $spec->save();
                }
              }
              $linktitle = $request->linktitle;
              $urls = $request->links;
              if(!empty($linktitle[0]) && count($linktitle)>0){
                foreach($linktitle as $key=>$lnk){
                 $links = new Link;
                 $links->car_id = $car->id;
                 $links->title = $lnk;
                 $links->url = $urls[$key];
                 $links->save();
                }
              }
              return redirect('admin/cars')->with('msg','Car has been added successfully.');  
            }else{
               return redirect('admin/cars')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        $brands = Brand::where('status', 1)->get();
        return view('admin::caradd',compact('brands'));
    }
    
    public function deletecar($id)
    {
       
        $car= Car::find($id);
        $car->delete();
        return redirect('admin/cars')->with("msg","Car has been deleted successfully");
    }
    
    public function editcar($id , Request $request)
    {
       if($request->submit){
        $cardata = Car::where('id', $id)->first();
        if($request->hasFile('images'))
        {
          foreach($request->file('images') as $image)
          {
            $imageName = Str::random(5).time().'.'.$image->extension();  
            $image->move('public/img/car/', $imageName);
            $imgpath[] = 'public/img/car/'.$imageName;
          }
        if($cardata->images==""){
           $allimg = $imgpath;
        }else{
          $oldimg = json_decode($cardata->images);
          $allimg = array_merge($imgpath,$oldimg);
        }  
        
        $img = json_encode($allimg);
        }else{
            $img = $cardata->images;
        }

         if(count($request->links)>0){
                //$oldlink = json_decode($cardata->links);
               // $alllinks = array_merge($request->links,$oldlink);
                $links = json_encode($request->links); 
            }else{
                $links = $cardata->links;
            }
            
            $car= Car::find($id);
            $car->brand_id = $request->brand_id;
            $car->model_id = $request->model_id;
            $car->title = $request->title;
            $car->description = $request->description;
            $car->importer_price = $request->importer_price;
            $car->licence_price = $request->licence_price;
            $car->opinion = $request->opinion;
            $car->links = $links;
            $car->images = $img;
            $car->save();
            if($car){
              $oldspec= Specification::where('car_id',$id)->delete();
              $oldlinks= Link::where('car_id',$id)->delete();
              $sptitle = $request->sptitle;
              $detail = $request->detail;
              if(!empty($sptitle[0]) && count($sptitle)>0){
                foreach($sptitle as $k=>$sp){
                 $spec = new Specification;
                 $spec->car_id = $car->id;
                 $spec->title = $sp;
                 $spec->detail = $detail[$k];
                 $spec->save();
                }
              }
              $linktitle = $request->linktitle;
              $urls = $request->links;
              if(!empty($linktitle[0]) && count($linktitle)>0){
                foreach($linktitle as $key=>$lnk){
                 $links = new Link;
                 $links->car_id = $car->id;
                 $links->title = $lnk;
                 $links->url = $urls[$key];
                 $links->save();
                }
              }
              return redirect('admin/cars')->with('msg','Car has been updated successfully.');  
            }else{
               return redirect('admin/cars')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       $view = Car::where('id', $id)->first();
       $brands = Brand::where('status', 1)->get();
       $models = Model::where('status', 1)->where('brand_id',$view->brand_id)->get();
       $links = Link::where('car_id',$view->id)->get();
       $images = json_decode($view->images);
       $specification = Specification::where('car_id',$view->id)->get();
       return view('admin::caradd',compact('view','brands','models','links','images','specification'));
    }
    
  
    public function getmodel(Request $request)
    {
       
         $brand_id = $request->brand_id; 
         $model = Model::where('status', 1)->where('brand_id',$brand_id)->get();
       
        echo "<option value=''>--Select Brand--</option>";
        if(!empty($model)){

           foreach($model as $md){
              echo "<option value='$md->id'>$md->name</option>"; 
           } 
        }
       
    }

    public function deletelinkold(Request $request)
    {
        $id = $request->car_id; 
        $car= Car::find($id);
        $links = json_decode($car->links);
        unset($links[$request->index]);
        //if(count($links)>0){
          $lnkstr = json_encode($links);
          $car->links = $lnkstr;
          $car->save();
          if($car){
            echo "1";
          }else{
            echo "0";
          }
       // }
        
    }
    public function deleteimg(Request $request)
    {

        $id = $request->car_id; 
        $car= Car::find($id);
        $images = json_decode($car->images);
        unset($images[$request->index]);
        //if(count($images)>0){
          $imgstr = json_encode($images);
          $car->images = $imgstr;
          $car->save();
          if($car){
            echo "1";
          }else{
            echo "0";
          }
       // }
        
    }
    public function deletespec(Request $request)
    {

        $id = $request->index; 
        $car= Specification::find($id);
        $car->delete();
        echo "1";
    }
    public function deletelink(Request $request)
    {

        $id = $request->index; 
        $car= Link::find($id);
        $car->delete();
        echo "1";
    }
    

       public function getcarimages(Request $request)
    {
         $id = $request->com_id; 
         $car = Car::where('id',$id)->first();
         //return $comp->images;
          if($car && $car->images!=NULL){
              $view = json_decode($car->images);
              $page = "product";
              return view('admin::images',compact('view','page'));
         }else{
             return "<center style='color:red;font-size: 20px;'> No Image Found!</center>";
         }
        
       
    }

     // Car Supplier functions 
   
    public function supplier()
    {
        $view = Supplier::where('status', 1)->get();
        return view('admin::supplier',compact('view'));
    }
      public function addsupplier(Request $request)
    {

       // echo env('CIPHER'); die;
        if($request->submit){
           
             $chk =  Supplier::where('email', $request->email)->first();
             if($chk){
                return redirect('admin/supplier')->with('errmsg','Email Id is alredy exist');   
             }
            // print_r($request->all());
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();  
              $request->image->move('public/img/supplier/', $imageName);
              $imgpath = 'public/img/supplier/'.$imageName;
            }else{
              $imgpath = "";
            }
            $password = Str::random(6);
            $pass = Crypt::encryptString($password); 
            $supplier =  new Supplier;
            $supplier->description = $request->description;
            $supplier->name = $request->name;
            $supplier->user_id = Str::random(6);
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->password = $pass;
            $supplier->logo = $imgpath;
            $supplier->status = 1;
            $supplier->save();
            if($supplier->id){
              $this->sendmail($supplier->id);  
              return redirect('admin/supplier')->with('msg','Supplier has been added successfully.');  
            }else{
               return redirect('admin/supplier')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        return view('admin::supplieradd');
    }
    
    public function deletesupplier($id)
    {
        $supp= Supplier::find($id);
        $supp->delete();
        return redirect('admin/supplier')->with("msg","Supplier has been deleted successfully");
    }
    
    public function editsupplier($id , Request $request)
    {
       $view = Supplier::where('id', $id)->first(); 
       if($request->submit){
            $chk =  Supplier::where('email', $request->email)->where('id','!=',$id)->first();
             if($chk){
                return redirect('admin/supplier')->with('errmsg','Email Id is alredy exist');   
             }
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();  
              $request->image->move('public/img/supplier/', $imageName);
              $imgpath = 'public/img/supplier/'.$imageName;
            }else{
              $imgpath = $view->logo;
            }
            $supp= Supplier::find($id);
            $supp->description = $request->description;
            $supp->name = $request->name;
            $supp->email = $request->email;
            $supp->phone = $request->phone;
            $supp->logo = $imgpath;
            $supp->save();
            if($supp->id){
              return redirect('admin/supplier')->with('msg','Supplier has been Updated successfully.');  
            }else{
               return redirect('admin/supplier')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       
       return view('admin::supplieradd',compact('view'));
    }
    

    
    
     
    
     // Banner functions
    
    public function banner(Request $request)
    {
      if($request->submit){
        // print_r($request->all());
        if($request->hasFile('images'))
        {
          foreach($request->file('images') as $image)
          {
            $imageName = Str::random(5).time().'.'.$image->extension();  
            $image->move('public/img/banner/', $imageName);
            $imgpath = 'public/img/banner/'.$imageName;
            $banner= new Banner;
            $banner->name = $imageName;
            $banner->path = $imgpath;
            $banner->status = 1;
            $banner->save();
        }
        }else{
            $img = "";
        }
        
        if($banner->id){
          return redirect('admin/banner')->with('msg','Banner Images added successfully.');  
        }else{
           return redirect('admin/banner')->with('errmsg','Something went wrong.Please try after sometime');   
        }
       
    }
        $view = Banner::get();
        return view('admin::banneradd',compact('view'));
    }
      public function addbanner(Request $request)
    {
        
        if($request->submit){
            // print_r($request->all());
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/img/banner', $imageName);
              $imgpath = 'public/img/banner/'.$imageName;
            }else{
              $imgpath = "";
            }
            $banner= new Banner;
            $banner->merchant_id = $request->merchant_id;
            $banner->offer_id = $request->offer_id?:"";
            $banner->image = $imgpath;
            $banner->status = 1;
            $banner->save();
            if($banner->id){
              return redirect('admin/banner')->with('msg','Banner added successfully.');  
            }else{
               return redirect('admin/banner')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
         $merchant = User::where('status', '=', 2)->get();
        return view('admin::banneradd',compact('merchant'));
    }
    
    public function bannerdelete($id)
    {
       
        $banner= Banner::find($id);
        $banner->delete();
        return redirect('admin/banner')->with("msg","Banner has been deleted successfully");
    }
    
    public function banneredit($id , Request $request)
    {
       if($request->submit){
            $bannerdata = Banner::where('id', '=', $id)->first();
           
            if($request->hasFile('image')){
              $file = $request->image;
              $imageName = time().'.'.$file->getClientOriginalExtension();
              $request->image->move('public/img/banner', $imageName);
              $imgpath = 'public/img/banner/'.$imageName;
            }else{
              $imgpath = $cat->image;
            }
            $banner= Banner::find($id);
            $banner->merchant_id = $request->merchant_id;
            $banner->offer_id = $request->offer_id?:"";
            $banner->image = $imgpath;
            $banner->save();
            if($banner){
              return redirect('admin/banner')->with('msg','Banner Updated successfully.');  
            }else{
               return redirect('admin/banner')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
       $records = Banner::where('id', '=', $id)->first();
       $merchant = User::where('status', 2)->get();
       $offer = Offer::where('merchant_id', $records->merchant_id)->where('status',1)->get();
       return view('admin::banneradd',compact('records','merchant','offer'));
    }
      // Vendor functions
    
      public function vendor(Request $request)
      {
          $view = Vendor::get();
          return view('admin::vendor',compact('view'));
      }
        public function addvendor(Request $request)
      {
          
          if($request->submit){
              // print_r($request->all());
              if($request->hasFile('image')){
                $file = $request->image;
                $imageName = time().'.'.$file->getClientOriginalExtension();
                $request->image->move('public/img/vendor', $imageName);
                $imgpath = 'public/img/vendor/'.$imageName;
              }else{
                $imgpath = "";
              }
              $vendor= new Vendor;
              $vendor->name = $request->name;
              $vendor->description = $request->description;
              $vendor->status = 1;
              $vendor->save();
              if($vendor->id){
                return redirect('admin/vendor')->with('msg','Vendor has been added successfully.');  
              }else{
                 return redirect('admin/vendor')->with('errmsg','Something went wrong.Please try after sometime');   
              }
             
          }
          return view('admin::vendoradd');
      }
      
      public function deletevendor($id)
      {
         
          $banner= Vendor::find($id);
          $banner->delete();
          return redirect('admin/vendor')->with("msg","Vendor has been deleted successfully");
      }
      
      public function editvendor($id , Request $request)
      {
         if($request->submit){
              $vendordata = Vendor::where('id', $id)->first();
             
              // if($request->hasFile('image')){
              //   $file = $request->image;
              //   $imageName = time().'.'.$file->getClientOriginalExtension();
              //   $request->image->move('public/img/vendor', $imageName);
              //   $imgpath = 'public/img/banner/'.$imageName;
              // }else{
              //   $imgpath = $cat->image;
              // }
              $vendor= Vendor::find($id);
              $vendor->name = $request->name;
              $vendor->description = $request->description?:"";
              $vendor->save();
              if($vendor){
                return redirect('admin/vendor')->with('msg','Vendor has been Updated successfully.');  
              }else{
                 return redirect('admin/vendor')->with('errmsg','Something went wrong.Please try after sometime');   
              }
             
          }
         $view = Vendor::where('id', $id)->first();
         return view('admin::vendoradd',compact('view'));
      }
     
    public function terms(Request $request)
    {
        $view = Admin::where('id', 1)->first();
        if($request->submit){
            
            $terms= Admin::find($view->id);
            $terms->terms = $request->terms;
            $terms->save();
            if($terms){
              return redirect('admin/terms')->with('msg','Terms & Condition updated successfully.');  
            }else{
               return redirect('admin/terms')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        return view('admin::terms',compact('view'));
    }
    
    public function about(Request $request)
    {
        $view = Admin::where('id', 1)->first();
        if($request->submit){
            
            $terms= Admin::find($view->id);
            $terms->about = $request->about;
            $terms->save();
            if($terms){
              return redirect('admin/about')->with('msg','About us has been updated successfully.');  
            }else{
               return redirect('admin/about')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
     
        return view('admin::aboutus',compact('view'));
    }
     public function privacy(Request $request)
    {
        $view = Admin::where('id', 1)->first();
        if($request->submit){
            
            $terms= Admin::find($view->id);
            $terms->privacy = $request->privacy;
            $terms->save();
            if($terms){
              return redirect('admin/privacy')->with('msg','Privacy policy has been updated successfully.');  
            }else{
               return redirect('admin/privacy')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        return view('admin::privacy',compact('view'));
    }
       public function contactpage(Request $request)
    {
        $view = Admin::where('id', 1)->first();
        if($request->submit){
            
            $terms= Admin::find($view->id);
            $terms->contact = $request->contact;
            $terms->save();
            if($terms){
              return redirect('admin/contactpage')->with('msg','Contact us has been updated successfully.');  
            }else{
               return redirect('admin/contactpage')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        return view('admin::contact',compact('view'));
    }
    public function homepage(Request $request)
    {
        $view = Admin::where('id', 1)->first();
        if($request->submit){
            
            $terms= Admin::find($view->id);
            $terms->homepage = $request->homepage;
            $terms->save();
            if($terms){
              return redirect('admin/homepage')->with('msg','Homepage has been updated successfully.');  
            }else{
               return redirect('admin/homepage')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        return view('admin::homepage',compact('view'));
    }
     public function user()
    {
        $view = User::where('status', 1)->get();
        return view('admin::user',compact('view'));
    }
    public function pricing()
    {
        //$brands = Brand::where('status', 1)->get();
        $supplier = Supplier::where('status', 1)->get();

        $brands = Brand::select('brands.*')
                  ->where('brands.status',1)
                  ->where('cars.status',1)
                  ->join('cars', 'cars.brand_id', '=', 'brands.id')
                  ->groupBy('brands.id')
                  ->orderBy('brands.id', 'ASC')
                  ->get();
        return view('admin::pricing',compact('brands','supplier'));
    }
     public function changeprice(Request $request)
    {
        $price = $request->price;
        $supplier_id = $request->sup_id;
        $car_id = $request->car_id;
        $pricing = Price::where('car_id', $car_id)->where('supplier_id',$supplier_id)->first();
        // if($pricing){
        //   $prc= Price::find($pricing->id);
        //   $prc->price = $price;
        //   $prc->save();
        //   if($prc){
        //     $pricing = Price::where('id', $pricing->id)->first();
        //     echo date('d/m/Y',strtotime($pricing->updated_at));   
        //   }else{
        //     echo "0";
        //   }
        // }else{
          $prc= new Price;  
          $prc->supplier_id = $supplier_id;
          $prc->car_id = $car_id;  
          $prc->price = $price;
          $prc->save();
          if($prc->id){
            $pricing = Price::where('id', $prc->id)->first();
            echo date('d/m/Y',strtotime($pricing->updated_at));  
          }else{
            echo "0";
          }
      //  }
        
        
    }
    
     public function openhistory(Request $request)
    {
        
        $supplier_id = $request->sup_id;
        $car_id = $request->car_id;
         $view = Price::where('car_id', $car_id)->where('supplier_id',$supplier_id)->get();
      
          if(!empty($view)){
             return view('admin::pricingmodal',compact('view')); 
          }else{
            echo "0";
          }
   
    }
      
       public function sendmail($id)
    {
         $supplier = Supplier::where('id', $id)->first();
         $decrypted = Crypt::decryptString($supplier->password);
         $message = '<!DOCTYPE html>
<html lang="en">
<head>
    <title> Aseafiesta </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div style="width: 600px; background: #f1efef; display: block; margin-left: auto; margin-right: auto; margin-top: 15px;" class="main_outer">
    <div style="width: 100%; padding: 35px 0px; background: #FF6C34; border: 1px solid #d0cece;">
        <h1 style="text-align: center; margin: auto; color: #fff; font-weight: 600; letter-spacing: 1px;"> Domy </h1>
    </div>
    <div style="width: 100%; padding: 30px 0px; background: #f5f5f5;">
        <div style="width: 100%; padding: 0px 20px; background: none;">
            <h3 style="margin: 0; text-align: center; font-weight: 600; font-size: 24px; color: #333;     margin-bottom: 40px;"> Supplier Registration </h3>
            <h5 style="margin: 0; text-align: center; font-size: 17px; padding: 0 45px; line-height: 25px; color: #555;"> Your account is activated. Now you can login and start your application. </h5>
            <div style="margin-bottom: 20px; margin-top: 40px;">
                <label style="margin-bottom: 0; text-align: left; font-size: 18px; color: #555; font-weight: 200;"> <span style="display: inline-block; width: 190px; color: #333; font-weight: 600;">Name </span> '.$supplier->name.' </label>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="margin-bottom: 0; text-align: left; font-size: 18px; color: #555; font-weight: 200;"> <span style="display: inline-block; width: 190px; color: #333; font-weight: 600;">Email </span> '.$supplier->email.' </label>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="margin-bottom: 0; text-align: left; font-size: 18px; color: #555; font-weight: 200;"> <span style="display: inline-block; width: 190px; color: #333; font-weight: 600;">Phone Number </span> '.$supplier->phone.' </label>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="margin-bottom: 0; text-align: left; font-size: 18px; color: #555; font-weight: 200;"> <span style="display: inline-block; width: 190px; color: #333; font-weight: 600;">User Id </span> '.$supplier->user_id.' </label>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="margin-bottom: 0; text-align: left; font-size: 18px; color: #555; font-weight: 200;"> <span style="display: inline-block; width: 190px; color: #333; font-weight: 600;">Your Password </span> '.$decrypted.' </label>
            </div>

            <!-- <center style="margin-top: 40px;"> <button style="background: #1246FF; border: none; color: #fff; padding: 8px 20px; font-size: 17px; border-radius: 2px; outline: none; min-width: 150px;" type="button"> Click here </button> </center> -->

        </div>
    </div>
    <div style="width: 100%; background: #FF6C34; padding: 20px 0px;">
        <p style="margin: 0; text-align: center; color: #fff; letter-spacing: 1px;"> &copy; copyright | All rights reserved </p>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>';
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <project@cloudwapp.in>' . "\r\n";
            
            $subject = "Domy";
            mail($supplier->email,$subject,$message,$headers);
        
       
    }
    
    
     
}
