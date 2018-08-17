<style>
    .seditpersonal_01{padding:0px}
.seditpersonal_02{width: 95.8%; border: 1px solid #fff;}
.seditpersonal_03{width: 100.8%; border: 1px solid #fff;}
.seditpersonal_04{display:none}
.seditpersonal_05{clear:both}
</style>

<form class="" id="editpersonal_save" method="POST" enctype="multipart/form-data"   data-parsley-validate>
                 {{ csrf_field() }}
                 				 						
					<div class="row">
					    
					    
                        <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                           <div class="form-group">
                              <label>First Name <span class="star">*</span></label>
                              <input type="text" name="first_name"  value="{{@$UserDetails->first_name}}" class="input-box-signup" placeholder="Enter Your First Name" required="" pattern="[A-Za-z]+">
                           
                           </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 last-name">
                           <div class="form-group">
                              <label>Last Name <span class="star">*</span></label>
                              <input type="text" name="last_name"  value="{{@$UserDetails->last_name}}" class="input-box-signup" placeholder="Enter Your Last Name" required="" pattern="[A-Za-z]+">
                          
                           </div>
                        </div>
                      
				 
				  
                      
                       
                        
                        
                         <div class="col-sm-12 col-md-12 col-lg-12 first-name">
                        
                        <div id="form-group">
             <div class="col-sm-4 selectclasss seditpersonal_01"> 
             <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number seditpersonal_02" >
                       

                                <input type="text" class="input-box-signup keypressit" id="country_id" name="country_ids" value="{{@$countryDetails->country_name}}" required autocomplete="off">

<div class="auto-search-box">
  
<div class="auto-search-boxul"></div>

</div>

                            <div id="err_country_id" class="error"></div>
                        </div>
                        </div>
                        </div>
            <div class="col-sm-4 seditpersonal_01">
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
               <div class="select-number seditpersonal_02">
                          
                            <input type="text" name="state_ids" class="input-box-signup keystate"  value="{{@$stateDetails->state_name}}" required autocomplete="off">


                            <div class="auto-search-box-state"></div>

 
                            
                             <input type="hidden" class="country_id" name="country_id" autocomplete="off" value="{{@$memberdetailsDetails->education_country_id}}">
                            
                            
                            
               </div>
             
                        </div>
                        </div>
            <div class="col-sm-4 seditpersonal_01" >
                        <div class="form-group">
                           <label>
                              City
                           </label>
               <div class="select-number" >
                           

     <input type="text" class="input-box-signup keycity" name="city_ids" value="{{@$cityDetails->city_name}}"  autocomplete="off">

      <div class="auto-search-box-city"></div>

  <input type="hidden" class="state_id" name="state_id" autocomplete="off" value="{{@$memberdetailsDetails->education_state}}" >
  <input type="hidden" class="city_id" name="city_id" autocomplete="off" value="{{@$memberdetailsDetails->education_city}}">
  
  
 

               </div>
               <div id="err_city_id" class="error"></div>
                        </div>
                        </div>
                        
         </div>
         
         
         
         </div>
                        
                        
                        
                        <div class="col-xs-2 col-sm-2 col-md-2 mumber-box-left mobilecodesss seditpersonal_04">
                            <div class="form-group">
                              <label>Code<span class="star">*</span></label>
                      <input type="text" name="mobile_code" id="mobile_code" class="input-box-signup mobilecodesssm" value="{{@$UserDetails->mobile_code}}" required readonly="" autocomplete="off">
                            </div>
                     </div>
                     
                     
                     
                    
                        
                        
				     
                        
                        
                          <div class="col-sm-12 col-md-12 col-lg-12 last-name">
                        
                        <div class="form-groupn seditpersonal_05">
					<label>Job Title/Headline<span class="star">*</span></label>
					<input type="text" name="headline" data-rule-lettersonly="true" value="{{@$memberdetailsDetails->headline}}"  class="input-box-signup" placeholder="Enter Headline" required="">
					  
				 </div>
				 </div>
				 
				 
				 
                       
                     
                      <div class="col-sm-12 col-md-12 col-lg-12 last-name">
                     <div class="form-group">
                        <label>Experience  Summary <span class="star">*</span></label>
                        <textarea name="designation" class="form-area" cols="30" rows="5" placeholder="About You" required="">{{@$memberdetailsDetails->designation}}</textarea>
                           
				 </div>
				  </div>
                     
                     
				  <div class="clearfix"></div>
				

             
               <input type="hidden" value="{{@$memberdetailsDetails->id}}" name="enc_id">
               
               
                              <input type="hidden" value="{{@$UserDetails->id}}" name="uenc_id">
               
               
               
               <div class="btn-wrapper text-center" >
                 
                  <button type="submit" class="submit-btn">Save</button>
               </div> </div>	
               </form>