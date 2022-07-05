<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function Register(string $name, string $email, string $password) {
        if (User::where('email', '=', $email)->exists()) {
            return false;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        return true;
    }
}
