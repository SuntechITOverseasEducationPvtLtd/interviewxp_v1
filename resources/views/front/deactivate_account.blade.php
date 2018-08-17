@extends('front.layout._master')
@section('middle_content')
       <div class="banner-change-pw">
         <div class="pattern-change-pw">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"><div class="heading-changepw">{{$module_title}}</div></div>
                </div>
             </div>
           </div>
       </div>
       <div class="middle-area min-height">
           <div class="container">
               <div class="deactivate-heading">
                <h4>We're sorry to see you go...</h4>
                <h4>Are you sure you want to close your Account? You will loose all you products and their validities.</h4>
               </div>
               
               <div class="reson">
                   <h5>Tell us why you're deactivating your account:</h5>
                    <form action="{{url('/user/deactivate_account')}}" method="post"> 
                   {{ csrf_field() }}
                      <!-- checkbox-->
                     <div class="user-box">
                       <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input id="Radio1" name="reason" value="I have a duplicate account" type="radio">
                                    <label for="Radio1">I have a duplicate account</label>
                                    <div class="check"></div>
                                 </div>
                                
                              </div>
                     </div>
                     
                     <div class="user-box">
                       <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input id="Radio2" name="reason" value="I have a Privacy concern" type="radio">
                                    <label for="Radio2">I have a Privacy concern</label>
                                    <div class="check"></div>
                                 </div>
                                
                              </div>
                     </div>
                     
                     <div class="user-box">
                       <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input id="Radio3" value="I am receiving unwanted email" name="reason" type="radio">
                                    <label for="Radio3">I am receiving unwanted email</label>
                                    <div class="check"></div>
                                 </div>
                                
                              </div>
                     </div>
                     
                     <div class="user-box">
                       <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input id="Radio4" value="The Interview Q & A is having quality" name="reason" type="radio">
                                    <label for="Radio4">The Interview Q &amp; A is having quality</label>
                                    <div class="check"></div>
                                 </div>
                                
                              </div>
                     </div>
                     
                     <div class="user-box">
                       <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input id="Radio5" value="other" name="reason" type="radio">
                                    <label for="Radio5" >Other</label>
                                    <div class="check"></div>
                                 </div>
                                
                              </div>
                     </div>
                     <!--end-->
                    
                          <div class="row">
                              <div class="col-sm-6">
                                   
                                     <div class="form-group other-input">

                                              <input type="text" id="other" name="other" class="input-box-signup" placeholder="Enter Other" />
                                              <!--div class="error">Name is not Valid</div-->
                                     </div>
                                       <div class="form-group">
                                            <label>Is there anything else you'd like to us to know</label>
                                            <textarea class="form-area" id="description" name="description" cols="30" rows="5"></textarea>
                                       </div>
                                       
                                         <div class="btn-wrapper">
                                            <button type="button" class="submit-btn" data-toggle="modal" href="#myModalsm">Next</button>
                                            <button type="button" class="cancel-btn">Cancel</button>
                                         </div>
                                         
                                      
                                         
                         </div>
                      </div>

                   </div>
               </div>
           
       </div>
       
          <!-- Modal -->
                              <div class="modal fade popup-cls" id="myModalsm" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/>
</button>
                                      <h4 class="modal-title">For Security reason, enter your Password to make this changes</h4>
                                    </div>

                                    <div class="modal-body">
                                   
                                      <div class="form-group">
                                          <label>Password</label>
                                          <input type="password" id="password" name="password" class="input-box-signup" placeholder="Enter Your Password"/>
                                           <div id="error_msg" class="error"></div>
                                    </div>
                                   
                                    </div>
                                    
                                    <div class="modal-footer">
                                          <button type="button"  onclick="javascript: return deactivate();"  class="d-account">Deactivate an Account</button>
                                          
                                    </div>
                                  </div>
                                  </form>
                                </div>
                              </div> 

<script type="text/javascript">




function deactivate()
    {
        var link = "{{ url('/user/deactivate_account') }}";
        var success_link = "{{ url('/user/login') }}";
         var reason = $("input[name='reason']:checked").val();
         var other = $('#other').val();
         var description = $('#description').val();
         var _token = $("input[name=_token]").val();
         var password = $('#password').val();


         var arr_data = {
                          description:description,
                          _token :_token,
                          reason : reason,
                          other : other,
                          password:password,
                          
                        }
      /*var  arr_data;
      arr_data = 'reason='+reason+'&other='+other+'&description='+description+"&_token="+$('input[name="_token"]').val();*/


        jQuery.ajax({
                        url:link,
                        type:'post',
                        dataType:'json',
                        data:arr_data,
                        beforeSend:function()
                        {
                          $('#error_msg').html('');
                        },
                        success:function(response)
                        {
                            if(response.status=="SUCCESS")
                            {
                               location.href = success_link;
                            }
                            if(response.status=="ERROR")
                            {
                              $('#error_msg').html('Invalid password.');
                            }
                            if(response.status=="Error")
                            {
                              $('#error_msg').html('Error while deactivate your account.');
                            }
                        } 
                       });     
  } 
</script>
                              
                              <!-- end --> 
@endsection                                                                                  