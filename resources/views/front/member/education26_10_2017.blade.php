 @extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.css">
<div id="header-home" class="home-header"></div>
      <div class="signup-banner">
         <div class="pattern-signup">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="signup-heading">New Member? Register here!</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--end-->
      <!--middle section-->
      
      <div class="middle-area">
         <div class="container">
            <div class="row">
               <div class="col-sm-8 col-md-8 col-lg-6">
                  <div class="form-wrapper">
                     <h3>Have you attended lots of Interviews? Would you like to share interview questions &amp answers &amp; monetize your experience?</h3>
                     <!--process box-->
                     <form action="{{url('/member/store_education')}}" id="frm_education_member" method="POST" data-parsley-validate>
               {{ csrf_field() }}
               @include('front.layout._operation_status')
                <?php $current_year = date('Y'); ?>
                     <div class="process-bx">
                        <div class="center-row">
                           <div class="step_process border-line">
                              <div class="active-step step_bor">
                                 <div class="active_step normal_step">1</div>
                              </div>
                              <div class="plan-detail left1">
                                 <div class="active step_title">Personal</div>
                              </div>
                           </div>
                           <div class="bg_i">&nbsp;</div>
                           <div class="step_process border-line">
                              <div class="step_bor">
                                 <div class="active_step normal_step">2</div>
                              </div>
                              <div class="plan-detail left2">
                                 <div class="active step_title">Employment</div>
                              </div>
                           </div>
                           <div class="bg_i">&nbsp; </div>
                           <div class="step_process">
                              <div class="step_bor">
                                 <div class="active_step normal_step">3</div>
                              </div>
                              <div class="plan-detail left3">
                                 <div class="active step_title">Education</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--end-->
                     <div class="form-group">
                        <label>Highest Qualification<span class="star">*</span></label>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="select-number">
                                 <select name="qualification_id" onchange="loadSpecialization(this);" required="" data-parsley-errors-container="#err_high_qualification" data-parsley-required-message="This field is required">
                                    <option value="">--Select Qualification--</option>
			                      	@if(isset($arr_qualification) && count($arr_qualification)>0)
			                        @foreach($arr_qualification as $qualification)
			                        <option value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
			                        @endforeach
			                        @endif 
                                 </select>
                                  <div id="err_high_qualification" class="error"></div>
                                 <div class="error">{{ $errors->first('qualification_id') }}</div>
                              </div>
                           </div>
                           <div  id="specialization_div" class="col-sm-6">
                              <div class="select-number">
                                 <select id="specialization" name="specialization_id" data-parsley-required="true" data-parsley-errors-container="#err_specialization" data-parsley-required-message="This field is required">
                                    
                                 </select>

                               <!--    <select id="specialization" name="specialization_id">
                                    
                                 </select> -->
                                  <div id="err_specialization" class="error"></div>
                              </div>
                              
                           </div>
                        </div>
                        <div class="m-top">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="select-number">
                                    <select name="passing_month" required="" data-parsley-errors-container="#err_passing_month" data-parsley-required-message="This field is required">
                                        <option value="">Passing Month</option>
				                        <option value="jan">Jan</option>
				                        <option value="feb">Feb</option>
				                        <option value="mar">Mar</option>
				                        <option value="apr">Apr</option>
				                        <option value="may">May</option>
				                        <option value="jun">Jun</option>
				                        <option value="jul">Jul</option>
				                        <option value="aug">Aug</option>
				                        <option value="sep">Sep</option>
				                        <option value="oct">Oct</option>
				                        <option value="nov">Nov</option>
				                        <option value="dec">Dec</option>
                                    </select>
                                    <div id="err_passing_month" class="error"></div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="select-number">
                                    <select name="passing_year" required="" data-parsley-errors-container="#err_passing_year" data-parsley-required-message="This field is required">
                                       <option value="">Passing Year</option>
                                        @for($i=$current_year;$i>=1992;$i--) 
                                        <option value="{{$i}}"> {{$i}}</option>
                                        @endfor
                                    </select>
                                   <div id="err_passing_year" class="error"></div>
                                 <div class="error">{{ $errors->first('passing_year') }}</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--inline checkbox-->
                     <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-2">
                           <div class="form-lable">Marks:</div>
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-10">
                           <div class="radio-btns">
                              <div class="radio-btn">
                                 <input id="marks_type" value="percentage" name="marks_type" type="radio" required="" data-parsley-errors-container="#err_marks" data-parsley-required-message="This field is required">
                                 <label for="marks_type">Percentage</label>
                                 <div class="check"></div>
                              </div>
                              <div class="radio-btn">
                                 <input  id="marks_typec" value="cgpa" name="marks_type" type="radio">
                                 <label for="marks_typec">CGPA(Out of 10)</label>
                                 <div class="check">
                                    <div class="inside"></div>
                                 </div>
                              </div>

                           </div>
                        </div>
                        
                        <div class="clearfix"></div>
                     </div>
                      <div id="err_marks" class="error"></div>
                       <div class="error">{{ $errors->first('marks_type') }}</div>
                  </div>
                     <!--end-->
                  <div class="form-group">
                        <label></label>
                        <input type="text" onkeyup="markstype();" id="marks_input" name="marks_input" class="input-box-signup" value="{{old('marks_input')}}" placeholder="Enter Your Marks" required="" data-parsley-type="integer" data-parsley-errors-container="#err_marks_input1" data-parsley-required-message="This field is required"/>
                           <div class="error">{{ $errors->first('marks_input') }}</div>
                         <div id="err_marks_input1" class="error"></div>
                         
                  </div>
                  <div class="form-group">
                        <label></label>
                        <div id="err_marks_input" class="error"></div>
                  </div>
                 
                     <div class="form-group">
                        <label>PAN NO.<span class="star">*</span></label>
                        <input type="text" name="pan_no" class="input-box-signup" placeholder="Enter Your PAN NO." required="" data-parsley-pattern="[A-Za-z]{5}\d{4}[A-Za-z]{1}" data-parsley-errors-container="#err_pan_no" data-parsley-pattern-message="Please enter valid pan no." data-parsley-required-message="This field is required"/>
                        <div id="err_pan_no" class="error"></div>
                        <div class="error">{{ $errors->first('pan_no') }}</div> 
                     </div>
                      
				   <div id="city" class="form-group" style="display:none">
					  <label>Location<span class="star">*</span></label>
					  <div class="select-number">
						 <select id="city_parsely"  name="city" data-parsley-required="true"     data-parsley-errors-container="#err_city" data-parsley-required-message="This field is required">
							<option value="">--Select City--</option>
						  @if(isset($arr_state) && count($arr_state)>0)
							@foreach($arr_state as $state)
							<optgroup label="{{$state['state_name']}}">

							@if(isset($state['city']) && sizeof($state['city'])>0)

							  @foreach($state['city'] as $city)
							  <option value="{{ $city['city_id'] }}">{{ $city['city_name'] or '-' }}</option>  

							  @endforeach
							@endif  
							</optgroup>
							  
							@endforeach
						  @endif
						 </select>
						<div id="err_city" class="error"></div> 
					  </div>
					   
				   </div>

                           
                     <?php /*   <div class="check-box">
                        <input onclick="locationtype();" value="location" class="css-checkbox" id="radio7" name="location_type" type="checkbox">
                        <label class="css-label radGroup2" for="radio7">Outside India</label>
                        </div> */ ?>
                    
                     
                     
                     <div class="form-group">
                        <label>Social Network</label>
                        <div class="row">
                           <div class="col-sm-4">
                              <input type="text" name="facebook" class="input-box-signup m-bottom" placeholder="Facebook" />
                           </div>
                           <div class="col-sm-4">
                              <input type="text" name="linkedin" class="input-box-signup m-bottom" placeholder="LinkedIn" />
                           </div>
                           <div class="col-sm-4">
                              <input type="text" name="twitter" class="input-box-signup" placeholder="Twitter" />
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Tell us about your skill set<span class="star">*</span></label>
                        <textarea style="height: 187px;" class="form-area" name="about_member" cols="30" rows="10" required="" data-parsley-errors-container="#err_skill_set" data-parsley-required-message="This field is required" placeholder="You MUST have real time work experience of minimum 2 years in a good company to become a member with us. If you are interested to earn serious money with us then you MUST reply the below 5 questions. Once we get answers to these below questions we will call you verify and activate your account !


                                                   Is your skill a hot cake in market and is it in good demand ?
                                                   How regularly are jobs posted in job portals for your skill ?
                                                   How many calls can one expect in the present market for 0-2 years ? 2-4 years ? 5-10 years ?How many interviews have you given so far ? In how many companies ?Have you attended interviews in minimum 10 companies in the last 3 months ?
                                                                                                                     
