<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewDetailModel extends Model
{
    protected $table = "interview_detail";

    protected $fillable = [
                            'user_id',
                            'interview_id',
                            'skill_id',
                            'topic_name',
                            'experience_level',
                            'company_id',
                            'company_location',
                            'attachment',
                            'admin_comments',
                            'approve_status',
							'roundType',
							'pageCount',
							'file_extension',
							'fileSize',
							'company_source'
                          ];

	protected $appends = array('company_name');               

    public function getCompanyNameAttribute()
    {
        $company = CompanyModel::where('company_id',$this->company_id)->first();

        if(isset($company->company_name)) 
        {
            return $company->company_name;    
        }
        return null;   
    }

    public function member_info()
    {
         return $this->hasOne('App\Models\MemberInterviewModel','interview_id','id');
    }                      
}
