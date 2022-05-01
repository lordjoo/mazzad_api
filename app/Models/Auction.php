<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auction extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'price',
        "seller_id",
    ];

    
    public function User(){
        return $this->hasMany('auction');
    }
}
