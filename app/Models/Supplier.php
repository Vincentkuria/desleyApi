<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Supplier extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $casts=[
        'status'=>'array'
    ];

    protected $hidden=[
        'password'
    ];

    protected $fillable=[
        "company_name",
        'email',
        'password'
    ];

    /**
     * Get all of the payments for the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get all of the inventories for the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }
}
