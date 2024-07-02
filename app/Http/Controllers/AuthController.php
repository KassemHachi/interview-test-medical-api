<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function login(LoginRequest $request): JsonResource|JsonResponse
    {

        $authenticatedUser = $this->authService->login($request->validated());
        if (! $authenticatedUser) {
            return $this->error('Invalid login, please try again');
        }
        [$token,$user] = $authenticatedUser;

        return new JsonResource(['user' => new UserResource($user), 'token' => $token]);

    }

    public function register(Request $request)
    {
        // Logic for register user
    }

    public function verifyEmail(Request $request)
    {
        // Logic for verifying user
    }

    public function forgetPassword(Request $request)
    {
        // Logic for password recovery
    }

    public function resetPassword(Request $request)
    {
        // Logic for setting a new password
    }
}
