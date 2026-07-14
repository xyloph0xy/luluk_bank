<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-light">
        <div>
            <h2 class="fw-bold tracking-tight mb-1" style="color: #0d6efd;">
                My Pockets
            </h2>
            <small class="text-secondary-custom opacity-75">
                Kelola pocket tabunganmu
            </small>
        </div>

    </div>

    {{-- Saldo Card --}}
    <div class="card border-0 bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="text-uppercase text-muted fw-bold small"
                    style="font-size: 0.75rem; letter-spacing: 0.5px;">My Balance</span>
                <h3 class="fw-bold mb-0 mt-1 d-flex align-items-center gap-3">
                    <span>
                        @if ($showBalance)
                            Rp {{ number_format($balance, 2, ',', '.') }}
                        @else
                            Rp ••••••••
                        @endif
                    </span>
                    <button class="btn btn-sm btn-light border-0 rounded-3 text-secondary" style="padding: 4px 8px;"
                        wire:click="$toggle('showBalance')">
                        <i class="bi {{ $showBalance ? 'bi-eye-slash' : 'bi-eye' }} fs-6"></i>
                    </button>
                </h3>
            </div>
            <div class="p-3 bg-light rounded-3 d-none d-sm-block">
                <i class="bi bi-wallet2 text-primary fs-3"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('pocket-create') }}" class="text-decoration-none h-100 d-block">
                <div class="card pocket-card h-100 border-0 shadow-sm bg-warning-subtle rounded-4 hover-card transition-all"
                    style="min-height: 160px;">
                    <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center text-center">
                        <div class="rounded-circle bg-warning text-dark d-flex justify-content-center align-items-center mb-3 shadow-sm icon-box"
                            style="width: 54px; height: 54px; transition: transform 0.2s;">
                            <i class="bi bi-plus-lg fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-0">
                            Create Pocket
                        </h5>
                    </div>
                </div>
            </a>
        </div>

        @foreach ($pockets as $pocket)
            <div class="col-md-6 col-lg-4">
                <div class="card pocket-card h-100 border-0 shadow-sm rounded-4 hover-card transition-all"
                    style="background: {{ $pocket->color() }}; color: {{ $pocket->textColor() }}; min-height: 160px;">

                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div class="mt-4">
                            <h5 class="fw-bold mb-1 opacity-90">
                                {{ $pocket->name }}
                            </h5>
                            <h4 class="fw-extrabold mb-0">
                                Rp {{ number_format($pocket->balance, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach



    </div>
</div>
