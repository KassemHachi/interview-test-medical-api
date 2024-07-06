<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateMedicalHistoryRequest extends FormRequest
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
            'diagnosis' => ['required', 'string'],
            'treatment' => ['required', 'string'],
            'notes' => ['string'],
        ];
    }
}
