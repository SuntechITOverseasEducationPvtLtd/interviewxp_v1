<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewRatingModel extends Model
{
   protected $table = "review_rating";

    protected $fillable = [
    						'user_id',
                            'interview_id',
    						'unique_id',
                            'review_star',
                            'review_message',
                            'member_user_id',
                            'order_idd',
                            'ReviewType',
                            'ReviewTypeID',
                            'trans_history_id',
    					  ];



   	public function interview_details()
    {
        return $this->hasOne('App\Models\MemberInterviewModel','id','interview_id');
    }
    public function member_details()
    {
        return $this->hasMany('App\Models\MemberInterviewModel','interview_id','id');
    }

    public function user_details()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }


}
