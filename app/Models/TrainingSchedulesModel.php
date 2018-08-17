<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class TrainingSchedulesModel extends Model
{
    //use SoftDeletes;
    
    protected $table='training_schedules';
   
    protected $fillable = ['member_id',
                           'skill_id',
                           'date',
                           'start_time',
                           'end_time',
                           'max_allowed',
                           'created_at',
                           'updated_at',    
                           ];
}