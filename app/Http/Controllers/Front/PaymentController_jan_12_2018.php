<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use Softon\Indipay\Facades\Indipay;

use App\Models\PriceListModel;
use App\Models\TransactionModel;
use App\Models\PurchaseHistoryModel;
use App\Models\MemberInterviewModel;
use App\Models\InterviewDetailModel;
use App\Models\PurchasedTicketModel;
use App\Models\AccountSettingModel;
use App\Models\UserModel;
use App\Models\SkillsModel;
use App\Models\ReviewRatingModel;
use App\Models\ManageEmailModel;
use App\Models\UserDetailModel;
use App\Models\MemberDetailModel;
use App\Models\TransactionHistoryModel;
use App\Models\TransactionBillingDetailsModel;
use App\Common\Services\CommonService;
use Validator;
use Sentinel;
use Flash;
use Session;
use Activation;
use Mail;
use File;
use Carbon\carbon;
use URL;
use Config;
use PDF;
use DB;

class PaymentController extends Controller
{
    public function __construct(PriceListModel $price_list,
                                TransactionModel $transaction,
                                PurchaseHistoryModel $purchase_history,
                                InterviewDetailModel $InterviewDetail,
                                MemberInterviewModel $member_interview,
                                PurchasedTicketModel $purchased_ticket,
                                SkillsModel $skills,
                                UserModel $user,
                                UserDetailModel $user_detail,
                                MemberDetailModel $member_detail,
                                //ReviewRatingModel $review_rating,
                                ReviewRatingModel $review_rating,
                                AccountSettingModel $acount_settings,
                                TransactionHistoryModel $transaction_history,
                                TransactionBillingDetailsModel $transaction_billing_details,
                                ManageEmailModel $manage_email)
    {
        $this->UserModel            = $user;
        $this->UserDetailModel      = $user_detail;
        $this->MemberDetailModel    = $member_detail;
        $this->PriceListModel       = $price_list;
        $this->TransactionModel     = $transaction;
        $this->SkillsModel             = $skills;
        $this->PurchaseHistoryModel = $purchase_history;
        $this->InterviewDetailModel = $InterviewDetail;
        $this->MemberInterviewModel = $member_interview;
        $this->PurchasedTicketModel = $purchased_ticket;
        $this->ReviewRatingModel    = $review_rating;
        $this->ManageEmailModel     = $manage_email;
        $this->AccountSettingModel     = $acount_settings;
        $this->TransactionHistoryModel     = $transaction_history;
        $this->TransactionBillingDetailsModel     = $transaction_billing_details;
        $this->arr_view_data        = [];
        $obj_mail_from = $this->ManageEmailModel->first();
        $this->mail_from = $obj_mail_from->general_email;
    }


    public function order_summery(Request $request)
    {		
        $user = Sentinel::check();
        if($user==false || $user->inRole('admin'))
        {
          Flash::error('Please do login first.');
          return redirect('user/login');
        }
        $total_amt = 0;
        $arr_company = [];
        $arr_ticket = [];
        $obj_user_details = $this->AccountSettingModel->first();
        $is_enable_gst = $obj_user_details->is_enable_gst;
        $igst = $obj_user_details->igst;
        $cgst = $obj_user_details->cgst;
        $sgst = $obj_user_details->sgst;
       
        if($request->has('enc_experience_level') == false)
        {
            Flash::error('Experience Level Missing.');
            return redirect()->back();
        }
        $TextResumeType=$request->input('TextResumeType');
        $enc_experience_level = $request->input('enc_experience_level');
        $enc_interview_id = $request->input('enc_interview_id');
        $enc_user_id = $request->input('enc_user_id');
        $enc_skill_id = $request->input('enc_skill_id');
        $training_schedule_id = $request->input('schedule_id');
        try
        {
            $experience_level = $enc_experience_level;
            $interview_id     = $enc_interview_id;
            $user_id          = $enc_user_id;
            $current_user     = $user->id;
            $skill_id         = $enc_skill_id;
        }
        catch(\Exception $e)
        {
            Flash::error('Invalid Data.');
            return redirect()->back();
        }

        $TextResume_box = $request->input('reference_book_textResume');
        $arr_company = $request->input('company',[]);
        $arr_ticket  = $request->input('radio_ticket',[]);
        $reference_book = $request->input('reference_book');
        $training_classes = $request->input('training_classes');	
        $user_state = '';

        $userDetails = $this->UserDetailModel->where('user_id',$current_user)->first();
        $memberDetails = $this->MemberDetailModel->where('user_id',$current_user)->first();
        if(count($userDetails) > 0)
        {
          $user_state = $userDetails->state;
        }
        else if(count($memberDetails) > 0)
        {
          $user_state = $memberDetails->education_state;
        }
        
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
           $TextResume           = $arr_price_list['validity'];
           $reference_book_price = $arr_price_list['ref_book_price'];
           $training_price = $arr_price_list['training_price'];
           $interview_price      = $arr_price_list['interview_price'];
           $price_for_25_ticket  = $arr_price_list['price_for_25_ticket'];
           $price_for_50_ticket  = $arr_price_list['price_for_50_ticket'];
           $price_for_75_ticket  = $arr_price_list['price_for_75_ticket'];
           $combo_coach_interview_qa  = $arr_price_list['combo_coach_interview_qa'];
           $combo_coach_company  = $arr_price_list['combo_coach_company'];
           $combo_coach_realissues  = $arr_price_list['combo_coach_realissues'];
        }
        
