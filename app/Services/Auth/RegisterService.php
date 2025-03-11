<?php

namespace App\Services\Auth;

use App\Repositories\Users\UserInterface;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(array $data): array
    {
        $user = app(UserInterface::class)->store([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }
}
