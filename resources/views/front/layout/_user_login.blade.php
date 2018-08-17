@extends('front.layout.main')
@section('middle_content')
      <div class="banner-login">
         <div class="pattern-login">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="login-box">
                        <h3>User Login</h3>
                        <img src="{{url('/')}}/images/bag-login.png" alt="Interviewxp" class="center-block"/>
                        @include('front.layout._operation_status')
                        <form action="{{url('/user/login_process')}}" method="POST" id="frm_user_login" id="frm_user_login">
                        {{ csrf_field() }}
                           <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" name="email" class="input-box-login" data-rule-required='true'
                              data-rule-email='true' />
                               <div class="error">{{ $errors->first('email') }}</div>
                           </div>
                           <div class="form-group">
                              <label for="pwd">Password:</label>
                              <input type="password" data-rule-required='true' class="input-box-login" name="password" />
                               
                              <div class="error">{{ $errors->first('password') }}</div>
                           </div>
                           <div class="checkbox"><input name="remember" value="remember" type="checkbox"/> Remember me</div>
                           <div class="forget"><a href="{{url('/user/forgot_password')}}">Forgot Password?</a></div>
                           <div class="clr">&nbsp;</div><button type="submit" class="login-button">Login</button>
                           <div class="account">
                              <div class="dont-account">Dont have an account?</div>
                              <div class="register"><a href="{{url('/user/register')}}">Register here</a></div>
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
                  errorElement: 'div',
                  errorClass: 'error',
                  highlight: function (element) {
                      $(element).removeClass('error');
                  }
            });  
        </script>
      @endsection