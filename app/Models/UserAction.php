<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;
    public static array $ACTIONS = [
        "view"=>1,
        'attempt_to_bid'=>2,
        "bid"=>5,
    ];
    protected $guarded = ["id"];

}
