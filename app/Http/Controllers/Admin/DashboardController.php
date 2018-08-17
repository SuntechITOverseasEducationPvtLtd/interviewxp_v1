<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
/*use App\Models\ContactEnquiryModel;*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\MemberInterviewModel;
use App\Models\RealtimeExperienceModel;
use App\Models\TransactionModel;
use App\Models\TransactionHistoryModel;
use App\Models\MultiReferenceBookModel;
use App\Models\InterviewDetailModel;
use App\Models\ReviewRatingModel;

use Charts;
use Sentinel;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DashboardController extends Controller
{
	public function __construct(MemberInterviewModel $member_interview,
								RealtimeExperienceModel $real_time_experience,
                                TransactionModel $transaction,
                                TransactionHistoryModel $transactionHistory,
                                MultiReferenceBookModel $multiple_reference_book,
                                InterviewDetailModel $interview_detail,
                                ReviewRatingModel $review_ratings
                                )
	{
		$this->arr_view_data      		= [];
		$this->module_title       		= "Dashboard";
		/*$this->ContactEnquiryModel= $contact_enquiry;*/
		$this->BaseModel          		= Sentinel::createModel();   // using sentinel for base model.
		$this->MemberInterviewModel 	= $member_interview;
		$this->RealtimeExperienceModel 	= $real_time_experience;
        $this->TransactionModel         = $transaction;
        $this->TransactionHistoryModel         = $transactionHistory;
        $this->MultiReferenceBookModel  = $multiple_reference_book;
        $this->InterviewDetailModel     = $interview_detail;
        $this->ReviewRatingModel     = $review_ratings;
		$this->module_view_folder 		= "admin.dashboard";
		$this->admin_url_path     		= url(config('app.project.admin_panel_slug'));
	}
   
    public function index()
    {
    	/*$obj_contact_enquiry                   = $this->ContactEnquiryModel->where('is_view',0)->count();*/
    	
    	$arr_tile_color  = array('tile-red','tile-green','tile-magenta','');

    	/*$this->arr_view_data['contact_enquiry']	 = $obj_contact_enquiry;*/
    	$arr_user_count = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
        							    ->count();

        $arr_member_count = $this->BaseModel->whereHas('roles',function($query)
        									  {
        									  	$query->where('slug','!=','admin');
        									  	$query->where('slug','!=','user');	
        									  })
        							        ->count();

        /*$multi_ref_book_pending = $this->MultiReferenceBookModel    
                            ->where('approve_status','=','0')
                            ->count();  

        $company_pending     = $this->InterviewDetailModel    
                            ->where('approve_status','=','0')
                            ->count();                                  

        $real_time_exp_approve_pending = $this->RealtimeExperienceModel    
                            ->where('approve_status','=','0')
                            ->count();                   						       

         $count_pending =  $multi_ref_book_pending + $company_pending + $real_time_exp_approve_pending; 
         */

        $reviewsCount = $this->ReviewRatingModel->count();     
        $skillsCount = $this->MemberInterviewModel->where('admin_approval',1)->count();     

        /*$multi_ref_book = $this->MultiReferenceBookModel    
                            ->where('approve_status','=','1')
                            ->count();  

        $company        = $this->InterviewDetailModel    
                            ->where('approve_status','=','1')
                            ->count();                                  

        $real_time_exp_approve = $this->RealtimeExperienceModel    
                            ->where('approve_status','=','1')
                            ->count();    

        $count_approve   =  $multi_ref_book + $company + $real_time_exp_approve;
        */     


	
         $tot_sales_sum = $this->TransactionModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
                                 //->sum('th.item_price','th.sgst','th.cgst','th.igst');

         $tot_revenue_sum = $this->TransactionModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->sum('t.admin_amount');                                	
        //dd($multi_ref_book);   

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
        
        $perPage = 10000;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $entries = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage,$page ,['path' => url('/admin/dashboard')]);                             
						     						   							           					    				  
    	$this->arr_view_data['page_title']       = $this->module_title;
    	$this->arr_view_data['admin_url_path']   = $this->admin_url_path;
    	$this->arr_view_data['arr_tile_color']   = $arr_tile_color;
    	$this->arr_view_data['arr_user_count']	 = $arr_user_count;
    	$this->arr_view_data['arr_member_count'] = $arr_member_count;
    	$this->arr_view_data['reviewsCount']    = $reviewsCount;
    	$this->arr_view_data['skillsCount']	 = $skillsCount;
        $this->arr_view_data['tot_sales_sum']    = $tot_sales_sum;
        //$this->arr_view_data['tot_revenue_sum']  = $tot_revenue_sum;  	
    	$this->arr_view_data['arr_final_tile']   = $this->built_dashboard_tiles();
        $this->arr_view_data['total_month_of_sales_count'] = $this->total_month_of_sales_count();
        $this->arr_view_data['total_no_of_coaches'] = $this->total_no_of_coaches();
        $this->arr_view_data['total_no_of_users'] = $this->total_no_of_users();
        $this->arr_view_data['total_no_of_reviews'] = $this->total_no_of_reviews();
    	$this->arr_view_data['total_no_of_skills'] = $this->total_no_of_skills();
        $this->arr_view_data['entries'] = $entries;

        //dd($this->arr_view_data);
    	$this->arr_view_data['chart'] 			 = Charts::database(UserModel::all(), 'pie', 'highcharts')
    	->elementLabel("Users")
    	->title('Users')
    	->dimensions(625, 375)
    	->responsive(true)
    	->groupByYear();

        $user_member_charts = Charts::create('bar', 'highcharts')
                                ->title('Users and Members')
                                ->labels(['Users', 'Members'])
                                ->elementLabel('Users and Members')
                                ->values([$arr_user_count,$arr_member_count])
                                ->dimensions(625,375)
                                ->responsive(true);
        $this->arr_view_data['user_member_charts'] = $user_member_charts;
    	return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function built_dashboard_tiles()
    {
    	/*------------------------------------------------------------------------------
    	| Note: Directly Use icon name - like, fa fa-user and use directly - 'user'
    	------------------------------------------------------------------------------*/
					
		$arr_final_tile[] = ['module_slug'  => 'account_settings',
							  'css_class'   => 'cog',
							  'module_title'=> 'Account Settings'];

		$arr_final_tile[] = ['module_slug'  => 'qualification',
							  'css_class'   => 'graduation-cap',
							  'module_title'=> 'Qualification'];					  
							  					  
		$arr_final_tile[] = ['module_slug'  => 'specialization',
							  'css_class'   => 'university',
							  'module_title'=> 'Specialization'];					  	
			  				  
		$arr_final_tile[] = ['module_slug'  => 'contact_enquiry',
							  'css_class'   => 'info-circle',
							  'module_title'=> 'Contact Enquirys'];

		$arr_final_tile[] = ['module_slug'  => 'users',
							  'css_class'   => 'users',
							  'module_title'=> 'Users'];

		$arr_final_tile[] = ['module_slug'  => 'members',
							  'css_class'   => 'users',
							  'module_title'=> 'Members'];					  					  							  					 					  

		return 	$arr_final_tile;						  
    }

    public function built_dashboard_tiles_userinfo()
    {
    	/*------------------------------------------------------------------------------
    	| Note: Directly Use icon name - like, fa fa-user and use directly - 'user'
    	------------------------------------------------------------------------------*/

    		$arr_final_count[] = ['module_slug'  => 'users',
							  'css_class'   => 'fa fa-users ',
							  'module_title'=> 'Users'];

		    return $arr_final_count;				  
    }

    public function total_no_of_skills()
    {
        $zero_two_count = $this->MemberInterviewModel->where('admin_approval',1)->where('experience_level','0-2')->count();
        $two_four_count = $this->MemberInterviewModel->where('admin_approval',1)->where('experience_level','2-4')->count();
        $five_ten_count = $this->MemberInterviewModel->where('admin_approval',1)->where('experience_level','5-10')->count();
        $ten_twenty_count = $this->MemberInterviewModel->where('admin_approval',1)->where('experience_level','10-20')->count();
        $na_count = $this->MemberInterviewModel->where('admin_approval',1)->where('experience_level','NA')->count();
         $response[] = [
                        'zero_two_count'   => $zero_two_count,
                        'two_four_count'   => $two_four_count,
                        'five_ten_count'   => $five_ten_count,
                        'ten_twenty_count'   => $ten_twenty_count,
                        'na_count'   => $na_count,
                     ];
                                        
        return $response;
    }

    public function total_no_of_reviews()
    {
        $five_star_count = $this->ReviewRatingModel->where('review_star',5)->count();
        $four_star_count = $this->ReviewRatingModel->where('review_star',4)->count();
        $three_star_count = $this->ReviewRatingModel->where('review_star',3)->count();
        $two_tar_count = $this->ReviewRatingModel->where('review_star',2)->count();
        $one_star_count = $this->ReviewRatingModel->where('review_star',1)->count();
         $response[] = [
                        'five_star_count'   => $five_star_count,
                        'four_star_count'   => $four_star_count,
                        'three_star_count'   => $three_star_count,
                        'two_tar_count'   => $two_tar_count,
                        'one_star_count'   => $one_star_count,
                     ];
                                        
        return $response;
    }
    public function total_no_of_users()
    {
        $current_date  = date('Y-m-d');
        $aciveUsersDate=Date('Y-m-d', strtotime("-90 days"));
        $active_users_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','member');  
                                              })
                                            ->where('is_deactivate',0)
                                            ->where('is_active',1)
                                            ->where('updated_at','>',$aciveUsersDate)->count();

        $inactive_users_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','member');  
                                              })
                                            ->where('is_deactivate',0)
                                            ->where('is_active',1)
                                            ->where('updated_at','<=',$aciveUsersDate)->count();

        $deactivated_users_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','member');  
                                              })
                                            ->where('is_deactivate',1)->count();

        $blocked_users_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','member');  
                                              })
                                            ->where('is_deactivate',0)
                                            ->where('is_active',0)
                                            ->where('last_login','!=','')->count();

        $purchaged_users_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','member');  
                                              })
                                            ->whereIn('id', function($query)
                                            {
                                                $query->select('transaction.user_id')
                                                      ->from('transaction')
                                                      ->whereRaw('transaction.user_id = users.id')
                                                      ->whereRaw('transaction.payment_status="paid"');
                                            })
                                            ->count();

        $notpurchaged_users_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','member');  
                                              })
                                            ->whereNotin('id', function($query)
                                            {
                                                $query->select('transaction.user_id')
                                                      ->from('transaction')
                                                      ->whereRaw('transaction.user_id = users.id')
                                                      ->whereRaw('transaction.payment_status="paid"');
                                            })
                                            ->count();

        $response[] = [
                        'active_users_count'   => $active_users_count,
                        'inactive_users_count'   => $inactive_users_count,
                        'deactivated_users_count'   => $deactivated_users_count,
                        'blocked_users_count'   => $blocked_users_count,
                        'purchaged_users_count'   => $purchaged_users_count,
                        'notpurchaged_users_count'   => $notpurchaged_users_count,
                     ];
                                        
        return $response;
    }
    public function total_no_of_coaches()
    {
        $current_date  = date('Y-m-d');
        $aciveUsersDate=Date('Y-m-d', strtotime("-90 days"));
        $active_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->where('is_deactivate',0)
                                            ->where('is_active',1)
                                            ->where('admin_status','Approved')
                                            ->where('updated_at','>',$aciveUsersDate)->count();

        $inactive_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->where('is_deactivate',0)
                                            ->where('is_active',1)
                                            ->where('admin_status','Approved')
                                            ->where('updated_at','<=',$aciveUsersDate)->count();

        $deactivated_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->where('is_deactivate',1)->count();

        $blocked_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->where('is_deactivate',0)
                                            ->where('is_active',0)
                                            ->where('admin_status','Approved')
                                            ->where('last_login','!=','')->count();

        $denied_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->where('admin_status','Denied')->count();

        $purchaged_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->whereIn('id', function($query)
                                            {
                                                $query->select('transaction.user_id')
                                                      ->from('transaction')
                                                      ->whereRaw('transaction.user_id = users.id')
                                                      ->whereRaw('transaction.payment_status="paid"');
                                            })
                                            ->count();

        $notpurchaged_coaches_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->whereNotin('id', function($query)
                                            {
                                                $query->select('transaction.member_user_id')
                                                      ->from('transaction')
                                                      ->whereRaw('transaction.member_user_id = users.id')
                                                      ->whereRaw('transaction.payment_status="paid"');
                                            })
                                            ->count();

        $response[] = [
                        'active_coaches_count'   => $active_coaches_count,
                        'inactive_coaches_count'   => $inactive_coaches_count,
                        'deactivated_coaches_count'   => $deactivated_coaches_count,
                        'blocked_coaches_count'   => $blocked_coaches_count,
                        'denied_coaches_count'   => $denied_coaches_count,
                        'purchaged_coaches_count'   => $purchaged_coaches_count,
                        'notpurchaged_coaches_count'   => $notpurchaged_coaches_count,
                     ];
                                        
        return $response;
    }
	
	public function total_month_of_sales_count()
    {
		$tot_coaching = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.item_type','=','Coach')
                                 ->where('th.combo_status','=',0)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
								 
		$tot_qa = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.item_type','=','Interview_qa')
                                 ->where('th.combo_status','=',0)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
	    
		$tot_companies = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.item_type','=','Company')
                                 ->where('th.combo_status','=',0)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
								 
		$tot_work_exp = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.item_type','=','Work_exp')
                                 ->where('th.combo_status','=',0)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
								 
		$tot_combo_qa = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.combo_type','=','Coach+Qa')
                                 ->where('th.combo_status','=',1)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
								 
		$tot_combo_companies = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.combo_type','=','Coach+Company')
                                 ->where('th.combo_status','=',1)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
								 
		$tot_combo_workexp = $this->TransactionHistoryModel->from('transaction as t')->join('transaction_history as th','th.trans_id','=','t.id')
                                 ->where('t.payment_status','=','paid')
                                 ->where('th.combo_type','=','Coach+Workexp')
                                 ->where('th.combo_status','=',1)
								 ->whereBetween('t.created_at',array(date('Y-m-01'),date('Y-m-t')))
                                 ->sum(DB::raw('th.item_price+th.sgst+th.cgst+th.igst'));
								 
		$total_month_of_sales_count[] = ['tot_coaching'   => $tot_coaching,
    						   			 'tot_qa'    => $tot_qa,
    						   			 'tot_companies'   => $tot_companies,
										 'tot_work_exp' => $tot_work_exp,
    						   			 'tot_combo_qa'  => $tot_combo_qa,
    						   			 'tot_combo_companies' => $tot_combo_companies,
    						   			 'tot_combo_workexp' => $tot_combo_workexp,
    						  			];
										
    	return $total_month_of_sales_count;						 
	}

    public function total_day_week_month_count()
    {
    	$current_date  = date('Y-m-d');
		$current_month = date('Y-m');

		$monday = strtotime("last monday");
		$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

		$sunday = strtotime(date("Y-m-d",$monday)." +7 days");

		$this_week_sd = date("Y-m-d",$monday);
		$this_week_ed = date("Y-m-d",$sunday);
		//dd( $this_week_sd.' to '.$this_week_ed);

		//USER........
		$user_count_today = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
         								->where('created_at','LIKE',$current_date.'%')
        							    ->count();

		$user_count_week = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
         								 ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
        							     ->count();	
        $user_count_month = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
         								->where('created_at','LIKE',$current_month.'%')
        							    ->count();	
        //MEMBER........

        $member_count_today = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','user');
                                        })
                                       /* ->orWhere('created_at','LIKE',$current_date.'%')*/
         								->Where('created_at','LIKE',$current_date.'%')
        							    ->count();

		$member_count_week = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','user');
                                        })
         								 ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
        							     ->count();	
        $member_count_month = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','user');
                                        })
         								->where('created_at','LIKE',$current_month.'%')
        							    ->count();

       // dd($member_count_today);                                
                                        
        //=========================================================================================================
         //PENDING MULTI REFERENCE BOOK...........

        $pending_multi_ref_book_day   = $this->MultiReferenceBookModel   
                                             ->where('approve_status','=','0')
                                             ->where('created_at','LIKE',$current_date.'%')
                                             ->count();

        $pending_multi_ref_book_week  = $this->MultiReferenceBookModel   
                                             ->where('approve_status','=','0')
                                             ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                                             ->count();                                  

        $pending_multi_ref_book_month = $this->MultiReferenceBookModel   
                                             ->where('approve_status','=','0')
                                             ->where('created_at','LIKE',$current_month.'%')
                                             ->count();
        //PENDING COMPANY................ 
        $company_pending_day         = $this->InterviewDetailModel  
                                             ->where('approve_status','=','0')
                                             ->where('created_at','LIKE',$current_date.'%')
                                             ->count();

        $company_pending_week        = $this->InterviewDetailModel  
                                             ->where('approve_status','=','0')
                                             ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                                             ->count();                                  

        $company_pending_month       = $this->InterviewDetailModel  
                                             ->where('approve_status','=','0')
                                             ->where('created_at','LIKE',$current_month.'%')
                                             ->count();

        // PENDING REAL TIME TICKET......................

        $ticket_pending_day         = $this->RealtimeExperienceModel 
                                             ->where('approve_status','=','0')
                                             ->where('created_at','LIKE',$current_date.'%')
                                             ->count();

        $ticket_pending_week        = $this->RealtimeExperienceModel  
                                             ->where('approve_status','=','0')
                                             ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                                             ->count();                                  

        $ticket_pending_month       = $this->RealtimeExperienceModel  
                                             ->where('approve_status','=','0')
                                             ->where('created_at','LIKE',$current_month.'%')
                                             ->count();   

        //PENDING INTERVIEW AND RWE TICKET........                                                         
        $count_pending_multirefbook_company_ticket_day = $pending_multi_ref_book_day + $company_pending_day  + $ticket_pending_day;

        $count_pending_multirefbook_company_ticket_week = $pending_multi_ref_book_week + $company_pending_week + $ticket_pending_week;

        $count_pending_multirefbook_company_ticket_month = $pending_multi_ref_book_month + $company_pending_month + $ticket_pending_month;
                                     

        //===========================================================================================================                                

        
		//APPROVE MULTI REFERENCE BOOK...........
		$member_multi_ref_book_day   = $this->MultiReferenceBookModel	
                            		         ->where('approve_status','=','1')
                            		         ->where('created_at','LIKE',$current_date.'%')
                            				 ->count();

        $member_multi_ref_book_week  = $this->MultiReferenceBookModel	
                            		         ->where('approve_status','=','1')
                            		         ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                            				 ->count();                    				 

        $member_multi_ref_book_month = $this->MultiReferenceBookModel	
                            		         ->where('approve_status','=','1')
                            		         ->where('created_at','LIKE',$current_month.'%')
                            				 ->count();
        //APPROVE COMPANY................ 
        $company_approve_day         = $this->InterviewDetailModel	
                            		         ->where('approve_status','=','1')
                            		         ->where('created_at','LIKE',$current_date.'%')
                            				 ->count();

        $company_approve_week        = $this->InterviewDetailModel	
                            		         ->where('approve_status','=','1')
                            		         ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                            				 ->count();                    				 

        $company_approve_month       = $this->InterviewDetailModel	
                            		         ->where('approve_status','=','1')
                            		         ->where('created_at','LIKE',$current_month.'%')
                            				 ->count();

        // APPROVE REAL TIME TICKET......................

        $ticket_approve_day         = $this->RealtimeExperienceModel 
                                             ->where('approve_status','=','1')
                                             ->where('created_at','LIKE',$current_date.'%')
                                             ->count();

        $ticket_approve_week        = $this->RealtimeExperienceModel  
                                             ->where('approve_status','=','1')
                                             ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                                             ->count();                                  

        $ticket_approve_month       = $this->RealtimeExperienceModel  
                                             ->where('approve_status','=','1')
                                             ->where('created_at','LIKE',$current_month.'%')
                                             ->count();                                     

        //ADDITION APPROVE INTERVIEW AND RWE TICKET........                   				                    	
        $count_approve_multirefbook_company_ticket_day = $member_multi_ref_book_day + $company_approve_day  + $ticket_approve_day;

        $count_approve_multirefbook_company_ticket_week = $member_multi_ref_book_week + $company_approve_week + $ticket_approve_week;

        $count_approve_multirefbook_company_ticket_month = $member_multi_ref_book_month + $company_approve_month + $ticket_approve_month;

        //dd($count_approve_multirefbook_company_ticket_month);

        // TOTAL OF SALES
        $tot_sales_sum_today = $this->TransactionModel
                                 ->where('payment_status','=','paid')
                                 ->where('created_at','LIKE',$current_date.'%')
                                 ->sum('grand_total');

        $tot_sales_sum_week = $this->TransactionModel
                                 ->where('payment_status','=','paid')
                                 ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                                 ->sum('grand_total');
                                 
        $tot_sales_sum_month = $this->TransactionModel
                                 ->where('payment_status','=','paid')
                                 ->where('created_at','LIKE',$current_month.'%')
                                 ->sum('grand_total');     

        // TOTAL OF REVENUE
        $tot_revenue_sum_today = $this->TransactionModel
                                 ->where('payment_status','=','paid')
                                 ->where('created_at','LIKE',$current_date.'%')
                                 ->sum('admin_amount'); 

        $tot_revenue_sum_week = $this->TransactionModel
                                 ->where('payment_status','=','paid')
                                 ->whereBetween('created_at', array($this_week_sd, $this_week_ed))
                                 ->sum('admin_amount');
                                 
        $tot_revenue_sum_month = $this->TransactionModel
                                 ->where('payment_status','=','paid')
                                 ->where('created_at','LIKE',$current_month.'%')
                                 ->sum('admin_amount');                                                                                

        //dd($tot_sales_sum_week);                         


		/*if($member_interview_pending_month)
         {
         	$member_interview_pending_month1 = $member_interview_pending_month->toArray();
         }	                            
		dd($member_interview_pending_month1);*/                            	  							    
    	$total_day_week_month_count[] = ['user_count_today'   => $user_count_today,
    						   			 'user_count_week'    => $user_count_week,
    						   			 'user_count_month'   => $user_count_month,

    						   			 'member_count_today' => $member_count_today,
    						   			 'member_count_week'  => $member_count_week,
    						   			 'member_count_month' => $member_count_month,

    						   			 'count_pending_multirefbook_company_ticket_day' => $count_pending_multirefbook_company_ticket_day,
    						   			 'count_pending_multirefbook_company_ticket_week' => $count_pending_multirefbook_company_ticket_week,
    						   			 'count_pending_multirefbook_company_ticket_month' => $count_pending_multirefbook_company_ticket_month,	

    						   			 'count_approve_multirefbook_company_ticket_day' => $count_approve_multirefbook_company_ticket_day,
                                         'count_approve_multirefbook_company_ticket_week' => $count_approve_multirefbook_company_ticket_week,
                                         'count_approve_multirefbook_company_ticket_month' => $count_approve_multirefbook_company_ticket_month,	

                                         'tot_sales_sum_today' => $tot_sales_sum_today,
                                         'tot_sales_sum_week'  => $tot_sales_sum_week,
                                         'tot_sales_sum_month' => $tot_sales_sum_month,

                                         'tot_revenue_sum_today' => $tot_revenue_sum_today,
                                         'tot_revenue_sum_week'  => $tot_revenue_sum_week,
                                         'tot_revenue_sum_month' => $tot_revenue_sum_month,
    						  			];
    	return $total_day_week_month_count;				  

    }

}