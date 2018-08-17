<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealtimeExperienceModel extends Model
{
    protected $table = "member_real_time_experience";

    protected $fillable = [
    						'user_id',
                            'interview_id',
    						'member_id',
    						'skill_id',
    						'issue_title',
    						'experience_level',
    						'solution',
    						'attachment',
                            'approve_status',
                            'admin_comments',
							'pageCount',
							'file_extension',
							'fileSize'
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

    public function memberdetails()
    {
        return  $this->belongsto('App\Models\MemberDetailModel','user_id','user_id');
    }
    public function member_personal_details()
    {
        return $this->belongsto('App\Models\UserModel','user_id','id');
    }                      

}
