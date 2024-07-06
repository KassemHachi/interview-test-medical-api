<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\GetProfileRequest;
use App\Http\Requests\UpdatePasswordProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function __construct(protected AccountService $accountService)
    {
    }

    public function get(GetProfileRequest $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function update(UpdateProfileRequest $request): UserResource
    {
        $user = $this->accountService->update($request->user()->id, $request->validated());

        return new UserResource($user);
    }

    public function updatePassword(UpdatePasswordProfileRequest $request): JsonResponse
    {
        $isPasswordUpdated = $this->accountService->updatePassword($request->user()->id, $request->validated());
        if (! $isPasswordUpdated) {
            return $this->error('Password not updated', 404);
        }

        return $this->success('Password updated successfully');
    }

    public function delete(DeleteProfileRequest $request): JsonResponse
    {
        $isDeleted = $this->accountService->delete($request->user()->id);
        if (! $isDeleted) {
            return $this->error('User not found', 404);
        }

        return $this->success('User deleted successfully');
    }
}
