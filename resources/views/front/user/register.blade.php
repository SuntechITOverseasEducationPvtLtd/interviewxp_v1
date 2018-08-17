@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.css">
<div class="signup-banner">

   <div class="pattern-signup">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="signup-heading">New User? Create an account here, Its Free !!</div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--end-->
<!--middle section-->
@include('front.layout._operation_status')
<div class="middle-area">
   <div class="container">
      <div class="row">
         <div class="col-sm-8 col-md-8 col-lg-6">
            <div class="form-wrapper">
               <h3>Get access to the latest interview Questions &amp; Answer</h3>
               <form action="{{url('/user/store')}}" id="frm_store_user" method="POST"  autocomplete='off'> 
               {{-- data-parsley-validate --}}
               {{ csrf_field() }}
                <?php  $current_year = date('Y'); ?>
                  <div class="row">
                     <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                        <div class="form-group">
                           <label>First Name <span class="star">*</span></label>
                           <input type="text" name="first_name" value="{{old('first_name')}}" class="input-box-signup" data-parsley-pattern="^[a-zA-Z]+$"
                        data-parsley-pattern-message="First name should be only characters" placeholder="Enter Your First Name" required="" data-parsley-errors-container="#err_first_name" data-parsley-required-message="This field is required" />
                           <div id="err_first_name" class="error"></div>
                           <div class="error">{{ $errors->first('first_name') }}</div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-6 last-name">
                        <div class="form-group">
                           <label>Last Name <span class="star">*</span></label>
                           <input type="text" name="last_name" value="{{old('last_name')}}" class="input-box-signup" data-parsley-pattern="^[a-zA-Z]+$"
                        data-parsley-pattern-message="Last name should be only characters" placeholder="Enter Your Last Name" required="" data-parsley-errors-container="#err_last_name" data-parsley-required-message="This field is required" />
                           <div id="err_last_name" class="error"></div>
                            <div class="error">{{ $errors->first('last_name') }}</div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Email Address <span class="star">*</span></label>
                     <input type="text" name="email" class="input-box-signup" id="email_verifi" onchange="javascript: return email_verification();" value="{{old('email')}}" placeholder="Enter Your Email Address" required="" data-parsley-type="email" data-parsley-errors-container="#err_email" data-parsley-required-message="This field is required" />
                           <div id="err_email" class="error"></div>
                           <div id="verify_err_email" class="error"></div>
                            <div class="error">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                     <label>Password <span class="star">*</span></label>
                     <input type="password" id="password" name="password" class="input-box-signup" placeholder="Enter Your Password" required="" data-parsley-pattern="((?=.*\d)(?=.*[!@#$%]).{6,})" data-parsley-errors-container="#err_password" data-parsley-required-message="This field is required" data-parsley-pattern-message="Password must be 6 characters in length and contain atleast one special character and number." />
                           <div id="err_password" class="error"></div>
                            <div class="error">{{ $errors->first('password') }}</div>
                  </div>
                  <div class="form-group">
                     <label>Confirm Password <span class="star">*</span></label>
                     <input type="password" name="con_password" class="input-box-signup" placeholder="Enter Your Confirm Password" required="" data-parsley-equalto="#password" data-parsley-errors-container="#err_con_password" data-parsley-required-message="This field is required" data-parsley-equalto-message="Password and confirm password must be the same." />
                           <div id="err_con_password" class="error"></div>
                           <div class="error">{{ $errors->first('con_password') }}</div>
                  </div>
				  <div id="form-group">
					   <div class="col-sm-4" style="padding:0px">	
					   <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number"  style="width: 95.8%;">
                       

                                <input type="text"  class="input-box-signup keypressit" id="country_id" name="country_id" data-parsley-required="true"    data-parsley-errors-container="#err_country_id" data-parsley-required-message="This field is required"   autocomplete="off" />

<div class="auto-search-box" >
  
<div class="auto-search-boxul"></div>

