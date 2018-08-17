@extends('front.layout.main')
@section('middle_content')      
@inject('common', 'App\Common\Services\CommonService')
@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>
      <div class="container-fluid fix-left-bar max-height">
         <div class="row">
            @include('front.member.member_sidebar')
            <div class="col-sm-8 col-md-9 col-lg-10 middle-content">
               <h2 class="my-profile pages">{{$module_title}}</h2>
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="middle part green-table">
                        <div class="outer-box revenue">
                           <div class="icon-wrapper" style="display:none"> 
                              <a style="visibility:hidden" href="#" class="delete-i-top"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              <!--<a href="{{url('/member/revenue_reports')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>-->
                           </div>
                           <div class="section1-tab history-page">
                            <div class="table-responsive" style="border:0">

                              <input type="hidden" name="multi_action" value="" />

                       <table class="datatable table table-striped table-bordered table table-advance" style="width: 1524px !important;">
                                <thead>
                                  <tr class="t-head">
                                       <td >S.No <i class="fa fa-fw fa-sort"></i></td>
                                       <td style="width: 100px !important;">Name <i class="fa fa-fw fa-sort"></i></td>
                                       <td style="width: 100px !important;">Sold Date <i class="fa fa-fw fa-sort"></i></td>
                                       
                                       
                                       
                                       <td style="width:1000px;">
                                           
                                           
                              <div class="tblrow">Skill <i class="fa fa-fw fa-sort"></i></div>  
                              <div class="tblrow" style=" width: 158px;">Experience Level <i class="fa fa-fw fa-sort"></i></div> 
                              
                              
                              <div class="tblrow">Sale Amount <i class="fa fa-fw fa-sort"></i></div>
                              <div class="tblrow" style=" width: 162px;">My Earnings <i class="fa fa-fw fa-sort"></i></div>
                              <div class="tblrow">Ratings <i class="fa fa-fw fa-sort"></i></div>
                           
                           
                              <div class="tblrow">Reviews <i class="fa fa-fw fa-sort"></i></div>    
                                           <div class="tblrows" style=" width: 140px;">Payment Action <i class="fa fa-fw fa-sort"></i></div>
                                           </td>
                                       
                                  </tr>
                                </thead>
                                <tbody>
                            @if(isset($arr_transaction) && sizeof($arr_transaction)>0)
                                    @foreach($arr_transaction  as $key => $data)

                                    <?php
                                      //print_r($data);
                                      
                                      if($key%2 ==0) { $bgcolrs="asgreen"; $imagesc="http://interviewxp.com/images/sibg.png"; } else {$bgcolrs="aswhite"; $imagesc=""; }
                                      
                                      
                                      $bgColor = ($key%2 ==1) ? 'background-color: #f6f6f6;' : 'background-color: #f6f6f6;';
                                    ?>
                                  <tr class="row-vm">                 
                                       <td style="width: 60px !important;     padding: 8px;     border-top: 1px solid #f3f1f1;    background-repeat: no-repeat; background-image:url({{$imagesc}})" >{{$key+1}}</td>
                                       <td style="width: 120px !important;"><div class="{{$bgcolrs}} ppd">{{ $data['user_detail']['first_name'].' '.$data['user_detail']['last_name']}}</div></td>
                                       <td style="    width: 185px !important;"> <div class="{{$bgcolrs}} ppd">{{ date('D j M, Y, g:i A T', strtotime($data['created_at']))}}</div></td>
                                      
                                      
                                        <td style="width:1000px;"><div style="width:100%; float:left" class="{{$bgcolrs}} ppd"><div class="tblrow1">{{ $data['interview_detail']['skill_name'] or 'NA' }}</div>
                                        
                                        <div class="tblrow1" style="width: 158px;">{{ $data['interview_detail']['experience_level'] or 'NA' }}</div>
                                        <div class="tblrow1">{{ number_format($data['base_price'],2) }}</div>
                            <div class="tblrow1">{{ number_format($data['member_amount'],2) }}&nbsp;&nbsp;({{ 100-$data['admin_commission'] }}%)</div>
                                        </div>
                                             <?php
                                      $transactionHistory = $common->getTransactionHistory($data['order_id']);
									  $comboReviews = ''; 
									  $comboRatings = ''; 
                                      foreach ($transactionHistory as $key1 => $transactionItem) {
                                         
                                         if($transactionItem->combo_status == 1)
                                         {
                                            $combo = $common->getCombos($transactionItem->order_id, true);
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
                                            $description = '';
                                            if($transactionItem->item_type == 'Interview_qa')
                                            {
                                                 $description = '<p  style="  margin: 0px; font-size: 12px;">&nbsp;&nbsp;*&nbsp;Interview QA</p>';
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
                                                
                                                $description .= '<p style="  margin: 0px; font-size: 12px;">&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
                                            }
                                            else if($transactionItem->item_type == 'Work_exp')
                                            {
                                                 $description = '<p style="  margin: 0px; font-size: 12px;">&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$transactionItem->item_id.'</p>';
                                            }
                                            else if($transactionItem->item_type == 'Coach')
                                               $description = '<p style="  margin: 0px; font-size: 12px;">&nbsp;&nbsp;*&nbsp;Interview Coaching</p>';

                                            $basePrice = $transactionItem->item_price;
                                            $igst = $transactionItem->igst;
                                            $cgst = $transactionItem->cgst;
                                            $sgst = $transactionItem->sgst;
                                            $totalAmount = $basePrice + $igst + $cgst + $sgst;
                                         }

                                        $bgColor = 'background-color: #f6f6f6;';

                                        $emptyStars = url('/')."/images/blank_star.png";           
                                        $stars = url('/')."/images/star.png";
if($key1%2 ==0) { $bgcolrs="#f6f6f6ad !important";} else {$bgcolrs="#fff !important"; }
                                    ?>
                                    
                                    
                                    <div style="width:100%; float:left;  background-color: {{$bgcolrs}}; " class="ppd"><div class="tblrow3" style="float: left;">{!! $description !!}</div>
                                    
                                 
                                    <div class="tblrow1" style=" width: 158px; float: left;"><p style="  margin: 0px; font-size: 12px;"><span>{{ number_format($basePrice,2) }}</span></p></div>
                                      <div class="tblrow1"></div>
                                    <div class="tblrow1"> <?php if(!empty($comboRatings)) {  echo $comboRatings;} elseif(isset($transactionItem->review_star)) { for($i=1; $i<=5; $i++) { if($i <= $transactionItem->review_star) { echo ' <i class="fa fa-star" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.$common->getReviewRatings($transactionItem->review_star).'"></i>'; } else { echo ' <i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.$common->getReviewRatings($transactionItem->review_star).'"></i>'; } }  } else { for($i=1; $i<=5; $i++) { echo '<i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000"></i>'; } } ?>
                                    </div>
                                    <div class="tblrow1">@if(!empty($comboReviews)) {!! $comboReviews !!} @elseif(isset($transactionItem->review_message))<img src="{{url('/')}}/images/review.png"  style="width: 19px; cursor: pointer;"  title="{{ $transactionItem->review_message}}" />@else <img src="{{url('/')}}/images/comment-alt-regular.svg"  style="width: 17px; cursor: pointer;"  title="{{ $transactionItem->review_message}}" /> @endif</div>
                                    <div class="tblrow1"> <p style="  margin: 0px; font-size: 12px;"> @if($data['member_payment_status'] != 'Paid' && $transactionItem->payment_status == 'refunded')
                                          Refunded
                                          @elseif($data['member_payment_status']!='Paid')
                                          Pending 
                                          @endif </p></div>
                               
                                    
                                    </div>
                                    
                                      <?php 
                                    }
                                      
                                    ?>
                                      
                                      </td>    
                                        
                                    </tr>
                                   
                                    @endforeach
                                    @endif
                                </tbody>
                              </table>
                            </div>
                           </div>
                           <!-- pagination -->
                              <div class="prod-pagination">
                                   {!! $arr_transaction->render() !!}
                              </div>
                           <!-- end -->              
                        </div>
                        

                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
      </div>
     <style>
         
         .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px 3px; }
     </style>
     
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
   .tblrow {width: 120px;  display: inline-block; text-align: left;
       

   
   
   }
   
   .dbg {
  

}


    .tblrow60 {width: 60px;  display: inline-block; text-align: left;}
      .tblrow160 {width: 160px;  display: inline-block; text-align: left;}
     .tblrow1 { width:120px;    display: inline-block; text-align: left; }
  
.tblrows {width: 140px;  display: inline-block; text-align: left;}
    
    
    
    .tblrow3 { width:284px;    display: inline-block;
   

    text-align: left; }
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

.green-table table tr:nth-child(even) {
    background-color: #ffffff;
}
.tblrow3 span{
	float : left;
	width : 100%;
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
		</script>
@endsection       

