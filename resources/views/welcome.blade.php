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
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-home"></i></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-tambah-tab" data-bs-toggle="pill" data-bs-target="#pills-tambah" type="button" role="tab" aria-controls="pills-tambah" aria-selected="false"><i class="fas fa-plus me-2"></i>Pengantar Surat</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-cari-tab" data-bs-toggle="pill" data-bs-target="#pills-cari" type="button" role="tab" aria-controls="pills-cari" aria-selected="false"><i class="fas fa-search me-2"></i>Cari Data</button>
                        </li>
                    </ul>

                </div>
                <div class="card-body p-4">

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="alert alert-info">
                                        <div class="row">
                                            <div class="col-3 text-center">
                                                <i class="fas fa-info-circle fa-5x"></i>
                                            </div>
                                            <div class="col-9">
                                                <h4>Selamat Datang!</h4>
                                                <p>Selamat Datang di aplikasi "SURAT PENGANTAR RT/RW" yang mana mempermudah administrasi kepengurusan surat pengantar untuk keperluan di luar kelurahan.</p>
                                                <p class="m-0">Silahkan klik "Pengantar Surat" untuk meminta pembuatan "Surat Pengantar" baru dan "Cari data" untuk mencari data permintaan anda.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-tambah" role="tabpanel" aria-labelledby="pills-tambah-tab">
                            <h3>Formulir Pengajuan "Surat Pengantar"</h3>
                            <p class="text-muted">Isiikan beberapa kolom dibawah untuk kami tindak lanjuti pembuatan formulir Surat Pengantar anda.</p>

                            <form action="{{ route('process-data') }}" method="post" id="pengajuan" novalidate>

                                @csrf

                                <div class="row">
                                    <div class="col-md-7 mb-3">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">

                                                <div class="form-group mb-3">
                                                    <label for="nik">Nomor NIK</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user fa-fw"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="nik" id="nik" placeholder="Nomor NIK Anda" />
                                                    </div>
                                                    <div class="error-message"></div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-3">

                                                <div class="form-group mb-3">
                                                    <label for="fullname">Nama Lengkap</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user fa-fw"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nama Lengkap (Otomatis)" readonly />
                                                    </div>
                                                    <div class="error-message"></div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group mb-3 mb-md-0">
                                            <label for="subject">Keperluan</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-comment fa-fw"></i>
                                                </span>
                                                <input type="text" name="subject" class="form-control" id="subject" placeholder="Isikan Keperluan Anda" />
                                            </div>
                                            <div class="error-message"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-5 mb-3">

                                        <div class="form-group mb-3">
                                            <label for="keterangan">Penjelasan Keperluan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Masukkan penjelasan..." rows="5.75"></textarea>
                                            <div class="error-message"></div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Kirim<i class="fas fa-paper-plane ms-2"></i></button>

                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-cari" role="tabpanel" aria-labelledby="pills-cari-tab">
                            <h3>Pencarian Data</h3>
                            <p class="text-muted">Pencarian data pengajuan "Surat Pengantar" anda.</p>

                            <div class="table-striped">
                                <table class="table-striped table">
                                    <thead>
                                        <th width="15%">#</th>
                                        <th width="30%">ID Registrasi</th>
                                        <th width="30%">Nama Terang</th>
                                        <th width="15%">Jangka Waktu</th>
                                        <th width="10%">Aksi</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/localization/messages_id.min.js') }}"></script>

<script>
"use strict";

// Get NIK Data
$('#pengajuan #nik').on("keyup", function() {
    $.ajax({
        url: '{{ route('api.data-nik') }}',
        data: {nik: $(this).val()},
        type: 'POST',

        success(response) {
            $('#pengajuan #fullname').val(response.data.nama_lengkap);
        },
        error() {
            $('#pengajuan #fullname').val('');
        }
    });
});
// Get NIK Data

$('form#pengajuan').validate({
    rules: {
        'fullname' : {
            required: true,
        },
        'subject' : {
            required: true,
        },
        'nik' : {
            required: true,
            minlength: 5,
            maxlength: 16,
        },
    },

    onfocusout: function (e) {
        this.element(e);
    },

    highlight: function (element) {
        jQuery(element).closest('.form-control').addClass('is-invalid');
        jQuery(element).closest('.form-control').removeClass('is-valid');
    },
    unhighlight: function (element) {
        jQuery(element).closest('.form-control').removeClass('is-invalid');
        jQuery(element).closest('.form-control').addClass('is-valid');
    },

    errorElement: 'div',
    errorClass: 'invalid-feedback',
    errorPlacement: function (error, element) {
        $(element).parents('.form-group').find(".error-message").append(error);
    },

    submitHandler(e) {
        $.ajax({
            url: $(e).attr('action'),
            data: $(e).serialize(),
            type: 'POST',

            beforeSend() {
                Swal.fire({
                    title: 'Tunggu Sebentar',
                    allowOutsideClick: false,
                    text: 'Tunggu sebentar, data sedang diproses!',
                    didOpen() {
                        Swal.showLoading();
                    }
                    });

                    $('#pengajuan button').attr('disabled', true);
                    $('#pengajuan input, #pengajuan textarea').attr('disabled', true);
            },

            success(response) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil diproses ke dalam database. Surat Pengajuan anda akan kami kirim ke alamat rumah anda dalam waktu dekat.',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn-block btn btn-light',
                    },
                    buttonsStyling: false
                });

                setTimeout(() => {
                    window.location.href = '{{ route('home') }}';
                }, 2500);
            },
            error(response) {
                Swal.fire({
                    title: 'Ada Kesalahan!',
                    text: 'Mohon maaf, data anda gagal diproses. Mohon coba lagi beberapa saat!',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'btn-block btn btn-light',
                    },
                    buttonsStyling: false
                });

                $('#pengajuan button').removeAttr('disabled')
                $('#pengajuan input, #pengajuan textarea').removeAttr('disabled')
            }
        });
    }
});
</script>
@endsection
