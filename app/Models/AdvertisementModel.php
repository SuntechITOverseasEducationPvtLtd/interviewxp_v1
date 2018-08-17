<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementModel extends Model
{
    use SoftDeletes;

    protected $table = "advertisement";

    protected $fillable = ['title','advertise_image','description'];

    /*public function delete()
    {
    	parent::delete();
    }*/
}
