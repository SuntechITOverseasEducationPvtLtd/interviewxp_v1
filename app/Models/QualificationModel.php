<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationModel extends Model
{
    use SoftDeletes;

    protected $table = "qualification";

    protected $fillable = ['qualification_name','is_active'];

    /*public function delete()
    {
    	parent::delete();
    }*/
}
