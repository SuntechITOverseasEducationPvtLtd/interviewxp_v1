<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

use Cmgmyr\Messenger\Traits\Messagable;
use App\Models\UserDetailModel;

class UserModel extends CartalystUser
{
    

//    protected $appends = ['user_profile'];
    

	protected $fillable = [
		'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'profile_image',
        'is_active',
        'mobile_no',
        'gender',
        'status',
        
    ];

    public function user_profile()
    {
        return $this->hasOne('App\Models\UserDetailModel','user_id','id');
    }

    public function member_detail()
    {
        return $this->hasOne('App\Models\MemberDetailModel','user_id','id');
    }
    public function member_skills()
    {
        return  $this->hasMany('App\Models\MembersSkillsModel','member_id','id');
    }

    /*public function notification_detail()
    {
        return $this->hasOne('App\Models\NotificationModel','user_id','id')->where('status','=',0)->count();
    }*/
    
    //protected $appends = array('user_profile');

  /*  public function getUserProfileAttribute()
    {
        $user_details = UserDetailModel::where('user_id',$this->id)->first();
        return $user_details;
    }*/

    

    /*
    public function favourite_properties()
    {
        return $this->belongsToMany('App\Models\PropertyModel','favourite_properties','user_id','property_id');
    }

   */

  
}