"></textarea>
                     <div id="err_skill_set" class="error"></div>
                     </div>
                     <input type="hidden" value="{{$enc_id or ''}}" name="enc_id">
                     

                     <div class="check-box">
                     <input  class="css-checkbox"  id="condition" name="condition" value="condition" type="checkbox" required="" data-parsley-errors-container="#err_term_con" data-parsley-required-message="This field is required">
                     <label class="css-label radGroup2" for="condition">By Clicking create on account, You agree to <a href="{{url('/terms_of_use')}}" target="_new">our terms and conditions</a> governing the use of <a href="{{url('/')}}">interviewxp.com</a>
                      <div id="err_term_con" class="error"></div>
                     </label>
                      <div class="clearfix">&nbsp;</div>
                     
                  </div>
                  <div class="g-recaptcha captch-educatn" data-sitekey="6Lc-HA4UAAAAAPY67Ox_frqmqLpqfPxGmPHg0Aot"></div>

                     <div id="captcha_error" class="error">  </div>
                     <div class="text-right m-top"><button type="submit" onclick="javascript:return validate_with_recaptcha();" class="submit-btn ctn">Create an Account</button> </div>
                     </form>
                  </div>

               </div>

               <div class="col-sm-4 col-md-4 col-lg-6">
            <!--right section-->
            <div class="signup-personal-RightSection row">
               <div class="line-empty">&nbsp;</div>
               <div class="signup-personal-img pull-right text-center col-sm-12 col-md-12 col-lg-6">
                  <img src="{{url('/')}}/images/signup-Personal-img1.png" alt="Interviewxp" class="img-responsive img-d hidden-xs hidden-sm hidden-md">
                  <img src="{{url('/')}}/images/doller.png" alt="Interviewxp" class="img-responsive visible-xs visible-sm visible-md">
                  <h5>You Could earn an extra income of 5,000/- to 1,00,000/- Plus every month</h5>
               </div>
               <div class="clr"></div>
               <div class="signup-personal-img pull-left text-center col-sm-12 col-md-12 col-lg-6">
                  <img src="{{url('/')}}/images/signup-Personal-img2.png" alt="Interviewxp" class="img-responsive img-d-r hidden-xs hidden-sm hidden-md">
                  <img src="{{url('/')}}/images/person.png" alt="Interviewxp" class="img-responsive visible-xs visible-sm visible-md">
                  <h5>It might be useful to repay your loans, or dream trip to foreign countries</h5>
               </div>
               <div class="clr"></div>
               <div class="signup-personal-img pull-right text-center col-sm-12 col-md-12 col-lg-6">
                  <img src="{{url('/')}}/images/signup-Personal-img3.png" alt="Interviewxp" class="img-responsive img-d hidden-xs hidden-sm hidden-md">
                  <img src="{{url('/')}}/images/signup-img3.png" class="img-responsive visible-xs visible-sm visible-md">
                  <h5>Share, contribute your real time work experience and interview Q &amp; A</h5>
               </div>
               <div class="clr"></div>
               <div class="signup-personal-img pull-left text-center col-sm-12 col-md-12 col-lg-6">
                  <img src="{{url('/')}}/images/signup-Personal-img4.png" alt="Interviewxp" class="img-responsive img-d-r hidden-xs hidden-sm hidden-md">
                  <img src="{{url('/')}}/images/rocket.png" alt="Interviewxp" class="img-responsive visible-xs visible-sm visible-md">
                  <h5>Spare your time, 8 hours a month and make more money at interviewxp</h5>
               </div>
            </div>
            <!--end-->
             <!--contact details box-->
                 
                  <div class="contact-details pull-right">
                     <div class="inner-details">
                        <h4>Customer Support</h4>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
                           <div class="contact-details2">
                              <h5>Landline:</h5>
                              <h6>040-646487</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
                           <div class="contact-details2">
                              <h5>Mobile no.:</h5>
                             <!--  <h6>9000000009</h6> -->
                             <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
                           <div class="contact-details2">
                              <h5>Email:</h5>
                              <!-- <h6 class="email">support@interviewxp.com</h6> -->
                              <h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <!--end-->
         </div>
            </div>
         </div>
      </div>

