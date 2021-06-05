@extends('templates.admin')

@section('header')
<style>
.card .content {
    margin-left: 1rem;
}
</style>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dasbor</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dasbor</li>
        </ol>
        <div class="row">
            <div class="col-sm-4 col-xs-6 mb-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="icon-wrapper">
                                <i class="fas fa-file fa-fw fa-3x"></i>
                            </div>
                            <div class="content">
                                <h3>{{ $penduduk }}</h3>
                                <p class="m-0">Data Penduduk</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('penduduk.index') }}" class="card-footer d-flex justify-content-between text-white text-decoration-none">
                        <span>Detail</span><i class="fas fa-arrow-right fa-fw"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="icon-wrapper">
                                <i class="fas fa-paper-plane fa-fw fa-3x"></i>
                            </div>
                            <div class="content">
                                <h3>{{ $pemohon }}</h3>
                                <p class="m-0">Pemohon Surat Pengantar</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pemohon.index') }}" class="card-footer d-flex justify-content-between text-white text-decoration-none">
                        <span>Detail</span><i class="fas fa-arrow-right fa-fw"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="icon-wrapper">
                                <i class="fas fa-users fa-fw fa-3x"></i>
                            </div>
                            <div class="content">
                                <h3>{{ $jml_petugas }}</h3>
                                <p class="m-0">Petugas</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('petugas.main') }}" class="card-footer d-flex justify-content-between text-white text-decoration-none">
                        <span>Detail</span><i class="fas fa-arrow-right fa-fw"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
function showAlert(data) {
    Swal.fire(data);
}
</script>
@endsection
