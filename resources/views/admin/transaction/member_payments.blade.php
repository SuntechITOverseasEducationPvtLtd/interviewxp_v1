@extends('admin.layout.master')
    @section('main_content')
    @inject('common', 'App\Common\Services\CommonService')
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
    <?php
       $reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];
    ?>
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
    .flipslide {cursor: pointer; }
                        </style>
                       <script> 
$(document).ready(function(){ 
    $(".flipslide").click(function(){
        $thid=$(this).attr('id');
        
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
                  
                  <a href="{{ $module_url_path }}/total-payments" class="pull-right label bg-success-400" style="font-size: 14px;color:#fff; margin-top: 8px;">{{ date('j M, Y, g:i A T', strtotime($fromdate))}} - {{ date('j M, Y, g:i A T', strtotime($todate))}}</a>
                  
                  
              
                      </div>
            </div>

  
    
 
        <div class="box-content">
        
          @include('admin.layout._operation_status')  

          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

            <table class="table table-advance"    >
              <thead>
              <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">

                     <th>Name</th>
                     <th>Gender</th>
                     <th>Mob No</th>
                     <th>Email</th>
                     <th>No.of Skills</th>
                     <th>Amount</th>
                     <th>IGST</th>
                     <th>CGST</th>
                     <th>SGST</th>
                     <th>Amount+Tax</th>
                     <th>Member Earnings</th>
                     <th>Admin Commission</th>
                     <th>Member Earnings</th>
                     <th>Income After Tax</th>
                     <th>Payment Action</th>
                     
                </tr>
              </thead>
              <tbody>

                  <tr style="    background: #4caf50;
    color: #fff !important;">

                     <td><div style="width:150px">{{ $tot_data_transaction['member_detail']['first_name'].' '.$tot_data_transaction['member_detail']['last_name']}}
                     
                     </div></td>
                     <td> 
                          @if($tot_data_transaction['member_detail']['gender']=='F')
                          Female
                          @elseif($tot_data_transaction['member_detail']['gender']=='M')
                          Male 
                          @endif 
                     </td>
                    <td> {{ $tot_data_transaction['member_detail']['mobile_no'] or 'NA' }}</td>
                     <td>{{ $tot_data_transaction['member_detail']['email'] or 'NA' }}</td>
                     <td>{{ $tot_data_transaction['all_interview_detail'][0]['no_of_skills'] or 'NA' }}</td>
                     <td>{{ number_format($tot_data_transaction['base_price'],2)  }}</td>
                     <td>{{ number_format($tot_data_transaction['igst_amount'],2) }}</td>
                     <td>{{ number_format($tot_data_transaction['cgst_amount'],2) }}</td>
                     <td>{{ number_format($tot_data_transaction['sgst_amount'],2) }}</td>
                     <td>{{ number_format($tot_data_transaction['grand_total'],2) }}</td>                     
                     <td>{{ number_format($tot_data_transaction['admin_amount'],2) }}</td>
					 <td>{{ number_format($tot_data_transaction['member_amount'],2) }}</td>
                     <td>{{ number_format($tot_data_transaction['after_tax_amount'],2) }}</td>
                     @if($tot_data_transaction['end_date']>$currentdate && $tot_data_transaction['member_payment_status']=='Dont Pay')
                     <td><button class="btn btn-warning" type="button">Pending</button></td>
                     @endif
                     @if($tot_data_transaction['end_date']<$currentdate && $tot_data_transaction['member_payment_status']=='Pay')
                     <td><a href="javascript:member_payment('{{base64_encode($tot_data_transaction['id'])}}','{{base64_encode($tot_data_transaction['member_user_id'])}}','{{base64_encode($fromdate)}}','{{base64_encode($todate)}}')"><button class="btn btn-primary" type="button" style="color:blue;">Pay</button></a></td>
                     @endif
                     @if($tot_data_transaction['member_payment_status']=='Paid')
                     <td><button class="btn btn-success" type="button" >Paid</button></td>
                     @endif
                      
                  </tr>


              </tbody>
            </table>
          </div>
    
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

           <table class="datatable table table-striped table-bordered">
              <thead>
             <tr class="bg-teal-400" style="    background-color: #828282 !important;
    border-color: #828282 !important;
    color: #e5e7e8;">
                     <th>S.No</th>
                     <th>Name</th>
                     <th>Sold Date</th>
                     <th>Skill/Description</th>
                     
                        <th style="font-size: 11px; width:1500px !important;"> 
                    <div style="width:100%; float:left" class="  ppd">
                     <div style="width:110px; float:left">Experience Level <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:100px; float:left"> Amount <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:100px; float:left"> IGST <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:100px; float:left"> CGST <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:100px; float:left"> SGST <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:100px; float:left"> Amount+Tax <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:115px; float:left"> Admin Commission <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                    <div style="width:115px; float:left"> Member Earnings <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                     <div style="width:100px; float:left">TDS <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                     <div style="width:120px; float:left">Earnings After Tax <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                     <div style="width:100px; float:left">Ratings <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                     <div style="width:100px; float:left">Reviews <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                     <div style="width:100px; float:left">Payment Action  <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                   
                    <div style="width:85px; float:left">View <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>
                       </div>
                </tr>
              </thead>
              <tbody>
          @if(isset($arr_transaction) && sizeof($arr_transaction)>0)
                  @foreach($arr_transaction  as $key => $data)
                  <?php
                    $bgColor = ($key%2 ==1) ? 'background-color: #fbf5f5;' : 'background-color: #f6f6f6;';
                  ?>
                  <tr style="{{$bgColor}}">                    
                     <td >{{$key+1}}</td>
                     <td >{{ $data['user_detail']['first_name'].' '.$data['user_detail']['last_name']}}</td>
                     <td style="float: left;width: 100px;"> {{ date('j M, Y, g:i A T', strtotime($data['created_at']))}}</td>
                       <td > {{ $data['interview_detail']['allskill'] or 'NA' }}</td>
                     
                     
                     <td >
                         
                         <div style="width:1500px; float:left">
                         
                         <div style="width:100%; float:left; height:30px;">
                        <div style="width:110px; float:left;     padding-left: 10px;">  {{ $data['interview_detail']['experience_level'] or 'NA' }} </div>
                         
                         
                     <div class="flipslide" id="{{$data->id}}" style="width:100px; float:left">
                         
                         <span class="label bg-success heading-text"> {{ number_format($data['base_price'],2) }} <i class="icon-sort-amount-asc"></i></span> </div>
                         
                    <div class="flipslide" id="{{$data->id}}" style="width:100px; float:left">{{ number_format($data['igst_amount'],2) }}</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:103px; float:left">{{ number_format($data['cgst_amount'],2) }}</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:100px; float:left">{{ number_format($data['sgst_amount'],2) }}</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:110px; float:left">{{ number_format($data['grand_total'],2) }}</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:110px; float:left">{{ number_format($data['admin_amount'],2) }}&nbsp;&nbsp;({{ $data['admin_commission'] }}%)</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:110px; float:left">{{ number_format($data['member_amount'],2) }}</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:120px; float:left">{{ number_format($data['member_tax_amount'],2) }}&nbsp;&nbsp;({{ $data['tds_percent'] }}%)</div>
                     <div class="flipslide" id="{{$data->id}}" style="width:100px; float:left">{{ number_format($data['after_tax_amount'],2) }}</div>
                          <div style="width:100px; float:left">&nbsp;&nbsp;</div>
                     <div style="width:100px; float:left">&nbsp;&nbsp;</div>
                    <div style="width:100px; float:left">
                     @if($data['end_date']>$currentdate && $data['member_payment_status']=='Dont Pay' || $data['end_date']<$currentdate && $data['member_payment_status']=='Pay')
                     <button class="btn btn-warning" type="button" >Pending</button>
                     @endif
                     @if($data['member_payment_status']=='Paid')
                     <button class="btn btn-succes" > Paid</button>
                    
                     @endif
                      </div>
                      
                      <div style="width:85px; float:left">  <span data-popup="tooltip" class="flipslide" id="{{$data->id}}"  title="" data-original-title="Check Payment Details"> 
                      <a  class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style="padding: 1px 3px;"  ><i class="icon-plus3"></i></a>
                      
                      </span></div>
                      
                      
                      </div>
                      
                      
                      
                      
                      
                       <?php
                    $transactionHistory = $common->getTransactionHistory($data['order_id']);
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
                      $refundcolour='';
                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";
                      if($data['member_payment_status'] != 'Paid' && $transactionItem->payment_status == 'refunded')
                      {
                        $bgcolrs="#E91E63  !important";
                        $refundcolour = "color: #fff;";
                      }
                      else if($key1%2 ==0) 
                      { 
                        $bgcolrs="#d8d8d8ad  !important";
                      }else {$bgcolrs="#fff !important"; }
                  ?>
                   <div style="width:100%; float:left; display:none;   padding: 4px 0px 3px;    line-height: 31px; background-color: {{$bgcolrs}}; {{$refundcolour}}" class="flipslidedownal{{$data->id}}">
                  
                      
                   <div    style="   width:213px; float:left"><i class=" icon-plus-circle2" style="float:left; margin-top: 9px;"></i> {!! $description !!}</div>
                                         <div style="width:100px; float:left"> {{ number_format($basePrice,2) }}</div>
                      <div style="width:100px; float:left"> {{ number_format($igst,2) }}</div>
                      <div style="width:100px; float:left"> {{ number_format($cgst,2) }}</div>
                      <div style="width:100px; float:left"> {{ number_format($sgst,2) }}</div>
                      <div   style="width:100px; float:left"> {{ number_format($totalAmount,2) }}</div>
                    
                     <div style="width:100px; float:left">&nbsp;&nbsp;</div>  <div style="width:100px; float:left">&nbsp;&nbsp;</div>  <div style="width:145px; float:left">&nbsp;&nbsp;</div>
                        <div style="width:100px; float:left"><?php if(isset($transactionItem->review_star)) { for($i=1; $i<=5; $i++) 
                        { if($i <= $transactionItem->review_star) { echo '<img src="'.$stars.'" title="'.$reviewStatusArray[$transactionItem->review_star].'"/>'; } 
                        else { echo '<img src="'.$emptyStars.'" title="'.$reviewStatusArray[$transactionItem->review_star].'"/>'; } }  } else { for($i=1; $i<=5; $i++) { echo ''; } } ?></div>
                        
                        
                      
                      <div style="width:100px; float:left">
                        @if(isset($transactionItem->review_message)) 
                        
                        <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="{{ $transactionItem->review_message}}" style="  margin-top: 4px;  width: 25px;
    height: 25px;
    font-size: 12px;
    line-height: 0px;
    text-align: center;
    padding: 6px 0px;"><i class="icon-comments" style="font-size: 12px;"></i></a>
                        
                        
                        @endif 
                      </div>
                      
                      <div style="width:100px; float:left">
                        @if($data['member_payment_status'] != 'Paid' && $transactionItem->payment_status == 'refunded')
                        Refunded
                        @elseif($data['member_payment_status']!='Paid')
                         <a href="javascript:refund_payment('{{base64_encode($transactionItem->id)}}','{{base64_encode($data['id'])}}','{{base64_encode($transactionItem->combo_status)}}');"><button class="btn bg-pink" type="button" >Refund</button></a>
                        @endif
                      </div>
                      
                      
                      
                    </div>
                    
                    
                    
                    
                  <?php 
                  }
                    
                  ?>
                      
                      
                      </div>
                      </td>
                  </tr>
                 
                  @endforeach
                  @endif
              </tbody>
            </table>
          </div>
        <div> </div>
        {!! $arr_transaction->render() !!}
      </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="member_payments_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                     Refund Payment
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                
               {{ Form::open(array('url'=>'','method'=>'post', 'id'=>'form_member_payment')) }}
                  <div class="form-group">
                    {{ csrf_field() }}
                    {!! Form::text('RefId', null,['required','class'=>'form-control','id'=>'refId','placeholder'=>'Enter Refference ID']) !!}                    
                  </div>
                    <div class="form-group">
                    {!! Form::hidden('inputId', null,['class'=>'form-control','id'=>'inputId']) !!}
                    {!! Form::hidden('combo_status', null,['class'=>'form-control','id'=>'combo_status']) !!}
                    {!! Form::hidden('transId', null,['class'=>'form-control','id'=>'transId']) !!}
                    {!! Form::hidden('fd', null,['class'=>'form-control','id'=>'fd']) !!}
                    {!! Form::hidden('td', null,['class'=>'form-control','id'=>'td']) !!}
                    {!! Form::textarea('inputComment', null, array('required','class'=>'form-control','placeholder'=>'Enter Comment', 'cols'=>2,'rows'=>2)) !!}
                    </div>
                  <div class="form-group">
                    {!! Form::file('payment_img', null,['class'=>'form-control','id'=>'inputInterviewId']) !!}                    
                  </div>
                  <div class="form-group">
                    {!! Form::submit('submit', array('class'=>'btn btn-primary', 'id'=>'btn_admin_comment')) !!}
                  </div>
                {{ Form::close() }}            
            </div>
         
        </div>
    </div>
</div>
<style type="text/css">
  p {
    margin: 0 0 5px;
  }
</style>

<!-- END Main Content -->
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
           { "bSortable": false },
           { "bSortable": false },
           { "bSortable": false }
            ]

        });
    });
    function refund_payment(id,transId,combo_status) {

          $('#member_payments_modal').modal('show');
          $('#inputId').val(id);
          $('#transId').val(transId);
          $('#combo_status').val(combo_status);
          var url = "{{url('/')}}/admin/transactions/refund-payments";
          $('#form_member_payment').attr('action',url);
        return false;   
   }

   function member_payment(transId,id,fd,td) {

          $('#member_payments_modal').modal('show');
          $('#inputId').val(id);
          $('#transId').val(transId);
          $('#fd').val(fd);
          $('#td').val(td);
          var url = "{{url('/')}}/admin/transactions/pay-member-payment";
          $('#form_member_payment').attr('action',url);
        return false;   
   }

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