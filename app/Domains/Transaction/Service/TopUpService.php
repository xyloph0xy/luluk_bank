<?php

namespace App\Domains\Transaction\Service;

use App\Domains\Transaction\Repositories\TopUpRepositories;
use App\Models\TopUpTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TopUpService
{

    public function __construct(
        protected TopUpRepositories $repository
    ) {}

    public function getAllBank(): array
    {
        return $this->repository->getAllActiveSupportedBank();
    }
    

    public function getDetailPaymentByVA($va): TopUpTransaction
    {
        return $this->repository->getDetailPaymentByVA($va);
    }

    

    public function createTopUpTransaction($nominal, $fee, $totalPayemnt, $vaNumber)
    {
        $user = Auth::user()->load('bankAcc');
      
        $accountBank = $user->bankAcc;

        return $this->repository->createTopUpTransaction(
            $user->id,
            $vaNumber,
            $accountBank->account_number,
            $nominal,
            $fee,
            $totalPayemnt,
            now()->addHours(24),
        );
    }

    public function checkStatusTopup($userId, $vaNumber): string
    {
        return $this->repository->checkStatusTopup($userId, $vaNumber);
    }
    
}
