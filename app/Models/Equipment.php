<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{
    use HasFactory;

    protected $table='equipments';

    protected $casts=[
        'status'=>'array'
    ];

    protected $fillable=[
        'name',
        'price',
        'item_description',
        'img_url',
        'video_url',
        'inventory_id'
    ];

    
}
