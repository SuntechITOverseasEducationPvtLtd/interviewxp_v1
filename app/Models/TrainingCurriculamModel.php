<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class TrainingCurriculamModel extends Model
{
    //use SoftDeletes;
    
    protected $table='training_curriculam';
   
    protected $fillable = ['member_id',
                           'skill_id',
                           'title',
                           'description',
                           'created_at',
                           'updated_at',    
                           ];
}