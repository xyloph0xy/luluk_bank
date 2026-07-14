<?php

namespace App\Domains\Pocket\Service;


use App\Domains\Pocket\Repositories\PocketRepositories;
use App\Models\Pockets;
use Illuminate\Database\Eloquent\Collection;

class PocketService
{
    public function __construct(
        protected PocketRepositories $repository
    ) {}

    public function getAllPocket($userId): Collection
    {
        return $this->repository->getAllPocketByUser($userId);
    }

    public function getBalance($userId)
    {
        return $this->getAllPocket($userId)->sum('balance');;
    }

    public function getMainBalance($userId)
    {
        return $this->repository->getMainBalance($userId);
    }

    public function addPocket(
        $userId,
        $name,
        $balance_pocket,
        $goal_amount,
        $achivement_date_goal
    ): ?Pockets {
        return $this->repository->addPocket(
            $userId,
            $name,
            $balance_pocket,
            $goal_amount,
            $achivement_date_goal
        );
    }
}
