<style>
    .scoach_01{padding:0px  !important;}
.scoach_02{border:none  !important;}
.scoach_03{font-size: 16px  !important:; color:#ffc000 !important;}
.scoach_04{width: 19px   !important; cursor: pointer  !important;}
.scoach_05{color:red  !important;}
</style>

@extends('front.layout.default')
@section('middle_content')
@inject('common', 'App\Common\Services\CommonService')

      <?php
        $reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];
     ?>
                  <div class="table-responsive">

                        @if(isset($arr_interview) && sizeof($arr_interview)>0)
                        <?php $myss=0; ?>
                        @foreach($arr_interview as $key => $uploads)
                        
                        <?php  $myss++; ?>
                        <thead class="box  hideRow hideRow{{$key+1}}">

                           <tr class="bottom">
                              <td colspan="4" class="scoach_01">
                                 <div class="multi-tabbing">
								    <div class="panel with-nav-tabs panel-default scoach_02" >
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
							<td><?php if($star) { for($i=1; $i<=5; $i++) { if($i <= $star) { echo ' <i class="fa fa-star scoach_03" aria-hidden="true"   title="'.$reviewStatusArray[$star].'"></i>'; } else { echo ' <i class="fa fa-star-o scoach_03" aria-hidden="true"  title="'.$reviewStatusArray[$star].'"></i>'; } }  } else { for($i=1; $i<=5; $i++) { echo ' <i class="fa fa-star-o scoach_03" aria-hidden="true" ></i>'; } } ?></td>
							<td title="{{$msg}}">@if(!empty($msg))<img src="{{url('/')}}/images/review.png" class="scoach_04" />@endif</td>
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
               
         </td>
         </tr>
         </thead>
         
        
         @endforeach
         @else
         <tr class="strips">
         <td class="scoach_05">
         No Records found...
         </td>
         </tr>
         @endif    
         </tr>
         </table>
      </div>
      <!-- end -->
   

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
		<script src="https://www.jquery-az.com/boots/js/datatables/datatables.js"></script>
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