@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->

<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.css">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>
<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js"></script>

<script>
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

function getStates(country_id, state_id='', id){
     $.ajax({
            url: "{{url('/get_states')}}",
            type: "get",
            data: {country_id: country_id, state_id: state_id},
			dataType:'json',
            success: function (data) {
                $('#'+id).html(data);
            }
        });
}

function getCities(state_id, city_id='', id){
    $.ajax({
        url: "{{url('/get_cities')}}",
        type: "get",
        data: {state_id: state_id, city_id: city_id},
		dataType:'json',
        success: function (data) {
            $('#'+id).html(data);
        }
    });
}

</script>

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
         <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-wrapper">
               <h3>Have you attended lots of Interviews? Would you like to share interview questions &amp answers &amp; monetize your experience?</h3>
             <form action="{{url('/member/store_employment')}}" id="frm_employment_member" enctype="multipart/form-data" method="POST" data-parsley-validate>
                     {{ csrf_field() }}
                     @include('front.layout._operation_status')
                     <!--process box-->
                      <?php $current_year = date('Y'); ?>
               
               
               <!--process box-->
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
                           <div class="normal_step employment">2</div>
                        </div>
                        <div class="plan-detail left2">
                           <div class="step_title">Employment</div>
                        </div>
                     </div>
                     <div class="bg_i">&nbsp; </div>
                     <div class="step_process">
                        <div class="step_bor">
                           <div class="normal_step education">3</div>
                        </div>
                        <div class="plan-detail left3">
                           <div class="step_title">Education</div>
                        </div>
                     </div>
                  </div>
               </div>
               
          <!--end-->
          
          
          
          
          
          
          
          <div class="boxone" style="position:absolute; width: 89%;     background: #fff;">
          
          
          
               <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                     <div class="form-group">
                        <label>First Name <span class="star">*</span></label>

                        <input type="text" name="first_name" value="{{old('first_name')}}" class="input-box-signup" data-parsley-pattern="^[a-zA-Z]+$" pattern="[A-Za-z]+"
                        data-parsley-pattern-message="First name should be only characters" placeholder="Enter Your First Name" required="" data-parsley-errors-container="#err_first_name" data-parsley-required-message="This field is required" />
                           <div id="err_first_name" class="error"></div>
                            <div class="error">{{ $errors->first('first_name') }}</div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 last-name">
                     <div class="form-group">
                        <label>Last Name <span class="star">*</span></label>
                        <input type="text" name="last_name"  value="{{old('last_name')}}" class="input-box-signup" placeholder="Enter Your Last Name" required="" 
                        data-parsley-pattern="^[a-zA-Z]+$"
                        data-parsley-pattern-message="Last name should be only characters"
                           data-parsley-errors-container="#err_last_name" data-parsley-required-message="This field is required" />
                           <div id="err_last_name" class="error"></div>
                             <div class="error">{{ $errors->first('last_name') }}</div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Email Address <span class="star">*</span></label>
                  <input type="text" name="email"
                        data-rule-email="true" class="input-box-signup" id="email_verifi" value="{{old('email')}}" placeholder="Enter Your Email Address" onchange="javascript: return email_verification();" required="" data-parsley-type="email" data-parsley-errors-container="#err_email" data-parsley-required-message="This field is required" />
                           <div id="err_email" class="error" style="margin-bottom:6px;"></div>
                           <span id="verify_err_email" class="error" style="margin-top:6px;"></span>
                            <div class="error">{{ $errors->first('email') }}</div>
               </div>

               <div class="form-group">
                  <label>Password <span class="star">*</span></label>
                  <input type="password" id="password" name="password" class="input-box-signup" placeholder="Enter Your Password"  required=""  data-parsley-errors-container="#err_password" 
                  data-parsley-required-message="This field is required" data-parsley-pattern-message="Password must be 6 characters in length"/>
                           <div id="err_password" class="error"></div>
                           <div class="error">{{ $errors->first('password') }}</div>
               </div>
               <div class="form-group">
                  <label>Confirm Password <span class="star">*</span></label>
                  <input type="password" name="con_password"
                         data-rule-equalto='#password' class="input-box-signup" placeholder="Enter Your Confirm Password"  required="" data-parsley-equalto="#password" data-parsley-errors-container="#err_con_password" data-parsley-required-message="This field is required" data-parsley-equalto-message="Password and confirm password must be the same." />
                           <div id="err_con_password" class="error"></div>
                            <div class="error">{{ $errors->first('con_password') }}</div>
               </div>
         
    <div id="form-group">
             <div class="col-sm-4 selectclasss" style="padding:0px"> 
             <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number"  style="width: 95.8%; border: 1px solid #fff; ">
                       

                                <input type="text"  class="input-box-signup keypressit" id="country_id" name="country_ids" data-parsley-required="true"    data-parsley-errors-container="#err_country_id" data-parsley-required-message="This field is required"   autocomplete="off" />

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
               <div class="select-number"  style="width: 95.8%; border: 1px solid #fff; ">
                          
                            <input type="text" name="state_ids" class="input-box-signup keystate" data-parsley-required="true"    data-parsley-errors-container="#err_state_id" data-parsley-required-message="This field is required"  />


                            <div class="auto-search-box-state" ></div>



                            <input type="hidden" class="countrycodes" name="m_country">
                            
                             <input type="hidden" class="country_id" name="country_id">
                            
                            
                            
               </div>
               <div id="err_state_id" style="line-height:22px;" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>
                        </div>
            <div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              City
                           </label>
               <div class="select-number"  style="width: 100.8%; border: 1px solid #fff; ">
                           

     <input type="text"  class="input-box-signup keycity" name="city_ids"    data-parsley-errors-container="#err_city_id"   />

      <div class="auto-search-box-city" ></div>

  <input type="hidden" class="state_id" name="state_id">
  <input type="hidden" class="city_id" name="city_id">
  
  


 <input type="hidden" class="satecodeset" name="m_state">
 

 
 
 <input type="hidden" class="citycodeset" name="m_city">

               </div>
               <div id="err_city_id" class="error"></div>
                        </div>
                        </div>
                        
         </div>
         
         
         
               <div class="form-group" style="clear:both">
                  <label>Mobile Number <span class="star">*</span></label>
                  <div class="row">
                     <div class="col-xs-3 col-sm-3 col-md-2 mumber-box-left mobilecodesss">
                      <input type="text" name="mobile_code" id="mobile_code"
                               class="input-box-signup mobilecodesssm" value="+91" data-parsley-pattern="\+[0-9]{1,3}"
                        data-parsley-pattern-message="Enter Valid Country Code" required="" data-parsley-errors-container="#err_mobile_code" data-parsley-required-message="Field required" readonly />
                               <div id="err_mobile_code" class="error"></div>
                            <div class="error">{{ $errors->first('mobile_code') }}</div>
                     </div>
                     <div class="col-xs-9 col-sm-9 col-md-10 mumber-box-right">
                        <input type="text" name="mobile_no"
                               data-rule-digits="true" class="input-box-signup" value="{{old('mobile_no')}}" placeholder="Enter Your Mobile Number" required="" data-parsley-type="integer" data-parsley-errors-container="#err_mobile_no" data-parsley-required-message="This field is required" data-parsley-minlength="7" data-parsley-maxlength="16"/>
                           <div id="err_mobile_no" class="error"></div>
                            <div class="error">{{ $errors->first('mobile_no') }}</div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Birth Date <span class="star">*</span></label>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="select-number">
                           <select name="date" required="" data-parsley-errors-container="#err_birth_date" data-parsley-required-message="This field is required">
                              <option value="">Date</option>
                      @for($i=1;$i<=31;$i++) 
                      <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT) }}"> {{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                      @endfor
                           </select>
                           <div id="err_birth_date" class="error"></div>
                           <div class="error">{{ $errors->first('date') }}</div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="select-number">
                           <select name="month" required="" data-parsley-errors-container="#err_birth_month" data-parsley-required-message="This field is required">
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
                               <div id="err_birth_month" class="error"></div>
                              <div class="error">{{ $errors->first('month') }}</div>
                        </div>
                     </div>
                    
                     <div class="col-sm-4">
                     <?php $current_year = date('Y');
                           $year = $current_year-23;
                      ?>
                      
                        <div class="select-number">
                           <select name="year" required="" data-parsley-errors-container="#err_birth_year" data-parsley-required-message="This field is required">
                                 <option value="">Year</option>
                                  @for($i=$year;$i>=1950;$i--) 
                                  <option value="{{$i}}"> {{$i}}</option>
                                  @endfor
                              </select>
                                <div id="err_birth_year" class="error"></div>
                                  <div class="error">{{ $errors->first('year') }}</div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--inline Radio button-->
               <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-2">
                           <div class="form-lable">Gender: </div>
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-10">
                           <div class="radio-btns">
                              <div class="radio-btn">
                                 <input id="genderm" required="" name="gender" value="M" type="radio" required="" data-parsley-errors-container="#err_gender" data-parsley-required-message="This field is required">
                                 <label for="genderm">Male</label>
                                 <div class="check left-min"></div>
                              </div>
                              <div class="radio-btn">
                                 <input  id="genderf" value="F" name="gender" type="radio">
                                 <label for="genderf">Female</label>
                                 <div class="check left-min">
                                    <div class="inside"></div>
                                 </div>
                              </div>
                           </div>
                            <div id="err_gender" class="error"></div>
                            <div class="error">{{ $errors->first('gender') }}</div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  
               <!--end-->
               <div class="text-right m-top"><button type="button" class="submit-btn ctn boxnemove">Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button> </div>
               
               
               </div>
               
               
               <div class="boxtwo" style="    position: relative;
    display: none;
    left: 200px;
    width: 89%;     background: #fff;">
                   
               
                 <div class="form-group">
                        <label>Job Skills<span class="star">*</span> </label>
                        <select  id="skill_id" name="skills[]" multiple="multiple" required="" data-parsley-errors-container="#err_job_skill" data-parsley-required-message="This field is required" placeholder="Enter Your Job Skills" >
                        </select>
                          <div class="error">{{ $errors->first('skills') }}</div>
                        <div id="err_job_skill" class="error"></div>
                     </div>
                     <div class="form-group">
                        <label>Total Experience<span class="star">*</span></label>
                        <div class="row">
                           
                           <div class="col-sm-6">
                              <div class="select-number">
                                 <select name="experience_year" required="" data-parsley-errors-container="#err_exp_year" data-parsley-required-message="This field is required">
                                    <option value="">Years</option>
                                     @for($i=0;$i<=40;$i++) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                 </select>
                                  <div id="err_exp_year" class="error"></div>
                                  <div class="error">{{ $errors->first('experience_year') }}</div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="select-number">
                                 <select name="experience_month" required="" data-parsley-errors-container="#err_exp_month" data-parsley-required-message="This field is required">
                                    <option value="">Month</option>
                                     @for($i=0;$i<=11;$i++) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                 </select>
                                 <div id="err_exp_month" class="error"></div>
                                  <div class="error">{{ $errors->first('experience_month') }}</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Company<span class="star">*</span></label>
                        
                        <input type="text" class="input-box-signup allcompany" name="employer_name" placeholder="Enter Name of Your Employer"  value="{{ old('employer_name') }}" required="" data-parsley-errors-container="#err_employer_name" data-parsley-required-message="This field is required"/>
                         <div id="err_employer_name" class="error"></div>
                          <div class="error">{{ $errors->first('employer_name') }}</div>
                     </div>
                     <!--inline Radio button-->
                     <!--<div class="form-group">
                        <div class="row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input id="Radio3" onclick="employertype();" name="employer_type" value="current" type="radio" required="" data-parsley-errors-container="#err_current_employee" data-parsley-required-message="This field is required">
                                    <label for="Radio3">Current Employer</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn">
                                    <input value="previous" onclick="employertype();" id="Radio4" name="employer_type" type="radio">
                                    <label for="Radio4">Previous Employer</label>
                                    <div class="check">
                                       <div class="inside"></div>
                                    </div>
                                 </div>
                              </div>
                              <div id="err_current_employee" class="error"></div>
                              <div class="error">{{ $errors->first('employer_type') }}</div> 
                           </div>
                        
                           <div class="clearfix"></div>
                          
                        </div>
                     </div>-->
                     <!--end-->
                     <div id="current_employer">
						
					  <div class="form-group">
						<label>Designation<span class="star">*</span></label>
						<input type="text" id="previous_designation-1" class="input-box-signup alldesignnation" placeholder="Enter Your Designation" name="current_designation" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation-1" data-parsley-required-message="This field is required">
						<div id="err_previous_designation-1" class="error"></div><div class="error"></div>
					  </div>
					  
					  
					  
					  
					  
					  
				  <div id="form-group">
             <div class="col-sm-4 selectclasss" style="padding:0px"> 
             <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number"  style="width: 95.8%; border: 1px solid #fff; ">
                       

                                <input type="text"  class="input-box-signup keypressit" id="country_id" name="company_country_id" data-parsley-required="true"    data-parsley-errors-container="#err_company_ountry_id-1" data-parsley-required-message="This field is required"   autocomplete="off" />

