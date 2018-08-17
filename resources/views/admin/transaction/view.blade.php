@extends('admin.layout.master')                
@section('main_content')
@inject('common', 'App\Common\Services\CommonService')
@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
<!-- BEGIN Page Title -->

            <style type="text/css">
                          .rounded-box {
                                  border-radius: 0%;
                                  height: 67px;
                                  overflow: hidden;
                                  width: 80px;
                                  float: left;
                          }
                          .rounded-box img {
                              border-radius: 50%;
                              float: left;
                              height: 73%;
                              width: 73%;
                          }
                           .proimgset {
                                height: 60px !important;
    width: 60px !important;
                          }
                           .table td {   padding: 2px 7px !important; }
                           p {
    margin: 0 0 3px; }
    .flipslide {cursor: pointer; } h4.value {font-size: 15px;
    line-height: 0px; }
    .form-group {     background-color: #f5f5f5; margin-bottom: 10px;
    padding: 5px 0px;
    line-height: 22px;} .pull-right {display:none; }
                        </style>
                       <script> 
$(document).ready(function(){ 
    $(".flipslide").click(function(){
        $thid=$(this).attr('id');
        alert($thid);
        $(".flipslidedownal"+$thid).slideToggle("slow");
    });
});
</script>
            <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
                  
                  <a href="{{ $module_url_path }}/total-sales" class="pull-right label bg-success-400" style="font-size: 14px;color:#fff; margin-top: 8px;">Back</a>
                  
                  
              
                      </div>
            </div>

  

         
         <div class="box-content">
            <div class="row">
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-6">
                        <h3>
                           <span 
                              class="text-" 
                              ondblclick="scrollToButtom()"
                              style="cursor: default;" 
                              title="Double click to Take Action" 
                              >
                           </span>
                        </h3>
                     </div>
                     
                  </div> 
                  <div class="form-group" style="    background-color: #f5f5f5;">
                     <div class="col-sm-6">
                        <label class="main-label">Transaction Id :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">IE0000{{ isset($arr_data['id'])?$arr_data['id']:'NA' }}</h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Order Id :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['order_id'])?$arr_data['order_id']:'NA' }}</h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Name :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['user_detail']['first_name'])?$arr_data['user_detail']['first_name']:'NA'}}</h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Email :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['user_detail']['email'])?$arr_data['user_detail']['email']:'NA'}}</h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Mobile No :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['user_detail']['mobile_no'])?$arr_data['user_detail']['mobile_no']:'NA'}}</h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Gender :</label>
                     </div>
                     <div class="col-sm-3">
                      
                     
                     <span class="label bg-success-400"> @if(isset($arr_data['user_detail']['gender']) && $arr_data['user_detail']['gender']=='F' )
                     Female
                     @else
                     Male
                     @endif </span>
                     </div>
                     <div class="clearfix"></div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Total Amount(Rs.) :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value"> <span class="label bg-blue">{{ isset($arr_data['grand_total'])?$arr_data['grand_total']:'NA' }}</span></h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Experience :</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">
                           {{ isset($arr_data['experience_level'])?$arr_data['experience_level']:'NA' }}
                        </h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-6 ">
                        <label class="main-label" >Purchase Detail :</label>
                     </div>
                     <div class="col-sm-6">
                        
                     </div>
                     <div class="clearfix"></div>
                  </div>
                
            </div>
            
            <div class="col-sm-6" style="padding-top: 20px;">
                
                
                
                
                <table class="table text-nowrap">
										<thead>
										
										</thead>
										<tbody>
											<tr class="active border-double" style="    height: 40px;">
												<td colspan="2" style="    font-size: 16px">  @if(isset($arr_data['experience_level']) == 'NA')
                           {{ $arr_data['skill_name'] }} interview questions & answers
                           @else
                           {{ $arr_data['skill_name'] }} real time interview questions & answers ($arr_data['experience_level'] Years)
                           @endif</td>
												<td class="text-right">
													<span class="progress-meter" id="today-progress" data-progress="30"><svg width="20" height="20"><g transform="translate(10,10)"><g class="progress-meter"><path d="M0,8A8,8 0 1,1 0,-8A8,8 0 1,1 0,8Z" style="fill: rgb(255, 255, 255); stroke: rgb(121, 134, 203); stroke-width: 1.5;"></path><path d="M4.898587196589413e-16,-8A8,8 0 0,1 7.608452130361228,2.472135954999579L0,0Z" style="fill: rgb(121, 134, 203);"></path></g></g></svg></span>
												</td>
											</tr>
											
											
											<?php
                     $transactionHistory = $common->getTransactionHistory($arr_data['order_id']);
                     foreach ($transactionHistory as $key => $transactionItem) {
                       if($transactionItem->combo_status == 1)
                       {
                          $combo = $common->getCombos($transactionItem->order_id);
                          $description = $combo['comboStr'];
                          $basePrice = $combo['comboPrice'];
                          $igst = $combo['comboIgst'];
                          $cgst = $combo['comboCgst'];
                          $sgst = $combo['comboSgst'];
                          $totalAmount = $combo['comboTotal'];
                       }
                       else
                       {
                          $description = '';
                          if($transactionItem->item_type == 'Interview_qa')
                          {
                               $description = '<p>&nbsp;&nbsp;*&nbsp;Interview QA</p>';
                          }
                          else if($transactionItem->item_type == 'Company')
                          {
                              $company_id = $transactionItem->item_id;
                              $interview_id = $transactionItem->interview_id;
                              $companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();

                              $item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
                              $description .= '<p>&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
                          }
                          else if($transactionItem->item_type == 'Work_exp')
                          {
                               $description = '<p>&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$transactionItem->item_id.'</p>';
                          }
                          else if($transactionItem->item_type == 'Coach')
                             $description = '<p>&nbsp;&nbsp;*&nbsp;Interview Coaching</p>';

                          $basePrice = $transactionItem->item_price;
                          $igst = $transactionItem->igst;
                          $cgst = $transactionItem->cgst;
                          $sgst = $transactionItem->sgst;
                          $totalAmount = $basePrice + $igst + $cgst + $sgst;
                       }

                      $refundcolours = ''; 
                      $refundtdcolour = '';
                         $mimus = '';

                      if($arr_data['member_payment_status'] != 'Paid' && $transactionItem->payment_status == 'refunded')
                      {
                        //$refundcolours="background-color : #E91E63 !important;color: #fff !important;";
                         $refundtdcolour = 'color: #E91E63 !important;'; $mimus='-';
                      }
                      
                  ?>
											
											<tr  >
												<td>
												
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold" style="    line-height: 10px; ">
														    
														    	<span class="status-mark border-blue position-left" style="float:left"></span>
														    {!! $description !!}</a></div>
														<div class="text-muted text-size-small">
														
															
														</div>
													</div>
												</td>
												
												<td><h6 class="text-semibold"><span class="text-success-600" style="{{$refundtdcolour}}">
												    <i class="icon-stats-growth2 position-left"></i> Rs. {{$mimus}}{!! number_format($basePrice,2) !!}</span></h6></td>
												
												<td class="text-center">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
														
														</li>
													</ul>
												</td>
											</tr>
											
											 <?php 
                  }
                    
                  ?>
                  
											
										</tbody>
									</table>
                
                
                
                <div class="panel bg-blue-400">
									
									 <div>
                     <div class="col-sm-3"></div>
                     <div class="col-sm-5">
                        <h4>
                           Sub Total
                        </h4>
                     </div>
                     <div class="col-sm-4">
                        <h4>
                           Rs. {!! number_format($arr_data['base_price'],2) !!}
                        </h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  @if($arr_data['cgst_percent'])
                  <div>
                     <div class="col-sm-3"></div>
                     <div class="col-sm-5">
                        <h4>
                           CGST ({{$arr_data['cgst_percent']}}%)
                        </h4>
                     </div>
                     <div class="col-sm-4">
                        <h4>
                           Rs. {!! number_format($arr_data['cgst_amount'],2) !!}
                        </h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  @endif
                  @if($arr_data['sgst_percent'])
                  <div>
                     <div class="col-sm-3"></div>
                     <div class="col-sm-5">
                        <h4>
                           SGST ({{$arr_data['sgst_percent']}}%)
                        </h4>
                     </div>
                     <div class="col-sm-4">
                        <h4>
                           Rs. {!! number_format($arr_data['sgst_amount'],2) !!}
                        </h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  @endif
                  @if($arr_data['igst_percent'])
                  <div>
                     <div class="col-sm-3"></div>
                     <div class="col-sm-5">
                        <h4>
                           IGST ({{$arr_data['igst_percent']}}%)
                        </h4>
                     </div>
                     <div class="col-sm-4">
                        <h4>
                           Rs. {!! number_format($arr_data['igst_amount'],2) !!}
                        </h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  @endif
                  <div>
                     <div class="col-sm-3"></div>
                     <div class="col-sm-5">
                        <h4>
                           Total
                        </h4>
                     </div>
                     <div class="col-sm-4">
                        <h4>
                           Rs. {!! number_format($arr_data['grand_total'],2) !!}
                        </h4>
                     </div>
                     <div class="clearfix"></div>
                  </div>
									</div>
									
									
									
									
									
                
            </div>
            
            
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->
@stop

