<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AccountService;

class PatientController extends Controller
{
    public function __construct(protected AccountService $accountService)
    {
    }

    public function index()
    {
        $pateints = $this->accountService->getPatients();

        return UserResource::collection($pateints);
    }

    public function get($id)
    {
        $pateint = User::find($id);
        if (! $pateint || $pateint->type != UserTypeEnum::PATIENT->value) {
            return $this->error('Patient not found', 404);
        }

        return new UserResource($pateint);
    }
}
