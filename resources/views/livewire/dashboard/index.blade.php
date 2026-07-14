<div class="container-fluid bg-primary-soft py-5" style="min-height:100vh;">

    <div class="container">

        {{-- Header --}}
        <div class="card card-bank mb-4">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="title-primary mb-1">
                        Hai {{ $user->nickname }}!
                    </h4>

                    <small class="text-secondary-custom">
                        Udah siap menabung hari ini?
                    </small>
                </div>

                <div class="dropdown">

                    <button class="btn btn-outline-primary rounded-circle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="width:52px;height:52px;">

                        <i class="bi bi-person fs-5"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow">

                        <li>
                            <h6 class="dropdown-header">
                                {{ auth()->user()->nickname }}
                            </h6>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

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

                                <button class="btn btn-warning w-100 rounded-pill">

                                    <i class="bi bi-wallet2"></i>

                                    <br>

                                    Top Up

                                </button>

                            </div>

                            <div class="col">

                                <button class="btn btn-warning w-100 rounded-pill">

                                    <i class="bi bi-arrow-left-right"></i>

                                    <br>

                                    Transfer

                                </button>

                            </div>

                            <div class="col">

                                <button class="btn btn-warning w-100 rounded-pill">

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
