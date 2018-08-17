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
      <div class="col-sm-9 col-md-9 col-lg-10">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="my-profile m-history">My Bookings</h2>
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
                                 {{isset($uploads['skill_name'])?$uploads['skill_name']:'NA'}} Real Time Interview Questions &amp; Answers   
                              </td>
                              <td>
                                 {{isset($uploads['experience_level'])?$uploads['experience_level']:'NA'}} Year
                              </td>
                              <td><img src="{{url('/')}}/images/plus_faq.png" /></td>
                           </tr>
                           <tr class="bottom" style="display:none;">
                              <td colspan="4">
                                 <div class="multi-tabbing">
								    <div class="panel with-nav-tabs panel-default">
											<div class="tab-content">
											   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
												  <div class="table-responsive">
													 <table class="table">
														<tbody>
														  <tr class="top-strip-table">
															<td>S.No</td>
															<td>Date Purchased</td>
															<td>Name</td>
															<td>PH.No.</td>
															<td>Email Id</td>
															<td>Ratings</td>
															<td>Reviews</td>
															<td>Status</td>
														</tr>
														<?php
														//echo "SELECT * FROM transaction a, purchase_history b, users c where a.member_user_id='".$uploads['user_id']."' AND a.skill_id='".$uploads['skill_id']."' AND a.order_id=b.order_id AND a.ref_interview_id=b.interview_id AND b.TextResumeType=1 AND a.user_id=c.id";
														 $results = DB::select( DB::raw("SELECT * FROM transaction a, purchase_history b, users c where a.member_user_id='".$uploads['user_id']."' AND a.skill_id='".$uploads['skill_id']."' AND a.order_id=b.order_id AND a.ref_interview_id=b.interview_id AND b.TextResumeType=1 AND a.user_id=c.id") );
														 foreach ($results as $key=>$user) {
														 $reviewInfo = DB::table('review_rating')
																		->where('user_id', $user->user_id)
																		->where('member_user_id', $uploads['user_id'])
																		->where('interview_id', $user->interview_id)
																		->where('ReviewType', 'Interview Coaching')
																		->first();
														if(isset($reviewInfo)){
															$star=$reviewInfo->review_star;
															$msg=$reviewInfo->review_message;
															if($star <=2)
																$staus="Not Satisfied";
															else
																$staus="Completed";
														}else{
															$star="-";
															$msg="";
															$staus="Pending";
														}
														?>
														<tr>
															<td>{{$key+1}}</td>
															<td>{{$user->created_at}}</td>
															<td>{{$user->first_name}} {{$user->last_name}}</td>
															<td>{{$user->mobile_no}}</td>
															<td>{{$user->email}}</td>
															<td>{{$star}}</td>
															<td title="{{$msg}}"><i class='fa fa-eye' aria-hidden='true'></i></td>
															<td>{{$staus}}</td>
														</tr>
														<?php
														}
														?>
														</tbody>
													 </table>
														<!--end-->
													 </div>
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

</script>
@endsection