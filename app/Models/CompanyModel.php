<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;


class CompanyModel extends Model
{
    protected $table = "company_master";

    protected $fillable = ['company_name','company_location','is_active'];

    /*public function delete()
    {
    	parent::delete();
    }*/
}