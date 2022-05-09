<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "image"
    ];
    protected $hidden = [];

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

}
