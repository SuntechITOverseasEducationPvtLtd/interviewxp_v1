@extends('front.layout.main')
@section('middle_content')
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
                
                     <h2 class="my-profile">My Profile</h2>
                 
                  <div class="right-section-member">
                   <div class="col-sm-12 col-md-10 form-wrapper">
                   
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
                           <div class="bg_i2">&nbsp;</div>
                           <div class="step_process border-line">
                              <div class="active-step step_bor">
                                 <div class="active_step normal_step">2</div>
                              </div>
                              <div class="plan-detail left2">
                                 <div class="active step_title">Employment</div>
                              </div>
                           </div>
                           <div class="bg_i2">&nbsp; </div>
                           <div class="step_process">
                              <div class="active-step step_bor">
                                 <div class="active_step normal_step">3</div>
                              </div>
                              <div class="plan-detail left3">
                                 <div class="active step_title">Education</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--end-->
                
                 <div class="member-myProfile-form">

                 <form class="" id="frm_edit_education" method="POST" action="{{url('/')}}/member/update_education" data-parsley-validate>                        
                 {{ csrf_field() }}
                @include('admin.layout._operation_status')
                 <div class="form-group">
                        <label>Highest Qualification<span class="star">*</span></label>

                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="select-number">
                                    <select class="form-control"  name="qualification_id" required=""
                           data-parsley-errors-container="#err_high_quali" data-parsley-required-message="This field is required" id="qualification_id" onclick="loadSpecialization(this);"  >
                                  <option value="">--Select Qualification--</option>
                                  @if(isset($arr_qualification) && count($arr_qualification)>0)
                                    @foreach($arr_qualification as $qualification)
                                    <option @if($arr_data['qualification_id']==$qualification['id']) selected="" @endif value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                                    @endforeach
                                    @endif  
                                 </select>
                                 <div id="err_high_quali" class="error"></div>
                               <div class="error">{{ $errors->first('qualification_id') }}</div>  
                                 </div>
                              </div>
                              <div id="specialization_div" class="col-sm-6">
                                 <div class="select-number">
                                    <select id="specialization" name="specialization_id" data-parsley-required="true" data-parsley-errors-container="#err_specialization" data-parsley-required-message="This field is required">
                                    {{-- <option value="">Select Specialization</option> --}}
                                    <option value="{{$arr_data['qualification_id']}}">{{$arr_data['specialization']}}</option>
                                    
                                  </select>
                                    <div id="err_specialization" class="error"></div>
                                <!--    <select id="specialization" name="specialization_id">
                                    {{-- <option value="">Select Specialization</option> --}}
                                    <option value="{{$arr_data['qualification_id']}}">{{$arr_data['specialization']}}</option>
                                    
                                  </select> -->
                                 </div>
                              </div>
                            
                           </div>
                        </div>
                     </div>
         
                      <div class="form-group">

                      
                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="select-number">

                                    <select   name="passing_month" required=""
                           data-parsley-errors-container="#err_pass_month" data-parsley-required-message="This field is required">
                      <option value="">Passing Month</option>
                      
                        <option @if($arr_data['passing_month']=='jan') selected="" @endif value="jan">Jan</option>
                        <option @if($arr_data['passing_month']=='feb') selected="" @endif value="feb">Feb</option>
                        <option @if($arr_data['passing_month']=='mar') selected="" @endif value="mar">Mar</option>
                        <option @if($arr_data['passing_month']=='apr') selected="" @endif value="apr">Apr</option>
                        <option @if($arr_data['passing_month']=='may') selected="" @endif value="may">May</option>
                        <option @if($arr_data['passing_month']=='jun') selected="" @endif value="jun">Jun</option>
                        <option @if($arr_data['passing_month']=='jul') selected="" @endif value="jul">Jul</option>
                        <option @if($arr_data['passing_month']=='aug') selected="" @endif value="aug">Aug</option>
                        <option @if($arr_data['passing_month']=='sep') selected="" @endif value="sep">Sep</option>
                        <option @if($arr_data['passing_month']=='oct') selected="" @endif value="oct">Oct</option>
                        <option @if($arr_data['passing_month']=='nov') selected="" @endif value="nov">Nov</option>
                        <option @if($arr_data['passing_month']=='dec') selected="" @endif value="dec">Dec</option>
                         
                    </select>
                      <div id="err_pass_month" class="error"></div>
                      <?php $current_year = date('Y'); ?>
                      <div class="error">{{ $errors->first('passing_month') }}</div>   
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="select-number">
                                    <select  name="passing_year" required=""
                           data-parsley-errors-container="#err_pass_year" data-parsley-required-message="This field is required">
                      <option value="">Passing Year</option>
                      @for($i=$current_year;$i>=1992;$i--) 
                      <option @if($arr_data['passing_year']==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                    <div id="err_pass_year" class="error"></div>
                    <div class="error">{{ $errors->first('passing_year') }}</div>    
                                 </div>
                              </div>
                             
                         
                           </div>
                        </div>
                     </div>
                  <!--inline Radio button-->
                 <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12 col-md-3 col-lg-2">
                              <div class="form-lable">Marks<span class="star">*</span></div>
                           </div>
                           <div class="col-sm-12 col-md-9 col-lg-10">
                              <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input type="radio" id="Radio1" name="marks_type" @if($arr_data['marks_type']=='percentage') checked="" @endif value="percentage" required=""
                           data-parsley-errors-container="#err_marks" data-parsley-required-message="This field is required">

                                    <label for="Radio1">Percentage</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn">

                                    <input type="radio" id="Radio2" name="marks_type" @if($arr_data['marks_type']=='cgpa') checked="" @endif value="cgpa" >
                                    <label for="Radio2">CGPA(Out of 10)</label>
                                    <div class="check">
                                       <div class="inside"></div>
                                    </div>
                                 </div>

                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                      <div id="err_marks" class="error"></div>
                      <div class="error">{{ $errors->first('marks_type') }}</div> 
                     <!--end-->
                 
                  <div class="form-group">
                        
                        <input type="text" name="marks_input" id="marks_input" class="input-box-signup" placeholder="Marks" value="{{isset($arr_data['marks'])?$arr_data['marks']:'NA'}}" required="" data-parsley-errors-container="#err_marks_input" data-parsley-required-message="This field is required"/>
                               <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                          <div id="err_marks_input" class="error"></div> 
                           <div class="error">{{ $errors->first('marks_input') }}</div>     
                  </div>
                     
                     
                  <div class="form-group">
                        <label>PAN No.<span class="star">*</span></label>
                        <input type="text" name="pan_no" readonly=""  class="input-box-signup" placeholder="Enter pan no" value="{{isset($arr_data['pan_no'])?$arr_data['pan_no']:'NA'}}" required="" data-parsley-errors-container="#err_pan_no" data-parsley-required-message="This field is required"/>
                        <!--div class="error">Email is not Valid</div-->
                        <div id="err_pan_no" class="error"></div>   
                        <div class="error">{{ $errors->first('pan_no') }}</div>     
                  </div>   

                     <div class="clearfix"></div>
                   <div class="form-group">
                        <label>Social Network</label>
                        <div class="row">
                           <div class="col-sm-12">
                              <input type="text" name="facebook"  class="input-box-signup scocial-site" placeholder="Facebook" value="{{isset($arr_data['facebook'])?$arr_data['facebook']:'NA'}}" />
                           </div>
                           <div class="col-sm-12">
                              <input type="text" name="linkedin"  class="input-box-signup scocial-site" placeholder="Linkedin" value="{{isset($arr_data['linkedin'])?$arr_data['linkedin']:'NA'}}" />
                           </div>
                           <div class="col-sm-12">
                              <input type="text" name="twitter"  class="input-box-signup scocial-site" placeholder="Twitter" value="{{isset($arr_data['twitter'])?$arr_data['twitter']:'NA'}}" />
                           </div>
                        </div>
                     </div> 
                     
                    <div class="form-group">
                        <label>Tell us about your skill set<span class="star">*</span></label>
                        <textarea name="about_member" class="form-area" data-rule-required="true" cols="30" rows="5" placeholder="About You" required="" data-parsley-errors-container="#err_about_member" data-parsley-required-message="This field is required">{{isset($arr_data['about_member'])?$arr_data['about_member']:'NA'}}</textarea>
                        <div id="err_about_member" class="error"></div>
                         <div class="error">{{ $errors->first('about_member') }}</div>  
                    </div>                        
                     <div class="btn-wrapper">
                        <input type="hidden"  name="enc_id" value="{{$enc_id or ''}}">
                        <button type="submit" class="submit-btn">Update</button>

                     </div>
                     </form>
                  </div>
                </div>
                 </div>
                 
                   </div>
                </div>
                
               </div>
            </div>
         </div>        
          </div>
       </div> 
     </div>

<!-- <script type="text/javascript">
   $("#frm_edit_education").validate({
         errorElement: 'div',
         errorClass: 'error',
         highlight: function (element) {
             $(element).removeClass('error');
         }
   });
   
</script> -->

<script>
 

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
                              var option = '<option value="">No Specialization</option>'; 
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
          $('#other_state').val('');
          $('#city_parsely').attr('data-parsley-required', 'true');
           $('#country_id').attr('data-parsley-required', 'false');
           $('#other_city').attr('data-parsley-required', 'false');
           $('#other_state').attr('data-parsley-required', 'false');
        }
     }
  </script> 

    
  @endsection  
