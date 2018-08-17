<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageEmailModel extends Model
{
    protected $table = "email_master";

    protected $fillable = ['general_email','opening_email','hr_mail'];
}
