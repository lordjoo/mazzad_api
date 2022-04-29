<?php

namespace App\Services;

use App\Http\Resources\User\UserResource;
use App\Models\Product;
use App\Models\User;
use mysql_xdevapi\Exception;

class ProductsService
{
    public function getAllProducts()
    {
        return Product::all();
    }
}
