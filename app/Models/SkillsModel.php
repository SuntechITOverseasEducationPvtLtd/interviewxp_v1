<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillsModel extends Model
{
    use SoftDeletes;

    protected $table = "skills";

    protected $fillable = [
                            'skill_name',
                          ];

}

class CareersModel extends Model
{
      protected $table='career';
    //protected $fillable = ['state_id','city_name','is_active'];

    protected $fillable = ['jobtitle',
                           'experience',
                           'type',
                           'opening',
                           'anualsalary',
                           'jobdescription',
                           'email',
                           'phone',
                           'status'    
                           ];

}
