<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AppointmentService
{

    /**
     * Create an appointment
     *
     * @param array $data
     * @param User $doctor
     * @return Appointment
     */
    public function store(array $data, User $doctor):Appointment
    {
        $appointment = new Appointment($data);
        $doctor->doctorAppointments()->save($appointment);
        return $appointment;
    }

    /**
     * get all appointments related to user
     *
     * @param User $user
     * @return Collection
     */
    public function all(User $user):Collection
    {
        if ($user->type == UserTypeEnum::DOCTOR->value) {
            return $user->doctorAppointments;
        }elseif ($user->type == UserTypeEnum::PATIENT->value) {
            return $user->patientAppointments;
        }
    }

    /**
     * get one appointment
     *
     * @param integer $id
     * @return Appointment
     */
    public function get(int $id):Appointment
    {
        $appointment= Appointment::find($id);
        return $appointment;
    }

}
