<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_no',
        'verified',
    ];

    protected $hidden=[
        'password',
        'remember_token'
    ];

    /**
     * Get all of the cartitems for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartitems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get all of the payments for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
