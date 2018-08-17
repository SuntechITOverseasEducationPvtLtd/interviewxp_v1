
<?php
        $admin_path     = config('app.project.admin_panel_slug');
?>






<!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                
                
                
                
                
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">
                            <div class="media">
                                <a href="#" class="media-left"><img src="{{ url('/') }}/themeassets/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                                <div class="media-body">
                                    <span class="media-heading text-semibold">Suntech IT</span>
                                    <div class="text-size-mini text-muted">
                                        <i class="icon-pin text-size-small"></i> &nbsp; Hyderabad, TS
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /user menu -->


                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                                <!-- Main -->

                                    <li class="<?php  if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>">
                        <a href="{{ url('/').'/'.$admin_path.'/dashboard'}}"  class="call_loader">
                           <i class="icon-home4"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'account_settings' || Request::segment(2) == 'manage_email'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)"   class="dropdown-toggle">
                      <i class="icon-cog4"></i>
                            <span>Settings</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                          <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'account_settings'){ echo 'active'; } ?>">
                            <a href="{{ url('/').'/'.$admin_path.'/account_settings' }}"  class="call_loader"><i class="icon-stack2"></i> Account Settings</a></li>                            
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'manage_email'){ echo 'active'; } ?>">
                            <a href="{{ url('/').'/'.$admin_path.'/manage_email' }}"  class="call_loader"><i class="icon-envelop5"></i> Manage Emails</a></li>                            
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'activity_logs'){ echo 'active'; } ?>">
                        <a href="{{ url('/').'/'.$admin_path.'/activity_logs' }}" >
                           <i class="icon-history"></i> 
                            <span>Activity Log</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'admin_users'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                           <i class="icon-users2"></i>
                            <span>Admin Users</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'admin_users'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/admin_users')}}"  class="call_loader"> <i class=" icon-user-check"> </i> Manage </a></li>                            
                        </ul>

                    </li>
                    
                    
                        <li class="<?php  if(Request::segment(2) == 'users_roles'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                           <i class="icon-users2"></i>
                            <span>Users Roles</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'users_roles'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/users_roles')}}"  class="call_loader"> <i class=" icon-user-check"> </i> Manage </a></li>                            
                        </ul>

                    </li>
                    
                    

                    <li class="<?php  if(Request::segment(2) == 'static_pages'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                         
                             <i class="icon-pencil7"></i> 


                            <span>CMS</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'static_pages'){ echo 'active'; } ?>">

                            <a href="{{ url($admin_panel_slug.'/static_pages')}}"  class="call_loader"><i class="icon-popout"></i> Manage </a></li>                            
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'state' || Request::segment(2) == 'city' ){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                          <i class="icon-direction"></i> 
                            <span>Location</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'state'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/state')}}"  class="call_loader"><i class="icon-location3"></i>  States</a></li>                            
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'city'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/city')}}"  class="call_loader"><i class="icon-location4"></i>  Cities </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'categories'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                           <i class="icon-grid6"></i>
                            <span>Categories</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'categories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/categories')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>

                      <li class="<?php  if(Request::segment(2) == 'skills'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="icon-book3"></i>
                            <span>Skills</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'skills'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/skills')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                          
                        </ul>
                    </li>

                      

                    <li class="<?php  if(Request::segment(2) == 'alerts'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="icon-bell-check"></i>

                            <span>Alerts</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'alerts'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/alerts')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'qualification'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="icon-graduation"></i>
                            <span>Qualifications</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'qualification'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/qualification')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'specialization'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                           <i class="icon-file-spreadsheet"></i>


                            <span>Specializations</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'subcategories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/specialization')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>

                      <li class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="icon-people"></i>
                                <span>Users</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul>
                            <!--<li style="display: block;" class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/users')}}"  class="call_loader">A/c Activations </a></li> -->
<li style="display: block;" class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/users/profiles')}}"  class="call_loader"><i class="icon-profile"></i> 
Profiles </a></li>                           
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class=" icon-user-tie"></i>
                                <span>Members</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
