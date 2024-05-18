<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    use HasFactory;

    protected $table='customer_transactions';

    protected $fillable=[
        'customer_id',
        'payment_id',
        'equipment_id',
        'spare_id',
        'service_id',
        'count',
        'shipping_address'
    ];
}
