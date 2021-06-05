<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ !empty($title) ? $title : config('app.name') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito&display=fallback" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: "Nunito", Arial, Helvetica, sans-serif;
        }
    </style>

    @yield('header')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper min-vh-100 d-flex flex-column justify-content-between">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light border-bottom">
            <div class="container">
                <a class="navbar-brand" href="{{ URL::to('/') }}">SUPEDES</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-top" aria-controls="navbar-top" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse align-items-center" id="navbar-top">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item active">
                            <a class="nav-link{{ Request::is('/') ? ' active' : '' }}" href="{{ URL::to('/') }}"><i class="fas fa-home me-2"></i>Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('kritik-saran') ? ' active' : '' }}" href="{{ route('krisar') }}"><i class="fas fa-inbox me-2"></i>Kritik & Saran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lurah.login') }}"><i class="fas fa-sign-in-alt me-2"></i>Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        @yield('container')

        <!-- Main Footer -->
        <footer class="py-3 border-top">
            <div class="container">
                <!-- Default to the left -->
                <strong>Copyright &copy; {{ date('Y') }} <a href="{{ URL::to('/') }}">SUPEDES</a>.</strong> All rights reserved.
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @yield('footer')
</body>
</html>
