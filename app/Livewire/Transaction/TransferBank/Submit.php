<?php

namespace App\Livewire\Transaction\TransferBank;


use App\Domains\Transaction\Service\TopUpService;
use App\Domains\Transaction\Validators\TransferValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Submit extends Component
{
    // Form Properties
    public $amount;
    public $remark;
    public $selectedBank = null;
    public $banks = [];

    // PIN Properties
    public $hasPin = false; // Status apakah user sudah punya PIN di DB
    public $pinInput = ''; 
    public $showPinModal = false;

    public function mount(TopUpService $service)
    {
        $this->banks = $service->getAllBank();
        
        // Cek apakah user sudah memiliki PIN di database
        $account = DB::table('bank_accounts')->where('user_id', auth()->id())->first();
        $this->hasPin = !empty($account->pin);
    }

    protected function rules(): array
    {
        return array_merge(TransferValidator::rules(), [
            'selectedBank' => 'required|string',
        ]);
    }

    public function submitTransfer()
    {
        $this->resetValidation();
        $this->validate();

        // Cek saldo
        $currentBank = collect($this->banks)->firstWhere('bank_code', $this->selectedBank);
        $adminFee = $currentBank['fee'] ?? 6500;
        $totalAmount = (float)$this->amount + $adminFee;

        $account = DB::table('bank_accounts')->where('user_id', auth()->id())->first();

        if (!$account || $totalAmount > $account->balance) {
            $this->addError('amount', 'Saldo tidak mencukupi. Saldo Anda: Rp ' . number_format($account->balance ?? 0, 0, ',', '.'));
            return;
        }

        // Sinkronisasi status kepemilikan PIN terbaru sebelum memunculkan modal
        $this->hasPin = !empty($account->pin);
        $this->pinInput = '';
        $this->showPinModal = true;
    }

    public function verifyAndProcess()
    {
        $this->validate([
            'pinInput' => 'required|digits:6',
        ], [
            'pinInput.required' => 'PIN wajib diisi.',
            'pinInput.digits' => 'PIN harus terdiri dari 6 digit angka.',
        ]);

        $account = DB::table('bank_accounts')->where('user_id', auth()->id())->first();
        
        $currentBank = collect($this->banks)->firstWhere('bank_code', $this->selectedBank);
        $adminFee = $currentBank['fee'] ?? 6500;
        $totalAmount = (float)$this->amount + $adminFee;

        try {
            DB::beginTransaction();

            // Skenario pembuatan PIN baru jika belum punya
            if (!$this->hasPin) {
                DB::table('bank_accounts')
                    ->where('user_id', auth()->id())
                    ->update([
                        'pin' => Hash::make($this->pinInput),
                        'updated_at' => Carbon::now(),
                    ]);
                
                $this->hasPin = true;
            } else {
                // Skenario verifikasi jika sudah punya PIN
                if (!Hash::check($this->pinInput, $account->pin)) {
                    $this->addError('pinInput', 'PIN yang Anda masukkan salah.');
                    DB::rollBack();
                    return;
                }
            }

            // Validasi double-check saldo di dalam database transaction block
            if (!$account || $totalAmount > $account->balance) {
                $this->addError('amount', 'Saldo tidak mencukupi.');
                DB::rollBack();
                return;
            }

            // Potong saldo akun pengguna
            DB::table('bank_accounts')
                ->where('user_id', auth()->id())
                ->decrement('balance', $totalAmount);

            // Log detail data transaksi
            $referenceNo = 'TRF-' . strtoupper(Str::random(12));
            $localPayload = [
                'info' => 'Instant success internal bypass',
                'channel' => 'Direct DB Write',
                'selected_bank' => $this->selectedBank,
            ];

            DB::table('bank_transfer_transactions')->insert([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'reference_no' => $referenceNo,
                'amount' => $this->amount,
                'admin_fee' => $adminFee,
                'total_amount' => $totalAmount,
                'remark' => $this->remark,
                'transaction_id' => 'TX-' . rand(10000000, 99999999),
                'status' => 'SUCCESS',
                'response_code' => '00',
                'response_message' => 'SUCCESS_APPROVED',
                'processed_at' => Carbon::now(),
                'response_payload' => json_encode($localPayload),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::commit();

            $this->showPinModal = false;
            $this->reset(['amount', 'remark', 'pinInput']);

            session()->flash('successMessage', 'Transaksi Berhasil! Sebesar Rp ' . number_format($totalAmount, 0, ',', '.') . ' sukses diproses.');

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->showPinModal = false;
            throw $th;
        }
    }

    public function closePinModal()
    {
        $this->showPinModal = false;
        $this->pinInput = '';
    }

    public function render()
    {
        return view('livewire.transaction.transfer-bank.submit');
    }
}