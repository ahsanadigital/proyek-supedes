@extends('templates.rt')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css"/>
@endsection

@section('content')
<main>
    <div class="container-fluid my-4">
        <div class="row g-0 mt-4">
            <div class="col-md-8">
                <h1>Data Kritik dan Saran</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lurah.home') }}">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item active">Data Kritik Dan Saran</li>
                </ol>
            </div>
        </div>

        <div class="row">
        @if ($krisar->count())
        @foreach ($krisar as $item)
            <!-- Modal -->
            <div class="modal fade" id="data-{{ $item->id }}" tabindex="-1" aria-labelledby="data-{{ $item->id }}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="data-{{ $item->id }}Label">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row px-2">
                                <div class="col-md-4 px-2 py-2 border-top border-bottom">Nama Lengkap</div>
                                <div class="col-md-8 px-2 py-2 border-top border-bottom">{{ $item->penduduk[0]->nama_lengkap }}</div>

                                <div class="col-md-4 px-2 py-2 border-bottom">NIK/Kitas/Kitap</div>
                                <div class="col-md-8 px-2 py-2 border-bottom">{{ $item->nik }}</div>

                                <div class="col-md-4 px-2 py-2 border-bottom">Ditujukan</div>
                                <div class="col-md-8 px-2 py-2 border-bottom">{{ $jabatan[$item->for] }}</div>

                                <div class="col-md-4 px-2 py-2 border-bottom">Status</div>
                                @if ($item->confirmed)
                                <div class="col-md-8 px-2 py-2 border-bottom"><span class="badge bg-success">Terkonfirmasi</span></div>
                                @else
                                <div class="col-md-8 px-2 py-2 border-bottom"><span class="badge bg-danger">Belum Terkonfirmasi</span></div>
                                @endif

                                <div class="col-md-4 px-2 py-2 border-bottom">Nomor WA</div>
                                <div class="col-md-8 px-2 py-2 border-bottom">{{ $item->nomor_whatsapp }}</div>

                                <div class="col-md-4 px-2 py-2 border-bottom">Email</div>
                                <div class="col-md-8 px-2 py-2 border-bottom">{{ $item->email }}</div>

                                <div class="col-md-4 px-2 py-2 border-bottom">Deskripsi</div>
                                <div class="col-md-8 px-2 py-2 border-bottom">{!! $item->description !!}</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if($item->for == 'ketua_rt' && $item->confirmed == 0)
                            <a href="{{ route('ketua_rt.krisar_verify', $item->id) }}" class="btn btn-success"><i class="fas fa-check fa-fw me-2"></i>Verifikasi</a>
                            @elseif ($item->for == 'ketua_rt' OR $item->for !== 'ketua_rt' && $item->confirmed == 1)
                            <button class="btn btn-success" disabled="disabled"><i class="fas fa-check fa-fw me-2"></i>Verifikasi</button>
                            @endif
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times fa-fw me-2"></i>Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card-body card">
                    <h5 class="text-muted">Kritik dan Saran dari <strong>{{ $item->nama_lengkap }}</strong>.</h5>
                    <p class="m-0">Dari email {{ $item->email }}</p>
                    <p class="m-0">{!! $item->confirmed ? '<span class="badge bg-success">Terkonfirmasi</span>' : '<span class="badge bg-danger">Belum Terkonfirmasi</span>' !!}</p>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#data-{{ $item->id }}"><i class="fas fa-eye fa-fw me-2"></i>Buka</button>
                </div>
            </div>
        @endforeach
        @else
        <div class="d-flex align-items-center justify-content-center">
            <div class="mt-5">
                <h1 style="font-size: 7rem; color: var(--bs-gray)">:(</h1>
                <p class="m-0" style="font-size: 1.5rem">Ups, masih belum ada data yang masuk.</p>
                <p class="m-0" style="font-size: 1.5rem"><strong>Kesalahan 400 Bad_Request</strong></p>
            </div>
        </div>
        @endif
        </div>

        {{ $krisar->links() }}
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
