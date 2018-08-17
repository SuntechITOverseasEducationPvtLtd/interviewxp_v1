<style>
    .sinterviewCoach_01{padding-right: 0px;padding-left: 0px;}
.sinterviewCoach_02{height: 150px; margin-bottom: 0px;background-size: 100% 100%;}
.sinterviewCoach_03{float: right;}
.sinterviewCoach_04{font-size: 20px;color: #0e998e;}
.sinterviewCoach_05{margin:auto; visibility:hidden;}
.sinterviewCoach_06{width:100%; margin-top:70px;}
.sinterviewCoach_07{padding:0px}
.sinterviewCoach_08{width: 95.8%;}
.sinterviewCoach_09{clear:both}
.sinterviewCoach_010{box-shadow: 0px 1px 2px 1px #ccc; padding: 10px; margin-bottom: 20px;}
.sinterviewCoach_011{margin-top: -10px;float: right;cursor:pointer}
</style>

@extends('front.layout.main')
@section('middle_content')  
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
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
      <div class="banner-member">
         <div class="pattern-member">
            
         </div>
      </div>
    
         <div class="container-fluid fix-left-bar">
            <div class="row">
              @include('front.member.member_sidebar')
              
               <div class="col-sm-8 col-md-9 col-lg-10 middle-content">
               
                     <h2 class="my-profile">Interview Coach</h2>
                 
                  <div class="right-section-member">
                   <div class="col-sm-12 col-md-10 form-wrapper">

                 <div class="member-myProfile-form">
                 @include('admin.layout._operation_status')
                 <form class="" id="add_interviewCoach" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/add_interviewCoach" data-parsley-validate>
                 {{ csrf_field() }}
					<?php
						if(empty($FirstName))
							$opF="Interview";
						else
							$opF=$FirstName;
						if(empty($LastName))
							$opL="Member";
						else
							$opL=$LastName;
						
						if(!empty($banner_image))
						{
							$bgImage = url('/').'/uploads/profile_images/interviewCoach/'.$banner_image;
						}
						else{
							$bgImage = url('/').'/images/coach_banner.jpg';
						}
						
						if(!empty($profile_image))
						{
							$profile_image = url('/').'/uploads/profile_images/interviewCoach/'.$profile_image;
						}
						else{
							$profile_image = url('/').'/images/Profile-img.jpg';
						}
						
					?>				  
							  
                  <div class="form-wrapper">
                     <div class="row sinterviewCoach_01">
						<div class="col-sm-12 card hovercard">						
							<div class="sinterviewCoach_02" style="background-image: url('{{$bgImage}}');" id="bg_banner_image">
								
								<label for="member-banner-edit-upload-input" class="btn banner_image_label sinterviewCoach_03" ><i class="fa fa-pencil sinterviewCoach_04" aria-hidden="true"></i></label>
								<input type="file" id="member-banner-edit-upload-input" accept="image/*" name="banner_image" class="profile-photo-edit__file-upload-input sinterviewCoach_05" >
								 <div class="avatar">
								 <img src="{{$profile_image}}" class="sinterviewCoach_06" id="profile_image">
								 <label for="member-photo-edit-upload-input" class="btn profile_image_label"><i class="fa fa-pencil sinterviewCoach_04" aria-hidden="true"></i></label>
								 <input type="file" id="member-photo-edit-upload-input" name="profile_image" accept="image/*" class="profile-photo-edit__file-upload-input sinterviewCoach_05">
								</div>
							</div>
							
						</div>
                        <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                           <div class="form-group">
                              <label>First Name <span class="star">*</span></label>
                              <input type="text" name="FirstName"  value="{{$opF}}" class="input-box-signup" placeholder="Enter Your First Name" required=""
                            />
                           <div id="err_first_name" class="error"></div>
                           <div class="error">{{ $errors->first('FirstName') }}</div> 
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 last-name">
                           <div class="form-group">
                              <label>Last Name <span class="star">*</span></label>
                              <input type="text" name="LastName"  value="{{$opL}}" class="input-box-signup" placeholder="Enter Your Last Name" required="" />
                           <div id="err_last_name" class="error"></div>
                            <div class="error">{{ $errors->first('LastName') }}</div>  
                           </div>
                        </div>
                     </div>
					 <?php /*<div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                           <div class="form-group">
                              <label>Current State <span class="star">*</span></label>
                              <input type="text" name="CurrentState"  value="{{$CurrentState}}" class="input-box-signup" placeholder="Enter Your Current State" required="" />
                           <div id="err_first_name" class="error"></div>
                           <div class="error">{{ $errors->first('CurrentState') }}</div> 
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 last-name">
                           <div class="form-group">
                              <label>Current City<span class="star">*</span></label>
                              <input type="text" name="CurrentCity"  value="{{$CurrentCity}}" class="input-box-signup" placeholder="Enter Your Current City" required=""  />
                           <div id="err_last_name" class="error"></div>
                            <div class="error">{{ $errors->first('CurrentCity') }}</div>  
                           </div>
                        </div>
                     </div>*/ ?>
					 <div id="row">
					   <div class="col-sm-4 sinterviewCoach_07">	
					   <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number sinterviewCoach_08" >
                           <select id="country_id" name="country_id" data-parsley-required="true"    data-parsley-errors-container="#err_country_id" data-parsley-required-message="This field is required">
                              <option value="">--Select Country--</option>
                              @if(isset($arr_country) && count($arr_country)>0)
                              @foreach($arr_country as $country)
                                <option value="{{ $country['id'] }}" {{ ($arr_member_details['education_country_id'] == $country['id']) ? "selected" : "" }}>{{ $country['country_name'] or '-' }}</option>
                              @endforeach
                              @endif
                           </select>
                            <div id="err_country_id" class="error"></div>
                        </div>
                        </div>
                        </div>
						<div class="col-sm-4 sinterviewCoach_07" >
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
						   <div class="select-number sinterviewCoach_08"  >
                           <select id="state_id" name="state_id" data-parsley-required="true"    data-parsley-errors-container="#err_state_id" data-parsley-required-message="This field is required">
                              <option value="">--Select State--</option>                             
                           </select>
						   </div>
						   <div id="err_state_id" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>
                        </div>
						<div class="col-sm-4 sinterviewCoach_07" >
                        <div class="form-group">
                           <label>
                              City<span class="star">*</span>
                           </label>
						   <div class="select-number sinterviewCoach_08" >
                           <select id="city_id" name="city_id" data-parsley-required="true"    data-parsley-errors-container="#err_city_id" data-parsley-required-message="This field is required">
                              <option value="">--Select City--</option>                             
                           </select>
						   </div>
						   <div id="err_city_id" class="error"></div>
                        </div>
                        </div>
                        
					</div>
                     <div class="form-group sinterviewCoach_09">
                        <label>Title/Headline<span class="star">*</span></label>
                        <input type="text" name="Headline"  data-rule-lettersonly="true" value="{{$Headline}}" class="input-box-signup" placeholder="Enter Headline" required=""/>
                           <div id="err_email" class="error"></div>
                          <div class="error">{{ $errors->first('Headline') }}</div>  
                     </div>
					 <div class="form-group">
                        <label>Summary<span class="star">*</span></label>
                        <textarea name="Summary" class="form-area"  cols="30" rows="5" placeholder="About You" required="" >{{$Summary}}</textarea>
                           <div id="err_email" class="error"></div>
                          <div class="error">{{ $errors->first('Summary') }}</div>  
                     </div>
					 <div class="row">
							<label class="col-sm-12"><b>Experience</b></label>
					  </div>
					 @if(count($arr_employeeDetails) > 0)
					 @foreach($arr_employeeDetails as $key=>$value)
					 <div id="current_employer" class="sinterviewCoach_010">
					
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
					   <div class="col-sm-4 sinterviewCoach_07" >	
					   <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number sinterviewCoach_08" >
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
						<div class="col-sm-4 sinterviewCoach_07">
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
						   <div class="select-number sinterviewCoach_08">
                           <select id="state{{$key}}" data-key="{{$key}}" class="company_state_id" name="state[]" data-parsley-required="true"    data-parsley-errors-container="#err_company_state_id{{$key}}" data-parsley-required-message="This field is required">
                              <option value="">--Select State--</option>                             
                           </select>
						   </div>
						   <div id="err_company_state_id{{$key}}" class="error"></div>
                           <!--  <div class="error">{{ $errors->first('other_state') }}</div> -->
                        </div>
                        </div>
						<div class="col-sm-4 sinterviewCoach_07" >
                        <div class="form-group">
                           <label>
                              City<span class="star">*</span>
                           </label>
						   <div class="select-number sinterviewCoach_08">
                           <select id="city{{$key}}" name="city[]" data-parsley-required="true"    data-parsley-errors-container="#err_company_city_id{{$key}}" data-parsley-required-message="This field is required">
                              <option value="">--Select City--</option>                             
                           </select>
						   </div>
						   <div id="err_company_city_id{{$key}}" class="error"></div>
                        </div>
                        </div>
                        
						</div>
                      <div class="form-group sinterviewCoach_09">						
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
					 
					 <?php /*<div class="form-group">
                        <label>Interview Q & A<span class="star">*</span></label>
                        <textarea name="Interview" class="form-area"  cols="30" rows="5" placeholder="About Interview Q & A" required="" >{{$Interview}}</textarea>
                           <div id="err_email" class="error"></div>
                          <div class="error">{{ $errors->first('Interview') }}</div>  
                     </div>
					 <div class="form-group">
                        <label>Interview By Companies<span class="star">*</span></label>
                        <textarea name="Companies" class="form-area"  cols="30" rows="5" placeholder="About Interview By Companies" required="" >{{$Companies}}</textarea>
                           <div id="err_email" class="error"></div>
                          <div class="error">{{ $errors->first('Companies') }}</div>  
                     </div>
					 <div class="form-group">
                        <label>Real Time Issues<span class="star">*</span></label>
                        <textarea name="Issues" class="form-area"  cols="30" rows="5" placeholder="About Real Time Issues" required="" >{{$Issues}}</textarea>
                           <div id="err_email" class="error"></div>
                          <div class="error">{{ $errors->first('Issues') }}</div>  
                     </div>*/ ?>
                     <!--end-->
                     <input type="hidden" value="{{$enc_id}}" name="enc_id">
                     <div class="btn-wrapper">
                        <button type="reset" class="cancel-btn">Cancel</button>
                        <button type="submit" class="submit-btn">Submit</button>
                     </div>
                  </div>
                  </form>
                </div>
                 </div>
                 
                   </div>
                </div>
                
               </div>
            </div>
         </div>
<?php	
	$countries = json_encode($arr_country);
  $display_company = (isset($value->display_company)) ? 'Confidential' : '';
?>		 
<script type="text/javascript">
  var count = '{{count($arr_employeeDetails)}}';  
  var current_year = new Date().getFullYear();
    $("#add_more").click(function()
    {
      
        var content='<div class="previous_employer_details">';
        var countries = <?php echo $countries; ?>;

        content+='<i class="fa fa-times-circle-o fa-2x pull-right emp_close sinterviewCoach_011" aria-hidden="true"></i>';
        content+='<div class="form-group sinterviewCoach_09" >';
        content+='<label>Designation<span class="star">*</span></label>'
        content+='<input type="text" id="previous_designation'+count+'" class="input-box-signup" placeholder="Enter Your Designation" name="current_designation[]" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation'+count+'" data-parsley-required-message="This field is required"/>';
        content+='<div id="err_previous_designation'+count+'" class="error"></div>';
        content+='<div class="error"></div>'; 
        content+='</div>';

        content+='<div class="form-group">';
        content+='<label>Company Name<span class="star">*</span></label>';
        content+='<input data-parsley-required="true" id="previous_company_name'+count+'" data-parsley-errors-container="#err_company_name'+count+'" data-parsley-required-message="This field is required" type="text" class="input-box-signup"  name="company_name[]" placeholder="Enter Name Of Your Employer"  />';
        content+='<div id="err_company_name'+count+'" class="error"></div>';
        content+='<div class="error"></div>';
        content+='</div>';
		
		content+='<div class="form-group">';
		content+='<input id="display_company" type="checkbox"  name="display_company['+count+']" value="Confidential" {{ $display_company ==  "Confidential" ? "checked" : ""  }}>&nbsp;&nbsp;<span>Confidential</span>';
		content+='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		content+='<input id="display_company" type="checkbox"  name="display_company['+count+']" value="MNC" {{ $display_company ==  "MNC" ? "checked" : ""  }}>&nbsp;&nbsp;<span>MNC</span>';
		content+='</div>';

		content+='<div id="row">';
		content+='<div class="col-sm-4 sinterviewCoach_07">';
		content+='<div class="form-group">';
		content+='<label>Country<span class="star">*</span></label>';
		content+='<div class="select-number sinterviewCoach_08">';
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
		content+='<div class="col-sm-4 sinterviewCoach_07" >';
		content+='<div class="form-group">';
		content+='<label>';
		content+='State<span class="star">*</span> ';
		content+='</label>';
		content+='<div class="select-number sinterviewCoach_08">';
		content+='<select id="state'+count+'" data-key="'+count+'" name="state[]" data-parsley-required="true" data-parsley-errors-container="#err_company_state_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error company_state_id">';
		content+='<option value="">--Select State--</option>                             ';
		content+='</select>';
		content+='</div>';
		content+='<div id="err_company_state_id'+count+'" class="error"></div>';
		content+='<!--  <div class="error"></div> -->';
		content+='</div>';
		content+='</div>';
		content+='<div class="col-sm-4 sinterviewCoach_07">';
		content+='<div class="form-group">';
		content+='<label>';
		content+='City<span class="star">*</span>';
		content+='</label>';
		content+='<div class="select-number sinterviewCoach_08" >';
		content+='<select id="city'+count+'" name="city[]" data-parsley-required="true" data-parsley-errors-container="#err_company_city_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error">';
		content+='<option value="">--Select City--</option>';
		content+='</select>';
		content+='</div>';
		content+='<div id="err_company_city_id'+count+'" class="error"></div>';
		content+='</div>';
		content+='</div>';
		content+='</div>';


        content+='<div class="form-group sinterviewCoach_09">';
                        content+='<label>Duration<span class="star">*</span></label>';
                        content+='<div class="duration">';
                           content+='<div class="row">';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="start_month[]" id="previous_start_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_month'+count+'" data-parsley-required-message="This field is required">';
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
                                    content+='<select name="start_year[]" id="previous_start_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_year'+count+'" data-parsley-required-message="This field is required">';
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
                                    content+='<select name="end_month[]" id="previous_end_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_month'+count+'" data-parsley-required-message="This field is required">';
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
                                    content+='<select name="end_year[]" id="previous_end_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_year'+count+'" data-parsley-required-message="This field is required">';
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
  </script>	
<script type="text/javascript">

getStates({{$arr_member_details['education_country_id']}}, {{$arr_member_details['education_state']}}, 'state_id');
getCities({{$arr_member_details['education_state']}}, {{$arr_member_details['education_city']}}, 'city_id');

$(document).ready(function() { 

	$(document).on('click','.emp_close', function() {
		$(this).parent().remove();
	});
	$(document).on('change','input[type="checkbox"]', function() {
	   $(this).siblings('input[type="checkbox"]').prop('checked', false);
	});

    $('#country_id').on('change', function () {
        var country = this.value;
        var state = '';
        getStates(country, state, 'state_id');
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $('#state_id').on('change', function () {
        var state = this.value;
        var city = '';
		getCities(state, city, 'city_id');
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
$(document).ready(function(){
	//Image file input change event
	$("#member-photo-edit-upload-input").change(function(){
		readImageData(this, '#profile_image', 1);//Call image read and render function
	});
	$("#member-banner-edit-upload-input").change(function(){
		readImageData(this, '#bg_banner_image', 2);//Call image read and render function
	});
});
function readImageData(imgData, id, type){
	if (imgData.files && imgData.files[0]) {
		var readerObj = new FileReader();
		
		readerObj.onload = function (element) {
			if(type == 1)
			{
				$(id).attr('src', element.target.result);
			}
			else
			{
				$(id).css('background-image', 'url(' + element.target.result + ')');
			}										
			
		}
		
		readerObj.readAsDataURL(imgData.files[0]);
	}
}

</script>		

@endsection  