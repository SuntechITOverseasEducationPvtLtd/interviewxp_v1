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
            <div class="top-blocks-wrapper">
               <div class="col-sm-4">
                  <div class="top-blocks">
                     <div class="content-block">
                        <h2>INR {{number_format($act_revenue_ern+$act_revenue_pen,2)}}/-</h2>

                        <h5>TOTAL REVENUE EARNED</h5>
                     </div>
                     <div class="img-top-blocks"><img src="{{url('/')}}/images/rupies-img.png" alt="Interviewxp"/></div>
                     <div class="line-img hidden-xs hidden-sm hidden-md"><img src="{{url('/')}}/images/green-line.png" alt="Interviewxp"/></div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="top-blocks">
                     <div class="content-block">
                        <h2>INR {{number_format($act_revenue_ern,2)}}/-</h2>
                        <h5>CURRENTLY CONFIRMED</h5>
                        <h3 class="payout"><span>After Tax</span>(Payout Every Month 10th)</h3>
                     </div>
                     <div class="img-top-blocks"><img src="{{url('/')}}/images/money-img.png" alt="Interviewxp"/></div>
                     <div class="red-line line-img hidden-xs hidden-sm hidden-md"><img src="{{url('/')}}/images/red-line.png" alt="Interviewxp"/></div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="top-blocks">
                     <div class="content-block">
                        <h2>INR {{number_format($act_revenue_pen,2)}}/-</h2>
                        <h5>NOT YET CONFIRMED </h5>
                     </div>
                     <div class="img-top-blocks"><img src="{{url('/')}}/images/blocks-img.png" alt="Interviewxp"/></div>
                     <div class="line-img hidden-xs hidden-sm hidden-md"><img src="{{url('/')}}/images/blue-line.png" alt="Interviewxp"/></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="my-profile m-history">Uploads</h2>
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
                              <td>Options</td>
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
                              <td>
                              @if($uploads['admin_approval']==0)
                              <a href="{{url('/')}}/member/delete-skill/{{ base64_encode($uploads['id']) }}" onclick="return confirm('Are you sure want to cancel the skill?')"><i class="fa fa-minus-circle" aria-hidden="true" title="Delete Skill"></i>
                              </a>
                               <a href="{{url('/')}}/member/update-skill/{{ base64_encode($uploads['id']) }}"><i class="fa fa-pencil" aria-hidden="true" title="Update Skill"></i>
                              </a> 
                              @endif                             
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
												<li><a style="font-size: 14px;" href="{{url('/member/biography')}}">Bookings</a></li>
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
																	  <td>Topic Name</td>
																	  <td>File Size</td>
																	  <td>Date & Time</td>
																	  <td>Status</td>
																   </tr>
																   
																   <?php
																   $results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$uploads['id']."' group by topic_name ORDER BY `multi_reference_book`.`id` DESC") );
																	
																	foreach ($results as $key=>$user) {
																		
																		$delete="/member/delete_reference_book_all/".base64_encode($user->topic_name);
																		$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 95, '...')));
																		?>
																		<tr style="background-color: #ecf8f7">
																			<td colspan="5" title="{{$string}}">{{$key+1}} . {{$string}} </td>
																		 </tr>
																			<?php
																				   $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$uploads['id']."' AND topic_name = '".$user->topic_name."' ORDER BY `multi_reference_book`.`id` DESC") );
																					foreach ($results1 as $key1=>$user1) {
																						
																						 if($user1->file_extension =='Pdf'){
																							 $icon='<i class="fa fa-file-pdf-o"></i>';
																						 }else if($user1->file_extension =='Video'){
																							 $icon='<i class="fa fa-play"></i>';
																						 }else{
																							 $icon="";
																						 }
																						 
																						 if($user1->approve_status==1){
																							 $status="Approved";
																							 $url="/member/delete_reference_book/".base64_encode($user->id);
																							 $dow="/uploads/refrence_book/".$user->mul_reference_book;
																							
																						 }
																							 
																						 else{
																							 $status="Pending";
																							 $url="/member/delete_reference_book/".base64_encode($user->id);
																							 $dow="/uploads/refrence_book/".$user->mul_reference_book;
																							 
																						 }
																						 
																						 $freeView="/member/freePreview/".base64_encode($user1->id);
																					?>
																					<tr>
																						<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </td><td>{{$user1->fileSize}} M.B</td>
																						<td>{{$user1->created_at}}</td>
																						<td><?php echo $status;?></td>
																					<?php
																					}
																					?>
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
															  <table class="table">
																 <tbody>
																	@if(isset($uploads['interview_details']) && sizeof($uploads['interview_details'])>0)
																	<tr class="top-strip-table">
																	   <td><b>Company Name</b></td>
																	   <td>File Name</td>
																	   <td>Date &amp; Time Uploaded</td>
																	   <td>Status</td>
																	</tr>
																	<?php
																	   $results = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$uploads['id']."' group by company_id ORDER BY `id` DESC") );
																		foreach ($results as $key=>$user) {
																			$NameCompany = DB::table('company_master')
																				  ->where('company_id', '=', $user->company_id)
																				  ->first();
																			$NameC=$NameCompany->company_name;
																			?>
																			<tr style="background-color: #ecf8f7">
																				<td colspan="5">{{$key+1}} . {{$NameC}} ({{$user->company_location}})</td>
																			 </tr>
																				<?php
																				   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$uploads['id']."' AND company_id = '".$user->company_id."'") );
																					foreach ($results1 as $key1=>$user1) {
																						 if($user1->file_extension =='Pdf'){
																							 $icon='<i class="fa fa-file-pdf-o"></i>';
																						 }
																							 
																						 if($user1->file_extension =='Video'){
																							 $icon='<i class="fa fa-play"></i>';
																						 }
																						 
																						 if($user1->approve_status==1){
																							 $status="Approved";
																						 }
																						 else{
																							 $status="Pending";
																						 }
																					?>
																					<tr>
																						<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; {{$user1->roundType}} &nbsp;&nbsp; {{$user1->pageCount}}</td>
																						<td>{{$user1->fileSize}} M.B</td>
																						<td>{{$user1->created_at}}</td>
																						<td><?php echo $status;?></td>
																					<?php
																					}
																					?>
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
												   <table class="table">
													   <tbody>
													   @if(isset($uploads['realtime_details']) && sizeof($uploads['realtime_details'])>0)
													   <tr class="top-strip-table">
													   <td>Tickets, Tasks, Etc.,</td>
													   <td>File Size</td>
													   <td>Date & Time Uploaded</td>
													   <td>Status</td>
													   </tr>
													   <?php
													   $results = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$uploads['id']."' group by issue_title ORDER BY `id` DESC") );
													   $i=1;
														foreach ($results as $key=>$user) {
															$i++;
															$delete="/member/delete_realtime_all/".base64_encode($user->user_id)."/".base64_encode($user->issue_title);
															$string = ucwords(strtolower(mb_strimwidth($user->issue_title, 0, 95, '...')));
															?>
															<tr style="background-color: #ecf8f7">
																<td colspan="5" title="{{$user->issue_title}}">{{$key+1}} . {{$string}} </td>
															 </tr>
																<?php
																	   $results1 = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$uploads['id']."' AND issue_title = '".$user->issue_title."'") );
																		foreach ($results1 as $key1=>$user1) {
																			 if($user1->file_extension =='Pdf'){
																				 $icon='<i class="fa fa-file-pdf-o"></i>';
																			 }else if($user1->file_extension =='Video'){
																				 $icon='<i class="fa fa-play"></i>';
																			 }else{
																				 $icon="";
																			 }
																			 
																			 if($user1->approve_status==1){
																				 $status="Approved";
																				 $dow="/uploads/real_time_attachment/".$user1->attachment;
																				 
																			 }
																				 
																			 else{
																				 $status="Pending";
																				 $url="/member/delete_realtime/".base64_encode($user->user_id)."/".base64_encode($user->id);
																				 $dow="/uploads/real_time_attachment/".$user1->attachment;
																				 
																			 }
																		?>
																		<tr>
																			<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; {{$user1->pageCount}} </td><td>{{$user1->fileSize}} M.B</td>
																			<td>{{$user1->created_at}}</td>
																			<td><?php echo $status;?></td>
																		<?php
																		}
																		?>
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

</script>
@endsection