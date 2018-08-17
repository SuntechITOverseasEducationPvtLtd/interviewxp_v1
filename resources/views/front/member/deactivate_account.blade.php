<style>
    .sdeactivate_01{font-size: 18px !important;}
.sdeactivate_02{background-color: #fc575c !important; border: 1px solid #fc575c !important; border-radius: 3px !important; color: #fff !important; font-size: 16px !important; padding: 8px 40px !important; font-family: "ubunturegular",sans-serif !important; letter-spacing: 0.3px !important; display: inline-block !important;}
</style>


@extends('front.layout.main')
@section('middle_content')
       
       <div class="banner-member">
         <div class="pattern-member">
            
         </div>
      </div>
    
         <div class="container-fluid fix-left-bar max-height">
            <div class="row">
              @include('front.member.member_sidebar')
              
               <div class="col-sm-8 col-md-9 col-lg-10 middle-content">
            <h2 class="my-profile pages">Deactivate an Account</h2>
            <div class="outer-box"> 
                <div class="deactivate-heading">
				<?php
				$title = '';
				if($availableSkillSets > 0 || $pendingReviewsCount > 0)
				{
					
					if($availableSkillSets > 0)
					{
						$title .= "Your display status is set as available for <b>".$availableSkillSets." different skill sets</b>";
					}
					if($availableSkillSets > 0 && $pendingReviewsCount > 0)
					{
						$title .= " and ";
					}
					if($pendingReviewsCount > 0)
					{
						$title .= "<b>".$pendingReviewsCount." pending reviews</b>";
					}
					$title .= " in My Bookings page, Once ";
					if($availableSkillSets > 0)
					{
						$title .= "you set it as Not Available";
					}
					if($availableSkillSets > 0 && $pendingReviewsCount > 0)
					{
						$title .= " and ";
					}
					if($pendingReviewsCount > 0)
					{
						$title .= "reviews are completed by your learners ";
					}
					$title .= "then you can deactivate your account.";
				}					
					
				?>
                <h4 class="sdeactivate_01">{!!$title!!}</h4><br>
                <h4 class="sdeactivate_01"><b>Note:</b> All your skill sets will not be displayed live on interviewxp.com, but the learners who already made purchases of your learning content will still have access</h4>
               </div>
               
               <div class="reson">
                   <h5>Tell us why you're deactivating your account:</h5>
                   
                      <!-- checkbox-->
                      <form action="" method="post"> 
                   {{ csrf_field() }}
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
                                            <button type="button" class="cancel-btn">Cancel</button>											
											@if($availableSkillSets > 0 || $pendingReviewsCount > 0)
											<button type="button"class="btn primary sdeactivate_02" disabled="disabled" title="{!! strip_tags($title) !!}">Next</button>
											@else
                                            <button type="button" class="submit-btn" data-toggle="modal" href="#myModalsm" >Next</button>
											@endif
                                         </div>
                                         
                                      
                                         
                         </div>
                      </div>
                   </div>
              
      <div>          
       </div>
                
               </div>
            </div>
         </div>
        
		@if($availableSkillSets == 0 && $pendingReviewsCount == 0)
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
			</div>
		  </div> 
		@endif	
       </div> 

<script src="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.js"></script>
<script type="text/javascript">
function deactivate()
    {
        run_waitMe();
        var link = "{{ url('/member/deactivate_account') }}";
        var success_link = "{{ url('/member/login') }}";
         var reason = $("input[name='reason']:checked").val();
         var other = $('#other').val();
         var  description= $('#description').val();
         var _token = $("input[name=_token]").val();
         var password = $('#password').val();
         var arr_data = {
                          description:description,
                          _token :_token,
                          reason : reason,
                          other : other,
                          password:password,
                          
                        }
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
                              $('#error_msg').html('Please enter valid password.');
                            }
                            if(response.status=="Error")
                            {
                              $('#error_msg').html('Error while deactivate your account.');
                            }
                        } 
                       });     
  } 

  function run_waitMe(){
  $('body').waitMe({
  //none, rotateplane, stretch, orbit, roundBounce, win8,
  //win8_linear, ios, facebook, rotation, timer, pulse,
  //progressBar, bouncePulse or img
  effect: 'win8',
  //place text under the effect (string).
  text: 'Please Wait...',
  //background for container (string).
  bg: 'rgba(179,179,179,0.7)',
  //color for background animation and text (string).
  color: 'green',
  //change width for elem animation (string).
  sizeW: '',
  //change height for elem animation (string).
  sizeH: '',
  // url to image
  source: '',
  // callback
  //onClose: function() {}
  });
  } 
</script>
                              
                              <!-- end --> 
@endsection                                                                                  