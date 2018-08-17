<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="" />
      <meta name="keywords" content="" />
      <meta name="author" content="" />
      <!-- ======================================================================== -->
      <title>Interviewxp </title>
      <link rel="icon" href="{{url('/')}}/images/favicon.png" type="image/x-icon" />
      <!-- Bootstrap Core CSS -->
      <link href="{{url('/')}}/css/front/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- main CSS -->
      <link href="{{url('/')}}/css/front/Interviewxp.css" rel="stylesheet" type="text/css" />
      <!--font-awesome-css-start-here-->
      <link href="{{url('/')}}/css/front/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-1.11.3.min.js"></script>
      <link href="{{url('/')}}/css/front/bootstrap-modal.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-migrate-1.2.1.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
     
      <link rel="stylesheet" href="{{url('/')}}/css/front/timepicker.css">


      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/bootstrap.min.js"></script>
      
      
      <!--<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/jquery.validate.js"></script>-->
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/jquery.validate.min.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/additional-methods.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/additional-methods.min.js"></script>
      <link href="{{url('/')}}/css/front/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
      <link href="{{url('/')}}/css/front/unslider.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery.rating.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery.mCustomScrollbar.concat.min.js"></script>
	  <style>
	  .sticky .s-input-box{
		  margin: 0px auto 8px !important;
	  }
	  </style>

      <?php $obj_user  = Sentinel::check();?>

      @if(Session::has('logged_in') && Session::get('logged_in')=='member' && $obj_user!=false && !$obj_user->inRole('admin'))

      <div id="member-header" class="after-login">
         <div class="header" style="background-color: rgba(0 ,0 ,0 , 0.75);">
            <div class="container-fluid">
               <div class="row ">
                  <div class="col-xs-6 col-sm-2 col-md-2 col-lg-3">
                     <div class="main-logo">
                        <a href="{{url('/')}}"><img src="{{url('/')}}/images/logo.png" class="img-responsive" alt="Interviewxp" /></a>
                     </div>
                  </div>
                  <div class="col-xs-6 col-sm-7 col-md-5 col-lg-4 swap-right">
                     <div class="text-right menu-right right-menu p-t-0">
                        <ul>
                        <li class="hidden-md hidden-lg"><button class="click-search"><i class="fa fa-search"></i></button></li>
                        {{-- <a href="{{url('/member/post_interview')}}" class="member-profile-btn hidden-xs">Post an Interview Q &amp; A</a> --}}

                      
                           <a href="{{url('/member/post_interview')}}" class="member-profile-btn hidden-xs">Create New</a>
                           <li class="back-line bell-w">
                              <a href="{{url('/member/notification')}}"  >
                                 <div class="bell">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    @if(isset($notification_count) && $notification_count!=0)
                                    <div class="ten">{{$notification_count}}</div>
                                    @endif
                                 </div>
                              </a>
                           </li>
                           <li class="back-line">
                              <div class="dropdown-wrapper n-top">
                                 <div class="btn-group">
                                    <button type="button" class="drop-menu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="hidden-xs"> 
                                    {{isset($user_auth_details['first_name'])?ucfirst($user_auth_details['first_name']):''}} </span><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                    <div class="img-block">
                                       @if(isset($user_auth_details['profile_image']))
                                       <img src="{{$user_auth_details['profile_image']}}" class="img1"  />
                                       @endif
                                    </div>
                                    <ul class="dropdown-menu">
                                       <li><a href="{{url('/member/revenue_reports')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Revenue Reports</a></li>
                                       <li><a 
                                          href="{{url('/member/personal')}}"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                                         <li><a 
                                          href="{{url('/member/learn')}}"><i class="fa fa-book" aria-hidden="true"></i>Learn</a></li>
                                       <li><a 
                                          href="{{url('/member/change_password')}}"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                                       </li>
                                       <li><a href="{{url('/member/purchase_history')}}"><i class="fa fa-history" aria-hidden="true"></i>Purchase History</a></li>
                                       <li><a href="{{url('/member/create_alert')}}"><i class="fa fa-bell-o" aria-hidden="true"></i> Alerts</a></li>
                                       <li><a 
                                          href="{{url('/member/deactivate')}}"><i class="fa fa-ban" aria-hidden="true"></i> Deactivate an Account</a></li>
                                          <li><a 
                                          href="{{url('/member/post_interview')}}" class="visible-xs"><i class="fa fa-file-o" aria-hidden="true"></i> Upload new</a></li>
                                       <li class="lst"><a 
                                          href="{{url('/member/logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                                       </li>
                                      <!-- <li class="visible-xs visible-sm"><a href="javascript:void(0)">Notification</a></li>-->
                                    </ul>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                    <!--search bar start here-->
                   <!--<div class="col-xs-2 col-sm-2 hidden-md hidden-lg pad-remove"><button class="click-search"><i class="fa fa-search"></i></button></div>-->

                     {{-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 pad-remove swap-left">
                         <div class="input-box s-input-box">
                             <input placeholder="Type Your Skill..." type="text" />
                             <button class="search-btn">Find</button>
                         </div>
                     </div> --}}
           
                     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 pad-remove swap-left">
                     <div class="input-box s-input-box">
                        <form method="get" name="frm_search" action="{{url('/')}}/searchskill">
                          {{ csrf_field() }}
                        <select data-placeholder="Select Skill" class="chosen-select chosen-container chosen-container-single" title="Select one" name="skill_id" id="skill_name" >
                           <option value=""></option>
                           @if(isset($arr_skill) && sizeof($arr_skill)>0)
                            
                              @foreach($arr_skill as $skill)
                              <option value="{{$skill['id']}}" @if($skill['skill_name']==$skill_name) selected="selected" @endif >{{ucfirst($skill['skill_name'])}}</option>
                              @endforeach
                           @endif
                        </select>

                           <div class="error" id="err_search"></div>
                           <button  type="submit" class="search-btn" id="btn_find" name="btn_find" value="find">Find</button>
                        </form>   
                        </div>
                        </div>

                  <!--search bar end here-->
                  
               </div>
            </div>
         </div>
      </div>


