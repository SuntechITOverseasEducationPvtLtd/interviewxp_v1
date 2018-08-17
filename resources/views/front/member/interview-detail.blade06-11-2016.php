@extends('front.layout.main') 
@section('middle_content')
<style type="text/css">  
  a.morelink {
  color: #0254EB;
}
a.morelink:visited {
  color: #0254EB;
}
a.morelink {
  text-decoration:none;
  outline: none;
}
.morecontent span {
  display: none;
}
.comment {
  width: 400px;
  background-color: #f0f0f0;
  margin: 10px;
}

.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
	background-color: #fff;
    box-shadow: 0px 2px 12px -4px;
    /*background-color: rgba(214, 224, 226, 0.2);*/
}

.card.hovercard .cardheader {
    background-color: #fff;
    background-size: cover;
    height: 55px;
}

.card.hovercard .avatar {
    position: relative;
    top: -50px;
    margin-bottom: -50px;
}

.card.hovercard .avatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 158, 158, 0.5);
}
</style>

<!-- middle section -->
<div class="middle-area min-height" style="padding-top:100px !important">
    <div class="container">
    @include('front.layout._operation_status')
        <div class="search-detail-topSection">
			<?php
				$interview_skill_name = '';
				if(isset($arr_interview['skill_name']) && isset($arr_interview['experience_level'])  && $arr_interview['experience_level'] != 'NA')
				{
					$interview_skill_name = $arr_interview['skill_name'].' Real Time Interview Questions &amp; Answers ( '.$arr_interview['experience_level'].' Year Exp )';
				}
				else if(($arr_interview['skill_name']) && isset($arr_interview['experience_level'])){									
					$interview_skill_name = $arr_interview['skill_name'].' Interview Questions &amp; Answers';
				}
		   ?>
            <h4>{{$interview_skill_name}}</h4>
            <ul class="first-list">
                <li class="hidden-xs">Member Since {{isset($arr_interview['memberdetails']['created_at'])?date('d M Y', strtotime($arr_interview['memberdetails']['created_at'])):' '}}</li>
                <li class="hidden-xs" style="border-right: none;">Last update {{isset($arr_interview['updated_at'])?date('d M Y', strtotime($arr_interview['updated_at'])):' '}}</li>
                <li style="margin-left: 28%;color:#555"><i class="fa fa-phone" aria-hidden="true"></i><b>&nbsp;&nbsp;&nbsp;+91-40-64648700, 9000539774</b></li>
                <li style="color:#555"><i class="fa fa-envelope" aria-hidden="true"></i></i><b>&nbsp;&nbsp;&nbsp;support@interviewxp.com</b></li>                
                
            </ul>
			
            <ul class="second-list">
                <li>
                    <div class="star-wrapper">
                        <div class="starrr">
                            @for($i=1;$i<=$average_rating;$i++)
                          <img src="{{url('/')}}/images/star.png"/>
                    @endfor          
                    @for($i=$average_rating;$i<5;$i++)
                          <img src="{{url('/')}}/images/blank_star.png"/>
                    @endfor
                        </div>
                        <span> Ratings</span>
                    </div>
                </li>
                <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i> {{isset($arr_interview['user_purchase_details'])?count($arr_interview['user_purchase_details']):''}} Learners</li>
                <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true" style="font-size: 16px;"></i> {{isset($arr_interview['view_count'])?$arr_interview['view_count']:''}} Views</li>
            </ul>
        </div>
        <!-- vedio section -->
        <div class="row">
            <div class="" style="padding-top: 10px !important;">
                <div class="col-lg-3">
                <input type="hidden" id="video_url" name="video_url" value="{{$arr_interview['video_id']}}">
                    <div class="video">
                        {{-- <img src="{{url('/')}}/images/video-img.jpg" class="img-responsive" alt="Interviewxp" /> --}}
                        @if($arr_interview['video_id'] !='')
                <iframe width="270" height="166" src="//www.youtube.com/embed/{{$video_id}}" frameborder="0" allowfullscreen></iframe>
                        @else
                             <img width="270" height="166" src="{{url('/')}}/uploads/no-image.png" />
                        @endif
                        
                    </div>
                </div>
                <div class="col-lg-7">
                    <ul style="line-height: 35px;">                       
                        <li>
                            <b style="letter-spacing: 0.6px;">Category </b>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;{{isset($arr_interview['category_name'])?ucfirst($arr_interview['category_name']):'NA'}}</span>
                        </li>
                        <li>
                            <b style="letter-spacing: 0.6px;">Sub Category </b>
                            <span>&nbsp;: &nbsp;{{isset($arr_interview['subcategory_name'])?ucfirst($arr_interview['subcategory_name']):'NA'}}</span>
                        </li>
                        <li>
                            <b style="letter-spacing: 0.6px;">Qualification </b> 
							<span>&nbsp;&nbsp;: &nbsp;{{isset($arr_interview['qualification_name'])?ucfirst($arr_interview['qualification_name']):' '}}</span>
                        </li>
                        <li>
                            <b style="letter-spacing: 0.6px;">Specialization </b>
                            <span>: &nbsp;{{isset($arr_interview['specialization_name'])?ucfirst($arr_interview['specialization_name']):'NA'}}</span>
                        </li>                        
                    </ul>
                </div>
                <form method="POST" action="{{url('/')}}/payment/order_summery">
                {{ csrf_field() }}
                <div class="col-lg-2">
                <div id="error_validation_msg" class="error" ></div>
                    <div class="buy-now-wrapper">

                        <h3><div id="interview_amount"> INR 0.00</div></h3>
                        
                        <input type="hidden" name="TextResumeType" id="TextResumeType" value="0" >
                        <input type="hidden" name="TextResume" id="TextResume" value="0.00" >
                        <input type="hidden" name="total_interview_price" id="total_interview_price" value="0.00" >
                        <input type="hidden" id="ref_book_price" value="0.00">
                        <input type="hidden" name="training_classes" id="training_classes" value="0.00">
                        <input type="hidden" name="total_ticket_price" id="total_ticket_price" value="0.00" >
                        <input type="hidden" name="grand_price" id="grand_price" value="0.00" > 
                        <input type="hidden" name="enc_experience_level" value="{{ $experience_level or '-'}}">
                        <input type="hidden" name="enc_interview_id" value="{{ $interview_id or '-'}}">
                        <input type="hidden" name="enc_user_id" id="enc_user_id" value="{{ $user_id or '-'}}">
                        <input type="hidden" name="enc_skill_id" id="enc_skill_id" value="{{ $skill_id or '-'}}">
                        <input type="hidden" name="enc_skill_name" value="{{$skill_name or 'NA'}}">
                        <input type="hidden" name="ticket_unique_id" id="ticket_unique_id" value="">
                        <input type="hidden" name="schedule_id" id="schedule_id" value="" />
											        		
                        <!-- <h4>30 Days Validity</h4> -->
                       <button type="submit" onclick="javascript: return validation();" class="buy-btn">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
        <!-- Tab Ramakrishna start -->
		<div class="appom-box search-detail-tabs" style="padding-top: 10px !important;">
			<div class="box-m">
				<div class="tab-contact">
					<div data-responsive-tabs="" class="tabs responsive-tabs responsive-tabs-initialized">
						<nav>
							<div class="container">
								<ul class="options" style="border-bottom:none;">
									
									<li class="box tab-box active" id="interview-coach" onclick="showBoxTab('tabTextResume');">
										<a href="#tabTextResume">Interview Coach</a>
										<div class="check-box referencebook_textResume" style="padding: 15px 15px 0px 15px;">
										<?php
										$sql ='select count(*) as cnt,interview_id FROM `purchase_history` as p INNER JOIN `transaction` as t ON t.id = p.trans_id  where p.`interview_id`="'.$arr_interview['id'].'" AND p.`TextResumeType`=1 AND t.payment_status = "paid" AND t.ticket_unique_id NOT IN (SELECT unique_id FROM `review_rating` where `interview_id`="'.$arr_interview['id'].'")';
										$result = DB::select(DB::raw($sql));
										
										if(isset($result) AND ($result[0]->cnt > 10) ){
											?>
											<i class="fa fa-inr" style="margin-bottom: 10px;"><span class="tab-price">{{ number_format($arr_price_list['validity'], 0, '', '')}}</span></i>
											<br>
											<p class="fulled-bookings">
												<span style="text-align: center;font-size: 15px;padding-left: 20px;">Fully Booked</span>
											</p>
											<?php
											$notificationsCount = $notificationModel->where(['interview_id'=>$arr_interview['id'], 'user_id'=>$auth_user_id, 'status'=>1])->count();
											$notifyChecked = ($notificationsCount > 0 && Sentinel::check()) ? 'checked="checcked"' : '';	
											?>
											<p style="margin-top:15px"><input class="css-checkbox ads_Checkbox" value="1" id="coach_notify" name="coach_notify" type="checkbox" {{$notifyChecked}}>
											<label class="css-label radGroup2" for="coach_notify"  title="Check this box to receive notification email of this coach availability."></label><span style="font-size:13px"  title="Check this box to receive notification email of this coach availability.">Notify Me</span></p>	
											<?php
										}else{
										?>		<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['validity']}}" id="radio_textresume" name="reference_book_textResume" type="checkbox">
												<!--<label class="css-label radGroup2" for="radio_textresume"></label>-->
												<i class="fa fa-inr"><span class="tab-price">{{ number_format($arr_price_list['validity'], 0, '', '')}}</span></i>
												<label id="coach_booknow_btn" class="member-profile-btn" for="radio_textresume" style="text-transform: none;font-size: 17px !important;max-width: 134px;margin-top: 10px;cursor:pointer;height: 35px;padding: 6px 0;">Book Now</label>												
												
										<?php
										}
										?>
										</div>
										<p><span>&#10022;</span> One on one session</p>
										<p><span>&#10022;</span> 1 week (10 Hours) coaching</p>
										<p><span>&#10022;</span> Ask any questions/Topics/Doubts related to coach experience</p>
										
									</li>
									<li class="box tab-box" id="interview-qa" onclick="showBoxTab('tab1InterView');">
										<a href="#tab1InterView">Interview Q &amp; A  </a>
										<div class="check-box referencebook">
											<input  class="css-checkbox ads_Checkbox"  value="{{$arr_price_list['ref_book_price']}}"  id="radio_02" name="reference_book" type="checkbox">
											<label class="css-label radGroup2" for="radio_02"></label>
											<i class="fa fa-inr"><span class="tab-price">{{ number_format($arr_price_list['ref_book_price'], 0, '', '')}}</span></i>
										</div>
										<p><span>&#10022;</span> Most of the Q & A which are asked in interviews are covered</p>																				
									</li>
									@if(!empty($arr_user_info[0]['company_qa_tab']) && $deactivate_company_tab == 0)
									<li class="box tab-box " id="interview-company" onclick="showBoxTab('tab2Company');">
										<a href="#tab2Company">Interviews By Companies</a>
										<div class="check-box">
										<i class="fa fa-inr" style="width: 60%;"><span class="tab-price">{{ number_format($arr_price_list['interview_price'], 0, '', '')}}</span> <span style="font-size: 12px;text-transform: initial;">Each</span></i>
										</div>
										<p><span>&#10022;</span> Q & A asked in interview rounds of direct companies covered(For example : Techincal Round, Project Manager Round, Hr Round)</p>						
									</li>
									@endif
									@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
									<li class="box tab-box realissues" id="interview-realissues" onclick="showBoxTab('tab3RealTime1');" style="width: 21%;">
										<a href="#tab3RealTime1">Real Time Work Experience<!-- <br>(Tickets, Tasks, Etc.,) --></a>
										<div class="check-box nooftickets" style="border-bottom: none;">
											<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['price_for_25_ticket'] or 0.00}}" id="radio14" name="radio_ticket[price_for_25_ticket]" type="checkbox" title="25">
											<label class="css-label radGroup2" for="radio14" style="margin-right: -38px;">&nbsp;</label>
											<i class="fa fa-inr col-sm-12 pull-right" style="width: 75%;font-size: 13px;text-align: left;"><span style="font-size: 16px;margin-right: 8px;">{{ number_format($arr_price_list['price_for_25_ticket'], 0, '', '')}}</span><span style="top: -2px;position: relative;">-</span><span class="circle"><span style="font-size: 10px;position: absolute;padding: 0px;margin-top: 4px;margin-left: -10px;">25</span></span></i>
										</div>
										<div class="check-box nooftickets" style="border-bottom: none;">
											<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['price_for_50_ticket'] or 0.00}}" id="radio15" name="radio_ticket[price_for_50_ticket]" type="checkbox" title="50">
											<label class="css-label radGroup2" for="radio15" style="margin-right: -38px;">&nbsp;</label>
											<i class="fa fa-inr col-sm-12 pull-right" style="width: 75%;font-size: 13px;text-align: left;"><span style="font-size: 16px;margin-right: 8px;">{{ number_format($arr_price_list['price_for_50_ticket'], 0, '', '')}}</span><span style="top: -2px;position: relative;">-</span><span class="circle"><span style="font-size: 10px;position: absolute;padding: 0px;margin-top: 4px;margin-left: -10px;">50</span></span></i>
										</div>
										<div class="check-box nooftickets">
											<input class="css-checkbox ads_Checkbox"  value="{{$arr_price_list['price_for_75_ticket'] or 0.00}}" id="radio16" name="radio_ticket[price_for_75_ticket]" type="checkbox" title="75">
											<label class="css-label radGroup2" for="radio16" style="margin-right: -38px;">&nbsp;</label>
											<i class="fa fa-inr col-sm-12 pull-right" style="width: 75%;font-size: 13px;text-align: left;"><span style="font-size: 16px;margin-right: 8px;">{{ number_format($arr_price_list['price_for_75_ticket'], 0, '', '')}}</span><span style="top: -2px;position: relative;">-</span><span class="circle"><span style="font-size: 10px;position: absolute;padding: 0px;margin-top: 4px;margin-left: -10px;">75</span></span></i>
										</div>
										<p><span>&#10022;</span> Common issues, major issues, Tasks in every day work life and daily job resposibilities are covered</p>										
									</li>
									@endif
									@if(!empty($arr_user_info[0]['training_tab']) && !empty($arr_training_schedule))
									<li class="box tab-box " id="interview-onlineclass"  onclick="showBoxTab('tab4TrainingClasses');">
										<a href="#tab4TrainingClasses">Online Class</a>										
										<div class="check-box reference_training_enrollment">
											<input class="css-checkbox ads_Checkbox"  value="{{$arr_price_list['training_price'] or 0.00}}" id="radio_training_enrollment" name="reference_training_enrollment" type="checkbox" title="75">
											<label class="css-label radGroup2" for="radio_training_enrollment">&nbsp;</label>
											<i class="fa fa-inr"><span class="tab-price">{{ number_format($arr_price_list['training_price'], 0, '', '')}}</span></i>
										</div>
										<p><span>&#10022;</span> All the topics that are mentioned in curriculam are covered in the training program</p>	
									</li>
									@endif
								</ul>
							</div>
						</nav>
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="content">
										<section id="tabTextResume" style="display: block;">
											<div class="row">
												
												<?php 
												$userInfo = DB::table('interview_coach')->where('User_Id', $user_id)->first();
												if(isset($userInfo)){
													if(!empty($userInfo->banner_image))
													{
														$bgImage = url('/').'/uploads/profile_images/interviewCoach/'.$userInfo->banner_image;
													}
													else{
														$bgImage = url('/').'/images/coach_banner.jpg';
													}
													
													if(!empty($userInfo->profile_image))
													{
														$profile_image = url('/').'/uploads/profile_images/interviewCoach/'.$userInfo->profile_image;
													}
													else{
														$profile_image = url('/').'/images/Profile-img.jpg';
													}
													
													$obj_member_details = DB::table('member_detail')->where('id',$member_id)->first();
													$countryDetails = DB::table('countries')->where('id',$obj_member_details->education_country_id)->first();
													$stateDetails = DB::table('state')->where('id',$obj_member_details->education_state)->first();
													$cityDetails = DB::table('city')->where('city_id',$obj_member_details->education_city)->first();
													
												?>
												<div class="col-md-7" style="padding:0px">
													<div class="card hovercard" style="padding-right: 0px;padding-left: 0px;height:auto !important;">
														<div class="cardheader"></div>
														<div class="avatar" style="background-image: url('{{$bgImage}}');height: 150px; margin-bottom: 0px;background-size: 100% 100%;">
															 <img src="{{$profile_image}}" style="width:100%; margin-top: 95px;">
														</div>
														<div class="info" style="padding:15px;line-height:25px;">
															<b style="font-size: 18px;">{{$userInfo->FirstName}} {{ $userInfo->LastName}}</b><br/>
															<span style="font-size: 16px;">{{$userInfo->Headline}}</span><br/>
															<span style="font-size: 14px;">{{$countryDetails->country_name}}, {{$stateDetails->state_name}}, {{$cityDetails->city_name}}</span><br/><hr/>
															<span class="member_summary hide" style="text-align:justify; display:block;font-family: ubuntulight;">{!!nl2br($userInfo->Summary)!!}</span>
														</div>
														<span aria-hidden="true" class="see-more-info-btn"><span>See More</span> <i class="fa fa-angle-down" style="font-size:24px"></i></span>
													</div>
													<div class="card hovercard" style="padding-right: 0px;padding-left: 0px;margin-top:10px;height:auto !important;">
													<?php
													$employeeDetails = DB::table('employer_type')->where('member_id', $member_id)->get();
													if(count($employeeDetails) > 0)
													{
													foreach($employeeDetails as $key=>$employee)
													{
														$display = ($key < 2) ? 'show' : 'hide';
														$employer = ($key < 2) ? '' : 'employer';
													?>
													
														@if($key == 0)
														<div class="col-sm-12">
														<h3 style="text-align:left;font-size:20px;">Experience</h3>
														</div>
														@endif
														
														<div class="col-sm-12 employment_details {{$employer}} {{$display}}" style="text-align:left;">
														  <h3 class="desig-details" style="margin-top: 15px;">{{ $employee->designation }}</h3>

														  <p class="company-details">
															<span class="lbl-right" style="line-height: 13px;">{{ ($employee->display_company) ? $employee->display_company : $employee->company_name }}</span>
														  </p>
															<p class="company-join-date" style="line-height: 13px;">
															
																<?php
																	$startDate = $employee->start_year.'-'.$employee->start_month.'-01';
																	if($employee->end_month == 'present')
																	{
																		$end_month = date('m');
																		$end_year = date('Y');
																	}
																	else
																	{
																		$end_month = $employee->end_month;
																		$end_year = $employee->end_year;
																	}
																		
																	
																	$endDate = $end_year.'-'.$end_month.'-01';
																	$datetime1 = new DateTime($startDate);
																	$datetime2 = new DateTime($endDate);
																	$interval = $datetime1->diff($datetime2);
																?>	
																
																@if($employee->employer_type == 'current')																
																<span class="lbl-right">{{ date('M', mktime(0, 0, 0, $employee->start_month, 10)) }} {{ $employee->start_year }} – {{ $employee->end_month }} &nbsp;<b>&#8226;</b>&nbsp;{{$interval->format('%yyrs %mmos')}}</span>	
																@else	
																<span class="lbl-right">{{ date('M', mktime(0, 0, 0, $employee->start_month, 10)) }} {{ $employee->start_year }} – {{ date('M', mktime(0, 0, 0, $employee->end_month, 10)) }} {{ $employee->end_year }} &nbsp;<b>&#8226;</b>&nbsp;{{$interval->format('%yyrs %mmos')}}</span>
																@endif
															</p>
														  <p class="company-details">
															<?php
																$empCountryDetails = DB::table('countries')->where('id',$employee->country)->first();
																$empStateDetails = DB::table('state')->where('id',$employee->state)->first();
																$empCityDetails = DB::table('city')->where('city_id',$employee->city)->first();
															?>
															<span class="lbl-right" style="line-height: 13px;">{{$empCityDetails->city_name}}, {{$empStateDetails->state_name}}, {{$empCountryDetails->country_name}}</span>
														  </p>		
														  <p class="company-details" style="padding-top: 10px;">
															<span class="lbl-right">{!! nl2br($employee->description) !!}</span>
														  </p>
															<p style="border-bottom: 1px solid #eee;"></p>
															<!--<p class="company-end-date">
															  <span class="lbl-left">Employment Duration : </span>
															  <span  class="lbl-right">1 yr 2 mos</span>
															</p>-->

														</div>
														@if($key == count($employeeDetails)-1 && count($employeeDetails) > 2)
														<span aria-hidden="true" class="see-more-btn"><span>See More</span> <i class="fa fa-angle-down" style="font-size:24px"></i></span>
														@endif
																											
													<?php } } ?>
													</div>
													<?php /* ?><div style="background-color:#fff;">
													<span style="border-radius:50px; border:1px solid #ccc; padding: 10px;float: left;">Interview Q &amp; A</span><div class="clearfix"></div><p style="text-align:justify;float: left;">{{$userInfo->Interview}}</p> </div>
													<div class="clearfix"></div><br/>
													<div style="background-color:#fff">
													<span style="border-radius:50px; border:1px solid #ccc; padding: 10px;float: left;">Interviews By Companies</span><div class="clearfix"></div><p style="text-align:justify;float: left;">{{$userInfo->Companies}}</p> </div>
													<div class="clearfix"></div><br/>
													<div style="background-color:#fff">
													<span style="border-radius:50px; border:1px solid #ccc; padding: 10px;float: left;">Real Time Issues</span><div class="clearfix"></div><p style="text-align:justify;float: left;">{{$userInfo->Issues}}</p> </div><?php */ ?>
												</div>
												<?php
												}else{
													?>
													<div class="col-md-7"></div>
													<?php
												}
												?>
												<div class="col-md-5">
													<h5 style="text-decoration:underline">Coaching Process</h5>
													<div>
														<p>Once you book interview coach you will receive a call from your coach within one business day, (mostly within a couple of hours). Your coach will schedule your appointment for a week based on your availability time.</p>
													</div>
													<h5 style="text-decoration:underline">What's Included</h5>
													<div>
														<ul>
															<li><i class="fa fa-circle-o" aria-hidden="true"></i> One to one session between the interview coach and learner for personal mentoring or doubt solving ensuring 100% personalized attention at learners pace.</li>
															<li><i class="fa fa-circle-o" aria-hidden="true"></i> You will be guided what to prepare for the interviews. Learn from your home, anytime.One interview  mock session will be taken and you will be given a feedback based on your performance to improve further and perfect your interview techniques.</li>
															<li class="whats_inclde"><i class="fa fa-circle-o" aria-hidden="true"></i> You should send your CV which will help the interviewer to analyze and provide feedback as it will help the interviewer ask you more relevant and appropriate questions based on your knowledge and experience.</li>
															<li class="whats_inclde"><i class="fa fa-circle-o" aria-hidden="true"></i> Preparation of your resume.</li>
														</ul>
														
													</div>
													
													<script>
														$(document).ready(function(){
															$(".seemore_whats_include").click(function(){
																$(".whats_inclde").toggleClass('hide show');
																$(this).hide();
																$('.less_whats_include').show();
															});
															$(".less_whats_include").click(function(){
																$(".whats_inclde").toggleClass('show hide');
																$(this).hide();
																$('.seemore_whats_include').show();
															});
															$(".seemore_adv_coach").click(function(){
																$(".adv_coach").toggleClass('hide show');
																$(this).hide();
																$('.less_adv_coach').show();
															});
															$(".less_adv_coach").click(function(){
																$(".adv_coach").toggleClass('show hide');
																$(this).hide();
																$('.seemore_adv_coach').show();
															});
															$(".see-more-btn").click(function(){
																$(".employer").toggleClass('show hide');
																$(this).find('i').toggleClass('fa-angle-down fa-angle-up');
																var text = $(this).find('span').html();
																if(text == 'See More')
																{
																	$(this).find('span').html('See Less');
																}
																else{
																	$(this).find('span').html('See More');
																}
																
															});
															$(".see-more-info-btn").click(function(){
																$(".member_summary").toggleClass('show hide');
																$(this).find('i').toggleClass('fa-angle-down fa-angle-up');
																var text = $(this).find('span').html();
																if(text == 'See More')
																{
																	$(this).find('span').html('See Less');
																}
																else{
																	$(this).find('span').html('See More');
																}
																
															});
															$("#coach_notify").click(function(){
																var user_auth = '{{Sentinel::check()}}';
																																
																if(user_auth == '')
																{
																	window.location.href = "{{url('user/login')}}";
																}
																else{
																	var interview_id = "{{$arr_interview['id']}}";
																	var user_id = "{{$auth_user_id}}";
																	var message = "{{$arr_interview['skill_name']}} Real Time Interview Questions & Answers ({{$arr_interview['experience_level']}})";
																	var coach_notify =  $("input:checkbox[name='coach_notify']:checked").length;

																	link = "{{url('notify-coach')}}";
																	jQuery.ajax({
																		url:link,
																		type:'get',
																		dataType:'json',
																		data:{'coach_notify' : coach_notify, 'interview_id' : interview_id, 'user_id' : user_id, 'message' : message},
																		cache:false,
																		success:function(response)
																		{
																			if(response.status == true)
																			{
																				alert('Notification Successfully submitted');
																			}
																		}
																	});
																}
															});
														});
																											</script>
													<h5 style="text-decoration:underline">Advantages of an interview coach</h5>
													<div>
														<p>Our Coaches are subject matter experts having industry experience. They are handpicked to provide quality interview coaching through online video & telephonic sessions.Get inspired, motivated, educated and be guided by a process expert. Our coaches are always learning and growing with their profession.Get Interview experiences from the most experienced interviewees. All the members are real time working professionals from MNC companies. They understand the importance of the mock interviews, as they too have been in this situation while applying for jobs.</p>
													</div>
													<h5 style="text-decoration:underline">Who should take this coaching</h5>
													<div>
														<p>Suitable for learners who have already done this course training and has a good understanding of the course contents.</p>
													</div>
												</div>
											</div>
										</section>
										<section id="tab1InterView" style="display: none;">
											<div class="col-md-9">
												
												<ul>
													@if(isset($arr_interview['reference_book_details']) && sizeof($arr_interview['reference_book_details'])>0)
												    <?php
													$i=0;
													?>
													@foreach($arr_interview['reference_book_details'] as $reference_book)
													<?php
													$i++;
													if($i==1){
													   $results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$reference_book['interview_id']."' AND approve_status='1' group by topic_name") );
														foreach ($results as $key=>$user) {
															$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 90, '...')));
															?>
																<li style="line-height:35px;background-color:#eee"><b title="{{$user->topic_name}}" style="margin-left:25px;">{{$key+1}} . {{$string}}</b>
																<?php
																   $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$reference_book['interview_id']."' AND topic_name = '".$user->topic_name."'") );
																   //print_r($results1);
																	foreach ($results1 as $key1=>$user1) {
																		 if($user1->file_extension =='Pdf'){
																			 $icon='<i class="fa fa-file-pdf-o" style="color: #17b0a4;"></i>';
																			 $href='#home'.$user1->id;
																			 $dataId=$user1->id;
																		 }else if($user1->file_extension =='Video'){
																			 $icon='<i class="fa fa-play" style="color: #17b0a4;"></i>';
																			 $href='#video'.$user1->id;
																			 $dataId=$user1->id;
																		 }else{
																			 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
																			 $href='#';
																			 $dataId="";
																		 }
																		 
																?>
																	<ul class="row" style="margin: 0px">
																		<li style="border:1px solid #eee;padding-left:45px;line-height:35px;background-color:#fff !important;width: 100%;float: left;"> 
																			<span class="col-sm-4"><?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} </span>
																			<span class="col-sm-2" align="center">
																			<?php 
																			if($user1->freePreview =='Yes'){
																				$dow="/uploads/refrence_book/".$user->mul_reference_book;
																				$previewUrl= url('/')."/".str_replace(" ","-",$user->topic_name)."/preview/".base64_encode($reference_book['interview_id']);
																			?>
																			<a href="<?php echo $previewUrl?>" target="_New"><span style="margin-right:15px;">Preview</span></a>
																			<?php }
																			?>
																			</span>
																			<span class="col-sm-3" align="right">{{$user1->pageCount}}</span>
																			<span class="col-sm-2" align="right">{{$user1->fileSize}} M.B</span>																				
																		</li>
																	
																	</ul>
																<?php
																	}
																	?>
																</li>
															<?php
														}
													}
												   ?>
														
													@endforeach
													@endif
												   </ul>
											</div> 
											<div class="col-md-3">
												<div class="search-detail-rightSection">
													<!--contact details box-->
													<?php /*<div class="contact-details pull-right">
														<div class="inner-details">
															<h4 style="color:#fff">Customer Support</h4>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Landline:</h5>
																	<h6>040-464687</h6>
																</div>
															</div>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Mobile no.:</h5>
																	<!-- <h6>9000000009</h6> -->
																	 <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
																</div>
															</div>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Email:</h5>
																	<!-- <h6 class="email">support@interviewxp.com</h6> -->
																	<h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
																</div>
															</div>
														</div>
													</div>*/ ?>
													<!--end-->
													
													<div class="clr">&nbsp;</div>
													

													<div class="clr"></div>
													 <div class="user-view content-d">
														<h4>User Who Viewed This Also Viewed</h4>
													   
														  @if(isset($arr_otherinterview) && sizeof($arr_otherinterview)>0)
															@foreach($arr_otherinterview as $otherinterview)  
															<div class="sub-view" style="padding: 0 5px;">
															<a href="{{url('/')}}/interview_details/{{base64_encode($otherinterview['id'])}}">
																  <div class="db-angle"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
																   <div class="php"><h6>{{isset($otherinterview['skill_name'])?ucfirst($otherinterview['skill_name']):' '}} Real Time Interview Question &amp; Answers <span>({{isset($otherinterview['experience_level'])?$otherinterview['experience_level']:' '}} Years exp)</span></h6></div>
																</a>   
																</div>
															@endforeach
															@else
															  <div class="sub-view">
																   <div class="php" style="text-align: center; color: red;">
																		Sorry no records found.
																   </div>
																</div>
														  @endif  
														</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</section>
										@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
										<section id="tab3RealTime1" style="display:none;">
											<div class="col-md-9" style="padding: 0px">
											<!-- <div class="row nooftickets">
												<div class="col-sm-4">
													<div class="check-d act">
													<div class="check-box-big">
															<input class="css-checkbox-big" value="{{$arr_price_list['price_for_25_ticket'] or 0.00}}" id="radio14" name="radio_ticket[price_for_25_ticket]" type="checkbox" title="25">
															<label class="css-label radGroup2" for="radio14">&nbsp;</label>
													</div>
														<div class="middle-boxes">
															<h2>25</h2>
															<p style="font-size:13px !important;">Real Time Work Experience<br/> (Tickets, Tasks &amp; Issues)</p>
															<h3>Rs. {{$arr_price_list['price_for_25_ticket'] or 0.00}}</h3>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="check-d">
														<div class="check-box-big">
															<input class="css-checkbox-big" value="{{$arr_price_list['price_for_50_ticket'] or 0.00}}" id="radio15" name="radio_ticket[price_for_50_ticket]" type="checkbox" title="50">
															<label class="css-label radGroup2" for="radio15">&nbsp;</label>
														</div>
														<div class="middle-boxes">
															<h2>50</h2>
															<p style="font-size:13px !important;">Real Time Work Experience<br/> (Tickets, Tasks &amp; Issues)</p>
															<h3>Rs. {{$arr_price_list['price_for_50_ticket'] or 0.00}}</h3>
														</div>
													</div>
												</div>
												
												<div class="col-sm-4">
													<div class="check-d">
														<div class="check-box-big">
															<input class="css-checkbox-big"  value="{{$arr_price_list['price_for_75_ticket'] or 0.00}}" id="radio16" name="radio_ticket[price_for_75_ticket]" type="checkbox" title="75">
															<label class="css-label radGroup2" for="radio16">&nbsp;</label>
														</div>
														<div class="middle-boxes">
															<h2>75</h2>
															<p style="font-size:13px !important;">Real Time Work Experience<br/> (Tickets, Tasks &amp; Issues)</p>
															<h3>Rs. {{$arr_price_list['price_for_75_ticket'] or 0.00}}</h3>
														</div>
													</div>
												</div>
											</div> -->
											<br/>
											<?php
											//$ticketslist = DB::select( DB::raw("SELECT * FROM `member_real_time_experience`	WHERE `interview_id` = ".$arr_interview['id']." AND `user_id` = ".$arr_interview['user_id']." AND `member_id` = ".$arr_interview['member_id']." AND `skill_id` = ".$arr_interview['skill_id']." AND `experience_level` = '".$arr_interview['experience_level']."' AND `approve_status` = '1' ORDER BY `issue_title` DESC limit 0,10") );
											$ticketslist = DB::table('member_real_time_experience')
												        ->select('*')
												        ->where(['interview_id'=>$arr_interview['id'], 'user_id'=>$arr_interview['user_id'], 'member_id'=>$arr_interview['member_id'], 'skill_id'=>$arr_interview['skill_id'], 'experience_level'=>$arr_interview['experience_level'], 'approve_status'=>1])
												        ->orderBy('issue_title','DESC')
												        ->paginate(10);
									        ?>
									        <div id="realissues-list">
												 @include('front.rtresult',['page'=>1])											
											</div>
											</div>
											<div class="col-md-3">
												<div class="search-detail-rightSection">
													<!--contact details box-->
													<?php /*<div class="contact-details pull-right">
														<div class="inner-details">
															<h4 style="color:#fff">Customer Support</h4>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Landline:</h5>
																	<h6>040-464687</h6>
																</div>
															</div>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Mobile no.:</h5>
																	<!-- <h6>9000000009</h6> -->
																	 <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
																</div>
															</div>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Email:</h5>
																	<!-- <h6 class="email">support@interviewxp.com</h6> -->
																	<h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
																</div>
															</div>
														</div>
													</div>*/ ?>
													<!--end-->
													
													<div class="clr">&nbsp;</div>

													<div class="clr"></div>
													 <div class="user-view content-d">
														<h4>User Who Viewed This Also Viewed</h4>
													   
														  @if(isset($arr_otherinterview) && sizeof($arr_otherinterview)>0)
															@foreach($arr_otherinterview as $otherinterview)  
															<div class="sub-view" style="padding: 0 5px;">
															<a href="{{url('/')}}/interview_details/{{base64_encode($otherinterview['id'])}}">
																  <div class="db-angle"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
																   <div class="php"><h6>{{isset($otherinterview['skill_name'])?ucfirst($otherinterview['skill_name']):' '}} Real Time Interview Question &amp; Answers <span>({{isset($otherinterview['experience_level'])?$otherinterview['experience_level']:' '}} Years exp)</span></h6></div>
																</a>   
																</div>
															@endforeach
															@else
															  <div class="sub-view">
																   <div class="php" style="text-align: center; color: red;">
																		Sorry no records found.
																   </div>
																</div>
														  @endif  
														</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</section>
										@endif
										@if(!empty($arr_user_info[0]['company_qa_tab']) && $deactivate_company_tab == 0)
										<section id="tab2Company" style="display:none;">
											<div class="col-md-9">
											 @if(isset($company_details) && sizeof($company_details)>0 )
												@foreach($company_details as $interview_company)
													<div class="search-detail-checkbox">
														<div class="col-sm-12">
															<div class="check-box noofcompany">
																<ul>
																<?php
																	$interviewid = DB::table('interview_detail')
																			  ->where('company_id', '=', $interview_company['company_id'])
																			  ->orderBy('id','desc')
																			  ->first();			
																   $results = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$interviewid->interview_id."' AND approve_status='1' group by company_id") );
																	foreach ($results as $key=>$user) {
																		$delete="/member/delete_interview_all/".base64_encode($user->company_id);
																		$att = DB::table('interview_detail')
																			  ->where('company_id', '=', $user->company_id)
																			  ->orderBy('id','desc')
																			  ->first();
																		if($att->roundType =='Call / Email Schedul')
																			$typeofRound='addTechRoundAdd';
																		else if($att->roundType =='Technical Round')
																			$typeofRound='addPmRoundAdd';
																		else if($att->roundType =='PM Round')
																			$typeofRound='addHrRoundAdd';
																		else
																			$typeofRound='NoAdd';
																		
																		$NameCompany = DB::table('company_master')
																			  ->where('company_id', '=', $user->company_id)
																			  ->first();
																		$NameC=$NameCompany->company_name;
																		?>
																		
																		
																		<li style="border:1px solid #eee; line-height:35px; padding-left:20px; padding-right:20px;" title="{{$user->topic_name}}"><input  class="css-checkbox ads_Checkbox"  value="1"  id="radio_{{$user->company_id}}" name="company[{{$user->company_id}}]" type="checkbox"><label class="css-label radGroup2" for="radio_{{$user->company_id}}"></label><b> {{$NameC}} ({{$user->company_location}}) </b> <img src="../images/down-arow.png" class="downArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		<img src="../images/up-arow.png" class="upArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		
																			<?php
																			   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$interviewid->interview_id."' AND company_id = '".$user->company_id."'") );
																				foreach ($results1 as $key1=>$user1) {
																					 if($user1->file_extension =='Pdf'){
																						 $icon='<i class="fa fa-file-pdf-o" style="color: #17b0a4;"></i>';
																					 }
																						 
																					 if($user1->file_extension =='Video'){
																						 $icon='<i class="fa fa-play" style="color: #17b0a4;"></i>';
																					 }
																					 
																					 if($user1->approve_status==1){
																						 $status="Approved";
																						 $action='';
																					 }
																						 
																					 else{
																						 $status="Pending";
																						 $url="/member/delete_interview/".base64_encode($user->id);
																						 $action='<a class="delete-i"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;" href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																					 }
																					 
																					 
																				?>
																				<ul  class="row downUl" style="margin: 0px" style="margin-left:30px;">
																					<li style="border:1px solid #eee; line-height:35px; padding-left:20px; width: 100%; float: left;">
																						<span class="col-sm-4" style="display: inline-block;"><?php echo $icon ?> &nbsp;&nbsp; {{$user1->roundType}} </span>
																						<span class="col-sm-2" align="center">
																							<?php 
																							if($user1->freePreview =='Yes'){
																								$dow="/uploads/refrence_book/".$interviewid->interview_id;
																								$previewUrl= url('/')."/".base64_encode($user->company_id)."/preview-company/".base64_encode($interviewid->interview_id);
																							?>
																							<a href="<?php echo $previewUrl?>" target="_New"><span style="margin-right:15px;">Preview</span></a>
																							<?php }
																							?>
																						</span>
																						<span class="col-sm-3" align="right">{{$user1->pageCount}}</span>
																						<span class="col-sm-2" align="right">{{$user1->fileSize}} M.B</span>																						
																					</li>
																				</ul>
																				
																				<?php
																				}
																				?>
																				</li>
																	<?php
																}
															   ?>
															   
															   </ul>
															</div>
														</div>
													</div>
													@endforeach
													 @else
														<div class="error">No records found</div>
													@endif 
												<input type="hidden" id="interview_price" value="{{$arr_price_list['interview_price'] or 0.00 }}">
											</div>
											<div class="col-md-3">
												<div class="search-detail-rightSection">
													<!--contact details box-->
													<?php /*<div class="contact-details pull-right">
														<div class="inner-details">
															<h4 style="color:#fff">Customer Support</h4>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Landline:</h5>
																	<h6>040-464687</h6>
																</div>
															</div>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Mobile no.:</h5>
																	<!-- <h6>9000000009</h6> -->
																	 <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
																</div>
															</div>
															<div class="inner-details2">
																<div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
																<div class="contact-details2">
																	<h5 style="color:#fff;">Email:</h5>
																	<!-- <h6 class="email">support@interviewxp.com</h6> -->
																	<h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
																</div>
															</div>
														</div>
													</div>*/ ?>
													<!--end-->
													
													<div class="clr">&nbsp;</div>
													<div class="create-alerts">
														<h4>Create Alerts</h4>
														<h6>Will you receive alerts based on your skills</h6>
													  
													  <form method="post" enctype="multipart/form-data" action="{{-- {{url('/')}} --}}/subscribe">
													   {{ csrf_field() }}
													  <input type="hidden" name="skill_id" value="{{isset($arr_interview['skill_id'])?ucfirst($arr_interview['skill_id']):'NA'}}">
													  <input type="hidden" name="exp_level" value="{{isset($arr_interview['experience_level'])?$arr_interview['experience_level']:'NA'}}">
													  <input type="hidden" name="skill_name" value="{{isset($arr_interview['skill_name'])?ucfirst($arr_interview['skill_name']):'NA'}}">
														<div class="error" id="err_alert_message" style="font-size:16px;"></div>
														<div id="succ_alert_message" style="font-size:16px; color:green;"></div>
														<button type="button" onclick="return subscribe()" class="subscribe">Subscribe</button>
													  </form> 
													  
													</div>

													<div class="clr"></div>
													 <div class="user-view content-d">
														<h4>User Who Viewed This Also Viewed</h4>
													   
														  @if(isset($arr_otherinterview) && sizeof($arr_otherinterview)>0)
															@foreach($arr_otherinterview as $otherinterview)  
															<div class="sub-view" style="padding: 0 5px;">
															<a href="{{url('/')}}/interview_details/{{base64_encode($otherinterview['id'])}}">
																  <div class="db-angle"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
																   <div class="php"><h6>{{isset($otherinterview['skill_name'])?ucfirst($otherinterview['skill_name']):' '}} Real Time Interview Question &amp; Answers <span>({{isset($otherinterview['experience_level'])?$otherinterview['experience_level']:' '}} Years exp)</span></h6></div>
																</a>   
																</div>
															@endforeach
															@else
															  <div class="sub-view">
																   <div class="php" style="text-align: center; color: red;">
																		Sorry no records found.
																   </div>
																</div>
														  @endif  
														</div>
													<div class="clearfix"></div>
												</div>
											</div>
										</section>
										@endif
										@if(!empty($arr_user_info[0]['training_tab']) && !empty($arr_training_schedule))
										<section id="tab4TrainingClasses" style="display:none;">
											<div class="container demo">

    
											    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
											    <div class="row">
											    	<div class="col-sm-8">
											    	<div class="panel" style="margin-top: -30px;">
											            <h3>Curriculam</h3>
											        </div>
											        <div class="accordion">
											    	 @if(isset($arr_training_curriculam) && sizeof($arr_training_curriculam)>0)
                                      				 @foreach($arr_training_curriculam as $key => $value)
                                      				 

											        <h3>
											        <span>{{ $key+1}}. {{$value['title']}}<i class="more-less fa fa-chevron-down pull-right"></i></span>
											        </h3>
												    <div class="tab1">
												        {{$value['description']}}
												    </div>
											        @endforeach
											        @else
											        <div style="color:red;" colspan="2">
		                                           		No Records found...
		                                            </div>
											        @endif
											        </div>
											        </div>
											        <div id="right_container" class="col-sm-4">
											        	<div id="training_enrollments" class="col-sm-12">
										        			<!-- <label for="radio_training_enrollment" class="member-profile-btn check-box reference_training_enrollment" style="margin-bottom:15px; cursor:pointer">
															<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['training_price']}}" id="radio_training_enrollment" name="reference_training_enrollment" type="checkbox">
															Enroll Now
															</label> -->
															
											        		<div class="training_schedule">
												        		<b>Training :</b>
												        		<div class="select-number">
												        			<select id="schedules" name="schedules">
												        			@foreach($arr_training_schedule as $key => $value)
										                              <option value="{{$value['id']}}" {!! ($key == 0) ? 'selected="selected"' : ''  !!}>{{date('dS F Y',strtotime($value['date'])) }} - {{  date('h:ia',strtotime($value['start_time'])) }}</option>	
									                                @endforeach									                             
										                            </select>
												        		</div>
											        		</div>
											        		@foreach($arr_training_schedule as $key => $value)		
											        		<?php
											        			$start_date = $value['created_at'];
											        			$max_allowed = $value['max_allowed'];
											        			$closing_days = config('constants.CLOSE_SCHEDULE_DAYS');
											        			$newEndDate = strtotime("+".$closing_days." days", strtotime($value['date']));
											        			$end_date = date("Y-m-d H:i:s", $newEndDate);
		                                      				 	$scheduleCount = DB::table('transaction')
		                                      				 				->join('purchase_history','purchase_history.trans_id','=','transaction.id')
																			->where('member_user_id', '=', $user_id)
																			->where('training_schedule_id', '=', $value['id'])
																			->where('skill_id', '=', $skill_id)
																			->where('transaction.payment_status', '=', 'paid')
																			->where('transaction.created_at','>=',$start_date)
            																->where('transaction.created_at','<=',$end_date)
																			->count();
																$attendeesLeft = $max_allowed-$scheduleCount;			
		                                      				 ?>									        		
											        		<div id="schedules{{$value['id']}}" class="schedule_content" style="display : {!! ($key ==0) ? 'block': 'none' !!}">
											        		<div class="training_schedule" align="center"><b>Starting  {{ date('dS F Y', strtotime($value['date'])) }}</b></div>
											        		<div class="training_schedule"><b>Duration :</b> 30 to 45 Days</div>
											        		<div class="training_schedule"><b>Timings(IST) :</b> {{  date('h:ia',strtotime($value['start_time'])) }} to {{ date('h:ia',strtotime($value['end_time'])) }}</div>
											        		<div class="training_schedule"><b>Type :</b> Live Online</div>
											        		<div class="training_schedule"><b>Max Attendees :</b> {{ $value['max_allowed'] }} <span style="padding-left: 20px;font-weight: bold;">({{$attendeesLeft}} left)</span></div>
											        		</div>
											        		@endforeach
											        	</div>
											        	<div class="col-sm-12">
															<div class="search-detail-rightSection">
																<!--contact details box-->
																<?php /*<div class="contact-details pull-right">
																	<div class="inner-details">
																		<h4 style="color:#fff">Customer Support</h4>
																		<div class="inner-details2">
																			<div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
																			<div class="contact-details2">
																				<h5 style="color:#fff;">Landline:</h5>
																				<h6>040-464687</h6>
																			</div>
																		</div>
																		<div class="inner-details2">
																			<div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
																			<div class="contact-details2">
																				<h5 style="color:#fff;">Mobile no.:</h5>
																				<!-- <h6>9000000009</h6> -->
																				 <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
																			</div>
																		</div>
																		<div class="inner-details2">
																			<div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
																			<div class="contact-details2">
																				<h5 style="color:#fff;">Email:</h5>
																				<!-- <h6 class="email">support@interviewxp.com</h6> -->
																				<h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
																			</div>
																		</div>
																	</div>
																</div>*/ ?>
																<!--end-->
																
																<div class="clr">&nbsp;</div>

																<div class="clr"></div>
																 <div class="user-view content-d">
																	<h4>User Who Viewed This Also Viewed</h4>
																   
																	  @if(isset($arr_otherinterview) && sizeof($arr_otherinterview)>0)
																		@foreach($arr_otherinterview as $otherinterview)  
																		<div class="sub-view" style="padding: 0 5px;">
																		<a href="{{url('/')}}/interview_details/{{base64_encode($otherinterview['id'])}}">
																			  <div class="db-angle"> <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
																			   <div class="php"><h6>{{isset($otherinterview['skill_name'])?ucfirst($otherinterview['skill_name']):' '}} Real Time Interview Question &amp; Answers <span>({{isset($otherinterview['experience_level'])?$otherinterview['experience_level']:' '}} Years exp)</span></h6></div>
																			</a>   
																			</div>
																		@endforeach
																		@else
																		  <div class="sub-view">
																			   <div class="php" style="text-align: center; color: red;">
																					Sorry no records found.
																			   </div>
																			</div>
																	  @endif  
																	</div>
																<div class="clearfix"></div>
															</div>
														</div>
											        </div>
											    </div>    

											    </div><!-- panel-group -->
											    
											    
											</div><!-- container -->
										</section>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end-->
			</div>
		</div>
    </div>
    </form>
    <!--tab-->
    <div class="appom-box search-detail-tabs">
        <div class="box-m">
            <div class="tab-contact">
                <div data-responsive-tabs="" class="tabs responsive-tabs responsive-tabs-initialized">
                    <!--<nav>
                        <div class="container">
                            <ul class="options">
                                <li class="active">
                                    <a href="#tab1">Interview Q &amp; A  </a>
                                </li>
                                <li>
                                    <a href="#tab2">Curriculam</a>
                                </li>
                                <li>
                                    <a href="#tab3">Biography </a>
                                </li>
                                <li>
                                    <a href="#tab4">My Interview Experience</a>
                                </li>
                                <li>
                                    <a href="#tab5">Present Calls in Job Market</a>
                                </li>
                            </ul>
                        </div>
                    </nav>-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <!--<div class="content">
                                            <section id="tab1" style="display: block;">
                                                <h5>About this Interview Q &amp; A</h5>
                                                @if(isset($arr_interview['memberdetails']['about_interview']) && $arr_interview['memberdetails']['about_interview'] !='')
                                                <p>{{isset($arr_interview['memberdetails']['about_interview'])?ucfirst($arr_interview['memberdetails']['about_interview']):''}}</p>
                                                @else
                                                    <div class="error">No records found</div>
                                                @endif 
                                                
                                            </section>
                                            <section id="tab2" style="display:none;">
                                                <h5>Curriculam</h5>
                                                 @if(isset($arr_interview['memberdetails']['curriculum']) && $arr_interview['memberdetails']['curriculum'] !='')
                                                <p>{{isset($arr_interview['memberdetails']['curriculum'])?ucfirst($arr_interview['memberdetails']['curriculum']):''}}</p>
                                                @else
                                                    <div class="error">No records found</div>
                                                @endif 
                                            </section>
                                            <section id="tab3" style="display:none;">
                                                <h5>Biography</h5>
                                                @if(isset($arr_interview['memberdetails']['biography']) && $arr_interview['memberdetails']['biography'] !='')
                                                <p>{{isset($arr_interview['memberdetails']['biography'])?ucfirst($arr_interview['memberdetails']['biography']):' '}}</p>
                                                 @else
                                                    <div class="error">No records found</div>
                                                @endif 
                                            </section>
                                            <section id="tab4" style="display:none;">
                                                <h5>My Interview Experience</h5>
                                                 @if(isset($arr_interview['memberdetails']['my_interview_experience']) && $arr_interview['memberdetails']['my_interview_experience'] !='')
                                                <p>{{isset($arr_interview['memberdetails']['my_interview_experience'])?ucfirst($arr_interview['memberdetails']['my_interview_experience']):' '}}</p>
                                                @else
                                                    <div class="error">No records found</div>
                                                @endif 
                                            </section>
                                            <section id="tab5" style="display:none;">
                                                <h5>Pesent Calls in Job Market</h5>
                                                 @if(isset($arr_interview['memberdetails']['calls_job_market']) && $arr_interview['memberdetails']['calls_job_market'] !='')
                                                <p>{{isset($arr_interview['memberdetails']['calls_job_market'])?ucfirst($arr_interview['memberdetails']['calls_job_market']):' '}}</p>
                                                 @else
                                                    <div class="error">No records found</div>
                                                @endif 
                                            </section>
                                        </div>-->
                                    </div>
                                    
                                </div>
                                   <!--review rating section start here-->
								<section>
									<div class="rating-h">Review Rating</div>                

                                        <!-- <div id="chartContainer" style="height: 50px; width: 100%;"></div>-->
                                         <div class="clearfix"></div>
                                            <div class="r-wraper content-d" id="userreviews">
                                            @if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
												@include('front.userreviews',['page'=>1, 'arr_review_rating' =>$arr_review_rating])
											@else
											<div class="error">Yet their is no review .</div>
											@endif
                                            </div>
                                    </section>
                     <!--review rating section end here-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end-->
        </div>
    </div>
