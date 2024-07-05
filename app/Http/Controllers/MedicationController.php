<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicationRequest;
use App\Http\Requests\GetAllMedicationsRequest;
use App\Http\Requests\GetMedicationRequest;
use App\Http\Resources\MedicationResource;
use App\Services\MedicationService;

class MedicationController extends Controller
{
    public function __construct(protected MedicationService $medicationService){}

    public function index(GetAllMedicationsRequest $request)
    {
        $medications = $this->medicationService->getAllMedications();
        return MedicationResource::collection($medications);
    }

    public function store(CreateMedicationRequest $request)
    {
        $medication = $this->medicationService->createMedication($request->validated());
        return new MedicationResource($medication);
    }

    public function show(int $id, GetMedicationRequest $request)
    {
        $medication = $this->medicationService->getMedication($id);
        if (!$medication) {
            return $this->error("Medication not found", 404);
        }
        return new MedicationResource($medication);
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
