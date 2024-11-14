<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'phone_no',
        'service_group'
    ];

    protected $hidden=[
        'password'
    ];

    protected $casts=[
        'status'=>'array'
    ];
}
