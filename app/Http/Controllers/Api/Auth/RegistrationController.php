<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\User\UsersService;

class RegistrationController extends Controller
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
        $this->service = new UsersService();
        $this->apiResponse = $apiResponse;
    }

    public function register(RegisterUserRequest $request)
    {
        try {
            $data = $this->service->registerUser($request->validated());
            return $this->apiResponse->success("USER_REGISTERED")->setData($data)->return();
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage())->return();
        }

    }

}
