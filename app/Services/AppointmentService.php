<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\Appointment;
use App\Models\User;

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

}
