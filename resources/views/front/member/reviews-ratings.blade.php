@extends('front.layout.main')
@section('middle_content')
@inject('common', 'App\Common\Services\CommonService')
@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
@inject('reviewRatingModel', 'App\Models\ReviewRatingModel')
@inject('userDetailModel', 'App\Models\UserDetailModel')
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
               <div class="outer-box history-page" >
                  <!--                  <h4>Interviews</h4>-->
                  <!-- tabbing section -->
                  <div class="table-responsive">
                     <?php $colspan = (isset($member_id)) ? 2 : 1; ?>                  
                      <table class="datatable table table-striped table-bordered table table-advance" >
                        <thead>
                           <tr class="t-head">
                              <td >S.No <i class="fa fa-fw fa-sort"></i></td>
                              <td >Date <i class="fa fa-fw fa-sort"></i></td>
                              <td>Name <i class="fa fa-fw fa-sort"></i></td>
                              <td >Gender <i class="fa fa-fw fa-sort"></i></td>
                              <td ><div class="tblrow">Skill <i class="fa fa-fw fa-sort"></i></div>  
                              <div class="tblrow" style="    width: 160px;">Experience Level <i class="fa fa-fw fa-sort"></i></div> 
                              <div class="tblrow">Ratings <i class="fa fa-fw fa-sort"></i></div> <div class="tblrows">Reviews <i class="fa fa-fw fa-sort"></i></div>    </td>
                             
                           </tr>
                        </thead>
                        <tbody>
                          
                          @if(isset($memberReviews) && sizeof($memberReviews)>0)
                            
                            
                            <?php
                              
                              foreach($memberReviews as $key => $reviews)
                              {
                                  
                                  if($key%2 ==0) { $bgcolrs="asgreen"; $imagesc="http://interviewxp.com/images/sibg.png";  } else {$bgcolrs="aswhite";  $imagesc="";}
                                $bgColor = ($key%2 ==1) ? 'background-color: #f6f6f694;' : 'background-color: #fff;';
                            ?>
                                 <tr class="row-vm">
                             <td style="width: 80px !important;     padding: 8px;     border-top: 1px solid #f3f1f1;    background-repeat: repeat-x; background-image:url({{$imagesc}})" >{{$key+1}}</td>
                              <td ><div class="{{$bgcolrs}} ppd">{{ date(' d  M, Y' ,strtotime($reviews['created_at'])) }}</div></td>
                              <td ><div class="{{$bgcolrs}} ppd">{{ $reviews['user_detail']['first_name'] }}</div></td>
                              <td><div class="{{$bgcolrs}} ppd">@if($reviews['user_detail']['gender']=="M")Male @else Female @endif</div></td>
                              <td style="width: 580px;"><div style="width:100%; float:left" class="{{$bgcolrs}} ppd"><div class="tblrow1">{{ $reviews['interview_detail']['skill_name'] }}</div> <div class="tblrow1">{{$reviews['interview_detail']['experience_level'] or 'NA'}}</div></div>
                              
                               <?php

                              $transactionHistory = $common->getTransactionHistoryById($reviews->ticket_unique_id);
							  $comboReviews = ''; 
							  $comboRatings = ''; 	
                              foreach ($transactionHistory as $key1 => $transactionItem) {
                                
                                 $description = '';
								 if($transactionItem->combo_status == 1)
								 {
									$combo = $common->getCombos($transactionItem->order_id, true, false, null, true);
									$description = $combo['comboStr'];
									$basePrice = $combo['comboPrice'];
									$igst = $combo['comboIgst'];
									$cgst = $combo['comboCgst'];
									$sgst = $combo['comboSgst'];
									$totalAmount = $combo['comboTotal'];
									$comboReviews = $combo['comboReviews'];
									$comboRatings = $combo['comboRatings'];
								 }
								 else
								 {
									  if($transactionItem->item_type == 'Interview_qa')
									  {
										   $description = '<p style="margin: 0px;font-size: 12px;">&nbsp;&nbsp;*&nbsp;Interview QA</p>';
									  }
									  else if($transactionItem->item_type == 'Company')
									  {
										  $company_id = $transactionItem->item_id;
										  $item_name = '';
										  $interview_id = $transactionItem->interview_id;
										  $companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();
										  if($companyDetails)
										  {
											$item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
										  }
										  
										  $description .= '<p style="margin: 0px;font-size: 12px;">&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
									  }
									  else if($transactionItem->item_type == 'Work_exp')
									  {
										   $description = '<p style="margin: 0px;font-size: 12px;">&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$transactionItem->item_id.'</p>';
									  }
									  else if($transactionItem->item_type == 'Coach')
										 $description = '<p style="margin: 0px;font-size: 12px;">&nbsp;&nbsp;*&nbsp;Interview Coaching</p>';
								}
                                
                                $bgColor = 'background-color: #f6f6f6;';

                                $emptyStars = url('/')."/images/blank_star.png";           
                                $stars = url('/')."/images/star.png";
                                $reviewRating = '';
                                if($transactionItem->review_star > 0)
                                $reviewRating = $common->getReviewRatings($transactionItem->review_star);


								if($key1%2 ==0) { $bgcolrs="#f6f6f6ad !important";} else {$bgcolrs="#fff !important"; }
					

                            ?>
                            <div style="width:100%; float:left;   padding: 6px 0px 3px;; background-color: {{$bgcolrs}}; " >
                                
                            <div class="tblrow3"> {!! $description !!} <!--@if($transactionItem->combo_status == 1  && empty($comboReviews))<span style="color: #FF8000;padding-left: 7px;">(Combo)</span>@endif-->  </div>
                             
                            <div class="tblrow1">  <?php if(!empty($comboRatings)) {  echo $comboRatings;} elseif(isset($transactionItem->review_star)) { for($i=1; $i<=5; $i++) { if($i <= $transactionItem->review_star) { echo ' <i class="fa fa-star" aria-hidden="true" style="font-size: 16px; color:#ffc000"  title="'.$reviewRating.'"></i>'; } else { echo ' <i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.$reviewRating.'"></i>'; } }  } else { for($i=1; $i<=5; $i++) { echo ' <i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000" ></i>'; } } ?>
                           </div>
                           <div class="tblrow1">@if(!empty($comboReviews)) {!! $comboReviews !!}  @elseif(isset($transactionItem->review_message))<img src="{{url('/')}}/images/review.png"  style="width: 19px;    cursor: pointer;" title="{{ $transactionItem->review_message}}" />@if(isset($transactionItem->member_reply)) <span style="padding-left:10px" title="{{$transactionItem->member_reply}}">Replied</span> @else<a href="javascript:;" onclick="reply_review({{$transactionItem->review_id}})" style="padding-left:10px">Reply</a>@endif @else <img src="{{url('/')}}/images/comment-alt-regular.svg"  style="width: 19px;    cursor: pointer;" title="{{ $transactionItem->review_message}}" /> @endif
                           </div>
                           </div>
                            <?php 
								if($transactionItem->combo_status == 1)
								 {
									 break;
								 }
                            }
                              
                            ?>
                           
                              
                              
                              </td> 
                           
                              
                             
                              
                            </tr>
                         
                            
                            <?php  } ?>

                            
                          @endif
                           
                        </tbody>
                      </table>
                       <tr> <td colspan="5"><div class="col-md-12 text-center">{!! $memberReviews->render() !!} </div></td></tr>
					   
						<div class="modal reviewreplymodal" tabindex="-1" role="dialog" id="reviewreplymodal">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title">Reply to Review</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								{{ Form::open(array('url'=>'','method'=>'post', 'id'=>'form_reply_review')) }}
								  
									<div class="form-group">
									{!! Form::hidden('inputId', null,['class'=>'form-control','id'=>'inputId']) !!}
									{!! Form::textarea('inputComment', null, array('required','class'=>'form-control','placeholder'=>'Enter Comment', 'cols'=>2,'rows'=>2)) !!}
									</div>
								  <div class="form-group">
									{!! Form::submit('Submit Review', array('class'=>'btn btn-primary', 'id'=>'btn_admin_comment')) !!}
								  </div>
								{{ Form::close() }}
							  </div>
							</div>
						  </div>
						</div>
                
      </div>

      <!-- end -->
   </div>
    </div>
</div>
   </div>
</div>
<style type="text/css">
  .table-advance tbody > tr:nth-child(even) {
      border-left: none;
  }
  .table-advance tbody > tr {
      border-left: none;
  }
  th {
    text-align: left;
    font-size: 15px;
  }
  .table-responsive p{
    float: left;
  }
  .pagination>li>a, .pagination>li>span{
         height: 40px;
   }
   .tblrow {     width: 120px;
    display: inline-block;
   

   
    text-align: left;}
    
     .tblrow1 { width:120px;    display: inline-block;
  

    text-align: left; }
    
    .tblrows {width: 140px;  display: inline-block; text-align: left;}
    
    
    .tblrow3 { width:300px;    display: inline-block;text-align: left; float: left; }
    .outer-box {border: none; } 
    select.input-sm {
    
    line-height: 22px;
}
.dataTables_filter {
    margin-top: 0px;
}
.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 0px 0;
    border-radius: 4px;
}
.pagination>li>a, .pagination>li>span {
    height: 33px;
    cursor: pointer;
}  
.table-bordered>thead>tr>td,.table-bordered>tbody>tr>td { border:none;}
.table>tbody>tr>td { padding:0px;}
.ppd { padding:8px;}
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #ffffff;
}
.aswhite {
    background: #fff !important;
    border-top: 1px solid #f3f1f1;
}
#DataTables_Table_0_wrapper {  width:98%; }

.history-page .table .t-head td {
   
   
}
.tblrow1 p {
    height: 18px;
}
</style>
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
		function reply_review(id) {

			  $('#reviewreplymodal').modal('show');
			  $('#inputId').val(id);
			  var url = "{{url('/')}}/member/reply-review";
			  $('#form_reply_review').attr('action',url);
			return false;   
	   }
		</script>
@endsection