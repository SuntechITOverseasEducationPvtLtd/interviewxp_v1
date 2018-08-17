@extends('admin.layout.master')                
@section('main_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>

<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js">
    
</script>
<style type="text/css">
  .error{
    color:red;
  }
</style>
    
   <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
            </div>
            
            <div class="box-content">

          @include('admin.layout._operation_status')  

                                <form action="{{$module_url_path}}/store_employment" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate>


           {{ csrf_field() }}
           <?php $current_year = date('Y') ?>
            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Job Skills<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <select id="skill_id" name="skills[]" multiple="multiple" required="" data-parsley-errors-container="#err_job_skill" data-parsley-required-message="This field is required">
                      </select>
                      <span class="help-block">{{ $errors->first('skills') }}</span>
                      <div id="err_job_skill" class="error"></div>
                  </div>
            </div>

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Experience<i style="color: red;">*</i></label>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control" name="experience_year" required="" data-parsley-errors-container="#err_exp_year" data-parsley-required-message="This field is required"  >
                      <option value="">Years</option>
                      @for($i=0;$i<=20;$i++) 
                      <option value="{{$i}}"> {{$i}}</option>
                      @endfor
                        
                    </select>
                    <div id="err_exp_year" class="error"></div>
                    <span class="help-block">{{ $errors->first('experience_year') }}</span>
                </div>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="experience_month" required="" data-parsley-errors-container="#err_exp_month" data-parsley-required-message="This field is required"  >
                      <option value="">Month</option>
                      @for($i=0;$i<=11;$i++) 
                      <option value="{{$i}}"> {{$i}}</option>
                      @endfor   
                    </select>
                    <div id="err_exp_month" class="error"></div>
                    <span class="help-block">{{ $errors->first('experience_month') }}</span>
                </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Current Employer<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >

                      <input type="text" class="form-control" name="employer_name" placeholder="Enter Companyname" value="{{ old('employer_name') }}" required="" data-parsley-errors-container="#err_employer_name" data-parsley-required-message="This field is required" />
                      <div id="err_employer_name" class="error"></div>

                      <span class="help-block">{{ $errors->first('employer_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label"><i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="radio" onclick="employertype();" name="employer_type" required="" data-parsley-errors-container="#err_current_employee" data-parsley-required-message="This field is required" value="current" >Current Employer
                      <input type="radio" onclick="employertype();" name="employer_type" value="previous">Previous Employer
                       <div id="err_current_employee" class="error"></div>
                      <span class="help-block">{{ $errors->first('employer_type') }}</span>
                  </div>
            </div>

            <div class="row">
							<label class="col-sm-12"><b>Experience</b></label>
					  </div>
					 @if(count($arr_employeeDetails) > 0)
					 @foreach($arr_employeeDetails as $key=>$value)
					 <div id="current_employer" style="box-shadow: 0px 1px 2px 1px #ccc; padding: 10px; margin-bottom: 20px;">
					
					  <div class="form-group">
                        <label>Designation<span class="star">*</span></label>
                        <input type="hidden" id="emp_type_id" name="emp_type_id[]" value="{{ base64_encode($value->id) }}"/>
                        <input type="text" class="input-box-signup" id="current_designation" placeholder="Enter Your Designation" name="current_designation[]" value="{{ $value->designation }}"  data-parsley-required="true" data-parsley-errors-container="#err_designation" data-parsley-required-message="This field is required"/>
                        <div id="err_designation" class="error"></div>
                        <div class="error">{{ $errors->first('designation') }}</div> 
					  </div>	
					  <div class="form-group">
						<label>Company Name<span class="star">*</span></label>
						<input data-parsley-required="true" id="previous_company_name" data-parsley-errors-container="#err_company_name" data-parsley-required-message="This field is required" type="text" class="input-box-signup" name="company_name[]" value="{{ $value->company_name }}" placeholder="Enter Name Of Your Employer">
						<div id="err_company_name" class="error"></div><div class="error"></div>
					  </div>
					  <div class="form-group">
						<input id="display_company" type="checkbox"  name="display_company[{{$key}}]" value="Confidential" {{ $value->display_company ==  'Confidential' ? 'checked' : ''  }}>&nbsp;&nbsp;<span>Confidential</span>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="display_company" type="checkbox"  name="display_company[{{$key}}]" value="MNC" {{ $value->display_company ==  'MNC' ? 'checked' : ''  }}>&nbsp;&nbsp;<span>MNC</span>
					  </div>
					  <div id="row">
					   <div class="col-sm-4" style="padding:0px">	
					   <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number"  style="width: 95.8%;">
                           <select id="country{{$key}}" data-key="{{$key}}" class="company_country_id" name="country[]" data-parsley-required="true"    data-parsley-errors-container="#err_company_ountry_id{{$key}}" data-parsley-required-message="This field is required">
                              <option value="">--Select Country--</option>
                              @if(isset($arr_country) && count($arr_country)>0)
                              @foreach($arr_country as $country)
                              <option value="{{ $country['id'] }}" {{ ($value->country == $country['id']) ? "selected" : "" }}>{{ $country['country_name'] or '-' }}</option>
                              @endforeach
                              @endif
                           </select>
                            <div id="err_company_country_id{{$key}}" class="error"></div>
                        </div>
                        </div>
                        </div>
						<div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
						   <div class="select-number"  style="width: 95.8%;">
                           <select id="state{{$key}}" data-key="{{$key}}" class="company_state_id" name="state[]" data-parsley-required="true"    data-parsley-errors-container="#err_company_state_id{{$key}}" data-parsley-required-message="This field is required">
                              <option value="">--Select State--</option>                             
                           </select>
						   </div>
						   <div id="err_company_state_id{{$key}}" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>
                        </div>
						<div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              City<span class="star">*</span>
                           </label>
						   <div class="select-number"  style="width: 95.8%;">
                           <select id="city{{$key}}" name="city[]" data-parsley-required="true"    data-parsley-errors-container="#err_company_city_id{{$key}}" data-parsley-required-message="This field is required">
                              <option value="">--Select City--</option>                             
                           </select>
						   </div>
						   <div id="err_company_city_id{{$key}}" class="error"></div>
                        </div>
                        </div>
                        
						</div>
                      <div class="form-group" style="clear:both">						
                        <label>Working Since<span class="star">*</span></label>
                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="start_month[]" id="current_start_month" data-parsley-required="true" data-parsley-errors-container="#err_duration_month" data-parsley-required-message="This field is required">
                                       <option value="">Month</option>
                                       <option value="01" {{ $value->start_month ==  '01' ? 'selected' : ''  }}>Jan</option>
                                       <option value="02" {{ $value->start_month ==  '02' ? 'selected' : ''  }}>Feb</option>
                                       <option value="03" {{ $value->start_month ==  '03' ? 'selected' : ''  }}>Mar</option>
                                       <option value="04" {{ $value->start_month ==  '04' ? 'selected' : ''  }}>Apr</option>
                                       <option value="05" {{ $value->start_month ==  '05' ? 'selected' : ''  }}>May</option>
                                       <option value="06" {{ $value->start_month ==  '06' ? 'selected' : ''  }}>Jun</option>
                                       <option value="07" {{ $value->start_month ==  '07' ? 'selected' : ''  }}>Jul</option>
                                       <option value="08" {{ $value->start_month ==  '08' ? 'selected' : ''  }}>Aug</option>
                                       <option value="09" {{ $value->start_month ==  '09' ? 'selected' : ''  }}>Sep</option>
                                       <option value="10" {{ $value->start_month ==  '10' ? 'selected' : ''  }}>Oct</option>
                                       <option value="11" {{ $value->start_month ==  '11' ? 'selected' : ''  }}>Nov</option>
                                       <option value="12" {{ $value->start_month ==  '12' ? 'selected' : ''  }}>Dec</option>
                                    </select>
                                    <div id="err_duration_month" class="error"></div>
                                    <div class="error">{{ $errors->first('start_month') }}</div> 
                                 </div>
                              </div>
							  <?php
							  $current_year = date('Y');
							  ?>
                              <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="start_year[]" id="current_start_year" data-parsley-required="true" data-parsley-errors-container="#err_duration_year" data-parsley-required-message="This field is required">
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}" {{ $value->	start_year ==  $i ? 'selected' : ''  }}> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <div id="err_duration_year" class="error"></div>
                                   <div class="error">{{ $errors->first('start_year') }}</div> 
                                 </div>
                              </div>
                              <div class="duration-to">To</div>
                              <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="end_month[]" id="current_end_month" data-parsley-required="true" data-parsley-errors-container="#err_toduration_month" data-parsley-required-message="This field is required">
                                      
									   <option value="">Month</option>
									   <option value="present" {{ $value->end_month ==  'present' ? 'selected' : ''  }}>Present</option>
                                       <option value="01" {{ $value->end_month ==  '01' ? 'selected' : ''  }}>Jan</option>
                                       <option value="02" {{ $value->end_month ==  '02' ? 'selected' : ''  }}>Feb</option>
                                       <option value="03" {{ $value->end_month ==  '03' ? 'selected' : ''  }}>Mar</option>
                                       <option value="04" {{ $value->end_month ==  '04' ? 'selected' : ''  }}>Apr</option>
                                       <option value="05" {{ $value->end_month ==  '05' ? 'selected' : ''  }}>May</option>
                                       <option value="06" {{ $value->end_month ==  '06' ? 'selected' : ''  }}>Jun</option>
                                       <option value="07" {{ $value->end_month ==  '07' ? 'selected' : ''  }}>Jul</option>
                                       <option value="08" {{ $value->end_month ==  '08' ? 'selected' : ''  }}>Aug</option>
                                       <option value="09" {{ $value->end_month ==  '10' ? 'selected' : ''  }}>Oct</option>
                                       <option value="11" {{ $value->end_month ==  '11' ? 'selected' : ''  }}>Nov</option>
                                       <option value="12" {{ $value->end_month ==  '12' ? 'selected' : ''  }}>Dec</option>
                                    </select>
                                    <div id="err_toduration_month" class="error"></div>
                                     <div class="error">{{ $errors->first('end_month') }}</div>
                                 </div>
                              </div>
							   <div class="col-sm-3">
                                 <div class="select-number">
                                    <select name="end_year[]" id="current_end_year" data-parsley-required="true" data-parsley-errors-container="#err_end_year" data-parsley-required-message="This field is required">
                                     <option value="">Year</option>
									 <option value="present" {{ $value->	end_year ==  'present' ? 'selected' : ''  }}>Present</option>									 
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}" {{ $value->	end_year ==  $i ? 'selected' : ''  }}> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <div id="err_end_year" class="error"></div>
                                   <div class="error">{{ $errors->first('end_year') }}</div> 
                                 </div>
                              </div>
                              
                           </div>
                        </div>						
                     </div>
					 <div class="form-group">
						<label>Description<span class="star">*</span></label>
						<textarea type="text" id="description" class="input-box-textarea" placeholder="Enter Your Designation Summary" name="description[]" data-parsley-required="true" data-parsley-errors-container="#err_description" data-parsley-required-message="This field is required" rows="3">{{$value->description}}</textarea>
						<div id="err_description" class="error"></div><div class="error"></div>
					 </div>
                       
                     </div>
					 <script type="text/javascript">
						getStates({{$value->country}}, {{$value->state}}, 'state{{$key}}');
						getCities({{$value->state}}, {{$value->city}}, 'city{{$key}}');
					</script>
					@endforeach
					@endif
					 <div id="previous_employer">
						<div class="add-employment"><input type="button" id="add_more" class="submit-btn ctn add-employment" value="+add another employment" />
						</div>
                    </div>

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Upload Your Resume</label>
                <div class="col-sm-9 col-lg-4 controls" >
                <input class="form-control" type="file" name="resume" >
                </div>
            </div>
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-lg-4 controls" >
                Note: Allowed File type: docx , doc , pdf. maximum size 500 kb
                </div>
            </div>    
            <input type="hidden" name="enc_id" value="{{$enc_id or '-'}}">
            <input type="hidden" name="type" value="{{$type}}">
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
               
                
                <input type="submit" value="Save" class="btn btn btn-primary">
                
              </div>
            </div>
    
          </form>
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#skill_id').tokenize(
      {
        newElements:true,
        datas: site_url+'/admin/members/get_skills',
            textField:'skill_name',
            valueField:'id'  
        });
   });

