<div class="container-fluid bg-primary-soft py-5" style="min-height:100vh;">

    <div class="container">

        {{-- Kartu Rekening --}}
        <div class="row justify-content-center mb-4">

            <div class="col-lg-6">

                <div class="card shadow border-0 text-white"
                    style="
                        border-radius:25px;
                        background:linear-gradient(135deg,#0d6efd,#1b4db6);
                    ">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between mb-4">

                            <strong>
                                Treasury Account
                            </strong>

                            <span>
                                {{ $user->bankAcc->account_number }}
                            </span>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small>Saldo</small>

                                <h3 class="fw-bold mb-0">

                                    {{ $showBalance ? 'Rp ' . number_format($user->balance, 2, ',', '.') : 'Rp ••••••••' }}

                                </h3>

                            </div>

                            <button type="button" class="btn btn-light rounded-circle"
                                wire:click="$toggle('showBalance')">

                                <i class="bi {{ $showBalance ? 'bi-eye-slash' : 'bi-eye' }}"></i>

                            </button>

                        </div>

                        <hr class="border-light">

                        <div class="row text-center">

                            <div class="col">

                                <button class="btn btn-warning w-100 rounded-pill hover-button transition-all">

                                    <i class="bi bi-wallet2"></i>

                                    <br>

                                    Top Up

                                </button>

                            </div>

                            <div class="col">

                                <button class="btn btn-warning w-100 rounded-pill hover-button transition-all">

                                    <i class="bi bi-arrow-left-right"></i>

                                    <br>

                                    Transfer

                                </button>

                            </div>

                            <div class="col">

                                <button class="btn btn-warning w-100 rounded-pill hover-button transition-all">

                                    <i class="bi bi-qr-code"></i>

                                    <br>

                                    QRIS

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Menu --}}
        <div class="row g-4">

            <div class="col-md-4">

                <a href="{{ route('pocket.index') }}" class="text-decoration-none">


                    <div class="card card-bank h-100 card-clickable">

                        <div class="card-body text-center">

                            <i class="bi bi-piggy-bank fs-1 text-primary mb-3"></i>

                            <h5 class="text-dark">
                                Ayo buat Pocket!
                            </h5>

                            <p class="text-secondary-custom">
                                Pisahkan tabungan sesuai tujuanmu.
                            </p>

                        </div>

                    </div>

                </a>

            </div>

            <div class="col-md-4">

                <div class="card card-bank h-100">

                    <div class="card-body text-center">

                        <i class="bi bi-graph-up-arrow fs-1 text-primary mb-3"></i>

                        <h5>

                            Keuanganmu sehat?

                        </h5>

                        <p class="text-secondary-custom">

                            Cek kondisi keuanganmu sekarang.

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card card-bank h-100">

                    <div class="card-body text-center">

                        <i class="bi bi-cash-stack fs-1 text-primary mb-3"></i>

                        <h5>

                            Mulai Investasi

                        </h5>

                        <p class="text-secondary-custom">

                            Tumbuhkan uangmu bersama Bank Luluk.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>
    .transition-all {
        transition: all 0.3s ease;
    }

    .hover-button:hover {
        transform: translateY(-4px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .hover-button:active {
        transform: translateY(-1px);
    }
</style>