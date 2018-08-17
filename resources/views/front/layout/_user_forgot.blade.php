@extends('front.layout.main')
@section('middle_content')
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.css">
      <div class="banner-login">
         <div class="pattern-login">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="login-box">
                        <h3>Get back your password</h3>
                        <img src="{{url('/')}}/images/bag-login.png" alt="Interviewxp" class="center-block"/>
                        @include('front.layout._operation_status')
                        <form action="{{url('/user/process_forgot_password')}}" method="POST" id="frm_user_login">
                        {{ csrf_field() }}
                           <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" name="email" class="input-box-login" data-rule-required='true' data-rule-email='true' id="email"/>
                               <div class="error">{{ $errors->first('email') }}</div>
                           </div>
                          <button type="submit" id="user_forgot_password" class="login-button">Recover</button>
                           <div class="account">
                            
                              <div class="register"><a href="{{url('/user/login')}}">← Back to login form</a></div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
<script src="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.js"></script>
<script type="text/javascript">
      $("#frm_user_login").validate({
                  errorElement: 'span',
                  errorClass: 'error',
                  highlight: function (element) 
                  {
                      $(element).removeClass('error');
                  }
            });

            $(function(){
            
            $('#user_forgot_password').click(function()
            {
               if($("#frm_user_login").valid())
               {
                  var current_effect = 'ios';
                  run_waitMe(current_effect);
               }
           });
            
  // none, bounce, rotateplane, stretch, orbit,
  // roundBounce, win8, win8_linear or ios
  function run_waitMe(effect){
    
  $('body').waitMe({
  //none, rotateplane, stretch, orbit, roundBounce, win8,
  //win8_linear, ios, facebook, rotation, timer, pulse,
  //progressBar, bouncePulse or img
  effect: 'ios',
  //place text under the effect (string).
  text: 'Please Wait...',
  //background for container (string).
  bg: 'rgba(179,179,179,0.7)',
  //color for background animation and text (string).
  color: '#000',
  //change width for elem animation (string).
  sizeW: '',
  //change height for elem animation (string).
  sizeH: '',
  // url to image
  source: '',
  // callback
  //onClose: function() {}
  });
  }
  });
  </script> 
@endsection