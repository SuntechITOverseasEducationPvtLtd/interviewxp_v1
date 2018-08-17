@extends('front.layout.main')
@section('middle_content')
<div id="header-home"></div>
      <div class="banner-login">
         <div class="pattern-login">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="login-box">
                        <h3>Member Login</h3>
                        <img src="{{url('/')}}/images/bag-login.png" alt="Interviewxp" class="center-block"/>
                        @include('front.layout._operation_status')
                        
                        <form action="{{url('/member/login_process')}}" method="POST" id="frm_member_login" >
                        {{ csrf_field() }}
                           <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" name="email" data-rule-required='true'
                              data-rule-email='true' class="input-box-login" id="email"/>
                              
                               <div class="error">{{ $errors->first('email') }}</div>
                           </div>
                           <div class="form-group">
                              <label for="pwd">Password:</label>
                              <input type="password" name="password" data-rule-required='true' class="input-box-login" id="pwd"/>
                              <div class="error">{{ $errors->first('password') }}</div>
                              
                           </div>
                           <div class="checkbox"><input name="remember" value="remember" type="checkbox"/> Remember me</div>
                           <div class="forget"><a href="{{url('/member/forgot_password_member')}}">Forgot Password?</a></div>
                           <div class="clr">&nbsp;</div><button type="submit" class="login-button" value="Login">Login</button>
                           <div class="account">
                              <div class="dont-account">Dont have an account?</div>
                              <div class="register"><a href="{{url('/member/register')}}">Register here</a></div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script type="text/javascript">
            $("#frm_member_login").validate({
                  errorElement: 'div',
                  errorClass: 'error',
                  highlight: function (element) {
                      $(element).removeClass('error');
                  }
            });

            
        </script>
@endsection