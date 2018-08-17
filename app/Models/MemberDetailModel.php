<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;


/*use App\Models\QualificationModel;
use App\Models\CityModel;*/

class MemberDetailModel extends Model
{
    
    protected $table = "member_detail";

    protected $fillable = [
                            'user_id',
                            'qualification_id',
                            'passing_month',
                            'passing_year',
                            'marks_type',
                            'marks',
                            'specialization_id',
                            'category_id',
                            'current_work_location',
                            'experience_years',
                            'experience_month',
                            'company_name',
                            'employer_type',
                            'employer_name',
                            'duration',
                            'designation',
                            'resume',
                            'pan_no',
                            'address',
                            'state',
                            'education_city',
                            'pincode',
                            'about_member',
                            'status',
                            'employment_country_id',
                            'education_country_id',
                            'employment_other_city',
                            'employment_other_state',
                            'education_other_city',
                            'education_other_state',
                            'curriculum',
                            'my_interview_experience',
                            'biography',
                            'calls_job_market',
                            'headline',
                            'banner_image',
                            'education_state',
                           ];

    
    
    protected $appends = array('qualification','educationcity_name','currentworklocation_city','specialization');

    public function getQualificationAttribute()
    {
        $qulification = QualificationModel::find($this->qualification_id);
        if (isset($qulification->qualification_name) && sizeof($qulification->qualification_name)) 
        {
        	return $qulification->qualification_name;	
        }

        return null;
    }

    public function getEducationcityNameAttribute()
    {
        $obj_city = CityModel::where('city_id',$this->education_city)->first();
        
        if(isset($obj_city->city_name) && sizeof($obj_city->city_name)) 
        {
        	return $obj_city->city_name;	
        }

        return null;
    }
    public function getCurrentworklocationCityAttribute()
    {
        $obj_city = CityModel::where('city_id',$this->current_work_location)->first();
        
        if(isset($obj_city->city_name) && sizeof($obj_city->city_name)) 
        {
            return $obj_city->city_name;    
        }

        return null;
    }
    public function getSpecializationAttribute()
    {
        $specialization = SpecializationModel::find($this->specialization_id);
        if(isset($specialization->specialization_name) && sizeof($specialization->specialization_name)) 
        {
        	return $specialization->specialization_name;	
        }

        return null;
    }
    
    public function member_skills()
    {
        return  $this->hasMany('App\Models\MembersSkillsModel','member_id','id');
    }

    public function member_employer_type()
    {
        return  $this->hasMany('App\Models\EmployerTypeModel','member_id','id');
    }    

    public function member_post_interview()
    {
        return $this->hasMany('App\Models\MemberInterviewModel','member_id','id');

       // return $this->hasOne('Section')->selectRaw('module_id, count(*) as count')->groupBy('module_id');
    }


}