</div>

<div class="modal fade" id="interviewDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Title</h4>
      </div>
      <div class="modal-body">
        Description
      </div>      
    </div>
  </div>
</div> 


<!--responsive tabs-->
<script type="text/javascript">
     var video_url    = $('input[name=video_url]').val();

     /*var myId = getId('http://www.youtube.com/watch?v=zbYf5_S7oJo');

    $('#myId').html(myId);
     alert(myId);
*/
</script>

<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/responsivetabs.js"></script>
<script type="text/javascript">
    function subscribe()
    {
        var link         = "{{url('/')}}/subscribe";
        var _token       = $('input[name=_token]').val();
        var skill_id    = $('input[name=skill_id]').val();
        var exp_level   = $('input[name=exp_level]').val();
        var skill_name  = $('input[name=skill_name]').val();
       
        var form_data = new FormData();
        form_data.append('_token',_token);
        form_data.append('skill_id',skill_id);
        form_data.append('exp_level',exp_level);   
        form_data.append('skill_name',skill_name);       

          jQuery.ajax({
                          url:link,
                          type:'post',
                          dataType:'json',
                          data:form_data,
                          processData:false,
                          contentType:false,
                          beforeSend:function()
                          {
                            $('#err_alert_message').html('');
                            $('#succ_alert_message').html('');
                            $('#error_msg').html('');
                          },
                          success:function(response)
                          {
                           
                            if(response['status']=='success')
                            {
                                $('#succ_alert_message').html(response.msg);
                            }
                            else
                            {
                                $('#err_alert_message').html(response.msg);
                            }
                          } 
                         });    
    }

