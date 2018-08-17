<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasedTicketModel extends Model
{
    protected $table = "purchase-tickets";

    protected $fillable = [
                            'rwe_purchase_id',
                            'rew_id',
                            'interview_id',
                           ];

     public function rwe_details()
    {
        return $this->hasMany('App\Models\RealtimeExperienceModel','id','rew_id');
    } 
}
