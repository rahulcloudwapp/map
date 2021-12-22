@extends('admin::layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <h1>
       Contact
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Contact</a></li>
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
              <h3 class="box-title">Contact List   </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Description</th>
                </tr>
                </thead>
                <tbody>
                   @if(isset($view) && count($view) > 0)
                  <?php $i=1; ?>
                  @foreach($view as $vw)
                    <tr>
                       <td>{{ $i;}}</td>
                       <td>{{ $vw->name }}</td>
                       <td>{{ $vw->email }}</td>
                       <td>{{ $vw->mobile }}</td>
                       <td>{{ $vw->description }}</td>
                       
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

