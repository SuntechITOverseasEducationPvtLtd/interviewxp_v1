@extends('admin.layout.master')
    @section('main_content')
    @inject('common', 'App\Common\Services\CommonService')
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
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
                          }.pull-right { display:none !important;}
                           .proimgset {
                                height: 60px !important;
    width: 60px !important;
                          }
                           .table td {   padding: 2px 7px !important; }
                           p {
    margin: 0 0 3px; }
    .flipslide {cursor: pointer; }
     .pagination { float:right;}
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
                  
                  <a href="{{ $module_url_path }}/total-sales" class="pull-right label bg-success-400" style="font-size: 14px;color:#fff; margin-top: 8px;">Back</a>
                  
                  
              
                      </div>
            </div>

  
    
        <div class="box-content">
        
          @include('admin.layout._operation_status')  
          
       
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

             <table class="datatable table table-striped table-bordered">
              <thead>
            <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                     
                     <th>S.No</th>
                 <!--  <th>Transaction Id</th> -->
                     <th>Details</th>
                     <th>Name</th>
                     <th>A/c Type</th>
                     
                     <th>Gender</th>
                     <th>Mob No</th>
                     <th>Email</th>
                    <th style="font-size: 11px; width:1000px !important;"> 
                    <div style="width:100%; float:left" class="  ppd">
                        
                    
                    <div style="width:200px; float:left">Skill <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left"> Exp Level <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left"> Amount <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left"> IGST <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left"> CGST <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left"> SGST <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                    <div style="width:100px; float:left"> Total <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
                     <div style="width:100px; float:left">Action  </div> 
                    
                    </div>
                    </th>
                </tr>
              </thead>
              <tbody>
          @if(isset($arr_transaction) && count($arr_transaction)>0)
                  @foreach($arr_transaction  as $key => $data)
                  <?php
                    $bgColor = ($key%2 ==1) ? 'background-color: #f6f6f6;' : 'background-color: #fbf5f5;';
                  ?>
                  <tr style="{{ $bgColor }}">
                    
                     <td > 
                         {{$key+1}}
                     </td>
                    
                     <td > 
                     
                     
                     
                     
                     
                     
                     <div class="col-sm-12" style="padding: 0px;width: 320px !important;">
 <div class="rounded-box" style="float: left;">
                              <img src="{{url('/')}}/uploads/profile_images/{{ isset($data->profile_image) ? $data->profile_image : 'default.jpg' }}" alt="Photo" class="proimgset">  </div>

  <p class="td-p-line" style="font-size:14px; float: left;"><b>
   
{{ ucfirst($data->first_name)." ".ucfirst($data->last_name) }}</b><br>


<span data-popup="tooltip" title="" data-original-title="DOB" style="    font-size: 12px;
    color: #2196f3;"><i class=" icon-calendar2" style="    font-size: 12px;"></i> ({{date('d M Y',strtotime($data->birth_date))}})</span>
                              <br>
<span data-popup="tooltip" title="" data-original-title="Payment Date" style="    font-size: 12px;
    color: #2196f3;"><i class="icon-watch2" data-popup="tooltip" title="" data-original-title="Location" style="    font-size: 12px;"></i> {{date('j M, Y, g:i A T', strtotime($data->created_at))}}</span>
                            </p>