<div class="auto-search-box" >
  
<div class="auto-search-boxul"></div>

</div>

                                           <div id="err_company_country_id-1" class="error"></div>
                        </div>
                        </div>
                        </div>
            <div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
               <div class="select-number"  style="width: 95.8%; border: 1px solid #fff; ">
                          
                            <input type="text" name="company_state_id" class="input-box-signup keystate" data-parsley-required="true"     data-parsley-errors-container="#err_company_state_id-1" data-parsley-required-message="This field is required"  />


                            <div class="auto-search-box-state" ></div>



                            <input type="hidden" class="countrycodes" name="countrycodes">
               </div>
                           <div id="err_company_state_id-1" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>
                        </div>
            <div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              City
                           </label>
               <div class="select-number"  style="width: 100.8%; border: 1px solid #fff; ">
                           

     <input type="text"  class="input-box-signup keycity" name="company_city_id"    data-parsley-required="true"   data-parsley-errors-container="#err_company_city_id-1" data-parsley-required-message="This field is required">

      <div class="auto-search-box-city" ></div>




 <input type="hidden" class="satecodeset" name="satecodeset">

               </div>
               <div id="err_company_city_id-1" class="error"></div>
                        </div>
                        </div>
                        
         </div>
         
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
                      <div class="form-group" style="clear:both">
                        <label>Working Since<span class="star">*</span></label>
                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="current_start_month" id="current_start_month" data-parsley-required="true" data-parsley-errors-container="#err_duration_month" data-parsley-required-message="This field is required">
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
                                    <div id="err_duration_month" class="error"></div>
                                    <div class="error">{{ $errors->first('start_month') }}</div> 
                                 </div>
                              </div>
                              <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="current_start_year" id="current_start_year" data-parsley-required="true" data-parsley-errors-container="#err_duration_year" data-parsley-required-message="This field is required">
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <div id="err_duration_year" class="error"></div>
                                   <div class="error">{{ $errors->first('start_year') }}</div> 
                                 </div>
                              </div>
                              <div class="duration-to">To</div>
                              <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="current_end_month" id="current_end_month" data-parsley-required="true" data-parsley-errors-container="#err_toduration_month" data-parsley-required-message="This field is required">
                                       <option value="">Month</option>
									   <option value="present">Present</option>
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
                                    <div id="err_toduration_month" class="error"></div>
                                     <div class="error">{{ $errors->first('end_month') }}</div>
                                 </div>
                              </div>
							   <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="current_end_year" id="current_end_year" data-parsley-required="true" data-parsley-errors-container="#err_toduration_year" data-parsley-required-message="This field is required">
                                     <option value="">Year</option>
									 <option value="present">Present</option>									 
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <div id="err_toduration_year" class="error"></div>
                                   <div class="error">{{ $errors->first('end_year') }}</div> 
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                     </div>
					 <div class="form-group">
						<label>Description<span class="star">*</span></label>
						<textarea type="text" id="description" class="input-box-textarea" placeholder="Enter Your Designation Summary" name="current_description" data-parsley-required="true" data-parsley-errors-container="#err_description" data-parsley-required-message="This field is required" rows="3"></textarea>
						<div id="err_description" class="error"></div><div class="error"></div>
					 </div>
                     
                     </div>
                     <!-- end current employer-->

                    <div id="previous_employer">
                    <div class="add-employment"><input type="button" id="add_more" class="submit-btn ctn add-employment" value="+add another employment" />
					</div>
                    </div>

                      <!-- end previous employer-->
                     <?php /*<div id="city" class="form-group">
                        <label>Current Work Location<span class="star">*</span></label>
                        <div class="select-number">
                           <select id="city_parsely" name="city" data-parsley-required="true" data-parsley-errors-container="#err_current_work_location" data-parsley-required-message="This field is required">
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
                            <div id="err_current_work_location" class="error"></div>
                        <!--  <div class="error">{{ $errors->first('city') }}</div>     -->
                        </div>
                     </div>
					 

                     <div id="outside_india" style="display:none;">
                       <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number">
                           <select id="country_id" name="country_id" data-parsley-required="true" data-parsley-errors-container="#err_country" data-parsley-required-message="This field is required">
                              <option value="">--Select Country--</option>
                              @if(isset($arr_country) && count($arr_country)>0)
                              @foreach($arr_country as $country)
                              <option value="{{ $country['id'] }}">{{ $country['country_name'] or '-' }}</option>
                              @endforeach
                              @endif
                           </select>
                           <div id="err_country" class="error"></div>
                          <!--   <div class="error">{{ $errors->first('country_id') }}</div> -->
                        </div>
                        </div>

                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
                           <input id="other_state" type="text" class="input-box-signup"  name="other_state" placeholder="Enter your state name here" value="{{ old('other_state') }}" data-parsley-required="true" data-parsley-errors-container="#err_state" data-parsley-required-message="This field is required"/>
                           <div id="err_state" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>

                        <div class="form-group">
                           <label>
                              City<span class="star">*</span> 
                           </label>
                           <input id="other_city" type="text" class="input-box-signup"  name="other_city" placeholder="Enter your city name here" value="{{ old('city_name') }}" data-parsley-required="true" data-parsley-errors-container="#err_city" data-parsley-required-message="This field is required"/>
                           <div id="err_city" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('city_name') }}</div> -->
                        </div>
                     </div>

                     <div class="check-box">
                        <input onclick="locationtype();" value="location" class="css-checkbox" id="radio7" name="location_type" type="checkbox">
                        <label class="css-label radGroup2" for="radio7">Outside India</label>
                        </div>
					*/ ?>	
                     <!--upload resume section-->
                     <div class="form-group">
                        <label>Upload your Resume</label>
                        <div class="user-box row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <input id="profile_image" style="visibility:hidden; height: 0;" name="resume" type="file">
                              <div class="input-group ">
                                 <div class="btn btn-primary btn-file btn-gry">
                                    <a class="file" onclick="browseImage()">Choose File
                                    </a>
                                 </div>
                                 <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_image">
                                    <a class="file" onclick="removeBrowsedImage()"><i class="fa fa-trash"></i>
                                    </a>
                                 </div>
                                 <input class="form-control file-caption  kv-fileinput-caption" id="profile_image_name" disabled="disabled" type="text" style="height: 38px;">
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        <h5 class="upload">Support Formats: doc, docx, rtf, PDF, Max File 500 KB</h5>
                        
                        <div class="filezise" style="color: #a92428;"><input type="hidden" name="resumefile" required value="1"></div>
                        
                        		<div id="err_filezise" class="error"></div>
                     </div>
                     <input type="hidden" name="type" value="create">
                     <!--end-->
                    
                 
                 <div class="row">
                   
                     <!--end-->
                     <div class="col-sm-6">
               <div class="m-top"><button type="button" class="submit-btn ctn boxneprev" style="background: #fff; color: #fc575c;"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</button> </div> </div>
                <div class="col-sm-6">
               <div class="text-right m-top"><button type="button" class="submit-btn ctn boxtwmove">Continue <i class="fa fa-angle-double-right" aria-hidden="true"></i></button> </div></div>
               
               </div>
               
               </div>
               
               
               
               
               
               <div class="boxthree" style="    position: absolute;
    display: none;
    left: 200px;
    width: 89%;     top: 222px;     background: #fff;">
                   
                   
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
                      
				    <?php /*   <div id="city" class="form-group" style="display:none">
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

                           
                    <div class="check-box">
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
                        <label>I Can Help in: <span class="star"></span></label>
                        
                        
                         <div class="check-box">
                     <input  class="css-checkbox"   id="inqa"  name="inqa" value="1" type="checkbox"   >
                     <label class="css-label radGroup2" for="inqa">Interview Q&A</label> <br>
                 
                            
                     <input  class="css-checkbox"   id="giveresume"  name="giveresume" value="1" type="checkbox"   >
                     <label class="css-label radGroup2" for="giveresume">Give Interview Coding and Resume Preparation </label><br>
                  
                  
                    
                     <input  class="css-checkbox"   id="collectinterview"  name="collectinterview" value="1" type="checkbox"   >
                     <label class="css-label radGroup2" for="collectinterview">Collect QA's Companies </label><br>
                    
                      
                     <input  class="css-checkbox"   id="workexp"  name="workexp" value="1" type="checkbox"   >
                     <label class="css-label radGroup2" for="workexp">Work Experience</label><br>
                  
                     
                  </div>
                  
                  
                        
                        
                        <textarea style="height: 187px; display:none"  class="form-area" name="about_member" cols="30" rows="10" required="" data-parsley-errors-container="#err_skill_set" data-parsley-required-message="This field is required" placeholder="">InterviewXP</textarea>
                        
                        
                        
                     <div id="err_skill_set" class="error"></div>
                     </div>
                     <input type="hidden" value="{{$enc_id or ''}}" name="enc_id">
                     
                     
                      <div class="form-group">
                        <label>NOTE: <span class="star"></span></label>
                        
                         <?php                 $activationfee = DB::table('account_setting')->where('id',1)->first();
                         
                         
                         ?>
                         <div class="check-box">
                     <input  class="css-checkbox"   id="accactive"  name="accactive" value="yes" type="checkbox"   required="" data-parsley-errors-container="#err_term_conacc" data-parsley-required-message="This field is required" >
                     <label class="css-label radGroup2" for="accactive">One time A/C Activation/Subscription Fee of Rs {{$activationfee->activationfee}}/- will be charged after  you make earings of 25,000/-on our site.
                        <div id="err_term_conacc" class="error"></div>
                     </label>
                     
                        
                      <div class="clearfix">&nbsp;</div>
                      
                      </div></div>
                      
                      

                     <div class="check-box">
                     <input  class="css-checkbox"  id="condition" name="condition" value="condition" type="checkbox" required="" data-parsley-errors-container="#err_term_con" data-parsley-required-message="This field is required">
                     <label class="css-label radGroup2" for="condition">By Clicking create on account, You agree to <a href="{{url('/terms_of_use')}}" target="_new">our terms and conditions</a> governing the use of <a href="{{url('/')}}">interviewxp.com</a>
                      <div id="err_term_con" class="error"></div>
                     </label>
                      <div class="clearfix">&nbsp;</div>
                     
                  </div>
                  <!-- <div class="g-recaptcha captch-educatn" data-sitekey="6Lc-HA4UAAAAAPY67Ox_frqmqLpqfPxGmPHg0Aot"></div>

                     <div id="captcha_error" class="error">  </div> -->
                     
                   
                   
                    <div class="row">
                   
                     <!--end-->
                     <div class="col-sm-6">
               <div class="m-top"><button type="button" class="submit-btn ctn boxtwprev" style="background: #fff; color: #fc575c;"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous</button> </div> </div>
                <div class="col-sm-6">
             <div class="text-right m-top"><button type="submit"  class="submit-btn ctn errorshowen">Create an Account</button> </div></div>
               
               
               
    <div class="alert alert-success errorshow" style="
    color: #fc575c;
    background-color: #fc575c0f;
    border-color: #fff5f5;
    float: left;
    padding: 5px;
    margin-bottom: 0px;
    margin-top: 5px; display:none;
    ">
        <button type="button" class="close" style="margin-top: 0px !important;padding: 0px !important;" data-dismiss="alert" aria-hidden="true">×</button>If form not submiting then check previous tab.</div>
    
    
    
               </div>
                   
               </div>
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
          
               
               
               
               </form>
               
               
               
            </div>
            
           
    
         </div>
         <div class="col-sm-12 col-md-4 col-lg-6">
             
                  
          
               
               
               
               
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
                  
                  <!--end-->
            
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
$(this).closest(".select-number").find('.keypressit').val(kyvalueres[1]);

  
  $satecodesetdd=$('.satecodeset').val();
  if($satecodesetdd==''){
$mobile_code='+'+kyvalueres[2];

 
 $('#mobile_code').val($mobile_code);
  }

$('.countrycodes').val(kyvalueres[0]);



$country_id_value=$('.country_id').val();
if($country_id_value==''){
$('.country_id').val(kyvalueres[0]);
}


 $('.auto-search-box').css('display','none'); 
});




$(document).on('keyup', '.keystate', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
var country_id=$(this).closest(".select-number").find('.countrycodes').val();
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


$state_id_value=$('.state_id').val();
if($state_id_value==''){
$('.state_id').val(kyvalueres[0]);
}




$(this).closest(".select-number").find('.keystate').val(kyvalueres[1]);



 $('.auto-search-box-state').css('display','none'); 
});









$(document).on('keyup', '.keycity', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
var country_id=$(this).closest(".select-number").find('.satecodeset').val();

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

$(this).closest(".select-number").find('.citycodeset').val(kyvalueres[0]);


$city_id_value=$('.city_id').val();
if($city_id_value==''){
$('.city_id').val(kyvalueres[0]);
}




$(this).closest(".select-number").find('.keycity').val(kyvalueres[1]);



 $('.auto-search-box-city').css('display','none'); 
});









   

});


</script>
<script type="text/javascript">
   function email_verification()
   {
      var link = "{{ url('/member/email_verification') }}";
        
         
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
                              $('#verify_err_email').html('EmailId already exists.');
                              $("#verify_err_email").show().fadeOut(2000);
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

<script> 
$(document).ready(function(){ 
    
 $(document).on('keypress', '.input-box-signup', function() {  $('.error').text('');  });
        
    $(".boxnemove").click(function(){ 
        
        $error_v=0;
$first_name=$("input[name=first_name]").val();   if($first_name==''){   $('#err_first_name').text('Enter Your First Name with only characters');  $error_v=1; } 

$last_name=$("input[name=last_name]").val();   if($last_name==''){   $('#err_last_name').text('Enter Your Last Name ');  $error_v=1; } 

$email=$("input[name=email]").val();   if($email==''){   $('#verify_err_email').text('Enter Your Email ');  $error_v=1; }

if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($email)){ } else { $('#verify_err_email').text('Enter Valid Email ');  $error_v=1; }
      


$password=$("input[name=password]").val().length;   if($password<=5){   $('#err_password').text('Enter Password with min 6 char. ');  $error_v=1; } 

$con_password=$("input[name=con_password]").val().length;   if($con_password<=5){   $('#err_con_password').text('Enter Con Password with min 6 char. ');  $error_v=1; } 

$cp=$("input[name=password]").val(); $ccp=$("input[name=con_password]").val();

if($cp!=$ccp) { $('#err_con_password').text('Both Password Should Be match');  }
        
$country_id=$("input[name=country_id]").val();   if($country_id==''){   $('#err_country_id').text('Choose from Country  List');  $error_v=1; } 

$state_id=$("input[name=state_id]").val();   if($state_id==''){   $('#err_state_id').text('Choose from State List ');  $error_v=1; } 

$mobile_no=$("input[name=mobile_no]").val();   if($mobile_no==''){   $('#err_mobile_no').text('Enter Mobile No. ');  $error_v=1; } 


$date=$("select[name=date]").val();   if($date==''){   $('#err_birth_date').text('Enter Your DOB');  $error_v=1; } 

$month=$("select[name=month]").val();   if($month==''){   $('#err_birth_month').text('Enter Your DOB');  $error_v=1; } 
$year=$("select[name=year]").val();   if($year==''){   $('#err_birth_year').text('Enter Your DOB');  $error_v=1; } 
        
        
        
        
        
         if($error_v==0) {
      
        
        
        $(".boxone").animate({left: '-1400px'});
        
        
         $(".boxtwo").css('display','block');
        
         $(".boxtwo").animate({left: '20px'});
         
      
       $(".employment").addClass("active_step");
       
         }
        
    });
    
     $(".boxneprev").click(function(){ 
        $(".boxone").animate({left: '20px'});
        
         $(".boxtwo").animate({left: '200px'});
         
         $(".boxtwo").css('display','none');
        
         $(".employment").removeClass("active_step");
        
    });
    
    
      $(".boxtwmove").click(function(){ 
          
          
                  $error_vs=0;
 

$skills=$("select[name=skills]").val();   if($skills==''){   $('#err_job_skill').text('This field is required');  $error_vs=1; } 

$experience_year=$("select[name=experience_year]").val();   if($experience_year==''){   $('#err_exp_year').text('This field is required');  $error_vs=1; } 

$employer_name=$("input[name=employer_name]").val();   if($employer_name==''){   $('#err_employer_name').text('This field is required');  $error_vs=1; }



$current_designation=$("input[name=current_designation]").val();   if($current_designation==''){   $('#err_previous_designation-1').text('This field is required');  $error_vs=1; }



$company_country_id=$("select[name=company_country_id]").val();   if($company_country_id==''){   $('#err_company_country_id-1').text('This field is required');  $error_vs=1; }

$company_state_id=$("select[name=company_state_id]").val();   if($company_state_id==''){   $('#err_company_state_id-1').text('This field is required');  $error_vs=1; }

$company_city_id=$("select[name=company_city_id]").val();   if($company_city_id==''){   $('#err_company_city_id-1').text('This field is required');  $error_vs=1; }

$current_start_month=$("select[name=current_start_month]").val();   if($current_start_month==''){   $('#err_duration_month').text('This field is required');  $error_vs=1; }


$current_end_month=$("select[name=current_end_month]").val();   if($current_end_month==''){   $('#err_toduration_month').text('This field is required');  $error_vs=1; }


$current_start_year=$("select[name=current_start_year]").val();   if($current_start_year==''){   $('#err_duration_year').text('This field is required');  $error_vs=1; }



$current_end_year=$("select[name=current_end_year]").val();   if($current_end_year==''){   $('#err_toduration_year').text('This field is required');  $error_vs=1; }




$current_description=$("textarea[name=current_description]").val();   if($current_description==''){   $('#err_description').text('This field is required');  $error_vs=1; }




$resumefile=$("input[name=resumefile]").val();   if($resumefile==''){   $('#err_filezise').text('File Size Should be Less then 500 KB');  $error_vs=1; }
 

 
          
        
          
          if($error_vs==0) {
          
         
          
          
        $(".boxtwo").animate({left: '-1400px'});
        
        
         $(".boxthree").css('display','block');
        
         $(".boxthree").animate({left: '20px'});
          $(".education").addClass("active_step");
         
        
          }
          
          
    });
    
    
   $(".boxtwprev").click(function(){ 
        $(".boxtwo").animate({left: '20px'});
        
         $(".boxthree").animate({left: '200px'});
         
         $(".boxthree").css('display','none');
        
        $(".education").removeClass("active_step");
        
          $(".errorshow").fadeOut();
        
    });
    
    
     $(".errorshowen").click(function(){ 
       
         
         $(".errorshow").fadeIn();
        
       
        
    });
    
    
    
    
});
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
</script>
<script type="text/javascript">
     function employertype()
     {
        var value_employertype = $("input[name='employer_type']:checked").val();
     
        if(value_employertype=='current')
        {
          $('#previous_employer').hide();
          $('#current_employer').show();
          $('#current_start_month').attr('data-parsley-required','true');
          $('#current_end_month').attr('data-parsley-required','true');
          $('#current_end_year').attr('data-parsley-required','true');
          $('#current_start_year').attr('data-parsley-required','true');
          /*$('#current_job_profile').attr('data-parsley-required','true');*/
          $('#current_designation').attr('data-parsley-required','true');

          $('#previous_start_month').attr('data-parsley-required','false');
          $('#previous_end_month').attr('data-parsley-required','false');
          $('#previous_end_year').attr('data-parsley-required','false');
          $('#previous_start_year').attr('data-parsley-required','false');
          $('#previous_company_name').attr('data-parsley-required','false');
          $('#previous_designation').attr('data-parsley-required','false'); 

          $('#previous_start_month').val('');
          $('#previous_end_month').val('');
          $('#previous_end_year').val('');
          $('#previous_start_year').val('');
          $('#previous_company_name').val('');
          $('#previous_designation').val('');
        }
        if(value_employertype=='previous')
        {
          $('#current_employer').hide();
          $('#previous_employer').show();
          $('#current_start_month').attr('data-parsley-required','false');
          $('#current_end_month').attr('data-parsley-required','false');
          $('#current_end_year').attr('data-parsley-required','false');
          /*$('#current_job_profile').attr('data-parsley-required','false');*/
          $('#current_designation').attr('data-parsley-required','false');
          $('#current_start_year').attr('data-parsley-required','false');

          $('#previous_start_month').attr('data-parsley-required','true');
          $('#previous_end_month').attr('data-parsley-required','true');
          $('#previous_end_year').attr('data-parsley-required','true');
          $('#previous_start_year').attr('data-parsley-required','true');
          $('#previous_company_name').attr('data-parsley-required','true');
          $('#previous_designation').attr('data-parsley-required','true');

          $('#current_start_month').val('');
          $('#current_end_month').val('');
          $('#current_end_year').val('');
          $('#current_start_year').val('');
          $('#current_job_profile').val('');
          $('#current_designation').val('');
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
     
</script>
<?php	
	$countries = json_encode($arr_country);
?>	
<script type="text/javascript">
  var count = 1;  
  var current_year = new Date().getFullYear();
    $("#add_more").click(function()
    {
      
        var content='<div class="previous_employer_details">';
		var countries = <?php echo $countries; ?>;
		
		content+='<i class="fa fa-times-circle-o fa-2x pull-right emp_close" aria-hidden="true" style="float: right !important; cursor:pointer"></i>';
        content+='<div class="form-group" style="clear:both">';
        content+='<label>Designation<span class="star">*</span></label>'
        content+='<input type="text" id="previous_designation'+count+'" class="input-box-signup alldesignnation" placeholder="Enter Your Designation" name="previous_designation[]" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation'+count+'" data-parsley-required-message="This field is required"/>';
        content+='<div id="err_previous_designation'+count+'" class="error"></div>';
        content+='<div class="error"></div>'; 
        content+='</div>';

        content+='<div class="form-group">';
        content+='<label>Company Name<span class="star">*</span></label>';
        content+='<input data-parsley-required="true" id="previous_company_name'+count+'" data-parsley-errors-container="#err_company_name'+count+'" data-parsley-required-message="This field is required" type="text" class="input-box-signup"  name="company_name[]" placeholder="Enter Name Of Your Employer"  />';
        content+='<div id="err_company_name'+count+'" class="error"></div>';
        content+='<div class="error"></div>'; 
        content+='</div>';	
		
		content+='<div id="row">';
		content+='<div class="col-sm-4" style="padding:0px">';
		content+='<div class="form-group">';
		content+='<label>Country<span class="star">*</span></label>';
		content+='<div class="select-number" style="width: 95.8%;">';
		content+='<select id="country'+count+'" data-key="'+count+'" name="country[]" data-parsley-required="true" data-parsley-errors-container="#err_company_ountry_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error company_country_id">';
		content+='<option value="">--Select Country--</option>';		
		$.each(countries, function(i, item) {
			content+='<option value="'+item.id+'">'+item.country_name+'</option>';
		});
		content+='</select>';
		content+='<div id="err_company_country_id'+count+'" class="error"></div>';
		content+='</div>';
		content+='</div>';
		content+='</div>';
		content+='<div class="col-sm-4" style="padding:0px">';
		content+='<div class="form-group">';
		content+='<label>';
		content+='State<span class="star">*</span> ';
		content+='</label>';
		content+='<div class="select-number" style="width: 95.8%;">';
		content+='<select id="state'+count+'" data-key="'+count+'" name="state[]" data-parsley-required="true" data-parsley-errors-container="#err_company_state_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error company_state_id">';
		content+='<option value="">--Select State--</option>                             ';
		content+='</select>';
		content+='</div>';
		content+='<div id="err_company_state_id'+count+'" class="error"></div>';
		content+='<!--  <div class="error"></div> -->';
		content+='</div>';
		content+='</div>';
		content+='<div class="col-sm-4" style="padding:0px">';
		content+='<div class="form-group">';
		content+='<label>';
		content+='City<span class="star">*</span>';
		content+='</label>';
		content+='<div class="select-number" style="width: 95.8%;">';
		content+='<select id="city'+count+'" name="city[]" data-parsley-required="true" data-parsley-errors-container="#err_company_city_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error">';
		content+='<option value="">--Select City--</option>';
		content+='</select>';
		content+='</div>';
		content+='<div id="err_company_city_id'+count+'" class="error"></div>';
		content+='</div>';
		content+='</div>';
		content+='</div>';


        content+='<div class="form-group" style="clear:both">';
                        content+='<label>Duration<span class="star">*</span></label>';
                        content+='<div class="duration">';
                           content+='<div class="row">';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="previous_start_month[]" id="previous_start_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_month'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Month</option>';
                                       content+='<option value="01">Jan</option>';
                                       content+='<option value="02">Feb</option>';
                                       content+='<option value="03">Mar</option>';
                                       content+='<option value="04">Apr</option>';
                                       content+='<option value="05">May</option>';
                                       content+='<option value="06">Jun</option>';
                                       content+='<option value="07">Jul</option>';
                                       content+='<option value="08">Aug</option>';
                                       content+='<option value="09">Sep</option>';
                                       content+='<option value="10">Oct</option>';
                                       content+='<option value="11">Nov</option>';
                                       content+='<option value="12">Dec</option>';
                                    content+='</select>';
                                    content+='<div id="err_previous_duration_month'+count+'" class="error"></div>';
                                    content+='<div class="error"></div>'; 
                                 content+='</div>';
                              content+='</div>';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="previous_start_year[]" id="previous_start_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_year'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Year</option>';

                                     for(var i=current_year;i>=1976;i--)
                                          {
                                            content+='<option value='+i+'>'+i+'</option>';       
                                          }
                                    content+='</select>';
                                   content+='<div id="err_previous_duration_year'+count+'" class="error"></div>';
                                   content+='<div class="error"></div>'; 
                                 content+='</div>';
                              content+='</div>';
                              content+='<div class="duration-to">To</div>';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="previous_end_month[]" id="previous_end_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_month'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Month</option>';
									   content+='<option value="present">Present</option>';
                                       content+='<option value="01">Jan</option>';
                                       content+='<option value="02">Feb</option>';
                                       content+='<option value="03">Mar</option>';
                                       content+='<option value="04">Apr</option>';
                                       content+='<option value="05">May</option>';
                                       content+='<option value="06">Jun</option>';
                                       content+='<option value="07">Jul</option>';
                                       content+='<option value="08">Aug</option>';
                                       content+='<option value="09">Sep</option>';
                                       content+='<option value="10">Oct</option>';
                                       content+='<option value="11">Nov</option>';
                                       content+='<option value="12">Dec</option>';
                                    content+='</select>';
                                    content+='<div id="err_previous_toduration_month'+count+'" class="error"></div>';
                                     content+='<div class="error"></div>';
                                 content+='</div>';
                              content+='</div>';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="previous_end_year[]" id="previous_end_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_year'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Year</option>';
									   content+='<option value="present">Present</option>';

                                        for(var i=current_year;i>=1976;i--)
                                          {
                                            content+='<option value='+i+'>'+i+'</option>';       
                                          }

                                    content+='</select>';
                                    content+='<div id="err_previous_toduration_year'+count+'" class="error"></div>';
                                    content+='<div class="error"></div>'; 
                                 content+='</div>';
                              content+='</div>';
                           content+='</div>';
                        content+='</div>';
                        content+='</div>';
					content+='<div class="form-group">';
					content+='<label>Description<span class="star">*</span></label>';
					content+='<textarea type="text" id="description'+count+'" class="input-box-textarea" placeholder="Enter Your Designation Summary" name="description[]" data-parsley-required="true" data-parsley-errors-container="#err_description'+count+'" data-parsley-required-message="This field is required" rows="3"></textarea>';
					content+='<div id="err_description'+count+'" class="error"></div><div class="error"></div>';
					content+='</div>';	
                    content+='</div>';
                    
                    $('#previous_employer').before(content);
					
		count++;
      
        
    });
	
$(document).ready(function() { 
	$(document).on('click','.emp_close', function() {
		$(this).parent().remove();
	});
	
	$(document).on('change','.company_country_id', function () {  
        var country = $(this).val();
        var state = '';
		var key = $(this).attr('data-key');		
        getStates(country, state, 'state'+key);
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $(document).on('change', '.company_state_id', function () {
        var state = $(this).val();
        var city = '';
		var key = $(this).attr('data-key');
		getCities(state, city, 'city'+key);
    });
});	
   
   
  </script>
  
  
  
  
  
<script type="text/javascript">
     
	window.Parsley.on('field:error', function() {
  // This global callback will be called for any field that fails validation.
	  //console.log('Validation failed for: ', this.$element);
	});
     function validate_with_recaptcha() 
    {
		//console.log($('#frm_education_member').parsley().getErrorsMessages());

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
  
  
   
<script type="text/javascript">
var urlsd = "{{ url('/get_skills') }}";

  $(document).ready(function()
  {
    $('#skill_id').tokenize(
      { 
        newElements:true,
        datas: urlsd,
            textField:'skill_name',
            valueField:'skill_name'
        });

   });

</script>



    <script type="text/javascript">
        $('#profile_image').bind('change', function() {
        
        $filezise=Math.round(this.files[0].size/1024);
        
if($filezise>=500)
{
            $('.filezise').html('<p>File Size -'+$filezise+' KB</p> <p>File Size Should be Less then 500 KB</p><input type="hidden" required name="resumefile"  >');

}
else {

$('.filezise').html('<input type="hidden" name="resumefile" required value="1">');}
        });
    </script>
    
    
    
@endsection

