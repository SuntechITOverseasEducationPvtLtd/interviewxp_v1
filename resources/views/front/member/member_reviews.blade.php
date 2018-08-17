@extends('front.layout.main')
@section('middle_content')
<div id="member-header" class="after-login"></div>
<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')
     
      <div class="col-sm-9 col-md-9 col-lg-10 middle-content">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="my-profile m-history">Reviews & Ratings</h2>
               <div class="outer-box history-page">
                  <!--                  <h4>Interviews</h4>-->
                  <!-- tabbing section -->
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr class="t-head">
                              <td>S.No</td>
                              <td>Description</td>
                              <td>Experience Level</td>
                              <td>&nbsp;</td>
                           </tr>
                        </thead>
                        @if(isset($arr_interview) && sizeof($arr_interview)>0)
                        @foreach($arr_interview as $key => $uploads)
                        <thead class="box  hideRow hideRow{{$key+1}}">
                           <tr class="top hideAll" id="{{$key+1}}">
                              <td>{{$key+1}}</td>
                              <td>
								 <?php
									$interview_skill_name = '';
									if(isset($uploads['skill_name']) && isset($uploads['experience_level'])  && $uploads['experience_level'] != 'NA')
									{
										$interview_skill_name = $uploads['skill_name'].' Real Time Interview Questions &amp; Answers';
									}
									else if(($uploads['skill_name']) && isset($uploads['experience_level'])){									
										$interview_skill_name = $uploads['skill_name'].' Interview Questions &amp; Answers';
									}
							    ?> 	
                                 {{$interview_skill_name}}   
                              </td>
                              <td>
                                 {{isset($uploads['experience_level']) && $uploads['experience_level'] != 'NA'?$uploads['experience_level'].' Year':'NA'}}
                              </td>
                              <td><img src="{{url('/')}}/images/plus_faq.png" /></td>
                           </tr>
                           <tr class="bottom" style="display:none;">
                              <td colspan="4">
                                 <div class="multi-tabbing">
								    <div class="panel with-nav-tabs panel-default">
										<div class="panel-heading">
											<ul class="nav nav-tabs">
												<li class="active"><a style="font-size: 14px;" href="#tab1default{{$uploads['id']}}" data-toggle="tab">Interview Q & A</a></li>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<li><a style="font-size: 14px;" href="#tab2default{{$uploads['id']}}" data-toggle="tab">Interviews by Companies</a></li>
												@endif
												@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
												<li><a style="font-size: 14px;" href="#tab3default{{$uploads['id']}}" data-toggle="tab">Real Time Issues (Tickets, Tasks, Etc.,)</a></li>
												@endif
												<li><a style="font-size: 14px;" href="{{url('/member/mybookings/'.base64_encode($uploads['id']))}}">Bookings</a></li>
												@if(!empty($arr_user_info[0]['training_tab']))
												<li><a style="font-size: 14px;" href="{{url('/member/onlineClassEnrollments/'.base64_encode($uploads['id']))}}">Online Class</a></li>
												@endif
											</ul>
										</div>
										<div class="panel-body">
											<div class="tab-content">
												<div class="tab-pane fade in active" id="tab1default{{$uploads['id']}}">
													<!--tab 1-->
													<div class="middle-box">
													   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														  <div class="table-responsive">
															 <table class="table">
																<tbody>
																   @if(isset($uploads['reference_book_details']) && sizeof($uploads['reference_book_details'])>0)
																   <tr class="top-strip-table">
																	  <td>S.No</td>
																	  <td>Date Purchased</td>
																	  <td>Name</td>
																	  <td>Ratings</td>
																	  <td>Reviews</td>
																   </tr>
																	<?php

																	$reviewInfo = DB::table('review_rating')
																	 				->join('transaction', 'transaction.ticket_unique_id', '=', 'review_rating.unique_id')
																	 				->join('users', 'users.id', '=', 'review_rating.user_id')
																					->where('transaction.member_user_id', $uploads['user_id'])
																					->where('review_rating.interview_id', $uploads['id'])
																					->where('transaction.skill_id', $uploads['skill_id'])
																					->where(['ReviewType'=>'Interview QA'])
																					->where(function ($query) {
																					    $query->where('approve_status', '=', 'member')
																					          ->orWhere('approve_status', '=', 'user');
																							})
																					->get();

																	 /*$results = DB::select( DB::raw("SELECT * FROM transaction a, purchase_history b, users c where a.member_user_id='".$uploads['user_id']."' AND a.skill_id='".$uploads['skill_id']."' AND a.order_id=b.order_id AND a.ref_interview_id=b.interview_id AND b.reference_book='Yes' AND a.user_id=c.id") );*/
																	 foreach ($reviewInfo as $key=>$review) {

																	?>
																	<tr>
																		<td>{{$key+1}}</td>
																		<td>{{$review->created_at}}</td>
																		<td>{{$review->first_name}} {{$review->last_name}}</td>
																		<td>
																		<?php echo getReviewStars($review->review_star); ?>
																		</td>
																		<td title="{{$review->review_message}}"><i class='fa fa-eye' aria-hidden='true'></i></td>
																	</tr>
																	<?php
																	}
																	?>
																   @else
																   <tr>
																	  <td style="color:red;">
																		 No Records found...
																	  </td>
																   </tr>
																   @endif
																</tbody>
															 </table>
																<!--end-->
															 </div>
														  </div>
													   </div>
												</div>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<div class="tab-pane fade" id="tab2default{{$uploads['id']}}">
													<div class="middle-box">
														<div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														   <div class="table-responsive">
															  <ul><?php
															   $results = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$uploads['id']."' AND approve_status='1' group by company_id ORDER BY `id` DESC") );
																foreach ($results as $key=>$user) {
																	
																	$NameCompany = DB::table('company_master')
																		  ->where('company_id', '=', $user->company_id)
																		  ->first();
																	$NameC=$NameCompany->company_name;
																	?>
																	<li style="padding:10px;">
																		{{$key+1}} . {{$NameC}} ({{$user->company_location}})
																		<img src="../images/down-arow.png" class="downArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		<img src="../images/up-arow.png" class="upArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		<table class="table downUl" style="margin-top:2%">
																			 <tbody>
																				@if(isset($uploads['interview_details']) && sizeof($uploads['interview_details'])>0)
																				<tr class="top-strip-table" style="background-color: #ecf8f7;">
																				   <td>S.No</td>
																				  <td>Date Purchased</td>
																				  <td>Name</td>
																				  <td>Ratings</td>
																				  <td>Reviews</td>
																				</tr>
																				<?php

																				 //$results1 = DB::select( DB::raw("SELECT * FROM transaction a, purchase_history b, users c where a.member_user_id='".$uploads['user_id']."' AND a.skill_id='".$uploads['skill_id']."' AND a.order_id=b.order_id AND a.ref_interview_id=b.interview_id AND b.InterviewByCompaniesID='".$user->company_id."' AND a.user_id=c.id") );
																				 $reviewInfoObj = DB::table('review_rating')
								                                                               ->join('transaction', 'transaction.ticket_unique_id', '=', 'review_rating.unique_id')
								                                                               ->join('users', 'users.id', '=', 'review_rating.user_id')
								                                                               ->where('transaction.member_user_id', $uploads['user_id'])
								                                                               ->where('review_rating.interview_id', $uploads['id'])
								                                                               ->where('transaction.skill_id', $uploads['skill_id'])
								                                                               ->where('review_rating.ReviewTypeID', $user->company_id)
								                                                               ->where(['ReviewType'=>'Company'])
								                                                               ->where(function ($query) {
								                                                                   $query->where('approve_status', '=', 'member')
								                                                                         ->orWhere('approve_status', '=', 'user');
								                                                                     })
								                                                               ->get();
								                                                 //print_r($reviewInfoObj);              
																				 foreach ($reviewInfoObj as $key=>$reviewInfo1) {
																				 /*$reviewInfo1 = DB::table('review_rating')
																								->where('user_id', $user1->user_id)
																								->where('member_user_id', $uploads['user_id'])
																								->where('interview_id', $user1->interview_id)
																								->where('ReviewType', 'Company')
																								->first();*/
																				
																				?>
																				<tr>
																					<td>{{$key+1}}</td>
																					<td>{{$reviewInfo1->created_at}}</td>
																					<td>{{$reviewInfo1->first_name}} {{$reviewInfo1->last_name}}</td>
																					<td><?php echo getReviewStars($reviewInfo1->review_star); ?></td>
																					<td title="{{$reviewInfo1->review_message}}"><i class='fa fa-eye' aria-hidden='true'></i></td>
																				</tr>
																				<?php
																				}
																				?>
																			   @else
																			   <tr>
																				   <td style="color:red;">
																				   No Records found...
																				   </td>
																			   </tr>
																			   @endif
																			</tbody>
																		 </table>
																	 </li>
																<?php
																}
															   ?></ul>
														</div>
													 </div>
													</div>
												</div>
												@endif
												@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
												<div class="tab-pane fade" id="tab3default{{$uploads['id']}}">
													<!--tab 3-->
												   <div class="middle-box">
													   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														   <div class="table-responsive">
																<ul><?php
																	 for($i=1; $i<4; $i++){
																		 $tic=$i*25;
																	?>
																	<li style="padding:10px;">
																		{{$i}}. Real Time Issue ({{$tic}})
																		<img src="../images/down-arow.png" class="downArrow" style="float: right; cursor:pointer;margin-top:10px;">
																		<img src="../images/up-arow.png" class="upArrow" style="float: right; cursor:pointer;margin-top:10px;">
																	   <table class="table downUl" style="margin-top:2%">
																		   <tbody>
																			   @if(isset($uploads['realtime_details']) && sizeof($uploads['realtime_details'])>0)
																			   <tr class="top-strip-table" style="background-color: #ecf8f7;">
																			      <td>S.No</td>
																				  <td>Date Purchased</td>
																				  <td>Name</td>
																				  <td>Ratings</td>
																				  <td>Reviews</td>
																			   </tr>
																			   <?php
																				 //$results2 = DB::select( DB::raw("SELECT * FROM transaction a, purchase_history b, users c where a.member_user_id='".$uploads['user_id']."' AND a.skill_id='".$uploads['skill_id']."' AND a.order_id=b.order_id AND a.ref_interview_id=b.interview_id AND b.ticket_name='".$tic."' AND a.user_id=c.id") );
																				 $reviewInfoObj = DB::table('review_rating')
								                                                               ->join('transaction', 'transaction.ticket_unique_id', '=', 'review_rating.unique_id')
								                                                               ->join('users', 'users.id', '=', 'review_rating.user_id')
								                                                               ->where('transaction.member_user_id', $uploads['user_id'])
								                                                               ->where('review_rating.interview_id', $uploads['id'])
								                                                               ->where('transaction.skill_id', $uploads['skill_id'])
								                                                               ->where('review_rating.ReviewTypeID', $tic)
								                                                               ->where(['ReviewType'=>'Real Issues'])
								                                                               ->where(function ($query) {
								                                                                   $query->where('approve_status', '=', 'member')
								                                                                         ->orWhere('approve_status', '=', 'user');
								                                                                     })
								                                                               ->get();
								                                                 //print_r($reviewInfoObj);              
																				 foreach ($reviewInfoObj as $key=>$reviewInfo2) {
																				 /*$reviewInfo2 = DB::table('review_rating')
																								->where('user_id', $user2->user_id)
																								->where('member_user_id', $uploads['user_id'])
																								->where('interview_id', $user2->interview_id)
																								->where('ReviewType', 'Real Issues')
																								->where('ReviewTypeID', $tic)
																								->first();*/
																				
																				?>
																				<tr>
																					<td>{{$key+1}}</td>
																					<td>{{$reviewInfo2->created_at}}</td>
																					<td>{{$reviewInfo2->first_name}} {{$reviewInfo2->last_name}}</td>
																					<td>
																					<?php
																					echo getReviewStars($reviewInfo2->review_star);
																					?>																						
																					</td>
																					<td title="{{$reviewInfo2->review_message}}"><i class='fa fa-eye' aria-hidden='true'></i></td>
																				</tr>
																				<?php
																				 }
																				?>
																			   @else
																			   <tr>
																			   <td style="color:red;">
																			   No Records found...
																			   </td>
																			   </tr>
																			   @endif
																		   </tbody>
																	   </table>
																	</li>
																<?php
																}
															   ?></ul>
															</div>
													   </div>
												   </div>
												</div>
												@endif
											</div>
										</div>
									</div>
                                    
                                </div>
                </div>
               
         </td>
         </tr>
         </thead>
         @endforeach
         @else
         <tr class="strips">
         <td style="color:red;">
         No Records found...
         </td>
         </tr>
         @endif    
         </tr>
         </table>
      </div>
      <!-- end -->
   </div>
		</div>
