<div>
    <x-alert />
    <div class="container-fluid bg-primary-soft" style="min-height:100vh;">

        <div class="row justify-content-center align-items-center" style="min-height:100vh;">

            <div class="col-md-6 col-lg-5">

                <div class="card card-bank">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">

                            <h2 class="title-primary mb-2">
                                Bank Luluk
                            </h2>

                            <p class="text-secondary-custom mb-0">
                                Buat akun baru
                            </p>

                        </div>

                        <form wire:submit="register">

                            {{-- Nama --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap" wire:model.blur="name">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Nickname --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Panggilan
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control @error('nickname') is-invalid @enderror"
                                    placeholder="Masukkan nama panggilan" wire:model.blur="nickname">

                                @error('nickname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Nomor HP --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nomor HP
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" inputmode="numeric"
                                    class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxxxxxx"
                                    wire:model.blur="phone">

                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Password --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Password
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="{{ $showPassword ? 'text' : 'password' }}"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password" wire:model.blur="password">

                                    <button class="btn btn-outline-secondary" type="button"
                                        wire:click="$toggle('showPassword')">

                                        <i class="bi {{ $showPassword ? 'bi-eye-slash-fill' : 'bi-eye-fill' }}"></i>

                                    </button>

                                </div>

                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Konfirmasi Password
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <input type="{{ $showPasswordConfirmation ? 'text' : 'password' }}"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi password" wire:model.blur="password_confirmation">

                                    <button class="btn btn-outline-secondary" type="button"
                                        wire:click="$toggle('showPasswordConfirmation')">

                                        <i
                                            class="bi {{ $showPasswordConfirmation ? 'bi-eye-slash-fill' : 'bi-eye-fill' }}"></i>

                                    </button>

                                </div>

                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary w-100">

                                Daftar

                            </button>

                        </form>

                        <div class="text-center mt-4">

                            <small class="text-secondary-custom">
                                Sudah punya akun?
                            </small>

                            <div class="mt-3">

                                <a href="{{ route('login') }}" class="text-secondary-custom">

                                    Login

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
