
@extends('admin::layouts.master')
@section('content')

<style type="text/css">
  .image-uploader .uploaded .uploaded-image img {
    margin: 35px 0px 0px;
    height: 85%;
  }
  .remove-image {
    width: 100%;
    height: 20px;
    background-color: #e43434;
    border-color: #e43434;
    padding: 15px;
    font-size: 19px;
    position: absolute;
    color: #ffff;
    font-weight: bold;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        @if(isset($view)){{'Edit'}} @else {{ 'Add'}} @endif Category 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Category</li>
        <li class="active">Add Category</li>
      </ol>
    </section>
   
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                @csrf
              <div class="box-body row">
                  
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">English Name</label>
                  <input type="text" name="name" class="form-control" value="@if(isset($view)){{$view->name}}@endif" required>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Latvian Name</label>
                  <input type="text" name="lat_name" class="form-control" value="@if(isset($view)){{$view->lat_name}}@endif" required>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Russian Name</label>
                  <input type="text" name="rus_name" class="form-control" value="@if(isset($view)){{$view->rus_name}}@endif" required>
                </div>
               

             

              <div class="box-footer">
                <button type="submit" name="submit" value="save" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
  </div>


@endsection
