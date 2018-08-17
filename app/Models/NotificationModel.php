<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table = "notification";
    protected $fillable = [
    						'user_id',
    						'message',
							'interview_id',
    						'status',
    					  ];

    public function interview_detail()
    {
        return $this->hasOne('App\Models\MemberInterviewModel','id','interview_id');
    }

    public function user_detail()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }	

    public function coach_reviews_ratings()
    {
        return $this->hasOne('App\Models\ReviewRatingModel','unique_id','ticket_unique_id');
    }				  
}
