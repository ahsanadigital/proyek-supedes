@extends('templates.login')

@section('header')
<style>.login-heading{text-align:center}.login-heading a{font-weight:700;text-decoration:none;color:var(--dark)}.login-desc{color:var(--gray);text-align:center}body{background-color:#f0f0f0}</style>
@endsection

@section('container')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-4 col-sm-8 col-xs-12">
            <div class="card card-body">

                <h3 class="login-heading"><a href="{{ URL::to('/') }}">SUPEDES</a></h3>
                <p class="login-desc">Silahkan masuk dahulu</p>

                <form action="{{ route('ketua_rw.login-process') }}" method="post">

                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">Surel</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-user fa-fw"></i></div>
                            <input type="email" id="email" placeholder="admin@supedes.com" name="email" class="form-control" />
                        </div>
                        <div class="form-text">Masukkan alamat surat elektronik anda.</div>
                        <div class="error-message"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Kata Sandi</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fas fa-key fa-fw"></i></div>
                            <input type="password" id="password" placeholder="password123" name="password" class="form-control" />
                            <button data-toggle="openPassword" type="button" class="btn btn-primary"><i class="fas fa-eye fa-fw"></i></button>
                        </div>
                        <div class="form-text">Masukkan alamat kata sandi anda.</div>
                        <div class="error-message"></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="remember" />
                            <label class="form-check-label" for="remember">Ingatkan Saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i>Masuk</button>
                    </div>

                </form>

            </div>

            <p class="m-0 mt-3 text-center">Masuk Sebagai<br/><a href="{{ route('lurah.login') }}">Kelurahan</a> | <a href="{{ route('ketua_rt.login') }}">Ketua RT</a></p>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/localization/messages_id.min.js') }}"></script>

<script>
"use strict"

// Showing the password input
$('[data-toggle="openPassword"]').click((e) => {
    e.preventDefault();

    let el = $('#password');
    let ty = el.attr('type');

    if(ty == 'password') {
        el.attr('type', 'text');
        $('[data-toggle="openPassword"]').find('i').attr('class', 'fas fa-fw fa-eye-slash');
    } else {
        el.attr('type', 'password');
        $('[data-toggle="openPassword"]').find('i').attr('class', 'fas fa-fw fa-eye');
    }
});
// End showing the password input

let validator = $('form').validate({
    rules: {
        'email' : {
            required: true,
            minlength: 5,
        },
        'password' : {
            required: true,
            minlength: 6,
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

                    $('button').attr('disabled', true);
                    $('input, textarea').attr('disabled', true);
            },

            success(response) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data ditemukan dan anda adalah seorang admin disini. Sistem akan mengarahkan anda ke halaman dasbor admin.',
                    icon: 'success',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                setTimeout(() => {
                    window.location.href = '{{ route('ketua_rw.home') }}';
                }, 2500);
            },
            error(response) {
                const respon = response.responseJSON;

                Swal.fire({
                    title: 'Ada Kesalahan!',
                    text: (
                        respon.message ?
                        respon.message :
                        'Mohon maaf, data anda gagal diproses. Mohon coba lagi beberapa saat!'
                    ),
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'btn-block btn btn-light',
                    },
                    buttonsStyling: false
                }).then(res => {
                    $('input').val('');
                    $('input:checkbox').prop('checked', false);
                    validator.resetForm();
                });

                $('button').removeAttr('disabled')
                $('input, textarea').removeAttr('disabled')
            }
        });
    }
});
</script>
@endsection
