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
    background-color: rgba(214, 224, 226, 0.2);
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
            <h4>{{isset($arr_interview['skill_name'])?ucfirst($arr_interview['skill_name']):'NA'}} Real Time Interview Questions &amp; Answers ( {{isset($arr_interview['experience_level'])?$arr_interview['experience_level']:'NA'}} Year Exp )</h4>
            <ul class="first-list">
                <li class="hidden-xs">Member Since {{isset($arr_interview['memberdetails']['created_at'])?date('d M Y', strtotime($arr_interview['memberdetails']['created_at'])):' '}}</li>
                <li class="hidden-xs">Last update {{isset($arr_interview['updated_at'])?date('d M Y', strtotime($arr_interview['updated_at'])):' '}}</li>
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
                <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i> {{isset($arr_interview['user_purchase_details'])?count($arr_interview['user_purchase_details']):''}} Users</li>
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
										<div class="check-box referencebook_textResume">
										<?php
										$result = DB::select(DB::raw('select count(*) as cnt,interview_id FROM `purchase_history` where `interview_id`="'.$arr_interview['id'].'" AND `TextResumeType`=1'));

										if(isset($result) AND ($result[0]->cnt >= 10) ){
											?>
											<p class="fulled-bookings" style="">
												Bookings Fulled
											</p>
											<?php
										}else{
										?>		<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['validity']}}" id="radio_textresume" name="reference_book_textResume" type="checkbox">
												<label class="css-label radGroup2" for="radio_textresume"></label>
												<i class="fa fa-inr"><span class="tab-price">{{ number_format($arr_price_list['validity'], 0, '', '')}}</span></i>
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
										<a href="#tab3RealTime1">Real Time Issues Q & A<!-- <br>(Tickets, Tasks, Etc.,) --></a>
										<div class="check-box nooftickets" style="border-bottom: none;">
											<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['price_for_25_ticket'] or 0.00}}" id="radio14" name="radio_ticket[price_for_25_ticket]" type="checkbox" title="25">
											<label class="css-label radGroup2" for="radio14">&nbsp;</label>
											<i class="fa fa-inr" style="width: 55%;font-size: 13px"><span style="font-size: 18px;">{{ number_format($arr_price_list['price_for_25_ticket'], 0, '', '')}}&nbsp;&nbsp;&nbsp;(25)</span></i>
										</div>
										<div class="check-box nooftickets" style="border-bottom: none;">
											<input class="css-checkbox ads_Checkbox" value="{{$arr_price_list['price_for_50_ticket'] or 0.00}}" id="radio15" name="radio_ticket[price_for_50_ticket]" type="checkbox" title="50">
											<label class="css-label radGroup2" for="radio15">&nbsp;</label>
											<i class="fa fa-inr" style="width: 55%;font-size: 13px"><span style="font-size: 18px;">{{ number_format($arr_price_list['price_for_50_ticket'], 0, '', '')}}&nbsp;&nbsp;&nbsp;(50)</span></i>
										</div>
										<div class="check-box nooftickets">
											<input class="css-checkbox ads_Checkbox"  value="{{$arr_price_list['price_for_75_ticket'] or 0.00}}" id="radio16" name="radio_ticket[price_for_75_ticket]" type="checkbox" title="75">
											<label class="css-label radGroup2" for="radio16">&nbsp;</label>
											<i class="fa fa-inr" style="width: 55%;font-size: 13px"><span style="font-size: 18px;">{{ number_format($arr_price_list['price_for_75_ticket'], 0, '', '')}}&nbsp;&nbsp;&nbsp;(75)</span></i>
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
											<div class="col-md-12">
												
												<?php 
												$userInfo = DB::table('interview_coach')->where('User_Id', $user_id)->first();
												if(isset($userInfo)){
												?>
												<div class="col-md-7">
													<div class="card hovercard" style="padding-right: 0px;padding-left: 0px;">
														<div class="cardheader"></div>
														<div class="avatar">
															 <img src="{{url('/')}}/images/Profile-img.jpg" style="width:100%">
														</div>
														<div class="info" style="padding:10px;line-height:25px;">
															<b>{{$userInfo->FirstName}} {{ $userInfo->LastName}}</b><br/>
															<span>{{$userInfo->Headline}}</span><br/>
															<span>{{$userInfo->CurrentState}},{{$userInfo->CurrentCity}}</span><br/><hr/>
															<span style="text-align:justify; display:block">{{$userInfo->Summary}}</span>
														</div>
													</div><br/>
													<div style="background-color:#fff;">
													<span style="border-radius:50px; border:1px solid #ccc; padding: 10px;float: left;">Interview Q &amp; A</span><div class="clearfix"></div><p style="text-align:justify;float: left;">{{$userInfo->Interview}}</p> </div>
													<div class="clearfix"></div><br/>
													<div style="background-color:#fff">
													<span style="border-radius:50px; border:1px solid #ccc; padding: 10px;float: left;">Interviews By Companies</span><div class="clearfix"></div><p style="text-align:justify;float: left;">{{$userInfo->Companies}}</p> </div>
													<div class="clearfix"></div><br/>
													<div style="background-color:#fff">
													<span style="border-radius:50px; border:1px solid #ccc; padding: 10px;float: left;">Real Time Issues</span><div class="clearfix"></div><p style="text-align:justify;float: left;">{{$userInfo->Issues}}</p> </div>
												</div>
												<?php
												}else{
													?>
													<div class="col-md-7"></div>
													<?php
												}
												?>
												<div class="col-md-5">
												
													<h5 style="text-decoration:underline">What's Included</h5>
													<div style="margin-left:20px;">
														<ul>
															<li><i class="fa fa-circle-o" aria-hidden="true"></i> A session for a week or a total of (10 hours) chat <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; over Skype or video call</li>
															<li><i class="fa fa-circle-o" aria-hidden="true"></i> Preparation of Resume (2 rounds of edit)</li>
															<li><i class="fa fa-circle-o" aria-hidden="true"></i> You can ask any questions related to the coach <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; experience & skill set for the specified time</li>
															<li><i class="fa fa-circle-o" aria-hidden="true"></i> You can ask your coach to share the screen and <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;explain the issues</li>
														</ul>
														
													</div>
													<hr/>
													<p style="text-align:justify;">Once you place the order for an interview coach through book now option you will receive a call from your coach withing one business day. Your coach will schedule your appointment for a week based on your availability time</p>
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
																			 $icon='<i class="fa fa-file-pdf-o"></i>';
																			 $href='#home'.$user1->id;
																			 $dataId=$user1->id;
																		 }else if($user1->file_extension =='Video'){
																			 $icon='<i class="fa fa-play"></i>';
																			 $href='#video'.$user1->id;
																			 $dataId=$user1->id;
																		 }else{
																			 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
																			 $href='#';
																			 $dataId="";
																		 }
																		 
																?>
																	<ul>
																		<li style="border:1px solid #eee;padding-left:45px;line-height:35px;background-color:#fff !important"> 
																		<a href="{{$href}}" attrId={{$dataId}} data-toggle="tab">
																			<span><?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} </span>
																			<span style="margin-left:55px;">{{$user1->pageCount}} &nbsp;&nbsp; {{$user1->fileSize}} M.B</span>
																			<?php 
																			if($user1->freePreview =='Yes'){
																				$dow="/uploads/refrence_book/".$user->mul_reference_book;
																				$previewUrl= url('/')."/".str_replace(" ","-",$user->topic_name)."/preview/".base64_encode($reference_book['interview_id']);
																			?>
																			<a href="<?php echo $previewUrl?>" target="_New"><span style="float:right;margin-right:15px;">Preview</span></a>
																			<?php }
																			?>
																		</li>
																	</a>
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
													<div class="contact-details pull-right">
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
													</div>
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
											<div class="col-md-9">
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
													<div class="contact-details pull-right">
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
													</div>
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
																		
																		
																		<li style="border:1px solid #eee; line-height:35px; padding-left:20px; padding-right:20px" title="{{$user->topic_name}}"><input  class="css-checkbox ads_Checkbox"  value="1"  id="radio_{{$user->company_id}}" name="company[{{$user->company_id}}]" type="checkbox"><label class="css-label radGroup2" for="radio_{{$user->company_id}}"></label><b> {{$NameC}} ({{$user->company_location}}) </b> <img src="../images/down-arow.png" class="downArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		<img src="../images/up-arow.png" class="upArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		
																			<?php
																			   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$interviewid->interview_id."' AND company_id = '".$user->company_id."'") );
																				foreach ($results1 as $key1=>$user1) {
																					 if($user1->file_extension =='Pdf'){
																						 $icon='<i class="fa fa-file-pdf-o"></i>';
																					 }
																						 
																					 if($user1->file_extension =='Video'){
																						 $icon='<i class="fa fa-play"></i>';
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
																				<ul class="downUl" style="margin-left:30px;">
																					<li style="border:1px solid #eee; line-height:35px; padding-left:20px">
																						<span style="width:200px;display: inline-block;"><?php echo $icon ?> &nbsp;&nbsp; {{$user1->roundType}} </span>
																						<span style="margin-left:55px;">{{$user1->pageCount}} &nbsp;&nbsp; {{$user1->fileSize}} M.B</span>
																						<?php 
																						if($user1->freePreview =='Yes'){
																							$dow="/uploads/refrence_book/".$interviewid->interview_id;
																							$previewUrl= url('/')."/".base64_encode($user->company_id)."/preview-company/".base64_encode($interviewid->interview_id);
																						?>
																						<a href="<?php echo $previewUrl?>" target="_New"><span style="float:right;margin-right:15px;">Preview</span></a>
																						<?php }
																						?>
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
													<div class="contact-details pull-right">
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
													</div>
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
																<div class="contact-details pull-right">
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
																</div>
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
                                            <div class="r-wraper content-d">
                                            @if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
                                            @foreach($arr_review_rating as $data)
										<?php
										if($data['ReviewTypeID'] !='' AND $data['ReviewType'] == 'Company'){
											$NameCompany = DB::table('company_master')->where('company_id', '=', $data['ReviewTypeID'])->first();
											$CompanyLocation = DB::table('interview_detail')->where('company_id', '=', $data['ReviewTypeID'])->first();
											$NameC=$NameCompany->company_name;
											
											$Location=$CompanyLocation->company_location;
											if($data['ReviewType'] == 'Company'){
												$title=$NameC. "(".$Location.")";
											}else{
												$title=$data['ReviewTypeID'];
											}
										}else{
											$title=$data['ReviewTypeID'];
										}
										?>

                                        <div class="row">
                                            <div class="col-sm-2 col-md-1 col-lg-1">
                                                <div class="user-bl">
                                                    <img src="{{$user_profile_public_img_path}}/{{$data['user_details']['profile_image']}}" class="img-responsive" alt="Interviewxp" />
                                                </div>
                                            </div>
                                            <div class="col-sm-10 col-md-11 col-lg-11">
                                                <div class="review-bl">
                                                    <div class="review">
                                                        <h4>
                                                        {{ucfirst($data['user_details']['first_name'])}} {{$data['user_details']['last_name']}}</h4>
                                                        <div class="star-wrapper">
                                                            @for($i=1;$i<=$data['review_star'];$i++)
                                                            <img src="{{url('/')}}/images/star.png"/>
                                                        @endfor          
                                                        @for($i=$data['review_star'];$i<5;$i++)
                                                              <img src="{{url('/')}}/images/blank_star.png"/>
                                                        @endfor
														 ( {{$title}} {{$data['ReviewType']}})
                                                        </div>
                                                        <p>{{substr($data['review_message'],0,300).'...'}}</p>
                                                        <div class="rev-date">{{date('d-M-Y',strtotime($data['created_at']))}}</div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
                $('.referencebook_textResume').removeClass('active').addClass('inactive');
            }

        $("input:checkbox[name='reference_book_textResume']:checked").each(function () 
           {
                var id= $(this).attr("id");
                var val= $(this).val();
                var reference_book_price =val;
                $('#error_validation_msg').html('');
                $('#TextResume').val(reference_book_price);
                $('#TextResumeType').val(1);
                $('.referencebook_textResume').removeClass('inactive').addClass('active');
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

                grand_total=parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price);
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
            
            var ref_book_price = $('#ref_book_price').val();
            var training_price        = $('#training_classes').val();

            grand_total        = parseInt(total_ticket_price)+parseInt(training_price)+parseInt(total_interview_price)+parseInt(ref_book_price);
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
       getData(page);
    });
});
function getData(page){
		
        $.ajax(
        {
            url: "{{url('/')}}/realtimeissues?interview_id={{$arr_interview['id']}}&user_id={{$arr_interview['user_id']}}&member_id={{$arr_interview['member_id']}}&skill_id={{$arr_interview['skill_id']}}&experience_level={{$arr_interview['experience_level']}}&page=" + page,
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
            
            $("#realissues-list").empty().html(data);
            var p = getParameterByName('p');  	
		  	
			if(page > 1)
			{
				$('.hideme ul li').addClass('blur-in');
				$('.showme').show();
			}
			else
			{
				$('.showme').hide();
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