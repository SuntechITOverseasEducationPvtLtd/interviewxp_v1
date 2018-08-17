@extends('front.layout.main')
@section('middle_content')
    @inject('common', 'App\Common\Services\CommonService')  
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
      <div id="after-login-header" class="after-login"></div>
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>

      <div class="container max-height">
         <div class="row">
            <div class="col-lg-12">
               <div class="middle-section min-height">
                  <div class="user-dashbord">
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="middle part">

                         @include('admin.layout._operation_status')  
                         <!--<form id="frm_manage" action="{{url('/user/multi_action_purchase')}}" id="frm_alerts_manage" method="POST" enctype="multipart/form-data" data-parsley-validate> -->
              
                              <div class="row">
                                 <div class="col-xs-8">
                                    <h2 class="my-profile">Purchase History</h2>
                                 </div>
                                 <div class="col-xs-4">
                                    <div class="icon-w"> 
                                        <!-- <a href="javascript:void(0);" class="delete-i-top" title="Multiple Delete"
                              onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a> -->
                              <a href="{{url('/member/purchase_history')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                    </div>
                                 </div>
                              </div>
                              <div class="outer-box">
                                 <div class="table-search-pati section1-tab">
                                    <div class="table-responsive">
                                       <table class="table">
                                          
                                          <thead>
                                             <tr class="top-strip-table">
                                                <td>
                                                   <div class="check-box-UserAlert">
                                                      <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                                                      <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                                                   </div>
                                                </td>
                                                <td>S.No.</td>
                                                <td style="text-align: left;">Description</td>
                                                <td>Exp.Level</td>
                                                <td>Purchased date</td>
                                                <!-- <td>Validity Date</td> -->
                                                <td>Amount</td>
                                                <td>Actions</td>
                                             </tr>
                                          </thead>
                                         <tbody class="strips">
                                         @if(isset($purchase_history) && sizeof($purchase_history)>0)
                                         <?php $i = 1;
                          //dd($arr_transaction['data']);
                   ?>
                  
                                         @foreach($purchase_history as $key=>$data)
                                         
                                             <tr class="main-content">
                                                <td>
                                                   <div class="check-box-UserAlert">
                                                      <input id="radio1_{{ base64_encode($data['id']) }}" class="css-checkbox" type="checkbox" 
                                                   name="checked_record[]"  
                                                   value="{{ base64_encode($data['id']) }}" /> 
                                                   <label class="css-label radGroup2" for="radio1_{{ base64_encode($data['id']) }}">&nbsp;</label>  
                                                   </div>
                                                </td>
                                                <td>{{$key+1}}</td>
                                                <td style="text-align: left;">{{$data['skill_name'] or 'NA'}}</td>
                                                <td>{{$data['experience_level'] != 'NA' ? $data['experience_level'].' Years' : 'NA'}}</td>
                                                <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                                                
                                                <td>Rs.{{ $data['grand_total'] or 'NA' }}</td>
                                                <td>
                                                   <div class="text-left">
                                                      <a href="{{url('/')}}/member/view_purchase/{{ base64_encode($data['id']) }}" class="eye-p"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                       
                                                   </div>
                                                </td>
                                                <td class="arrow" rel="sub-content-{{$key}}"><i class="fa fa-chevron-down" aria-hidden="true"></i></td>
                                             </tr>
                                             <?php
                                              $transactionHistory = $common->getTransactionHistoryByLineItem($data['order_id']);
                                              if(count($transactionHistory) > 0)
                                              {
                                              foreach ($transactionHistory as $item => $transactionItem) {
                                              
                                                $description = '';
                                                $class = $transactionItem->id;
                                          if($transactionItem->item_type == 'Interview_qa')
                                          {
                                               $description = '<p>&nbsp;&nbsp;*&nbsp;Interview QA</p>';
                                               $class = 'interview_qa'.$transactionItem->id;
                                               $reviewType = 'Interview QA';
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
                                            
                                            $description .= '<p>&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
                                            $class = 'interview_company'.$transactionItem->id;
                                            $reviewType = 'Company';
                                        }
                                        else if($transactionItem->item_type == 'Work_exp')
                                        {
                                             $description = '<p>&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$transactionItem->item_id.'</p>';
                                             $class = 'realtime_issues'.$transactionItem->id;
                                             $reviewType = 'Real Issues';
                                        }
                                        else if($transactionItem->item_type == 'Coach')
                                        {
                                           $description = '<p>&nbsp;&nbsp;*&nbsp;Interview Coaching</p>'; 
                                           $class = 'interview_coach'.$transactionItem->id;
                                           $reviewType = 'Interview Coaching';
                                        }

                                        $basePrice = $transactionItem->item_price;
                                        $igst = $transactionItem->igst;
                                        $cgst = $transactionItem->cgst;
                                        $sgst = $transactionItem->sgst;
                                        $totalAmount = $basePrice + $igst + $cgst + $sgst;

                                      

                                          $emptyStars = url('/')."/images/blank_star.png";           
                                          $stars = url('/')."/images/star.png";

                                                    if(isset($transactionItem->review_star)){
                                            $css="pointer-events:none";
                                            $tit=$transactionItem->review_message;
                                          }
                                          else{
                                            $css="pointer-events:all";
                                            $tit="";
                                          }
                                                  
                                             ?>
                                              <tr class="sub-content sub-content-{{$key}}" style="display:none;">
                                                <td colspan="2"></td>   
                            <td style="text-align: left;">@if($transactionItem->combo_status == 1 && $item == 0 && ($transactionItem->combo_type == '5 Companies' || $transactionItem->combo_type == '10 Companies' || $transactionItem->combo_type == '20 Companies'))<span style="color: #FF8000;padding-left: 7px;width: 32%;">{{$transactionItem->combo_type}}</span>@elseif($transactionItem->combo_status == 1 && $item == 0)<span style="color: #FF8000;padding-left: 7px;width: 32%;">Combo</span>@endif <br>{!!$description!!}</td>
                            <td>@if(isset($transactionItem->review_star))<i class="fa fa-eye" style="cursor:pointer" title="{{$tit}}" aria-hidden="true"></i>@endif</td>
                                                <td>
                            <div class="star-wrapper">
                              <div class="starrr">
                                @if(isset($transactionItem->review_star))
                                    <span class="star-rating-control">
                                    <div class="reviewed_rating-cancel rating-cancel"><a title="Cancel Rating"></a></div>
                                  <?php 
                                  $emptyStars = url('/')."/images/blank_star.png";           
                                                            $stars = url('/')."/images/star.png";

                                                            $reviewStatus = $common->getReviewRatings($transactionItem->review_star); 
                                  for($i=1; $i<=5; $i++) 
                                  { 
                                    if($i <= $transactionItem->review_star) { echo '<div role="text" class="reviewed_star"><img title="'.$reviewStatus.'" src="'.$stars.'"/></div>'; } else { echo '<div role="text" class="reviewed_star"><img  title="'.$reviewStatus.'" src="'.$emptyStars.'"/></div>'; } 
                                  }  
                                  ?>
                                  </span>
                                @else
                                <input class="star" type="radio"  name="review_star_{{$transactionItem->id}}" value="1" title="{{$common->getReviewRatings(1)}}" dataId="{{$class}}_review_star" />
                                <input class="star" type="radio" name="review_star_{{$transactionItem->id}}" value="2" title="{{$common->getReviewRatings(2)}}" dataId="{{$class}}_review_star" />
                                <input class="star" type="radio" name="review_star_{{$transactionItem->id}}" value="3" title="{{$common->getReviewRatings(3)}}" dataId="{{$class}}_review_star" />
                                <input class="star" type="radio" name="review_star_{{$transactionItem->id}}" value="4" title="{{$common->getReviewRatings(4)}}" dataId="{{$class}}_review_star" />
                                <input class="star" type="radio" name="review_star_{{$transactionItem->id}}" value="5" title="{{$common->getReviewRatings(5)}}" dataId="{{$class}}_review_star" />
                                @endif
                              </div>
                              <div class="clearfix"></div>
                              <div class="error">{{ $errors->first('review_star') }}</div>
                            </div>
                          </td>
                          <td>@if(empty($transactionItem->review_star))<span class="writeReview" dataValue="Interview Coaching" dataClass="{{$class}}_review_form_{{$key}}" dataTitle="Interview Coaching" id="" style="border:1px solid #17b0a4;padding:6px;display:block; cursor:pointer; {{$css}}">Write a review</span>@endif</td>
                                                <td colspan="2"></td>
                                              </tr>
                                              <tr class="{{$class}}_review_form_{{$key}}"  style="display:none;background-color: #f9f9f9;">
                                                <td>
                                                  <form method="POST" action="{{url('member/add_review')}}" id="frm_review_rating">
                            {{ csrf_field() }}
                          </td>
                                                <td colspan="4">  
                                                <div class="form-group">
                              <h4 id="reviewTitile"></h4>
                              <textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="3" name="review" placeholder="Add Review"></textarea>
                              </div>                            
                                                </td>
                                                <td>
                                                    <div class="m-top">
                              <input type="hidden" name="enc_user" value="{{base64_encode(isset($data['user_id'])?$data['user_id']:'')}}">
                              <input type="hidden" name="enc_interview" value="{{base64_encode(isset($data['ref_interview_id'])?$data['ref_interview_id']:'')}}">
                              <input type="hidden" name="enc_unique" value="{{isset($data['ticket_unique_id'])?$data['ticket_unique_id']:''}}">

                              <input  type="hidden" name="reviewType" id="reviewType" value="{{$reviewType}}" />
                              <input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="{{$transactionItem->item_id}}" />
                              <input  type="hidden" name="trans_history_id" id="trans_history_id" value="{{ base64_encode($transactionItem->id) }}" />
                              <input  type="hidden" name="review_star" id="{{$class}}_review_star" value="" />

                              <button type="submit" class="submit-btn" style="margin-top: -25px;">Submit</button>
                              </div>
                                                </td>
                                                <td colspan="2">
                                                  <button type="reset" class="btn btn-primary close-review" dataClass="{{$class}}_review_form_{{$key}}">Cancel</button>
                                                  </form>
                                              </td>
                                              </tr>

                                             <?php
                                              }
                                              }
                                             ?>
                    
                                         @endforeach
                                         @else
                                          <tr><td colspan="6"><div style="color:red;text-align:center;">No Records found...  </div></td></tr>
                                         @endif
                                         
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                  <div class="prod-pagination">
                                   {{$purchase_history->render()}}  
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
      </div>
      </div>
