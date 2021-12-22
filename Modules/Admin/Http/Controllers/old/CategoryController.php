<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Hash;
use Session;



use Redirect;
use Auth;


class CategoryController extends Controller
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
         $view = Category::orderBy('id',"desc")->get();
        return view('admin::Category.categorylist',compact('view'));
    }
    
    public function add(Request $request)
    {
         if($request->submit){
             //print_r($request->all());die();
            
            $category= new Category;
            $category->name = $request->name;
            $category->lat_name = $request->lat_name;
            $category->rus_name = $request->rus_name;
            $category->status = 1;
            $category->save();
            if($category->id){
              return redirect('admin/category')->with('msg','Category added successfully.');  
            }else{
               return redirect('admin/category')->with('errmsg','Something went wrong.Please try after sometime');   
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
            $category->lat_name = $request->lat_name;
            $category->rus_name = $request->rus_name;
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
