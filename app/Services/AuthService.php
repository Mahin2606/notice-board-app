<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function checkPassword(User $user, $password)
    {
        return Hash::check($password, $user->password);
    }
}
