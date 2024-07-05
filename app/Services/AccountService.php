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

    /**
     * Get all patients from database
     *
     * @return Collection
     */
    public function getPatients():Collection
    {
        return User::where('type', UserTypeEnum::PATIENT->value)->get();
    }

    /**
     * Update user information
     *
     * @param integer $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data):User
    {
        return User::find($id)->update($data);
    }

    /**
     * Delete user
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id):bool
    {
        return User::find($id)->delete();
    }
}
