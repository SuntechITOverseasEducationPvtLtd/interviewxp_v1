<style>
    .schange_password_01{margin-top: 2%;}
</style>
@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<div class="banner-member">
 <div class="pattern-member">  
 </div>
</div>      
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')  
      <div class="col-sm-6 col-md-6 col-lg-6">  
   <form action="{{url('/member/update_password')}}"  id="frm_member_change_password" method="POST" data-parsley-validate>
   {{ csrf_field() }}
	@include('admin.layout._operation_status')
	   <div class="col-md-12 form-wrapper extra-m">
		   <div class="form-group">
			   <label>Current Password:</label>
			   <input type="password" data-rule-required="true" name="old_password" class="input-box-signup" placeholder="Enter Your Current Password" required=""  data-parsley-errors-container="#err_old_password" data-parsley-required-message="This field is required" />
			   <div id="err_old_password" class="error"></div>
			   <!--div class="error">Password is not Valid</div-->
		   </div>
		   <div class="form-group">
			   <label>New Password:</label>
			   <input type="password" id="new_password" name="new_password" class="input-box-signup" placeholder="Enter Your New Password" required="" data-parsley-pattern="((?=.*\d)(?=.*[!@#$%]).{6,})" data-parsley-errors-container="#err_new_password" data-parsley-required-message="This field is required" data-parsley-pattern-message="Password must be 6 characters in length and contain atleast one special character and number."  />
			   <div id="err_new_password" class="error"></div>
			   <!--div class="error">Password is not Valid</div-->
		   </div>
		   <div class="form-group">
			   <label>Confirm New Password:</label>
			   <input type="password" data-rule-required="true" name="con_new_password" class="input-box-signup" placeholder="Confirm your New Password" required=""  data-parsley-errors-container="#err_confirm_password" data-parsley-required-message="This field is required" data-parsley-equalto="#new_password" data-parsley-equalto-message="New password and confirm new password must be the same." />
			   <div id="err_confirm_password" class="error"></div>
			   <!--div class="error">Password is not Match</div-->
		   </div>
		   <div class="btn-wrapper">
			   <button type="reset"  class="cancel-btn">Cancel</button>
			   <button type="submit" class="submit-btn">Change Password</button>
		   </div>
	   </div>
	   </form>
	   </div>
	   <div class="col-md-12 col-lg-3 schange_password_01">
		   <div class="top-blocks-right">
			  <div class="user-block-right">
				 <div class="content-block-right">
					<h3>MEMBER ID</h3>
					<h4>IE000{{$user_auth_details['member_id']}}</h4>
				 </div>
				 <div class="img-top-blocks-right"><img src="{{url('/')}}/images/user.png" alt="Interviewxp"/></div>
			  </div>
		   </div>
		   <!--end-->
		</div>
	   
   </div>
</div>

@endsection       