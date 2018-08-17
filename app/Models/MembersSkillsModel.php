<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;


class MembersSkillsModel extends Model
{
    

    protected $table = "member_skills";

    protected $fillable = [
                            'member_id',
                            'skill_id'
                          ];

    protected $appends = array('skill_name');

	public function getSkillNameAttribute()
    {
        $skill = SkillsModel::find($this->skill_id);
        if(isset($skill->skill_name)) 
        {
            return $skill->skill_name;    
        }
        return null;   
    }

	/*public function skill_name()
	{
		return  $this->hasOne('App\Models\SkillsModel','id','skill_id');
	}    */                      	

}