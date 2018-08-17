
<?php
        $admin_path     = config('app.project.admin_panel_slug');
?>

<div id="sidebar" class="navbar-collapse collapse">
                <!-- BEGIN Navlist -->
                <ul class="nav nav-list">
                    
                    
                    <li class="<?php  if(Request::segment(2) == 'dashboard'){ echo 'active'; } ?>">
                        <a href="{{ url('/').'/'.$admin_path.'/dashboard'}}"  class="call_loader">
                            <i class="fa fa-dashboard faa-vertical animated-hover"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'account_settings' || Request::segment(2) == 'manage_email'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)"   class="dropdown-toggle">
                            <i class="fa fa-cog faa-vertical animated-hover"></i>
                            <span>Settings</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                          <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'account_settings'){ echo 'active'; } ?>">
                            <a href="{{ url('/').'/'.$admin_path.'/account_settings' }}"  class="call_loader">Account Settings</a></li>                            
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'manage_email'){ echo 'active'; } ?>">
                            <a href="{{ url('/').'/'.$admin_path.'/manage_email' }}"  class="call_loader">Manage Emails</a></li>                            
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'activity_logs'){ echo 'active'; } ?>">
                        <a href="{{ url('/').'/'.$admin_path.'/activity_logs' }}" >
                            <i class="fa fa-buysellads" aria-hidden="true"></i>
                            <span>Activity Log</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'admin_users'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-user-secret faa-vertical animated-hover"></i>
                            <span>Admin Users</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'admin_users'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/admin_users')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'static_pages'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-sitemap faa-vertical animated-hover"></i>
                            <span>CMS</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'static_pages'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/static_pages')}}"  class="call_loader">Manage </a></li>                            
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'state' || Request::segment(2) == 'city' ){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-globe faa-vertical animated-hover"></i>
                            <span>Location</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'state'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/state')}}"  class="call_loader">States</a></li>                            
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'city'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/city')}}"  class="call_loader">Cities </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'categories'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-list-alt faa-vertical animated-hover"></i>
                            <span>Categories</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'categories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/categories')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'subcategories'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-list-alt faa-vertical animated-hover"></i>
                            <span>Subcategories</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'subcategories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/subcategories')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                      <li class="<?php  if(Request::segment(2) == 'skills'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-star faa-vertical animated-hover"></i>
                            <span>Skills</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>
                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'skills'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/skills')}}"  class="call_loader">Manage </a></li>                          
                        </ul>
                    </li>

                      <li class="<?php  if(Request::segment(2) == 'company'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-building faa-vertical animated-hover"></i>

                            <span>Companies</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'company'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/company')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'alerts'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-bell faa-vertical animated-hover"></i>

                            <span>Alerts</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'alerts'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/alerts')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'qualification'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-graduation-cap faa-vertical animated-hover"></i>
                            <span>Qualifications</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'qualification'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/qualification')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                    <li class="<?php  if(Request::segment(2) == 'specialization'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-university faa-vertical animated-hover"></i>


                            <span>Specializations</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'subcategories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/specialization')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                      <li class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-users faa-vertical animated-hover"></i>
                                <span>Users</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <!--<li style="display: block;" class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/users')}}"  class="call_loader">A/c Activations </a></li> -->
                             <li style="display: block;" class="<?php  if(Request::segment(2) == 'users'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/users/profiles')}}"  class="call_loader">Profiles </a></li>                           
                        </ul>
                    </li>

                    <li class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-users faa-vertical animated-hover"></i>
                                <span>Members</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members')}}"  class="call_loader">A/c Activations </a></li> 
                             <li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/upload_approvals')}}"  class="call_loader">Upload Approvals</a></li>   
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'members'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/members/profiles')}}"  class="call_loader">Profiles</a></li>     
                                                           
                        </ul>
                       
                    </li>
                    
                     <li class="<?php  if(Request::segment(2) == 'price_list'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-money faa-vertical animated-hover"></i>


                            <span>Price List</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'price_list'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/price_list')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>


                    <li class="<?php  if(Request::segment(2) == 'advertisement'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle"  >
                            <i class="fa fa-video-camera faa-vertical animated-hover"></i>


                            <span>Advertisements</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'subcategories'){ echo 'active'; } ?>">
                            <a href="{{ url($admin_panel_slug.'/advertisement')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                     <li class="<?php  if(Request::segment(2) == 'contact_enquiry'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-info-circle faa-vertical animated-hover"></i>
                                <span>Contact Enquiries</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'contact_enquiry'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/contact_enquiry')}}"  class="call_loader">Manage </a></li>                            
                        </ul>

                    </li>

                     <li class="<?php  if(Request::segment(2) == 'transactions'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-credit-card faa-vertical animated-hover"></i>
                                <span>Transactions</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(3) == 'transactions'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/transactions/sales')}}"  class="call_loader">Sales</a></li>                            
                            <li style="display: block;" class="<?php  if(Request::segment(3) == 'payments'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/transactions/payments')}}"  class="call_loader">Payments</a></li>                            
                        </ul>

                    </li> 


                    <li class="<?php  if(Request::segment(2) == 'review_rating'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-star faa-vertical animated-hover"></i>
                                <span>Reviews</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'review_rating'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/review_rating')}}"  class="call_loader">Manage Review</a></li>                             
                        </ul>

                    </li>

                     <li class="<?php  if(Request::segment(2) == 'career'){ echo 'active'; } ?>">
                        <a href="javascript:void(0)" class="dropdown-toggle" >
                            <i class="fa fa-briefcase faa-vertical animated-hover"></i>
                                <span>Career</span>
                            <b class="arrow fa fa-angle-right"></b>
                        </a>

                        <ul class="submenu">
                            <li style="display: block;" class="<?php  if(Request::segment(2) == 'career'){ echo 'active'; } ?>"><a href="{{ url($admin_panel_slug.'/career')}}"  class="call_loader">Manage</a></li>                             
                        </ul>

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
                    

                <!-- END Navlist -->

                <!-- BEGIN Sidebar Collapse Button -->
                <div id="sidebar-collapse" class="visible-lg">
                    <i class="fa fa-angle-double-left"></i>
                </div>
                <!-- END Sidebar Collapse Button -->
            </div>

   