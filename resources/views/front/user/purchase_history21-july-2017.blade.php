@extends('front.layout.main')
@section('middle_content')
      <div id="after-login-header" class="after-login"></div>
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>

      <div class="container max-height">
         <div class="row">
            <div class="col-lg-12">
               <div class="middle-section min-height">
                  <div class="user-dashbord">
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="middle part">

                         @include('admin.layout._operation_status')  
                         <!--<form id="frm_manage" action="{{url('/user/multi_action_purchase')}}" id="frm_alerts_manage" method="POST" enctype="multipart/form-data" data-parsley-validate> -->
						  <form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">
                         {{ csrf_field() }}
                              <div class="row">
                                 <div class="col-xs-8">
                                    <h2 class="my-profile">Purchase History</h2>
                                 </div>
                                 <div class="col-xs-4">
                                    <div class="icon-w"> 
                                        <!-- <a href="javascript:void(0);" class="delete-i-top" title="Multiple Delete"
                              onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a> -->
                              <a href="{{url('/user/purchase_history')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                    </div>
                                 </div>
                              </div>
                              <div class="outer-box">
                                 <div class="table-search-pati section1-tab">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                          <thead>
                                             <tr class="top-strip-table">
                                                <td>
                                                   <div class="check-box-UserAlert">
                                                      <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                                                      <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                                                   </div>
                                                </td>
                                                <td>S.No.</td>
                                                <td>Description</td>
                                                <td>Exp.Level</td>
                                                <td>Purchased date</td>
                                                <!-- <td>Validity Date</td> -->
                                                <td>Amount</td>
                                                <td>Actions</td>
                                             </tr>
                                          </thead>
                                        
                                         @if(isset($arr_transaction['data']) && sizeof($arr_transaction['data'])>0)
                                         <?php $i = 1;
													//dd($arr_transaction['data']);
									 ?>
									
                                         @foreach($arr_transaction['data'] as $data)
                                          <thead class="strips">
                                             <tr class="main-content">
                                                <td>
                                                   <div class="check-box-UserAlert">
                                                      <input id="radio1_{{ base64_encode($data['id']) }}" class="css-checkbox" type="checkbox" 
                                                   name="checked_record[]"  
                                                   value="{{ base64_encode($data['id']) }}" /> 
                                                   <label class="css-label radGroup2" for="radio1_{{ base64_encode($data['id']) }}">&nbsp;</label>  
                                                   </div>
                                                </td>
                                                <td>{{$i++}}</td>
                                                <td>{{$data['skill_name'] or 'NA'}}</td>
                                                <td>{{$data['experience_level'] or 'NA'}} Years</td>
                                                <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                                                <!-- <td>{{date('d M Y', strtotime($data['end_date']))}}</td> -->
                                                <td>Rs.{{ $data['grand_total'] or 'NA' }}</td>
                                                <td>
                                                   <div class="text-left">
                                                      <a href="{{url('/')}}/user/view_purchase/{{ base64_encode($data['id']) }}" class="eye-p"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                       <!-- <a href="{{url('/')}}/user/delete_purchase/{{ base64_encode($data['id']) }}" onclick="return confirm('Are you sure to Delete this record?')" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                                                   </div>
                                                </td>
                                                <td class="arrow"><i class="fa fa-chevron-down" aria-hidden="true"></i></td>
                                             </tr>

                                             <tr class="sub-content" style="display:none;">
											 <table>
                                                <tr>

                                                @if($data['purchase_history'][0]['TextResumeType']==1)
													<?php
													$Interview = DB::table('review_rating')
													->where('user_id', '=', $data['user_id'])
													->where('interview_id', '=', $data['ref_interview_id'])
													->where('member_user_id', '=', $data['member_user_id'])
													->where('unique_id', '=', $data['ticket_unique_id'])
													->where('ReviewType', '=', 'Interview Coaching')
													->first();
													if($Interview){
														$css="pointer-events:none";
														$tit=$Interview->review_message;
													}
													else{
														$css="pointer-events:all";
														$tit="";
													}
												    ?>
                                                   <td></td>
                                                   <td></td>
                                                   <td></td>
												   <td></td>
												   <td></td>
												   <td>* Interview Coaching </td>
												   <td><i class="fa fa-eye" style="cursor:pointer" title="{{$tit}}" aria-hidden="true"></i></td>
												   <td>
														<div class="star-wrapper">
															<div class="starrr">
																<input class="star" type="radio"  name="review_star_{{$data['ref_interview_id']}}" value="1" title="I love it" />
																<input class="star" type="radio" name="review_star_{{$data['ref_interview_id']}}" value="2" title="I like it" />
																<input class="star" type="radio" name="review_star_{{$data['ref_interview_id']}}" value="3" title="Its Okey" />
																<input class="star" type="radio" name="review_star_{{$data['ref_interview_id']}}" value="4" title="I dont like it" />
																<input class="star" type="radio" name="review_star_{{$data['ref_interview_id']}}" value="5" title="I hate it" />
															</div>
															<div class="clearfix"></div>
															<div class="error">{{ $errors->first('review_star') }}</div>
														</div>
													</td>
													<td><span class="writeReview" dataValue="Interview Coaching" dataTitle="Interview Coaching" id="" style="border:1px solid #17b0a4;padding:6px;display:block; cursor:pointer; {{$css}}">Write a review</span></td>
                                                 @endif 
												 <tr>
												 </tr>
												@if($data['reference_book']=='Yes')
													<?php
													$qa = DB::table('review_rating')
													->where('user_id', '=', $data['user_id'])
													->where('interview_id', '=', $data['ref_interview_id'])
													->where('member_user_id', '=', $data['member_user_id'])
													->where('unique_id', '=', $data['ticket_unique_id'])
													->where('ReviewType', '=', 'Interview QA')
													->first();
													if($qa){
														$css="pointer-events:none";
														$tit=$qa->review_message;
													}
													else{
														$css="pointer-events:all";
														$tit="";
													}
												    ?>
												   <td></td>
                                                   <td></td>
                                                   <td></td>
												   <td></td>
												   <td></td>
												   <td>* Interview Q & A</td>
                                                   <td>
                                                      <!--<a href="{{url('/')}}/user/view_purchase/{{ base64_encode($data['id']) }}">
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>-->
													  <i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>
                                                   </td>
												   <td>
														<div class="star-wrapper">
															<div class="starrr">
																<input class="star" type="radio"  name="Interview_review_star_{{$data['ref_interview_id']}}" value="1" title="I love it" />
																<input class="star" type="radio" name="Interview_review_star_{{$data['ref_interview_id']}}" value="2" title="I like it" />
																<input class="star" type="radio" name="Interview_review_star_{{$data['ref_interview_id']}}" value="3" title="Its Okey" />
																<input class="star" type="radio" name="Interview_review_star_{{$data['ref_interview_id']}}" value="4" title="I dont like it" />
																<input class="star" type="radio" name="Interview_review_star_{{$data['ref_interview_id']}}" value="5" title="I hate it" />
															</div>
															<div class="clearfix"></div>
															<div class="error">{{ $errors->first('review_star') }}</div>
														</div>
													</td>
													<td><span class="writeReview" dataValue="Interview QA" dataTitle="Interview Q & A" id="" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer; {{$css}}">Write a review</span></td>
                                                 @endif 
												</tr>
												<tr>
                                                 @if(isset($data['purchase_history']) && sizeof($data['purchase_history'])>0)
													@foreach($data['purchase_history'] as $key=> $company)
										
													<?php
														$NameCompany = DB::table('company_master')->where('company_id', '=', $company['InterviewByCompaniesID'])->first();
														$CompanyLocation = DB::table('interview_detail')->where('company_id', '=', $company['InterviewByCompaniesID'])->first();
														$NameC=$NameCompany->company_name;
														$Location=$CompanyLocation->company_location;
														
														$Company = DB::table('review_rating')
														->where('user_id', '=', $data['user_id'])
														->where('interview_id', '=', $data['ref_interview_id'])
														->where('member_user_id', '=', $data['member_user_id'])
														->where('unique_id', '=', $data['ticket_unique_id'])
														->where('ReviewType', '=', 'Company')
														->where('ReviewTypeID', '=', $company['InterviewByCompaniesID'])
														->first();
														if($Company){
															$css="pointer-events:none";
															$tit=$Company->review_message;
														}
														else{
															$css="pointer-events:all";
															$tit="";
														}
													?>
														
													   <tr>
													   <td></td>
													   <td></td>
													   <td></td>
													   <td></td>
													   <td></td>
													   <td>* {{$NameC}} ({{$Location}}) Company's Q & A</td>
													   <td>
														   <i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>
													   </td>
													   <td>
														<div class="star-wrapper">
															<div class="starrr">
																<input class="star" type="radio"  name="Company_review_star_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}" value="1" title="I love it" />
																<input class="star" type="radio" name="Company_review_star_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}" value="2" title="I like it" />
																<input class="star" type="radio" name="Company_review_star_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}" value="3" title="Its Okey" />
																<input class="star" type="radio" name="Company_review_star_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}" value="4" title="I dont like it" />
																<input class="star" type="radio" name="Company_review_star_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}" value="5" title="I hate it" />
															</div>
															<div class="clearfix"></div>
															<div class="error">{{ $errors->first('review_star') }}</div>
														</div>
													    </td>
													<td><span class="writeReview" dataValue="Company" dataTitle="{{$NameC}} ({{$Location}}) Company's Q & A" id="{{$company['InterviewByCompaniesID']}}" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer;{{$css}}">Write a review</span></td>
													</tr>
													   
												   @endforeach
                                                 @endif  
												 </tr>
												 <tr>
                                                 @if($data['purchase_history'][0]['ticket_name']!="")
												<?php
													$Real = DB::table('review_rating')
													->where('user_id', '=', $data['user_id'])
													->where('interview_id', '=', $data['ref_interview_id'])
													->where('member_user_id', '=', $data['member_user_id'])
													->where('unique_id', '=', $data['ticket_unique_id'])
													->where('ReviewType', '=', 'Real Issues')
													->where('ReviewTypeID', '=', $data['ticket_name'])
													->first();
													if($Real){
														$css="pointer-events:none";
														$tit=$Real->review_message;
													}
													else{
														$css="pointer-events:all";
														$tit="";
													}
												?>
												  <td></td>
                                                   <td></td>
                                                   <td></td>
												   <td></td>
												   <td></td>
												   <td>* Real Time Issues - {{$data['ticket_name']}}</td>
                                                   <td>
                                                       <i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>
                                                   </td>
												   <td>
														<div class="star-wrapper">
															<div class="starrr">
																<input class="star" type="radio"  name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="1" title="I love it" />
																<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="2" title="I like it" />
																<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="3" title="Its Okey" />
																<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="4" title="I dont like it" />
																<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="5" title="I hate it" />
															</div>
															<div class="clearfix"></div>
															<div class="error">{{ $errors->first('review_star') }}</div>
														</div>
													</td>
													<td><span class="writeReview" dataValue="Real Issues" dataTitle="Real Time Issues - {{$data['ticket_name']}}" id="{{$data['ticket_name']}}" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer; {{$css}}">Write a review</span></td>
                                                 @endif 

                                                </tr>
												</table>
												
                                             </tr>
                                          </thead>
                                         @endforeach
                                         @else
                                          <tr><td colspan="6"><div style="color:red;text-align:center;">No Records found...  </div></td></tr>
                                         @endif
                                         
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
								 
                                 <!-- pagination -->
                               <!--   <div class="prod-pagination">
                                    <ul class="pagination pagination-blog">
                                       <li>
                                          <a href="#" class="disable">
                                          <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                          </a>
                                       </li>
                                       <li><a href="#" class="act">1</a></li>
                                       <li><a href="#">2</a></li>
                                       <li><a href="#">3</a></li>
                                       <li>
                                          <a href="#">
                                          <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                          </a>
                                       </li>
                                    </ul>
                                 </div> -->

                                  <div class="prod-pagination">
                                   {{$arr_pagination->render()}}  
                                   </div>
                                 <!-- end -->              
                              </div>
							  <div class="form-group">
							    <h4 id="reviewTitile"></h4>
								<textarea class="text-area reviewComments" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="5" name="review" placeholder="Add Review"></textarea>
							  </div>
							  <div class="m-top">
								<input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
								<input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
								<input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">
								
								<input  type="hidden" name="reviewType" id="reviewType" value="" />
								<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="" />
								<input  type="hidden" name="review_star" id="review_star" value="" />

								<button type="submit" class="submit-btn reviewSubmit" style="float:right">Submit</button>
							  </div>
                               

                             @if(isset($arr_advertise) && sizeof($arr_advertise)>0)
                             @if($arr_advertise[1]['is_active']==1)

                                @if($arr_advertise[1]['id']==4)
                                  <div class="sample-img2"> <img src="{{$advertise_public_img_path.$arr_advertise[1]['advertise_image']}}" alt="Interviewxp" class="img-responsive" /> </div>
                                @endif
                             @else
                             <div class="sample-img2"> <img src="{{url('/')}}/images/sample-img3.jpg" alt="Interviewxp" class="img-responsive" /> </div>
							 @endif 
                             @endif   


                            <!--   <div class="sample-img2"><img src="{{url('/')}}/images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/></div> -->
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
<script type="text/javascript">
   $("#frm_review_rating").validate({
         errorElement: 'div',
         errorClass: 'error',
         highlight: function (element) {
             $(element).removeClass('error');
         }
   });
