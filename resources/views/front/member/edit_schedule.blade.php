@extends('front.layout.main')
@section('middle_content')
<div id="member-header" class="after-login"></div>
	<div class="banner-member">
	   <div class="pattern-member">
	   </div>
	</div>
	 
	<div class="container-fluid fix-left-bar">
      <div class="row">
        @include('front.member.member_sidebar')
         <div class="col-sm-8 col-md-9 col-lg-10">
          
            <h2 class="schedule">Update Schedule</h2>
           
            <div class="right-section-member">
             <div class="col-sm-12 col-md-10 form-wrapper">                  
           
          
           <div class="member-myProfile-form">

           <form class="" id="frm_schedule_class" method="POST" action="{{url('/')}}/member/update_schedule" data-parsley-validate>                        
           {{ csrf_field() }}
           @include('admin.layout._operation_status')
           <div class="form-group">
                  <label>Topics<span class="star">*</span></label>

                  <div class="duration">
                     <div class="row">
                        
                        <div id="specialization_div" class="col-sm-12">
                           <div class="select-number">
                              <input type="hidden" name="id" id="id" value="{{isset($arr_schedule['id'])?$arr_schedule['id']:''}}" />
                              <select id="skills" name="skills" data-parsley-required="true" data-parsley-errors-container="#err_skills" data-parsley-required-message="This field is required">
                              @if(isset($arrMemberDetails) && count($arrMemberDetails)>0)
                              @foreach($arrMemberDetails as $value)
                              <option value="{{$value['skill_id']}}" {{($value['skill_id'] == $arr_schedule['skill_id'])?'selected="selected"':'NA'}}>{{$value['skill_name']}} Real Time Interview Questions & Answers</option>
                              @endforeach
                              @endif
                              
                            </select>
                             
                           </div>
                        </div>
                      
                     </div>
                  </div>
               </div>     


           
            <div class="form-group">
                  <label>Date<span class="star">*</span></label>
                  
                  <input type="text" name="date" id="date" class="input-box-signup datepicker" placeholder="Select Date" value="{{isset($arr_schedule['date'])?$arr_schedule['date']:''}}" required="" data-parsley-errors-container="#err_date" data-parsley-required-message="This field is required" readonly="readonly" />
                  
                         <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                    <div id="err_date" class="error"></div> 
                     <div class="error">{{ $errors->first('date') }}</div>     
            </div>
            <div class="row">
              <div class="form-group col-sm-4">
                    <label>Time From:<span class="star">*</span></label>
                    <input type="text" name="start_time" id="start_time" class="input-box-signup timepicker" placeholder="Select Start Time" value="{{isset($arr_schedule['start_time'])?$arr_schedule['start_time']:''}}" required="" data-parsley-errors-container="#err_start_time" data-parsley-required-message="This field is required" readonly="readonly" />                    
                    <div id="err_start_time" class="error"></div> 
                    <div class="error">{{ $errors->first('start_time') }}</div>     
              </div>
              <div class="form-group col-sm-4">
                    <label>To:<span class="star">*</span></label>
                    <input type="text" name="end_time" id="end_time" class="input-box-signup timepicker" placeholder="Select End Time" value="{{isset($arr_schedule['end_time'])?$arr_schedule['end_time']:''}}" required="" data-parsley-errors-container="#err_end_time" data-parsley-required-message="This field is required" readonly="readonly" /> 
                           <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                    <div id="err_end_time" class="error"></div> 
                    <div class="error">{{ $errors->first('end_time') }}</div>     
              </div>
              <div class="form-group col-sm-4">
                  <label>Max Allowed<span class="star">*</span></label>                       
                  <input type="text" name="max_allowed" id="max_allowed" class="form-control" value="{{isset($arr_schedule['max_allowed'])?$arr_schedule['max_allowed']:''}}" />     
            </div> 
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
@endsection