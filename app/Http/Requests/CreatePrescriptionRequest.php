<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreatePrescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->type == UserTypeEnum::DOCTOR->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'exists:users,id'],
            'prescription_medications' => ['required', 'array', 'min:1'],
            'prescription_medications.*.medication_id' => ['required', 'exists:medications,id'],
            'prescription_medications.*.dosage' => ['required', 'string'],
            'prescription_medications.*.frequency' => ['required', 'string'],
            'prescription_medications.*.start_date' => ['required', 'date'],
            'prescription_medications.*.end_date' => ['required', 'date', 'after_or_equal:prescription_medications.*.start_date'],
            'notes' => ['string'],
        ];
    }
}
