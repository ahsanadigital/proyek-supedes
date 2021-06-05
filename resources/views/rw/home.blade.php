@extends('templates.rw')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dasbor</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dasbor</li>
        </ol>

        <div class="alert bg-info">
            <h3>Selamat Datang!</h3>
            <p class="m-0">Selamat datang di aplikasi {{ config('app.name') }}, disini anda dapat memverifikasi data pemohon yang akan mengajukan surat pengantar dari desa.</p>
        </div>
    </div>
</main>
@endsection
