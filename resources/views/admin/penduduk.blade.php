@extends('templates.admin')

@section('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css"/>
@endsection

@section('content')
<main>
    <div class="container-fluid my-4">
        <div class="row g-0 mt-4">
            <div class="col-md-8">
                <h1>Data Penduduk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lurah.home') }}">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item active">Data Penduduk</li>
                </ol>
            </div>
            <div class="col-md-4">
                <a href="{{ route('penduduk.create') }}" class="btn btn-primary"><i class="fas fa-fw fa-plus me-2"></i>Tambah Data</a>
            </div>
        </div>

        <div class="table-striped">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td class="no-sort">#</td>
                        <td>Nama</td>
                        <td>Nomor NIK</td>
                        <td>TTL</td>
                        <td>Kewarganegaraan</td>
                    </tr>
                </thead>

                <tbody>
                @foreach ($penduduk as $data)
                    <div class="modal fade" id="edit-{{ md5($data->nama_lengkap) }}" tabindex="-1" aria-labelledby="dataEdit-{{ md5($data->nama_lengkap) }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dataEdit-{{ md5($data->nama_lengkap) }}">Ubah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('penduduk.edit') }}" class="container-fluid">
                                        @csrf
                                        {!! Form::hidden('id', $data->id) !!}

                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Nama Lengkap</div>
                                            <div class="col-8 right px-2">
                                                <input type="text" class="form-control mb-2" name="nama_lengkap" value="{{ $data->nama_lengkap }}" />
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">TTL</div>
                                            <div class="col-8 right px-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" style="width: 30%" name="tempat_lahir" value="{{ $data->tempat_lahir }}" />
                                                    <input type="date" class="form-control" style="width: 70%" name="tgl_lahir" value="{{ \Carbon\Carbon::parse($data->tgl_lahir)->format('Y-m-d') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Pekerjaan</div>
                                            <div class="col-8 right px-2">
                                                <input type="text" class="form-control mb-2" name="pekerjaan" value="{{ $data->pekerjaan }}" />
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">NIK/Kartu Identitas</div>
                                            <div class="col-8 right px-2">
                                                <input type="text" class="form-control mb-2" name="nomor_nik" value="{{ $data->nomor_nik }}" />
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Alamat</div>
                                            <div class="col-8 right px-2">
                                                <input type="text" class="form-control mb-2" name="alamat_jalan" value="{{ $data->alamat_jalan }}" />
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" name="RT" value="{{ $data->RT }}" />
                                                    <input type="number" class="form-control" name="RW" value="{{ $data->RW }}" />
                                                </div>
                                                <p class="m-0">, Munggut, Padas, Ngawi, Jawa Timur 63281.</p>
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">
                                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                            </div>
                                            <div class="col-8 right px-2">
                                                <select name="kewarganegaraan" id="kewarganegaraan" class="form-control">
                                                    <option disabled="disabled" selected="selected"></option>
                                                    <option value="WNI"{{ $data->kewarganegaraan === 'wni' ? ' selected' : '' }}>Indonesia</option>
                                                    <option value="WNA"{{ $data->kewarganegaraan === 'wna' ? ' selected' : '' }}>Luar Negeri</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                            </div>
                                            <div class="col-8 right px-2">
                                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                    <option disabled="disabled" selected="selected"></option>
                                                    <option value="l"{{ $data->jenis_kelamin === 'l' ? ' selected' : '' }}>Laki-Laki</option>
                                                    <option value="p"{{ $data->jenis_kelamin === 'p' ? ' selected' : '' }}>Perempuan</option>
                                                    <option value="o"{{ $data->jenis_kelamin === 'o' ? ' selected' : '' }}>Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">
                                                <label for="pend_terakhir">Pendidikan Terakhir</label>
                                            </div>
                                            <div class="col-8 right px-2">
                                                <select name="pend_terakhir" id="pend_terakhir" class="form-control">
                                                    <option disabled="disabled" selected="selected"></option>
                                                    <option value="sd"{{ $data->pend_terakhir === 'sd' ? ' selected' : '' }}>SD</option>
                                                    <option value="smp"{{ $data->pend_terakhir === 'smp' ? ' selected' : '' }}>SMP</option>
                                                    <option value="sma"{{ $data->pend_terakhir === 'sma' ? ' selected' : '' }}>SMA</option>
                                                    <option value="sarjana"{{ $data->pend_terakhir === 'sarjana' ? ' selected' : '' }}>Sarjana</option>
                                                    <option value="diploma"{{ $data->pend_terakhir === 'diploma' ? ' selected' : '' }}>Diploma</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button class="btn btn-sm mt-3 btn-primary" type="submit"><i class="fas fa-save fa-fw me-2"></i>Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="data-{{ md5($data->nama_lengkap) }}" tabindex="-1" aria-labelledby="dataLabel-{{ md5($data->nama_lengkap) }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dataLabel-{{ md5($data->nama_lengkap) }}">Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Nama Lengkap</div>
                                            <div class="col-8 right px-2">{{ $data->nama_lengkap }}</div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Tempat Lahir</div>
                                            <div class="col-8 right px-2">{{ $data->tempat_lahir }}, {{ Carbon\Carbon::parse($data->tgl_lahir)->translatedFormat('j F Y') }}</div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Pekerjaan</div>
                                            <div class="col-8 right px-2">{{ $data->pekerjaan }}</div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">NIK</div>
                                            <div class="col-8 right px-2">{{ $data->nomor_nik }}</div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Alamat</div>
                                            <div class="col-8 right px-2">{{ $data->alamat_jalan }}, RT {{ $data->RT }}/{{ $data->RW }}, Munggut, Padas, Ngawi, Jawa Timur 63281.</div>
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Kewarganegaraan</div>
                                            @if ($data->kewarganegaraan == 'wni')
                                            <div class="col-8 right px-2"><span class="badge bg-primary">Indonesia</span></div>
                                            @else
                                            <div class="col-8 right px-2"><span class="badge bg-success">Luar Negeri</span></div>
                                            @endif
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Jenis Kelamin</div>
                                            @if ($data->jenis_kelamin == 'l')
                                            <div class="col-8 right px-2">Laki-laki</div>
                                            @else
                                            <div class="col-8 right px-2">Perempuan</div>
                                            @endif
                                        </div>
                                        <div class="row py-2 border-bottom">
                                            <div class="col-4 left px-2">Pendidikan Terakhir</div>
                                            <div class="col-8 right px-2">{{ strlen($data->pend_terakhir) > 3 ? Str::ucfirst($data->pend_terakhir) : strtoupper($data->pend_terakhir) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#data-{{ md5($data->nama_lengkap) }}"><i class="fas fa-eye fa-fw"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-{{ md5($data->nama_lengkap) }}"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                <a href="{{ route('penduduk.delete', $data->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
                            </div>
                        </td>
                        <td>{{ $data->nama_lengkap }}</td>
                        <td>{{ Str::substr($data->nomor_nik, 0, -4) }}****</td>
                        <td>{{ $data->tempat_lahir }}, {{ Carbon\Carbon::parse($data->tgl_lahir)->translatedFormat('j F Y') }}</td>
                        @if ($data->kewarganegaraan == 'wni')
                        <td class="text-center"><span class="badge bg-primary">Indonesia</span></td>
                        @else
                        <td class="text-center"><span class="badge bg-success">Luar Negeri</span></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
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
