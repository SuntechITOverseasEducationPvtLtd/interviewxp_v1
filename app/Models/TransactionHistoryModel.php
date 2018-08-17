<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHistoryModel extends Model
{
    protected $table = "transaction_history";

    protected $fillable = [
                            'trans_id',
                            'order_id',
                            'interview_id',
                            'item_type',
                            'item_id',
			    'item_price',
                            'combo_status',
                            'combo_type',
                            'igst',
                            'cgst',
							'sgst',
							'member_commission',
							'admin_commission',
                           ];

    public function interview_detail()
    {
    	return $this->hasMany('App\Models\MemberInterviewModel','id','interview_id');
    }

    public function interview_attachment()
    {
        return $this->hasMany('App\Models\InterviewDetailModel','interview_id','interview_id');
    } 
    
    public function skills()
    {
        return $this->hasOne('App\Models\SkillsModel','id','skill_id');
    }                      
}
