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
            throw new \Exception('Email already in use');
        }
        $user = User::create($data);
        return new UserResource($user);
    }

    public function updateUserProfile(array $data)
    {
        // check if the provided email in the request is different from the user email ?
        // this means the user is trying to update his email
        // at this point I have to check that the email the user is trying to set is unique
        // if it's being used then I shall throw an exception with a proper message
//        $updatable_fields = ['name',"email","phone"];
//        $_data =
        $new_user = auth()->user()->update($data);
        return new UserResource(auth()->user());
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
