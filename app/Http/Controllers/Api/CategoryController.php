<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\User\UsersService;

class CategoryController extends Controller
{
    // TODO: Add the service and apiResponse property
    /**
     * @var CategoryService
     */
    public $service;
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->service = new CategoryService();
        $this->apiResponse = $apiResponse;
    }

    public function all()
    {
        $data = $this->service->getAll();
        return $this->apiResponse->success("DATA_HAS_BEEN_FETCHED", $data)->return();
    }

}