</script>



<script type="text/javascript">
    $(document).ready(function() {

        $('.check-d').click(function() {
        $('.check-d').removeClass("act");
        $(this).addClass("act");
        });

        /*$("#dialog").dialog({
		    autoOpen: false,
		    width: 500,
		    show: {
		        effect: "blind",
		        duration: 1000
		    },
		    hide: {
		        effect: "explode",
		        duration: 1000
		    },
		    close: function(event, ui)
	        {
	            $(".middle-area").removeClass("blur-in");
	        }
		});*/

    });

</script>

<script type="text/javascript">
$(document).ready(function() 
{       
    $('.referencebook').click(function () 
    {
        var checked_reference_book =  $("input:checkbox[name='reference_book']:checked").length;
            if(checked_reference_book==0) 
            {   
                $('#ref_book_price').val(0);
            }

        $("input:checkbox[name='reference_book']:checked").each(function () 
           {
                var id= $(this).attr("id");
                var val= $(this).val();
                var reference_book_price =val;
                $('#error_validation_msg').html('');
                $('#ref_book_price').val(reference_book_price);
            });
            var total_interview_price = $('#total_interview_price').val();
            var total_ticket_price    = $('#total_ticket_price').val();
            var ref_book_price        = $('#ref_book_price').val();
            var training_price        = $('#training_classes').val();
            var TextResume = $('#TextResume').val();

            grand_total               = parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price)+parseInt(TextResume);
            $('#interview_amount').html('INR '+grand_total); 
            $('#grand_price').val(grand_total);
    });    
	$('.referencebook_textResume').click(function () 
    {
        var checked_reference_book =  $("input:checkbox[name='reference_book_textResume']:checked").length;
            if(checked_reference_book==0) 
            {   
                $('#TextResume').val(0);
                $('#TextResumeType').val(0);
                //$('.referencebook_textResume').removeClass('active').addClass('inactive');
                $('#coach_booknow_btn').removeClass('active');
            }

        $("input:checkbox[name='reference_book_textResume']:checked").each(function () 
           {
                var id= $(this).attr("id");
                var val= $(this).val();
                var reference_book_price =val;
                $('#error_validation_msg').html('');
                $('#TextResume').val(reference_book_price);
                $('#TextResumeType').val(1);
                //$('.referencebook_textResume').removeClass('inactive').addClass('active');
				$('#coach_booknow_btn').addClass('active');
            });
            var TextResume = $('#TextResume').val();
            var total_interview_price = $('#total_interview_price').val();
            var total_ticket_price    = $('#total_ticket_price').val();
            var ref_book_price        = $('#ref_book_price').val();
            var training_price        = $('#training_classes').val();

            grand_total               = parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price)+parseInt(TextResume);
            $('#interview_amount').html('INR '+grand_total); 

            $('#grand_price').val(grand_total);
    });
    $(".reference_training_enrollment").on("click", function (event) { 
    	setTimeout(function(){
    	var flag = false;
        var checked_reference_enrollment =  $("input:checkbox[name='reference_training_enrollment']:checked").length;

        if(checked_reference_enrollment==0) 
        {   
            $('#training_classes').val(0);
            $('#schedule_id').val('');
            $('.reference_training_enrollment').removeClass('active').addClass('inactive');
            flag = true;
        }
        else
        {
        	var schedule_id = $('#schedules').val();
        	var skill_id = $('#enc_skill_id').val();
        	var user_id = $('#enc_user_id').val();
        	jQuery.ajax({
	          type:"get",
			  url:'{{url("/")}}/validate_current_enrollment',
			  data:{schedule_id:schedule_id, skill_id:skill_id, user_id:user_id},
			  dataType: 'json',
			  async: false,
	          success:function(response)
	          {
	           
	            if(response.status==true)
	            {
	               flag = true; 
	            }
	            else
	            {
	            	//$('#dialog p').text(response.msg);
	            	$("#myModalLabel").html('Message');
	            	$('#interviewDetailModal .modal-body').text(response.msg);
	            	$("#interviewDetailModal").modal('show');
	            	//$("#dialog").dialog("open");
	            	//$(".middle-area").addClass("blur-in");
	            }
	          } 
	         });
        }

        if(flag == true)
        {
           $("input:checkbox[name='reference_training_enrollment']:checked").each(function () 
           {
                var id= $(this).attr("id");
                var val= $(this).val();
                var scheduleId= $('#schedules').val();
                var reference_book_price =val;
                $('#error_validation_msg').html('');
                $('#training_classes').val(reference_book_price);
                $('#schedule_id').val(scheduleId);
                $('.reference_training_enrollment').addClass('active').removeClass('inactive');
            });
            var TextResume = $('#TextResume').val();
            var total_interview_price = $('#total_interview_price').val();
            var total_ticket_price    = $('#total_ticket_price').val();
            var ref_book_price        = $('#ref_book_price').val();
            var training_price        = $('#training_classes').val();
            grand_total               = parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price)+parseInt(TextResume);
            $('#interview_amount').html('INR '+grand_total); 
            $('#grand_price').val(grand_total);
        }

        event.preventDefault();
       }, 200);
    }); 
	
    $('.noofcompany').click(function () 
    {
            var interview_amount=0;
            
            var interview_price = $('#interview_price').val();
            var checked_interview =  $("input:checkbox[name='company[]']:checked").length;
            if(checked_interview==0) 
            {   
                $('#total_interview_price').val(0);
            }
             
           $("input:checkbox[name^='company']:checked").each(function () 
           {
                var initial_amount=parseInt(interview_amount);
                var id= $(this).attr("id");
                var val= $(this).val();
                interview_amount=(initial_amount+val*parseInt(interview_price));
                
                $('#error_validation_msg').html('');
                $('#total_interview_price').val(interview_amount);
                
            });
            var total_interview_price = $('#total_interview_price').val();
			var total_ticket_price = $('#total_ticket_price').val();
			var ref_book_price = $('#ref_book_price').val();
			var training_price        = $('#training_classes').val();
			var TextResume = $('#TextResume').val();

                grand_total=parseInt(TextResume)+parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price);
                $('#interview_amount').html('INR '+grand_total);      
                $('#grand_price').val(grand_total);

    });


    $('.nooftickets').click(function () 
    {
        var amount = 0;
        var checked_ticket =  $("input:checkbox[name^='radio_ticket']:checked").length;
        
            if(checked_ticket==0) 
            {   
                $('#total_ticket_price').val(0);
            }
           
            $("input:checkbox[name^='radio_ticket']").on('click', function() 
            {
                $("input:checkbox[name^='radio_ticket']").not(this).prop('checked', false);

                    var val= $(this).val();
                    total_amount=parseInt(val);
                    amount=total_amount;
                    $('#error_validation_msg').html('');
                    $('#total_ticket_price').val(amount);
                    var limit = this.title;
                    if(this.checked)
                    {   
                        $('#limit').val(limit);
                        $('#tickets').modal('show');
                    }
            });
                    
            var total_interview_price = $('#total_interview_price').val();
            var total_ticket_price    = $('#total_ticket_price').val();
            var TextResume = $('#TextResume').val();
            var ref_book_price = $('#ref_book_price').val();
            var training_price        = $('#training_classes').val();

            grand_total        = parseInt(TextResume)+parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price);
            $('#interview_amount').html('INR '+grand_total); 
            $('#grand_price').val(grand_total);

    });
    $('.ticket_check').click(function () 
    {
        var check_record=$("input:checkbox[name='check_record[]']:checked").length;
        limit = $('#limit').val();
        if(check_record==limit)
        {
            $('#exceed_limit').html('');
            var result = confirm(' You have selected '+limit+' tickets! Are you sure for payment?');
        }
        if(check_record>limit)
        {
            $('#exceed_limit').html('Your limit is exceeded.');
        }
        if(result)
        {
            var arr = $('input[name="check_record[]"]:checked').map(function(){
            return $(this).val();
            }).get();
            var link         = "{{ url('/purchased_tickets') }}";
            var _token       = $("input[name=_token]").val();
            var interview_id = $('#unique').val();
   
          var form_data = new FormData();
          form_data.append('_token',_token);
          form_data.append('arr_data',arr);
          form_data.append('id',interview_id);
   
          jQuery.ajax({
                          url:link,
                          type:'post',
                          dataType:'json',
                          data:form_data,
                          processData:false,
                          contentType:false,
                          beforeSend:function()
                          {
                            $('#error_msg').html('');
                          },
                          success:function(response)
                          {
                            if(response.status=="success")
                              {
                                $('#ticket_unique_id').val(response.ticket_unique_id);
                                $('#modal-success-ticket').html(response.msg);
                              }
                              if(response.status=="error")
                              {
                                /*alert('user not logged in');*/
                                 $('#modal-error-ticket').html(response.msg);
                              }
                          } 
                         });   
        }
        
        
    });
});
    function validation()
    {
        var grand_price = $('#grand_price').val();
        if(grand_price==0.00)
        {
            $('#error_validation_msg').html('Please select atleast one reference book/Company/Rwe tickets.');
            return false;
        }
        else
        {
            $('#error_validation_msg').html('');
            return true;
        }    

    }
