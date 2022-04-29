<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Product;
use App\Services\ProductsService;
use App\Services\User\UsersService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var UsersService
     */
    public $service;
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->service = new ProductsService();
        $this->apiResponse = $apiResponse;
    }

    public function all()
    {
        $data = $this->service->getAllProducts();
        return $data;
    }
}