</div>

                            <div id="err_country_id" class="error"></div>
                        </div>
                        </div>
                        </div>
						<div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
						   <div class="select-number"  style="width: 95.8%;">
                          
                            <input type="text" name="state_id" class="input-box-signup keystate" data-parsley-required="true"    data-parsley-errors-container="#err_state_id" data-parsley-required-message="This field is required"  />


                            <div class="auto-search-box-state" ></div>






                            <input type="hidden" class="countrycodes" name="countrycodes">
						   </div>
						   <div id="err_state_id" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>
                        </div>
						<div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              City
                           </label>
						   <div class="select-number"  style="width: 95.8%;">
                           

     <input type="text"  class="input-box-signup keycity" name="city_id"    data-parsley-errors-container="#err_city_id"   />

      <div class="auto-search-box-city" ></div>




 <input type="hidden" class="satecodeset" name="satecodeset">

						   </div>
						   <div id="err_city_id" class="error"></div>
                        </div>
                        </div>
                        
				 </div>
                  <div class="form-group" style="clear: both;">
                     <label>Mobile Number <span class="star">*</span></label>
                     <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-2 mumber-box-left">
                        <input type="text" name="mobile_code" id="mobile_code"
                               class="input-box-signup" value="+91" data-parsley-pattern="\+[0-9]{1,3}"
                        data-parsley-pattern-message="Enter Valid Country Code" required="" data-parsley-errors-container="#err_mobile_code" data-parsley-required-message="Field required" readonly  />
                               <div id="err_mobile_code" class="error"></div>
                          <div class="error">{{ $errors->first('mobile_code') }}</div>
                           
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-10 mumber-box-right">
                           <input type="text" name="mobile_no" class="input-box-signup" value="{{old('mobile_no')}}" placeholder="Enter Your Mobile Number" required="" data-parsley-type="integer" data-parsley-errors-container="#err_mobile_no" data-parsley-required-message="This field is required" data-parsley-minlength="7" data-parsley-maxlength="16" />
                           <div id="err_mobile_no" class="error"></div>
                            <div class="error">{{ $errors->first('mobile_no') }}</div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Highest Qualification <span class="star">*</span></label>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="select-number">
                              <select name="qualification_id" onchange="loadSpecialization(this);" required="" data-parsley-errors-container="#err_qualification_id" data-parsley-required-message="This field is required">
                                 <option value="">--Select Qualification--</option>
                      @if(isset($arr_qualification) && count($arr_qualification)>0)
                        @foreach($arr_qualification as $qualification)
                        <option value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                        @endforeach
                        @endif 
                              </select>
                              <div id="err_qualification_id" class="error"></div>
                               <div class="error">{{ $errors->first('qualification_id') }}</div>
                           </div>
                        </div>
						<div class="col-sm-4">
						<div id="specialization_div" class="form-group">
							<div class="select-number">
								<select name="specialization_id" data-parsley-required="true" data-parsley-errors-container="#err_specialization" data-parsley-required-message="This field is required">
								   <option value="">--Select Specialization--</option>
								</select>

							   <!--  <select name="specialization_id">
								   
								</select> -->
								<div id="err_specialization" class="error"></div>
							   <!--  <div class="error">{{ $errors->first('specialization_id') }}</div>  -->
							 </div>
						  </div>
						 </div>
                        <?php /*<div class="col-sm-4">
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
                              <div class="error">{{ $errors->first('passing_month') }}</div>
                           </div>
                        </div> */ ?>
                        <div class="col-sm-4">

                           <div class="select-number">
                              <select name="passing_year" required="" data-parsley-errors-container="#err_passing_year" data-parsley-required-message="This field is required">
                                 <option value="">Passing Year</option>
                                  @for($i=$current_year;$i>=1975;$i--) 
                                  <option value="{{$i}}"> {{$i}}</option>
                                  @endfor
                              </select>
                              <div id="err_passing_year" class="error"></div>
                              <div class="error">{{ $errors->first('passing_year') }}</div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
                  <?php /*<div class="form-group">
                     <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-2">
                           <div class="form-lable">Marks<span class="star">*</span></div>
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-10">
                           <div class="radio-btns">
                              <div class="radio-btn">
                                 <input id="marks_typep" value="percentage" name="marks_type" type="radio" required="" type="radio" data-parsley-errors-container="#err_marks_typep" data-parsley-required-message="This field is required">
                                 <label for="marks_typep">Percentage</label>
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
                     <div id="err_marks_typep" class="error"></div>
                     <div class="error">{{ $errors->first('marks_type') }}</div>

                     
                  </div>
                  <!--end-->
                  <div class="form-group">
                  <label></label>
                     <input type="text" onkeyup="markstype();" id="marks_input" name="marks_input" class="input-box-signup" value="{{old('marks_input')}}" placeholder="Enter Your Marks" required="" data-parsley-errors-container="#err_marks_input" data-parsley-required-message="This field is required" />
                     <div class="error" id="err_marks_input"></div>
                  </div>               
                 
                  
                  <div id="city" class="form-group">
                     <label>Current Work Location <span class="star">*</span></label>
                     <div class="select-number">
                        <select id="city_parsely" name="city" data-parsley-required="true" data-parsley-errors-container="#err_city" data-parsley-required-message="This field is required">
                           <option value="">--Select City--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $state)
                        <optgroup label="{{$state['state_name']}}">

                        @if( isset($state['city']) && sizeof($state['city'])>0)

                          @foreach($state['city'] as $city)
                          <option value="{{ $city['city_id'] }}">{{ $city['city_name'] or '-' }}</option>  

                          @endforeach
                        @endif  
                        </optgroup>
                          
                        @endforeach
                      @endif
                        </select>
                        <div id="err_city" class="error"></div>
                         <!-- <div class="error">{{ $errors->first('city') }}</div> -->
                     </div>
                  </div> 
				  

                  <div id="outside_india"  style="display:none;">
                  <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number">
                           <select id="country_id" name="country_id" data-parsley-required="true" data-parsley-errors-container="#err_country_id" data-parsley-required-message="This field is required">
                              <option value="">--Select Country--</option>
                              @if(isset($arr_country) && count($arr_country)>0)
                              @foreach($arr_country as $country)
                              <option value="{{ $country['id'] }}">{{ $country['country_name'] or '-' }}</option>
                              @endforeach
                              @endif
                           </select>
                           <div id="err_country_id" class="error"></div>

                        </div>
                      </div>
                      <div class="form-group">
                           <label>
                              State<span class="star">*</span>
                           </label>
                           <input type="text" class="input-box-signup" id="other_state"  name="other_state" placeholder="Enter your state name here" data-parsley-required="true"  data-parsley-errors-container="#err_other_state" data-parsley-required-message="This field is required" value="{{ old('city') }}" />
                           <div id="err_other_state" class="error"></div>
                        </div>  
                        <div class="form-group">
                           <label>
                              City<span class="star">*</span>
                           </label>
                           <input type="text" class="input-box-signup" id="other_city"  name="other_city" placeholder="Enter your city name here" data-parsley-required="true"  data-parsley-errors-container="#err_other_city" data-parsley-required-message="This field is required" value="{{ old('city') }}" />
                           <div id="err_other_city" class="error"></div>
                        </div>
                     </div>

                     <div class="check-box">
                        <input onclick="locationtype();" value="location" class="css-checkbox" id="radio7" name="location_type" type="checkbox">
                        <label class="css-label radGroup2" for="radio7">Outside India</label>
                        </div> */ ?>
                  <div class="form-group">
                     <label>Birth Date <span class="star">*</span></label>
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="select-number">
                              <select name="date" required="" data-parsley-errors-container="#err_date" data-parsley-required-message="This field is required">
                                 <option value="">Date</option>
                                  @for($i=1;$i<=31;$i++) 
                                  <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT) }}"> {{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                                  @endfor
                              </select>
                              <div id="err_date" class="error"></div>
                               <div class="error">{{ $errors->first('date') }}</div>
                           </div>
                           
                        </div>
                        <div class="col-sm-4">
                           <div class="select-number">
                              <select name="month" required="" data-parsley-errors-container="#err_month" data-parsley-required-message="This field is required">
                                 <option value="">Month</option>
                      
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                              </select>
                            <div id="err_month" class="error"></div>   
                             <div class="error">{{ $errors->first('month') }}</div> 
                           </div>
                          
                        </div>
                       
                        <div class="col-sm-4">
                      
                           <div class="select-number">
                              <select name="year" required="" data-parsley-errors-container="#err_year" data-parsley-required-message="This field is required">
                                 <option value="">Year</option>
                                  @for($i=$current_year-23;$i>=1950;$i--) 
                                  <option value="{{$i}}"> {{$i}}</option>
                                  @endfor
                                 
                              </select>
                             <div id="err_year" class="error"></div>  
                             <div class="error">{{ $errors->first('year') }}</div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
                  <!--inline Radio button-->
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-2">
                           <div class="form-lable">Gender<span class="star">*</span> </div>
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-10">
                           <div class="radio-btns">
                              <div class="radio-btn">
                                 <input id="genderm" required="" name="gender" value="M" type="radio" required="" data-parsley-errors-container="#err_gender" data-parsley-required-message="This field is required">
                                 <label for="genderm">Male</label>
                                 <div class="check"></div>
                              </div>
                              <div class="radio-btn">
                                 <input  id="genderf" value="F" name="gender" type="radio">
                                 <label for="genderf">Female</label>
                                 <div class="check">
                                    <div class="inside"></div>
                                 </div>
                              </div>
                           </div>

                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <div id="err_gender" class="error"></div>
                      <div class="error">{{ $errors->first('gender') }}</div>
                  </div>
                  <!--end-->
                   {{-- <div class="captcha"><img src="{{url('/')}}/images/captcha.jpg" alt="Interviewxp" class="img-responsive" /></div> --}}
                   
                  <div class="check-box termc-c">
                     <input  class="css-checkbox" id="condition" name="condition" value="condition" type="checkbox" required="" data-parsley-errors-container="#err_condition" data-parsley-required-message="This field is required" >
                     <label class="css-label radGroup2" for="condition">By Clicking create on account, You agree to <a href="{{url('/terms_of_use')}}" target="_new">our terms and conditions</a> governing the use of <a href="{{url('/')}}">interviewxp.com</a></label>
                     
                  </div>
                   <div class="clearfix">&nbsp;</div>
                  <div id="err_condition" class="error"></div></br>
                  <div class="g-recaptcha" data-sitekey="6Lc-HA4UAAAAAPY67Ox_frqmqLpqfPxGmPHg0Aot"></div>

                  <div id="captcha_error" class="error">  </div>
                  <div class="error">{{ $errors->first('condition') }}</div>
                  
                 <div class="clearfix">&nbsp;</div>
                  <div class="text-right m-top"><button type="submit" onclick="return validate_with_recaptcha()"  class="submit-btn ctn mar-botm">Create an Account</button> </div>
               </form>
            </div>
         </div>
         <div class="hidden-xs hidden-sm col-md-1 col-lg-1">&nbsp;</div>
         <div class="col-sm-4 col-md-4 col-lg-5">
           <div class="right-section">
            <div class="signup-img1">
               <img src="{{url('/')}}/images/signup-img1.png" alt="Interviewxp" class="img-responsive center-block"/>
               <h5>Do you know what to prepare for job interviews?</h5>
            </div>
            <div class="signup-img1">
               <img src="{{url('/')}}/images/signup-img2.png" alt="Interviewxp" class="img-responsive center-block"/>
               <h5>Find hundreds of Questions & Answers asked in different companies</h5>
            </div>
            <div class="signup-img1">
               <img src="{{url('/')}}/images/signup-img3.png" alt="Interviewxp" class="img-responsive center-block"/>
               <h5>Find the most typical questions asked</h5>
            </div>
            <div class="signup-img1">
               <img src="{{url('/')}}/images/signup-img4.png" alt="Interviewxp" class="img-responsive center-block"/>
               <h5>Know what exactly is an interviewer looking for and work for those points, so that they will have you on board</h5>
            </div>
    </div>
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
                              <!-- <h6>9000000009</h6> -->
                              <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
                           <div class="contact-details2">
                              <h5>Email:</h5>
                             <!--  <h6 class="email">support@interviewxp.com</h6> -->
                             <h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
                           </div>
                        </div>
                     </div>
                  </div>
         </div>
         
      </div>
   </div>
