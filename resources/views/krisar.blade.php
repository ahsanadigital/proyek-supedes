@extends('templates.home')

@section('header')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" />
@endsection

@section('container')
<!-- .container -->
<div class="container my-3">
    <!-- .row -->
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card card-primary card-tabs">
                <div class="card-header">

                    <h3 class="m-0">Kritik dan Saran</h3>

                </div>
                <div class="card-body">

                    {!! Form::open(['method' => 'post', 'route' => 'krisar.process', 'id' => 'krisar']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nik">Nomor NIK</label>
                                {!! Form::text('nik', null, ['id' => 'nik', 'placeholder' => 'Masukkan email', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nama">Nama Anda</label>
                                <div class="form-control" id="fullname">Nama Anda</div>
                                <div class="error-message"></div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group mb-3">
                            <label for="email">Email Anda</label>
                            {!! Form::email('email', null, ['id' => 'email', 'placeholder' => 'Masukkan email anda', 'class' => 'form-control']) !!}
                            <div class="error-message"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="number">Nomor Whatsapp Anda</label>
                            {!! Form::text('number', null, ['id' => 'number', 'placeholder' => 'Masukkan nomor whatsapp anda', 'class' => 'form-control']) !!}
                            <div class="error-message"></div>
                        </div>


                        <div class="form-group mb-3">
                            <label for="for">Ditujukan Kepada</label>
                            {!! Form::select('for', [null => 'Pilih', 'ketua_rt' => 'Ketua RT', 'ketua_rw' => 'Ketua RW', 'lurah' => 'Kelurahan'], null, ['id' => 'for', 'class' => 'form-control'], [ 0 => [ "disabled" => true ] ]) !!}
                        </div>

                        <div class="form-group mb-3">
                            <label for="textarea">Isi Saran</label>
                            <div id="textarea"></div>
                        </div>

                        {!! Form::submit('Kirim', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

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
<script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/localization/messages_id.min.js') }}"></script>

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<script>
"use strict";

// Get NIK Data
$('form #nik').on("keyup", function() {
    $.ajax({
        url: '{{ route('api.data-nik') }}',
        data: {nik: $(this).val()},
        type: 'POST',

        success(response) {
            $('form #fullname').html(response.data.nama_lengkap);
        },
        error() {
            $('form #fullname').html('');
        }
    });
});
// Get NIK Data

// The activated editor functions
var toolbarOptions = [
    ['bold', 'italic'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    ['link', 'underline', 'blockquote']
];
var options = {
    modules: {
    toolbar: toolbarOptions
    },
    placeholder: 'Ketikkan sesuatu...',
    readOnly: false,
    theme: 'snow'
};
var editor = new Quill('#textarea', options);

// Form Validation
$('form#krisar').validate({
    rules: {
        'nik' : {
            required: true,
            minlength: 14,
        },
        "for" : {
            required: true,
        },
        'email' : {
            required: true,
            email: true,
        },
        'number' : {
            required: true,
            minlength: 9,
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
            type: $(e).attr('method'),
            data: {
                nik: $('form #nik').val(),
                email: $('form #email').val(),
                for: $('form #for').val(),
                nomor: $('form #number').val(),
                description: editor.root.innerHTML,
            },
            url: $(e).attr('action'),

            beforeSend() {
                Swal.fire({
                    title: 'Tunggu Sebentar',
                    allowOutsideClick: false,
                    text: 'Tunggu sebentar, data sedang diproses!',
                        didOpen() {
                            Swal.showLoading();
                        }
                    });

                    $('form button').attr('disabled', true);
                    $('form input, form textarea').attr('disabled', true);
            },

            success(response) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Kritik dan saran anda sudah tercatat di sistem kami, petugas desa akan membacanya dan sesegera mungkin memprosesnya. Terimakasih.',
                    icon: 'success',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                setTimeout(() => {
                    window.location.href = '{{ route('home') }}';
                }, 2500);
            },
            error(response) {
                Swal.fire({
                    title: 'Ada Kesalahan!',
                    text: 'Mohon maaf, kritik dan saran anda gagal diproses. Mohon coba lagi beberapa saat!',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'btn-block btn btn-light',
                    },
                    buttonsStyling: false
                });

                $('form button').removeAttr('disabled')
                $('form input, form textarea').removeAttr('disabled')
            }
        });
        // console.log(editor);
    }
});
</script>
@endsection
