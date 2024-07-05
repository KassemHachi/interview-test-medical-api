<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicalHistoryRequest;
use App\Http\Requests\DeleteMedicationRequest;
use App\Http\Requests\GetAllMedicalHistoriesRequest;
use App\Http\Requests\GetMedicalHistoryRequest;
use App\Http\Requests\UpdateMedicalHistoryRequest;
use App\Http\Resources\MedicalHistoryResource;
use App\Services\MedicalHistoryService;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    public function __construct(protected MedicalHistoryService $medicalHistoryService){}

    public function index(GetAllMedicalHistoriesRequest $request)
    {
        $medicalHistories= $this->medicalHistoryService->getMedicalHistories($request->user());
        return MedicalHistoryResource::collection($medicalHistories);
    }

    public function store(CreateMedicalHistoryRequest $request)
    {
        $medicalHistory=$this->medicalHistoryService->createMedicalHistory($request->validated(),$request->user());
        return new MedicalHistoryResource($medicalHistory);
    }

    public function show(int $id,GetMedicalHistoryRequest $request)
    {
        $medicalHistory=$this->medicalHistoryService->getMedicalHistory($id, $request->user());
        if(!$medicalHistory){
            return $this->error("Medical History not found", 404);
        }
        return new MedicalHistoryResource($medicalHistory);
    }

    public function update(int $id, UpdateMedicalHistoryRequest $request)
    {
        $medicalHistory=$this->medicalHistoryService->updateMedicalHistory($id, $request->validated(),$request->user());
        if(!$medicalHistory){
            return $this->error("Medical History not found", 404);
        }
        return new MedicalHistoryResource($medicalHistory);
    }

    public function destroy(int $id,DeleteMedicationRequest $request)
    {
        $medicalHistory=$this->medicalHistoryService->deleteMedicalHistory($id, $request->user());
        if(!$medicalHistory){
            return $this->error("Medical History not found", 404);
        }
        return $this->success("Medical History deleted successfully");
    }
}
