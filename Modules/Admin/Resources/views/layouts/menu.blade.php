
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  
    <a href="{{ url('admin/profile') }}" class="brand-link">
      <img src="{{ url('public/Admin/assets/') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo Auth::guard('admin')->user()->name;?></span>
    </a>


    <div class="sidebar">
  


    
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           
           <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link <?php  if( request()->segment(2)=='dashboard' ){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashbaord
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('admin/users-list') }}" class="nav-link <?php  if( request()->segment(2)=='users-list' ){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
          
          <!--  <li class="nav-item">-->
          <!--  <a href="pages/widgets.html" class="nav-link">-->
          <!--    <i class="nav-icon fas fa-th"></i>-->
          <!--    <p>-->
          <!--      Widgets-->
          <!--      <span class="right badge badge-danger">New</span>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
         
        </ul>
      </nav>
      
    </div>
   </aside>