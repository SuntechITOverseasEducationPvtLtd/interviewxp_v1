<style>
    .scareer-form_01{padding-bottom: 15px !important;}
.scareer-form_02{padding-bottom: 15px !important;
    float: left!important;
    width: 100% !important;}
.scareer-form_03{display:none !important}
.scareer-form_04{float: left !important;
    background: white !important;
    padding: 10px !important;
    font-size: 15px !important;
    border: 1px solid #ccc !important;}
.scareer-form_05{width: 93% !important; float : right !important;}
.scareer-form_06{visibility:hidden !important; height: 0 !important}
.scareer-form_07{border-right: 1px solid rgb(251, 251, 251) ! important; display: none !important;}
.scareer-form_08{color: #a92428 !important;}
.scareer-form_09{display:none !important;     border: 1px solid rgb(220, 214, 214) !important;
    padding: 3px !important;
    margin-bottom: 10px !important;}
.scareer-form_010{padding: 4px !important;
    background: #17afa3 !important;
    border: 1px solid #ffffff!important;}
</style>

@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<div class="banner-member"> 
   <div class="pattern-member about-banner">
   </div>
</div>
<!-- middle section --> <?php $current_year = date('Y'); ?>
<div class="career-form-banner">
   <div class="container">
      <div class="row">
         <div class="col-sm-3 col-md-5 col-lg-5">&nbsp;</div>
         <div class="col-sm-9 col-md-7 col-lg-7">
            
            <div class="career-form-wrapper">
            @include('front.layout._operation_status')
               <div class="career-heading">Position applying for  <span>{{ $arr_data['jobtitle'] }}</span></div>
               
              <form action="{{url('/store_careers')}}" id="frm_career_form" method="POST" data-parsley-validate enctype="multipart/form-data"> 
               {{ csrf_field() }}

               <input type="hidden" name="carrer_slug" value="<?php echo strtolower(str_replace(" ","_",$arr_data['jobtitle']));?>">
                <input type="hidden" name="postid" value="{{ $arr_data['id'] }}" required>
               <div class="career-form">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="first_name" class="input-box-signup" placeholder="Full Name" required=""
                           data-parsley-errors-container="#err_first_name" data-parsley-required-message="This field is required" />
                             <div id="err_first_name" class="error"></div>
                             <div class="error">{{ $errors->first('first_name') }}</div>
                        </div>
                     </div>

  
                        <div class="col-sm-12"><div class="form-group">
                           <input type="text" name="email" class="input-box-signup" placeholder="Email" required=""
                           data-parsley-errors-container="#error_email" data-parsley-type="email" data-parsley-required-message="This field is required"/>
                           <div id="error_email" class="error"></div>
                           <div class="error">{{ $errors->first('email') }}</div>
                        </div>
                     </div>





  
                    <div class="col-sm-12"> <label>Mobile Number <span class="star">*</span></label></div>
                      <div class="row"> <div class="col-sm-12 scareer-form_01" > <div class="form-group">
                        <div class="col-xs-3 col-sm-3 col-md-2 mumber-box-left">
                           <div class="select-number select-phone">
                              <!-- <select name="mobile_code">
                                 <option value="+91">+91</option>
                                 <option value="+92">+92</option>
                                 <option value="+93">+93</option>
                                 <option value="+94">+94</option>
                                 <option value="+95">+95</option>
                              </select> -->
                              <input type="text" name="mobile_code"
                               class="input-box-signup" value="+91" data-parsley-pattern="\+[0-9]{1,3}"
                        data-parsley-pattern-message="Enter Valid Country Code" required="" data-parsley-errors-container="#err_mobile_code" data-parsley-required-message="Field required" />
                               <div id="err_mobile_code" class="error"></div>
                          <div class="error">{{ $errors->first('mobile_code') }}</div>

                           </div>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-10 mumber-box-right">
                           <input class="input-box-signup" name="mobile_no" placeholder="Enter Your Mobile Number" type="text" required=""
                           data-parsley-errors-container="#error_mobile_no" data-parsley-required-message="This field is required" data-parsley-type="integer" data-parsley-minlength="7" data-parsley-maxlength="16">
                           <div id="error_mobile_no" class="error"></div>
                           <div class="error">{{ $errors->first('mobile_no') }}</div>
                        </div>
                     </div>
                  
  </div>
  </div>


<div class="form-group">
                     <div class="col-sm-12">  <label>DOB <span class="star">*</span></label></div>
                     <div class="duration scareer-form_02">
                      
                           <div class="col-sm-3">
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
                           <div class="col-sm-3">
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
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="year" required="" data-parsley-errors-container="#err_year" data-parsley-required-message="This field is required">
                                 <option value="">Year</option>
                                  @for($i=$current_year;$i>=1976;$i--) 
                                  <option value="{{$i}}"> {{$i}}</option>
                                  @endfor
                                 </select>
                                 <div id="err_year" class="error"></div>
                                 <div class="error">{{ $errors->first('year') }}</div>
                              </div>
                           </div>
                          
                          
                           
                       
                     </div>
                  </div>


   <div class="row"><div class="col-sm-12" >
                     <div class="col-sm-12 col-md-3 col-lg-2">
                        <div class="form-lable">Gender: </div>
                     </div>
                     <div class="col-sm-12 col-md-9 col-lg-10">
                        <div class="radio-btns">
                           <div class="radio-btn">
                              <input id="Radio3" value="M" name="gender" type="radio" required=""
                           data-parsley-errors-container="#error_gender" data-parsley-required-message="This field is required">
                              <label for="Radio3">Male</label>
                              <div class="check"></div>
                           </div>
                           <div class="radio-btn">
                              <input id="Radio4" value="F" name="gender" type="radio">
                              <label for="Radio4">Female</label>
                              <div class="check">
                                 <div class="inside"></div>
                              </div>
                           </div>
                        </div>
                         <div id="error_gender" class="error"></div>
                         <div class="error">{{ $errors->first('gender') }}</div>
                     </div>
                     <div class="clearfix">&nbsp;</div>
                  </div>

                     </div>
                     
                     
                     
                     
                     
                     
                     

                     <div class="col-sm-6 scareer-form_03">
                        <div class="form-group">
                           <input type="text" name="last_name" class="input-box-signup" placeholder="Full Name" 
                           data-parsley-errors-container="#err_last_name" data-parsley-required-message="This field is required" value="InterviewXP"/>
                           <div id="err_last_name" class="error"></div>
                           <div class="error">{{ $errors->first('last_name') }}</div>
                        </div>
                          
                     </div>
                  </div>
                  <div class="form-group scareer-form_03">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="job_title" class="input-box-signup" placeholder="Enter Your Job Title" readonly  
                           data-parsley-errors-container="#err_job_title" data-parsley-required-message="This field is required" value="{{ $arr_data['jobtitle'] }}"/>
                           <div id="err_job_title" class="error"></div>
                           <div class="error">{{ $errors->first('job_title') }}</div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Total Experience</label>
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="select-number">
                              <select name="total_exp_year"  required=""
                           data-parsley-errors-container="#error_total_exp_year" data-parsley-required-message="This field is required">
                                 <option value="">Years</option>
                                     @for($i=0;$i<=30;$i++) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                              </select>
                           <div id="error_total_exp_year" class="error"></div>
                           <div class="error">{{ $errors->first('total_exp_year') }}</div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="select-number">
                              <select name="total_exp_month" required=""
                           data-parsley-errors-container="#error_total_exp_month" data-parsley-required-message="This field is required">
                                  <option value="">Month</option>
                                 @for($i=0;$i<=11;$i++) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                 @endfor
                              </select>
                               <div id="error_total_exp_month" class="error"></div>
                               <div class="error">{{ $errors->first('total_exp_month') }}</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="company_name" class="input-box-signup" placeholder="Company Name" required=""
                           data-parsley-errors-container="#error_company_name" data-parsley-required-message="This field is required"/>
                            <div id="error_company_name" class="error"></div>
                            <div class="error">{{ $errors->first('company_name') }}</div>
                        </div>
                     </div>
                  </div>
 <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="designation" class="input-box-signup" placeholder="Designation" required=""
                           data-parsley-errors-container="#error_designation" data-parsley-required-message="This field is required"/>
                           <div id="error_designation" class="error"></div>
                           <div class="error">{{ $errors->first('designation') }}</div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Duration</label>
                     <div class="duration">
                        <div class="row">
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_month_start" required=""
                           data-parsley-errors-container="#error_duration_month_start" data-parsley-required-message="This field is required">
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
                                 <div id="error_duration_month_start" class="error"></div>
                                 <div class="error">{{ $errors->first('duration_month_start') }}</div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                          
                              <div class="select-number">
                                 <select name="duration_year_start" required=""
                           data-parsley-errors-container="#error_duration_year_start" data-parsley-required-message="This field is required">
                                   <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                 </select>
                                 <div id="error_duration_year_start" class="error"></div>
                                 <div class="error">{{ $errors->first('duration_year_start') }}</div>
                              </div>
                           </div>
                           <div class="duration-to-career">To</div>
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_month_end" required=""
                           data-parsley-errors-container="#error_duration_month_end" data-parsley-required-message="This field is required">
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
                                       <option value="13">Present</option>
                                 </select>
                                 <div id="error_duration_month_end" class="error"></div>
                                 <div class="error">{{ $errors->first('duration_month_end') }}</div>
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_year_end" required=""
                           data-parsley-errors-container="#error_duration_year_end" data-parsley-required-message="This field is required">
                                    <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                      <option value="2018"> Present</option>
                                 </select>
                                 <div id="error_duration_year_end" class="error"></div>
                                 <div class="error">{{ $errors->first('duration_year_end') }}</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                     <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="annual_sal" class="input-box-signup" placeholder="Annual Salary" required=""
                          data-parsley-type="number" data-parsley-errors-container="#error_annual_sal" data-parsley-required-message="This field is required"/>
                           <div id="error_annual_sal" class="error"></div>
                           <div class="error">{{ $errors->first('annual_sal') }}</div>

                        </div>
                     </div>
                  </div>
                  
                  
                  
                      <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12" id="locationField">
                         <i class="fa fa-map-marker scareer-form_04" aria-hidden="true"></i>
                            
                            
                           <input type="text" name="current_location" class="input-box-signup scareer-form_05" placeholder="Current Location" required=""
                           data-parsley-errors-container="#error_current_location" id="autocomplete" onFocus="geolocate()" data-parsley-required-message="This field is required"/>
                           <div id="error_current_location" class="error"></div>
                           <div class="error">{{ $errors->first('current_location') }}</div>
                        </div>
                     </div>
                  </div>

                  
                  
                  
                  
                   <div class="form-group">
                     <label>Upload your Resume</label>
                     <div class="user-box row">
                         <div class="user-box row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <input id="profile_image scareer-form_06" required="" name="resume" type="file" data-parsley-errors-container="#error_resume" data-parsley-required-message="This field is required">
                              <div class="input-group ">
                                 <div class="btn btn-primary btn-file btn-gry" style="    margin-left: 15px;">
                                    <a class="file" onclick="browseImage()">Choose File
                                    </a>
                                 </div>
                                 <div class="btn btn-primary btn-file remove scareer-form_07"  id="btn_remove_image">
                                    <a class="file" onclick="removeBrowsedImage()"><i class="fa fa-trash"></i>
                                    </a>
                                 </div>
                                 <input class="form-control file-caption  kv-fileinput-caption" id="profile_image_name" disabled="disabled" type="text">
                              </div>
                           </div>
                           
                           <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <h5 class="upload">Support Formats: doc, docx, rtf, PDF, Max File 500 KB</h5>
                     
                     <div class="filezise scareer-form_08"  ></div>

 <div id="error_resume" class="error"></div>
                    <div class="error">{{ $errors->first('resumefile') }}</div>

 
                    <div class="error">{{ $errors->first('resume') }}</div>



                  </div>

 
            
                  
                  
                  
                  
                  
                  
                  
                  
                  <div class="form-group scareer-form_03" >
                     <div class="row">
                        <div class="col-sm-12 col-md-9 col-lg-11">
                           <div class="radio-btns">
                              <div class="radio-btn">
                                 <input id="Radio1" onclick="employertype();" value="current" name="employer_type" type="radio" 
                          checked data-parsley-required-message="This field is required">
                                 <label for="Radio1">Current Employee</label>
                                 <div class="check"></div>
                              </div>
                              <div class="radio-btn">
                                 <input id="Radio2" onclick="employertype();" name="employer_type" value="previous" type="radio">
                                 <label for="Radio2">Previous Employee</label>
                                 <div class="check">
                                    <div class="inside"></div>
                                 </div>
                              </div>

                           </div>
                            <div id="error_employee" class="error"></div>
                            <div class="error">{{ $errors->first('selector') }}</div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>

                   <div class="form-group scareer-form_03" id="employer_name" >
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="employer_name" class="input-box-signup" value="interviewxp" placeholder="Enter Employer Name"/>
                        </div>
                     </div>
                  </div>

                 
                 
               
                 
                 
                 
                 
                 
                 <div class="addonemore scareer-form_09 scareer-form_09">
                     
                     
                     
                     
                     
                     
                      <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="company_namen" class="input-box-signup" placeholder="Company Name"  />
                         
                        </div>
                     </div>
                  </div>
                  
                  
 <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="designationn" class="input-box-signup" placeholder="Designation">
                        </div>
                     </div>
                  </div>
            
                
                  <div class="form-group">
                     <label>Duration</label>
                     <div class="duration">
                        <div class="row">
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_month_startn" >
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
                             
                              </div>
                           </div>
                           <div class="col-sm-3">
                           <?php $current_year = date('Y'); ?>
                              <div class="select-number">
                                 <select name="duration_year_startn" >
                                   <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                 </select>
                            
                              </div>
                           </div>
                           <div class="duration-to-career">To</div>
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_month_endn" >
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
                                
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_year_endn">
                                    <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                  
                                 </select>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="annual_saln" class="input-box-signup" placeholder="Annual Salary" 
                          data-parsley-type="number" />
                      
                        </div>
                     </div>
                  </div>
                  
                  
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12" >
<button type="button" class="submit-btn ctn addtwo scareer-form_010">+ Add another employment </button>

</div></div></div>
 
                     
                     
                     
                 </div>
                 
                 
                 
                 
                 
                    
                 <div class="addtwomore scareer-form_09" >
                     
                     
                     
                     
                     
                     
                      <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">

                           <input type="text" name="company_namenn" class="input-box-signup" placeholder="Company Name"  />
                         
                        </div>
                     </div>
                  </div>
                  
                  
 <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="designationnn" class="input-box-signup" placeholder="Designation">
                        </div>
                     </div>
                  </div>
            
                
                  <div class="form-group">
                     <label>Duration</label>
                     <div class="duration">
                        <div class="row">
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_month_startnn" >
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
                             
                              </div>
                           </div>
                           <div class="col-sm-3">
                           <?php $current_year = date('Y'); ?>
                              <div class="select-number">
                                 <select name="duration_year_startnn" >
                                   <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                 </select>
                            
                              </div>
                           </div>
                           <div class="duration-to-career">To</div>
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_month_endnn" >
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
                                
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="select-number">
                                 <select name="duration_year_endnn">
                                    <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                    <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                  
                                 </select>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <input type="text" name="annual_salnn" class="input-box-signup" placeholder="Annual Salary" 
                          data-parsley-type="number" />
                      
                        </div>
                     </div>
                  </div>
                  
                  
                
                     
                     
                     
                 </div>
                 
                 
                 
                  
                  
   <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12" >
<button type="button" class="submit-btn ctn addone scareer-form_010" style="     margin-top: 10px;  ">+ Add another employment </button>

</div></div></div>


 
                 

                <!--   <div class="form-group">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="select-number">
                              <select name="current_location" required=""
                           data-parsley-errors-container="#error_current_location" data-parsley-required-message="This field is required">
                                 <option value="">Select Current Work Location</option>
                                 <option>Nasik</option>
                                 <option>Pune</option>
                                 <option>Mumbai</option>
                                 <option>Delhi</option>
                                 <option>Banglore</option>
                              </select>
                              <div id="error_current_location" class="error"></div>
                              <div class="error">{{ $errors->first('current_location') }}</div>
                           </div>
                        </div>
                     </div>
                  </div> -->

                

                  
                  
                  
                  
                 
                  
                  
                 <!--  <div class="captcha"><img src="images/captcha.jpg" alt="Interviewxp" class="img-responsive"></div> -->
                
                  
                  <div class="btn-wrapper">
                     <button onclick="return validate_with_recaptcha()" type="submit" class="submit-btn ctn">Submit</button>
                  </div>
               </div>
              </form>

            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
    function employertype()
     {
        var value_employertype = $("input[name='employer_type']:checked").val();
     
        if(value_employertype=='current')
        {
          $('#employer_name').hide(); 
        }
        if(value_employertype=='previous')
        {
          $('#employer_name').show();  
        }
     }

     function validate_with_recaptcha () 
    {

        if($('#frm_career_form').parsley().isValid())
        {
            
            var is_valid_captcha = grecaptcha.getResponse();  
              
            if(is_valid_captcha == "")
            {
               $('#captcha_error').html('This field is required.');
               return false;
            }
            return grecaptcha.getResponse()==""?false:true
        }
        
    }
    
    $(document).ready(function(){
    $(".addone").click(function(){
        $(".addonemore").slideDown();
        $(".addone").css('display','none');
    });
    
     $(".addtwo").click(function(){
        $(".addtwomore").slideDown();
        $(".addtwo").css('display','none');
    });
});
</script>

    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
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
    
    
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB45EYFRoODaNYO3EU38HE_PRLgwHxgDh4&libraries=places&callback=initAutocomplete"
        async defer></script>
@endsection

