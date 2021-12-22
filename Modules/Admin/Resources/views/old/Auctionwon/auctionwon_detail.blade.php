@extends('admin::layouts.master')
@section('content')
<div class="content-wrapper" style="min-height: 565px;">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Auction Winner
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><a href="#">Auction Winner</a></li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Default box -->
      <div class="box">
         <div class="box-header with-border">
            <h3 class="box-title">Auction Winner</h3>
            <a href="{{ url('admin/auctionwon') }}" class="btn btn-success pull-right">Back</a>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-4">
                  <h3>Auction Details</h3>
                  
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Category</label>
                           <?php $category = DB::table('categories')->where('id',$view->category_id)->first(); echo $category->name."/".$category->lat_name."/".$category->rus_name; ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Title</label>
                           {{ $view->title.'/'.$view->lat_title.'/'.$view->rus_title }}
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Start Date Time</label>
                           {{ $view->start_datetime }}               
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">End Date Time</label>
                           {{ $view->end_datetime }}        
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Starting Price</label>
                           {{ $view->starting_price }}        
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Description</label>
                           {{ $view->description }}           
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Latvian Description</label>
                           {{ $view->lat_description }}           
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Russian Description</label>
                           {{ $view->rus_description }}           
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <h3>User Details</h3>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Customer Name</label>
                           <?php $userdetail = DB::table('users')->where('id',$view->user_id)->first(); echo $userdetail->fname." ".$userdetail->lname; ?>          
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Customer Email</label>
                           {{ $userdetail->email }}  
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label for="title">Customer Phone</label>
                           {{ $userdetail->mobile }}  
                        </div>
                     </div>
                  </div>
                  
               </div>
               <div class="col-md-4">
                  <h3> Winner Details </h3>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="title">Won Amount</label>
                        {{ $view->wonamt }}           
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="title">Won Datetime</label>
                        {{ $view->wondatetime }}                  
                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
         <!-- /.box -->
      </div>
   </section>
   <!-- /.content -->
</div>

@endsection
