<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

class FAQModel extends Model
{
    use Rememberable;
    protected $table = 'faq';
    protected $fillable = ['is_active', 'question', 'answer'];
}
