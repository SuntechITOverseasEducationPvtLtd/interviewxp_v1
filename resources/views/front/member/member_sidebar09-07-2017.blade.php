<script type='text/javascript' src="{{url('/')}}/js/front/left-menu-jquery.js"></script> 
<div class="col-sm-3 col-md-3 col-lg-2 left-green-box">
                 <div class="left-section-member">
                     
                  <div class="member-profile">
                     <div class="rounded-box"> <img src="{{$user_auth_details['profile_image']}}" alt="Interviewxp" /></div>
                      <div class="profile-name">
                          <h5>{{ucfirst($user_auth_details['first_name'])}}</h5>
                          <h6 style="font-size: 13px;">Member - IE000{{$user_auth_details['member_id']}}</h6>
                      </div>
                      <!--div class="angle visible-xs hidden-sm hidden-md hidden-lg"><a><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                      </div-->
                  </div>
                     
                     <div id='cssmenu'>
<ul>
   
   <li @if(\Request::segment(2)=='upload_history' || \Request::segment(2)=='manage_upload_history') class='has-sub active' @else class='has-sub active'  @endif >
          <a href='javascript:void(0)'>
            <span>My Uploads</span>
          </a>
      <ul class="submenu" @if(\Request::segment(2)=='upload_history' || \Request::segment(2)=='manage_upload_history') style="display: block;" @endif>

            <li @if(\Request::segment(2)=='upload_history') class="act" @endif>
                  <a href='{{url('/member/upload_history')}}'>
                    <span>Uploads</span>
                  </a>
            </li>
            <li @if(\Request::segment(2)=='upload_history') class="act" @endif>
                  <a href='{{url('/member/manage_upload_history')}}'>
                    <span>Manage Uploads</span>
                  </a>
            </li>
             
           {{--  <li @if(\Request::segment(2)=='add_skill') class="has-sub act" @else class='has-sub' @endif >
                  <a href='{{url('/member/add_skill')}}'>
                    <span>Add New Skills</span>
                  </a>
            </li>

            <li class='last'>
                  <a href='javascript:void(0)'>
                    <span>Products</span>
                  </a>
            </li> --}}
      </ul>
   </li>





   <li @if(\Request::segment(2)=='personal' || \Request::segment(2)=='edit_employment' ||\Request::segment(2)=='edit_education') class='has-sub active' @else class='has-sub' @endif >
      <a href='javascript:void(0)'>
        <span>My Profile</span>
      </a>


      <ul class="submenu" @if(\Request::segment(2)=='personal' || \Request::segment(2)=='edit_employment' ||\Request::segment(2)=='edit_education')  style="display: block;" @endif>

         <li @if(\Request::segment(2)=='personal') class="act" @endif>
              <a href='{{url('/member/interviewCoach')}}'>
                <span>Interview Coach</span>
              </a>
         </li>
		 <li @if(\Request::segment(2)=='personal') class="act" @endif>
              <a href='{{url('/member/personal')}}'>
                <span>Personal</span>
              </a>
         </li>


          <li @if(\Request::segment(2)=='edit_employment') class="act" @endif>
                <a href='{{url('/member/edit_employment')}}'>
                  <span>Employment</span>
                </a>
          </li>

         <li @if(\Request::segment(2)=='edit_education') class="last act" @else class='last' @endif >
              <a href='{{url('/member/edit_education')}}'>
                <span>Education</span>
              </a>
         </li>

      </ul>
   </li>





    <li @if(\Request::segment(2)=='about_interview' || \Request::segment(2)=='curriculum' ||\Request::segment(2)=='biography' ||\Request::segment(2)=='interview_experience' ||\Request::segment(2)=='call_job_market') class='has-sub active' @else class='has-sub active' @endif >
      <a href='javascript:void(0)'>
        <span>My Learners</span>
      </a>

      <ul class="submenu" @if(\Request::segment(2)=='about_interview' || \Request::segment(2)=='curriculum' ||\Request::segment(2)=='biography' ||\Request::segment(2)=='interview_experience' ||\Request::segment(2)=='call_job_market') style="display: block;" @endif>
<!--
         <li @if(\Request::segment(2)=='about_interview') class="act" @endif>
              <a href='{{url('/member/about_interview')}}'>
                <span>About this Interview</span>
              </a>
         </li>
         
         <li @if(\Request::segment(2)=='curriculum') class="act" @endif>
              <a href='{{url('/member/curriculum')}}'>
                <span>Curriculum</span>
              </a>
         </li>
         
         <li @if(\Request::segment(2)=='biography') class="act" @endif>
              <a href='{{url('/member/biography')}}'>
                <span>Biography</span>
              </a>
         </li>
         
         <li @if(\Request::segment(2)=='interview_experience') class="act" @endif>
              <a href='{{url('/member/interview_experience')}}'>
                <span>My Interview Experience</span>
              </a>
         </li>
         
         <li @if(\Request::segment(2)=='call_job_market') class="last act" @else class='last' @endif >
              <a href='{{url('/member/call_job_market')}}'>
                <span>Present Calls in Job Market</span>
              </a>
         </li>
-->
		<li @if(\Request::segment(2)=='biography') class="act" @endif>
              <a href='{{url('/member/biography')}}'>
                <span>Bookings</span>
              </a>
         </li>
         <li @if(\Request::segment(2)=='reviews') class="last act" @else class='last' @endif >
              <a href='{{url('/member/reviews')}}'>
                <span>Reviews & Ratings</span>
              </a>
         </li>

      </ul>
   </li>
    
  {{--  <li @if(\Request::segment(2)=='real_time_experience' || \Request::segment(2)=='listing_real_time_experience') class='has-sub active' @else class='has-sub' @endif >
        <a href='javascript:void(0)'>
          <span>My Real Time Experience</span>
        </a>
    <ul class="submenu" @if(\Request::segment(2)=='real_time_experience' || \Request::segment(2)=='listing_real_time_experience') style="display: block;" @endif>
         <li @if(\Request::segment(2)=='real_time_experience') class="act" @endif>
              <a href='{{url('/member/real_time_experience')}}'>
                <span>Add Real Time Experience</span>
              </a>
         </li>

         <li @if(\Request::segment(2)=='listing_real_time_experience') class="last act" @else class='last' @endif>
              <a href='{{url('/member/listing_real_time_experience')}}'>
                <span>Manage Real Time Experience Added</span>
              </a>
         </li>

    </ul>
  
  </li> --}}
</ul>
</div>
            
 </div> 
</div>