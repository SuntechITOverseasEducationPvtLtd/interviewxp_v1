<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use App\Models\TransactionHistoryModel;
use App\Models\PurchaseHistoryModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Carbon\Carbon;
use Flash;
use Validator;
use Sentinel;
use File;
use Excel;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TransactionController extends Controller
{
   public function __construct(TransactionModel $transaction,
                              PurchaseHistoryModel $purchase_history,
   							              TransactionHistoryModel $transaction_history,
                              ActivityLogsModel $activity_logs
                              )
   {
   		$this->TransactionModel     = $transaction;
      $this->BaseModel            = $this->TransactionModel;
      $this->PurchaseHistoryModel = $purchase_history;
   		$this->TransactionHistoryModel = $transaction_history;
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

   public function salesOld()
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

   public function sales($fromdate, $todate)
   {
        $fdate = date('Y-m-d 00:00:00',strtotime(base64_decode($fromdate)));
        $tdate = date('Y-m-d 23:59:59',strtotime(base64_decode($todate)));
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $pageSize = 10;
        
        $sqlQuery ="SELECT  t.id as transaction_id,t.*,ud.*,md.*,u.*,s.*,t.created_at, IF(md.user_id != '', 'Member', 'User') as user_type FROM `transaction` t
                  INNER JOIN interview_detail id ON id.interview_id = t.ref_interview_id
                  INNER JOIN users u ON u.id = t.user_id
                  INNER JOIN skills s ON s.id = t.skill_id
                  LEFT JOIN user_detail ud ON ud.user_id = t.user_id
                  LEFT JOIN member_detail md ON md.user_id = t.user_id
                  WHERE t.payment_status='paid' and t.created_at BETWEEN '".$fdate."' and '".$tdate."' GROUP BY t.id
                 ORDER BY transaction_id DESC";
        $obj_transaction = DB::select($sqlQuery);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($obj_transaction);
        
        $perPage = 1200;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage,$page ,['path' => url('/admin/transactions/sales/'.$fromdate.'/'.$todate)]);

        //print_r($obj_transaction[2]); die;
       
        return view('admin.transaction.tot_sales', [
            'arr_transaction' => $entries,
            'theme_color' => $this->theme_color,
            'module_url_path' => $this->module_url_path,
            'module_title' => 'Sales',
            'page_title' => 'Sales Report',
        ]);
        
        //return view('admin.transaction.tot_sales',$this->arr_view_data);
   }

   public function totalSales()
   {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $dateRange = [];
        $toYear = date('Y');
        $fromYear = 2017;

        for($i=$toYear; $i>=$fromYear; $i--)
        {
            $months = ($i == date('Y')) ? date('m') : 12;
            for($k=$months; $k>=1; $k--)
            {
               $date = $i.'-'.$k.'-01';
               $dateRange[$i.$k][] = date('Y-m-01', strtotime($date));
               $dateRange[$i.$k][] = date('Y-m-t', strtotime($date));
               if($i == date('Y') && $k == date('m'))
               {
                  $dateRange[$i.$k][] = '12:00 AM IST '.date('01-M-Y').' to 11:59 PM IST '.date('d-M-Y');
				  $fdate = date('Y-m-01 00:00:00');
				  $tdate = date('Y-m-d 23:59:59');
               }
               else
               {
                  $dateRange[$i.$k][] = '12:00 AM IST '.date('01-M-Y', strtotime($date)).' to 11:59 PM IST '.date('t-M-Y', strtotime($date));
				  $fdate = date('Y-m-01 00:00:00', strtotime($date));
				  $tdate = date('Y-m-t 23:59:59', strtotime($date));
               }
			   
			   $tot_data_transaction = [];

				$tot_obj_transaction= $this->TransactionModel
									 ->select(['transaction.*', DB::raw('SUM(base_price) as base_price'), DB::raw('SUM(igst_amount) as igst_amount'), DB::raw('SUM(cgst_amount) as cgst_amount'), DB::raw('SUM(sgst_amount) as sgst_amount'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(admin_amount) as admin_amount'), DB::raw('SUM(member_amount) as member_amount'), DB::raw('SUM(tds_percent) as tds_percent'), DB::raw('count(tds_percent) as tds_percent_count')]) 
									 ->with(['all_interview_detail'=>function($query){
										$query->select(['*',DB::raw('COUNT(skill_id) as no_of_skills')]);
									  $query->groupBy('user_id');
									 },'member_detail'])
									 ->where('payment_status','paid')
									 ->whereBetween('created_at', array($fdate, $tdate))
									 ->orderBy('id','desc')
									 ->first();
									  
				if($tot_obj_transaction)
				{
				 $tot_data_transaction = $tot_obj_transaction->toArray();
				}
				
				if(!empty($tot_data_transaction['id']) && !is_null($tot_data_transaction['id']))
				{
					$member_amount     = $tot_data_transaction['member_amount'];
					$tds_percent     = $tot_data_transaction['tds_percent']/$tot_data_transaction['tds_percent_count'];
					$member_tax_amount = ($member_amount*$tds_percent/100);
					$after_tax_amount = $member_amount-$member_tax_amount;
					$tot_data_transaction['member_tax_amount'] = $member_tax_amount;
					$tot_data_transaction['after_tax_amount'] = $after_tax_amount;
					
					$dateRange[$i.$k][] = $tot_data_transaction['base_price'];					
					$dateRange[$i.$k][] = $tot_data_transaction['grand_total'];					
					$dateRange[$i.$k][] = $tot_data_transaction['igst_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['cgst_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['sgst_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['member_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['admin_amount'];					
					$dateRange[$i.$k][] = $member_tax_amount;
					$dateRange[$i.$k][] = $after_tax_amount;
				}
				else
				{					
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
				}

               
            }
            
        }
		
		
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($dateRange);
        
        $perPage = 1000;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage,$page ,['path' => url('/admin/transactions/total-sales')]);
                                 
        return view('admin.transaction.tot_sales_by_range', [
            'entries' => $entries,
            'theme_color' => $this->theme_color,
            'module_url_path' => $this->module_url_path,
            'module_title' => 'Sales',
            'page_title' => 'Sales Report',
        ]);
        
        //return view('admin.transaction.tot_sales_by_range', $this->arr_view_data);
        //return view('admin.transaction.tot_sales',$this->arr_view_data);
   }
   public function view_transaction_detail($order_id)
   {
   		$order_id = base64_decode($order_id);
   		$obj_transaction= $this->TransactionModel
                                ->with(['interview_detail','member_detail','user_detail','skills'])
                                ->where('payment_status','=','paid') 
                                ->where('order_id',$order_id)
                                ->first();
   	    if($obj_transaction)
   	    {
   	    	$arr_transaction = $obj_transaction->toArray();
   	    }
   	    //dd($obj_transaction);
        //dd($reference_book_bought);
         $this->arr_view_data['page_title']             = 'Transaction Details';
         $this->arr_view_data['module_url_path']        = $this->module_url_path;
         $this->arr_view_data['module_title']           = $this->module_title;
         $this->arr_view_data['arr_data']               = $arr_transaction;
         $this->arr_view_data['theme_color']            = $this->theme_color;

         return view('admin.transaction.view',$this->arr_view_data);	
   }
   public function totalPayments()
   {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $dateRange = [];
        $toYear = date('Y');
        $fromYear = 2017;

        for($i=$toYear; $i>=$fromYear; $i--)
        {
            $months = ($i == date('Y')) ? date('m') : 12;
            for($k=$months; $k>=1; $k--)
            {
               $date = $i.'-'.$k.'-01';
               $dateRange[$i.$k][] = date('Y-m-01', strtotime($date));
               $dateRange[$i.$k][] = date('Y-m-t', strtotime($date));
               if($i == date('Y') && $k == date('m'))
               {
                  $dateRange[$i.$k][] = '12:00 AM IST '.date('01-M-Y').' to 11:59 PM IST '.date('d-M-Y');
				  $fdate = date('Y-m-01 00:00:00');
				  $tdate = date('Y-m-d 23:59:59');
               }
               else
               {
                  $dateRange[$i.$k][] = '12:00 AM IST '.date('01-M-Y', strtotime($date)).' to 11:59 PM IST '.date('t-M-Y', strtotime($date));
				  $fdate = date('Y-m-01 00:00:00', strtotime($date));
				  $tdate = date('Y-m-t 23:59:59', strtotime($date));
               }
			   
			   $tot_data_transaction = [];

				$tot_obj_transaction= $this->TransactionModel
									 ->select(['transaction.*', DB::raw('SUM(base_price) as base_price'), DB::raw('SUM(igst_amount) as igst_amount'), DB::raw('SUM(cgst_amount) as cgst_amount'), DB::raw('SUM(sgst_amount) as sgst_amount'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(admin_amount) as admin_amount'), DB::raw('SUM(member_amount) as member_amount'), DB::raw('SUM(tds_percent) as tds_percent'), DB::raw('count(tds_percent) as tds_percent_count')]) 
									 ->with(['all_interview_detail'=>function($query){
										$query->select(['*',DB::raw('COUNT(skill_id) as no_of_skills')]);
									  $query->groupBy('user_id');
									 },'member_detail'])
									 ->where('payment_status','paid')
									 ->whereBetween('created_at', array($fdate, $tdate))
									 ->orderBy('id','desc')
									 ->first();
									  
				if($tot_obj_transaction)
				{
				 $tot_data_transaction = $tot_obj_transaction->toArray();
				}
				
				if(!empty($tot_data_transaction['id']) && !is_null($tot_data_transaction['id']))
				{
					$member_amount     = $tot_data_transaction['member_amount'];
					$tds_percent     = $tot_data_transaction['tds_percent']/$tot_data_transaction['tds_percent_count'];
					$member_tax_amount = ($member_amount*$tds_percent/100);
					$after_tax_amount = $member_amount-$member_tax_amount;
					$tot_data_transaction['member_tax_amount'] = $member_tax_amount;
					$tot_data_transaction['after_tax_amount'] = $after_tax_amount;
					
					$dateRange[$i.$k][] = $tot_data_transaction['base_price'];					
					$dateRange[$i.$k][] = $tot_data_transaction['grand_total'];					
					$dateRange[$i.$k][] = $tot_data_transaction['igst_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['cgst_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['sgst_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['member_amount'];
					$dateRange[$i.$k][] = $tot_data_transaction['admin_amount'];					
					$dateRange[$i.$k][] = $member_tax_amount;
					$dateRange[$i.$k][] = $after_tax_amount;
				}
				else
				{					
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
					$dateRange[$i.$k][] = 0;
				}
				
               
            }
            
        }
		
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = new Collection($dateRange);
        
        $perPage = 1000;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage,$page ,['path' => url('/admin/transactions/total-payments')]);
                                 
        return view('admin.transaction.tot_payments_by_range', [
            'entries' => $entries,
            'theme_color' => $this->theme_color,
            'module_url_path' => $this->module_url_path,
            'module_title' => 'Payments',
            'page_title' => 'Payments Report',
        ]);
        
        //return view('admin.transaction.tot_sales_by_range', $this->arr_view_data);
        //return view('admin.transaction.tot_sales',$this->arr_view_data);
   }
   public function total_member_payments($user_id, $fromdate, $todate)
   {
      $user_id = base64_decode($user_id);
      $fdate = date('Y-m-d 00:00:00',strtotime(base64_decode($fromdate)));
      $tdate = date('Y-m-d 23:59:59',strtotime(base64_decode($todate)));
      $tot_data_transaction = [];

      $tot_obj_transaction= $this->TransactionModel
                             ->select(['transaction.*', DB::raw('SUM(base_price) as base_price'), DB::raw('SUM(igst_amount) as igst_amount'), DB::raw('SUM(cgst_amount) as cgst_amount'), DB::raw('SUM(sgst_amount) as sgst_amount'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(admin_amount) as admin_amount'), DB::raw('SUM(member_amount) as member_amount'), DB::raw('SUM(tds_percent) as tds_percent'), DB::raw('count(tds_percent) as tds_percent_count')]) 
                             ->with(['all_interview_detail'=>function($query){
                                $query->select(['*',DB::raw('COUNT(skill_id) as no_of_skills')]);
                              $query->groupBy('user_id');
                             },'member_detail'])
                             ->where('payment_status','paid')
                             ->where('member_user_id','=', $user_id)
                             ->whereBetween('created_at', array($fdate, $tdate))
                             ->groupBy('member_user_id')
                             ->orderBy('id','desc')
                             ->first();
                              
      if($tot_obj_transaction)
      {
         $tot_data_transaction = $tot_obj_transaction->toArray();
      }

		$member_amount     = $tot_data_transaction['member_amount'];
		$tds_percent     = $tot_data_transaction['tds_percent']/$tot_data_transaction['tds_percent_count'];
		$member_tax_amount = ($member_amount*$tds_percent/100);
		$after_tax_amount = $member_amount-$member_tax_amount;
		$tot_data_transaction['member_tax_amount'] = $member_tax_amount;
		$tot_data_transaction['after_tax_amount'] = $after_tax_amount;
      $obj_transaction= $this->TransactionModel
                             ->with(['all_interview_detail','member_detail'])
                             ->where('payment_status','paid')
                             ->where('member_user_id','!=','')
                             ->where('member_user_id', $user_id)
                             ->whereBetween('created_at', array($fdate, $tdate))
                             ->orderBy('id','desc')
                             ->paginate(15);
            
      $currentdate=date('Y-m-d H:i:s'); 
      foreach($obj_transaction as $key => $details) 
      {
         $member_amount     = $details['member_amount'];
		 $tds_percent = $details['tds_percent'];
         $member_tax_amount = ($member_amount*$tds_percent/100);
         $after_tax_amount = $member_amount-$member_tax_amount;
         $obj_transaction[$key]['member_tax_amount'] = $member_tax_amount;
         $obj_transaction[$key]['after_tax_amount'] = $after_tax_amount;
      }
      
      $this->arr_view_data['page_title']      = 'Manage Payments';
      $this->arr_view_data['module_url_path'] = $this->module_url_path;
      $this->arr_view_data['module_title']    = 'Payments';
      $this->arr_view_data['arr_transaction'] = $obj_transaction;
      $this->arr_view_data['theme_color']     = $this->theme_color;
      $this->arr_view_data['currentdate']     = $currentdate;
      $this->arr_view_data['fromdate']     = $fdate;
      $this->arr_view_data['todate']     = $tdate;
      $this->arr_view_data['tot_data_transaction']     = $tot_data_transaction;

        
      return view('admin.transaction.member_payments',$this->arr_view_data);
   }
   public function refundPayment(Request $request)
   {
      $trans_id = base64_decode($request->input('transId'));
      $trans_history_id = base64_decode($request->input('inputId'));
      $combo_status = base64_decode($request->input('combo_status'));

      if($combo_status == 1)
      {
        $transactionHistoryData = $this->TransactionHistoryModel->where(['trans_id'=>$trans_id, 'combo_status'=>1])->get();
        foreach ($transactionHistoryData as $key => $value) {          
          $transactionData = $this->TransactionModel->where('id',$trans_id)->first();
          $transactionData->base_price = $transactionData->base_price - $value->item_price;
          $transactionData->igst_amount = $transactionData->igst_amount - $value->igst;
          $transactionData->cgst_percent = $transactionData->cgst_percent - $value->cgst;
          $transactionData->sgst_amount = $transactionData->sgst_amount - $value->sgst;
          $transactionData->grand_total = $transactionData->grand_total - $value->item_price - $value->igst - $value->cgst - $value->sgst;
          $transactionData->admin_amount = $transactionData->admin_amount-(($value->item_price*$transactionData->admin_commission)/100);
          $transactionData->member_amount = $transactionData->member_amount-(($value->item_price*(100-$transactionData->admin_commission))/100);
          $transactionData->save();

          $value->payment_sign = '-';
          $value->member_commission = '0.00';
          $value->admin_commission = '0.00';
          $value->payment_status = 'refunded';
          $value->save();

        }
      }
      else
      {
        $transactionHistoryData = $this->TransactionHistoryModel->where('id',$trans_history_id)->first();
        $transactionData = $this->TransactionModel->where('id',$trans_id)->first();
        $transactionData->base_price = $transactionData->base_price - $transactionHistoryData->item_price;
        $transactionData->igst_amount = $transactionData->igst_amount - $transactionHistoryData->igst;
        $transactionData->cgst_percent = $transactionData->cgst_percent - $transactionHistoryData->cgst;
        $transactionData->sgst_amount = $transactionData->sgst_amount - $transactionHistoryData->sgst;
        $transactionData->grand_total = $transactionData->grand_total - $transactionHistoryData->item_price - $transactionHistoryData->igst - $transactionHistoryData->cgst - $transactionHistoryData->sgst;
        $transactionData->admin_amount = $transactionData->admin_amount-(($transactionHistoryData->item_price*$transactionData->admin_commission)/100);
        $transactionData->member_amount = $transactionData->member_amount-(($transactionHistoryData->item_price*(100-$transactionData->admin_commission))/100);
        $transactionData->save();

        $transactionHistoryData->payment_sign = '-';
		$transactionHistoryData->member_commission = '0.00';
	    $transactionHistoryData->admin_commission = '0.00';
        $transactionHistoryData->payment_status = 'refunded';
        $transactionHistoryData->save();
      }

      return redirect()->back();
      
   }
    public function payMemberPayment(Request $request)
   {
      $trans_id = base64_decode($request->input('transId'));
      $member_user_id = base64_decode($request->input('inputId'));
      $fromdate = base64_decode($request->input('fd'));
      $todate = base64_decode($request->input('td'));
	  $member_payments_img_path   = base_path().'/uploads/member_payments/';
	  //dd($member_payments_img_path);

      $totTransactionData = $this->TransactionModel->where(['member_user_id'=>$member_user_id])->whereBetween('created_at', array($fromdate, $todate))->get(); 
	  $file_name      = "";
      foreach ($totTransactionData as $key => $transactionData) {  

        if($transactionData->member_payment_status == 'Pay')
        {
          $transactionData->member_payment_status = 'Paid';
		  if($key == 0)
		  {
			
			if($request->hasFile('payment_img'))
			{	
				$fileExtension = strtolower($request->file('payment_img')->getClientOriginalExtension()); 
				$arr_file_types = ['jpg','jpeg','png','bmp','pdf'];

				if(in_array($fileExtension, $arr_file_types))
				{
					$file_name      = $request->input('payment_img');
					$file_extension = strtolower($request->file('payment_img')->getClientOriginalExtension()); 
					$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
					$request->file('payment_img')->move($member_payments_img_path, $file_name); 
				}
				else
				{
					Flash::error('Please upload valid image with jpg, jpeg ,png, pdf extension!!!');
					return redirect()->back();
				} 
			}
		  }
		  
			$transactionData->member_payment_ref_id = $request->input('RefId');
			$transactionData->member_payment_ref_comment = $request->input('inputComment');
			$transactionData->member_payment_ref_image = $file_name;
          $transactionData->save();
          $trans_id = $transactionData->id;

          $transactionHistoryData = $this->TransactionHistoryModel->where('trans_id',$trans_id)->get();
          foreach ($transactionHistoryData as $key => $value) {          
           
              $value->payment_status = 'paid';
              $value->save();
          } 
        }
      }
     
      return redirect()->back();
      
   }
   public function member_payments($fromdate, $todate)
   {
      $fdate = date('Y-m-d 00:00:00',strtotime(base64_decode($fromdate)));
      $tdate = date('Y-m-d 23:59:59',strtotime(base64_decode($todate)));
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $pageSize = 10;

      $obj_transaction= $this->TransactionModel
                             ->select(['transaction.*', DB::raw('SUM(base_price) as base_price'), DB::raw('SUM(igst_amount) as igst_amount'), DB::raw('SUM(cgst_amount) as cgst_amount'), DB::raw('SUM(sgst_amount) as sgst_amount'), DB::raw('SUM(grand_total) as grand_total'), DB::raw('SUM(member_amount) as member_amount'), DB::raw('SUM(admin_amount) as admin_amount'), DB::raw('SUM(tds_percent) as tds_percent'), DB::raw('count(tds_percent) as tds_percent_count')]) 
                             ->with(['all_interview_detail'=>function($query){
                                $query->select(['*',DB::raw('COUNT(skill_id) as no_of_skills')]);
                              $query->groupBy('user_id');
                             },'member_detail'])
                             ->where('payment_status','paid')
                             ->where('member_user_id','!=','')
                             ->whereBetween('created_at', array($fdate, $tdate))
                             ->groupBy('member_user_id')
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
         $tds_percent     = $details['tds_percent']/$details['tds_percent_count'];
         $member_tax_amount = ($member_amount*$tds_percent/100);
         $after_tax_amount = $member_amount-$member_tax_amount;
         $arr_transaction[$key]['member_tax_amount'] = $member_tax_amount;
         $arr_transaction[$key]['after_tax_amount'] = $after_tax_amount;
      }
      //dd($obj_transaction);
      $result = $this->TransactionModel->where('end_date','<',$currentdate)->where('member_payment_status','Dont Pay')->update(['member_payment_status'=>'Pay']);

      $this->arr_view_data['page_title']      = 'Manage Payments';
      $this->arr_view_data['module_url_path'] = $this->module_url_path;
      $this->arr_view_data['module_title']    = 'Payments';
      $this->arr_view_data['arr_transaction'] = $arr_transaction;
      $this->arr_view_data['theme_color']     = $this->theme_color;
      $this->arr_view_data['currentdate']     = $currentdate;
      $this->arr_view_data['fromdate']     = $fdate;
      $this->arr_view_data['todate']     = $tdate;
        
      return view('admin.transaction.tot_payments',$this->arr_view_data);
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
