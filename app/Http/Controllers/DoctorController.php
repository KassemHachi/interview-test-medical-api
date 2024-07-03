<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\AccountService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(protected AccountService $accountService){}

    public function index(){
        $doctors = $this->accountService->getDoctors();
        return UserResource::collection($doctors);
    }
}
