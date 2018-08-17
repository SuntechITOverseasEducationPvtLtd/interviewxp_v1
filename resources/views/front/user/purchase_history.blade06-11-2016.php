@extends('front.layout.main')
@section('middle_content')
	  <?php
	  	 $reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];
	  ?>	
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
									
                                         @foreach($arr_transaction['data'] as $key=>$data)
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
                                                <td>{{$key+1}}</td>
                                                <td>{{$data['skill_name'] or 'NA'}}</td>
                                                <td>{{$data['experience_level'] != 'NA' ? $data['experience_level'].' Years' : 'NA'}}</td>
                                                <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                                                
                                                <td>Rs.{{ $data['grand_total'] or 'NA' }}</td>
                                                <td>
                                                   <div class="text-left">
                                                      <a href="{{url('/')}}/user/view_purchase/{{ base64_encode($data['id']) }}" class="eye-p"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                       
                                                   </div>
                                                </td>
                                                <td class="arrow"><i class="fa fa-chevron-down" aria-hidden="true"></i></td>
                                             </tr>

                                            @if($data['purchase_history'][0]['TextResumeType']==1)
                                            	<tr class="sub-content" style="display:none;">

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
											   <td colspan="2"></td> 	
											   <td>* Interview Coaching </td>
											   <td>@if($Interview)<i class="fa fa-eye" style="cursor:pointer" title="{{$tit}}" aria-hidden="true"></i>@endif</td>
											   <td>
													<div class="star-wrapper">
														<div class="starrr">
															@if($Interview)
															    <span class="star-rating-control">
															    <div class="reviewed_rating-cancel rating-cancel"><a title="Cancel Rating"></a></div>
																<?php 
																$emptyStars = url('/')."/images/blank_star.png";           
                                                  				$stars = url('/')."/images/star.png";	
																for($i=1; $i<=5; $i++) 
																{ 
																	if($i <= $Interview->review_star) { echo '<div role="text" class="reviewed_star"><img title="'.$reviewStatusArray[$Interview->review_star].'" src="'.$stars.'"/></div>'; } else { echo '<div role="text" class="reviewed_star"><img  title="'.$reviewStatusArray[$Interview->review_star].'" src="'.$emptyStars.'"/></div>'; } 
																}  
																?>
																</span>
															@else
															<input class="star" type="radio"  name="review_star_{{$data['ticket_unique_id']}}" value="1" title="{{$reviewStatusArray[1]}}" dataId="interview_coach_review_star" />
															<input class="star" type="radio" name="review_star_{{$data['ticket_unique_id']}}" value="2" title="{{$reviewStatusArray[2]}}" dataId="interview_coach_review_star" />
															<input class="star" type="radio" name="review_star_{{$data['ticket_unique_id']}}" value="3" title="{{$reviewStatusArray[3]}}" dataId="interview_coach_review_star" />
															<input class="star" type="radio" name="review_star_{{$data['ticket_unique_id']}}" value="4" title="{{$reviewStatusArray[4]}}" dataId="interview_coach_review_star" />
															<input class="star" type="radio" name="review_star_{{$data['ticket_unique_id']}}" value="5" title="{{$reviewStatusArray[5]}}" dataId="interview_coach_review_star" />
															@endif
														</div>
														<div class="clearfix"></div>
														<div class="error">{{ $errors->first('review_star') }}</div>
													</div>
												</td>
												<td>@if(empty($Interview))<span class="writeReview" dataValue="Interview Coaching" dataClass="interview_coach_review_form_{{$key}}" dataTitle="Interview Coaching" id="" style="border:1px solid #17b0a4;padding:6px;display:block; cursor:pointer; {{$css}}">Write a review</span>@endif</td>
                                         	   	<td colspan="2"></td>
                                         	   </tr>
                                         	   <tr class="interview_coach_review_form_{{$key}}"  style="display:none;background-color: #f9f9f9;">
                                            	<td>
                                            		<form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">
													{{ csrf_field() }}
												</td>
                                            	<td colspan="4">	
                                            	<div class="form-group">
														<h4 id="reviewTitile"></h4>
														<textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="3" name="review" placeholder="Add Review"></textarea>
														</div>														
                                            	</td>
                                            	<td>
                                            			<div class="m-top">
														<input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
														<input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
														<input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">

														<input  type="hidden" name="reviewType" id="reviewType" value="Interview Coaching" />
														<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="" />
														<input  type="hidden" name="review_star" id="interview_coach_review_star" value="" />

														<button type="submit" class="submit-btn" style="margin-top: -25px;">Submit</button>
														</div>
                                            	</td>
                                            	<td colspan="2">
                                            		<button type="reset" class="btn btn-primary close-review" dataClass="interview_coach_review_form_{{$key}}">Cancel</button>
                                            		</form>
                                        		</td>
                                            </tr>
                                             @endif 
										
										 
											@if(isset($data['purchase_history'][0]['training_schedule_id']))
											<tr class="sub-content" style="display:none;">
											   <?php
												$onlineClass = DB::table('review_rating')
												->where('user_id', '=', $data['user_id'])
												->where('interview_id', '=', $data['ref_interview_id'])
												->where('member_user_id', '=', $data['member_user_id'])
												->where('unique_id', '=', $data['ticket_unique_id'])
												->where('ReviewType', '=', 'Online Class')
												->first();
												if($onlineClass){
													$css="pointer-events:none";
													$tit=$onlineClass->review_message;
												}
												else{
													$css="pointer-events:all";
													$tit="";
												}
											    ?> 	
											   <td colspan="2"></td>	
											   <td>* Online Class</td>
											   <td>
												   @if($onlineClass)<i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>@endif
											   </td>
											   <td>
													<div class="star-wrapper">
														<div class="starrr">
															@if($onlineClass)
															    <span class="star-rating-control">
															    <div class="reviewed_rating-cancel rating-cancel"><a title="Cancel Rating"></a></div>
																<?php 
																$emptyStars = url('/')."/images/blank_star.png";           
                                                  				$stars = url('/')."/images/star.png";	
																for($i=1; $i<=5; $i++) 
																{ 
																	if($i <= $onlineClass->review_star) { echo '<div role="text" class="reviewed_star"><img title="'.$reviewStatusArray[$onlineClass->review_star].'" src="'.$stars.'"/></div>'; } else { echo '<div role="text" class="reviewed_star"><img  title="'.$reviewStatusArray[$onlineClass->review_star].'" src="'.$emptyStars.'"/></div>'; } 
																}  
																?>
																</span>
															@else
															<input class="star" type="radio"  name="training_review_star_{{$data['purchase_history'][0]['training_schedule_id']}}_{{$key}}" value="1" title="{{$reviewStatusArray[1]}}" dataId="online_class_review_star" />
															<input class="star" type="radio" name="training_review_star_{{$data['purchase_history'][0]['training_schedule_id']}}_{{$key}}" value="2" title="{{$reviewStatusArray[2]}}" dataId="online_class_review_star" />
															<input class="star" type="radio" name="training_review_star_{{$data['purchase_history'][0]['training_schedule_id']}}_{{$key}}" value="3" title="{{$reviewStatusArray[3]}}" dataId="online_class_review_star" />
															<input class="star" type="radio" name="training_review_star_{{$data['purchase_history'][0]['training_schedule_id']}}_{{$key}}" value="4" title="{{$reviewStatusArray[4]}}" dataId="online_class_review_star" />
															<input class="star" type="radio" name="training_review_star_{{$data['purchase_history'][0]['training_schedule_id']}}_{{$key}}" value="5" title="{{$reviewStatusArray[5]}}" dataId="online_class_review_star" />
															@endif
														</div>
														<div class="clearfix"></div>
														<div class="error">{{ $errors->first('review_star') }}</div>
													</div>
												</td>
												<td>@if(empty($onlineClass))<span class="writeReview" dataClass="training_review_form_{{$key}}" dataValue="Online Class" dataTitle="Online Class" id="" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer;">Write a review</span>@endif</td>
                                            	<td colspan="2"></td>
                                            </tr>
                                            <tr class="training_review_form_{{$key}}"  style="display:none;background-color: #f9f9f9;">
                                            	<td>
                                            		<form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">
													{{ csrf_field() }}
												</td>
                                            	<td colspan="4">	
                                            	<div class="form-group">
														<h4 id="reviewTitile"></h4>
														<textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="3" name="review" placeholder="Add Review"></textarea>
														</div>														
                                            	</td>
                                            	<td>
                                            			<div class="m-top">
														<input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
														<input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
														<input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">

														<input  type="hidden" name="reviewType" id="reviewType" value="Online Class" />
														<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="" />
														<input  type="hidden" name="review_star" id="online_class_review_star" value="" />

														<button type="submit" class="submit-btn" style="margin-top: -25px;">Submit</button>
														</div>
                                            	</td>
                                            	<td colspan="2">
                                            		<button type="reset" class="btn btn-primary close-review" dataClass="training_review_form_{{$key}}">Cancel</button>
                                            		</form>
                                        		</td>
                                            </tr>
                                             @endif
                                        
									 	
											@if($data['reference_book']=='Yes')
											<tr class="sub-content" style="display:none;">

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
											   <td colspan="2"></td> 
											   <td>* Interview Q & A</td>
                                               <td>                                                  
												  @if($qa)<i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>@endif
                                               </td>
											   <td>
													<div class="star-wrapper">
														<div class="starrr">
															@if($qa)
															    <span class="star-rating-control">
															    <div class="reviewed_rating-cancel rating-cancel"><a title="Cancel Rating"></a></div>
																<?php 
																$emptyStars = url('/')."/images/blank_star.png";           
                                                  				$stars = url('/')."/images/star.png";	
																for($i=1; $i<=5; $i++) 
																{ 
																	if($i <= $qa->review_star) { echo '<div role="text" class="reviewed_star"><img title="'.$reviewStatusArray[$qa->review_star].'" src="'.$stars.'"/></div>'; } else { echo '<div role="text" class="reviewed_star"><img  title="'.$reviewStatusArray[$qa->review_star].'" src="'.$emptyStars.'"/></div>'; } 
																}  
																?>
																</span>
															@else
															<input class="star" type="radio"  name="Interview_review_star_{{$data['ticket_unique_id']}}" value="1" title="{{$reviewStatusArray[1]}}" dataId="interview_qa_review_star" />
															<input class="star" type="radio" name="Interview_review_star_{{$data['ticket_unique_id']}}" value="2" title="{{$reviewStatusArray[2]}}" dataId="interview_qa_review_star" />
															<input class="star" type="radio" name="Interview_review_star_{{$data['ticket_unique_id']}}" value="3" title="{{$reviewStatusArray[3]}}" dataId="interview_qa_review_star" />
															<input class="star" type="radio" name="Interview_review_star_{{$data['ticket_unique_id']}}" value="4" title="{{$reviewStatusArray[4]}}" dataId="interview_qa_review_star" />
															<input class="star" type="radio" name="Interview_review_star_{{$data['ticket_unique_id']}}" value="5" title="{{$reviewStatusArray[5]}}" dataId="interview_qa_review_star" />
															@endif
														</div>
														<div class="clearfix"></div>
														<div class="error">{{ $errors->first('review_star') }}</div>
													</div>
												</td>
												<td>@if(empty($qa))<span class="writeReview" dataValue="Interview QA" dataClass="interview_qa_review_form_{{$key}}" dataTitle="Interview Q & A" id="" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer; {{$css}}">Write a review</span>@endif</td>
                                             	<td colspan="2"></td>
                                             </tr>
                                             <tr class="interview_qa_review_form_{{$key}}"  style="display:none;background-color: #f9f9f9;">
                                            	<td>
                                            		<form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">
													{{ csrf_field() }}
												</td>
                                            	<td colspan="4">	
                                            	<div class="form-group">
														<h4 id="reviewTitile"></h4>
														<textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="3" name="review" placeholder="Add Review"></textarea>
														</div>														
                                            	</td>
                                            	<td>
                                            			<div class="m-top">
														<input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
														<input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
														<input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">

														<input  type="hidden" name="reviewType" id="reviewType" value="Interview QA" />
														<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="" />
														<input  type="hidden" name="review_star" id="interview_qa_review_star" value="" />

														<button type="submit" class="submit-btn" style="margin-top: -25px;">Submit</button>
														</div>
                                            	</td>
                                            	<td colspan="2">
                                            		<button type="reset" class="btn btn-primary close-review" dataClass="interview_qa_review_form_{{$key}}">Cancel</button>
                                            		</form>
                                        		</td>
                                            </tr>
                                             @endif 
																						
										
                                             @if(isset($data['purchase_history']) && sizeof($data['purchase_history'])>0)
												@foreach($data['purchase_history'] as $key=> $company)
									
												<?php

												if(isset($company['InterviewByCompaniesID']))
												{													

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
													
												   <tr class="sub-content" style="display:none;">
												   <td colspan="2"></td>
												   <td style="width: 32% !important;">* {{$NameC}} ({{$Location}}) Company's Q & A</td>
												   <td>
													   @if($Company)<i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>@endif
												   </td>
												   <td>
													<div class="star-wrapper">
														<div class="starrr">
															@if($Company)
															    <span class="star-rating-control">
															    <div class="reviewed_rating-cancel rating-cancel"><a title="Cancel Rating"></a></div>
																<?php 
																$emptyStars = url('/')."/images/blank_star.png";           
                                                  				$stars = url('/')."/images/star.png";	
																for($i=1; $i<=5; $i++) 
																{ 
																	if($i <= $Company->review_star) { echo '<div role="text" class="reviewed_star"><img title="'.$reviewStatusArray[$Company->review_star].'" src="'.$stars.'"/></div>'; } else { echo '<div role="text" class="reviewed_star"><img  title="'.$reviewStatusArray[$Company->review_star].'" src="'.$emptyStars.'"/></div>'; } 
																}  
																?>
																</span>
															@else
															<input class="star" type="radio"  name="Company_review_star_{{$company['id']}}_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}_{{$data['ticket_unique_id']}}" value="1" title="{{$reviewStatusArray[1]}}" dataId="company_qa_review_star_{{$company['id']}}" />
															<input class="star" type="radio" name="Company_review_star_{{$company['id']}}_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}_{{$data['ticket_unique_id']}}" value="2" title="{{$reviewStatusArray[2]}}" dataId="company_qa_review_star_{{$company['id']}}" />
															<input class="star" type="radio" name="Company_review_star_{{$company['id']}}_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}_{{$data['ticket_unique_id']}}" value="3" title="{{$reviewStatusArray[3]}}" dataId="company_qa_review_star_{{$company['id']}}" />
															<input class="star" type="radio" name="Company_review_star_{{$company['id']}}_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}_{{$data['ticket_unique_id']}}" value="4" title="{{$reviewStatusArray[4]}}" dataId="company_qa_review_star_{{$company['id']}}" />
															<input class="star" type="radio" name="Company_review_star_{{$company['id']}}_{{$company['InterviewByCompaniesID']}}_{{$data['ref_interview_id']}}_{{$data['ticket_unique_id']}}" value="5" title="{{$reviewStatusArray[5]}}" dataId="company_qa_review_star_{{$company['id']}}" />
															@endif
														</div>
														<div class="clearfix"></div>
														<div class="error">{{ $errors->first('review_star') }}</div>
													</div>
												    </td>
													<td>@if(empty($Company))<span class="writeReview" dataValue="Company" dataClass="company_qa_review_form_{{$data['ticket_unique_id']}}_{{$company['id']}}" dataTitle="{{$NameC}} ({{$Location}}) Company's Q & A" id="{{$company['InterviewByCompaniesID']}}" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer;{{$css}}">Write a review</span>@endif</td>
													<td colspan="2"></td>
												</tr>
												<tr class="company_qa_review_form_{{$data['ticket_unique_id']}}_{{$company['id']}}"  style="display:none;background-color: #f9f9f9;">
                                            	<td>
                                            		<form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">
													{{ csrf_field() }}
												</td>
                                            	<td colspan="4">	
                                            	<div class="form-group">
														<h4 id="reviewTitile"></h4>
														<textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="3" name="review" placeholder="Add Review"></textarea>
														</div>														
                                            	</td>
                                            	<td>
                                            			<div class="m-top">
														<input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
														<input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
														<input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">

														<input  type="hidden" name="reviewType" id="reviewType" value="Company" />
														<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="{{$company['InterviewByCompaniesID']}}" />
														<input  type="hidden" name="review_star" id="company_qa_review_star_{{$company['id']}}" value="" />

														<button type="submit" class="submit-btn" style="margin-top: -25px;">Submit</button>
														</div>
                                            	</td>
                                            	<td colspan="2">
                                            		<button type="reset" class="btn btn-primary close-review" dataClass="company_qa_review_form_{{$data['ticket_unique_id']}}_{{ $company['id']}}">Cancel</button>
                                            		</form>
                                        		</td>
                                            </tr>
                                            <?php
                                            }

                                            ?>
												   
											   @endforeach
                                             @endif  
									 	
                                         	@if($data['purchase_history'][0]['ticket_name']!="")
                                         		<tr class="sub-content" style="display:none;">

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
											   <td colspan="2"></td>	
											   <td>* Real Time Issues - {{$data['ticket_name']}}</td>
                                               <td>
                                                   @if($Real)<i class="fa fa-eye" title="{{$tit}}" style="cursor:pointer" aria-hidden="true"></i>@endif
                                               </td>
											   <td>
													<div class="star-wrapper">
														<div class="starrr">
															@if($Real)
															    <span class="star-rating-control">
															    <div class="reviewed_rating-cancel rating-cancel"><a title="Cancel Rating"></a></div>
																<?php 
																$emptyStars = url('/')."/images/blank_star.png";           
                                                  				$stars = url('/')."/images/star.png";	
																for($i=1; $i<=5; $i++) 
																{ 
																	if($i <= $Real->review_star) { echo '<div role="text" class="reviewed_star"><img title="'.$reviewStatusArray[$Real->review_star].'" src="'.$stars.'"/></div>'; } else { echo '<div role="text" class="reviewed_star"><img  title="'.$reviewStatusArray[$Real->review_star].'" src="'.$emptyStars.'"/></div>'; } 
																}  
																?>
																</span>
															@else
															<input class="star" type="radio"  name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="1" title="{{$reviewStatusArray[1]}}" dataId="realtime_issues_review_star" />
															<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="2" title="{{$reviewStatusArray[2]}}" dataId="realtime_issues_review_star" />
															<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="3" title="{{$reviewStatusArray[3]}}" dataId="realtime_issues_review_star" />
															<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="4" title="{{$reviewStatusArray[4]}}" dataId="realtime_issues_review_star" />
															<input class="star" type="radio" name="Real_review_star_{{$data['ticket_name']}}_{{$data['ref_interview_id']}}" value="5" title="{{$reviewStatusArray[5]}}" dataId="realtime_issues_review_star" />
															@endif
														</div>
														<div class="clearfix"></div>
														<div class="error">{{ $errors->first('review_star') }}</div>
													</div>
												</td>
												<td>@if(empty($Real))<span class="writeReview" dataValue="Real Issues" dataClass="realtime_issues_review_form_{{$key}}" dataTitle="Real Time Issues - {{$data['ticket_name']}}" id="{{$data['ticket_name']}}" style="border:1px solid #17b0a4;padding:6px;display:block;cursor:pointer; {{$css}}">Write a review</span>@endif</td>
                                             	<td colspan="2"></td>
                                             </tr>
                                             <tr class="realtime_issues_review_form_{{$key}}"  style="display:none;background-color: #f9f9f9;">
                                            	<td>
                                            		<form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">
													{{ csrf_field() }}
												</td>
                                            	<td colspan="4">	
                                            	<div class="form-group">
														<h4 id="reviewTitile"></h4>
														<textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="3" name="review" placeholder="Add Review"></textarea>
														</div>														
                                            	</td>
                                            	<td>
                                            			<div class="m-top">
														<input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
														<input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
														<input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">

														<input  type="hidden" name="reviewType" id="reviewType" value="Real Issues" />
														<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="{{$data['purchase_history'][0]['ticket_name']}}" />
														<input  type="hidden" name="review_star" id="realtime_issues_review_star" value="" />

														<button type="submit" class="submit-btn" style="margin-top: -25px;">Submit</button>
														</div>
                                            	</td>
                                            	<td colspan="2">
                                            		<button type="reset" class="btn btn-primary close-review" dataClass="realtime_issues_review_form_{{$key}}">Cancel</button>
                                            		</form>
                                        		</td>
                                            </tr>
                                             @endif 

                                          </thead>
                                         @endforeach
                                         @else
                                          <tr><td colspan="6"><div style="color:red;text-align:center;">No Records found...  </div></td></tr>
                                         @endif
                                         
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                  <div class="prod-pagination">
                                   {{$arr_pagination->render()}}  
                                   </div>
                                 <!-- end -->              
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
           $(this).parent().siblings('.sub-content').slideToggle();
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
$(".close-review").on("click", function(){ 
	var dataClass = $(this).attr('dataClass');
	$("."+dataClass).hide();
});
$(".writeReview").on("click", function(){
	var dataClass = $(this).attr('dataClass');
	$("."+dataClass).show();
});
$(".star").on("change",function(){ // bind a function to the change event
	if( $(this).is(":checked") ){ // check if the radio is checked
		var val = $(this).val(); // retrieve the value
		var dataId = $(this).attr('dataId');
		$("#"+dataId).val(val);
	}
});
</script>                      
      <!--footer section-->
@endsection

