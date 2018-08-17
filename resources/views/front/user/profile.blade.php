@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<div class="banner-change-pw">
         <div class="pattern-change-pw">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="heading-changepw">{{$module_title}}</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
      
      <div class="middle-area min-height">
         <div class="container">

            <div class="row">

                    
              <form class="" id="frm_edit_profile" method="POST" enctype="multipart/form-data" action="{{url('/')}}/user/update_profile" data-parsley-validate>                        
                 {{ csrf_field() }}
                 <?php $current_year = date('Y'); ?>
               <div class="col-md-8 form-wrapper">
               @include('front.layout._operation_status')
               @if(isset($arr_data) && sizeof($arr_data)>0)
                 <div class="myProfile-form">
                  <div class="profile-img">
  <div class="upload-img">
  <img src="{{url('/')}}/images/Profile-edit-img.png" class="Profile-edit-img" alt="interviewxp"></div>
  <input class="file-upload" type="file" id="image_proof" name="profile_image">
  <!-- <input class="file-upload" type="file" onchange="readURL(this);" id="image_proof" name="profile_image">  -->
          <div class="profile-image">
          <?php $profile_logo = url('/uploads/profile_images/'.$arr_data['profile_image']) ?>
          @if($arr_data['profile_image']=="")
          <img style="width:160px;height:160px;" src="{{url('/')}}/images/Profile-img.jpg" id="upload-f" class="profile" alt="interviewxp">
          @else
          <img style="width:160px;height:160px;" src="{{$user_auth_details['profile_image']}}" id="upload-f" class="profile" alt="interviewxp">
          @endif
          </div>  
                  </div>
                  <div class="form-wrapper">
                     <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                           <div class="form-group">
                              <label>First Name <span class="star">*</span></label>
                              <input type="text" class="input-box-signup" name="first_name" data-rule-lettersonly="true" value="{{ isset($arr_data['first_name'])?$arr_data['first_name']:'NA' }}" data-parsley-pattern="^[a-zA-Z]+$"
                        data-parsley-pattern-message="First name should be only characters" placeholder="Enter Your First Name" required="" data-parsley-errors-container="#err_first_name" data-parsley-required-message="This field is required" />
                           <div id="err_first_name" class="error"></div>
                            <div class="error">{{ $errors->first('first_name') }}</div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 last-name">
                           <div class="form-group">
                              <label>Last Name <span class="star">*</span></label>
                              <input type="text" name="last_name" class="input-box-signup" placeholder="Enter Your Last Name" value="{{ isset($arr_data['last_name'])?$arr_data['last_name']:'NA' }}" data-parsley-pattern="^[a-zA-Z]+$"
                        data-parsley-pattern-message="Last name should be only characters" placeholder="Enter Your Last Name" required="" data-parsley-errors-container="#err_last_name" data-parsley-required-message="This field is required" />
                           <div id="err_last_name" class="error"></div>
                           <div class="error">{{ $errors->first('last_name') }}</div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Email Address <span class="star">*</span></label>
                        <input type="text" name="email" readonly="readonly" class="input-box-signup" placeholder="Enter Your Email Address" value="{{ isset($arr_data['email'])?$arr_data['email']:'NA' }}" required="" data-parsley-type="email" data-parsley-errors-container="#err_email" data-parsley-required-message="This field is required" />
                           <div id="err_email" class="error"></div>
                            <div class="error">{{ $errors->first('email') }}</div>
                     </div>
                     <div class="form-group">
                        <label>Mobile Number <span class="star">*</span></label>
                        <div class="row">
                           <div class="col-xs-3 col-sm-3 col-md-2 mumber-box-left">
                           <input type="text" name="mobile_code"
                               class="input-box-signup" value="{{$arr_data['mobile_code']}}" data-parsley-pattern="\+[0-9]{1,3}"
                        data-parsley-pattern-message="Enter Valid Country Code" required="" data-parsley-errors-container="#err_mobile_code" data-parsley-required-message="Field required" />
                               <div id="err_mobile_code" class="error"></div>
                          <div class="error">{{ $errors->first('mobile_code') }}</div>
                             
                           </div>
                           <div class="col-xs-9 col-sm-9 col-md-10 mumber-box-right">
                              <input type="text" name="mobile_no" class="input-box-signup" placeholder="Enter Your Mobile Number" value="{{ isset($arr_data['mobile_no'])?$arr_data['mobile_no']:'NA' }}" required="" data-parsley-type="integer" data-parsley-errors-container="#err_mobile_no" data-parsley-required-message="This field is required" data-parsley-minlength="7" data-parsley-maxlength="16"/>
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
                                 <select class="form-control"  name="qualification_id" required="" data-parsley-errors-container="#err_qualification_id" data-parsley-required-message="This field is required" id="qualification_id" onclick="loadSpecialization(this);"  >
                                  <option value="">--Select Qualification--</option>
                                  @if(isset($arr_qualification) && count($arr_qualification)>0)
                                    @foreach($arr_qualification as $qualification)
                                    <option @if($arr_data['user_profile']['qualification_id']==$qualification['id']) selected="" @endif value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                                    @endforeach
                                    @endif  
                                 </select>
                                <div id="err_qualification_id" class="error"></div>
                                  <div class="error">{{ $errors->first('qualification_id') }}</div>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="select-number">
                                 <select   name="passing_month" required="" data-parsley-errors-container="#err_passing_month" data-parsley-required-message="This field is required">
                      <option value="">Passing Month</option>
                      
                        <option @if($arr_data['user_profile']['passing_month']=='jan') selected="" @endif value="jan">Jan</option>
                        <option @if($arr_data['user_profile']['passing_month']=='feb') selected="" @endif value="feb">Feb</option>
                        <option @if($arr_data['user_profile']['passing_month']=='mar') selected="" @endif value="mar">Mar</option>
                        <option @if($arr_data['user_profile']['passing_month']=='apr') selected="" @endif value="apr">Apr</option>
                        <option @if($arr_data['user_profile']['passing_month']=='may') selected="" @endif value="may">May</option>
                        <option @if($arr_data['user_profile']['passing_month']=='jun') selected="" @endif value="jun">Jun</option>
                        <option @if($arr_data['user_profile']['passing_month']=='jul') selected="" @endif value="jul">Jul</option>
                        <option @if($arr_data['user_profile']['passing_month']=='aug') selected="" @endif value="aug">Aug</option>
                        <option @if($arr_data['user_profile']['passing_month']=='sep') selected="" @endif value="sep">Sep</option>
                        <option @if($arr_data['user_profile']['passing_month']=='oct') selected="" @endif value="oct">Oct</option>
                        <option @if($arr_data['user_profile']['passing_month']=='nov') selected="" @endif value="nov">Nov</option>
                        <option @if($arr_data['user_profile']['passing_month']=='dec') selected="" @endif value="dec">Dec</option>
                         
                    </select>
                   <div id="err_passing_month" class="error"></div>
                    <div class="error">{{ $errors->first('passing_month') }}</div>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="select-number">
                                 <select  name="passing_year" required="" data-parsley-errors-container="#err_passing_year" data-parsley-required-message="This field is required">
                      <option value="">Passing Year</option>
                      @for($i=$current_year;$i>=1975;$i--) 
                      <option @if($arr_data['user_profile']['passing_year']==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                        
                    </select>
                      <div id="err_passing_year" class="error"></div>
                        <div class="error">{{ $errors->first('passing_year') }}</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Specialization <span class="star">*</span></label>
                        <div class="select-number">
                            <select   name="specialization_id" data-parsley-required="true" data-parsley-errors-container="#err_specialization" data-parsley-required-message="This field is required">
                            {{-- <option value="">Select Specialization</option> --}}
                            <option value="{{$arr_data['user_profile']['qualification_id']}}">{{$arr_data['user_profile']['specialization']}}</option>
                           </select>


                           <!--  <select   name="specialization_id">
                            {{-- <option value="">Select Specialization</option> --}}
                            <option value="{{$arr_data['user_profile']['qualification_id']}}">{{$arr_data['user_profile']['specialization']}}</option>
                      
                           </select> -->
                         <div id="err_specialization" class="error"></div>
                          <!--  <div class="error">{{ $errors->first('specialization_id') }}</div> -->
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Marks:</label>     
                        <!--inline checkbox-->
                        <div class="row">
                           <div class="col-sm-12 col-md-6 col-lg-6">
                              <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input type="radio" id="Radio1" name="marks_type" type="radio" required="" data-parsley-errors-container="#err_marks_typep" data-parsley-required-message="This field is required"@if($arr_data['user_profile']['marks_type']=='percentage') checked="" @endif value="percentage">
                                    <label for="Radio1">Percentage</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn">
                                    <input type="radio" id="Radio2"  name="marks_type" @if($arr_data['user_profile']['marks_type']=='cgpa') checked="" @endif value="cgpa" >
                                    <label for="Radio2">CGPA(Out of 10)</label>
                                    <div class="check">
                                       <div class="inside"></div>
                                    </div>
                                      
                                 </div>
                              </div>
                              <div id="err_marks_typep" class="error"></div>

                           </div>
                           <!--end-->
                           <div class="col-sm-12 col-md-6 col-lg-6 marks">
                              <div class="form-group">
                                 <label></label>
                                 <input type="text" name="marks_input" id="marks_input" class="input-box-signup" placeholder="Enter Your Marks" value="{{isset($arr_data['user_profile']['marks'])?$arr_data['user_profile']['marks']:'NA'}}" required="" data-parsley-type="integer" data-parsley-errors-container="#err_marks_input" data-parsley-required-message="This field is required" />
                              <!--   <div class="error_msg" id="err_marks_input" style="color:red"></div>
                                <div class="error">{{ $errors->first('marks_input') }}</div> -->
                                 <div class="error" id="err_marks_input"></div>
                                   <div class="error">{{ $errors->first('marks_input') }}</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        

                        <div id="city" class="col-sm-12 form-group">
                              <label>Current Work Location <span class="star">*</span></label>
                           <div class="select-number">
                              <select  id="city_parsely" name="city" data-parsley-required="true" data-parsley-errors-container="#err_city" data-parsley-required-message="This field is required">
                      <option value="">--Select City--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $state)
                        <optgroup label="{{$state['state_name'] or '-'}}">

                        @if(isset($state['city']) && sizeof($state['city'])>0)

                          @foreach($state['city'] as $city)
                          <option 
            @if($arr_data['user_profile']['current_work_location']==$city['city_id']) selected="" @endif value="{{ $city['city_id'] }}">{{ $city['city_name'] or '-' }}</option>  

                          @endforeach
                        @endif  
                        </optgroup>
                          
                        @endforeach
                      @endif
                    </select>
                    <div id="err_city" class="error"></div>
                    <!--  <div class="error">{{ $errors->first('city') }}</div> -->
                           </div>

                        </div>
                        <div id="outside_india" class="col-sm-12" style="display:none;">
                         <div class="row">
                         <div class="col-sm-4">
                          <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number">
                        
                           <select id="country_id" name="country_id" data-parsley-required="true" data-parsley-errors-container="#err_country_id" data-parsley-required-message="This field is required">
                              <option value="">--Select Country--</option>
                              @if(isset($arr_country) && count($arr_country)>0)
                              @foreach($arr_country as $country)
                              <option @if($arr_data['user_profile']['country_id']==$country['id']) selected="" @endif value="{{ $country['id'] }}">{{ $country['country_name'] or '-' }}</option>
                              @endforeach
                              @endif
                           </select>
                           <div id="err_country_id" class="error"></div>

                        </div>
                         </div>
                            </div>
                            <div class="col-sm-4">
                        <div class="form-group">
                           <label>
                              State
                           </label>
                           <input id="other_state" type="text"  class="input-box-signup"  name="other_state" placeholder="Enter your state name here" value="{{ $arr_data['user_profile']['other_state'] or '' }}" data-parsley-required="true" data-parsley-errors-container="#err_other_state" data-parsley-required-message="This field is required"/>
                           <div id="err_other_state" class="error"></div>
                        </div>
                             </div>
                             <div class="col-sm-4">
                        <div class="form-group">
                           <label>
                              City
                           </label>
                           <input id="other_city" type="text"  class="input-box-signup"  name="other_city" placeholder="Enter your city name here" value="{{ $arr_data['user_profile']['other_city'] or '' }}" data-parsley-required="true" data-parsley-errors-container="#err_other_city" data-parsley-required-message="This field is required"/>
                           <div id="err_other_city" class="error"></div>
                        </div>
                             </div>
                      </div> 
                     </div>

                     <div class="check-box col-sm-12">
                        <input @if($arr_data['user_profile']['country_id']!=358) checked=""  onload="locationtype();" @endif onclick="locationtype_click();" value="location" class="css-checkbox" id="radio7" name="location_type" type="checkbox">
                        <label class="css-label radGroup2" for="radio7">Outside India</label>
                        </div>
                      
                     </div>

                     <!--<div class="col-sm-12">
                            <div class="form-group">
                              <label>Job Categories <span class="star">*</span></label>
                              <div class="select-number">
                               <select  name="category_id" id="category_id" required="" data-parsley-errors-container="#err_category_id" data-parsley-required-message="This field is required">
                                <option value="">--Select Category--</option>
                                @if(isset($arr_category) && count($arr_category)>0)
                                  @foreach($arr_category as $category)
                                  <option @if($arr_data['user_profile']['category_id']==$category['id']) selected="" @endif value="{{ $category['id'] }}">{{ $category['category_name'] or '-' }}</option>
                                  @endforeach
                                  @endif  
                              </select>
                                <div id="err_category_id" class="error"></div>
                                <div class="error">{{ $errors->first('category_id') }}</div>
                           </div>
                         </div>
                        </div>-->
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                        <label>Birth Date <span class="star">*</span></label>
                           @if(isset($birth_date) && $birth_date!='')
                          <input id="birth_date" name="birth_date" type="text" class="input-box-signup" readonly="readonly"  
                         value="{{$birth_date}}" />
                          @endif
                     </div>
                          </div>
                          <div class="col-sm-6">                          
                              <div class="form-group">
