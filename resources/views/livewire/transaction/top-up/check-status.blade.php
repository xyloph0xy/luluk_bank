<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="card-header bg-primary text-white p-4 border-0 text-center">
                    <h5 class="fw-bold mb-1 text-uppercase tracking-wider small opacity-75">Detail Pembayaran</h5>
                    <h3 class="fw-extrabold mb-0">Rp {{ number_format($transaction->nominal, 0, ',', '.') }}</h3>
                </div>

                <div class="card-body p-4">

                    {{-- Informasi Status Dinamis --}}
                    <div
                        class="text-center rounded-4 p-3 mb-4 d-flex align-items-center justify-content-center gap-2 
                        @if ($status === 'PENDING') bg-warning-subtle text-warning-dark 
                        @elseif($status === 'PAID') bg-success-subtle text-success 
                        @else bg-danger-subtle text-danger @endif">
                        <i
                            class="bi @if ($status === 'PENDING') bi-hourglass-split @elseif($transaction->status === 'PAID') bi-check-circle-fill @else bi-x-circle-fill @endif fs-5"></i>
                        <span class="small fw-bold">Status Pembayaran: <span
                                class="text-uppercase">{{ $transaction->status }}</span></span>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success rounded-3 mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    {{-- Detail Bank Pembayaran --}}
                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                        <div>
                            <span class="text-secondary small d-block">Metode Pembayaran</span>
                            <span class="fw-bold text-dark text-uppercase">{{ $transaction->bank_code }} Virtual
                                Account</span>
                        </div>
                    </div>

                    {{-- Nomor Virtual Account --}}
                    <div class="bg-light rounded-4 p-3 mb-3">
                        <span class="text-secondary small d-block mb-1">Nomor Virtual Account</span>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold text-dark tracking-wide"
                                id="vaText">{{ $transaction->va_number }}</span>
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5"
                                onclick="copyToClipboard('{{ $transaction->va_number }}', 'vaBtn')">
                                <span id="vaBtn"><i class="bi bi-clipboard me-1"></i> Copy</span>
                            </button>
                        </div>
                    </div>

                    {{-- Jumlah Nominal Pembayaran --}}
                    <div class="bg-light rounded-4 p-3 mb-4">
                        <span class="text-secondary small d-block mb-1">Nominal yang Harus Ditransfer</span>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold text-dark">Rp
                                {{ number_format($transaction->total_payment, 0, ',', '.') }}</span>
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5"
                                onclick="copyToClipboard('{{ $transaction->total_payment }}', 'amountBtn')">
                                <span id="amountBtn"><i class="bi bi-clipboard me-1"></i> Copy</span>
                            </button>
                        </div>
                    </div>

                    {{-- Button --}}
                    <div class="d-grid gap-2">

                        <button type="button" wire:click="checkStatus" wire:loading.attr="disabled"
                            class="btn btn-primary py-3 rounded-pill fw-bold hover-button transition-all w-100">

                            <span wire:loading wire:target="checkStatus" class="spinner-border spinner-border-sm me-2"
                                role="status" aria-hidden="true"></span>

                            <i wire:loading.remove wire:target="checkStatus" class="bi bi-arrow-clockwise me-1"></i>
                            Check Payment
                        </button>

                        <a href="{{ route('dashboard') }}"
                            class="btn btn-light py-3 rounded-pill fw-bold border text-secondary transition-all text-center">
                            Kembali
                        </a>

                        @if ($status === 'PENDING')
                            <div class="text-center mt-2">
                                <a href="#" wire:click.prevent="simulatePayment"
                                    class="text-muted text-decoration-none instan-simulation-link"
                                    style="font-size: 0.75rem;">
                                    <i class="bi bi-bug me-1"></i> [Simulasi] Bayar Instan (Ubah status ke SUCCESS)
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text, elementId) {
        navigator.clipboard.writeText(text).then(function() {
            const btn = document.getElementById(elementId);
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check2"></i> Copied!';
            btn.classList.add('text-success', 'border-success');

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('text-success', 'border-success');
            }, 2000);
        });
    }
</script>

<style>
    .instan-simulation-link:hover {
        color: #dc3545 !important;
        /* Berubah merah saat hover sebagai penanda testing */
        text-decoration: underline !important;
    }

    .fw-extrabold {
        font-weight: 800;
    }

    .text-warning-dark {
        color: #856404;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .hover-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.25) !important;
    }
</style>