</script>
<script>
   $(document).ready(function() {
  var showChar = 600;
  var ellipsestext = "...";
  var moretext = "more";
  var lesstext = "less";
  $('.more').each(function() {

    var content = $(this).html();

    if(content.length > showChar) {

      var c = content.substr(0, showChar);
      var h = content.substr(showChar-1, content.length - showChar);

      var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

      $(this).html(html);
    }

  });

  $(".morelink").click(function(){
    if($(this).hasClass("less")) {
      $(this).removeClass("less");
      $(this).html(moretext);
    } else {
      $(this).addClass("less");
      $(this).html(lesstext);
    }
    $(this).parent().prev().toggle();
    $(this).prev().toggle();
    return false;
  });
 
	$(document).on('change', '#schedules', function(e){
		var id = $(this).val();
		$('.schedule_content').hide();
		$('#schedules'+id).show();
		$('#schedule_id').val(id);
		$('#training_classes').val(0);
		$('#radio_training_enrollment').attr('checked', false);
        $('.reference_training_enrollment').removeClass('active').addClass('inactive');

	});
	
	$(document).on('click', '.ui-accordion-header', function(e){

			$(".more-less").addClass('fa-chevron-down').removeClass('fa-chevron-up');
			$(this)
	            .find(".more-less")
	            .toggleClass('fa-chevron-down fa-chevron-up');
	});

});