</div>
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     </td>
                     <td > 
                       
                       
                       <div class="col-sm-12" style="padding: 0px;width: 250px !important;">
                   
                            <p data-popup="tooltip"  title="" data-original-title="Education" class="td-p-line" style="    color: #26a69a; line-height: 2px;" aria-describedby="tooltip299331"> <i class="icon-graduation" style="    font-size: 12px;"></i> {{$data->qualification or 'NA'}}{{ isset($data->specialization) ? ' - '.$data->specialization : ''}}</p><div class="tooltip fade top" role="tooltip" id="tooltip299331" style="top: -42px; left: 84px; display: block;"></div>
                         
                          
                                 <?php

                              if($data->user_type == 'Member')
                              {
                              $countryDetails = DB::table('countries')->where('id',$data->education_country_id)->first();
                              $stateDetails = DB::table('state')->where('id',$data->education_state)->first();
                              $cityDetails = DB::table('city')->where('city_id',$data->education_city)->first();
                              }
                              elseif($data->user_type == 'User')
                              {
                              $countryDetails = DB::table('countries')->where('id',$data->country_id)->first();
                              $stateDetails = DB::table('state')->where('id',$data->state)->first();
                              $cityDetails = DB::table('city')->where('city_id',$data->current_work_location)->first();
                              }
                              $purchageDetails = DB::table('transaction')->where(['user_id'=>$data->user_id, 'payment_status'=>'paid'])->count();

                            ?>
                             <p class="td-p-line"  data-popup="tooltip" title="" data-original-title="Verified Date" style="font-size: 12px;     color: #43a047;"><i class="icon-user-check" style="    font-size: 12px; line-height: 2px;"> </i> 
                        
                        
                        
                         @if($data->user_type == 'Member')
                             {{ ($data->admin_activated_at != '0000-00-00 00:00:00') ? date("j M, Y, g:i A T",strtotime($data->admin_activated_at)) : '--------'}} 
                            @elseif($data->user_type == 'User') 
                             {{ ($data->activated_at != '0000-00-00 00:00:00') ? date("j M, Y, g:i A T",strtotime($data->activated_at)) : '--------'}}
                            @endif
                             
                             
                             
                             
                             
                             
                           
                        </p> 
                             <p  class="td-p-line" data-popup="tooltip" title="Registration   date " data-original-title="" style="font-size: 12px;line-height: 2px;"><i class=" icon-diff-added" style="    font-size: 12px;"></i> {{date("j M, Y, g:i A T",strtotime($data->created_at))}}
                          
                             </p>
                             
                                <p class="td-p-line" data-popup="tooltip" title="Location" data-original-title="" style="font-size: 12px; line-height: 2px;">
                             
                             <i class=" icon-location4" data-popup="tooltip" title="" data-original-title="Location" style="    font-size: 12px;"></i> {{isset($cityDetails->city_name) ? $cityDetails->city_name : ''}}{{isset($stateDetails->state_name) ? ', '.$stateDetails->state_name : ''}}{{isset($countryDetails->country_name) ? ', '.$countryDetails->country_name : ''}}
                             
                             
                             
                             </p>
                             
                             
                          </div>
                          
                          
                          
                          
                          
                          
                      
                    </td>
                     
                     <td > {{ $data->user_type }}</td>
                     <td > 
                          @if($data->gender=='F')
                          Female
                          @elseif($data->gender=='M')
                          Male 
                          @endif 
                     </td>
                     <td > {{ $data->mobile_no or 'NA' }}</td>
                     <?php 
                        $email = (strlen($data->email) > 23) ? substr($data->email,0,20).'...' : $data->email; 
                      ?>
                     <td > <span title="{{$data->email}}">{{ $email or 'NA' }}</span></td>
                     <?php 
  
                        
                        $skillnames = DB::table('member_interview')->where('id',$data->ref_interview_id)->first(); 
                      ?> 
                     <td >
                         <div style="width:1000px; float:left">
                             <div style="width:215px; float:left; ">
                         <span title="{{ucfirst($skillnames->allskill)}}">{{ucfirst($skillnames->allskill)}}</span>  </div>
                         
                         
                   <div style="width:100px; float:left; ">  {{$data->experience_level}}  @if($data->experience_level != 'NA')years @endif  </div>
                     
                     <div class="flipslide" id="{{$data->id}}" style="width:100px; float:left; " > <span class="label bg-success heading-text"> {{ number_format($data->base_price,2, '.', '') }} <i class="icon-sort-amount-asc"></i></span> </div>
                     <div class="flipslide" id="{{$data->id}}"  style="width:100px; float:left;  "> {{ number_format($data->igst_amount,2, '.', '') }}</div>
                     <div class="flipslide" id="{{$data->id}}"  style="width:100px; float:left;  "> {{ number_format($data->cgst_amount,2, '.', '') }}</div>
                     <div class="flipslide" id="{{$data->id}}"  style="width:100px; float:left;  "> {{ number_format($data->sgst_amount,2, '.', '') }}</div>
                     <div class="flipslide" id="{{$data->id}}"  style="width:100px; float:left; "> {{ number_format($data->grand_total,2, '.', '') }}</div>
                     
                  
                      <div class="flipslide" id="{{$data->id}}"  style="width:100px; float:left;  ">
                      
                      <span data-popup="tooltip" id="{{$data->id}}" class="flipslide"  title="" data-original-title="Check Payment Details"> 
                      <a  class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style="padding: 1px 3px;"  ><i class="icon-plus3"></i></a>
                      
                      </span>
                       <span> 
                      <a style="padding: 1px 3px;" href="{{url('/')}}/admin/transactions/details/{{base64_encode($data->order_id)}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        </div>
                        
                        
                          
                        
                        
                        
                              <?php
                    $transactionHistory = $common->getTransactionHistory($data->order_id);
                    foreach ($transactionHistory as $key => $transactionItem) {
                       if($transactionItem->combo_status == 1)
                       {
                          $combo = $common->getCombos($transactionItem->order_id,true);
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
                               $descriptionQa = 'Interview QA';
                               $description = (strlen($descriptionQa) > 50) ? '<p title="'.$descriptionQa.'">&nbsp;&nbsp;'.substr($descriptionQa,0,23).'...</p>' : '<p title="'.$descriptionQa.'">&nbsp;&nbsp;'.$descriptionQa.'</p>';
                          }
                          else if($transactionItem->item_type == 'Company')
                          {
                              $company_id = $transactionItem->item_id;
                              $interview_id = $transactionItem->interview_id;
                              $companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();

                              $item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
                              $description = (strlen($item_name) > 50) ? '<p title="'.$item_name.'">&nbsp;&nbsp;'.substr($item_name,0,48).'...</p>' : '<p title="'.$item_name.'">&nbsp;&nbsp;'.$item_name.'</p>';
                          }
                          else if($transactionItem->item_type == 'Work_exp')
                          {
                               $descriptionReal = 'Real Time Issues-'.$transactionItem->item_id;
                               $description = (strlen($descriptionReal) > 50) ? '<p title="'.$descriptionReal.'">&nbsp;&nbsp;'.substr($descriptionReal,0,48).'...</p>' : '<p title="'.$descriptionReal.'">&nbsp;&nbsp;'.$descriptionReal.'</p>';
                          }
                          else if($transactionItem->item_type == 'Coach')
                             $description = '<p title="Interview Coaching">&nbsp;&nbsp;Interview Coaching</p>';

                          $basePrice = $transactionItem->item_price;
                          $igst = $transactionItem->igst;
                          $cgst = $transactionItem->cgst;
                          $sgst = $transactionItem->sgst;
                          $totalAmount = $basePrice + $igst + $cgst + $sgst;
                       }
                      $bgColor = 'background-color: #f6f6f6;';
                       $refundcolour = '';
                      $minus = "";
                       
                       if($data->member_payment_status != 'Paid' && $transactionItem->payment_status == 'refunded')
                      {
                        $bgcolrs="";
                        $refundcolour = "color: #da1717;";
                        $minus = "-";
                      }
                      else if($key%2 ==0) 
                      { 
                        $bgcolrs="#d8d8d8ad  !important";
                      }else {$bgcolrs="#fff !important"; }
                      
                       
                  ?>
                  <div style="width:100%; float:left; display:none;   padding: 6px 0px 3px; background-color: {{$bgcolrs}}" class="flipslidedownal{{$data->id}}">
                    
                 
                  
                      <div   style="line-height: 14px !important; width:316px; float:left;"><i class=" icon-plus-circle2" style="float:left"></i> {!! $description !!}</div>
                      <div style=" width:100px; float:left; {{$refundcolour}}">{{$minus}}{{ number_format($basePrice,2) }}</div>
                      <div style=" width:100px; float:left;"> {{ number_format($igst,2) }}</div>
                      <div style=" width:50px; float:left;"> {{ number_format($cgst,2) }}</div>
                      <div style=" width:100px; float:left;"> {{ number_format($sgst,2) }}</div>
                      <div colspan="2" style=" width:100px; float:left;"> {{ number_format($totalAmount,2) }}</div>
                   </div>
                   
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
        <div> </div>
        {!! $arr_transaction->render() !!}
      </div>
  </div>
</div>
<style type="text/css">
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
    border-top: 15px solid #fff;
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
           { "bSortable": false },
           { "bSortable": false },
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
<script type="text/javascript" src="{{url('/')}}/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


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