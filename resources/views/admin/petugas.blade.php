@extends('templates.admin')

@section('content')
<main>
    <div class="container-fluid my-4">
        <div class="row g-0 mt-4">
            <div class="col-md-8">
                <h1>Data Petugas</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('lurah.home') }}">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item active">Data Petugas</li>
                </ol>
            </div>
            <div class="col-md-4">
                <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-fw me-2"></i>Tambah Baru</a>
            </div>
        </div>

        <div class="mt-3">
            <div class="table-responsive">
                <table class="table-striped table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas as $data)
                        <!-- Edit Data -->
                        <div class="modal fade" id="edit-{{ md5($data->id) }}" tabindex="-1" aria-labelledby="edit-{{ md5($data->id) }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-{{ md5($data->id) }}Label">Ubah Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open([ 'route' => ['petugas.edit', $data->id ]]) !!}
                                            <h3>Data Pribadi</h3>
                                            <div class="form-group mb-3">
                                                <label for="nama_terang">Nama Lengkap</label>
                                                {!! Form::text('nama_terang', $data->nama_terang, ['class' => 'form-control', 'placeholder' => 'Masukkan nama...', 'id' => 'nama_terang']) !!}
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="jabatan">Jabatan</label>
                                                {!! Form::select('jabatan', $jabatan, $data->jabatan, ['class' => 'form-control', 'id' => 'jabatan']) !!}
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                {!! Form::select('status', ['active' => 'Aktif', 'inactive' => 'Tidak Aktif'], $data->status, ['class' => 'form-control', 'id' => 'status']) !!}
                                            </div>

                                            <h3>Data Masuk</h3>
                                            <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                {!! Form::email('email', $data->email, ['class' => 'form-control', 'placeholder' => 'Masukkan email...', 'id' => 'email']) !!}
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password">Password</label>
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan kata sandi...', 'id' => 'password']) !!}
                                            </div>

                                            {!! Form::submit('Ubah Data', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Data -->
                        <div class="modal fade" id="delete-{{ md5($data->id) }}" tabindex="-1" aria-labelledby="delete-{{ md5($data->id) }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-{{ md5($data->id) }}Label">Konfirmasi Hapus Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="m-0">Yakin akan menghapus pengguna atas nama <strong>{{ $data->nama_terang }}</strong>? Jika data terhapus maka tidak bisa dikembalikan!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="{{ route('petugas.delete', $data->id) }}" class="btn btn-danger"><i class="fas fa-trash fa-fw me-2"></i>Hapus Data</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-{{ md5($data->id) }}"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-{{ md5($data->id) }}"><i class="fas fa-trash fa-fw"></i></button>
                                </div>
                            </td>
                            <td>{{ $data->nama_terang }}</td>
                            <td>{{ $jabatan[$data->jabatan] }}</td>
                            <td>
                                @if ($data->status == 'active')
                                <div class="badge bg-success">Aktif</div>
                                @else
                                <div class="badge bg-warning">Non-Aktif</div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $petugas->links() }}
        </div>
    </div>
</main>
@endsection