		$TextResume_boxAmount=0;
		$combo = $request->input('combo');
		if(!isset($combo['coach-company']) && !isset($combo['coach-reference_book']) && !isset($combo['coach-realissues']))
		{
			if(isset($TextResume_box) && $TextResume_box!='')
			{ 
			  $TextResume_boxAmount=$TextResume;
			}
		}
        
		
        $reference_book_bought=0;
		$combo_coach_interview_qa_price=0;
		if(isset($combo['coach-reference_book']))
		{
			$combo_coach_interview_qa_price = $combo_coach_interview_qa;
		}
		else{
			if(isset($reference_book) && $reference_book!='')
			{ 
			  $reference_book_bought=$reference_book_price;
			}
		}
        $reference_training_bought=0;
        if(isset($training_classes) && $training_classes!='' && $training_classes != '0.00')
        { 
          $reference_training_bought=$training_price;
        }
        /*dd($reference_book_bought);*/
        
        $total_interview_amount = 0;
		$combo_coach_company_price=0;
		if(isset($combo['coach-company']))
		{
			$combo_coach_company_price = $combo_coach_company;
		}
		else
		{
			if(isset($arr_company) && sizeof($arr_company)>0)
			{
				$amount=0;
				foreach($arr_company as $company)
				{
					  $initial_amount         = $amount;
					  $total_interview_amount = ($initial_amount+$interview_price*$company);
					  $amount = $total_interview_amount;
				}
				$total_interview_amount = $amount;
			}
		}

        $total_ticket_amount = 0;
		$combo_coach_realissues_price=0;
		if(isset($combo['coach-realissues']))
		{
			$combo_coach_realissues_price = $combo_coach_realissues;
		}
		else
		{
			if(isset($arr_ticket) && sizeof($arr_ticket)>0)
			{
				foreach($arr_ticket as $ticket)
				{
					$ticket=$total_ticket_amount+$ticket;
					$total_ticket_amount = $ticket;
				}
			}
		}
        $arr_ticket_name=[];
        $ticket_unique_id = uniqid();
        //if(isset($arr_ticket__keys) && sizeof($arr_ticket__keys)>0)
       // {
          
           // $ticket_unique_id = decrypt($request->input('ticket_unique_id'));
          
         
           //$arr_ticket_name=[];
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
        //}
        $sub_total                                    = $TextResume_boxAmount+$total_interview_amount+$reference_book_bought+$total_ticket_amount+$reference_training_bought+$combo_coach_company_price+$combo_coach_interview_qa_price+$combo_coach_realissues_price;
        $tax_amount_igst = 0;
        $tax_amount_cgst = 0;
        $tax_amount_sgst = 0;
        
        if($user_state == Config::get('constants.COMPANY_STATE'))
        {
          $tax_amount_cgst = (!empty($is_enable_gst)) ? ($sub_total*$cgst/100) : 0;
          $tax_amount_sgst = (!empty($is_enable_gst)) ? ($sub_total*$sgst/100) : 0;
          $tax_amount = $tax_amount_cgst+$tax_amount_sgst;   
          $igst = 0;       
        }
        else
        {
          $tax_amount_igst = (!empty($is_enable_gst)) ? ($sub_total*$igst/100) : 0;
          $tax_amount = $tax_amount_igst;
          $cgst = 0;
          $sgst = 0;
        }
        
