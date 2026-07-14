<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="card-header bg-primary text-white p-4 border-0">
                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="text-white fs-4"><i class="bi bi-arrow-left"></i></a>
                        <div>
                            <h4 class="fw-bold mb-0">Top Up Saldo</h4>
                            <small class="opacity-75">Isi ulang saldo akun Treasury Anda</small>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="submitTopUp">

                        {{-- STEP 1: PILIH BANK (Dropdown Custom) --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark mb-2">Pilih Bank Pembayaran</label>

                            <div class="dropdown">
                                <button
                                    class="btn btn-light bg-light border w-100 py-3 px-3 rounded-3 text-start d-flex justify-content-between align-items-center dropdown-toggle"
                                    type="button" id="bankDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="font-size: 0.95rem;">

                                    @if ($selectedBank)
                                        @php
                                            $currentBank = collect($banks)->firstWhere('bank_code', $selectedBank);
                                        @endphp
                                        <span class="d-flex align-items-center gap-3">
                                            <span class="fw-semibold text-dark">{{ $currentBank['bank_name'] }}</span>
                                        </span>
                                    @else
                                        <span class="text-secondary"><i class="bi bi-bank me-2"></i> Pilih Bank / Metode
                                            Pembayaran</span>
                                    @endif
                                </button>

                                <ul class="dropdown-menu w-100 border-0 shadow rounded-3 p-2"
                                    aria-labelledby="bankDropdown">
                                    @foreach ($banks as $bank)
                                        <li>
                                            <button type="button"
                                                class="dropdown-item d-flex align-items-center justify-content-between py-2.5 rounded-2 @if ($selectedBank == $bank['bank_code']) active bg-primary-subtle text-dark @endif"
                                                wire:click="$set('selectedBank', '{{ $bank['bank_code'] }}')">
                                                <span class="d-flex align-items-center gap-3">
                                                    <span class="fw-semibold">{{ $bank['bank_name'] }}</span>
                                                </span>
                                                <small class="text-muted text-xs">Biaya Rp
                                                    {{ number_format($bank['fee'], 0, ',', '.') }}</small>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('selectedBank')
                                <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}</div>
                            @enderror
                        </div>


                        @if ($selectedBank)
                            <div class="fade-in transition-all">

                                <hr class="my-4 border-light">


                                <div class="mb-4">
                                    <label class="form-label fw-bold text-dark mb-2">Pilih Nominal Instan</label>
                                    <div class="row g-2">
                                        @foreach ($instantAmounts as $val)
                                            <div class="col-4">
                                                <button type="button"
                                                    class="btn btn-outline-primary w-100 py-2.5 rounded-3 fw-bold btn-instant @if ($amount == $val) active @endif"
                                                    wire:click="selectInstantAmount({{ $val }})">
                                                    Rp {{ number_format($val / 1000, 0) }}k
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="mb-4">
                                    <label for="customAmount" class="form-label fw-bold text-dark mb-2">Atau Masukkan
                                        Nominal Sendiri</label>
                                    <div class="input-group">
                                        <span
                                            class="input-group-text bg-light border-end-0 text-secondary fw-bold">Rp</span>
                                        <input type="number"
                                            class="form-control bg-light border-start-0 py-3 @error('amount') is-invalid @enderror"
                                            id="customAmount" wire:model.live="customAmount"
                                            placeholder="Minimal Rp 10.000" min="10000">
                                    </div>
                                    @error('amount')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>
                                            {{ $message }}</div>
                                    @enderror
                                </div>


                                @if ($amount && $amount >= 10000)
                                    @php
                                        $currentBank = collect($banks)->firstWhere('bank_code', $selectedBank);
                                        $fee = $currentBank['fee'] ?? 0;
                                        $total = $amount + $fee;
                                    @endphp
                                    <div class="bg-light rounded-4 p-3 mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-secondary small">Nominal Top Up</span>
                                            <span class="fw-bold text-dark">Rp
                                                {{ number_format($amount, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-secondary small">Biaya Admin</span>
                                            <span class="fw-bold text-dark">Rp
                                                {{ number_format($fee, 0, ',', '.') }}</span>
                                        </div>
                                        <hr class="my-2 border-secondary opacity-25">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-dark fw-bold">Total Pembayaran</span>
                                            <span class="fw-bold text-primary fs-5">Rp
                                                {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @endif


                                <button type="submit"
                                    class="btn btn-primary w-100 py-3 rounded-pill fw-bold hover-button transition-all mb-2">
                                    Konfirmasi & Bayar
                                </button>
                            </div>
                        @else
                            <div class="text-center py-5 opacity-75">
                                <i class="bi bi-wallet2 text-muted fs-1 mb-3 d-block"></i>
                                <span class="text-secondary small">Pilih salah satu metode transfer bank di atas untuk
                                    melanjutkan pengisian saldo.</span>
                            </div>
                        @endif

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd !important;
    }

    .btn-instant {
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .btn-instant.active {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }

    .fade-in {
        animation: fadeIn 0.4s ease-in-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .transition-all {
        transition: all 0.3s ease;
    }

    .hover-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.25) !important;
    }

    .hover-button:active {
        transform: translateY(-1px);
    }
</style>
