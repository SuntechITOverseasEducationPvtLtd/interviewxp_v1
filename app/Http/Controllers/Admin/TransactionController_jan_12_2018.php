<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use App\Models\PurchaseHistoryModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Carbon\Carbon;
use Flash;
use Validator;
use Sentinel;
use File;
use Excel;
class TransactionController extends Controller
{
   public function __construct(TransactionModel $transaction,
   							              PurchaseHistoryModel $purchase_history,
                              ActivityLogsModel $activity_logs
                              )
   {
   		$this->TransactionModel     = $transaction;
      $this->BaseModel            = $this->TransactionModel;
   		$this->PurchaseHistoryModel = $purchase_history;
   		$this->module_view_folder   = 'admin.transaction';
   		$this->arr_view_data        = [];
   		$this->module_title         = "Transactions";
   		$this->module_url_path      = url(config('app.project.admin_panel_slug')."/transactions");
      /*For Activity log*/
      $this->obj_data             = Sentinel::getUser();
      $this->first_name           = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
      $this->last_name            = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
      $this->ip_address           = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
   		$this->theme_color          = theme_color();
   } 

   public function sales()
   {
   	    $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','purchase_history.interview_detail','member_detail','user_detail'])
                                 ->where('payment_status','=','paid')
                                 ->orderBy('id','desc')
                                 ->get();
   	    if($obj_transaction)
   	    {
   	    	$arr_transaction = $obj_transaction->toArray();
   	    }
        //dd($currentdate);
        $this->arr_view_data['page_title']      = 'Sales Report';
   	    $this->arr_view_data['module_url_path'] = $this->module_url_path;
   	    $this->arr_view_data['module_title']    = 'Sales';
   	    $this->arr_view_data['arr_transaction'] = $arr_transaction;
   	    $this->arr_view_data['theme_color']     = $this->theme_color;
        
        return view('admin.transaction.sales',$this->arr_view_data);
   }
   public function view_transaction_detail($transaction_id)
   {
   		$trans_id = base64_decode($transaction_id);
   		$obj_transaction= $this->TransactionModel
                                ->with(['purchase_history','purchase_history.interview_detail','member_detail','user_detail'])
                                ->where('payment_status','=','paid') 
                                ->where('id',$trans_id)
                                ->first();
   	    if($obj_transaction)
   	    {
   	    	$arr_transaction = $obj_transaction->toArray();
   	    }
   	    //dd($arr_transaction);
          $purchase_history_count = count($arr_transaction['purchase_history']);
          $reference_book_bought  = $arr_transaction['purchase_history'][0]['reference_book'];
          $ticket_name            = $arr_transaction['purchase_history'][0]['ticket_name']; 
   	    //dd($reference_book_bought);
         $this->arr_view_data['page_title']             = 'Transaction Details';
         $this->arr_view_data['module_url_path']        = $this->module_url_path;
         $this->arr_view_data['module_title']           = $this->module_title;
         $this->arr_view_data['arr_data']               = $arr_transaction;
         $this->arr_view_data['theme_color']            = $this->theme_color;
         $this->arr_view_data['reference_book_bought']  = $reference_book_bought;
         $this->arr_view_data['ticket_name']            = $ticket_name; 
         $this->arr_view_data['purchase_history_count'] = $purchase_history_count;

         return view('admin.transaction.view',$this->arr_view_data);	
   }
   public function member_payments()
   {
      $obj_transaction= $this->TransactionModel
                             ->with(['purchase_history','purchase_history.interview_detail','member_detail','user_detail'])
                             ->where('payment_status','paid')
                             ->orderBy('id','desc')
                             ->get();
      if($obj_transaction)
      {
         $arr_transaction = $obj_transaction->toArray();
      }
       
      $currentdate=date('Y-m-d H:i:s');
       
      foreach($arr_transaction as $key => $details) 
      {
         $member_amount     = $details['member_amount'];
         $member_tax_amount = ($member_amount*10/100);
         $after_tax_amount = $member_amount-$member_tax_amount;
         $arr_transaction[$key]['member_tax_amount'] = $member_tax_amount;
         $arr_transaction[$key]['after_tax_amount'] = $after_tax_amount;
         $arr_transaction[$key]['interview_count'] = count($details['purchase_history']);
         $arr_transaction[$key]['ticket_name'] = $details['purchase_history'][0]['ticket_name'];
      }

      $result = $this->TransactionModel->where('end_date','<',$currentdate)->where('member_payment_status','Dont Pay')->update(['member_payment_status'=>'Pay']);

      $this->arr_view_data['page_title']      = 'Manage Payments';
      $this->arr_view_data['module_url_path'] = $this->module_url_path;
      $this->arr_view_data['module_title']    = 'Payments';
      $this->arr_view_data['arr_transaction'] = $arr_transaction;
      $this->arr_view_data['theme_color']     = $this->theme_color;
      $this->arr_view_data['currentdate']     = $currentdate;
        
      return view('admin.transaction.payments',$this->arr_view_data);
   }

   public function sales_report(Request $request)
   {
      //dd($request->all());  $request->input('id')

      $start_dt = $request->input('start_date');
      $end_dt   = $request->input('end_date');

      $start_date = date("Y-m-d",strtotime($start_dt));
      $end_date = date("Y-m-d",strtotime($end_dt));

      //dd($start_date.' to '.$end_date);

      $arr_sales_report = [];
      $obj_sales_report = $this->TransactionModel
                               ->with(['purchase_history','purchase_history.interview_detail','member_detail','user_detail'])
                               ->whereBetween('created_at', array($start_date, $end_date))
                               ->get(); 
      if($obj_sales_report)
      {
         $arr_sales_report = $obj_sales_report->toArray();
      }                          
      dd($arr_sales_report);


   }


