<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $service
    ) {}

    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->service->login($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        $this->service->logout();

        return response()->json(['message' => 'Logged out']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}