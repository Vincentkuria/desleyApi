<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Model
{
    use HasFactory;

    protected $table='cart_items';

    protected $fillable=[
        'customer_id',
        'equipment_id',
        'service_id',
        'spare_id',
        'count',
    ];

    /**
     * Get the customer that owns the CartItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the equipment associated with the CartItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function equipment(): HasOne
    {
        return $this->hasOne(Equipment::class);
    }

    /**
     * Get the spare associated with the CartItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function spare(): HasOne
    {
        return $this->hasOne(Spare::class);
    }

    /**
     * Get the service associated with the CartItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service(): HasOne
    {
        return $this->hasOne(Service::class);
    }
}
