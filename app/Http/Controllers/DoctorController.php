<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\GetOneDoctorRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AccountService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(protected AccountService $accountService){}

    public function index(){
        $doctors = $this->accountService->getDoctors();
        return UserResource::collection($doctors);
    }

    public function get($id){
        $doctor = User::find($id);
        if(!$doctor || $doctor->type != UserTypeEnum::DOCTOR->value) {
            return $this->error("Doctor not found", 404);
        }
        return new UserResource($doctor);
    }
}
