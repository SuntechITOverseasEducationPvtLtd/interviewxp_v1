    @extends('admin.layout.master')                


    @section('main_content')
    @inject('common', 'App\Common\Services\CommonService')
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
    @inject('transactionModel', 'App\Models\TransactionModel')
    @inject('userDetailModel', 'App\Models\UserDetailModel')
    <!-- BEGIN Page Title -->
 <style type="text/css">
 
     .table > tbody > tr > td {
    vertical-align: top;
        }
        
        .dataTable tbody > tr  > td {
    border-top: 0;
    padding-top: 10px !important;
}
 
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
    h4.value {line-height: 14px;
    font-size: 13px;
    color: #13c0b2;
    font-weight: bold;}
    
    label {
    margin-bottom: 7px;
    font-weight: 400;
    line-height: 30px;
}
         .table > thead > tr > th {      padding: 12px 9px !important; } 
         
         
          .table > tbody > tr > th   {      padding: 12px 9px !important; font-size:12px !important; } 
         .pagination { float:right;}
         
         </style>



<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
               <div class="btn-group"> 
             
            </div>
                      </div>
            </div>
      <div class="box-content">
          {{ csrf_field() }}
          @include('admin.layout._operation_status')  
          
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">
            <?php $colspan = (isset($member_id)) ? 2 : 1; 
            
            if(isset($member_id)) { $tablestriner="datatable";  $rowbgs="background: #e4e2e2 !important"; } else { $tablestr="datatable";   } ?>
            
            
            
            <table class="{{ @$tablestr }} table table-striped table-bordered">
              <thead>
                    <tr class="bg-teal-400" style="        background-color: #9ad4a1 !important;
    border-color: #f5f5f5 !important;" role="row">
                  <th colspan="{{$colspan}}">S.No</th>
                  <th colspan="{{$colspan}}">Name</th>
                  <th colspan="{{$colspan}}">Email</th>
                  <th colspan="{{$colspan}}">PH.No</th>
                  <th colspan="{{$colspan}}">Gender</th>
                  <th colspan="{{$colspan}}">No.of Skills</th>
                  <th colspan="{{$colspan}}">No.of Transactions</th>
                  <th colspan="{{$colspan}}">Total Income Earned</th>
                  @if(!isset($member_id))
                  <th style="min-width:140px !important;">Action</th>
                  @endif
                  <th></th>
                </tr>
              </thead>
            
                
                @if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
                  @foreach($arr_review_rating as $key => $data)
                 
                  <tr style="height: 62px;        font-weight: bold;">
                    <td colspan="{{$colspan}}">{{$key+1}}</td>
                    <td colspan="{{$colspan}}"> {{ $data['member_detail']['first_name'] }} {{ $data['member_detail']['last_name'] }} </td> 
                    <td colspan="{{$colspan}}">{{$data['member_detail']['email'] or 'NA'}}</td>
                    <td colspan="{{$colspan}}">{{$data['member_detail']['mobile_no'] or 'NA'}}</td>
                    
                    <td colspan="{{$colspan}}">@if($data['member_detail']['gender']=="M")Male @else Female @endif</td>  
                    <td colspan="{{$colspan}}">{{$data['all_interview_detail'][0]['no_of_skills'] or ''}}</td>
                    <td colspan="{{$colspan}}">{{$data['no_of_transactions'] or ''}}</td>
                    <td colspan="{{$colspan}}">{{$data['total_income_earned'] or ''}}</td>
                    @if(!isset($member_id))
                    <td>
                        
                          <div class="forleft">
                          <a href="{{ $module_url_path.'/member-sales/'.base64_encode($data['member_user_id'])}}" class="myc admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="Review Message"></i>
                        </a>
                        <p class="myp">View</p>
                        
                 </div>
                    </td>  
                    <td></td>
                    @endif                  
                  </tr>
                
            
                  @if(isset($member_id))
                  
              <table class="{{ @$tablestriner }} table table-striped table-bordered">
                           <thead>
               <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                    <th ><div style="width:60px; float:left;">S.No</div></th>
                    <th>Date</th>
                    <th><div style="width:120px; float:left;">Name</div></th>
                    <th><div style="width:100px; float:left;">A/c Type</div></th>
                    <th><div style="width:70px; float:left;">Gender</div></th>
                    <th>Email</th>
                    <th>PH.No</th>
                    <th ><div style="width:160px; float:left;">Skill</div></th> 
                    
                    
                   
                        
                                         <th style="font-size: 11px; width:1200px !important;"> <div style="width:100%; float:left" class="  ppd">
                        
                        <div style="width:200px; float:left">Exp Level <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left" >Amount Status <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left">IGST <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left">CGST <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left">SGST <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div>                     
                    <div style="width:100px; float:left">Total <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left">Ratings <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left">Reviews <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left">Amount <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    
                    </div>
                    
                    </th>                                       
                  </tr>
                      </thead>
                  <?php
                    $memberReviewsRatings = $common->getAdminMemberCoaches($member_id, $data['skill_id']);
                    if(count($memberReviewsRatings) > 0)
                    {
                    foreach($memberReviewsRatings as $key => $reviews)
                    {
                      //print_r($reviews['coach_reviews_ratings']['review_star']);
                      $bgColor = ($key%2 ==1) ? 'border-top: 15px solid #fff;' : 'border-top: 15px solid #fff;';

                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";
                      $refundcolors=" "; $minunsyms="";
                   if(count($reviews['transaction_history']) > 0) {  
                         if(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'refunded')  {
                         
                         $refundcolors="color:#cf2c2c"; $minunsyms="-";
                         
                         } }?>
                    
                    
                  <tr style="background: #fafafa !important;border-bottom: 1px solid #f1f1f1;">
                    <td style="width:80px">{{$key+1}}</td>
                    <td style="{{$bgColor}}"><div style="width:80px;">{{ date(' d  M, Y' ,strtotime($reviews['created_at'])) }}</div></td>
                    <td style="{{$bgColor}}">{{ $reviews['user_detail']['first_name'] }} {{ $reviews['user_detail']['last_name'] }}</td>
                    <?php
                      $userData=$userDetailModel->where('user_id',$reviews->user_id)->first();
                      $role = (count($userData) > 0) ? 'User' : 'Member';
                    ?>
                    <td style="{{$bgColor}}">{{ $role or '' }}</td>
                    <td style="{{$bgColor}}">@if($reviews['user_detail']['gender']=="M")Male @else Female @endif</td>
                    <td style="{{$bgColor}}">{{$reviews['user_detail']['email'] or 'NA'}}</td>
                    <td style="{{$bgColor}}">{{$reviews['user_detail']['mobile_no'] or 'NA'}}</td>
                    <td style="{{$bgColor}}">{{ $reviews['interview_detail']['allskill'] }}</td> 
                    
                    
                    <td  >
                        
                        <div style="width:1200px; float:left">
                            
                            <div style="width:100%; float:left">
                           <div style="width:206px; float:left; ">   {{$reviews['interview_detail']['experience_level'] or 'NA'}}  </div>
                   
                <div style="width:100px; float:left; {{$refundcolors}}">  {{$minunsyms}}{{$reviews['base_price'] or ''}} </div>
                 
                  <div style="width:100px; float:left; ">    {{$reviews['igst_amount'] or ''}} </div>
              
               <div style="width:100px; float:left; ">         {{$reviews['cgst_amount'] or ''}} </div>
               
                 <div style="width:100px; float:left; ">   {{$reviews['sgst_amount'] or 'NA'}} </div>
                
                 <div style="width:100px; float:left; ">     {{$reviews['grand_total'] or 'NA'}} </div>
                 
                 <div style="width:100px; float:left; ">&nbsp;&nbsp;</div><div style="width:100px; float:left; ">&nbsp;&nbsp;</div>
                  <div style="width:100px; float:left; "> 
                      <?php if(count($reviews['transaction_history']) > 0) {  ?>
                          @if(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'unpaid')  
                          Pending
                          @elseif(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'paid')
                          Completed
                          @elseif(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'refunded')
                          Refunded
                          @endif
                    <?php } ?>
                    </div>
                    </div>
                    
                    
                    
                    
                    
                     <?php
                    $transactionHistory = $common->getTransactionHistory($reviews['order_id']);
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
                              $item_name = '';
                              $interview_id = $transactionItem->interview_id;
                              $companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();
                              if($companyDetails)
                              {
                                $item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
                              }
                              
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

                      $bgColor = 'background-color: #f6f6f6;';

                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";

                       $reviewRating = '';
                      if(isset($transactionItem->review_star) && $transactionItem->review_star > 0)
                      $reviewRating = $common->getReviewRatings($transactionItem->review_star);
if($key1%2 ==0) { $bgcolrs="#d8d8d8ad  !important";} else {$bgcolrs="#fff !important"; }

$refundcolor=""; $minunsym="";
 if($data['member_payment_status'] != 'Paid' && $transactionItem->payment_status == 'refunded') {  $refundcolor="color:#cf2c2c"; $minunsym="-"; }
                       
                       
                       
                       
                  ?>
                    
                            <div style="width:100%; float:left; background-color: {{$bgcolrs}};">
                    
                      <div style=" width:206px; float:left;">{!! $description !!}</div>
                      <div style="  width:100px; float:left; {{$refundcolor}}"> {{$minunsym}}{{ number_format($basePrice,2) }}</div>
                     <div style=" width:100px; float:left;"> {{ number_format($igst,2) }}</div>
                      <div style=" width:100px; float:left;"> {{ number_format($cgst,2) }}</div>
                      <div style=" width:100px; float:left;"> {{ number_format($sgst,2) }}</div>
                      <div style=" width:100px; float:left;"> {{ number_format($totalAmount,2) }}</div>
                      
                       <div style="width:100px; float:left;"> <?php if(isset($transactionItem->review_star)) { for($i=1; $i<=5; $i++) { if($i <= $transactionItem->review_star) { echo '<img src="'.$stars.'" title="'.$reviewRating.'"/>'; } else { echo '<img src="'.$emptyStars.'" title="'.$reviewRating.'"/>'; } }  } else { for($i=1; $i<=5; $i++) { echo ''; } } ?>
                     </div>  
                     <div style=" width:100px; float:left;">
                        @if(isset($transactionItem->review_message))
                        
                        <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" 
                        title="" data-original-title="{{ $transactionItem->review_message}}" style="    width: 25px;
    height: 25px;
    font-size: 12px;
    line-height: 0px;
    text-align: center;
    padding: 6px 0px;"><i class="icon-comments" style="font-size: 12px;"></i></a>
                        
                        @endif
                      </div>

                      <div style=" width:100px; float:left;">
                        @if($data['member_payment_status'] != 'Paid' && $transactionItem->payment_status == 'refunded')
                        Refunded
                       @endif
                      </div>
                    </div>
                  <?php 
                  }
                    
                  ?>
                  
                  
                    
                    
                    
                    
                    
                    </div>
                    </td>
                  </tr>
                 
                  
                  <?php } } ?>

                  @endif
                  @endforeach
                @endif
                 
              </tbody>
            </table>
            
            
               </tbody>
            </table>
            
          </div>
        <div> </div>
            @if(isset($member_id))
            <br>
            {!! $memberReviewsRatings->render() !!}
            @endif
      </div>
  </div>
