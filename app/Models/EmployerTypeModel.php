<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerTypeModel extends Model
{
    protected $table  ="employer_type"; 

    protected $fillable = [
    						'member_id',
    						'designation',
    						'company_name',
    						'start_month',
    						'start_year',
    						'end_month',
    						'end_year',
    						'employer_type',
    						'display_company',
    						'country',
    						'state',
    						'city',
    						'description',
    					  ];
}
