<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\User;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public final function __construct(protected AppointmentService $appointmentService){}

    public function store(CreateAppointmentRequest $request)
    {
        $data= $request->validated();
        $doctor = $request->user();
        $patient = User::find($data['patient_id']);

        if ($patient->type != UserTypeEnum::PATIENT->value){
           return   $this->error("Patient not found", 404);;
        }

        $appointment =  $this->appointmentService->store($data,$doctor);


        return new AppointmentResource($appointment);
    }
}
