<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $casts=[
        'status'=>'array'
    ];

    protected $fillable=[
        'name',
        'no_of_items',
        'supplier_id',
    ];

    /**
     * Get all of the suppliers for the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }
}
