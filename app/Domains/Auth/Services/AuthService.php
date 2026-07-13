<?php

namespace App\Domains\Auth\Services;

use App\Baseapp\AppException;
use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Repositories\AuthRepository;
use App\Models\User;

class AuthService
{
    public function __construct(
        protected AuthRepository $repository
    ) {}

    public function attempt(string $phone, string $password): User
    {
        $user = $this->repository->findByPhone($phone);

        if (!$user) {
            throw new AppException(
                message: 'Nomor HP belum terdaftar.',
                errorCode: 'PHONE_NOT_FOUND',
                field: 'phone'
            );
        }

        if (!Hash::check($password, $user->password)) {
            throw new AppException(
                message: 'Password salah.',
                errorCode: 'INVALID_PASSWORD',
                field: 'password'
            );
        }

        return $user;
    }
}
