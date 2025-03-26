<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();
        if(!$user|| !Hash::check($password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Неверные данные'],
            ]);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        DB::table('personal_access_tokens')->where('token', hash('sha256', explode('|', $token)[1]))
            ->update(['expires_at' => \Carbon\Carbon::now()->addDays(10)]);
        return ['token' => $token,'user'=>$user];
    }
}
