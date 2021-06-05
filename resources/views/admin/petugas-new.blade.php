@extends('templates.admin')

@section('content')
<div class="container-fluid">
    <div class="row g-0 mt-4">
        <div class="col-md-8">
            <h1>Data Petugas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ route('lurah.home') }}">Dasbor</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('petugas.main') }}">Data Petugas</a>
                </li>
                <li class="breadcrumb-item active">Tambah Data Petugas</li>
            </ol>
        </div>
    </div>
</div>

<div class="row mb-3 g-0 justify-content-center">
    <div class="col-md-6">
        <div class="card card-body">

            {!! Form::open([ 'route' => 'petugas.tambah']) !!}
                <h3>Data Pribadi</h3>
                <div class="form-group mb-3">
                    <label for="nama_terang">Nama Lengkap</label>
                    {!! Form::text('nama_terang', null, ['class' => 'form-control', 'placeholder' => 'Masukkan nama...', 'id' => 'nama_terang']) !!}
                </div>
                <div class="form-group mb-3">
                    <label for="jabatan">Jabatan</label>
                    {!! Form::select('jabatan', $jabatan, null, ['class' => 'form-control', 'id' => 'jabatan']) !!}
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    {!! Form::select('status', ['active' => 'Aktif', 'inactive' => 'Tidak Aktif'], null, ['class' => 'form-control', 'id' => 'status']) !!}
                </div>

                <h3>Data Masuk</h3>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Masukkan email...', 'id' => 'email']) !!}
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukkan kata sandi...', 'id' => 'password']) !!}
                </div>

                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
