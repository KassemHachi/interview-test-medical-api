<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    /**
     * login user function
     *
     * @param array $data
     * @return array [$token, $user]
     */
    public function login(array $data):array
    {
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;
        $password = $data['password'];

        $user = User::when($email, fn ($query) => $query->where('email', $email))
            ->when($phone, fn ($query) => $query->where('phone', $phone))
            ->first();

        $isPasswordValid = Hash::check($password, $user->password);
        if (! $isPasswordValid || ! $user) {
            return false;
        }
        $token = $user->createToken($user->name ?? '', ['*'], now()->addDay())->plainTextToken;

        return [$token, $user];

    }

}
