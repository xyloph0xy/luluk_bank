<?php

namespace App\Domains\Dashboard\Service;

use App\Domains\Dashboard\Repositories\DashboardRepositories;
use App\Models\User;

class DashboardService
{
    public function __construct(
        protected DashboardRepositories $repository
    ) {}

    public function dashboard(): User
    {
        return $this->repository->getDashboardData();
    }
}
