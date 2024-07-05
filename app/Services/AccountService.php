<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

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
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

       /**
     * Update user password
     *
     * @param integer $id
     * @param array $data
     * @return User
     */
    public function updatePassword(int $id, array $data):bool
    {

        $user = User::find($id);
        $oldPassword = $data['old_password'];
        if ( !Hash::check($oldPassword, $user->password) ) {
            return false;
        }

        return $user->update([
            'password' => Hash::make($data['password']),
        ]);
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
