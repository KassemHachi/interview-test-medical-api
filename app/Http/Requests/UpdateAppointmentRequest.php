<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use App\Models\Appointment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user->type == UserTypeEnum::DOCTOR->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'patient_id' => ['exists:users,id'],
           'date' => ['date'],
           'time' => ['string'],
           'reason' => ['string'],
        ];
    }
}
