@extends('admin::layouts.master')
@section('content')
<style>
    .help-block{
            width: 100%;
            margin-top: 6px;
            font-size: 15px;
            color:red;
            display: none;
        }
</style>
<div class="content-wrapper" style="min-height: 516px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Profile</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    
      <section class="content">

      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="box">
            <div class="box-body box-profile">

                                  <img class="profile-user-img img-responsive img-circle" src="{{ url($view->image) }}" alt="User profile picture">
                           <h3 class="profile-username text-center">Artavenue Admin</h3>
              <p class="text-muted text-center">{{ $view->name }}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right">{{ $view->phone }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{ $view->email }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-9 col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Data</h3>
            </div>

            <div class="box-body box-profile">
              @if(session()->has('msg'))
     <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('msg') }}
        </div>
      
    @endif               
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <input type="hidden" class="form-control" name="id" value="26">
 @csrf
  <div class="row">
          <div class="col-md-6">
          <div class="form-group">
          <label for="title">Name</label>
            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $view->name }}">
          </div>
        </div>

  <div class="col-md-6">
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" class="form-control" placeholder="Phone" name="phone" value="{{ $view->phone }}">
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $view->email }}">
      </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
          <label for="image">Image</label>
          <input type="file" name="userfile" value="1599134018.png">
          <p style="color:black;" class="help-block">For best view Image size : 32px X 32px</p>
     </div>
  </div>
    <div class="col-md-3">
       
                     <img src="{{ url($view->image) }}" class="img-circle" style="width:auto; height:45px; margin-bottom: 20px;">
               </div>
</div>


<div class="row">
  <div class="col-md-6">
    <button type="submit" class="btn btn-info" name="submit" value="1">Update Profile</button>
  </div>
</div>

</form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
              <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <div class="box-body box-profile">
             @if(session()->has('chngmsg'))
     <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('chngmsg') }}
        </div>
      
    @endif      
     @if(session()->has('errmsg'))
     <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   {{ session()->get('errmsg') }}
        </div>
      
    @endif      
             
              
                          <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="26">
                           <div class="row">
                            <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="oldpassword">Enter Old Password <span class="help-block text-danger-oldpass" style="">&nbsp;Field is required.</span></label>
                                          <input type="password" class="form-control" placeholder="Enter Old Password" id="oldpass" name="oldpass" value="">
                                        </div>
                                    </div>
                           
                            <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="newpassword">Enter New Password <span class="help-block text-danger-newpass" style="">&nbsp;Field is required.</span><span class="help-block text-danger-passwordlength" id="text-danger" style="display: none;">&nbsp;Password should be minimum six character long.</span></label>
                                          <input type="password" class="form-control" placeholder="Enter New Password" id="newpass" name="newpass" value="">
                                        </div>
                                    </div>
                          
                            <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="conformpassword">Confirm Password <span class="help-block text-danger-cpassword" style="">&nbsp;Field is required.</span><span class="help-block text-danger-notmatch" id="text-danger" style="display: none;">&nbsp;Password and Confirm password not match.</span></label>
                                          <input type="password" class="form-control" placeholder="Confirm New Password" id="cpassword" name="cpassword" value="">
                                        </div>
                                    </div>
                        </div>
                         <div class="row">
                          <div class="col-md-6">
                            <button type="submit" class="btn btn-info" name="changepassword" value="1" onClick="return vonf();">Change Password</button>
                          </div>
                          </div>
                        </form>

           </div>
          </div>
              </div>
</div>

</section></div>

@endsection
<script>
function vonf()
{
		var oldpass = $('#oldpass').val() ;
	var newpass = $('#newpass').val() ;
	var cpass = $('#cpassword').val() ;
	var flag=0;

		
				if(oldpass==''){
				$('#oldpass').css('border', '1px solid red');
				$('.text-danger-oldpass').show();
				flag++;
				}else{
				$('#oldpass').css('border', '');
				$('.text-danger-oldpass').hide();
				}
				if(cpass==''){
				$('#cpassword').css('border', '1px solid red');
				$('.text-danger-cpassword').show();
				flag++;
				}else{
				$('#cpassword').css('border', '');
				$('.text-danger-cpassword').hide();
				}
				if(newpass==''){
				$('#newpass').css('border', '1px solid red');
				$('.text-danger-newpass').show();
				flag++;
				}else{
					if(newpass.length < 6){
				   
				   $('.text-danger-newpass').hide();
				   $('#newpass').css('border', '');
				   $('.text-danger-passwordlength').show();
				   flag++;
				}else{ 
				if(newpass!=cpass){
				    $('#newpass').css('border', '1px solid red');
				    $('#cpassword').css('border', '1px solid red');
				    $('.text-danger-newpass').hide();
				    $('.text-danger-passwordlength').hide();
				    $('.text-danger-notmatch').show();
				    flag++;
				}else{
                    $('#newpass').css('border', '');
                    $('#cpassword').css('border', '');
                    $('.text-danger-newpass').hide();
                    $('.text-danger-notmatch').hide();
				}    
			
				}
				}
			
			 if(flag==0){
			
		}else{
			return false;
		}
	
}
</script>