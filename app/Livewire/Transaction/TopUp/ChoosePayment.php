<?php

namespace App\Livewire\Transaction\TopUp;

use App\Domains\Transaction\Service\TopUpService;
use App\Domains\Transaction\Validators\TopUpValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChoosePayment extends Component
{
    public array $banks;
    public $selectedBank = '';
    public $instantAmounts = [50000, 100000, 200000, 500000, 1000000];
    public $amount = '';
    public $customAmount = '';
    public $fee = 0;
    public $total = 0;

    public function mount(TopUpService $service)
    {
        $this->banks = $service->getAllBank();
        return $this->banks;
    }

    public function selectInstantAmount($val)
    {
        $this->amount = $val;
        $this->customAmount = '';
    }
    public function updatedCustomAmount($value)
    {
        if ($value) {
            $this->amount = $value;
        }
    }

    public function updatedSelectedBank($bankCode)
    {
        $bank = collect($this->banks)->firstWhere('bank_code', $bankCode);

        $this->fee = $bank['fee'] ?? 0;

        $this->calculateTotal();
    }

    protected function calculateTotal(): void
    {
        $this->total = (int) $this->amount + (int) $this->fee;
    }

    protected function rules(): array
    {
        return TopUpValidator::rules();
    }

    protected function messages(): array
    {
        return TopUpValidator::messages();
    }

    protected function validationAttributes(): array
    {
        return TopUpValidator::attributes();
    }

    public function submitTopUp(TopUpService $service)
    {

        $this->resetValidation();
        $this->validate();
        try {
            DB::beginTransaction();

            $amount = $this->amount;
            $vaNumber = $this->selectedBank . Auth::user()->phone_number;
            $totalPayment = $amount + $this->fee;
            $service->createTopUpTransaction(
                $amount,
                $this->fee,
                $totalPayment,
                $vaNumber,
            );

            DB::commit();

            return redirect()->route('status', ['vaNumber' => $vaNumber]);
        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

            $this->addError(
                'general',
                'Ada kesalahan di server. Silakan coba lagi nanti.'
            );
        }
    }

    public function render()
    {
        return view('livewire.transaction.top-up.choose-payment');
    }
}
