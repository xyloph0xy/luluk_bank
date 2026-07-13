<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body class="bg-light">

    <!-- Global Header/Navbar Layout -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
            <div>
                <h4 class="text-primary fw-bold mb-1">Hai Luluk!</h4>
                <small class="text-muted">Udah siap menabung hari ini?</small>
            </div>

            <!-- Dropdown Profil -->
            <div class="dropdown">
                <button class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center"
                    type="button" id="dropdownMenuProfile" data-bs-toggle="dropdown" aria-expanded="false"
                    style="width: 50px; height: 50px;">
                    <i class="bi bi-person fs-4"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2"
                    aria-labelledby="dropdownMenuProfile">

                    <li>
                        <a class="dropdown-item py-2 fw-medium" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-2 text-primary"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i
                                class="bi bi-person-gear me-2"></i> Pengaturan
                            Akun</a></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="bi bi-shield-lock me-2"></i> Keamanan</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item py-2 text-danger" href="#"><i
                                class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Konten Utama Halaman -->
    <main class="container my-4">
        <div class="bg-white p-4 rounded-4 shadow-sm border">
            @yield('main')
        </div>
    </main>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
