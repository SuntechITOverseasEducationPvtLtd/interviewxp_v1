
<div id="member-header" class="after-login"></div>	
	 
	<div class="container-fluid fix-left-bar">
      <div class="row">
        
         <div class="col-sm-8 col-md-9 col-lg-10">
          
            <div class="right-section-member">
             <div class="col-sm-12 col-md-10 form-wrapper">                  
           
          
           <div class="curriculam-form ">

           <form class="" id="frm_curriculam" method="POST" action="{{url('/')}}/member/store_curriculam" data-parsley-validate>                        
           {{ csrf_field() }}
           
           <div class="form-group">
                  <div class="duration">
                     <div class="row">                        
                        <div id="specialization_div" class="col-sm-12">
                           <input type="hidden" name="skills" id="skills" value="" />
                           <input type="hidden" name="id" id="id" value="" />
                        </div>
                      
                     </div>
                  </div>
               </div>     


           
            <div class="form-group">
                  <label>Title<span class="star">*</span></label>
                  <input type="text" name="title" id="title" class="input-box-signup" placeholder="Enter Title" value="{{isset($arr_data['title'])?$arr_data['title']:''}}" required="" data-parsley-errors-container="#err_title" data-parsley-required-message="This field is required"/>
                         <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                    <div id="err_title" class="error err_title"></div> 
                     <div class="error">{{ $errors->first('marks_input') }}</div>     
            </div>
               
               
            <div class="form-group">
                  <label>Description<span class="star">*</span></label>                        
                  <textarea name="description" id="description" class="form-area" data-rule-required="true" cols="30" rows="5" placeholder="Enter Description" required="" data-parsley-errors-container="#err_description" data-parsley-required-message="This field is required"></textarea>
                  <div id="err_description" class="error err_description"></div>   
                  <div class="error">{{ $errors->first('pan_no') }}</div>     
            </div>   

                
               <div class="btn-wrapper">
                  <input type="hidden"  name="enc_id" value="{{$enc_id or ''}}">
                  <span class="submit-btn" id="closeCurriculam">Cancel</span>
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
