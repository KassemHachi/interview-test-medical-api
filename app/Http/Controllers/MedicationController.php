<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAllMedicationsRequest;
use App\Http\Resources\MedicationResource;
use App\Services\MedicationService;

class MedicationController extends Controller
{
    public function __construct(protected MedicationService $medicationService){}

    public function index(GetAllMedicationsRequest $request)
    {
        $medications = $this->medicationService->getAllMedications();
        return new MedicationResource($medications);
    }

    public function store()
    {
        //
    }

    public function show()
    {
        //
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
