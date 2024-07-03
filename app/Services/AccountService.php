<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AccountService
{
    /**
     * Get all doctors from database
     *
     * @return Collection
     */
    public function getDoctors():Collection
    {
        return User::where('type', UserTypeEnum::DOCTOR->value)->get();
    }
}