</script>

<script type="text/javascript">
     function employertype()
     {
        var value_employertype = $("input[name='employer_type']:checked").val();
     //  alert(value_cardtype);
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

          $('#previous_start_month1').attr('data-parsley-required','false');
          $('#previous_end_month1').attr('data-parsley-required','false');
          $('#previous_end_year1').attr('data-parsley-required','false');
          $('#previous_start_year1').attr('data-parsley-required','false');
          $('#previous_company_name1').attr('data-parsley-required','false');
          $('#previous_designation1').attr('data-parsley-required','false');

          $('#previous_start_month2').attr('data-parsley-required','false');
          $('#previous_end_month2').attr('data-parsley-required','false');
          $('#previous_end_year2').attr('data-parsley-required','false');
          $('#previous_start_year2').attr('data-parsley-required','false');
          $('#previous_company_name2').attr('data-parsley-required','false');
          $('#previous_designation2').attr('data-parsley-required','false'); 

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
</script>
<script type="text/javascript">
  var count = 1;  
    $("#add_more").click(function()
    {
      if(count < 3)
      {
        var content="";

        content+='<div class="form-group">';
        content+='<label class="col-sm-3 col-lg-2 control-label">Designation<i style="color: red;">*</i></label>';
        content+='<div class="col-sm-9 col-lg-4 controls" >';
        content+='<input type="text" id="previous_designation'+count+'" class="form-control" placeholder="Enter Your Designation" name="previous_designation[]" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation'+count+'" data-parsley-required-message="This field is required"/>';
        content+='<div id="err_previous_designation'+count+'" class="error"></div>';
        content+='<span class="help-block"></span>';
        content+='</div>';
        content+='</div>';


        content+='<div class="form-group">';
        content+='<label class="col-sm-3 col-lg-2 control-label">Company Name<i style="color: red;">*</i></label>';
        content+='<div class="col-sm-9 col-lg-4 controls" >';
        content+='<input data-parsley-required="true" id="previous_company_name'+count+'" data-parsley-errors-container="#err_company_name'+count+'" data-parsley-required-message="This field is required" type="text" class="form-control"  name="company_name[]" placeholder="Enter Company Name"  />';
        content+='<div id="err_company_name'+count+'" class="error"></div>';
        content+='<span class="help-block"></span>';
        content+='</div>';
        content+='</div>';


        content+='<div class="form-group">';
        content+='<label class="col-sm-3 col-lg-2 control-label">Duration<i style="color: red;">*</i></label>';
        content+='<div class="duration">';
        content+='<div class="row">';
        content+='<div class="col-sm-2">';
        content+='<div class="select-number">';
        content+='<select name="previous_start_month[]" class="form-control" id="previous_start_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_month'+count+'" data-parsley-required-message="This field is required">';
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
        content+='<span class="help-block"></span>';
        content+='</div>';
        content+='</div>';
        content+='<div class="col-sm-2">';
        content+='<div class="select-number">';
        content+='<select name="previous_start_year[]" class="form-control" id="previous_start_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_year'+count+'" data-parsley-required-message="This field is required">';
        content+='<option value="">Year</option>';
        content+='@for($i=$current_year;$i>=1976;$i--)';
        content+='<option value="{{$i}}"> {{$i}}</option>';
         content+='@endfor';
        content+='</select>';
        content+='<div id="err_previous_duration_year'+count+'" class="error"></div>';
        content+='<span class="help-block"></span>'; 
        content+='</div>';
        content+='</div>';
        content+='<div class="col-sm-2">';
        content+='<div class="select-number">';
        content+='<select name="previous_end_month[]" class="form-control" id="previous_end_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_month'+count+'" data-parsley-required-message="This field is required">';
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
        content+='<span class="help-block"></span>';
        content+='</div>';
        content+='</div>';
        content+='<div class="col-sm-2">';
        content+='<div class="select-number">';
        content+='<select name="previous_end_year[]" class="form-control" id="previous_end_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_year'+count+'" data-parsley-required-message="This field is required">';
        content+='<option value="">Year</option>';
        content+='@for($i=$current_year;$i>=1976;$i--)';
        content+='<option value="{{$i}}"> {{$i}}</option>';
        content+='@endfor';
        content+='</select>';
        content+='<div id="err_previous_toduration_year'+count+'" class="error"></div>';
        content+='<span class="help-block"></span>';
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
@stop                    
