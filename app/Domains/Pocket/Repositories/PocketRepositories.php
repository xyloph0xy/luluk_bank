<?php

namespace App\Domains\Pocket\Repositories;

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
}
