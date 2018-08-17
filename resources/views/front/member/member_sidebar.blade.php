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
            <span class="sibebar-main-txt">My Uploads</span>
          </a>
      <ul class="submenu" @if(\Request::segment(2)=='upload_history' || \Request::segment(2)=='manage_upload_history') style="display: block;" @endif>

            <li @if(\Request::segment(2)=='upload_history') class="act" @endif>
                  <a href='{{url('/member/upload_history')}}'>
                    <img src="{{url('/')}}/themeassets/icon_member/uplaod_green.png" class="member-icons coach-icon" title="Uploads" /><span class="sibebar-link-txt">Uploads</span>
                  </a>
            </li>
            <li @if(\Request::segment(2)=='upload_history') class="act" @endif>
                  <a href='{{url('/member/manage_upload_history')}}'>
                    <img src="{{url('/')}}/themeassets/icon_member/manage_upload_green.png" class="member-icons coach-icon" title="Manage Uploads" /><span class="sibebar-link-txt">Manage Uploads</span>
                  </a>
            </li>
             
           {{--  <li @if(\Request::segment(2)=='add_skill') class="has-sub act" @else class='has-sub' @endif >
                  <a href='{{url('/member/add_skill')}}'>
                    <img src="{{url('/')}}/images/coach.png" class="member-icons coach-icon" title="Uploads" /><span class="sibebar-link-txt">Add New Skills</span>
                  </a>
            </li>

            <li class='last'>
                  <a href='javascript:void(0)'>
                    <span>Products</span>
                  </a>
            </li> --}}
      </ul>
   </li>



    <li @if(\Request::segment(2)=='about_interview' || \Request::segment(2)=='curriculum' ||\Request::segment(2)=='biography' ||\Request::segment(2)=='interview_experience' ||\Request::segment(2)=='call_job_market' || \Request::segment(2)=='schedule_class' || \Request::segment(2)=='class_enrollments' ||\Request::segment(2)=='curriculam') class='has-sub active' @else class='has-sub active' @endif >
      <a href='javascript:void(0)'>
        <span class="sibebar-main-txt">My Learners</span>
      </a>

      <ul class="submenu" @if(\Request::segment(2)=='about_interview' || \Request::segment(2)=='curriculum' ||\Request::segment(2)=='biography' ||\Request::segment(2)=='interview_experience' ||\Request::segment(2)=='call_job_market') style="display: block;" @endif>

		<li @if(\Request::segment(2)=='biography') class="act" @endif>
              <a href='{{url('/member/biography')}}'>
                <img src="{{url('/')}}/themeassets/icon_member/interviewbook.png" class="member-icons coach-icon" title="Interview Coach Bookings" /><span class="sibebar-link-txt">Interview Coach Bookings</span>
              </a>
         </li>
         
  
        @if(!empty($arr_user_info[0]['training_tab']))
  
         <li @if(\Request::segment(2)=='class_enrollments') class="last act" @else class='last' @endif >
              <a href='{{url('/member/classEnrollments')}}'>
                <img src="{{url('/')}}/images/online-class-enrollments.png" class="member-icons coach-icon" title="Online Class Enrollments" /><span class="sibebar-link-txt">Online Class Enrollments</span>
              </a>
         </li>
         <li @if(\Request::segment(2)=='schedule_class') class="act" @endif>
              <a href='{{url('/member/scheduleClass')}}'>
                <img src="{{url('/')}}/images/schedule-class.png" class="member-icons coach-icon" title="Schedule Class" /><span class="sibebar-link-txt">Schedule Class</span>
              </a>
         </li>         
         <li @if(\Request::segment(2)=='curriculam') class="last act" @else class='last' @endif >
              <a href='{{url('/member/curriculam')}}'>
                <img src="{{url('/')}}/images/curriculam.png" class="member-icons coach-icon" title="Curriculam" /><span class="sibebar-link-txt">Curriculam</span>
              </a>
         </li>
         @endif
         <li @if(\Request::segment(2)=='reviews') class="last act" @else class='last' @endif >
              <a href='{{url('/member/allreviews')}}'>
                <img src="{{url('/')}}/themeassets/icon_member/review-rating.png" class="member-icons coach-icon" title="Reviews & Ratings" /><span class="sibebar-link-txt">Reviews & Ratings</span>
              </a>
         </li>

      </ul>
   </li>
   

   <li @if(\Request::segment(2)=='personal' || \Request::segment(2)=='edit_employment' ||\Request::segment(2)=='edit_education') class='has-sub active' @else class='has-sub' @endif >
      <a href='javascript:void(0)'>
        <span class="sibebar-main-txt">My Profile</span>
      </a>


      <ul class="submenu" @if(\Request::segment(2)=='personal' || \Request::segment(2)=='edit_employment' ||\Request::segment(2)=='edit_education')  style="display: block;" @endif>

         <li style="display:none" @if(\Request::segment(2)=='personal') class="act" @endif>
              <a href='{{url('/member/interviewCoach')}}'>
                <img src="{{url('/')}}/themeassets/icon_member/profile.png" class="member-icons coach-icon" title="Coach" /><span class="sibebar-link-txt">Coach</span>
              </a>
         </li>
         
         @if(\Request::segment(2)=='edit_employment')
   
          <li @if(\Request::segment(2)=='edit_employment') class="act" @endif>
                <a   data-target="A"  class="ppnews">
                  <img src="{{url('/')}}/themeassets/icon_member/emp.png" class="member-icons coach-icon" title="Employment" /><span class="sibebar-link-txt">Employment</span>
                </a>
          </li>
          
            <li @if(\Request::segment(2)=='personal') class="act" @endif>
              <a   data-target="B" class="ppnews">
                <img src="{{url('/')}}/themeassets/icon_member/personal.png" class="member-icons coach-icon" title="Personal" /><span class="sibebar-link-txt">Personal</span>
              </a>
         </li>



         <li @if(\Request::segment(2)=='edit_education') class="last act" @else class='last' @endif >
              <a   data-target="C" class="ppnews">
                <img src="{{url('/')}}/themeassets/icon_member/education.png" class="member-icons coach-icon" title="Education" /><span class="sibebar-link-txt">Education</span>
              </a>
         </li>
         @else
          <li @if(\Request::segment(2)=='edit_employment') class="act" @endif>
                <a   href="{{url('/member/edit_employment')}}"  >
                  <img src="{{url('/')}}/themeassets/icon_member/emp.png" class="member-icons coach-icon" title="Employment" /><span class="sibebar-link-txt">Employment</span>
                </a>
          </li>
          
            <li @if(\Request::segment(2)=='personal') class="act" @endif>
        <a   href="{{url('/member/edit_employment')}}"  >
                <img src="{{url('/')}}/themeassets/icon_member/personal.png" class="member-icons coach-icon" title="Personal" /><span class="sibebar-link-txt">Personal</span>
              </a>
         </li>



         <li @if(\Request::segment(2)=='edit_education') class="last act" @else class='last' @endif >
             <a   href="{{url('/member/edit_employment')}}"  >
                <img src="{{url('/')}}/themeassets/icon_member/education.png" class="member-icons coach-icon" title="Education" /><span class="sibebar-link-txt">Education</span>
              </a>
         </li>
         
         @endif
         
         

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