<?php

namespace App\Services;

use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\VerificationPin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class AuthService
{

    public function __construct(   protected Redis $cache, protected Mail $mailer)
    {
    }

    /**
     * login user function
     *
     * @param array $data
     * @return array [$token, $user]
     */
    public function login(array $data):array
    {
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;
        $password = $data['password'];

        $user = User::when($email, fn ($query) => $query->where('email', $email))
            ->when($phone, fn ($query) => $query->where('phone', $phone))
            ->first();

        $isPasswordValid = Hash::check($password, $user->password);
        if (! $isPasswordValid || ! $user) {
            return false;
        }
        $token = $user->createToken($user->name, ['*'], now()->addDay())->plainTextToken;

        return [$token, $user];

    }

    public function register(array $data):array
    {
       try {
        $user = User::create($data);

        $token = $user->createToken($user->name, ['*'], now()->addDay())->plainTextToken;

        return [$token, $user];
       } catch (\Throwable $th) {
        return null;
       }
    }

    public function sendVerificationEmail(User $user){
        $pin = Str::random(15);
        $this->mailer::to($user)->send(new VerifyEmail(pin: $pin));
        VerificationPin::create([
            'name' => $user->name,
            'pin' => $pin,
            'expired_at' => now()->addHour(5)
        ]);
        return $pin;

    }

    public function verifyPinEmail(string $pin,User $user){
        $pin =  VerificationPin::where('pin', $pin)->where('expired_at', '>', now())->first();
        if (!$pin){
            return false;
        }
        $pin->delete();
        $user->update(['email_verified_at' => now()]);
        return true;
    }

    public function forgetPassword(array $data){
        try {

        $email = $data["email"];
        $user = User::where("email",$email)->first();
        $pin = Str::random(15);
        $this->mailer::to($user)->send(new VerifyEmail(pin: $pin));
        VerificationPin::create([
            'name' => $user->name,
            'pin' => $pin,
            'expired_at' => now()->addHour(5)
        ]);
        return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function resetPassword(string $pin ,array $data){

        $user = User::where('email', $data['email'])->first();
        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        $pin =  VerificationPin::where('pin', $pin)->where('expired_at', '>', now())->first();
        $pin->delete();
        return $user;
    }

}
