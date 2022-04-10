<?php

namespace App\Services\User;

use App\Http\Resources\User\UserResource;
use App\Models\User;

class UsersService
{

    public function registerUser(array $data)
    {
        // check if email is already in use
        if (User::where('email', $data['email'])->first()) {
            return [
                'status' => false,
                'message' => 'Email already in use'
            ];
        }
        $user = User::create($data);
        return new UserResource($user);
    }

    /**
     * Get a single user by its username
     *
     * @param string $username
     * @return UserResource
     */
    public function getByUsername(string $username): UserResource
    {
        return new UserResource(User::where('email', $username)->first());
    }

    /*
     *
     */
    public function sendOTP(UserResource $user)
    {

    }

}
