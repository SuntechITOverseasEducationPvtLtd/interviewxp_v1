<style>
    .seditemplyeement_01{clear:both}
.seditemplyeement_02{padding:0px}
.seditemplyeement_03{width: 95.8%; border: 1px solid #fff;}
.seditemplyeement_04{width: 100.8%; border: 1px solid #fff; }
.seditemplyeement_05{height: 60px;}
</style>


<form class="" id="editemplyeement_save" method="POST" enctype="multipart/form-data"   data-parsley-validate>
                 {{ csrf_field() }}
                 				 	 <?php $current_year = date('Y'); ?>					
					<div class="row">
					    
				<div class="col-sm-12 col-md-12 col-lg-12 first-name">	    
                        
    <div class="form-group seditemplyeement_01" >
        <label>Designation<span class="star">*</span></label>
        <input type="text"   class="input-box-signup" placeholder="Enter Your Designation" name="current_designation" value="{{@$employer_typeDetails->designation}}" required >
        <div id="err_previous_designation0" class="error"></div>
        <div class="error"></div>
    </div>
    <div class="form-group">
        <label>Company Name<span class="star">*</span></label>
        <input   type="text" class="input-box-signup" name="company_name" requiredplaceholder="Enter Name Of Your Employer" required placeholder="Enter Name Of Your Employer" value="{{@$employer_typeDetails->company_name}}">
      
    </div>
    <div class="form-group">
        
        
        
        <?php if(isset($employer_typeDetails->display_company) && !empty($employer_typeDetails->display_company)) {  $checked='checked';}  else { $checked=''; } ?>
        <input id="display_company" type="checkbox" name="display_company" value="Confidential" {{@$checked}}>&nbsp;&nbsp;<span>Confidential</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input id="display_company" type="checkbox" name="display_company"  value="MNC">&nbsp;&nbsp;<span>MNC</span></div>
    
                  
                        
                        <div id="form-group">
             <div class="col-sm-4 selectclasss seditemplyeement_02" > 
             <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number seditemplyeement_03" >
                       

                                <input type="text" class="input-box-signup keypressit" id="country_id" name="country_ids" value="{{@$countryDetails->country_name}}" required autocomplete="off">

<div class="auto-search-box">
  
<div class="auto-search-boxul"></div>

</div>

                            <div id="err_country_id" class="error"></div>
                        </div>
                        </div>
                        </div>
            <div class="col-sm-4 seditemplyeement_02" >
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
               <div class="select-number seditemplyeement_03">
                          
                            <input type="text" name="state_ids" class="input-box-signup keystate"  value="{{@$stateDetails->state_name}}" required autocomplete="off">


                            <div class="auto-search-box-state"></div>

 
                            
                             <input type="hidden" class="country_id" name="country_id" autocomplete="off" value="{{@$countryDetails->id}}">
                            
                            
                            
               </div>
             
                        </div>
                        </div>
            <div class="col-sm-4 seditemplyeement_02" >
                        <div class="form-group">
                           <label>
                              City
                           </label>
               <div class="select-number seditemplyeement_04">
                           

     <input type="text" class="input-box-signup keycity" name="city_ids" value="{{@$cityDetails->city_name}}"  autocomplete="off">

      <div class="auto-search-box-city"></div>

  <input type="hidden" class="state_id" name="state_id" autocomplete="off" value="{{@$stateDetails->id}}" >
  <input type="hidden" class="city_id" name="city_id" autocomplete="off" value="{{@$cityDetails->city_id}}">
  
  
 

               </div>
               <div id="err_city_id" class="error"></div>
                        </div>
                        </div>
                        
    
          
    </div>
    <div class="form-group seditemplyeement_01" >
        <label>Duration<span class="star">*</span></label>
        <div class="duration">
            <div class="row">
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="start_monthrequired" required class="input-box-signup">
                            
                           
                            
                            <option value="">Month</option>
                            
                        
                                    <option @if($employer_typeDetails->start_month==1) selected="" @endif value="01">Jan</option>
                                    <option @if($employer_typeDetails->start_month==2) selected="" @endif value="02">Feb</option>
                                    <option @if($employer_typeDetails->start_month==3) selected="" @endif value="03">Mar</option>
                                    <option @if($employer_typeDetails->start_month==4) selected="" @endif value="04">Apr</option>
                                    <option @if($employer_typeDetails->start_month==5) selected="" @endif value="05">May</option>
                                    <option @if($employer_typeDetails->start_month==6) selected="" @endif value="06">Jun</option>
                                    <option @if($employer_typeDetails->start_month==7) selected="" @endif value="07">Jul</option>
                                    <option @if($employer_typeDetails->start_month==8) selected="" @endif value="08">Aug</option>
                                    <option @if($employer_typeDetails->start_month==9) selected="" @endif value="09">Sep</option>
                                    <option @if($employer_typeDetails->start_month==10) selected="" @endif value="10">Oct</option>
                                    <option @if($employer_typeDetails->start_month==11) selected="" @endif value="11">Nov</option>
                                    <option @if($employer_typeDetails->start_month==12) selected="" @endif value="12">Dec</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="start_year" required class="input-box-signup">
                            <option value="">Year</option>
                           @for($i=$current_year;$i>=1975;$i--) 
                                    <option @if($employer_typeDetails->start_year==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                                    @endfor
                        </select>
                    
                    </div>
                </div>
                <div class="duration-to">To</div>
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="end_month"required class="input-box-signup">
                            <option value="">Month</option>
                            
                        <option @if($employer_typeDetails->employer_type=='current') selected="" @endif value="present">Present</option>
                        
                        
                                    <option @if($employer_typeDetails->end_month==1) selected="" @endif value="01">Jan</option>
                                    <option @if($employer_typeDetails->end_month==2) selected="" @endif value="02">Feb</option>
                                    <option @if($employer_typeDetails->end_month==3) selected="" @endif value="03">Mar</option>
                                    <option @if($employer_typeDetails->end_month==4) selected="" @endif value="04">Apr</option>
                                    <option @if($employer_typeDetails->end_month==5) selected="" @endif value="05">May</option>
                                    <option @if($employer_typeDetails->end_month==6) selected="" @endif value="06">Jun</option>
                                    <option @if($employer_typeDetails->end_month==7) selected="" @endif value="07">Jul</option>
                                    <option @if($employer_typeDetails->end_month==8) selected="" @endif value="08">Aug</option>
                                    <option @if($employer_typeDetails->end_month==9) selected="" @endif value="09">Sep</option>
                                    <option @if($employer_typeDetails->end_month==10) selected="" @endif value="10">Oct</option>
                                    <option @if($employer_typeDetails->end_month==11) selected="" @endif value="11">Nov</option>
                                    <option @if($employer_typeDetails->end_month==12) selected="" @endif value="12">Dec</option>
                                    
                                    
                                    
                        </select>
                     
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="end_year" required class="input-box-signup">
                            <option value="">Year</option>
                                                <option @if($employer_typeDetails->employer_type=='current') selected="" @endif value="present">Present</option>
                          <option value="">Year</option>
                           @for($i=$current_year;$i>=1975;$i--) 
                                    <option @if($employer_typeDetails->end_year==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                                    @endfor
                        </select>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Job Responsibilities<span class="star">*</span></label>
        <textarea    placeholder="Enter Your Designation Summary" name="description"  class="input-box-signup seditemplyeement_05" required rows="3">{{@$employer_typeDetails->description}}</textarea>
    
    </div>
  		 
				  
                      
 
               
               
               
               <div class="btn-wrapper text-center">
                  <input type="hidden" value="{{@$empyid}}" name="enc_id">
                  <button type="submit" class="submit-btn">Save</button>
               </div> </div>  </div>	
               </form>