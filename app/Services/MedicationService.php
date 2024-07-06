<?php

namespace App\Services;

use App\Models\Medication;
use Illuminate\Database\Eloquent\Collection;

class MedicationService
{
    /**
     * Create a new medication
     */
    public function createMedication(array $data): Medication
    {
        return Medication::create($data);
    }

    /**
     * Update a medication
     */
    public function updateMedication(int $id, array $data): ?Medication
    {
        $medication = $this->getMedication($id);
        if ($medication) {
            $medication->update($data);
        }

        return $medication;
    }

    /**
     * Get a medication
     */
    public function getMedication(int $id): ?Medication
    {
        $medication = Medication::find($id);
        if (! $medication) {
            return null;
        }

        return $medication;
    }

    /**
     * Get all medications
     */
    public function getAllMedications(): Collection
    {
        return Medication::all();
    }

    /**
     * Delete a medication
     */
    public function deleteMedication(int $id): bool
    {
        $medication = $this->getMedication($id);
        if (! $medication) {
            return false;
        }

        return $medication->delete();
    }
}