</script>
    <script type="text/javascript">
         $('.main-content > .arrow').click(function(){
           $(this).parent().next('.sub-content').slideToggle();
           $(this).find('.arrow i').toggleClass('fa-chevron-down fa-chevron-up')
         });
      </script>  

<script type="text/javascript">
  $( document ).ready(function() {
   $('#radio0').click(function() {
      if ($(this).is(':checked')) {
          $('div input').attr('checked', true);
      } else {
          $('div input').attr('checked', false);
      }
  });
  }); 

</script>   

<script type="text/javascript">
   function check_multi_action(checked_record,frm_id,action)
    {
      var checked_record = document.getElementsByName(checked_record);
      var len = checked_record.length;
      var flag=1;
      var input_multi_action = jQuery('input[name="multi_action"]');
      var frm_ref = jQuery("#"+frm_id);
  
      if(len<=0)
      {
        alert("No records to perform this action");
        return false;
      }
      
      if(confirm('Do you really want to perform this action'))
      {
      
        for(var i=0;i<len;i++)
        {
          if(checked_record[i].checked==true)
          {  
              flag=0;
              /* Set Action in hidden input*/
              jQuery('input[name="multi_action"]').val(action);

              /*Submit the referenced form */
              jQuery(frm_ref)[0].submit();  
            }
          }

        if(flag==1)
        {
          alert('Please select record(s)');
          return false;
        }  
          
      } 
  }
$(".reviewComments, .reviewSubmit").hide();
$(".writeReview").on("click", function(){
	$(".reviewComments, .reviewSubmit").show();
	var dataValue=$(this).attr("dataValue");
	var dataValueID=$(this).attr("id");
	var dataTitle=$(this).attr("dataTitle");
	
	$("#reviewTypeID").val(dataValueID);
	$("#reviewType").val(dataValue);
	$("#reviewTitile").html(dataTitle);
});
$(".star").on("change",function(){ // bind a function to the change event
	if( $(this).is(":checked") ){ // check if the radio is checked
		var val = $(this).val(); // retrieve the value
		$("#review_star").val(val);
	}
});
</script>                      
      <!--footer section-->
@endsection

