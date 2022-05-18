<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\UsersService;
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
    public function requestReset(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            $user = $this->usersService->getByEmail($request->email);
            if ($user->otp_expiry < now()) {
                $this->usersService->generateOTP($user);
            } else {
                throw new \Exception('OTP already sent');
            }
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage())->return();
        }

        return $this->apiResponse->success('OTP sent successfully')->return();
    }

    /**
     * Verify the OTP and reset the password
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|integer',
        ]);
        $user = $this->usersService->getByEmail($request->email);

        try {
            $this->usersService->checkOTP($user, $request->otp);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage())->return();
        }

        return $this->apiResponse->success('OTP valid')->return();
    }

    /**
     * Reset the password
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
            "otp" => 'required|integer',
        ]);
        $user = $this->usersService->getByEmail($request->email);

        try {
            $this->usersService->checkOTP($user, $request->otp);
            $this->usersService->resetPassword($user, $request->password);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage())->return();
        }

        return $this->apiResponse->success('Password reset successfully')->return();
    }
}