    public function comment($enc_id)
    {
        $trans_id = base64_decode($enc_id);
        $arr_trans_info=[];
       
        $obj_trans_info = $this->TransactionModel->where('id',$trans_id)->first();
        if($obj_trans_info)
        {
            $arr_trans_info = $obj_trans_info->toArray();
        }

        $this->arr_view_data['enc_id']              = $enc_id;
        $this->arr_view_data['arr_trans_info']     = $arr_trans_info;
        $this->arr_view_data['page_title']          = 'Admin Comment';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        return view($this->module_view_folder.'.comment',$this->arr_view_data);

    }

    public function store_comment(Request $request)
    {
        $arr_rules['comment']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $trans_id = base64_decode($request->input('enc_id'));
        $comment = $request->input('comment');
        
        $comment = $this->TransactionModel->where('id',$trans_id)->update(['member_comment'=>$comment]);
        if($comment)
        {
            Flash::success('Admin comment added Successfully.');
        }
        else
        {
            Flash::error('Error occur while storing admin comment.');
        }
        return redirect()->back();
    }
    public function updatepayment($enc_id)
    {  
        $trans_id = base64_decode($enc_id);
        $status = $this->TransactionModel->where('id',$trans_id)->update(['member_payment_status'=>'Paid']);
        if($status)
        {
            Flash::success('Payment was paid to the member.');
        }
        else
        {
            Flash::error('Error occur while paying to the member.');
        }
        return redirect()->back();
    }

    public function sales_data(Request $request)
    {
        $arr_rules =array();
        $arr_rules['from_sales_date'] = 'required';
        $arr_rules['to_sales_date']   = 'required';
      

      $validator = Validator::make($request->all(),$arr_rules);
      if($validator->fails())
      {
          return redirect()->back()->withErrors($validator)->withInput();
      }

      $start_dt = $request->input('from_sales_date');
      $end_dt   = $request->input('to_sales_date');

      $start_date = date("Y-m-d",strtotime($start_dt));
      $end_date = date("Y-m-d",strtotime($end_dt.'+1 days'));

      $arr_sales_report = $arr_data = [];
      $obj_sales_report = $this->TransactionModel
                               ->with(['purchase_history','purchase_history.interview_detail','member_detail','user_detail'])
                               ->where('payment_status','paid')
                               ->whereBetween('created_at', array($start_date, $end_date))
                               ->get();

      if($obj_sales_report)
      {
           $arr_sales_report = $obj_sales_report->toArray();
      }  
         
      if(isset($arr_sales_report) && sizeof($arr_sales_report)>0)
      {
        foreach($arr_sales_report  as $key => $data)
        {
          $arr_data[$key]['Sr.No'] = $key+1;
          if(isset($data['created_at']))
          {
            $date=date('d M Y', strtotime($data['created_at']));
            $arr_data[$key]['Date'] = $date;
          }
          if(isset($data['user_detail']['first_name']) && isset($data['user_detail']['last_name']))
          {
              $name = ucfirst($data['user_detail']['first_name']).' '.ucfirst($data['user_detail']['last_name']);
              $arr_data[$key]['Name'] = $name;
          }
          if(isset($data['user_detail']['email']))
          {
            $email = $data['user_detail']['email'];
            $arr_data[$key]['Email'] = $email;
          }
          if(isset($data['user_detail']['mobile_no']))
          {
            $mobile_no = $data['user_detail']['mobile_no'];
            $arr_data[$key]['Mobile no'] = $mobile_no;
          }
          if(isset($data['user_detail']['gender']))
          {
            if($data['user_detail']['gender']=='M')
            {
              $gender = 'Male';
            }
            if($data['user_detail']['gender']=='F')
            {
              $gender = 'Female';
            }
            $arr_data[$key]['Gender'] = $gender;
          }

          if(isset($data['experience_level']))
          {
            $experience_level=$data['experience_level'];
            $arr_data[$key]['Experience Level'] = $experience_level;
          }
          if(isset($data['skill_name']))
          {
            $skill_name=$data['skill_name'];
            $arr_data[$key]['Skill_name'] = $skill_name;
          }
          if(isset($data['grand_total']))
          {
            $amount=$data['grand_total'];
            $arr_data[$key]['Amount'] = $amount;
          }

        }

      }

      else
      {
        Flash::error('No Records for the date you have selected so cannot generate excel sheet.');
        return redirect()->back();
      }
      $sales_report = $arr_data;
        return Excel::create('Sales Report', function($excel) use ($sales_report)
        {
          $excel->sheet('sheet1', function($sheet) use ($sales_report) 
          {
            $sheet->fromArray($sales_report);
          });
        })->download('xls');
      }
                          
    public function delete($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_delete(base64_decode($enc_id)))
        {   
            Flash::success(str_singular($this->module_title).' Deleted Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).' Deletion!!! ');
        }

        return redirect()->back();
    }
    
    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action'] = "required";
        $arr_rules['checked_record'] = "required";


        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.str_plural($this->module_title) .' To Perform Multi Actions');  
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action = $request->input('multi_action');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error','Problem Occured, While Doing Multi Action');
            return redirect()->back();

        }

        
        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               $this->perform_delete(base64_decode($record_id));    
               Flash::success(str_plural($this->module_title).' Deleted Successfully!!!'); 
            } 
            
        }

        return redirect()->back();
    }

    public function perform_delete($id)
    {
       $delete_success = $this->BaseModel->where('id',$id)->delete();
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

       return $delete_success;    
    } 


}
