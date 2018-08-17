<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseHistoryModel extends Model
{
    protected $table = "purchase_history";

    protected $fillable = [
                            'trans_id',
                            'order_id',
                            'interview_id',
                            'reference_book',
                            'ticket_name',
							'TextResumeType',
                            'InterviewByCompaniesID',
							'training_schedule_id',
                           ];

    public function interview_detail()
    {
    	return $this->hasMany('App\Models\MemberInterviewModel','id','interview_id');
    }

    public function interview_attachment()
    {
        return $this->hasMany('App\Models\InterviewDetailModel','interview_id','interview_id');
    }                       
}
