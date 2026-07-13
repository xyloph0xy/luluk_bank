<?php

namespace App\Domains\Auth\Repositories;

use App\Models\User;

class AuthRepository
{
    public function findByPhone(string $phone): ?User
    {
        return User::where('phone_number', $phone)->first();
    }
}