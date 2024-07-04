<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePrescriptionRequest;
use App\Http\Requests\GetAllPrescriptionsRequest;
use App\Http\Requests\GetPrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Http\Resources\PrescriptionResource;
use App\Services\PrescriptionService;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function __construct(protected PrescriptionService $prescriptionService){}

    public function index(GetAllPrescriptionsRequest $request)
    {
        $prescriptions = $this->prescriptionService->getPresriptions($request->user());
        return PrescriptionResource::collection($prescriptions);
    }

    public function store(CreatePrescriptionRequest $request)
    {
        $prescription = $this->prescriptionService->createPrescription($request->validated(),$request->user());
        if (!$prescription) {
            return $this->error("Prescription not created, please try again", 404);
        }
        return new PrescriptionResource($prescription);
    }

    public function show(int $id,GetPrescriptionRequest $request)
    {
        $prescription = $this->prescriptionService->getPrescription($id, $request->user());
        if (!$prescription) {
            return $this->error("Prescription not found", 404);
        }
        return new PrescriptionResource($prescription);
    }

    public function update(int $id, UpdatePrescriptionRequest $request,)
    {
        $prescription = $this->prescriptionService->updatePrescription($id, $request->validated(),$request->user());
        if (!$prescription) {
            return $this->error("Prescription not created, please try again", 404);
        }
        return new PrescriptionResource($prescription);
    }

    public function destroy(int $id)
    {
        $isDeleted = $this->prescriptionService->deletePrescription($id);
        if (!$isDeleted) {
            return $this->error("Prescription not found", 404);
        }
        return $this->success("Prescription deleted successfully");
    }
}
