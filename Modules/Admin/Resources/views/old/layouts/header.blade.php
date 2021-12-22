
<!DOCTYPE html>
<html>

   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Art Avenue | Dashboard</title>

      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="icon" href="{{url('public/Admin/assets/favicon.png')}}" type="image/x-icon" />
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/Ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/morris.js/morris.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/jvectormap/jquery-jvectormap.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
      
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
     
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

      <link rel="stylesheet" type="text/css" href="{{ url('public/Admin/') }}/assets/custom.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/dist/css/image-uploader.min.css">
      <script src="{{ url('public/Admin/') }}/assets/bower_components/jquery/dist/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css">
      <link rel="stylesheet" href="{{ url('public/Admin/') }}/assets/dist/css/bootstrap-editable.css">
      <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('admin/dashboard') }}" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>M</b>CAR</span>
               <!-- logo for regular state and mobile devices -->
               <!--<span class="logo-lg"><b>Motor</b>CAR</span>-->
               <span class="logo-lg">
                  <img style="width: 140px;position: absolute;z-index: 9999;left: 2%; top: 2px;" src="{{url('public/Admin/assets/avenue.png')}}" alt="Logo">
                 <!--  <h3>Domy</h3> -->
               </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                         <?php
                        $admn_img = Auth::guard('admin')->user();
                        
                        if(is_null($admn_img->image)){
                           $immgg = url('public/Admin/assets/dist/img/noimage.png');
                            
                        }else{
                             $immgg = url($admn_img->image);
                            
                        }
                       
                        ?>      
                        <img src="{{url($immgg)}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">Admin</span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                              <img src="{{url($immgg)}}" class="img-circle" alt="User Image">
                              <p style="color:#ffffff">
                                 Admin
                                 <small></small>
                              </p>
                           </li>
                           <li class="user-footer">
                              
                               <div class="pull-right">
                                 <a href="{{ url('admin/logout') }}" class="btn btn-primary btn-flat">Sign out</a>
                              </div>
                              <div class="pull-right" style="margin: 0 5px;">
                                 <a href="{{ url('admin/profile') }}" class="btn btn-primary btn-flat">Profile</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>
         
        @include('admin::layouts.menu')