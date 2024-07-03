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
    public function get(int $id,User $user):Appointment|null
    {
        $appointment= Appointment::find($id);
        if (!$appointment ||( $appointment->doctor_id != $user->id && $appointment->patient_id != $user->id)) {
            return null;
        }
        return $appointment;
    }

    /**
     * update an appointment
     *
     * @param integer $id
     * @param array $data
     * @return Appointment
     */
    public function update(int $id, array $data, User $user):Appointment|null
    {
        $appointment = $appointment= Appointment::find($id);
        if (!$appointment || $appointment->doctor_id != $user->id) {
            return null;
        }
        $appointment->update($data);
        return $appointment;
    }

    /**
     * delete an appointment
     *
     * @param Appointment $appointment
     * @return void
     */
    public function delete(int $id,User $user):bool
    {
        $appointment =  $appointment= Appointment::find($id);;
        if (!$appointment || $appointment->doctor_id != $user->id) {
            return false;
        }
        return  $appointment->delete();
    }
}
