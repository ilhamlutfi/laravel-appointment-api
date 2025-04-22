<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function registerAttempt(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'patient'
        ]);

        return $user;
    }

    public function loginAttempt(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        // Check if the user exists & check if the password is correct & generate the token
        if (!$token = auth()->attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        $user = auth()->user();
        $user->token = $token;

        return $user;
    }
}
