@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<div class="banner-change-pw">
         <div class="pattern-change-pw">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="heading-changepw">{{$module_title}}</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<div class="middle-area min-height">
           <div class="container">
               <div class="row">
               <form action="{{url('/user/update_password')}}" id="frm_user_change_password" method="POST" data-parsley-validate>
               {{ csrf_field() }}
               @include('admin.layout._operation_status')
                   <div class="col-md-6 form-wrapper">
                       <div class="form-group">
                           <label>Current Password:</label>
                           <input type="password" data-rule-required="true" name="old_password" class="input-box-signup" placeholder="Enter Your Current Password" required=""  data-parsley-errors-container="#err_old_password" data-parsley-required-message="This field is required" />
                           <div id="err_old_password" class="error"></div>
                           <!--div class="error">Password is not Valid</div-->
                       </div>
                       <div class="form-group">
                           <label>New Password:</label>
                           <input type="password" id="new_password" name="new_password" class="input-box-signup" placeholder="Enter Your New Password" required="" data-parsley-pattern="((?=.*\d)(?=.*[!@#$%]).{6,})" data-parsley-errors-container="#err_new_password" data-parsley-required-message="This field is required" data-parsley-pattern-message="Password must be 6 characters in length and contain atleast one special character and number." />
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
           </div>
           
       </div>
       

@endsection       