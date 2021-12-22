
@extends('admin::layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <h1>
       Auction Request
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Auction</a></li>
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
              <h3 class="box-title">Auction Request List  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>User Name</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Start Date/Time</th>
                  <th>End Date/Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    
                     @if(isset($view) && count($view) > 0)
                  <?php $i=1; ?>
                  @foreach($view as $vw)
                  <?php $userdetail = DB::table('users')->where('id',$vw->user_id)->orderBy('id','desc')->first(); ?>
                    <tr>
                       <td>{{ $i;}}</td>
                       <td>{{ $userdetail->fname.' '.$userdetail->lname }}</td>
                       <td>{{ $vw->title }}</td>
                       <td>{{ $vw->starting_price }}</td>
                       <td>{{ $vw->start_datetime }}</td>
                       <td>{{ $vw->end_datetime }}</td>
                       <td>
                           @if($vw->status==0)
                        <a class="success p-0 btn btn-primary" title="Edit" href="{{ url('admin/auction-request-add?Riz='.base64_encode($vw->id)) }}" >
        					Add
        			   </a>
        			   @else
        			   <button class="btn btn-primary">Added</button>
        			   @endif
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
<script>
 function getimages(a) {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    }); 
    $.ajax({
       type:'POST',
       url:"{{ url('admin/getcarimages') }}",
       data:{ com_id:a },
       success:function(data) {
        
          $("#myModal").modal('show'); 
          $(".images").html(data);
       }
    });
 }
</script>
@endsection 

