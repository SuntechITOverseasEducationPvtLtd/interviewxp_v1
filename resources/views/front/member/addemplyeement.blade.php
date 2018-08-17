<style>
    .semplyeement_01{clear:both}
.semplyeement_02{padding:0px}
.semplyeement_03{width: 95.8%; border: 1px solid #fff; }
.semplyeement_04{width: 100.8%; border: 1px solid #fff;}
.semplyeement_05{height: 60px;}
.semplyeement_06{text-align:center}
</style>

<form class="" id="addemplyeement_save" method="POST" enctype="multipart/form-data"   data-parsley-validate>
                 {{ csrf_field() }}
                 				 						
					<div class="row">
					    
				<div class="col-sm-12 col-md-12 col-lg-12 first-name">	    
                        
    <div class="form-group semplyeement_01" >
        <label>Designation<span class="star">*</span></label>
        <input type="text"   class="input-box-signup" placeholder="Enter Your Designation" name="current_designation" required >
        <div id="err_previous_designation0" class="error"></div>
        <div class="error"></div>
    </div>
    <div class="form-group">
        <label>Company Name<span class="star">*</span></label>
        <input   type="text" class="input-box-signup" name="company_name" requiredplaceholder="Enter Name Of Your Employer" required placeholder="Enter Name Of Your Employer">
      
    </div>
    <div class="form-group">
        <input id="display_company" type="checkbox" name="display_company" value="Confidential">&nbsp;&nbsp;<span>Confidential</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input id="display_company" type="checkbox" name="display_company"  value="MNC">&nbsp;&nbsp;<span>MNC</span></div>
    
                  
                        
                        <div id="form-group">
             <div class="col-sm-4 selectclasss semplyeement_02"> 
             <div class="form-group">
                        <label>Country<span class="star">*</span></label>
                        <div class="select-number semplyeement_03" >
                       

                                <input type="text" class="input-box-signup keypressit" id="country_id" name="country_ids" value="{{@$countryDetails->country_name}}" required autocomplete="off">

<div class="auto-search-box">
  
<div class="auto-search-boxul"></div>

</div>

                            <div id="err_country_id" class="error"></div>
                        </div>
                        </div>
                        </div>
            <div class="col-sm-4 semplyeement_02">
                        <div class="form-group">
                           <label>
                              State<span class="star">*</span> 
                           </label>
               <div class="select-number semplyeement_03">
                          
                            <input type="text" name="state_ids" class="input-box-signup keystate"  value="{{@$stateDetails->state_name}}" required autocomplete="off">


                            <div class="auto-search-box-state"></div>

 
                            
                             <input type="hidden" class="country_id" name="country_id" autocomplete="off" value="{{@$memberdetailsDetails->education_country_id}}">
                            
                            
                            
               </div>
             
                        </div>
                        </div>
            <div class="col-sm-4" style="padding:0px">
                        <div class="form-group">
                           <label>
                              City
                           </label> 
               <div class="select-number semplyeement_04">
                           

     <input type="text" class="input-box-signup keycity" name="city_ids" value="{{@$cityDetails->city_name}}"  autocomplete="off">

      <div class="auto-search-box-city"></div>

  <input type="hidden" class="state_id" name="state_id" autocomplete="off" value="{{@$memberdetailsDetails->education_state}}" >
  <input type="hidden" class="city_id" name="city_id" autocomplete="off" value="{{@$memberdetailsDetails->education_city}}">
  
  
 

               </div>
               <div id="err_city_id" class="error"></div>
                        </div>
                        </div>
                        
    
          
    </div>
    <div class="form-group semplyeement_01" >
        <label>Duration<span class="star">*</span></label>
        <div class="duration">
            <div class="row">
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="start_monthrequired" required class="input-box-signup">
                            <option value="">Month</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="start_year" required class="input-box-signup">
                            <option value="">Year</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                            <option value="1989">1989</option>
                            <option value="1988">1988</option>
                            <option value="1987">1987</option>
                            <option value="1986">1986</option>
                            <option value="1985">1985</option>
                            <option value="1984">1984</option>
                            <option value="1983">1983</option>
                            <option value="1982">1982</option>
                            <option value="1981">1981</option>
                            <option value="1980">1980</option>
                            <option value="1979">1979</option>
                            <option value="1978">1978</option>
                            <option value="1977">1977</option>
                            <option value="1976">1976</option>
                        </select>
                    
                    </div>
                </div>
                <div class="duration-to">To</div>
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="end_month"required class="input-box-signup">
                            <option value="">Month</option>
                            <option value="present">Present</option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                     
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="select-number">
                        <select name="end_year" required class="input-box-signup">
                            <option value="">Year</option>
                            <option value="present">Present</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                            <option value="1989">1989</option>
                            <option value="1988">1988</option>
                            <option value="1987">1987</option>
                            <option value="1986">1986</option>
                            <option value="1985">1985</option>
                            <option value="1984">1984</option>
                            <option value="1983">1983</option>
                            <option value="1982">1982</option>
                            <option value="1981">1981</option>
                            <option value="1980">1980</option>
                            <option value="1979">1979</option>
                            <option value="1978">1978</option>
                            <option value="1977">1977</option>
                            <option value="1976">1976</option>
                        </select>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Job Responsibilities<span class="star">*</span></label>
        <textarea    placeholder="Enter Your Designation Summary" name="description"  class="input-box-signup semplyeement_05" required rows="3"></textarea>
    
    </div>
  		 
				  
                      
 
               
               
               
               <div class="btn-wrapper semplyeement_06">
                  <input type="hidden" value="{{@$memberid}}" name="enc_id">
                  <button type="submit" class="submit-btn">Save</button>
               </div> </div>  </div>	
               </form>