@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
@inject('transactionBillingDetailsModel', 'App\Models\TransactionBillingDetailsModel')
@inject('commonService', 'App\Common\Services\CommonService')
<style>
    .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th
    {
        border:1px solid #ddd !important;
        padding: 5px !important;
    }
    .table-bordered{
         border-collapse: collapse;
        border-spacing: 0;
    }
</style>
<div  style="width:100%;">
<div style="width: 70%;margin: 0px auto;">
    <div style="width:100%;padding: 15px;">
        <div style="width: 50%;float: left;">
            <img src="{{url('/')}}/images/logo.png" alt="company logo" width="75%" style="background: #999999;width: 270px;" /> 
        </div>
        <div  style="width: 30%;float: left;font-size: 20px;">

            <h4>Tax Invoice</h4>
        </div>
        <div style="width:20%;float: left;font-size: 20px;">
            <h4> ORIGINAL</h4>
        </div>
    </div>    

    <div style="width:100%;clear: both;padding: 15px">
            <div style="width:33%;float:left;">
                <table style="font-size: 16px;">
                    <tr>
                        <th style="text-align: left;">FROM : </th>    
                    </tr>                       
                    <tr>
                         <td><b>SUNTECH IT EDUCATION P.V.T.LTD</b></td>
                    </tr>
                    <tr>
                        <td>BZZ MAHESWAR TOWERS</td>
                    </tr>
                    <tr>
                        <td>ROAD NO.1, BANJARA HILLS-500034</td>
                    </tr>  
                    <tr>
                         <td>GST: 36AAECC8485A120</td>
                    </tr>                 
                    <tr>
                        <td>EMAIL: Support@interviewxp.com</td>
                    </tr>
                    <tr>
                        <td>P.NO: +91-40-12345</td>
                    </tr>
                    
                </table>

            </div>
            <div style="width:33%;float:left;">
                <?php
                    $billingDetails = $transactionBillingDetailsModel->where('order_id',$order_id)->first();
                ?>
                <table style="font-size: 16px;">
                     <tr>

                     <th style="text-align: left;">Bill To : </th>
    
                     </tr>   
                    <tr>
                         <td>{{$billingDetails->billing_name or ''}}</td>
                    </tr>
                    <tr>
                        <td>{{$billingDetails->billing_address or ''}},{{$billingDetails->billing_zip or ''}}</td>
                    </tr>
                   
                    <tr>
                        <td>{{$billingDetails->billing_city or ''}}, {{$billingDetails->billing_state or ''}}, {{$billingDetails->billing_country or ''}}</td>
                    </tr>
                    <tr>
                        <td>EMAIL: {{$billingDetails->billing_email or ''}}</td>
                    </tr>
                    <tr>
                        <td>P.NO: {{$billingDetails->billing_tel or ''}}</td>
                    </tr>
                    
                </table>

            </div>
            <div style="width:33%;float:left;">
                <table style="font-size: 16px;">
                    <tr>
                        <td><b>Order No: </b></td><td>{{ ucwords($order_id) }}</td>
                    </tr>
                    <tr>
                        <td><b>Order Date: </b></td><td>{{ date('j M, Y, g:i A T',strtotime($created_at)) }}</td>
                    </tr>
                </table>
            </div>
    </div>
       
     <div style="width:100%;clear: both;padding: 15px">
        <table style="width: 100%" class="table-bordered">
        	<thead style="border-bottom: black;font-size: 18px;">
	             <tr style="text-align: left;">
	        	 	<th style="width: 20%;border: none;padding: 10px;">SNO</th>
	             	<th style="width: 20%;border: none;border: none;padding: 10px;">Description</th>
	             	<th style="width: 20%;border: none;border: none;padding: 10px;">Quantity</th>
	             	<th style="width: 20%;border: none;padding: 10px;">Amount</th>
	             </tr>
             </thead> 
             <tbody style="font-size: 16px;"> 
             	@if($transaction_history)
                <?php
                    $comboFlag = true;  
                    $sno = 0;                
                ?>
             	@foreach($transaction_history as $key=>$history)
             	<?php
                    $item_name = '';
                    $interview_id = $history['interview_id'];
             		$order_id = $history['order_id'];

                    if($history['combo_status'] == 1 && $comboFlag == true)
                    {
                        $comboDetails = $commonService->getCombos($order_id);
                        $item_price = $comboDetails['comboPrice'];
                        $item_name = $comboDetails['comboStr'];
                        $comboFlag = false;
                        $sno = $sno +1;                    
                    }
                    else if($history['combo_status'] == 0)
                    {
                        switch($history['item_type'])
                        {
                            case 'Company' :
                                    $company_id = $history['item_id'];
                                    $companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();

                                    $item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';

                                    $item_price = $history['item_price'];
                                    break;

                            case 'Coach' :  
                                    $item_name = 'Interview Coach';
                                    $item_price = $history['item_price'];
                                    break;

                            case 'Work_exp' :   
                                    $item_name = 'Real Time issues - '.$history['item_id'];
                                    $item_price = $history['item_price'];
                                    break;

                        }
                        $sno = $sno +1;                    
                    }             		
             		
             	?>
                @if(!empty($item_name))
	            <tr style="text-align: left;">
	             	<td style="width: 30%;border: none;padding: 10px 5px 15px 5px !important;">{{$sno}}</td>
	             	<td style="width: 30%;border: none;padding: 10px 5px 15px 5px !important;">{!! $item_name !!}</td>
	             	<td style="width: 30%;border: none;padding: 10px 5px 15px 5px !important;">1</td>
	             	<td style="width: 20%;border: none;padding: 10px 5px 15px 5px !important;">Rs&nbsp;{{ $item_price }}</td>
	            </tr>
                @endif
	            @endforeach
	            @endif
            </tbody> 
            <tfoot style="font-weight: bold;font-size: 18px;">
            	<tr style="text-align: left;">
	            	<td style="border: none !important;padding: 5px;"></td>
	            	<td style="border: none !important;padding: 5px;"></td>
	        		<td style="width: 20%;border: none;padding: 5px;">Subtotal</td>
	             	<td style="width: 20%;border: none;padding: 5px;">Rs&nbsp;{{ $base_price }}</td>
	            </tr>
	            <tr style="text-align: left;">
	            	<td style="border: none !important;padding: 5px;"></td>
	            	<td style="border: none !important;padding: 5px;"></td>
	        		<td style="width: 20%;border: none;padding: 5px;">GST(18%)</td>
	             	<td style="width: 20%;border: none;padding: 5px;">Rs&nbsp;{{ $igst_amount }}</td>
	            </tr>
	            <tr style="text-align: left;">
	            	<td style="border: none !important;padding: 5px;"></td>
	            	<td style="border: none !important;padding: 5px;"></td>
	        		<td style="width: 20%;border: none;padding: 5px;">Total</td>
	             	<td style="width: 20%;border: none;padding: 5px;">Rs&nbsp;{{ $grand_total }}</td>
	            </tr>
            </tfoot>
            
        </table>

    </div>

</div>
</div>