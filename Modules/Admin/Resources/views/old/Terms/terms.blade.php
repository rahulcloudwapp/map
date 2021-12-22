
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
        Terms
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Terms</li>
      </ol>
    </section>
   
    <section class="content">
        @if(session()->has('msg'))
     <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('msg') }}
        </div>
      
    @endif
    
    @if(session()->has('errmsg'))
     <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('errmsg') }}
        </div>
      
    @endif
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <form role="form" action="" method="post" enctype="multipart/form-data">
                @csrf
              <div class="box-body row">
                 
                
                 
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">English Description</label>
                  <textarea class="form-control" name="description" rows="3" >@if(isset($view->description)){{$view->description}}@endif</textarea>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Latvian Description</label>
                  <textarea class="form-control" name="lat_description" rows="3" >@if(isset($view->lat_description)){{$view->lat_description}}@endif</textarea>
                </div>
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Russian Description</label>
                  <textarea class="form-control" name="rus_description" rows="3" >@if(isset($view->rus_description)){{$view->rus_description}}@endif</textarea>
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
