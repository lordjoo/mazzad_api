<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        "images"=> "array",
        "keywords"=> "array",
    ];

    public function category()
    {

    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
