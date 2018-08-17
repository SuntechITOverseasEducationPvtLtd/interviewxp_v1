@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
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
<div style="width: 95%;margin: 0px auto;">
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
            <div style="width:50%;float:left;">
                <table style="font-size: 18px;">
                     <tr>

                     <th style="text-align: left;">Transporter Details : </th>
    
                     </tr>   
                    <tr>
                         <td><b>Sun Info Technologies</b></td>
                    </tr>
                    <tr>
                        <td>4th Floor, Banja Hills</td>
                    </tr>
                   
                    <tr>
                        <td>Hyderabad, Telangana, India</td>
                    </tr>
                    
                </table>

            </div>
            <div style="width:50%;float:left;">
                <table style="font-size: 18px;">
                    <tr>
                        <td><b>Order No: </b></td><td>{{ ucwords($invoiceDetails->order_id) }}</td>
                    </tr>
                    <tr>
                        <td><b>Order Date: </b></td><td>{{ date('j M, Y, g:i A T',strtotime($invoiceDetails->created_at)) }}</td>
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
             	@if($invoiceDetails['transaction_history'])
             	@foreach($invoiceDetails['transaction_history'] as $key=>$transaction_history)
             	<?php
             		$item_name = '';
             		$interview_id = $transaction_history->interview_id;
             		switch($transaction_history->item_type)
             		{
             			case 'Company' :
             					$company_id = $transaction_history->item_id;
             					$companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();

             					$item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
             					break;

             			case 'Coach' :	
             					$item_name = 'Interview Coach';
             					break;

             			case 'Work_exp' :	
             					$item_name = 'Real Time issues - '.$transaction_history->item_id;
             					break;

             		}
             		
             		
             	?>
	            <tr style="text-align: left;">
	             	<td style="width: 30%;border: none;padding: 10px 5px 15px 5px !important;">{{$key+1}}</td>
	             	<td style="width: 30%;border: none;padding: 10px 5px 15px 5px !important;">{{ $item_name }}</td>
	             	<td style="width: 30%;border: none;padding: 10px 5px 15px 5px !important;">1</td>
	             	<td style="width: 20%;border: none;padding: 10px 5px 15px 5px !important;">Rs&nbsp;{{ $transaction_history->item_price }}</td>
	            </tr>
	            @endforeach
	            @endif
            </tbody> 
            <tfoot style="font-weight: bold;font-size: 18px;">
            	<tr style="text-align: left;">
	            	<td style="border: none !important;padding: 5px;"></td>
	            	<td style="border: none !important;padding: 5px;"></td>
	        		<td style="width: 20%;border: none;padding: 5px;">Subtotal</td>
	             	<td style="width: 20%;border: none;padding: 5px;">Rs&nbsp;{{ $invoiceDetails->base_price }}</td>
	            </tr>
	            <tr style="text-align: left;">
	            	<td style="border: none !important;padding: 5px;"></td>
	            	<td style="border: none !important;padding: 5px;"></td>
	        		<td style="width: 20%;border: none;padding: 5px;">GST(18%)</td>
	             	<td style="width: 20%;border: none;padding: 5px;">Rs&nbsp;{{ $invoiceDetails->igst_amount }}</td>
	            </tr>
	            <tr style="text-align: left;">
	            	<td style="border: none !important;padding: 5px;"></td>
	            	<td style="border: none !important;padding: 5px;"></td>
	        		<td style="width: 20%;border: none;padding: 5px;">Total</td>
	             	<td style="width: 20%;border: none;padding: 5px;">Rs&nbsp;{{ $invoiceDetails->grand_total }}</td>
	            </tr>
            </tfoot>
            
        </table>

    </div>

</div>
</div>