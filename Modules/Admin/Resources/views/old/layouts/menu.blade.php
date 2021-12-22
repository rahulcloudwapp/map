
         <aside class="main-sidebar">
            <section class="sidebar">

               <ul class="sidebar-menu" data-widget="tree">
                  <li class="<?php if( request()->segment(2)=='dashboard' ){ echo 'active'; }?>"><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                   <?php if( request()->segment(2)=="brands" || request()->segment(2)=="carmodels" || request()->segment(2)=="addbrand" || request()->segment(2)=="editbrand" || request()->segment(2)=="addmodel" || request()->segment(2)=="editmodel" ){ $carsetting="active menu open"; }else{ $carsetting="";  }?>
                   <!--<li class="treeview {{ $carsetting }}" >
                    <a href="#">
                    <i class="fa fa-car"></i> <span>Car Setting</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                     <li class="<?php if( request()->segment(2)=="brands" || request()->segment(2)=="addbrand" || request()->segment(2)=="editbrand" ){ echo "active"; }?>"><a href="{{ url('admin/brands') }}"><i class="fa fa-circle-o"></i> <span>Car Brands</span></a></li>
                     <li class="<?php if( request()->segment(2)=="carmodels" || request()->segment(2)=="addmodel" || request()->segment(2)=="editmodel"){ echo "active"; }?>"><a href="{{ url('admin/carmodels') }}"><i class="fa fa-circle-o"></i> <span>Car Models</span></a></li>
                    </ul>
                    </li>-->
                    <li class="<?php if( request()->segment(2)=='category' || request()->segment(2)=='addcategory' || request()->segment(2)=='editcategory'){ echo 'active'; }?>"><a href="{{ url('admin/category') }}"><i class="fa fa-tags"></i> <span>Category</span></a></li>
                     <li class="<?php if( request()->segment(2)=='auction' || request()->segment(2)=='addauction'){ echo 'active'; }?>"><a href="{{ url('admin/auction') }}"><i class="fa fa-gavel"></i> <span>Auction</span></a></li>
                     <li class="<?php if( request()->segment(2)=='users'){ echo 'active'; }?>"><a href="{{ url('admin/users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
                     <li class="<?php if( request()->segment(2)=='auction_request'){ echo 'active'; }?>"><a href="{{ url('admin/auction_request') }}"><i class="fa fa-paper-plane"></i> <span>Auction Request</span></a></li>
                     <li class="<?php if( request()->segment(2)=='about'){ echo 'active'; }?>"><a href="{{ url('admin/about') }}"><i class="fa fa-info-circle"></i> <span>About</span></a></li>
                     <li class="<?php if( request()->segment(2)=='terms'){ echo 'active'; }?>"><a href="{{ url('admin/terms') }}"><i class="fa fa-file"></i> <span>Terms</span></a></li>
                     <li class="<?php if( request()->segment(2)=='policy'){ echo 'active'; }?>"><a href="{{ url('admin/policy') }}"><i class="fa fa-file-text"></i> <span>Policy</span></a></li>
                     <li class="<?php if( request()->segment(2)=='contact'){ echo 'active'; }?>"><a href="{{ url('admin/contact') }}"><i class="fa fa-phone-square"></i> <span>Contact</span></a></li>
                    <li class="<?php if( request()->segment(2)=='auctionwon'){ echo 'active'; }?>"><a href="{{ url('admin/auctionwon') }}"><i class="fa fa-thumbs-up"></i> <span>Auction Winner</span></a></li>
              </ul>
               
            </section>
         </aside>