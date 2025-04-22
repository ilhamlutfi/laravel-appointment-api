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
}
