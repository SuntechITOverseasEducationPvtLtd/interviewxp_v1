<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class CareerpostModel extends Model
{
    //use SoftDeletes;
    
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


class CareerModel extends Model
{
    //use SoftDeletes;
    
    protected $table='career_master';
    //protected $fillable = ['state_id','city_name','is_active'];

    protected $fillable = ['first_name',
                           'last_name',
                           'job_title',
                           'experience_years',
                           'experience_month',
                           'company_name',
                           'employer_type',
                           'employer_name',
                           'start_month',
                           'start_year',
                           'end_month',
                           'end_year',
                           'designation',
                           'annual_salary',
                           'current_work_location',
                           'mobile_code',
                           'mobile_no',
                           'birth_date',
                           'gender',
                           'resume',
                           'email',
                           'slug',
                           'cnn',
                           'dn',
                           'smn',
                           'syn',
                           'emn',
                           'eyn',
                           'asn',
                           'cnnn',
                           'dnn',
                           'smnn',
                           'synn',
                           'emnn',
                           'eynn',
                           'asnn',
                           'postid'
                           ];
}



class CareersaveModel extends Model
{
    //use SoftDeletes;
    
    protected $table='tbl_learnlist';
    

    protected $fillable = ['useres_id',
                           'interviewes_id'
                           ];
}




