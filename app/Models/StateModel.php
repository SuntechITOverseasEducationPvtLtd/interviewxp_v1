<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StateModel extends Model
{
	use SoftDeletes;
	
    protected $table='state';
    protected $fillable = ['state_name','is_active'];

    public function city()
	{
		return $this->hasmany('App\Models\CityModel','state_id','id');
	}
}
