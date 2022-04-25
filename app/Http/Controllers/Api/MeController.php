<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\User\UsersService;

class MeController extends Controller
{
    // TODO: Add the service and apiResponse property
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
        $this->service = new UsersService();
        $this->apiResponse = $apiResponse;
    }

    public function me()
    {
        return $this->apiResponse->success("USER_DATA_FETCHED", auth()->user())->return();
    }

    // TODO
    public function updateProfile()
    {

    }

}
