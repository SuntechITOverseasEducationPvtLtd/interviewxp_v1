<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddInterviewCoach extends Model
{
    //use SoftDeletes;

    protected $table = "interview_coach";
	
    protected $fillable = ['User_Id', 'FirstName', 'LastName', 'CurrentState', 'CurrentCity', 'Headline', 'Summary', 'Interview', 'Companies', 'Issues'];

    /*public function delete()
    {
    	parent::delete();
    }*/
}
