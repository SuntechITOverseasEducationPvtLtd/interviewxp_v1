<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiReferenceBookModel extends Model
{
    protected $table = "multi_reference_book";

    protected $fillable = [
                            'interview_id',
							'pageCount',
                            'topic_name',
                            'mul_reference_book',
                            'file_extension',
							'fileSize'
                           ];

}