</div>

<script type="text/javascript">

$(document).ready(function() {   

$('input').attr('autocomplete', 'off');

$(document).on('keyup', '.keypressit', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
if(kyvaluelenght>=2)
{ $('.auto-search-box').css('display','block');
 $.ajax({
            url: "{{url('/get_country_codename')}}",
            type: "get",
            data: {country_id: kyvalueres},
      dataType:'json',
            success: function (data) {
             
                $('.auto-search-boxul').html(data);
            }
        }); } 
else {
      $('.auto-search-box').css('display','none'); 

} });




$(document).on('click', '.searchp', function() {

$mainvalue=$(this).attr('id');

var kyvalueres=$mainvalue.split('-');;


$('.keypressit').val(kyvalueres[1]);
$mobile_code='+'+kyvalueres[2];
$('#mobile_code').val($mobile_code);
$('.countrycodes').val(kyvalueres[0]);


 $('.auto-search-box').css('display','none'); 
});




$(document).on('keyup', '.keystate', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
var country_id=$('.countrycodes').val();
if(kyvaluelenght>=2)
{ $('.auto-search-box-state').css('display','block');
 $.ajax({
            url: "{{url('/get_state_codename')}}",
            type: "get",
            data: {country_id: country_id, state_id: kyvalueres},
      dataType:'json',
            success: function (data) {
             
                $('.auto-search-box-state').html(data);
            }
        }); } 
else {
      $('.auto-search-box-state').css('display','none'); 

} });