</script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

 /*scrollbar start*/
         (function($){
           
         $(window).on("load",function(){
         
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
         
               $(".content-d").mCustomScrollbar({theme:"dark"});
             //alert();
             
         });       

         });
		 $(".showme").hide();
$(".clickme").on('click', function() {
	var id=$(this).attr("att_ram");
	$( ".clickme" ).removeClass( "active" );
	$(this).addClass( "active" );
	//$(this).css("background-color","skyblue");
	if(id==1){
		$(".hideme").show(); $(".showme").hide();
	}
		
	else{
		$(".hideme").hide(); $(".showme").show();
	}
		
});
function showBoxTab(tab) {
	$('a[href="#' + tab + '"]').trigger('click');
}
function opendiv(id) {
	 var current = $("#currentdiv").val();
	 $("#currentdiv").val(id);
	 for (var i = 1; i <= 10; i++) {
		 if (id != i) {
			 $("#div" + i).hide('slow');
			 $('#arrow' + i).removeClass("career-hide-show-up");
		 }
	 }
	 $('#arrow' + id).addClass("career-hide-show-up");
	 $('#div' + id).slideToggle("slow", function() {
		 if (current == id) {
			 $('#arrow' + current).removeClass("career-hide-show-up");
			 $("#currentdiv").val('');
		 }
	 });
 }
 $(".downUl").hide();
 $(".upArrow").hide();
 $(".downArrow").on('click', function(){
	$(this).nextAll('.downUl').show();
	$(this).hide();
	$(this).next('img').show();
 });
  $(".upArrow").on('click', function(){
	$(this).nextAll('.downUl').hide();
	$(this).hide();
	$(this).prev('img').show();
 });

  
  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

  $(function() {
    var $accordions = $(".accordion").accordion({
        collapsible: true,
        autoHeight: true,
        active: false,
        icons: false
    }).on('click', function() {
        $accordions.not(this).accordion('activate', false);
    });
   
  });

