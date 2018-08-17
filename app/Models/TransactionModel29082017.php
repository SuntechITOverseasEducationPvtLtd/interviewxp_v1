<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    protected $table = "transaction";

    protected $fillable = [
                            'user_id',
                            'member_user_id',
                            'ref_interview_id',
                            'order_id',
                            'reference_book',
                            'grand_total',
                            'admin_amount',
                            'ticket_unique_id',
                            'member_amount',
                            'skill_id',
                            'end_date',
                            'experience_level',
                            'user_deleted',
                           ];
    protected $appends = array('skill_name');
    public function purchase_history()
    {
        return $this->hasMany('App\Models\PurchaseHistoryModel','trans_id','id');
    } 
    public function member_detail()
    {
        return $this->hasOne('App\Models\UserModel','id','member_user_id');
    }                      
    public function user_detail()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
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
