<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendVerificationEmailRequest;
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

    public function register(RegisterRequest $request)
    {
        $registeredUser = $this->authService->register($request->validated());
        if (! $registeredUser) {
            return $this->error('Invalid login, please try again');
        }
        [$token,$user] = $registeredUser;

        return new JsonResource(['user' => new UserResource($user), 'token' => $token]);
    }

    public function sendVerificationEmail(SendVerificationEmailRequest $request)
    {

      try {
        $this->authService->sendVerificationEmail($request->user());
        return $this->success("Verification email sent successfully");
      } catch (\Throwable $th) {
        return $this->error("There is error sending verification email", 500);
      }
    }

    public function verifyPinEmail(string $pin, Request $request)
    {
        $verified = $this->authService->verifyPinEmail($pin, $request->user());
        if (!$verified){
            return $this->error('Invalid pin, please try again',404);
        }
        return $this->success("Email verified successfully");
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
       $isSent = $this->authService->forgetPassword($request->validated());
       if (!$isSent) {
           return $this->error('Invalid email, please try again',404);
       }
       return $this->success("Email sent successfully");
    }

    public function resetPassword(string $pin , ResetPasswordRequest $request)
    {
       $user= $this->authService->resetPassword($pin,$request->validated());
       if (!$user) {
           return $this->error('Invalid pin, please try again',404);
       }
       return UserResource::make($user);
    }
}
