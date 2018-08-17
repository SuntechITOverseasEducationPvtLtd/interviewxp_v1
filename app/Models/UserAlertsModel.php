<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;


class UserAlertsModel extends Model
{
    protected $table = "user_alerts";

    protected $fillable = ['user_id','skill_id','exp_level','alert_name','skill_set','user_type'];

    /*public function delete()
    {
    	parent::delete();
    }*/
    public function skills()
    {
        return  $this->hasMany('App\Models\SkillsModel','id','skill_id');
    }

    public function user_details()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }
}
