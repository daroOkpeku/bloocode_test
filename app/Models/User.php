<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\StoreTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, StoreTrait;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $searchable  = [
        "columns"=>[
           "users.id"=>10,
            "users.firstname"=>10,
            "users.lastname"=>10,
        ]
      ];


    protected $fillable = [
        'firstname',
        'lastname',
        'employee_type',
        'comfirm_status',
        'email',
        'api_token',
        'password',
        'status'
    ];

    // 'firstname',
    // 'lastname',
    // 'date_of_brith',
    // 'employee_type',
    //  'role_id'
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
