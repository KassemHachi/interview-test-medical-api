<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\DeleteAppointmentRequest;
use App\Http\Requests\GetAllAppointments;
use App\Http\Requests\GetOneAppointment;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\User;
use App\Services\AppointmentService;

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

    public function index(GetAllAppointments $request)
    {
        $user = $request->user();
        $appointment = $this->appointmentService->all($user);
        return AppointmentResource::collection($appointment);
    }

    public function get(int $id,GetOneAppointment $request)
    {
        $appointment = $this->appointmentService->get($id, $request->user());
        if (!$appointment) {
            return $this->error("Appointment not found", 404);
        }
        return new AppointmentResource($appointment);
    }

    public function update(int $id, UpdateAppointmentRequest $request)
    {
        $appointment = $this->appointmentService->update($id,$request->validated(), $request->user());
        if (!$appointment) {
            return $this->error("Appointment not found", 404);
        }
        return new AppointmentResource($appointment);
    }

    public function delete(int $id,DeleteAppointmentRequest $request)
    {
        $isDeleted = $this->appointmentService->delete($id, $request->user());
        if (!$isDeleted) {
            return $this->error("Appointment not found", 404);
        }
        return $this->success("Appointment deleted successfully");
    }
}
