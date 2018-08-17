<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Common\Traits\MultiActionTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoryModel extends Model
{
    use SoftDeletes;

    protected $table = "subcategories";

    protected $fillable = [
    						'category_id',
    						'subcategory_name',
                            'is_active'
    					  ];

    /*public function delete()
    {
    	parent::delete();
    }*/
    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel','category_id','id');
    }
}