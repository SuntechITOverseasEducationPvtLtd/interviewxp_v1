<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StaticPageModel extends Model
{
	
    protected $table='static_pages';
    protected $fillable = ['page_title','page_desc','meta_keyword','meta_desc','page_slug','is_active'];

}


