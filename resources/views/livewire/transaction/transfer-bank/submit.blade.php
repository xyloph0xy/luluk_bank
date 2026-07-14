<div>
    <x-alert />
    <div class="container-fluid bg-primary-soft" style="min-height: 100vh;">

        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="col-md-7 col-lg-6">

                <div class="card card-bank shadow-sm border-0">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <h2 class="title-primary fw-bold mb-2">
                                Bank Luluk
                            </h2>
                            <p class="text-secondary-custom small mb-0">
                                Top Up / Transfer Saldo Instan
                            </p>
                        </div>

                        <!-- Notifikasi Sukses -->
                        @if (session()->has('successMessage'))
                            <div class="alert alert-success alert-dismissible fade show small mb-4" role="alert">
                                {{ session('successMessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="submitTransfer">

                            <!-- DROPDOWN PILIHAN BANK -->
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
                                            <span class="text-secondary">
                                                <i class="bi bi-bank me-2"></i> Pilih Bank / Metode Pembayaran
                                            </span>
                                        @endif
                                    </button>

                                    <ul class="dropdown-menu w-100 border-0 shadow rounded-3 p-2" aria-labelledby="bankDropdown">
                                        @foreach ($banks as $bank)
                                            <li>
                                                <button type="button"
                                                    class="dropdown-item d-flex align-items-center justify-content-between py-2.5 rounded-2 @if ($selectedBank == $bank['bank_code']) active bg-primary-subtle text-dark @endif"
                                                    wire:click="$set('selectedBank', '{{ $bank['bank_code'] }}')">
                                                    <span class="d-flex align-items-center gap-3">
                                                        <span class="fw-semibold">{{ $bank['bank_name'] }}</span>
                                                    </span>
                                                    <small class="text-muted text-xs">
                                                        Biaya Rp {{ number_format($bank['fee'], 0, ',', '.') }}
                                                    </small>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                @error('selectedBank')
                                    <div class="text-danger small mt-1">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- FORM TRANSFER BARU MUNCUL JIKA BANK SUDAH DIPILIH -->
                            @if ($selectedBank)
                                @php
                                    $currentBank = collect($banks)->firstWhere('bank_code', $selectedBank);
                                    $dbFee = $currentBank['fee'] ?? 6500;
                                @endphp

                                <!-- NOMINAL -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label fw-semibold mb-0 small">
                                            Nominal (IDR) <span class="text-danger">*</span>
                                        </label>
                                        
                                        <!-- INFORMASI SALDO AKTIF -->
                                        <span class="text-secondary-custom small">
                                            Saldo: <strong class="text-dark">Rp {{ number_format(DB::table('bank_accounts')->where('user_id', auth()->id())->value('balance') ?? 0, 0, ',', '.') }}</strong>
                                        </span>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary-custom fw-semibold border-end-0 px-3" style="border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem;">
                                            Rp
                                        </span>
                                        <input type="number" 
                                            class="form-control auth-input border-start-0 ps-1 @error('amount') is-invalid @enderror"
                                            placeholder="0" 
                                            wire:model.blur="amount"
                                            style="border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem; height: 48px;" 
                                            required>
                                    </div>

                                    @error('amount')
                                        <div class="text-danger small mt-1 d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- REMARK / CATATAN -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold small mb-2">
                                        Keterangan / Berita <span class="text-muted fw-normal">(Opsional)</span>
                                    </label>
                                    <textarea class="form-control @error('remark') is-invalid @enderror" 
                                        placeholder="Contoh: Top up saldo wallet, Pembayaran tagihan" 
                                        wire:model.live="remark" 
                                        rows="3"
                                        style="border-radius: 0.5rem; resize: none;"></textarea>

                                    @error('remark')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- RINGKASAN BIAYA -->
                                <div class="p-3 bg-light rounded-3 mb-4 small text-secondary-custom border">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Biaya Admin ({{ $currentBank['bank_name'] }})</span>
                                        <span class="fw-semibold text-dark">Rp {{ number_format($dbFee, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Status Pemrosesan</span>
                                        <span class="text-success fw-bold text-uppercase">Instan</span>
                                    </div>
                                </div>

                                <!-- BUTTON SUBMIT -->
                                <button type="submit" wire:loading.attr="disabled" class="btn btn-primary w-100 py-2.5 fw-semibold" style="height: 48px; border-radius: 0.5rem;">
                                    <span wire:loading.remove>Proses Transaksi</span>
                                    <span wire:loading>
                                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                        Memproses...
                                    </span>
                                </button>
                            @else
                                <!-- PLACEHOLDER JIKA BELUM PILIH BANK -->
                                <div class="text-center py-4 border rounded-3 border-dashed bg-light-subtle">
                                    <p class="text-muted small mb-0">Silakan pilih bank pembayaran terlebih dahulu untuk melanjutkan transaksi.</p>
                                </div>
                            @endif

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @if ($showPinModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);" role="dialog">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                    
                    <div class="modal-header border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">
                            {{ $hasPin ? 'Konfirmasi PIN' : 'Buat PIN Keamanan' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closePinModal" aria-label="Close"></button>
                    </div>

                    <form wire:submit.prevent="verifyAndProcess">
                        <div class="modal-body px-4 pb-3">
                            <p class="text-secondary small mb-4">
                                {{ $hasPin 
                                    ? 'Masukkan 6 digit PIN keamanan akun Bank Luluk Anda untuk memproses transaksi ini.' 
                                    : 'Akun Anda belum memiliki PIN transaksi. Silakan buat 6 digit PIN baru untuk mengamankan akun Anda.' }}
                            </p>

                            <!-- INPUT PIN -->
                            <div class="mb-3">
                                <div class="position-relative">
                                    <input type="password" 
                                        class="form-control text-center @error('pinInput') is-invalid @enderror" 
                                        placeholder="••••••" 
                                        maxlength="6"
                                        pattern="[0-9]*" 
                                        inputmode="numeric"
                                        wire:model="pinInput"
                                        style="font-size: 2rem; letter-spacing: 0.7rem; height: 60px; border-radius: 0.5rem;"
                                        required 
                                        autofocus>
                                </div>
                                
                                @error('pinInput')
                                    <div class="text-danger text-center small mt-2 d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- MODAL FOOTER DENGAN FLEXBOX SEJAJAR -->
                        <div class="modal-footer border-0 px-4 pb-4 pt-0 d-flex gap-3">
                            <button type="button" class="btn btn-light flex-grow-1 py-2.5 fw-semibold" wire:click="closePinModal" style="border-radius: 0.5rem; height: 45px;">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary flex-grow-1 py-2.5 fw-semibold" style="border-radius: 0.5rem; height: 45px;">
                                {{ $hasPin ? 'Verifikasi' : 'Simpan PIN' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif

</div>