</div>
   </div>
</div>
<script type="text/javascript">
   
      $('.top').on('click', function() {
     
         $parent_box = $(this).closest('.box');
         //$parent_box.find('.bottom').slideUp();
         //  $(".details-info").hide();
         $parent_box.find('.bottom').slideToggle(1000, 'swing');
         //$parent_box.find('.bottom').fadeIn(1000, 'swing');
         // $(".details-info").show();
     });
     
     $('.middle-top').on('click', function() {
     
         $parent_box = $(this).closest('.middle-box');
         $parent_box.siblings().find('.middle-bottom').slideUp();
         //  $(".details-info").hide();
         $parent_box.find('.middle-bottom').slideToggle(1000, 'swing');
         //$parent_box.find('.bottom').fadeIn(1000, 'swing');
         // $(".details-info").show();
     });
	 $(".hideAll").on("click", function(){
		var id=$(this).attr("id");
		$(".hideRow").hide();
		$(".hideRow"+id).show();
	});
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

</script>

<?php
	function getReviewStars($star)
	{
		$reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];
	    $emptyStars = url('/')."/images/blank_star.png";           
        $stars = url('/')."/images/star.png";

		$starsString = '';
		if($star) 
		{ 
			for($i=1; $i<=5; $i++) 
			{ 
				if($i <= $star) 
				{ 
					$starsString .= '<img src="'.$stars.'" title="'.$reviewStatusArray[$star].'"/>'; 
				} 
				else 
				{ 
					$starsString .= '<img src="'.$emptyStars.'" title="'.$reviewStatusArray[$star].'"/>'; 
				} 
			}  
		} 
		else 
		{ 
			for($i=1; $i<=5; $i++) 
			{ 
				$starsString .= '<img src="'.$emptyStars.'"/>'; 
			} 
		}

		return $starsString; 
	}
?>

@endsection