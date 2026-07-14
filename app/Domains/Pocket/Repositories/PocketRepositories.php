<?php

namespace App\Domains\Pocket\Repositories;

use App\Models\BankAccounts;
use App\Models\Pockets;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PocketRepositories
{

    public function getAllPocketByUser($userId): Collection
    {
        return Pockets::where('user_id', $userId)->get();
    }

    public function getMainBalance($userId)
    {
        return BankAccounts::where('user_id', $userId)->value('balance');
    }

    public function addPocket(
        $userId,
        $name,
        $balance_pocket,
        $goal_amount,
        $achivement_date_goal
    ): Pockets {
        $accountNumber = BankAccounts::where('user_id', $userId)->value('account_number');
        return Pockets::create([
            'user_id' => $userId,
            'name' => $name,
            'account_number' => $accountNumber,
            'balance' => $balance_pocket,
            'goal_amount' => $goal_amount,
            'achivement_date_goal' => $achivement_date_goal
        ]);
    }
}
