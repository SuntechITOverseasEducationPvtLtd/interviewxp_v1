<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmailTemplateModel extends Model
{
	
    protected $table='tbl_emailtemplate';
    protected $fillable = ['mailcategory','subject','bodytext','is_active'];

}


