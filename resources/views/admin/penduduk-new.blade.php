@extends('templates.admin')

@section('content')
<div class="container-fluid">
    <div class="row g-0 mt-4">
        <div class="col-md-8">
            <h1>Data Penduduk</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ route('lurah.home') }}">Dasbor</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('penduduk.index') }}">Data Penduduk</a>
                </li>
                <li class="breadcrumb-item active">Tambah Data Penduduk</li>
            </ol>
        </div>
    </div>
</div>

<div class="row mb-3 g-0 justify-content-center">
    <div class="col-md-6">
        <div class="card card-body">

            <form method="POST" action="{{ route('penduduk.create') }}" class="container-fluid">
                @csrf

                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">Nama Lengkap</div>
                    <div class="col-8 right px-2">
                        <input type="text" class="form-control mb-2" name="nama_lengkap" placeholder="Masukkan nama" />
                    </div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">TTL</div>
                    <div class="col-8 right px-2">
                        <div class="input-group">
                            <input type="text" class="form-control" style="width: 30%" name="tempat_lahir" placeholder="Masukkan tempat lahir" />
                            <input type="date" class="form-control" style="width: 70%" name="tgl_lahir" placeholder="Masukkan tanggal lahir" />
                        </div>
                    </div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">Pekerjaan</div>
                    <div class="col-8 right px-2">
                        <input type="text" class="form-control mb-2" name="pekerjaan" placeholder="Masukkan pekerjaan" />
                    </div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">NIK/Kartu Identitas</div>
                    <div class="col-8 right px-2">
                        <input type="text" class="form-control mb-2" name="nomor_nik" placeholder="Masukkan nomor NIK" />
                    </div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">Alamat</div>
                    <div class="col-8 right px-2">
                        <input type="text" class="form-control mb-2" name="alamat_jalan" placeholder="Masukkan jalan" />
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" name="RT" placeholder="Masukkan nomor RT" />
                            <input type="number" class="form-control" name="RW" placeholder="Masukkan nomor RW" />
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
                            <option disabled="disabled" selected="selected">--Pilih--</option>
                            <option value="WNI">Indonesia</option>
                            <option value="WNA">Luar Negeri</option>
                        </select>
                    </div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                    </div>
                    <div class="col-8 right px-2">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                            <option disabled="disabled" selected="selected">--Pilih--</option>
                            <option value="l">Laki-Laki</option>
                            <option value="p">Perempuan</option>
                            <option value="o">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="row py-2 border-bottom">
                    <div class="col-4 left px-2">
                        <label for="pend_terakhir">Pendidikan Terakhir</label>
                    </div>
                    <div class="col-8 right px-2">
                        <select name="pend_terakhir" id="pend_terakhir" class="form-control">
                            <option disabled="disabled" selected="selected">--Pilih--</option>
                            <option value="sd">SD</option>
                            <option value="smp">SMP</option>
                            <option value="sma">SMA</option>
                            <option value="sarjana">Sarjana</option>
                            <option value="diploma">Diploma</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-sm mt-3 btn-primary" type="submit"><i class="fas fa-save fa-fw me-2"></i>Simpan</button>
            </form>

        </div>
    </div>
</div>
@endsection
