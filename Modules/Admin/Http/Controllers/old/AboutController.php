<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\About;
use Hash;
use Session;



use Redirect;
use Auth;


class AboutController extends Controller
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
         $view = About::first();
        return view('admin::About.about',compact('view'));
    }
    
    public function update(Request $request)
    {
         $view = About::first();
        // echo "<pre>";print_r($view);die();
         if($request->submit){
             //print_r($request->all());die();
            if(!empty($view))
            {
                if($request->hasFile('image1')){
                      $file = $request->image1;
                      $imageName = "image1_".time().'.'.$file->getClientOriginalExtension();
                      $request->image1->move('public/upload/about', $imageName);
                      $img1path = 'public/upload/about/'.$imageName;
                    }else{
                      $img1path = $view->image1;
                    }
                    if($request->hasFile('image2')){
                      $file = $request->image2;
                      $imageName = "image2_".time().'.'.$file->getClientOriginalExtension();
                      $request->image2->move('public/upload/about', $imageName);
                      $img2path = 'public/upload/about/'.$imageName;
                    }else{
                      $img2path = $view->image2;
                    }
                $about= About::find($view->id);
                $msg ="added";
            }else{
                if($request->hasFile('image1')){
                      $file = $request->image1;
                      $imageName = "image1_".time().'.'.$file->getClientOriginalExtension();
                      $request->image1->move('public/upload/about', $imageName);
                      $img1path = 'public/upload/about/'.$imageName;
                    }else{
                      $img1path = '';
                    }
                    if($request->hasFile('image2')){
                      $file = $request->image2;
                      $imageName = "image2_".time().'.'.$file->getClientOriginalExtension();
                      $request->image2->move('public/upload/about', $imageName);
                      $img2path = 'public/upload/about/'.$imageName;
                    }else{
                      $img2path = '';
                    }
                $about= new About;
                $msg ="updated";
            }
            
                $about->title = $request->title;
                $about->lat_title = $request->lat_title;
                $about->rus_title = $request->rus_title;
                $about->description = $request->description;
                $about->lat_description = $request->lat_description;
                $about->rus_description = $request->rus_description;
                $about->image1 = $img1path;
                $about->image2 = $img2path;
                $about->save();
            
            if($about->id){
              return redirect('admin/about')->with('msg',"About $msg successfully.");  
            }else{
               return redirect('admin/about')->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        return view('admin::Category.categoryadd');
    }
    
    public function edit(Request $request)
    {
        $id = base64_decode($_GET['Ciz']);
        $view = Category::where('id', '=', $id)->first();
        if(empty($view)){ return redirect('admin/category')->with('errmsg','Something went wrong.Please try after sometime');    }
         if($request->submit){
            // print_r($request->all());die();
           
            $category= Category::find($id);
            $category->name = $request->name;
            $category->save();
            if($category->id){
              return redirect('admin/category')->with('msg','Category Updated successfully.');  
            }else{
               return redirect('admin/editcategory?Ciz='.base64_encode($id))->with('errmsg','Something went wrong.Please try after sometime');   
            }
           
        }
        
        return view('admin::Category.categoryadd',compact('view'));
    }
    
    
    
    
     
}
