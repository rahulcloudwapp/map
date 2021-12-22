@extends('admin::layouts.master')
@section('content')
<?php $adminimage =  Auth::guard('admin')->user()->image;?>
<style>
.errmessage{
    color:red;
}
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    
    <section class="content">
        @if(session()->has('message'))
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('message') }}
        </div>
      
     @endif
     
     @if(session()->has('errmessage'))
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('errmessage') }}
        </div>
      
     @endif
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype='multipart/form-data'>
                   @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ Auth::guard('admin')->user()->name }}">
                    <p class="errmessage">{{ $errors->first('name')}}</p>
                  </div>
                   <div class="form-group">
                    <label for="email">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="{{ Auth::guard('admin')->user()->phone }}">
                    <p class="errmessage">{{ $errors->first('phone')}}</p>
                  </div>
                  <div class="form-group">
                    <label for="password">Image</label>
                    <input type="file" class="form-control" id="image"  name="image" accept="image/*" >
                  </div>
                  <div class="form-group">
                    <img src="@if($adminimage!=''){{ url($adminimage) }}@else {{ url('public/Admin/dummyprofile.png')}} @endif" style="height: 200px;width: 200px;">
                  </div>
                  
                </div>
               
                <div class="card-footer">
                  <button type="submit" name="submit" value="add" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        
          </div>
         <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype='multipart/form-data'>
                   @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Old Password</label>
                    <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Enter old password" >
                    <p class="errmessage">{{ $errors->first('old_pass')}}</p>
                  </div>
                   <div class="form-group">
                    <label for="email">New Password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Enter New password" >
                    <p class="errmessage">{{ $errors->first('newpass')}}</p>
                  </div>
                  <div class="form-group">
                    <label for="email">Confirm New Password</label>
                    <input type="password" class="form-control" id="cnewpass" name="cnewpass" placeholder="Enter Confirm New password" >
                    <p class="errmessage">{{ $errors->first('cnewpass')}}</p>
                  </div>
                  
                </div>
               
                <div class="card-footer">
                  <button type="submit" name="changepassword" value="changepassword" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   
  </div>

@endsection