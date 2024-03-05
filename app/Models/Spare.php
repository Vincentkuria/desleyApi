<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    use HasFactory;

    protected $casts=[
        'status'=>'array'
    ];

    protected $fillable=[
        'name',
        'price',
        'item_description',
        'img_url',
        'inventory_id'
    ];
}
