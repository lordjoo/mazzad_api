<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\User\UsersService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * @var UsersService
     */
    private $usersService;
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiResponse $apiResponse)
    {
        $this->middleware('guest');
        $this->usersService = new UsersService();
        $this->apiResponse = $apiResponse;
    }

    /**
     * Send The OTP ro the user email if email found
     */
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $user = $this->usersService->getByUsername($request->email);
        try {
            $this->usersService->sendOTP($user);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage());
        }
        return $this->apiResponse->success('OTP sent successfully');
    }


    /**
     * Verify the OTP and reset the password
     */
    public function verifyOTP(Request $request) {

    }


}
