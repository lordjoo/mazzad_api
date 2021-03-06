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
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function auctionBids()
    {
        return $this->hasMany(AuctionBid::class);
    }
}
