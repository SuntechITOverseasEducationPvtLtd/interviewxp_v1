@extends('front.layout.main')
@section('middle_content')
@inject('common', 'App\Common\Services\CommonService')  
@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
<div id="after-login-header" class="after-login"></div>
<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container">
   <div class="row">
      <div class="col-lg-12">
         <div class="middle-section min-height">
            <div class="user-dashbord">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="middle part">
                        <div class="row">
                           <div class="col-xs-8">
                              <h2 class="my-profile">{{$module_title}}</h2>
                           </div>
                           <div class="col-xs-4">
                              <div class="icon-w"> 
                                 <a href="{{url('/member/purchase_history')}}" class="green-back m-r-0">Back</i></a>
                              </div>
                           </div>
                        </div>
                        <div class="outer-box r-details">
                           <div class="row">
                              
                              <div class="col-md-12">
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
                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label">Transaction Id :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">IE0000{{ isset($arr_data['id'])?$arr_data['id']:'NA' }}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Order Id :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">{{ isset($arr_data['order_id'])?$arr_data['order_id']:'NA' }}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>

                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Name :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">{{ isset($arr_data['user_detail']['first_name'])?$arr_data['user_detail']['first_name']:'NA'}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>

                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Email :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">{{ isset($arr_data['user_detail']['email'])?$arr_data['user_detail']['email']:'NA'}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Mobile No :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">{{ isset($arr_data['user_detail']['mobile_no'])?$arr_data['user_detail']['mobile_no']:'NA'}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 
                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Gender :</label>
                                    </div>
                                    <div class="col-sm-3">
                                    @if(isset($arr_data['user_detail']['gender']) && $arr_data['user_detail']['gender']=='F' )
                                    Female
                                    @else
                                    Male
                                    @endif   
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>

                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Total Amount(Rs.) :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">{{ isset($arr_data['grand_total'])?$arr_data['grand_total']:'NA' }}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 
                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Experience :</label>
                                    </div>
                                    <div class="col-sm-3">
                                       <p class="value">
                                          {{ isset($arr_data['experience_level'])?$arr_data['experience_level']:'NA' }}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>

                                 <div class="form-group">
                                    <div class="col-sm-3 ">
                                       <label class="main-label" >Purchase Detail :</label>
                                    </div>
                                    <div class="col-sm-9">
                                       
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-sm-12">
                                       <h4>
                                          @if(isset($arr_data['experience_level']) == 'NA')
                                          {{ $arr_data['skill_name'] }} interview questions & answers
                                          @else
                                          {{ $arr_data['skill_name'] }} real time interview questions & answers ($arr_data['experience_level'] Years)
                                          @endif
                                       </h4>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
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
                                      $is_refunded = ($transactionItem->payment_status == 'refunded') ? '&nbsp;&nbsp;&nbsp;&nbsp;(Refunded)' : '';
                                 ?>
                                 <div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                       <p>
                                          {!! $description !!}
                                       </p>
                                    </div>
                                    <div class="col-sm-6">
                                       <p>
                                          Rs. {!! number_format($basePrice,2) !!}{!! $is_refunded !!}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 <?php 
                                 }
                                   
                                 ?>
                                 <br \><br \>
                                 <div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3">
                                       <p>
                                          Sub Total
                                       </p>
                                    </div>
                                    <div class="col-sm-6">
                                       <p>
                                          Rs. {!! number_format($arr_data['base_price'],2) !!}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 @if($arr_data['cgst_percent'])
                                 <div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3">
                                       <p>
                                          CGST ({{$arr_data['cgst_percent']}}%)
                                       </p>
                                    </div>
                                    <div class="col-sm-6">
                                       <p>
                                          Rs. {!! number_format($arr_data['cgst_amount'],2) !!}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 @endif
                                 @if($arr_data['sgst_percent'])
                                 <div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3">
                                       <p>
                                          SGST ({{$arr_data['sgst_percent']}}%)
                                       </p>
                                    </div>
                                    <div class="col-sm-6">
                                       <p>
                                          Rs. {!! number_format($arr_data['sgst_amount'],2) !!}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 @endif
                                 @if($arr_data['igst_percent'])
                                 <div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3">
                                       <p>
                                          IGST ({{$arr_data['igst_percent']}}%)
                                       </p>
                                    </div>
                                    <div class="col-sm-6">
                                       <p>
                                          Rs. {!! number_format($arr_data['igst_amount'],2) !!}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                 @endif
                                 <div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3">
                                       <p>
                                          Total
                                       </p>
                                    </div>
                                    <div class="col-sm-6">
                                       <p>
                                          Rs. {!! number_format($arr_data['grand_total'],2) !!}
                                       </p>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                           </div>

                           </div>
                        </div>
                        <!-- <div class="sample-img2"><img src="images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/></div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<script type="text/javascript">
   $('.main-content > .arrow').click(function(){
     $(this).parent().next('.sub-content').slideToggle();
     $(this).find('.arrow i').toggleClass('fa-chevron-down fa-chevron-up')
   });
</script>  
<script>
$("tr:even").css("background-color", "#eeeeee"); 
$("tr:odd").css("background-color", "#fff");     
</script>         
<!--footer section-->
@endsection

