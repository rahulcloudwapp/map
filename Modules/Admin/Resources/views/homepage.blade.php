
@extends('admin::layouts.master')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css">
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Home Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Home Page</li>
        
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
                   <label >Home</label>
                  <textarea class="form-control details" name="homepage" id="homepage" rows="10"><?php echo $view->homepage; ?></textarea>
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


@endsection
	 