@elseif(Session::has('logged_in') && Session::get('logged_in')=='user' && $obj_user!=false && !$obj_user->inRole('admin'))

      <div id="after-login-header" class="after-login">
         <div class="header" style="background-color: rgba(0 ,0 ,0 , 0.75);">
            <div class="container">
               <div class="row ">
                  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                     <div class="main-logo">
                        <a href="{{url('/')}}"><img src="{{url('/')}}/images/logo.png" class="img-responsive" alt="Interviewxp" /></a>
                     </div>
                  </div>

                  <div class="col-xs-6 col-sm-4 col-md-5 col-lg-5 swap-right">
                     <div class="text-right menu-right right-menu">
                        <ul>

     
                        <li class="hidden-md hidden-lg"><button class="click-search"><i class="fa fa-search"></i></button></li>

                        <?php $user = Sentinel::inRole('member'); ?>

                           @if(isset($user) && $user==false)
                           <a href="{{url('/user/become_member')}}" class="member-btn hidden-xs hidden-sm">Become a Member</a>
                           @endif
                           @if(\Request::segment(1)!='')
                           <li class="back-line hidden-xs hidden-sm">
                              <a href="{{url('/user/notification')}}" 
                                 >
                                 <div class="bell">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    @if(isset($notification_count) && $notification_count!=0)
                                    <div class="ten">{{$notification_count}}</div>
                                    @endif
                                 </div>
                              </a>
                           </li>
                           
                           @endif
                           <li class="back-line">
                              <div class="dropdown-wrapper n-top">
                                 <div class="btn-group">
                                    <button type="button" class="drop-menu dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="hidden-xs"> 
                                    {{isset($user_auth_details['first_name'])?ucfirst($user_auth_details['first_name']):''}} 
                                    </span><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                    <div class="img-block">
                                       @if(isset($user_auth_details['profile_image']))  
                                       <img src="{{$user_auth_details['profile_image']}}" class="img1"  />
                                       @endif
                                    </div>
                                    <ul class="dropdown-menu">
                                       <li><a  href="{{url('/user/profile')}}" 
                                          ><i class="fa fa-user" aria-hidden="true"></i> My Profile</a></li>
                                       <li><a 
                                          href="{{url('/user/learn')}}"><i class="fa fa-book" aria-hidden="true"></i>Learn</a></li>   
                                       <li><a  href="{{url('/user/change_password')}}" 
                                          ><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                                       </li>
                                       <li><a href="{{url('/user/purchase_history')}}"><i class="fa fa-history" aria-hidden="true"></i> Purchase History</a></li>
                                       <li><a href="{{url('/user/create_alert')}}"><i class="fa fa-bell-o" aria-hidden="true"></i> Alerts</a></li>
                                       <li><a  href="{{url('/user/deactivate')}}" 
                                          ><i class="fa fa-ban" aria-hidden="true"></i> Deactivate an Account</a></li>
                                       <li class="lst"><a  href="{{url('/user/logout')}}" 
                                          ><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                                       </li>
                                       <li class="visible-xs visible-sm"><a href="javascript:void(0)">Become a Member</a></li>
                                       <li class="visible-xs visible-sm"><a href="javascript:void(0)">Notification</a></li>
                                    </ul>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                    <!--search bar start here-->
                   <!--<div class="col-xs-3 col-sm-4 hidden-md hidden-lg"><button class="click-search"><i class="fa fa-search"></i></button></div>-->

                     {{-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 pad-remove swap-left">
                         <div class="input-box s-input-box mar-remove">
                             <input placeholder="Type Your Skill..." type="text" />
                             <button class="search-btn">Find</button>
                         </div>
                     </div> --}}
           
                     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 pad-remove swap-left">
                     <div class="input-box s-input-box mar-remove">
                        <form method="get" name="frm_search" action="{{url('/')}}/searchskill">
                          {{ csrf_field() }}
                        <select data-placeholder="Select Skill" class="chosen-select chosen-container chosen-container-single" title="Select one" name="skill_id" id="skill_name" >
                           <option value=""></option>
                           @if(isset($arr_skill) && sizeof($arr_skill)>0)
                            
                              @foreach($arr_skill as $skill)
                              <option value="{{$skill['id']}}" @if($skill['skill_name']==$skill_name) selected="selected" @endif >{{ucfirst($skill['skill_name'])}}</option>
                              @endforeach
                           @endif
                        </select>

                           <div class="error" id="err_search"></div>
                           <button  type="submit" class="search-btn" id="btn_find" name="btn_find" value="find">Find</button>
                        </form>   
                        </div>
                        </div>

                  <!--search bar end here-->
               </div>
            </div>
         </div>
      </div>
      
      @else
      <div id="header-home" class="home-header">
         <div class="header" style="background-color: rgba(0 ,0 ,0 , 0.75);">
            <div class="container">
               <div class="row ">
                  <div class="col-xs-7 col-sm-5 col-md-3 col-lg-3">
                     <div class="main-logo"><a href="{{url('/')}}"><img src="{{url('/')}}/images/logo.png" alt="Interviewxp" /></a></div>
                  </div>
                  <!--search bar start here-->
                   <div class="col-xs-5 col-sm-7 hidden-md hidden-lg"><button class="click-search"><i class="fa fa-search"></i></button></div>

                     {{-- <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 pad-remove">
                         <div class="input-box s-input-box">
                             <input placeholder="Type Your Skill..." type="text" />
                             <button class="search-btn">Find</button>
                         </div>
                     </div> --}}
           
                     <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 pad-remove">
                     <div class="input-box s-input-box">
                        <form method="get" name="frm_search" action="{{url('/')}}/searchskill">
                          {{ csrf_field() }}
                        <select data-placeholder="Select Skill" class="chosen-select chosen-container chosen-container-single" title="Select one" name="skill_id" id="skill_name" >
                           <option value=""></option>
                           @if(isset($arr_skill) && sizeof($arr_skill)>0)
                            
                              @foreach($arr_skill as $skill)
                              <option value="{{$skill['id']}}" @if($skill['skill_name']==$skill_name) selected="selected" @endif >{{ucfirst($skill['skill_name'])}}</option>
                              @endforeach
                           @endif
                        </select>

                           <div class="error" id="err_search"></div>
                           <button  type="submit" class="search-btn" id="btn_find" name="btn_find" value="find">Find</button>
                        </form>   
                        </div>

                  </div>

                  <!--search bar end here-->
                  
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                     <div class="text-right menu-right">
                        <ul class="login-list">
                           <li ><a href="{{url('/')}}/user/login" class="user-icon"><i class="fa fa-user" aria-hidden="true"></i>User Login</a></li>
                            <li><a class="brd hidden-xs">&nbsp;</a></li>
                           <li><a href="{{url('/')}}/member/login" class="user-icon"><i class="fa fa-user" aria-hidden="true"></i>Member Login</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endif


   </head>
   <body>