<li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members')}}"  class="call_loader"><i class="icon-user-check"></i> A/c Activations </a></li> 
<li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/upload_approvals')}}"  class="call_loader"><i class="icon-cloud-check"></i> Upload Approvals</a></li>   
<li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/profiles')}}"  class="call_loader"><i class="icon-profile"></i> Profiles</a></li>     
        <li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/all-coaches')}}"  class="call_loader"><i class="icon-cart5"></i> Coach Bookings</a></li>
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/coach-notifications')}}"  class="call_loader"><i class="icon-comment"></i> 
                            Notification Requests</a></li> 
                            
                             <li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/all-members')}}"  class="call_loader"><i class="icon-cash"></i> Member Sales</a></li> 
                        </ul>
                       
                    </li>
                    
                     <li class="<?php  if(Request::segment(2) == 'price_list'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="icon-price-tag"></i>


                            <span>Price List</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'price_list'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/price_list')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>


                    <li class="<?php  if(Request::segment(2) == 'advertisement'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="icon-megaphone"></i>


                            <span>Advertisements</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'subcategories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/advertisement')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>

                     <li class="<?php  if(Request::segment(2) == 'contact_enquiry'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="icon-phone"></i>
                                <span>Contact Enquiries</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'contact_enquiry'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/contact_enquiry')}}"  class="call_loader"><i class="icon-popout"></i>  Manage </a></li>                            
                        </ul>

                    </li>

                     <li class="<?php  if(Request::segment(2) == 'transactions'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="icon-transmission"></i>
                                <span>Transactions</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(3) == 'transactions'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/transactions/total-sales')}}"  class="call_loader"><i class="icon-cart5"></i> Sales</a></li>                            
                            <li style="display: block;" class="<?php  if(Request::segment(3) == 'payments'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/transactions/total-payments')}}"  class="call_loader"><i class="icon-cash"></i> Payments</a></li>                            
                        </ul>

                    </li> 


                    <li class="<?php  if(Request::segment(2) == 'review_rating'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class=" icon-star-full2"></i>
                                <span>Reviews</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul >
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'review_rating'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/review_rating')}}"  class="call_loader"><i class="icon-popout"></i>  Manage Review</a></li>                             
                        </ul>

                    </li>

                     <li class="<?php  if(Request::segment(2) == 'career'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="icon-briefcase"></i>
                                <span>Career</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'career'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/career/careerpost/post')}}"  class="call_loader">Job Posting</a></li> 
                            
                               <li style="display: block;" class="<?php  if(Request::segment(2) == 'career'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/career/all')}}"  class="call_loader">Manage Job</a></li> 
                               
                               
                        </ul>

                    </li>



                     <li class="<?php  if(Request::segment(2) == 'email_template'){ echo 'active'; } ?>">
                        <a href="{{ url($admin_panel_slug.'/email_template')}}" class="dropdown-toggle" >
                            <i class="icon-envelope"></i>
                                <span>Email Template</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                      

                    </li>

   <!--  <li class="<?php  if(Request::segment(2) == 'rwe_tickets'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-clock-o faa-vertical animated-hover"></i>
                                <span>RWE Tickets</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'rwe_tickets'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/rwe_tickets')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li> -->
                             
                                

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>


<div class="content-wrapper">

                <!-- Page header -->
                
               


<?php
        $admin_path     = config('app.project.admin_panel_slug');
?>
<div class="page-header page-header-default">
                    <div class="page-header-content">
                        
                        <a class="sidebar-control sidebar-main-toggle hidden-xs" style="
    position: fixed;
    margin-top: 354px;
    padding: 4px;
    z-index: 9999;
    background: #263238;
    margin-left: -24px;
"><i class="icon-paragraph-justify3" style="
    color: #fff;
"></i></a>
                        
                        
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - {{ isset($page_title)?$page_title:"" }}</h4>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                             
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                        <ul class="breadcrumb">
                            <li><a href="{{ url('/').'/'.$admin_path.'/dashboard'}}"><i class="icon-home2 position-left"></i> Home</a></li>
                            <?php if(isset($module_url_path)) { ?>
                            <li class="active"> <a href="{{ $module_url_path }}" class="call_loader">{{ $module_title or ''}}</a></li>
                            <?php } ?>
                            <li class="active">{{ isset($page_title)?$page_title:"" }}</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i>
                                    Settings
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ url('/').'/'.$admin_path.'/account_settings' }}"><i class="icon-gear"></i> All settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                               
 <div class="content">

