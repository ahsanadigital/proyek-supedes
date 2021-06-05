@extends('templates.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css"/>
@endsection

@section('content')
<main>
    <div class="container-fluid my-4">
        <div class="row g-0 mt-4">
            <div class="col-md-8">
                <h1>Data Pemohon</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lurah.home') }}">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pemohon.index') }}">Data Pemohon</a>
                    </li>
                    <li class="breadcrumb-item active">Verifikasi Lurah</li>
                </ol>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-striped table">
                <thead>
                    <tr>
                        <td class="no-sort">#</td>
                        <td>ID Pemohon</td>
                        <td>Status</td>
                        <td>Tanggal Berlaku</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pemohon->get() as $data)
                    <!-- Delete Confirm -->
                    <div class="modal fade" id="deleteConfirm{{ md5($data->id_surat) }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirm{{ md5($data->id_surat) }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirm{{ md5($data->id_surat) }}Label">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin akan menghapus surat dengan ID <strong>{{ $data->id_surat }}</strong>? Jika iya maka data yang terhapus tidak dapat dikembalikan!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <a href="{{ route('pemohon.delete', $data->id) }}" class="btn btn-danger"><i class="fas fa-trash fa-fw me-2"></i>Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verifikasi Selesai -->
                    <div class="modal fade" id="selesai{{ md5($data->id_surat) }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="selesai{{ md5($data->id_surat) }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="selesai{{ md5($data->id_surat) }}Label">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda yakin akan menyelesaikan pendataan surat dengan ID <strong>{{ $data->id_surat }}</strong>? Jika iya maka data yang terubah tidak dapat dikembalikan!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <a href="{{ route('pemohon.verifikasi_lurah', $data->id) }}" class="btn btn-success"><i class="fas fa-check fa-fw me-2"></i>Selesaikan</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lihat Surat -->
                    <div class="modal fade" id="look{{ md5($data->id_surat) }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="look{{ md5($data->id_surat) }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="look{{ md5($data->id_surat) }}Label">Lihat Surat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">ID Surat</div>
                                            <div class="col-8 right px-2">{{ $data->id_surat }}</div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Kepada (Nomor NIK)</div>
                                            <div class="col-8 right px-2">
                                                {{ $data->nik }}
                                                @php
                                                    $penduduk = $data->penduduk;
                                                    echo "({$penduduk[0]->nama_lengkap})";
                                                @endphp
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Keperluan</div>
                                            <div class="col-8 right px-2">
                                                {{ $data->keperluan }}
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">&nbsp;</div>
                                            <div class="col-8 right px-2">
                                                {!! !$data->description ? '<span class="text-muted">(Tidak Ada Deskripsi)</span>' : $data->deskripsi !!}
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Status</div>
                                            <div class="col-8 right px-2">
                                                @if ($data->status)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Arsip</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Berlaku Sampai</div>
                                            <div class="col-8 right px-2">
                                                @if ($data->keterangan == 'terverifikasi')
                                                    {{ Carbon\Carbon::parse($data->tgl_berlaku)->isoFormat('dddd, D MMMM Y') }}
                                                @else
                                                    <span class="badge bg-danger">Belum Terverifikasi</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirm{{ md5($data->id_surat) }}"><i class="fas fa-trash fa-fw"></i></button>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#look{{ md5($data->id_surat) }}"><i class="fas fa-eye fa-fw"></i></button>
                                @if ($data->keterangan == 'verifikasi_lurah')
                                <button type="button" class="btn btn-success btn-sm" {{ !$data->status ? 'disabled ' : '' }}data-bs-toggle="modal" data-bs-target="#selesai{{ md5($data->id_surat) }}"><i class="fas fa-check fa-fw"></i></button>
                                @elseif ($data->keterangan == 'verifikasi_rt')
                                <button type="button" class="btn btn-success btn-sm" {{ !$data->status ? 'disabled ' : '' }}data-bs-toggle="modal" data-bs-target="#lurah{{ md5($data->id_surat) }}"><i class="fas fa-check-circle fa-fw"></i></button>
                                @elseif ($data->keterangan == 'verifikasi_rw')
                                <button type="button" class="btn btn-success btn-sm" {{ !$data->status ? 'disabled ' : '' }}data-bs-toggle="modal" data-bs-target="#rw{{ md5($data->id_surat) }}"><i class="fas fa-bookmark fa-fw"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-sm"{{ !$data->status ? 'disabled ' : '' }} data-bs-toggle="modal" data-bs-target="#archive{{ md5($data->id_surat) }}"><i class="fas fa-ban fa-fw"></i></button>
                                <a href="{{ route('pemohon.cetak', $data->id) }}" class="btn {{ !$data->status ? 'disabled ' : '' }}btn-warning btn-sm"><i class="fas fa-download fa-fw"></i></a>
                                @endif
                            </div>
                        </td>
                        <td>{{ $data->id_surat }}</td>
                        <td>
                        @if ($data->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Arsip</span>
                        @endif
                        </td>
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

        <div class="row text-white">
            <div class="col-md-4 bg-success py-3">
                <i class="fas fa-fw fa-bookmark"></i> Verifikasi RW
            </div>
            <div class="col-md-4 bg-danger py-3">
                <i class="fas fa-fw fa-trash"></i> Hapus Surat
            </div>
            <div class="col-md-4 bg-primary py-3">
                <i class="fas fa-fw fa-eye"></i> Lihat Surat Pengantar
            </div>
        </div>

    </div>
</main>
@endsection

@section('footer')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>

<script>
$('table').DataTable({
    columnDefs: [
        { targets: 'no-sort', orderable: false }
    ]
});
</script>
@endsection
