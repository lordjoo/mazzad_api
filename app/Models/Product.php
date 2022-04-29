<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        //'image',
        'price',
        'keyword',
        'category',
    ];

    protected $hidden = [
        'id',
        'seller_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
