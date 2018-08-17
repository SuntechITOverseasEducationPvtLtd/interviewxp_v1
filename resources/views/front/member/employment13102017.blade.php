@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>
<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js"></script>


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

                      <h4 class="note-new"> Note : You need to complete this two steps to become a member.</h4>
                     <form action="{{url('/member/store_employment')}}" id="frm_employment_member" enctype="multipart/form-data" method="POST" data-parsley-validate>
                     {{ csrf_field() }}
                     @include('front.layout._operation_status')
                     <!--process box-->
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
                                 <div class="normal_step">3</div>
                              </div>
                              <div class="plan-detail left3">
                                 <div class="step_title">Education</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--end-->
                     <div class="form-group">
                        <label>Job Skills<span class="star">*</span> </label>
                        <select  id="skill_id" name="skills[]" multiple="multiple" required="" data-parsley-errors-container="#err_job_skill" data-parsley-required-message="This field is required">
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
                        <label>Current Employer<span class="star">*</span></label>
                        
                        <input type="text" class="input-box-signup" name="employer_name" placeholder="Enter Employer name"  value="{{ old('employer_name') }}" required="" data-parsley-errors-container="#err_employer_name" data-parsley-required-message="This field is required"/>
                         <div id="err_employer_name" class="error"></div>
                          <div class="error">{{ $errors->first('employer_name') }}</div>
                     </div>
                     <!--inline Radio button-->
                     <div class="form-group">
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
                     </div>
                     <!--end-->
                     <div id="current_employer" style="display:none;">
                      <div class="form-group">
                        <label>Duration<span class="star">*</span></label>
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
                                       <option value="Present">Present</option>
                                       
                                    </select>
                                    <div id="err_toduration_month" class="error"></div>
                                     <div class="error">{{ $errors->first('end_month') }}</div>
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label>Designation<span class="star">*</span></label>
                        <input type="text" class="input-box-signup" id="current_designation" placeholder="Enter Your Designation" name="current_designation" value="{{ old('designation') }}"  data-parsley-required="true" data-parsley-errors-container="#err_designation" data-parsley-required-message="This field is required"/>
                        <div id="err_designation" class="error"></div>
                        <div class="error">{{ $errors->first('designation') }}</div> 
                     </div>

                                           

                     </div>
                     <!-- end current employer-->

                    <div id="previous_employer" style="display:none;">
                    <div class="add-employment"><input type="button" id="add_more" class="submit-btn ctn add-employment" value="+add another employment" />
</div>
                      <div id="previous_clone">
                        <div id="previous_designation_clone" class="form-group">
                        <label>Designation<span class="star">*</span></label>
                        <input type="text" id="previous_designation" class="input-box-signup" placeholder="Enter Your Designation" name="previous_designation[]" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation" data-parsley-required-message="This field is required"/>
                        <div id="err_previous_designation" class="error"></div>
                        <div class="error">{{ $errors->first('designation') }}</div> 
                        </div>

                        <div id="previous_company_clone" class="form-group">
                        <label>Company Name<span class="star">*</span></label>
                        <input data-parsley-required="true" id="previous_company_name" data-parsley-errors-container="#err_company_name" data-parsley-required-message="This field is required" type="text" class="input-box-signup"  name="company_name[]" placeholder="Enter Company Name"  />
                        <div id="err_company_name" class="error"></div>
                        <div class="error">{{ $errors->first('company_name') }}</div> 
                        </div>

                        <div class="form-group">
                        <label>Duration<span class="star">*</span></label>
                        <div class="duration">
                           <div class="row">
                              <div id="previous_start_month_clone" class="col-sm-3">
                                 <div class="select-number">
                                    <select name="previous_start_month[]" id="previous_start_month" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_month" data-parsley-required-message="This field is required">
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
                                    <div id="err_previous_duration_month" class="error"></div>
                                    <div class="error">{{ $errors->first('start_month') }}</div> 
                                 </div>
                              </div>
                              <div id="previous_start_year_clone" class="col-sm-3">
                                 <div class="select-number">
                                    <select name="previous_start_year[]" id="previous_start_year" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_year" data-parsley-required-message="This field is required">
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <div id="err_previous_duration_year" class="error"></div>
                                   <div class="error">{{ $errors->first('start_year') }}</div> 
                                 </div>
                              </div>
                              <div class="duration-to">To</div>
                              <div id="previous_end_month_clone" class="col-sm-3">
                                 <div class="select-number">
                                    <select name="previous_end_month[]" id="previous_end_month" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_month" data-parsley-required-message="This field is required">
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
                                    <div id="err_previous_toduration_month" class="error"></div>
                                     <div class="error">{{ $errors->first('end_month') }}</div>
                                 </div>
                              </div>
                              <div id="previous_end_year_clone" class="col-sm-3">
                                 <div class="select-number">
                                    <select name="previous_end_year[]" id="previous_end_year" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_year" data-parsley-required-message="This field is required">
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                    <div id="err_previous_toduration_year" class="error"></div>
                                    <div class="error">{{ $errors->first('end_year') }}</div> 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     </div>

                    </div>

                      <!-- end previous employer-->
                     <div id="city" class="form-group">
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
                     </div>
                     <input type="hidden" name="type" value="{{$type or ''}}">
                     <!--end-->
                     <input type="hidden" value="{{$enc_id or ''}}" name="enc_id">
                     <div class="text-right m-top"><button type="submit" class="submit-btn ctn">Continue</button> </div>
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
var url = "{{ url('/get_skills') }}";
  $(document).ready(function()
  {
    $('#skill_id').tokenize(
      { 
        newElements:true,
        datas: url,
            textField:'skill_name',
            valueField:'skill_name'
        });

   });

</script>
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
<script type="text/javascript">
  var count = 1;  
  var current_year = new Date().getFullYear();
    $("#add_more").click(function()
    {
      if(count < 3)
      {
        var content='';

        content+='<div class="form-group">';
        content+='<label>Designation<span class="star">*</span></label>'
        content+='<input type="text" id="previous_designation'+count+'" class="input-box-signup" placeholder="Enter Your Designation" name="previous_designation[]" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation'+count+'" data-parsley-required-message="This field is required"/>';
        content+='<div id="err_previous_designation'+count+'" class="error"></div>';
        content+='<div class="error"></div>'; 
        content+='</div>';

        content+='<div class="form-group">';
        content+='<label>Company Name<span class="star">*</span></label>';
        content+='<input data-parsley-required="true" id="previous_company_name'+count+'" data-parsley-errors-container="#err_company_name'+count+'" data-parsley-required-message="This field is required" type="text" class="input-box-signup"  name="company_name[]" placeholder="Enter Company Name"  />';
        content+='<div id="err_company_name'+count+'" class="error"></div>';
        content+='<div class="error"></div>'; 
        content+='</div>';


        content+='<div class="form-group">';
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
                    
                    $('#previous_employer').append(content);
        count++;
      }
      if(count > 2)
      {
        $("#add_more").hide();
      }  
    });
  </script>
@endsection      