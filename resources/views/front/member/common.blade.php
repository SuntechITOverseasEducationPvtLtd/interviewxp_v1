<style>
    .scommon_01{padding:0px !important;}
.scommon_02{border:none !important;}
.scommon_03{font-size: 16px !important; color:#ffc000 !important;}
.scommon_04{width: 19px !important; cursor: pointer !important;}
.scommon_05{color:red !important;}

</style>


@extends('front.layout.main')
@section('middle_content')
@inject('common', 'App\Common\Services\CommonService')
<div id="member-header" class="after-login"></div>

<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')  
      <?php
        $reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];
     ?>
      <div class="col-sm-9 col-md-9 col-lg-10 middle-content">
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
                              <td>S.No </td>
                              <td>Description</td>
                              <td>Experience Level</td>
                               <td>Status</td>
                              <td>&nbsp;</td>
                           </tr>
                        </thead> 
                        @if(isset($arr_interview) && sizeof($arr_interview)>0)
                        <?php $myss=0; ?>
                        @foreach($arr_interview as $key => $uploads)
                        
                        <?php  $myss++; ?>
                        <thead class="box  hideRow hideRow{{$key+1}}">
                           <tr class="top hideAll" id="{{$key+1}}">
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
                              <td>{{$key+1}}</td>
                              <td>
                                 {{$interview_skill_name}}   
                              </td>
                              <td>
                                 {{isset($uploads['experience_level']) && $uploads['experience_level'] != 'NA'?$uploads['experience_level'].' Year':'NA'}}
                              </td>
                              
                                <td>							    
								<input type="checkbox" id="toggle-two{{$key+1}}" data-on="Available" data-off="Not Available" data-interview="{{$uploads['id']}}" data-id="{{$key+1}}">
								@if($uploads['is_available'] == 1)
								<script>
									$(function() {
										$('#toggle-two{{$key+1}}').bootstrapToggle('on');										
									})
								</script>
								@else
									<script>
									$(function() {
										$('#toggle-two{{$key+1}}').bootstrapToggle('off');										
									})
								</script>
								@endif
							  </td>
							  
							  
                              <td><img src="{{url('/')}}/images/plus_faq.png" /></td>
                           </tr>
                           <tr class="bottom" style="{!! (isset($interviewId)) ? '': 'display:none;' !!}">
                              <td colspan="4" class="scommon_01">
                                 <div class="multi-tabbing">
								    <div class="panel with-nav-tabs panel-default scommon_02" >
											<div class="tab-content">
											   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
												  <div class="table-responsive">
													  <table class="datatable table table-striped table-bordered table table-advance" >
													     
<thead>
					
						       <tr class="top-strip-table">
