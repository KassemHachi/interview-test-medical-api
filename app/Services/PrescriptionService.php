<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\Prescription;
use App\Models\PrescriptionMedication;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PrescriptionService
{

    /**
     * get all prescriptions related users
     *
     * @param User $user
     * @return Collection
     */
    public function getPresriptions(User $user):Collection
    {
        if ($user->type == UserTypeEnum::DOCTOR->value) {
            return $user->doctorPrescriptions;
        }elseif ($user->type == UserTypeEnum::PATIENT->value) {
            return $user->patientPrescriptions;
        }
    }

    /**
     * get one prescription
     *
     * @param integer $id
     * @param User $user
     * @return Prescription|null
     */
    public function getPrescription(int $id ,User $user):Prescription|null
    {
        $prescription= Prescription::find($id);
        if (!$prescription ||( $prescription->doctor_id != $user->id && $prescription->patient_id != $user->id)) {
            return null;
        }
        return $prescription;
    }

    /**
     * Create a new Prescription
     *
     * @param array $data
     * @param User $doctor
     * @return Prescription
     */
    public function createPrescription(array $data,User $doctor):Prescription
    {
        return DB::transaction(function () use ($data, $doctor) {
            // Create the prescription
            $prescription = new Prescription();
            $prescription->patient_id = $data['patient_id'];
            $prescription->notes = $data['notes'] ?? '';
            $doctor->doctorPrescriptions()->save($prescription);

            // Create prescription medications
            $medications = array_map(function ($medicationData) {
                return new PrescriptionMedication($medicationData);
            }, $data['prescription_medications']);

            $prescription->prescription_midications()->saveMany($medications);

            return $prescription;
        });
    }

    /**
     * update a prescription with its medications
     *
     * @param integer $id
     * @param array $data
     * @param User $user
     * @return Prescription|null
     */
    public function updatePrescription(int $id, array $data,User $user):Prescription|null
    {

        return DB::transaction(function () use ($data, $id) {

            $prescription = Prescription::findOrFail($id);
            $prescription->patient_id = $data['patient_id'];
            $prescription->notes = $data['notes'] ?? '';
            $prescription->save();

            $existingMedicationIds = $prescription->prescription_midications->pluck('id')->toArray();
            $newMedicationIds = array_filter(array_column($data['prescription_medications'], 'id'));

            $medicationsToDelete = array_diff($existingMedicationIds, $newMedicationIds);
            PrescriptionMedication::destroy($medicationsToDelete);

            foreach ($data['prescription_medications'] as $medicationData) {
                if (isset($medicationData['id'])) {
                    $medication = PrescriptionMedication::findOrFail($medicationData['id']);
                    $medication->update($medicationData);
                } else {
                    $prescription->prescription_midications()->create($medicationData);
                }
            }

            return $prescription;
        });
    }

    /**
     * Delete a prescription
     *
     * @param integer $id
     * @return boolean
     */
    public function deletePrescription(int $id):bool
    {
        $prescription = Prescription::findOrFail($id);
        if (!$prescription) {
            return false;
        }
        return $prescription->delete();
    }
}
