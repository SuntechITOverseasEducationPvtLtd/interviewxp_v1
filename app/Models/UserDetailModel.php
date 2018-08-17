<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;


/*use App\Models\QualificationModel;
use App\Models\CityModel;*/

class UserDetailModel extends Model
{
    

    protected $table = "user_detail";

    protected $fillable = ['user_id','qualification_id','passing_month','passing_year','marks_type','marks','specialization_id','category_id','current_work_location','state','country_id','city',];

    

    protected $appends = array('qualification','city','specialization','country_name');

    public function getQualificationAttribute()
    {
        $qulification = QualificationModel::find($this->qualification_id);
        if (isset($qulification->qualification_name) && sizeof($qulification->qualification_name)) 
        {
        	return $qulification->qualification_name;	
        }

        return null;
    }

    
    public function getCountryNameAttribute()
    {
        $country = CountryModel::find($this->country_id);
        if(isset($country->country_name) && sizeof($country->country_name)) 
        {
            return $country->country_name;    
        }

        return null;
    }


    public function getCityAttribute()
    {
        $city = CityModel::where('city_id',$this->current_work_location)->first();
        
        if(isset($city->city_name) && sizeof($city->city_name)) 
        {
        	return $city->city_name;	
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



}