</script>
<script>
 $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
$(document).ready(function()
{
    $(document).on('click', '#realissues-list .pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.realissues').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
       var page=$(this).attr('href').split('page=')[1];
	   var url = "{{url('/')}}/realtimeissues?interview_id={{$arr_interview['id']}}&user_id={{$arr_interview['user_id']}}&member_id={{$arr_interview['member_id']}}&skill_id={{$arr_interview['skill_id']}}&experience_level={{$arr_interview['experience_level']}}&page=" + page;
       //getData(page);
	   getData(page, 'get_company_issues', 'realissues-list', url);
    });
	$(document).on('click', '#userreviews .pagination a',function(event)
    {        
        event.preventDefault();
       var myurl = $(this).attr('href');
       var params=$(this).attr('href').split('?')[1];	   
       var paramsNew=params.split('&');	   
       var page=paramsNew[1].split('=')[1];	   
       var interview_id=paramsNew[0].split('=')[1];
	   var url = "{{url('/')}}/get_user_reviews?interview_id="+interview_id+"&page=" + page;
       //getData(page);
	   getData(page, 'get_company_issues', 'userreviews', url);
    });
});
function getData(page, action, tab, url){
		
        $.ajax(
        {
            url: url,
            type: "get",
            datatype: "html",
            // beforeSend: function()
            // {
            //     you can show your loader 
            // }
        })
        .done(function(data)
        {
            //console.log(data);
            
            $("#"+tab).empty().html(data);
            var p = getParameterByName('p');  	
		  	
			if(page > 1)
			{
				$('.hideme ul li').addClass('blur-in');
				$('.showme').show();
				$(".show-results").css({'padding-left':'0px'});
			}
			else
			{
				$('.showme').hide();
				$(".show-results").css({'padding-left':'8px'});
			}
			
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
}
</script>
@endsection