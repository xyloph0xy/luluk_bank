<?php

namespace App\Domains\Transaction\Repositories;

use App\Models\MasterSupportedBanks;
use App\Models\TopUpTransaction;

class TopUpRepositories
{

    public function getAllActiveSupportedBank(): array
    {
        return MasterSupportedBanks::where('is_active', true)->get()->toArray();
    }

    public function getDetailPaymentByVA($va): TopUpTransaction
    {
        return TopUpTransaction::where('va_number', $va)->latest()->first();
    }


    public function checkStatusTopup($userID, $vaNumber): string
    {
        return TopUpTransaction::where('user_id', $userID)
            ->where('va_number', $vaNumber)
            ->latest()
            ->first()
            ->value('status');
    }


    public function createTopUpTransaction(
        $userID,
        $vaNumber,
        $accountNumber,
        $nominal,
        $fee,
        $totalPayment,
        $expiredAt
    ): TopUpTransaction {
        $data=[
            'user_id'        => $userID,
            'va_number'      => $vaNumber,
            'account_number' => $accountNumber,
            'nominal'        => $nominal,
            'admin_fee'            => $fee,
            'total_payment'  => $totalPayment,
            'status'         => 'PENDING',
            'expired_at'     => $expiredAt,
        ];

        return TopUpTransaction::create($data);
    }
}
