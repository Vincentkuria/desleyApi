<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTransaction extends Model
{
    use HasFactory;

    protected $casts=[
        'status'=>'array'
    ];

    protected $fillable=[
        'request_from',
        'inventory_id',
        'supplier_id',
        'count',
        'total_amount',
        'payment_id',
        'price',
    ];
}
