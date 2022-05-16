<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionBid extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'user_id',
        'bid_type',
        'price'
    ];

    protected $hidden = [];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
