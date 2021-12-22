
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
        @if(isset($view)){{'Edit'}} @else {{ 'Add'}} @endif   Auction 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Auction</li>
        <li class="active">@if(isset($view)){{'Edit'}} @else {{ 'Add'}} @endif  Auction</li>
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
                  <label for="exampleInputEmail1">Category </label>
                  <select name="category_id" class="form-control"  required>
                    <option value="">--Select Category--</option>  
                     @if(isset($category) && count($category) > 0)
                       @foreach($category as $cat)
                         @if(!empty($view) && $view->category_id==$cat->id) 
                        <?php $sl = "selected"; ?> 
                         @else
                          <?php  $sl="" ?>; 
                         
                         @endif
                         <option value="{{ $cat->id }}" <?php echo $sl; ?>>{{ $cat->name }}</option>
                       @endforeach
                    @endif
                  </select>
                </div>
               
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">English Title</label>
                  <input type="text" name="title" class="form-control" value="@if(isset($view)){{$view->title}}@endif" required>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Latvian Title</label>
                  <input type="text" name="lat_title" class="form-control" value="@if(isset($view)){{$view->lat_title}}@endif" required>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Russian Title</label>
                  <input type="text" name="rus_title" class="form-control" value="@if(isset($view)){{$view->rus_title}}@endif" required>
                </div>
                
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">English Description</label>
                  <textarea class="form-control" name="description" rows="3" >@if(isset($view)){{$view->description}}@endif</textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Latvian Description</label>
                  <textarea class="form-control" name="lat_description" rows="3" >@if(isset($view)){{$view->lat_description}}@endif</textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Russian Description</label>
                  <textarea class="form-control" name="rus_description" rows="3" >@if(isset($view)){{$view->rus_description}}@endif</textarea>
                </div>
                
                
                 <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Start bid Price</label>
                  <input type="number" step="any" min="1" name="starting_price" class="form-control" value="@if(isset($view)){{$view->starting_price}}@endif" required>
                </div>
                <!-- <div class="form-group col-md-6">-->
                <!--  <label for="exampleInputEmail1">Start date and time</label>-->
                <!--  <input type="datetime-local" name="start_datetime" class="form-control" value="<?php if(isset($view)){ echo date('Y-m-d',strtotime($view->start_datetime))."T".date('H:i:s',strtotime($view->start_datetime));}?>"  <?php if(!empty($view)){ echo "readonly"; }?> required>-->
                <!--</div>-->
                <!--<div class="form-group col-md-6">-->
                <!--  <label for="exampleInputEmail1">End date and time</label>-->
                <!--  <input type="datetime-local" name="end_datetime" class="form-control" value="<?php if(isset($view)){ echo date('Y-m-d',strtotime($view->end_datetime))."T".date('H:i:s',strtotime($view->end_datetime));}?>" <?php if(!empty($view)){ echo "readonly"; }?> required>-->
                <!--</div>-->
                <div class="form-group col-md-6">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Start date </label>
                            <input type="text" name="start_date" class="form-control" id="from" value="<?php if(isset($view)){ echo date('Y-m-d',strtotime($view->start_datetime));}?>"  <?php if(!empty($view)){ echo "readonly"; }?> required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Start time</label>
                            <input type="time" name="start_time" class="form-control"  value="<?php if(isset($view)){ echo date('H:i:s',strtotime($view->start_datetime));}?>"  <?php if(!empty($view)){ echo "readonly"; }?> required>
                        </div>
                    </div>
                  
                  
                </div>
               
                <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">End date </label>
                            <input type="text" name="end_date" class="form-control" id="to" value="<?php if(isset($view)){ echo date('Y-m-d',strtotime($view->end_datetime));}?>" <?php if(!empty($view)){ echo "readonly"; }?> required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">End time</label>
                            <input type="time" name="end_time" class="form-control"  value="<?php if(isset($view)){ echo date('H:i:s',strtotime($view->end_datetime));}?>" <?php if(!empty($view)){ echo "readonly"; }?> required>
                        </div>
                    </div>
                    
                 
                  
                </div>
                
               
                <div class="form-group col-md-12">
                   <label> Upload Images </label>
                  <div class="input-field">
                    <input type="file" name="images[]" accept="image/*" multiple <?php if(empty($view)){ echo "required"; }?> >
                  </div>
                </div>
                <div class="form-group col-md-12">
                   <div class="editImages">
                     <div class="row">
                      <?php
                      if(isset($imageslist) && count($imageslist)>0){
                        foreach($imageslist as $img){
                      ?>
                       <div class="col-md-3 col-sm-4">
                         <div class="img_outer">
                           <img src="{{url($img->path)}}" />
                           @if(count($imageslist)!=1)
                           <a href="{{ url('admin/deleteauctionfile?Fiz='.base64_encode($img->id)) }}" onclick="return confirm('Are you sure you want to Delete?');"><i class="fa fa-trash" ></i></a>
                           @endif
                         </div>
                       </div>
                      <?php }} ?> 
                       
                     </div>
                   </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script>
var dateToday = new Date();
var dates = $("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});


</script>
@endsection