$(document).on('click', '.searchpstate', function() {

$mainvalue=$(this).attr('id');

var kyvalueres=$mainvalue.split('-');;

$('.satecodeset').val(kyvalueres[0]);



$('.keystate').val(kyvalueres[1]);



 $('.auto-search-box-state').css('display','none'); 
});









$(document).on('keyup', '.keycity', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
var country_id=$('.satecodeset').val();

if(kyvaluelenght>=2)
{ $('.auto-search-box-city').css('display','block');
 $.ajax({
            url: "{{url('/get_city_codename')}}",
            type: "get",
            data: {country_id: country_id, state_id: kyvalueres},
      dataType:'json',
            success: function (data) {
             
                $('.auto-search-box-city').html(data);
            }
        }); } 
else {
      $('.auto-search-box-city').css('display','none'); 

} });


$(document).on('click', '.searchpcity', function() {

$mainvalue=$(this).attr('id');

var kyvalueres=$mainvalue.split('-');;

$('.satecodeset').val(kyvalueres[0]);



$('.keycity').val(kyvalueres[1]);



 $('.auto-search-box-city').css('display','none'); 
});






    $('#country_id').on('change', function () {
        var country = this.value;
        var state = '';
        getStates(country, state);
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $('#state_id').on('change', function () {
        var state = this.value;
        var city = '';
		getCities(state, city);
    });
   

});

