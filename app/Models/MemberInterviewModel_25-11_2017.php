<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;


class MemberInterviewModel extends Model
{
    

    protected $table = "member_interview";

    protected $fillable = [
                            'user_id',
                            'member_id',
                            'skill_id',
                            'topic_name',
                            'experience_level',
                            'category_id',
                            'sub_category_id',
                            'qualification_id',
                            'specialization_id',
                            'reference_book',
                            'company_id',
                            'location',
                            'location_city',
                            'location_other_country',
                            'location_other_city',
                            'meta_description',
                            'image',
                            'video',
                            'admin_approval',
                             'view_count',
                            'approve_status',
                           
                          ];

    protected $appends = array('skill_name','category_name','subcategory_name','qualification_name','specialization_name','company_name');

    public function getCompanyNameAttribute()
    {
        $company = CompanyModel::where('company_id',$this->company_id)->first();

        if(isset($company->company_name)) 
        {
            return $company->company_name;    
        }
        return null;   
    }

    public function getSkillNameAttribute()
    {
        $skill = SkillsModel::find($this->skill_id);
        if(isset($skill->skill_name)) 
        {
            return $skill->skill_name;    
        }
        return null;   
    }

    public function getCategoryNameAttribute()
    {
        $category = CategoryModel::find($this->category_id);
        if(isset($category->category_name)) 
        {
            return $category->category_name;    
        }
        return null;   
    }

    public function getSubcategoryNameAttribute()
    {
        $subcategory = SubCategoryModel::find($this->sub_category_id);
        if(isset($subcategory->subcategory_name)) 
        {
            return $subcategory->subcategory_name;    
        }
        return null;   
    }

    public function getQualificationNameAttribute()
    {
        $qualification = QualificationModel::find($this->qualification_id);
        if(isset($qualification->qualification_name)) 
        {
            return $qualification->qualification_name;    
        }
        return null;   
    }

    public function getSpecializationNameAttribute()
    {
        $specialization = SpecializationModel::find($this->specialization_id);
        if(isset($specialization->specialization_name)) 
        {
            return $specialization->specialization_name;    
        }
        return null;   
    }

    public function skilldetails()
    {
        return  $this->belongsto('App\Models\SkillsModel','skill_id','id');
    }

    public function user_details()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }

    public function memberdetails()
    {
        return  $this->belongsto('App\Models\MemberDetailModel','user_id','user_id');
    }
    public function member_personal_details()
    {
        return $this->belongsto('App\Models\UserModel','user_id','id');
    }
    public function realtime_work_experience()
    {
        return $this->belongsToMany('App\Models\RealtimeExperienceModel')->withPivot('experience_level');
    }
    public function interview_details()
    {
        return $this->hasMany('App\Models\InterviewDetailModel','interview_id','id');
    }
    public function realtime_details()
    {
        return $this->hasMany('App\Models\RealtimeExperienceModel','interview_id','id');
    }
    public function reference_book_details()
    {
        return $this->hasMany('App\Models\MultiReferenceBookModel','interview_id','id');
    }
    
    public function user_purchase_details()
    {
        return $this->hasMany('App\models\TransactionModel','ref_interview_id','id');
    }
    public function average_rating()
    {
        return $this->hasMany('App\models\ReviewRatingModel','interview_id','id');
    }

}