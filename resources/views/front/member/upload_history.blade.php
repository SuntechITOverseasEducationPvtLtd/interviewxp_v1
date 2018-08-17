@extends('front.layout.main')
@section('middle_content')



<!------ Include the above in your HEAD tag ---------->


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
                        <h2>INR {{number_format($tot_act_revenue_ern,2)}}/-</h2>

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
             
             <div class="modal fade in" id="myModal-s" role="dialog" >
    <div class="modal-dialog sign-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content sign-content" style="margin-top:-75px">
        <div class="modal-header sign-header">
            SIGN UP
          <button type="button" class="close sign-close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body sign-body" style="padding:2px 0px"> 
            
          <form id="form-validationreg" name="form-validation" method="POST">
	

	   <div class="col-md-12 showratingview">
		 <input autocomplete="off" type="text" placeholder="Name" name="Name" class="form-control margin-top-35" required="" id="username_or_email">
	   </div>

	   <div class="col-md-12">
		 <input type="email" placeholder="Email" name="Email" class="form-control  required form-control" id="login_password" required="">
	   </div>

	   <div class="col-md-12">
		<input name="Password" type="password" placeholder="Password" class="password tpass required form-control" id="reenter_password" required="">
	   </div>



	   <div class="col-md-12">
		<input name="rePassword" type="password" placeholder="Confirm Password" class="password cpass required form-control" id="reenter_password" required="">
	   </div>



   <div class="col-md-12" style="display:none">
	<input name="usertype" type="hidden" value="1">
	<select name="usertypess" class="form-control" placeholder="User Type" style="height: 50px;
    border-radius: 25px;
    background-color: #f3f3f3;
    border: none;
 "><option value="" select="">User Type</option>
<option value="1">Personal Use</option>
<option value="2">Corporate Use</option>
</select>
	   </div>




           <div class="col-md-12 text-center">
              <input type="submit" class="btn text-uppercase btn-sm btn-default btn-cancel" style="    margin-right: 0px;" value="Register">
          </div>
               
                
				<div class="clearfix"></div>
					</form>
            
        </div>

      </div>
      
    </div>
</div>


         	<div class="col-sm-12 uploads-title">
            	<h2 class="col-sm-3 my-profile m-history">Uploads </h2>
            	<div class="col-sm-3 right-block" style="display: none">
                  <h5>Profile Performance</h5>
                  <div class="col-xs-6 col-md-9 col-lg-6 new-perfrom">
                  	 <a href="#" class="no_of_views_url" target="_blank">	
                     <div class="table-number no-of-views">1</div>
                     <div class="radio-btns table-radio-btn">
                        <div class="radio-btn">
                           <!-- <input id="Radio1" name="selector" type="radio"> -->
                           <label for="Radio1">No. of views</label>
                           <div class="check new-top"></div>
                        </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-xs-6 col-md-9 col-lg-6 new-perfrom">
              		 <a href="#" class="no_of_sales_url" target="_blank">
                     <div class="table-number no-of-sales">0</div>
                     <div class="radio-btns table-radio-btn">
                        <div class="radio-btn">
                           <!-- <input id="Radio2" name="selector" type="radio"> -->
                           <label for="Radio2">No. of Sales</label>
                           <div class="check new-top"></div>
                        </div>
                     </div>
                     </a>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
           
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
            
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
								 <?php
									$interview_skill_name = '';
									if(isset($uploads['skill_name']) && isset($uploads['experience_level'])  && $uploads['experience_level'] != 'NA')
									{
										$interview_skill_name = $uploads['allskill'].' Real Time Interview Questions &amp; Answers';
									}
									else if(($uploads['skill_name']) && isset($uploads['experience_level'])){									
										$interview_skill_name = $uploads['allskill'].' Interview Questions &amp; Answers';
									}
							    ?>
                                 {{$interview_skill_name}}
                                 <input type="hidden" name="user_purchase_details" id="user_purchase_details{{$key+1}}" value="{{isset($uploads['user_purchase_details'])?count($uploads['user_purchase_details']):''}}"> 
                                 <input type="hidden" name="user_view_count" id="user_view_count{{$key+1}}" value="{{isset($uploads['view_count'])?$uploads['view_count']:''}}"> 
                                 <input type="hidden" name="no_of_views_url" id="no_of_views_url{{$key+1}}" value="{{url('/')}}/interview_details/{{ base64_encode($uploads['id']) }}"> 
                                 <input type="hidden" name="no_of_sales_url" id="no_of_sales_url{{$key+1}}" value="{{url('/')}}/member/revenue_reports">
                              </td>
                              <td>
                                 {{isset($uploads['experience_level']) && $uploads['experience_level'] != 'NA'?$uploads['experience_level'].' Year':'NA'}}
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
													
													 @if(isset($uploads['reference_book_details']) && sizeof($uploads['reference_book_details'])>0)
													
														<iframe src="interviewqna/{{$uploads['id']}}" style="width:100%; height:1400px; border:none"></iframe>
														 @else
																 
																	  <div style="color:red;">
																		 No Records found...
																	  </div>
																   
																   @endif
														
												
												</div>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<div class="tab-pane fade" id="tab2default{{$uploads['id']}}">
												    
												    @if(isset($uploads['interview_details']) && sizeof($uploads['interview_details'])>0)
													
														<iframe src="interviewscompanies/{{$uploads['id']}}" style="width:100%; height:1400px; border:none"></iframe>
														 @else
																 
																	  <div style="color:red;">
																		 No Records found...
																	  </div>
																   
																   @endif
														
											
												</div>
												@endif
											
												<div class="tab-pane fade" id="tab3default{{$uploads['id']}}">
												    
												       	@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
													
														<iframe src="realissuesqa/{{$uploads['id']}}" style="width:100%; height:1400px; border:none"></iframe>
														 @else
																 
																	  <div style="color:red;">
																		 No Records found...
																	  </div>
																   
																   @endif
																   
												
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
		$(".uploads-title").addClass('profile-performance');
		$(".outer-box.history-page").addClass('profile-performance');
		$(".profile-performance .right-block").show();
		var user_purchase_details = $("#user_purchase_details"+id).val();
		var user_view_count = $("#user_view_count"+id).val();
		var no_of_views_url = $("#no_of_views_url"+id).val();
		var no_of_sales_url = $("#no_of_sales_url"+id).val();
		$('.no-of-views').html(user_view_count);
		$('.no-of-sales').html(user_purchase_details);
		$('.no_of_views_url').attr('href',no_of_views_url);
		$('.no_of_sales_url').attr('href',no_of_sales_url);
	});

</script>
 <style type="text/css">
	.profile-performance .right-block {
	    border: 1px solid #eee;
	    padding: 0px;
	    border-radius: 3px;
	    margin-top: 10px;
	    margin-bottom: 10px;
	    float: right;
	}
	.profile-performance .new-perfrom {
	    margin: 0px;
	    width: 50%;
	}
	.profile-performance.outer-box.history-page {
	     margin-top: 0px;
	}
	.profile-performance .m-history {
	    margin-top: 70px;
	}
	.profile-performance .right-block > h5 {
	    padding-left: 20px;
	}
		.history-page .table-search-pati.section1-tab.add-skiils-table tr td {
    padding: 10px 11px 10px 25px !important;
    text-align: left;
    font-size: 14px;
}
</style>

</style>

		
	
 
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
	<script src="http://cloudforcehub.com/interviewxp/js/datatables.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable').dataTable({
				"sPaginationType": "bs_full"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>
 
@endsection