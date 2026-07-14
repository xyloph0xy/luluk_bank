<div>

    <div class="py-2">
        <div class="d-flex align-items-center mb-4 pb-2 border-bottom border-light">
            <button type="button"
                class="btn btn-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#cancelModal">
                <i class="bi bi-arrow-left fs-5"></i>
            </button>
            <div>
                <h3 class="fw-bold tracking-tight mb-1" style="color: #0d6efd;">Create New Pocket</h3>
                <small class="text-secondary opacity-75">Buat kantong baru untuk memisahkan alokasi tabunganmu</small>
            </div>
        </div>

        {{-- Form Input --}}
        <form wire:submit.prevent="save">
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold text-dark small">
                        Nama Pocket
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        class="form-standard form-control bg-light border-start-0 @error('name') is-invalid @enderror"
                        id="name" wire:model.defer="name" placeholder="Contoh: Liburan, Dana Darurat" required>
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <label for="balance" class="form-label fw-bold text-dark small mb-0">Saldo Awal (Rp)</label>
                        <span class="text-secondary small opacity-75">(Tersedia: <strong class="text-primary">Rp
                                0</strong>)</span>
                    </div>

                    <input type="number" step="any"
                        class="form-standard form-control bg-light border-start-0 @error('balance_pocket') is-invalid @enderror"
                        id="balance" wire:model.defer="balance_pocket" placeholder="0" min="0"
                        max="{{ $mainBalance ?? 0 }}">

                    @error('balance')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="goal_amount" class="form-label fw-bold text-dark small">Target Tabungan / Goal
                        (Opsional)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-secondary fw-bold">Rp</span>
                        <input type="number" step="any"
                            class="form-standard form-control bg-light border-start-0 @error('goal_amount') is-invalid @enderror"
                            id="goal_amount" wire:model.defer="goal_amount" placeholder="Contoh: 5000000">
                    </div>
                    @error('goal_amount')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="achivement_date_goal" class="form-label fw-bold text-dark small">
                        Tanggal Target Dicapai (Opsional)
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-secondary">
                            <i class="bi bi-calendar-event"></i>
                        </span>
                        <input type="date"
                            class="form-standard form-control bg-light border-start-0 @error('achivement_date_goal') is-invalid @enderror"
                            id="achivement_date_goal" wire:model.defer="achivement_date_goal" min="{{ date('Y-m-d') }}">
                    </div>
                    @error('achivement_date_goal')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 pt-3 border-top border-light mt-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light px-4 py-2 rounded-3 fw-medium" data-bs-toggle="modal"
                        data-bs-target="#cancelModal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning px-4 py-2 rounded-3 fw-bold text-dark">
                        Simpan Pocket
                    </button>
                </div>
        </form>

    </div>

</div>

<div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-body text-center p-4">
                <div class="text-warning mb-3">
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2" id="cancelModalLabel">Batalkan Pengisian?</h5>
                <p class="text-muted small mb-4">Data yang sudah kamu masukkan tidak akan disimpan.</p>
                <div class="d-grid gap-2">

                    <a href="{{ route('pocket.index') }}" class="btn btn-danger py-2 rounded-3 fw-medium">
                        Ya, Batalkan
                    </a>
                    <button type="button" class="btn btn-light py-2 rounded-3 fw-medium" data-bs-dismiss="modal">
                        Kembali Isi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
