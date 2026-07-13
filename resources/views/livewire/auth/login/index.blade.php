<div class="container-fluid bg-primary-soft" style="min-height:100vh;">

    <div class="row justify-content-center align-items-center" style="min-height:100vh;">

        <div class="col-md-5 col-lg-4">

            <div class="card card-bank">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <h2 class="title-primary mb-2">
                            Bank Luluk
                        </h2>

                        <p class="text-secondary-custom mb-0">
                            Masuk ke akun Anda
                        </p>

                    </div>

                    <form wire:submit="login">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Nomor HP
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control auth-input @error('phone') is-invalid @enderror"
                                placeholder="08xxxxxxxxxx" wire:model.blur="phone" required>

                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Password
                                <span class="text-danger">*</span>
                            </label>

                            <input type="password" class="form-control" placeholder="Masukkan password"
                                wire:model.live="password" required>

                        </div>

                        <button type="submit" class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                    <div class="text-center mt-4">

                        <small class="text-secondary-custom">
                            Belum punya akun?
                        </small>

                        <div class="mt-3">

                            <a {{-- href="{{ route('register') }}" --}} class="btn btn-secondary w-100">

                                Daftar Akun

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