<!--                        <div class="row">-->
<!--                           <div class="col-sm-12 col-md-3 col-lg-1">-->
                              <div class="form-lable">Gender: </div>
<!--                           </div>-->
<!--                           <div class="col-sm-12 col-md-9 col-lg-11">-->
<!--                              <div class="radio-btns">-->
                                 @if($arr_data['gender']=='M') 
                          <input type="text" class="input-box-signup" readonly="readonly"  
                         value="Male" />
                         @else 
                         <input type="text" class="input-box-signup" readonly="readonly"  
                         value="Female" />
                          @endif
<!--                              </div>-->
<!--                           </div>-->
                           <div class="clearfix"></div>
<!--                        </div>-->
                         <div id="err_gender" class="error"></div>
                          <div class="error">{{ $errors->first('gender') }}</div>
                     </div>
                          </div>
                      </div>
                     <!--end-->
                      @endif
                      <input type="hidden" name="enc_id" value="{{$enc_id or '-'}}">
                     <div class="btn-wrapper">
                       
                        <button type="reset" class="cancel-btn" value="reset">Cancel</button>
                        <button type="submit" value="submit" class="submit-btn">Update Profile</button>
                       
                     </div>
                  </div>

                 

                </div>
               </div>
               </form>
               
            </div>
         </div>
      </div>

 <!-- <script type="text/javascript">
   $("#frm_edit_profile").validate({
         errorElement: 'div',
         errorClass: 'error',
         highlight: function (element) {
             $(element).removeClass('error');
         }
   });
   
   
