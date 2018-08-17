<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class CityModel extends Model
{
	//use SoftDeletes;
	
    protected $table='city';
    protected $fillable = ['state_id','city_name','is_active'];

    public function state()
    {
    	return $this->belongsTo('App\Models\StateModel','state_id','id');
    }
}