        $grand_total                                  = $sub_total+$tax_amount;
        $this->arr_view_data['company_count']         = $count;
        $this->arr_view_data['interview_amount']      = $total_interview_amount;
        $this->arr_view_data['interview_each_company_price']      = $interview_price;
        $this->arr_view_data['arr_ticket_name']       = $arr_ticket_name;
        $this->arr_view_data['sub_total']             = $sub_total;
        $this->arr_view_data['tax_amount']            = $tax_amount;
        $this->arr_view_data['grand_total']           = $grand_total;
        $this->arr_view_data['experience_level']      = $experience_level;
        $this->arr_view_data['skill_name']            = $enc_skill_name;
        $this->arr_view_data['reference_book_bought'] = $reference_book_bought;
        $this->arr_view_data['reference_training_bought'] = $reference_training_bought;
        $this->arr_view_data['interview_id']          = $interview_id;
        $this->arr_view_data['user_id']               = $user_id;
        $this->arr_view_data['skill_id']              = $skill_id;
        $this->arr_view_data['training_schedule_id']              = $training_schedule_id;
        $this->arr_view_data['company_ids']           = $arr_company_keys;
        $this->arr_view_data['ticket_unique_id']      = $ticket_unique_id;
        $this->arr_view_data['validityResume']           = $TextResume_boxAmount;
        $this->arr_view_data['TextResumeType']           = $TextResumeType;
        $this->arr_view_data['coach_company']           = isset($combo['coach-company']) ? $combo['coach-company'] : '';
        $this->arr_view_data['combo_coach_company_price']           = $combo_coach_company_price;
        $this->arr_view_data['coach_reference_book']           = isset($combo['coach-reference_book']) ? $combo['coach-reference_book'] : '';
        $this->arr_view_data['combo_coach_interview_qa_price']           = $combo_coach_interview_qa_price;
		$this->arr_view_data['coach_realissues']           = isset($combo['coach-realissues']) ? $combo['coach-realissues'] : '';
        $this->arr_view_data['combo_coach_realissues_price']           = $combo_coach_realissues_price;

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
         $arr_skill = $obj_skill->toArray();
        }
        $skill_name=$enc_skill_name;

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['is_enable_gst']             = $is_enable_gst;
        $this->arr_view_data['igst']             = $igst;
        $this->arr_view_data['cgst']             = $cgst;
        $this->arr_view_data['sgst']             = $sgst;
        $this->arr_view_data['tax_amount_cgst']  = $tax_amount_cgst;
        $this->arr_view_data['tax_amount_sgst']  = $tax_amount_sgst;
        $this->arr_view_data['tax_amount_igst']  = $tax_amount_igst;
        $this->arr_view_data['user_state']  = $user_state;
        $this->arr_view_data['company_state']  = Config::get('constants.COMPANY_STATE');
        //dd($this->arr_view_data);
        $encrypt_data = encrypt($this->arr_view_data);
        $this->arr_view_data['encrypt_data']        = $encrypt_data;

		    return view('front.member.order_summary',$this->arr_view_data);
    }

    public function getInvoice()
    {
      $invoiceDetails = $this->TransactionModel->with(['transaction_history' => function($query){
        //$query->groupBy('combo_status');
        $query->orderBy('item_price','ASC');
    }])->where(['id'=>116])->first();

      //view()->share('invoiceDetails',$invoiceDetails);

      //$pdf = PDF::loadView('front.tax_invoice');
      //$uniqueFileName = $invoiceDetails->order_id."_".date('ymd')."_Tax_Invoice.pdf";
       //$pathToFile = url('/').'/uploads/invoices/'.$uniqueFileName;
       ///dd($pathToFile);
      //return $pdf->save(public_path().'../uploads/invoices/'.$uniqueFileName);
      //return $pdf->download($uniqueFileName);
      //dd($invoiceDetails);
      return view('front.email.tax_invoice')->with('invoiceDetails',$invoiceDetails);
    }

    public function pay_now(Request $request)
    {
      $user = Sentinel::check();
      if($user==false || $user->inRole('admin'))
      {
        //Session::put('payment_login','payment login');
        Flash::error('Please do login first.');
        return redirect('user/login');
      }
      $enc_data = $request->input('enc_data');
	  
      try
      {  
        $decrypt_data = decrypt($enc_data);
      }
      catch(\Exception $e)
      {
          Sentinel::logout();
          return redirect('user/login');
      }

      $grand_total = $decrypt_data['grand_total'];
      if($grand_total==0)
      {
      	return redirect()->back();	
      }
      $purchaser_id = $user->id;          /*user logged in id */
      $dt =carbon::now();
      $end_date = $dt->addMonth()->toDateTimeString();
      $reference_book_bought = $decrypt_data['reference_book_bought'];
      $combo_coach_interview_qa_price = $decrypt_data['combo_coach_interview_qa_price'];
      $reference_book        = 'No';
      
      if($reference_book_bought!=0 || $combo_coach_interview_qa_price != 0)
      {
          $reference_book = 'Yes';
      }
	  

      $arr_transaction                   = [];
      $arr_transaction['base_price']      = $decrypt_data['sub_total'];
      $arr_transaction['grand_total']      = $decrypt_data['grand_total'];
      $arr_transaction['admin_amount']     = $decrypt_data['grand_total']/2;
      $arr_transaction['member_amount']    = $decrypt_data['grand_total']/2;
      $arr_transaction['user_id']          = $purchaser_id;
      $arr_transaction['member_user_id']   = $decrypt_data['user_id'];
      $arr_transaction['skill_id']         = $decrypt_data['skill_id'];
      $arr_transaction['experience_level'] = $decrypt_data['experience_level'];
      $arr_transaction['end_date']         = $end_date;
      $arr_transaction['order_id']         = uniqid();
      $arr_transaction['ticket_unique_id'] = $decrypt_data['ticket_unique_id'];
      $arr_transaction['ref_interview_id'] = $decrypt_data['interview_id'];
      $arr_transaction['reference_book']   = $reference_book;
      $arr_transaction['TextResumeType']   = $decrypt_data['TextResumeType'];
      $arr_transaction['igst_percent']   = $decrypt_data['igst'];
      $arr_transaction['igst_amount']   = $decrypt_data['tax_amount_igst'];
      $arr_transaction['cgst_percent']   = $decrypt_data['cgst'];
      $arr_transaction['cgst_amount']   = $decrypt_data['tax_amount_cgst'];
      $arr_transaction['sgst_percent']   = $decrypt_data['sgst'];
      $arr_transaction['sgst_amount']   = $decrypt_data['tax_amount_sgst'];

      $transaction                         = $this->TransactionModel->create($arr_transaction);

      if($transaction)
      {  
          $transaction_id=$transaction->id;
          $order_id= $transaction->order_id;
          $amount = $transaction->grand_total;
          $transactionHistory = [];
          if($decrypt_data['TextResumeType'] == 1)
          {
            $coach['item_type'] = 'Coach';
            if(!empty($decrypt_data['coach_reference_book']) || !empty($decrypt_data['coach_realissues']) || !empty($decrypt_data['coach_company']))
            {
              $coach['item_price'] = 0;
              $coach['combo_status'] = 1;
              $coach['igst'] = 0;
              $coach['cgst'] = 0;
              $coach['sgst'] = 0;

              if(!empty($decrypt_data['coach_reference_book']))
                $coach['combo_type'] = 'Coach+Qa';
              elseif(!empty($decrypt_data['coach_realissues']))
                $coach['combo_type'] = 'Coach+Workexp';
              elseif(!empty($decrypt_data['coach_company']))
                $coach['combo_type'] = 'Coach+Company';
            }
            else
            {
              $coach['item_price'] = $decrypt_data['validityResume']; 
              $coach['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['validityResume'] * ($decrypt_data['igst']/100) : 0;
              $coach['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['validityResume'] * ($decrypt_data['cgst']/100) : 0;
              $coach['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['validityResume'] * ($decrypt_data['sgst']/100) : 0;      
            }     
            
            $transactionHistory[] = $coach;
          }

          if(!empty($decrypt_data['reference_book_bought']))
          {
            $interview_qa['item_type'] = 'Interview_qa';
            if(!empty($decrypt_data['coach_reference_book']))
            {
              $interview_qa['item_price'] = $decrypt_data['combo_coach_interview_qa_price'];
              $interview_qa['combo_status'] = 1;
              $interview_qa['combo_type'] = 'Coach+Qa';
              $interview_qa['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['combo_coach_interview_qa_price'] * ($decrypt_data['igst']/100) : 0;
              $interview_qa['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['combo_coach_interview_qa_price'] * ($decrypt_data['cgst']/100) : 0;
              $interview_qa['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['combo_coach_interview_qa_price'] * ($decrypt_data['sgst']/100) : 0;
            }
            else
            {
              $interview_qa['item_price'] = $decrypt_data['reference_book_bought'];   
              $interview_qa['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['reference_book_bought'] * ($decrypt_data['igst']/100) : 0;
              $interview_qa['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['reference_book_bought'] * ($decrypt_data['cgst']/100) : 0;
              $interview_qa['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['reference_book_bought'] * ($decrypt_data['sgst']/100) : 0;    
            }            
            

            $transactionHistory[] = $interview_qa;
          }

          if(count($decrypt_data['arr_ticket_name']) > 0)
          {
            $workexp['item_type'] = 'Work_exp';
            if(!empty($decrypt_data['coach_realissues']))
            {
              $workexp['item_price'] = $decrypt_data['combo_coach_realissues_price'];
              $workexp['combo_status'] = 1;
              $workexp['combo_type'] = 'Coach+Workexp';
              $workexp['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['combo_coach_realissues_price'] * ($decrypt_data['igst']/100) : 0;
              $workexp['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['combo_coach_realissues_price'] * ($decrypt_data['cgst']/100) : 0;
              $workexp['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['combo_coach_realissues_price'] * ($decrypt_data['sgst']/100) : 0;
            }
            else
            {
              $workexp['item_price'] = $decrypt_data['arr_ticket_name'][0]['ticket_price'];  
              $workexp['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['arr_ticket_name'][0]['ticket_price'] * ($decrypt_data['igst']/100) : 0;
              $workexp['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['arr_ticket_name'][0]['ticket_price'] * ($decrypt_data['cgst']/100) : 0;
              $workexp['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['arr_ticket_name'][0]['ticket_price'] * ($decrypt_data['sgst']/100) : 0;     
            }
            $workexp['item_id'] = $decrypt_data['arr_ticket_name'][0]['ticket_name'];
            

            $transactionHistory[] = $workexp;
          }

          if(count($decrypt_data['company_ids']) > 0)
          {
            foreach($decrypt_data['company_ids'] as $key => $id)
            {
              $company['item_type'] = 'Company';
              if(!empty($decrypt_data['coach_company']))
              {
                $company['item_price'] = ($key == 0) ? $decrypt_data['combo_coach_company_price'] : 0;
                $company['combo_status'] = 1;
                $company['combo_type'] = 'Coach+Company';
                $company['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['combo_coach_company_price'] * ($decrypt_data['igst']/100) : 0;
                $company['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['combo_coach_company_price'] * ($decrypt_data['cgst']/100) : 0;
                $company['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['combo_coach_company_price'] * ($decrypt_data['sgst']/100) : 0;
              }
              else
              {
                $company['item_price'] = $decrypt_data['interview_each_company_price'];
                $company['igst'] = (!empty($decrypt_data['igst'])) ? $decrypt_data['interview_each_company_price'] * ($decrypt_data['igst']/100) : 0;
                $company['cgst'] = (!empty($decrypt_data['cgst'])) ? $decrypt_data['interview_each_company_price'] * ($decrypt_data['cgst']/100) : 0;
                $company['sgst'] = (!empty($decrypt_data['sgst'])) ? $decrypt_data['interview_each_company_price'] * ($decrypt_data['sgst']/100) : 0;
              }
              $company['item_id'] = $id;
              

              $transactionHistory[] = $company;
            }            
          }
          foreach($transactionHistory as $transItem)
          {
            $transItem['interview_id']   = $decrypt_data['interview_id'];   
            $transItem['trans_id']       = $transaction_id;
            $transItem['order_id']       = $order_id;
            $this->TransactionHistoryModel->create($transItem);
          }
          
          $company_count         = $decrypt_data['company_count'];
          
          if(isset($decrypt_data['arr_ticket_name']) && sizeof($decrypt_data['arr_ticket_name'])>0)
          {
              $ticket_name = $decrypt_data['arr_ticket_name'][0]['ticket_name'];
          }
          else
          {
              $ticket_name = '';
          }
          $reference_book        = 'No';

          if($reference_book_bought!=0 || $combo_coach_interview_qa_price != 0)
          {
              $reference_book = 'Yes';
          }

          //dd($reference_book);21
          
          if($company_count==0)
          {
              $arr_purchase['interview_id']   = $decrypt_data['interview_id'];   
              $arr_purchase['trans_id']       = $transaction_id;
              $arr_purchase['order_id']       = $order_id;
              $arr_purchase['reference_book'] = $reference_book;
              $arr_purchase['ticket_name']    = $ticket_name;
			  $arr_purchase['TextResumeType']   = $decrypt_data['TextResumeType'];
			  $arr_purchase['training_schedule_id']   = (isset($decrypt_data['training_schedule_id']) && $decrypt_data['training_schedule_id'] != 0) ? $decrypt_data['training_schedule_id'] : null;
      
			  $arr_purchase['InterviewByCompaniesID']   = null;
              $purchase_history = $this->PurchaseHistoryModel->create($arr_purchase);   
          }
          
          if($company_count!=0)
          {
            $company_ids      = $decrypt_data['company_ids']; /*company's id */
            $experience_level = $decrypt_data['experience_level'];
            $skill_id         = $decrypt_data['skill_id'];
            $member_user_id   = $decrypt_data['user_id'];
            $arr_interview = [];
            foreach($company_ids as $key => $id) 
            {

              /*$arr_interview_detail = $this->MemberInterviewModel
                                            ->where('user_id',$member_user_id)
                                            ->where('skill_id',$skill_id) 
                                            ->where('experience_level',$experience_level)
                                            ->where('company_id',$id) 
                                            ->get(['id']);*/
            
			/* //Ramakrishna
              $arr_interview_detail    = $this->InterviewDetailModel
                                            ->where('user_id',$member_user_id)
                                            ->where('skill_id',$skill_id)
                                            ->where('approve_status','1')  
                                            ->where('experience_level',$experience_level)
                                            ->where('company_id',$id) 
                                            ->get(['id']);

            $data[$key]['detail']=$arr_interview_detail->toArray();
			*/
			//Ramakrishna
			$arr_purchase['trans_id']       = $transaction_id;
			$arr_purchase['order_id']       = $order_id;
			$arr_purchase['interview_id']   = $decrypt_data['interview_id'];
			//$arr_purchase['interview_id']   = $value['id'];
			$arr_purchase['reference_book'] = $reference_book;
			$arr_purchase['ticket_name']    = $ticket_name;
			$arr_purchase['TextResumeType']   = $decrypt_data['TextResumeType'];
			$arr_purchase['InterviewByCompaniesID']   = $id;
      $arr_purchase['training_schedule_id']  = $decrypt_data['training_schedule_id'];
      
			$purchase_history = $this->PurchaseHistoryModel->create($arr_purchase);
				
            }

           /* foreach($data as $key => $purchase)  ///////Ramakrishna
            {
              foreach ($purchase['detail'] as $key => $value) 
              {
                $arr_purchase['trans_id']       = $transaction_id;
                $arr_purchase['order_id']       = $order_id;
                $arr_purchase['interview_id']   = $decrypt_data['interview_id'];
                //$arr_purchase['interview_id']   = $value['id'];
                $arr_purchase['reference_book'] = $reference_book;
                $arr_purchase['ticket_name']    = $ticket_name;
				$arr_purchase['TextResumeType']   = $decrypt_data['TextResumeType'];
				$arr_purchase['InterviewByCompaniesID']   = "2";
                $purchase_history = $this->PurchaseHistoryModel->create($arr_purchase);
              }
              
            }*/
            
          }

        $userDetails = $this->UserModel->join('user_detail','user_detail.user_id','=','users.id')->where('users.id',$user->id)->first();
      
        $memberDetails = $this->UserModel->join('member_detail','member_detail.user_id','=','users.id')->where('users.id',$user->id)->first();
        if(count($userDetails) > 0)
        {
          $billing_state = CommonService::getState($userDetails->state);
          $billing_city = CommonService::getCity($userDetails->city);
          $billing_country = CommonService::getCountry($userDetails->state);
          $billing_tel = $userDetails->mobile_no;
          $billing_email = $userDetails->email;
          $billing_name = $userDetails->first_name.' '.$userDetails->last_name;
        }
        else if(count($memberDetails) > 0)
        {
          $billing_state = CommonService::getState($memberDetails->education_state);
          $billing_city = CommonService::getCity($memberDetails->education_city);
          $billing_country = CommonService::getCountry($memberDetails->education_country_id);
          $billing_tel = $memberDetails->mobile_no;
          $billing_email = $memberDetails->email;
          $billing_name = $memberDetails->first_name.' '.$memberDetails->last_name;
        }

          $parameters = [
                    'tid' => $transaction_id,
                    'order_id' => $order_id,
                    'amount' => $amount,
                    'billing_tel' => $billing_tel,
                    'billing_email' => $billing_email,
                    'billing_name' => $billing_name,
                    'billing_address' => '',
                    'billing_city' => $billing_city,
                    'billing_state' => $billing_state,
                    'billing_country' => $billing_country,
                    'billing_zip' => '',
                    ];

          // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo

          $order = Indipay::gateway('CCAvenue')->prepare($parameters);
          return Indipay::process($order);
      }
      else
      {
        Flash::error('Error while proceed to pay please try again.');
        return redirect()->back();
      }

    }

    public function payment_responce(Request $request)
    {
         /*
            array:42 [▼
                  "order_id" => "1232212"
                  "tracking_id" => "305002976300"
                  "bank_ref_no" => "1482730398996"
                  "order_status" => "Success"
                  "failure_message" => ""
                  "payment_mode" => "Net Banking"
                  "card_name" => "AvenuesTest"
                  "status_code" => "null"
                  "status_message" => "Y"
                  "currency" => "INR"
                  "amount" => "1200.0"
                  "billing_name" => "Shankar"
                  "billing_address" => "Kathe Lane Dwarka Nashik"
                  "billing_city" => "Nashik"
                  "billing_state" => "Maharashtra"
                  "billing_zip" => "5422112"
                  "billing_country" => "India"
                  "billing_tel" => "213546879897"
                  "billing_email" => "shankar@webwingtechnologies.com"
                  "delivery_name" => "Shankar"
                  "delivery_address" => "Kathe Lane Dwarka Nashik"
                  "delivery_city" => "Nashik"
                  "delivery_state" => "Maharashtra"
                  "delivery_zip" => "5422112"
                  "delivery_country" => "India"
                  "delivery_tel" => "213546879897"
                  "merchant_param1" => ""
                  "merchant_param2" => ""
                  "merchant_param3" => ""
                  "merchant_param4" => ""
                  "merchant_param5" => ""
                  "vault" => "N"
                  "offer_type" => "null"
                  "offer_code" => "null"
                  "discount_value" => "0.0"
                  "mer_amount" => "1200.0"
                  "eci_value" => "null"
                  "retry" => "N"
                  "response_code" => "0"
                  "billing_notes" => ""
                  "trans_date" => "26/12/2016 11:03:55"
                  "bin_country" => "\x04\x04\x04\x04"
                ]

           */

        // For Other than Default Gateway
        $response = Indipay::gateway('CCAvenue')->response($request);

        $order_status = isset($response['order_status'])?$response['order_status']:'';

        if($order_status=='Success')
        {
            $order_id     = $response['order_id'];
            $tracking_id  = $response['tracking_id'];
            $payment_mode = $response['payment_mode'];

            

            //view()->share('invoiceDetails',$invoiceDetails);

           // $uniqueFileName = $invoiceDetails->order_id."_".date('ymd')."_Tax_Invoice.pdf";
            /*$pdf = PDF::loadView('front.tax_invoice');
            $pdf->save(public_path().'../uploads/invoices/'.$uniqueFileName);
            */


            
            $this->TransactionModel->where('order_id',$order_id)
                                   ->update(['payment_status'=>'paid','tracking_id'=>$tracking_id,'payment_mode'=>$payment_mode, 'invoice_path'=>'']);
            $billingDetails = [];                      
            $billingDetails['order_id'] = $order_id;                      
            $billingDetails['billing_name'] = $response['billing_name'];                      
            $billingDetails['billing_address'] = $response['billing_address'];                      
            $billingDetails['billing_city'] = $response['billing_city'];                      
            $billingDetails['billing_state'] = $response['billing_state'];                      
            $billingDetails['billing_zip'] = $response['billing_zip'];                      
            $billingDetails['billing_country'] = $response['billing_country'];                      
            $billingDetails['billing_tel'] = $response['billing_tel'];                      
            $billingDetails['billing_email'] = $response['billing_email'];                      
            $billingDetails['delivery_name'] = $response['delivery_name'];                      
            $billingDetails['delivery_address'] = $response['delivery_address'];                      
            $billingDetails['delivery_city'] = $response['delivery_city'];                      
            $billingDetails['delivery_state'] = $response['delivery_state'];                      
            $billingDetails['delivery_zip'] = $response['delivery_zip'];                      
            $billingDetails['delivery_country'] = $response['delivery_country'];                      
            $billingDetails['delivery_tel'] = $response['delivery_tel'];   

            $this->TransactionBillingDetailsModel->create($billingDetails);
            /*Mail for successfull purchase*/
            $transaction_detail =  $this->TransactionModel->where('order_id',$order_id)->first();
            if($transaction_detail)
            {
                $arr_transaction_detail = []; 
                $arr_transaction_detail = $transaction_detail->toArray();
                $user_id = $arr_transaction_detail['user_id'];
                $arr_user_details = [];
                $obj_user_details = $this->UserModel->where('id',$user_id)->first();
                if($obj_user_details)
                {
                    $arr_user_details = $obj_user_details->toArray();
                }
                
              $email_id = isset($arr_user_details['email'])?$arr_user_details['email']:'';
              $data['name'] = ucfirst(isset($arr_user_details['first_name'])?$arr_user_details['first_name']:'');
              $data['email_id'] = isset($arr_user_details['email'])?$arr_user_details['email']:'';
              $data['arr_transaction_detail'] = $arr_transaction_detail;
              $project_name = config('app.project.name');
              $mail_from = $this->mail_from;
              $data['unique_id'] = uniqid();
              //$pathToFile = url('/').'/uploads/invoices/'.$uniqueFileName;

              
              /*$review = $this->ReviewRatingModel->create(['unique_id'=>$data['unique_id'],'order_id'=>$order_id]);
              if($review)
              {*/
                $invoiceDetails = $this->TransactionModel->with(['transaction_history' => function($query){
                  $query->orderBy('item_price','ASC');
              }])->where(['order_id'=>$order_id])->first()->toArray();

                $sent = Mail::send('front.email.tax_invoice', $invoiceDetails, function ($message) 
                  use ($email_id,$mail_from,$project_name) 
                  {
                        $message->from($mail_from, $project_name);
                        $message->subject($project_name.':Successfull Transaction.');
                        $message->to($email_id);
                        //$message->attach($pathToFile);
                  });
               

                //$fail = Mail::failures();

                //if( ! $sent) dd($fail);
                //dd("send");
              /*}*/
            }
            return view('front.thank_you');                       
        }  
        else
        {
            return view('front.error_transaction');
        }
    }

    public function purchased_tickets(Request $request)
    {
        $user = Sentinel::check();
        /*if($user==false || $user->inRole('admin'))
        {
            $arr_response['status'] = 'error';
            $arr_response['msg']  = 'Please do login first.';
            return response()->json($arr_response);
        }*/
        $unique_id    = $request->input('ticket_unique_id');
        $interview_id = base64_decode($request->input('id'));
        $arr_data     = $request->input('arr_data').','.$request->input('prev_arr_data');
        $realtime_id  = explode(',', $arr_data);
        
        foreach ($realtime_id as $value) 
        {
            $create_data = [];
            $create_data['interview_id']=$interview_id;
            $create_data['rwe_purchase_id']=$unique_id;
            $create_data['rew_id']=$value;
            $tickets=$this->PurchasedTicketModel->create($create_data);
        }
        if($tickets)
        {
            $arr_response['status'] = 'success';
            $arr_response['msg']    = 'succesfully stored your selected data';
            $arr_response['ticket_unique_id'] = encrypt($unique_id);
            return response()->json($arr_response);
        }
        else
        {
            $arr_response['status'] = 'error';
            $arr_response['msg']    = 'Error occured while storing your request please try again';
            return response()->json($arr_response); 
        }
    }
}