</script> -->
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
     function markstype()
     {
        var value_markstype = $("input[name='marks_type']:checked").val();
     //  alert(value_cardtype);
        var value_marks = $('#marks_input').val();
        if(value_markstype=='percentage')
        {
          if(value_marks<30 || value_marks>100 )
          {
            $('#err_marks_input').html('Percentage value must be between 30 to 100.');
            return false;
          } 
        }
        if(value_markstype=='cgpa')
        {
          if(value_marks<1 || value_marks>10 )
          {
            $('#err_marks_input').html('CGPA value must be between 1 to 10.');
            return false;
          }  
        }
     }
$(document).ready(function(locationtype){
     /*function locationtype()
     {*/
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
     /*}*/
   }); 
   
   function locationtype_click()
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
          $('#other_city').val('');
          $('#country_id').val('');

          $('#city_parsely').attr('data-parsley-required', 'true');
          $('#country_id').attr('data-parsley-required', 'false');
          $('#other_city').attr('data-parsley-required', 'false');
          $('#other_state').attr('data-parsley-required', 'false');
        }
     } 
</script>

      <script type="text/javascript">
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

  </script>

  <script type="text/javascript">
    
     function readURL(input) {
     // alert('this is alert');
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          //alert(reader);
          reader.onload = function (e) {
              $('#upload-f').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
      }
  }
  
  $("#image_proof").change(function(){
      readURL(this);
  });
    
  </script>
@endsection    
