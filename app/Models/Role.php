<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StoreTrait;

class Role extends Model
{
    use HasFactory;
    use StoreTrait;
    protected $fillable = [
        'role',
    ];
}