function getCountryPhoneCode(country_id){
     $.ajax({
            url: "{{url('/get_country_phone_code')}}",
            type: "get",
            data: {country_id: country_id},
			dataType:'json',
            success: function (data) {
                $('#mobile_code').val(data);
            }
        });
}

function getStates(country_id, state_id=''){
     $.ajax({
            url: "{{url('/get_states')}}",
            type: "get",
            data: {country_id: country_id, state_id: state_id},
			dataType:'json',
            success: function (data) {
                $('#state_id').html(data);
            }
        });
}

function getCities(state_id, city_id=''){
    $.ajax({
        url: "{{url('/get_cities')}}",
        type: "get",
        data: {state_id: state_id, city_id: city_id},
		dataType:'json',
        success: function (data) {
            $('#city_id').html(data);
        }
    });
}

</script>
<script src="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
   <script type="text/javascript">
   $(document).ready(function(){
    
        var value_locationtype = $("input[name='location_type']:checked").val();
        if(value_locationtype=='location')
        {
            $('#city_parsely').attr('data-parsley-required', 'false');
            $('#country_id').attr('data-parsley-required', 'true');
            $('#other_city').attr('data-parsley-required', 'true');
            $('#other_state').attr('data-parsley-required', 'true');
        }
        else
        {  
            $('#city_parsely').attr('data-parsley-required', 'true');
            $('#country_id').attr('data-parsley-required', 'false');
            $('#other_city').attr('data-parsley-required', 'false');
            $('#other_state').attr('data-parsley-required', 'false');
        }

    
   }); 


   
     function markstype()
     {
        var value_markstype = $("input[name='marks_type']:checked").val();
      	
        var value_marks = $('#marks_input').val();
        if(value_markstype=='percentage')
        {
          if(value_marks<30 || value_marks>100 )
          {
            $('#err_marks_input').val('');
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

     function locationtype()
     {
        var value_locationtype = $("input[name='location_type']:checked").val();
     
        if(value_locationtype=='location')
        {
          $('#city').hide();
          $('#outside_india').show(); 

            $('#city_parsely').attr('data-parsley-required', 'false');
            $('#country_id').attr('data-parsley-required', 'true');
            $('#other_city').attr('data-parsley-required', 'true');
            $('#other_state').attr('data-parsley-required', 'true');
        }
        else
        {
            $('#city').show();
            $('#outside_india').hide();

            $('#city_parsely').attr('data-parsley-required', 'true');
            $('#country_id').attr('data-parsley-required', 'false');
            $('#other_city').attr('data-parsley-required', 'false');
            $('#other_state').attr('data-parsley-required', 'false');
        }
     }

    function validate_with_recaptcha() 
    {
        if($('#frm_store_user').parsley().isValid())
        {
            
            var is_valid_captcha = grecaptcha.getResponse();  
              
            if(is_valid_captcha == "")
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
                                {
                                  $('#specialization_div').show();
                                   var option = '<option value="">Select Specialization</option>'; 
                                   jQuery(response.arr_specialization).each(function(index,specialization)
                                   {   
                                    
                                        option+='<option value="'+specialization.id+'">'+specialization.specialization_name+'</option>';
                                   });

                                   jQuery('select[name="specialization_id"]').html(option);
                                }
                                 jQuery('select[name="specialization_id"]').attr('data-parsley-required','true');
                            }
                            else
                            {
                              $('#specialization_div').hide();
                              var option = '<option value="">Please Select</option>'; 
                              jQuery('select[name="specialization_id"]').html(option);
                               jQuery('select[name="specialization_id"]').attr('data-parsley-required','false');
                            }
                            return false;
                        },
                        error:function(response)
                        {
                         
                        }
        });
     }   

   function email_verification()
   {
      var link = "{{ url('/user/email_verification') }}";
         var email = $('#email_verifi').val();
         var _token = $("input[name=_token]").val();

         var arr_data = {
                          email:email,
                          _token :_token,   
                        }
        jQuery.ajax({
                        url:link,
                        type:'post',
                        dataType:'json',
                        data:arr_data,
                        beforeSend:function()
                        {
                          $('#verify_err_email').html('');
                        },
                        success:function(response)
                        {
                           if(response.status=="ERROR")
                            {
                              $('#err_email').html('');
                              $('#verify_err_email').html('EmailId already exists.');
                              $('#email_verifi').val('');
                            }
                            if(response.status=="SUCCESS")
                            {
                              $('#verify_err_email').html('');  
                            }
                        } 
                       });     
  } 
   
 

  </script>
@endsection

