<form class="" id="edit_pro_savepro" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/update_employment" data-parsley-validate>
                 {{ csrf_field() }}
                 				 						
					<div class="row">
					    
					    
                     
                      
				 
				 
				         <div class="col-sm-6 col-md-6 col-lg-6 first-name">
                           <div class="form-group">
                              <label>Email <span class="star">*</span></label>
                              <input type="email"  readonly   value="{{@$UserDetails->email}}" class="input-box-signup" placeholder="Enter Your Email" required="" pattern="[A-Za-z]+">
                           
                           </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6 col-lg-6 first-name">

                              <label>DOB <span class="star">*</span></label>
                              <input type="date" name="dob" data-rule-required="true" data-rule-lettersonly="true" value="{{@$UserDetails->birth_date}}"  class="input-box-signup"  required="" >
                          
                           </div>
                       
                        
                        
                       	  <div class="clearfix"></div>
                        
                        
                        <div class="col-xs-2 col-sm-2 col-md-2 mumber-box-left mobilecodesss">
                            <div class="form-group">
                              <label>Code<span class="star">*</span></label>
                      <input type="text" name="mobile_code"  id="mobile_code" class="input-box-signup mobilecodesssm" value="{{@$UserDetails->mobile_code}}" required readonly="" autocomplete="off">
                            </div>
                     </div>
                     
                     
                     
                        <div class="col-sm-5 col-md-5 col-lg-5 last-name">
                           <div class="form-group">
                              <label>Phone No. <span class="star">*</span></label>
                              <input type="text" name="phoneno" value="{{@$UserDetails->mobile_no}}"  class="input-box-signup" placeholder="Enter Your Phone No." required="" pattern="[0-9]*" maxlength="10" minlength="10" >
                           
                           </div>
                        </div>
                        
                        
                        
                        
				        
                        <div class="col-sm-5 col-md-5 col-lg-5 last-name">
                           <div class="form-group">
                              <label>Gender <span class="star">*</span></label>
                              
                              <?php if(isset($UserDetails->gender) && $UserDetails->gender=='M') { $select="selected"; }  else { $selects="selected"; }  ?>
                              
                              <select name="gender" required=""   class="input-box-signup">
              
                       
                      <option value="M" {{@$select}}> Male</option>
                        <option value="F" {{@$selects}}> Female</option>
                      
                      </select>
                   
                           </div>
                        </div>
                        
                        
                        
                       	  <div class="clearfix"></div>
				 
				 
                        
                          <div class="col-sm-12 col-md-12 col-lg-12 last-name">
                           <div class="form-group">
                              <label>Pan Card <span class="star">*</span></label>
                              <input type="text" name="pancard" value="{{@$memberdetailsDetails->pan_no}}" class="input-box-signup" placeholder="Enter Your PAN NO." required="" data-parsley-pattern="[A-Za-z]{5}\d{4}[A-Za-z]{1}" >
                           
                           </div>
                        </div>
                    
                   
                     
				  <div class="clearfix"></div>
				

             
               <input type="hidden" value="{{@$memberdetailsDetails->id}}" name="enc_id">
               
               
                              <input type="hidden" value="{{@$UserDetails->id}}" name="uenc_id">
               
               
               
               <div class="btn-wrapper text-center" >
                 
                  <button type="submit" class="submit-btn">Save</button>
               </div> </div>	
               </form>