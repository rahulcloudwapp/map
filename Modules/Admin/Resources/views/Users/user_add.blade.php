@extends('admin::layouts.master')
@section('content')
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
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Add</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                   @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                    <p class="errmessage">{{ $errors->first('name')}}</p>
                  </div>
                   <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                    <p class="errmessage">{{ $errors->first('email')}}</p>
                  </div>
                  <div class="form-group">
                    <label for="password">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile"  name="mobile" placeholder="Enter mobile" value="{{ old('mobile') }}">
                    <p class="errmessage">{{ $errors->first('mobile')}}</p>
                  </div>
                  
                </div>
               
                <div class="card-footer">
                  <button type="submit" name="submit" value="add" class="btn btn-primary">Submit</button>
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