</div>
<?php $member_id = (empty($member_id)) ? '' : $member_id; ?>
<!-- END Main Content -->
<script>
function approve_change(val,id) {

      if(confirm('Are you sure to perform this action?'))
      {         
            var token         = $('input[name=_token]').val();
            var approve_id    = id;
            var approve_value = val;
            var success_link  = "{{url('/')}}/admin/review_rating/member-reviews-ratings/{{base64_encode($member_id)}}";
            //alert(approve_value);
            $.ajax({
            url: "{{url('/')}}/admin/review_rating/approve_change",
            type: "POST",
            async: false,
            data: { _token:token,approve_status:approve_value,id:approve_id},
            dataType: "json"
          }).done(function(result){
             
              if(result.status=="SUCCESS")
              {
                 location.href = success_link;
              }
              if(result.status=="ERROR")
              {
                location.href = success_link;
              }
          });
       }
     return false;   
}
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table_module').DataTable( {
            "aoColumns": [
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },  
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });

    function show_details(url)
    { 
       
        window.location.href = url;
    } 

    function confirm_delete()
    { 
       if(confirm('Are you sure to delete this record?'))
       {
         return true;
       }
       return false;
    }
    
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
</script>
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
  .table > thead > tr > th {
    padding: 12px 9px !important;
    font-size: 12px;
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
@stop                    