{{-- <script type="text/javascript">
$(document).ready(function(){
     var spelization=document.getElementById("specialization");
          if(spelization[spelization.selectedIndex].value=="No Specialization")
          {
           $('#specialization').attr('data-parsley-required', 'false');
          } 
          else if(spelization[spelization.selectedIndex].value=="Select Specialization")
          {
             $('#specialization').attr('data-parsley-required', 'true');
          }
 });           
</script> --}}
   <script src="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.js"></script>
      <script src='https://www.google.com/recaptcha/api.js'></script>


<script type="text/javascript">
     

     function validate_with_recaptcha() 
    {
		alert($('#frm_education_member').parsley().isValid());

        if($('#frm_education_member').parsley().isValid())
        {
            var is_valid_captcha= grecaptcha.getResponse();  
              
            if(is_valid_captcha=="")
            {
               $('#captcha_error').html('This field is required.');
               return false;
            }
            grecaptcha.getResponse()==""?false:true
            run_waitMe();
        }
        
    }

    /*$(function(){   */
  // none, bounce, rotateplane, stretch, orbit,
  // roundBounce, win8, win8_linear or ios
  function run_waitMe(){
    
  $('body').waitMe({
  //none, rotateplane, stretch, orbit, roundBounce, win8,
  //win8_linear, ios, facebook, rotation, timer, pulse,
  //progressBar, bouncePulse or img
  effect: 'win8',
  //place text under the effect (string).
  text: 'Please Wait...',
  //background for container (string).
  bg: 'rgba(179,179,179,0.7)',
  //color for background animation and text (string).
  color: 'green',
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
  /*});*/


var url = "{{ url('/user/specialization') }}";
    function loadSpecialization(ref)
    {
        var selected_qualification = jQuery(ref).val();
        
        jQuery.ajax({
                        url:url+'/'+selected_qualification,
                        type:'GET',
                        data:'',
                        dataType:'json',
                        beforeSend:function()
                        {
                            jQuery('select[name="specialization_id"]').attr('disabled','disabled');
                        },
                        success:function(response)
                        {
                            if(response.status=="SUCCESS")
                            {
                              
                                jQuery('select[name="specialization_id"]').removeAttr('disabled');
                                if(typeof(response.arr_specialization) == "object")
                                {$('#specialization_div').show();
                                   var option = '<option value="">Select Specialization</option>'; 
                                   jQuery(response.arr_specialization).each(function(index,specialization)
                                   {   
                                    
                                        option+='<option value="'+specialization.id+'">'+specialization.specialization_name+'</option>';
                                   });

                                   jQuery('select[name="specialization_id"]').html(option);
                                }
                                //$('#specialization').attr('data-parsley-required', 'true');
                               jQuery('select[name="specialization_id"]').attr('data-parsley-required','true');
                            }
                            else
                            {$('#specialization_div').hide();
                              var option = '<option value="">No Specialization</option>'; 
                              jQuery('select[name="specialization_id"]').html(option);
                              //$('#specialization').attr('data-parsley-required', 'false');
                               jQuery('select[name="specialization_id"]').attr('data-parsley-required','false');
                            }
                            return false;
                        },
                        error:function(response)
                        {
                         
                        }

        });
     }  

     function markstype()
     {
        var value_markstype = $("input[name='marks_type']:checked").val();
         
        var value_marks = $('#marks_input').val();
        if(value_markstype=='percentage')
        {
          if(value_marks<30 || value_marks>100 )
          {
            $('#err_marks_input').html('Percentage value must be between 30 to 100.').fadeIn().delay(3000).fadeOut();
            return false;
          } 
        }
        if(value_markstype=='cgpa')
        {
          if(value_marks<1 || value_marks>10 )
          {
            $('#err_marks_input').html('CGPA value must be between 1 to 10.').fadeIn().delay(3000).fadeOut();
            return false;
          }  
        }
     }  

  </script>
@endsection               