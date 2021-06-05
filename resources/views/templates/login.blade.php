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

<body>

    @yield('container')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @yield('footer')
</body>
</html>
