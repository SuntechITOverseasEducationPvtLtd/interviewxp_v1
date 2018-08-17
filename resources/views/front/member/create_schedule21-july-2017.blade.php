
<div id="member-header" class="after-login"></div>
	
	<div class="container-fluid fix-left-bar">
      <div class="row">
         <div class="col-sm-8 col-md-9 col-lg-10">
           <div class="right-section-member">
             <div class="col-sm-12 col-md-10 form-wrapper">                  
           
          
           <div class="member-myProfile-form">

           <form class="" id="frm_schedule" method="POST" action="{{url('/')}}/member/store_schedule" data-parsley-validate>                        
           {{ csrf_field() }}
           
           <div class="form-group">
              <div class="duration">
                 <div class="row">
                    
                    <div id="specialization_div" class="col-sm-12">
                          <input type="hidden" name="skills" id="skills" value="{{ isset($skill_id)?$skill_id:'' }}" />
                          <input type="hidden" name="id" id="id" value="" />
                    </div>
                  
                 </div>
              </div>
           </div>     


           
            <div class="form-group">
                  <label>Date<span class="star">*</span></label>
                  
                  <input type="text" name="date" id="date_{{ $key }}" class="input-box-signup datepicker" placeholder="Select Date" value="" required="" data-parsley-errors-container="#err_date" data-parsley-required-message="This field is required" readonly="readonly" />
                  
                         <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                    <div id="err_date" class="error err_date"></div> 
                     <div class="error">{{ $errors->first('date') }}</div>     
            </div>
            <div class="row">
              <div class="form-group col-sm-4">
                    <label>Time From:<span class="star">*</span></label>
                    <input type="text" name="start_time" id="start_time_{{ $key }}" class="input-box-signup startTimepicker" placeholder="Select Start Time" value="" required="" data-parsley-errors-container="#err_start_time" data-parsley-required-message="This field is required" readonly="readonly" />                    
                    <div id="err_start_time" class="error err_start_time"></div> 
                    <div class="error">{{ $errors->first('start_time') }}</div>     
              </div>
              <div class="form-group col-sm-4">
                    <label>To:<span class="star">*</span></label>
                    <input type="text" name="end_time" id="end_time_{{ $key }}" class="input-box-signup endTimepicker" placeholder="Select End Time" value="" required="" data-parsley-errors-container="#err_end_time" data-parsley-required-message="This field is required" readonly="readonly" /> 
                           <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                    <div id="err_end_time" class="error err_end_time"></div> 
                    <div class="error">{{ $errors->first('end_time') }}</div>     
              </div>
              <div class="form-group col-sm-4">
                  <label>Max Allowed<span class="star">*</span></label>                       
                  <input type="text" name="max_allowed" id="max_allowed" class="form-control" value="15" />     
            </div> 
            </div>
            
               <div class="btn-wrapper">
                  <input type="hidden"  name="enc_id" value="{{$enc_id or ''}}">
                  <span class="submit-btn" id="closeSchedule">Cancel</span>
                  <button type="submit" class="submit-btn">Submit</button>

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
