<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class VisitorsModel extends Model
{
	//use SoftDeletes;
	
    protected $table='visitors';
    protected $fillable = ['user_id','interview_id','ip_address','date'];

    
}