<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TransactionModel extends Model
{
    protected $table = "transaction";

    protected $fillable = [
                            'user_id',
                            'member_user_id',
                            'ref_interview_id',
                            'order_id',
                            'reference_book',
                            'base_price',
                            'grand_total',
                            'igst_percent',
                            'cgst_percent',
                            'sgst_percent',
                            'igst_amount',
                            'cgst_amount',
                            'sgst_amount',
                            'admin_amount',
                            'ticket_unique_id',
                            'member_amount',
                            'skill_id',
                            'end_date',
                            'experience_level',
                            'user_deleted',
                            'notification_request',
                            'tds_percent',
                            'admin_commission',
                            'member_payment_ref_id',
                            'member_payment_ref_comment',
                            'member_payment_ref_image',
                           ];
    protected $appends = array('skill_name');
    public function purchase_history()
    {
        return $this->hasMany('App\Models\PurchaseHistoryModel','trans_id','id');
    }
    public function transaction_history()
    {
        return $this->hasMany('App\Models\TransactionHistoryModel','trans_id','id');
    } 
    public function member_detail()
    {
        return $this->hasOne('App\Models\UserModel','id','member_user_id');
    }                      
    public function user_detail()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }
    public function interview_detail()
    {
        return $this->hasOne('App\Models\MemberInterviewModel','id','ref_interview_id');
    }
    public function all_interview_detail()
    {
        return $this->hasMany('App\Models\MemberInterviewModel','user_id','member_user_id');
    }
    public function skills()
    {
        return $this->hasOne('App\Models\SkillsModel','id','skill_id');
    }

    public function member_interview_info()
    {
        return $this->hasOne('App\Models\MemberInterviewModel','id','ref_interview_id');
    }

    public function ticket_details()
    {
        return $this->hasMany('App\Models\PurchasedTicketModel','rwe_purchase_id','ticket_unique_id');
    }

    public function multi_ref_book()
    {
        return $this->hasMany('App\Models\MultiReferenceBookModel','interview_id','ref_interview_id');
    }

    public function user_review()
    {
        return $this->hasOne('App\Models\ReviewRatingModel','id','order_idd');
    }

    public function member_reviews_ratings()
    {
        return $this->hasMany('App\Models\ReviewRatingModel','unique_id','ticket_unique_id');
    }
	
	public function get_member_reviews_ratings()
    {
		$ticket_unique_id = explode(',',$this->ticket_unique_id);
		$reviews_ratings = ReviewRatingModel::whereIn('unique_id',$ticket_unique_id)->select([DB::raw('COUNT(review_star) as reviews'), DB::raw('SUM(review_star) as ratings')])->first();
		return $reviews_ratings;
    }

    public function coach_reviews_ratings()
    {
        return $this->hasOne('App\Models\ReviewRatingModel','unique_id','ticket_unique_id');
    }

   /* public function company_details()
    {
        return $this->hasMany('App\Models\InterviewDetailModel','interview_id','id');
    }*/
    public function getSkillNameAttribute()
    {
        $skills = SkillsModel::find($this->skill_id);
        if(isset($skills->skill_name) && sizeof($skills->skill_name)) 
        {
            return $skills->skill_name;   
        }

        return null;
    }
}
