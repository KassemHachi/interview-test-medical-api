<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\MedicalHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class MedicalHistoryService
{

    /**
     * Get all medical histories that related to user
     *
     * @param User $user
     * @return Collection
     */
    public function getMedicalHistories(User $user):Collection
    {
        if ($user->type == UserTypeEnum::DOCTOR->value) {
            return $user->doctorMedicalHistories;
        }elseif ($user->type == UserTypeEnum::PATIENT->value) {
            return $user->patientMedicalHistories;
        }
    }

    /**
     * Get one medical history
     *
     * @param integer $id
     * @return MedicalHistory|null
     */
    public function getMedicalHistory(int $id,User $user):?MedicalHistory
    {
        if ($user->type == UserTypeEnum::DOCTOR->value) {
            return $user->doctorMedicalHistories->find($id);
        }elseif ($user->type == UserTypeEnum::PATIENT->value) {
            return $user->patientMedicalHistories->find($id);
        }
    }

    /**
     * Create a new medical history
     *
     * @param array $data
     * @return MedicalHistory
     */
    public function createMedicalHistory(array $data, User $doctor):MedicalHistory
    {
        $medicalHistory = new MedicalHistory($data);
        $doctor->doctorMedicalHistories()->save($medicalHistory);
        return $medicalHistory;
    }

    /**
     * Update a medical history
     *
     * @param integer $id
     * @param array $data
     * @return MedicalHistory|null
     */
    public function updateMedicalHistory(int $id,array $data,User $doctor): ?MedicalHistory
    {
        $medicalHistory = $doctor->doctorMedicalHistories->find($id);
        if (!$medicalHistory) {
            return null;
        }
        $medicalHistory->update($data);
        return $medicalHistory;
    }

    /**
     * Delete a medical history
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteMedicalHistory(int $id,User $doctor):bool
    {
        $medicalHistory = $doctor->doctorMedicalHistories->find($id);
        if (!$medicalHistory) {
            return false;
        }
        return $medicalHistory->delete();
    }

}
