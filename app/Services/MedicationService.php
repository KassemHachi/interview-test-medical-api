<?php

namespace App\Services;

use App\Models\Medication;
use Illuminate\Database\Eloquent\Collection;

class MedicationService
{

    /**
     * Create a new medication
     *
     * @param array $data
     * @return Medication
     */
    public function createMedication(array $data):Medication
    {
        return Medication::create($data);
    }

    /**
     * Update a medication
     *
     * @param integer $id
     * @param array $data
     * @return Medication
     */
    public function updateMedication(int $id, array $data):Medication|null
    {
        $medication = $this->getMedication($id);
        if ($medication){
            $medication->update($data);
        }
        return $medication;
    }

    /**
     * Get a medication
     *
     * @param integer $id
     * @return Medication|null
     */
    public function getMedication(int $id):Medication|null
    {
        $medication =  Medication::findorFail($id);
        if (!$medication){
            return null;
        }
        return  $medication;
    }

    /**
     * Get all medications
     *
     * @return Collection
     */
    public function getAllMedications():Collection
    {
        return Medication::all();
    }

    /**
     * Delete a medication
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteMedication(int $id):bool
    {
        $medication = $this->getMedication($id);
        if (!$medication){
            return false;
        }
       return $medication->delete();
    }

}
