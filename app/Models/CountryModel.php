<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CountryModel extends Model
{
	use SoftDeletes;
	
    protected $table='countries';
    protected $fillable = ['country_name','country_code','is_active'];
}
