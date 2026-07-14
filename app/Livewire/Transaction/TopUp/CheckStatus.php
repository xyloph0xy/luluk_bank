<?php

namespace App\Livewire\Transaction\TopUp;

use App\Domains\Transaction\Service\TopUpService;
use App\Models\BankAccounts;
use App\Models\TopUpTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckStatus extends Component
{
    public $vaNumber;
    public $transaction;
    public $status;

    protected TopUpService $topUpService;

    public function boot(TopUpService $topUpService)
    {
        $this->topUpService = $topUpService;
    }

    public function mount($vaNumber)
    {
        $this->vaNumber = $vaNumber;
        $this->transaction = $this->topUpService->getDetailPaymentByVA($vaNumber);
        $this->checkStatus();
    }

    public function checkStatus()
    {
        try {
            $user = Auth::user();
            $this->status = $this->topUpService->checkStatusTopup($user->id, $this->vaNumber);

            if ($this->status === 'SUCCESS') {
                session()->flash('success', 'Pembayaran berhasil terverifikasi!');
            }
        } catch (\Throwable $th) {
            report($th);

            $this->addError(
                'general',
                'Ada kesalahan di server. Silakan coba lagi nanti.'
            );
        }
    }

    public function simulatePayment()
    {
        try {
            DB::beginTransaction();

            $userId = Auth::id();
            $transaction = TopUpTransaction::where('va_number', $this->vaNumber)
                ->where('user_id', $userId)
                ->latest()
                ->firstOrFail();

            $transaction->update([
                'status' => 'PAID',
            ]);

            $account = BankAccounts::where('user_id', $userId)
                ->firstOrFail();
            
            $total = $account->balance + $transaction->nominal;

            $account->update([
                'balance' =>$total,
            ]);



            DB::commit();
            $this->checkStatus();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
