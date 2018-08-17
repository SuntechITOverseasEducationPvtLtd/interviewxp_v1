<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReviewRatingModel;
use App\Models\ActivityLogsModel;
use App\Events\ActivityLogEvent;
use App\Models\TransactionModel;

use Carbon\Carbon;
use Flash;
use Validator;
use Sentinel;
use File;
use DB;

class ReviewRatingController extends Controller
{
    public function __construct(TransactionModel $transaction, ReviewRatingModel $review_rating,
                                ActivityLogsModel $activity_logs 
   							   )
   {
      $this->BaseModel            = $review_rating;
      $this->ActivityLogsModel    = $activity_logs;
   		$this->ReviewRatingModel    = $review_rating;
      $this->TransactionModel     = $transaction;
   		$this->module_view_folder   = 'admin.review_rating';
   		$this->arr_view_data        = [];
   		$this->module_title         = "Review Ratintg";
   		$this->module_url_path      = url(config('app.project.admin_panel_slug')."/review_rating");
   		$this->theme_color          = theme_color();
   }

   public function index()
   {
      
   		$arr_review_rating = [];
   		$obj_reviews = $this->TransactionModel
                        ->with(['all_interview_detail'=>function($query){
                              $query->select(['*',DB::raw('COUNT(skill_id) as no_of_skills')]);
                            $query->groupBy('user_id');
                           },'member_detail'])
                        ->where('payment_status','paid')
                        ->groupBy('member_user_id')
                        ->orderBy('id','desc')
                        ->get();           
   		if($obj_reviews)
   		{
   			$arr_review_rating = $obj_reviews->toArray();
   		}
      
   		$this->arr_view_data['page_title']        = 'Review Rating';
   		$this->arr_view_data['module_url_path']   = $this->module_url_path;
   		$this->arr_view_data['module_title']      = 'Reviews';
   		$this->arr_view_data['arr_review_rating'] = $arr_review_rating;
   		$this->arr_view_data['theme_color']       = $this->theme_color;
        
      return view($this->module_view_folder.'.reviews-ratings',$this->arr_view_data);
   }

   public function memberReviewsRatings($member_id)
   {
      $arr_review_rating = [];
      $member_id = base64_decode($member_id);
      $obj_reviews = $this->TransactionModel
                        ->with(['all_interview_detail'=>function($query){
                              $query->select(['*',DB::raw('COUNT(skill_id) as no_of_skills')]);
                            $query->groupBy('user_id');
                           },'member_detail', 'member_reviews_ratings'=>function($query){
                              $query->select(['*',DB::raw('COUNT(review_rating.id) as no_of_rr_pending')]);
                              $query->where('approve_status','pending');
                              $query->where('trans_history_id','>',0);
                              $query->groupBy('member_user_id');
                           }])
                        ->where('payment_status','paid')
                        ->where('member_user_id','=', $member_id)
                        ->groupBy('member_user_id')
                        ->orderBy('id','desc')
                        ->get();
      if($obj_reviews)
      {
        $arr_review_rating = $obj_reviews->toArray();
      }
      
      $this->arr_view_data['page_title']        = 'Review Rating';
      $this->arr_view_data['module_url_path']   = $this->module_url_path;
      $this->arr_view_data['module_title']      = 'Reviews';
      $this->arr_view_data['arr_review_rating'] = $arr_review_rating;
      $this->arr_view_data['theme_color']       = $this->theme_color;
      $this->arr_view_data['member_id']       = $member_id;
        
      return view($this->module_view_folder.'.reviews-ratings',$this->arr_view_data);
   } 

   public function index_old()
   {
      $arr_review_rating = [];
      $obj_reviews = $this->ReviewRatingModel
                          ->orderBy('id','DESC')
                          ->with(['interview_details','user_details','interview_details.user_details'])
                          ->get();
      if($obj_reviews)
      {
        $arr_review_rating = $obj_reviews->toArray();
      }
      
      if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
      {
        foreach($arr_review_rating as $key => $data_rating) 
        {
            $user_id = $data_rating['user_id'];
            $role=Sentinel::findById($user_id)->roles()->first();
            $user_role = $role->name;
            $arr_review_rating[$key]['user_role'] = $user_role;  
        }  
      }
      
      $this->arr_view_data['page_title']        = 'Review Rating';
      $this->arr_view_data['module_url_path']   = $this->module_url_path;
      $this->arr_view_data['module_title']      = 'Reviews';
      $this->arr_view_data['arr_review_rating'] = $arr_review_rating;
      $this->arr_view_data['theme_color']       = $this->theme_color;
        
      return view($this->module_view_folder.'.index',$this->arr_view_data);
   } 

   public function review_message($enc_id)
   {
      $id = base64_decode($enc_id);
      $obj_review_msg = $this->ReviewRatingModel
                             ->where('id',$id)
                             ->first();
      if($obj_review_msg)
      {
         $arr_review_msg = $obj_review_msg->toArray();
      }                        

      //dd($arr_review_msg);
      $this->arr_view_data['page_title']        = 'Review Message';
      $this->arr_view_data['module_title']      = 'Reviews';
      $this->arr_view_data['module_url_path']   = $this->module_url_path;
      $this->arr_view_data['arr_review_msg']    =  $arr_review_msg;
      $this->arr_view_data['theme_color']       = $this->theme_color;
      return view($this->module_view_folder.'.review_message',$this->arr_view_data);
   }

    public function multi_action(Request $request)
    {
        //dd($request->all());
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
               $id = base64_decode($record_id);
               //$this->perform_delete(base64_decode($record_id)); 
               $delete_success = $this->BaseModel->where('id',$id)->delete();   
               Flash::success(str_plural($this->module_title).' Deleted Successfully!!!'); 
            } 
           
        }

        return redirect()->back();
    }

   public function delete($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        $id = base64_decode($enc_id);
        $delete_success = $this->BaseModel->where('id',$id)->delete();
        if($delete_success)
        {   
            Flash::success(str_singular($this->module_title).' Deleted Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).' Deletion!!! ');
        }

        return redirect()->back();
    }

    public function approve_change(Request $request)
    {
        $approve_id    = $request->input('id');
        $approve_value = $request->input('approve_status');

        //dd($approve_id." ".$approve_value);
        $result = $this->ReviewRatingModel->where('id',$approve_id)->update(['approve_status'=>$approve_value]);
        if($result)
        {
             Flash::success('Approve Status Change Successfully.');        
             $arr_response['status']    = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Change Approve Status.');
             $arr_response['status']    = "Error";
        }   
        //return json_encode($result);
        return response()->json($arr_response);
  
    }
}
