<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{!! !empty($title) ? $title : config('app.name') !!}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito&display=fallback" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <style>
        body {
            font-family: "Nunito", Arial, Helvetica, sans-serif;
        }

        .dropdown-static .dropdown-menu {
            width: 300px;
        }

        @media screen and (max-width: 600px) {
            .dropdown-static {
                position: static;
            }

            .dropdown-static .dropdown-menu {
                width: calc(100%-1rem);
                margin: 0 auto;
            }
        }
    </style>
    @yield('header')
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('ketua_rw.home') }}">{{ config('app.name') }}</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-3">
            <li class="nav-item dropdown dropdown-static">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                    <span class="ms-1 d-none d-md-inline d-sm-none">Halo {{ Auth::user()->nama_terang }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <div class="card-body card mx-3 mb-3">
                        <div class="d-flex">
                            <img src="{{ asset('system/default.jpg') }}" alt="{{ Auth::user()->nama_terang }}" height="60" class="rounded-circle" />

                            <div class="detail ms-2">
                                <p class="m-0"><strong>{{ Auth::user()->nama_terang }}</strong></p>
                                <span class="text-muted">{{ $jabatan[Auth::user()->jabatan] }}</span>
                            </div>
                        </div>
                    </div>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Keluar</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <ul class="nav">
                        <div class="sb-sidenav-menu-heading">Beranda</div>
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('rt') ? ' active' : '' }}" href="{{ route('ketua_rw.home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-fw"></i></div>
                                Beranda Dasbor
                            </a>
                        </li>
                        <div class="sb-sidenav-menu-heading">Data Master</div>
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('rt/verifikasi') ? ' active' : '' }}" href="{{ route('ketua_rw.verifikasi') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-check-circle fa-fw"></i></div>
                                Verifikasi Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('rw/kritik-saran') ? ' active' : '' }}" href="{{ route('ketua_rw.krisar_main') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-inbox fa-fw"></i></div>
                                Kritik & Saran
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sb-sidenav-footer">
                    <p class="mb-1"><strong>Masuk sebagai</strong> <span class="badge bg-warning">{{ $jabatan[Auth::user()->jabatan] }}</span></p>
                    <p class="mb-0"><span class="small">{{ Auth::user()->nama_terang }}</span></p>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

            @yield('content')

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a href="{{ route('home') }}">{{ config('app.name') }}.</a> All rights reserved.</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('footer')
</body>
</html>
