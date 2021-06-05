@extends('templates.home')

@section('header')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('container')
<!-- .container -->
<div class="container my-3">
    <!-- .row -->
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-primary card-tabs">
                <div class="card-header px-2">

                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fw fa-home me-2"></i>Beranda</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fw fa-plus me-2"></i>Tambah Data</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link disabled" disabled><i class="fas fa-search me-2"></i>Cari Data</button>
                        </li>
                    </ul>

                </div>
                <div class="card-body p-4">

                    <div class="table-sm-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Identitas Surat</th>
                                    <th>NIK/Kitas/Kitap</th>
                                    <th>Status</th>
                                    <th>Valid Sampai</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($pengantar as $data)
                                <tr>
                                    <td>
                                    @if ($data->keterangan == 'terverifikasi' && $data->status)
                                    <div class="dropdown">
                                        <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-download fa-fw me-2"></i>Unduh
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{ route('unduh', $data->id) }}"><i class="fas fa-download fa-fw me-2"></i>Unduh</a></li>
                                            <li><a class="dropdown-item" href="{{ route('cetak', $data->id) }}"><i class="fas fa-print fa-fw me-2"></i>Cetak</a></li>
                                        </ul>
                                    </div>
                                    @else
                                        <button class="btn btn-warning disabled" disabled="disabled"><i class="fas fa-download fa-fw me-2"></i>Unduh</button>
                                    @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::now()->format('Y/m') }}/{{ $data->id_surat }}</td>
                                    <td>{{ $data->nik }} a/n {{ $data->penduduk[0]->nama_lengkap }}</td>
                                    @if ($data->status && $data->keterangan == 'terverifikasi')
                                    <td><span class="badge bg-success">Terverifikasi</span></td>
                                    @elseif(!$data->status && $data->keterangan == 'terverifikasi')
                                    <td><span class="badge bg-warning">Diarsipkan</span></td>
                                    @else
                                    <td><span class="badge bg-warning">{{ $status[$data->keterangan] }}</span></td>
                                    @endif
                                    <td>
                                    @if ($data->keterangan == 'terverifikasi')
                                        {{ Carbon\Carbon::parse($data->tgl_berlaku)->isoFormat('dddd, D MMMM Y') }}
                                    @elseif ($data->keterangan == 'verifikasi_rt')
                                        <span class="badge bg-danger">Belum Terverifikasi di RT</span>
                                    @elseif ($data->keterangan == 'verifikasi_rw')
                                        <span class="badge bg-danger">Belum Terverifikasi di RW</span>
                                    @elseif ($data->keterangan == 'verifikasi_lurah')
                                        <span class="badge bg-danger">Belum Terverifikasi di Kelurahan</span>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $pengantar->links() }}

                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection

@section('footer')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
@endsection
