@extends('admin::layouts.master')
@section('content')

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
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users List</h3> 
                <a href="{{ url('admin/user-add') }}" class="btn btn-primary" style="float:right;">Add</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-hover">
                  <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Action</th>
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
                               <td>
                                <!--<a class="success p-0" title="Edit" href="{{ url('admin/editcategory?Ciz='.base64_encode($vw->id)) }}" >-->
                					<!--	<i class="fa fa-edit"></i>-->
                					<!--</a>-->
                               </td>
                            </tr>
                            <?php $i++; ?>
                         @endforeach
                       @endif
                        </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



@endsection

