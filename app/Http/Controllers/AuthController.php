<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\UserResource;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {

    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authService->registerAttempt($request->validated());

            return new UserResource(true, 'User registered successfully', $user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User registration failed',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->authService->loginAttempt($request->validated());

            return new UserResource(true, 'User logged in successfully', $user, $user->token);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User login failed',
                'error' => $e->getMessage(),
            ], 401);
        }
    }
}
