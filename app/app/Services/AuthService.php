<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class AuthService
{
    public function __construct(
        protected UserRepository $repo
    ) {}

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->repo->create($data);
    }

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            throw new \Exception('Invalid credentials');
        }

        return Auth::user();
    }

    public function logout()
    {
        $user = Auth::user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
    }
}