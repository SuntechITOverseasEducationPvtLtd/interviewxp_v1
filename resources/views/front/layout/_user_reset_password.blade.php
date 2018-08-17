@extends('front.layout.main')
@section('middle_content')

<style type="text/css">
  .new-error .error{position: relative;}
  
  .suser_01{position: relative;}
</style>

      <div class="banner-login">
         <div class="pattern-login">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="login-box">
                        <h3>Reset Password</h3>
                        <img src="{{url('/')}}/images/bag-login.png" alt="Interviewxp" class="center-block"/>
                        @include('front.layout._operation_status')
                        <form action="{{url('/user/reset_password')}}" method="POST" id="frm_user_login">
                        {{ csrf_field() }}
                           <div class="form-group new-error">
                           <label for="email">New Password:</label>
                                {!! Form::password('password',['class'=>'form-control','id'=>'new_password',
                                        'data-rule-required'=>'true','data-rule-minlength'=>'6','data-rule-pattern'=>"((?=.*\d)(?=.*[!@#$%]).{6,})",'data-msg-pattern'=>"Password must be 6 characters in length and contain atleast one special character and number.",
                                        'placeholder'=>'New Password']) !!}
                              <span class="error suser_01" >{{ $errors->first('password') }} </span>
                           </div>
                             <div class="form-group">
                             <label for="email">Confirm Password:</label>
                               {!! Form::password('confirm_password',['class'=>'form-control',
                                        'data-rule-required'=>'true','data-rule-minlength'=>'6','data-rule-equalto'=>'#new_password',
                                        'placeholder'=>'Confirm Password']) !!}
                                <span class="error">{{ $errors->first('confirm_password') }} </span>
                           </div>
                        <input type="hidden" name="enc_id" value="{{ $enc_id or '' }}" />
                        <input type="hidden" name="enc_reminder_code"  value="{{ $enc_reminder_code or '' }}"/>
                          <button type="submit" class="login-button">Change Password</button>
                           <div class="account">
                            
                              <!-- <div class="register"><a href="{{url('/user/login')}}">← Back to login form</a></div> -->
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">
            $("#frm_user_login").validate({
                  errorElement: 'span',
                  errorClass: 'error',
                  highlight: function (element) {
                      $(element).removeClass('error');
                  }
            });

            /*$('#login_btn').click(function(){
               if($("#frm_login").valid())
               {
                  showProcessingOverlay();
               }
           });*/
        </script>
      @endsection