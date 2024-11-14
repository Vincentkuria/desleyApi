<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model
{
    use HasFactory;

    protected $casts=[
        'status'=>'array'
    ];

    protected $fillable=[
        'customer_id',
        'shipping_address',
        'equipment_id',
        'spare_id',
        'shipped_by',
        'count',
        'service_id',
        'assigned',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
