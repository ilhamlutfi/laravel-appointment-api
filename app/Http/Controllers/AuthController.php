<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {

    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->registerAttempt($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }
}