<script type="text/javascript">
   $("#frm_review_rating").validate({
         errorElement: 'div',
         errorClass: 'error',
         highlight: function (element) {
             $(element).removeClass('error');
         }
   });
</script>
    <script type="text/javascript">
         $('.main-content > .arrow').click(function(){
           var rel = $(this).attr('rel'); 
           $(this).parent().siblings('.'+rel).slideToggle();
           $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up')
         });
      </script>  

<script type="text/javascript">
  $( document ).ready(function() {
   $('#radio0').click(function() {
      if ($(this).is(':checked')) {
          $('div input').attr('checked', true);
      } else {
          $('div input').attr('checked', false);
      }
  });
  }); 

</script>   

<script type="text/javascript">
   function check_multi_action(checked_record,frm_id,action)
    {
      var checked_record = document.getElementsByName(checked_record);
      var len = checked_record.length;
      var flag=1;
      var input_multi_action = jQuery('input[name="multi_action"]');
      var frm_ref = jQuery("#"+frm_id);
  
      if(len<=0)
      {
        alert("No records to perform this action");
        return false;
      }
      
      if(confirm('Do you really want to perform this action'))
      {
      
        for(var i=0;i<len;i++)
        {
          if(checked_record[i].checked==true)
          {  
              flag=0;
              /* Set Action in hidden input*/
              jQuery('input[name="multi_action"]').val(action);

              /*Submit the referenced form */
              jQuery(frm_ref)[0].submit();  
            }
          }

        if(flag==1)
        {
          alert('Please select record(s)');
          return false;
        }  
          
      } 
  }
$(".close-review").on("click", function(){ 
  var dataClass = $(this).attr('dataClass');
  $("."+dataClass).hide();
});
$(".writeReview").on("click", function(){
  var dataClass = $(this).attr('dataClass');
  $("."+dataClass).show();
});
$(".star").on("change",function(){ // bind a function to the change event
  if( $(this).is(":checked") ){ // check if the radio is checked
    var val = $(this).val(); // retrieve the value
    var dataId = $(this).attr('dataId');
    $("#"+dataId).val(val);
  }
});
</script>       
<style type="text/css">
  .sub-content p{
      float: left;
  }
</style>               
      <!--footer section-->
@endsection

