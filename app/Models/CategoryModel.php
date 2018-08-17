<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use SoftDeletes;

    protected $table = "categories";

    protected $fillable = ['category_name','is_active'];

    /*public function delete()
    {
    	parent::delete();
    }*/
}
