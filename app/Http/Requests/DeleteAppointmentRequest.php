<?php

namespace App\Http\Requests;

use App\Enums\UserTypeEnum;
use App\Models\Appointment;
use Illuminate\Foundation\Http\FormRequest;

class DeleteAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        $appointment = Appointment::find($this->id);
        return $user->type == UserTypeEnum::DOCTOR->value && $appointment->doctor->id == $user->id ;
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