<td >S.No <i class="fa fa-fw fa-sort"></i></td>
<td >Date Purchased <i class="fa fa-fw fa-sort"></i></td>
<td >Name <i class="fa fa-fw fa-sort"></i></td>
<td >PH.No. <i class="fa fa-fw fa-sort"></i></td>
<td >Email Id <i class="fa fa-fw fa-sort"></i></td>
<td >Ratings <i class="fa fa-fw fa-sort"></i></td>
<td >Reviews <i class="fa fa-fw fa-sort"></i></td>
<td >Status <i class="fa fa-fw fa-sort"></i></td>
														</tr>
					</thead>
														
														
														<tbody >
													
														<?php
													
                            $reviewInfoObj = $common->getMemberCoaches($uploads['user_id'],$uploads['skill_id']);
														 
                                                                                     

                                           foreach ($reviewInfoObj as $key=>$reviewInfo) {
									
														if(isset($reviewInfo)){              
															$star= (count($reviewInfo->coach_reviews_ratings) > 0) ? $reviewInfo->coach_reviews_ratings->review_star : '';
															$msg=(count($reviewInfo->coach_reviews_ratings) > 0) ? $reviewInfo->coach_reviews_ratings->review_message : '';
															if($star <=2)
																$staus="Pending" ;
															else
																$staus="Completed";
														}else{
															$star="-";
															$msg="";
															$staus="Pending";
														}
                                          $emptyStars = url('/')."/images/blank_star.png";           
                                          $stars = url('/')."/images/star.png";           
if($key%2==0) { $rowcolor='asgreen';}  else { $rowcolor='aswhite'; } 
														?>
														<tr class="{{$rowcolor}}">
															<td>{{$key+1}}</td>
															<td>{{$reviewInfo->created_at}}</td>
															<td>{{$reviewInfo->user_detail->first_name or ''}} {{$reviewInfo->user_detail->last_name or ''}}</td>
															<td>{{$reviewInfo->user_detail->mobile_no or ''}}</td>
															<td>{{$reviewInfo->user_detail->email or ''}}</td>
															<td><?php if($star) { for($i=1; $i<=5; $i++) { if($i <= $star) { echo ' <i class="fa fa-star scommon_03"  aria-hidden="true"  title="'.$reviewStatusArray[$star].'"></i>'; } else { echo ' <i class="fa fa-star-o scommon_03" aria-hidden="true"  title="'.$reviewStatusArray[$star].'"></i>'; } }  } else { for($i=1; $i<=5; $i++) { echo ' <i class="fa fa-star-o scommon_03" aria-hidden="true"></i>'; } } ?></td>
															<td title="{{$msg}}">@if(!empty($msg))<img src="{{url('/')}}/images/review.png" class="scommon_04" />@endif</td>
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
         <td class="scommon_05">
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

<div class="modal fade popup-cls" id="myModalsm" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/>
		</button>
		  <h4 class="modal-title">Reason for Not Available</h4>
		</div>
		<div class="modal-body">
		  <div class="form-group">
			  <input type="hidden" name="interviewId" id="interviewId" value="" />
			  <input type="hidden" name="status" id="status" value="" />
			  <input type="hidden" name="key" id="key" value="" />
			  <textarea name="not_available_reason" id="not_available_reason" cols="45" rows="3"></textarea>
		</div>
		</div>
		<div class="modal-footer">
			  <button type="button" id="btn_not_available_reason" class="d-account">Submit</button>
		</div>
		</div>
	</div>
</div>
<style>
    
    .history-page .table-search-pati.section1-tab.add-skiils-table tr td {
    padding: 10px 11px 10px 25px !important;
    text-align: left;
    font-size: 14px; }
    
   



</style>
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
$(function() {
	$('.toggle label').click(function(){
		var status = ($(this).text() == 'Available') ? 0 : 1;
		var interviewId = $(this).parent().parent().find('input').attr('data-interview');
		var key = $(this).parent().parent().find('input').attr('data-id');
		$('#interviewId').val(interviewId);
		$('#status').val(status);
		$('#key').val(key);
		
		if(status == 0)
		{
			$('#myModalsm').modal('show');
			$('#toggle-two'+key).bootstrapToggle('off');
		}
		else{
			$('#myModalsm').modal('hide');
			$('#btn_not_available_reason').trigger('click');
			$('#toggle-two'+key).bootstrapToggle('off');
		}
		
		
	});
	$('#btn_not_available_reason').click(function(){
		$('#myModalsm').modal('hide');
		var status = $('#status').val();
		var not_available_reason = $('#not_available_reason').val();
		var interviewId = $('#interviewId').val();
		var key = $('#key').val();
		var link = "{{ url('/member/update_interview_available_status') }}";
		$.ajax({
		  url:link,
		  type:'get',
		  data:{status : status, interviewId : interviewId, not_available_reason : not_available_reason},
		  dataType: 'json',
		  async: false,
		  beforeSend:function()
		  {
			
		  },
		  success:function(response)
		  {
			if(response.status == 'failed')
			{
				alert('All users are not reviewed to this skill');
				$('#toggle-two'+key).bootstrapToggle('off');				
			}
			else{$('#toggle-two'+key).bootstrapToggle('off');}
		  } 
		 });
		
	});
});
</script>

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
		
		<style>
		    
		    .toggle-on.btn {
    padding-right: 0px; padding-left: 0px; }
    .toggle-handle { margin:0px;}
    
    .toggle-on.btn {
   
    margin: 0px;
}

.toggle-handle {
     
    width: 35px;
     margin-left: 10px;
}

.toggle-on {
   
    right: 60%; }
    .toggle-group {
 
    width: 190%; }
    
    .toggle.btn {
   
   
    width: 110px !important;     
}
    
	.btn.active, .btn:active {
   
    -webkit-box-shadow: inset 0 3px 5px rgb(255, 255, 255);
    box-shadow: inset 0 3px 5px rgb(255, 255, 255);
}

.btn-default.active {
    color: #333;
    background-color: #e8e8e8;
    border-color: #e8e8e8;
}


.btn-default.active {
    color: #333;
    background-color: #e8e8e8;
    border-color: #e8e8e8;
    width: 114px;
    height: 33px;
    margin-top: 0px;
}

		</style>
@endsection