<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class GetAllMedicalHistoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user->type == UserTypeEnum::DOCTOR->value || $user->type == UserTypeEnum::PATIENT->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
