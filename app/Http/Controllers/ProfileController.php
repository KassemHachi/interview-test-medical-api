<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\GetProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(protected AccountService $accountService){}

    public function get(GetProfileRequest $request):UserResource
    {
        return new UserResource($request->user());
    }

    public function update(UpdateProfileRequest $request):UserResource
    {
        $user = $this->accountService->update($request->user()->id, $request->validated());
        return new UserResource($user);
    }

    public function updatePassword(UpdateProfileRequest $request):UserResource
    {
        $user = $this->accountService->updatePassword($request->user()->id, $request->validated());
        return new UserResource($user);
    }

    public function delete(DeleteProfileRequest $request):JsonResponse
    {
        $isDeleted = $this->accountService->delete($request->user()->id);
        if (!$isDeleted) {
            return $this->error("User not found", 404);
        }
        return $this->success("User deleted successfully");
    }
}
