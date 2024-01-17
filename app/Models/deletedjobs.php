<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deletedjobs extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_name',
         'user_id',
         'firstname',
         'lastname'
    ];
}
