<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecializationModel extends Model
{
    use SoftDeletes;

    protected $table = "specialization";

    protected $fillable = [
    						'qualification_id',
    						'specialization_name',
                            'is_active'
    					  ];

    /*public function delete()
    {
    	parent::delete();
    }*/
    public function qualification()
    {
        return $this->belongsTo('App\Models\QualificationModel','qualification_id','id');
    }
}