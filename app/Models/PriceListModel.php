<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class PriceListModel extends Model
{
	//use SoftDeletes;
	
    protected $table='price_list';
    protected $fillable = [ 
    						'price_id',
    						'exp_level',
    						'validity',
    						'ref_book_price',
    						'interview_price',
    						'is_active',
    						'price_for_25_ticket',
							'price_for_50_ticket',
							'price_for_75_ticket',
						  ];

   /* public function state()
    {
    	return $this->belongsTo('App\Models\StateModel','state_id','id');
    }*/
}