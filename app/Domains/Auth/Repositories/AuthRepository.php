<?php

namespace App\Domains\Auth\Repositories;

use App\Models\BankAccounts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    private function generateAccountNumber(): string
    {
        do {

            $accountNumber = sprintf(
                '%04d-%04d-%04d',
                random_int(0, 9999),
                random_int(0, 9999),
                random_int(0, 9999)
            );
        } while (
            BankAccounts::where('account_number', $accountNumber)->exists()
        );

        return $accountNumber;
    }

    public function findByPhone(string $phone): ?User
    {
        return User::where('phone_number', $phone)->first();
    }

    public function registerUser(
        string $name,
        string $nickname,
        string $phone,
        string $password
    ): User {
        $user = User::create([
            'name' => $name,
            'nickname' => $nickname,
            'phone_number' => $phone,
            'password' => Hash::make($password),
        ]);

        BankAccounts::create([
            'user_id' => $user->id,
            'account_number' => $this->generateAccountNumber(),
            'balance' => 0,
        ]);

        return $user;
    }
}
