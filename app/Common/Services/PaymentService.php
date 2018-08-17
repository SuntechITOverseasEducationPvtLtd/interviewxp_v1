<?php 

namespace App\Common\Services;

use Illuminate\Http\Request;
use Session;
use Redirect;
Use Sentinel;

class PaymentService
{
	public function __construct()
	{
		$this->PriceListModel          = new PriceListModel();	 
	}

	public function check_login()
	{
		
	}

	public function order_summery(Request $request)
    {
        $total_amt = 0;
        $arr_company = [];
        $arr_ticket = [];

        if($request->has('enc_experience_level') == false)
        {
            Flash::error('Experience Level Missing.');
            return redirect()->back();
        }
        
        $enc_experience_level = $request->input('enc_experience_level'); 
        try
        {
            $experience_level  = decrypt($enc_experience_level);    
        }
        catch(\Exception $e)
        {
            Flash::error('Invalid Experience Level.');
            return redirect()->back();
        }

        $arr_company = $request->input('company',[]);
        $arr_ticket  = $request->input('radio_ticket',[]);
        $reference_book = $request->input('reference_book');
        
        $count=count($arr_company);
        $enc_skill_name = $request->input('enc_skill_name');

        $arr_company_keys = array_keys($arr_company);
        $arr_ticket__keys = array_keys($arr_ticket);
        
        
        $arr_price_list=[];
        $obj_price_list = $this->PriceListModel->where('exp_level',$experience_level)->first();
        if($obj_price_list)
        {
            $arr_price_list = $obj_price_list->toArray();
        }
         
        if(isset($arr_price_list))
        {
           $reference_book_price = $arr_price_list['ref_book_price'];
           $interview_price      = $arr_price_list['interview_price'];
           $price_for_25_ticket  = $arr_price_list['price_for_25_ticket'];
           $price_for_50_ticket  = $arr_price_list['price_for_50_ticket'];
           $price_for_75_ticket  = $arr_price_list['price_for_75_ticket'];
        }

        $reference_book_bought=0;
        if(isset($reference_book) && $reference_book!='')
        { 
          $reference_book_bought=$reference_book_price;
        }
        
        $total_interview_amount = 0;
        if(isset($arr_company) && sizeof($arr_company)>0)
        {
            $amount=0;
            foreach($arr_company as $company)
            {
                  $initial_amount         = $amount;
                  $total_interview_amount = ($initial_amount+$interview_price*$company);
                  $amount   = $total_interview_amount;
            }
            $total_interview_amount = $amount;
        }

        $total_ticket_amount = 0;
        if(isset($arr_ticket) && sizeof($arr_ticket)>0)
        {
            foreach($arr_ticket as $ticket)
            {
                $ticket=$total_ticket_amount+$ticket;
                $total_ticket_amount = $ticket;
            }
        }
        $arr_ticket_name=[];
        if(isset($arr_ticket__keys) && sizeof($arr_ticket__keys)>0)
        {
           $arr_ticket_name=[];
	         foreach($arr_ticket__keys as $ticket_type => $ticket_key)
	         {
	              if($ticket_key=='price_for_25_ticket')
	              {
	                 $arr_ticket_name[$ticket_type]['ticket_name']=25; 
	                 $arr_ticket_name[$ticket_type]['ticket_price']=isset($price_for_25_ticket)?$price_for_25_ticket:0;
	              }
	              else if($ticket_key=='price_for_50_ticket')
	              {
	                 $arr_ticket_name[$ticket_type]['ticket_name']=50; 
	                 $arr_ticket_name[$ticket_type]['ticket_price']=isset($price_for_50_ticket)?$price_for_50_ticket:0;
	              }
	              else if($ticket_key=='price_for_75_ticket')
	              {
	                 $arr_ticket_name[$ticket_type]['ticket_name']=75; 
	                 $arr_ticket_name[$ticket_type]['ticket_price']=isset($price_for_75_ticket)?$price_for_75_ticket:0;
	              }
	         }
        }

        
        $sub_total                               = $total_interview_amount+$reference_book_bought+$total_ticket_amount;
        $tax_amount                              = ($sub_total*15/100);
        $grand_total                             = $sub_total+$tax_amount;
        $this->arr_view_data['company_count']    = $count;
        $this->arr_view_data['interview_amount'] = $total_interview_amount;
        $this->arr_view_data['arr_ticket_name']  = $arr_ticket_name;
        $this->arr_view_data['sub_total']        = $sub_total;
        $this->arr_view_data['tax_amount']       = $tax_amount;
        $this->arr_view_data['grand_total']      = $grand_total;
        $this->arr_view_data['experience_level'] = $experience_level;
        $this->arr_view_data['skill_name']       = $enc_skill_name;
        $this->arr_view_data['reference_book_bought']= $reference_book_bought;
        
       /* if (isset($request->input('submit'))){
            dd('I am Here');
        }*/

		return view('front.member.order_summary',$this->arr_view_data);
    }
}