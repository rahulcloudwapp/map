@extends('admin::layouts.master')
@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
       Auction Won
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Auction Won</a></li>
        <!--<li class="active">Data tables</li>-->
      </ol>
    </section>
  
    <section class="content">
           @if(session()->has('msg'))
     <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('msg') }}
        </div>
      
    @endif
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Auction WonList  <a href="{{ url('admin/addauction') }}" class="btn btn-primary pull-right"> Add Auction </a> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Winner User Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                     @if(isset($view) && count($view) > 0)
                  <?php $i=1; ?>
                  
                  @foreach($view as $vw)
                  <?php $userdetail = DB::table('users')->where('id',$vw->user_id)->first(); ?>
                    <tr>
                       <td>{{ $i;}}</td>
                       <td>{{ $vw->title }}</td>
                         <td>{{ $userdetail->fname.' '.$userdetail->lname }}</td>
                       <td>
                           <a href="{{ url('admin/auctionwon_detail?Aiz='.base64_encode($vw->id)) }}">View</a>
                       </td>
                    </tr>
                    <?php $i++; ?>
                 @endforeach
               @endif
               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>

@endsection

