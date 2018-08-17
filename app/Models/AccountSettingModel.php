<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSettingModel extends Model
{
    protected $table = "account_setting";

    protected $fillable = ['user_id','country_code','zipcode','mobile_no','city','street_address','lat','lon','state'
    ];
}
