<?php

namespace App\Services;

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

        if(auth()->user()->email == $data["email"]){
            throw new \Exception("This Email already in use!!");
        }
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


    /**
     * @param string $email
     * @return User
     */
    public function generateOTP(User $user): User
    {
        $user->otp = rand(10000, 99999);
        $user->otp_expiry = now()->addMinutes(5);
        $user->save();
        return $user;
    }

    public function resetPassword(User $user, mixed $password)
    {
        $user->password = $password;
        // reset the otp and otp_epiry
        $user->otp = null;
        $user->otp_expiry = null;
        $user->save();
    }

    public function checkOTP(User $user, $otp)
    {
        if ($user->otp_expiry < now()) {
            throw new \Exception('OTP expired');
        } elseif ($user->otp != $otp) {
            throw new \Exception('Invalid OTP');
        }
        return true;
    }

    public function getByEmail($email)
    {
        $user = User::where('email', $email)->first();
        if (! $user) {
            throw new \Exception('User not found');
        }
        return $user;
    }


}
