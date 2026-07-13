<?php

namespace App\Domains\Dashboard\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardRepositories
{

    public function getDashboardData(): User
    {
        return Auth::user()->load([
            'bankAcc',
        ]);
    }
}
