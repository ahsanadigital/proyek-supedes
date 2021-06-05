<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ !empty($title) ? $title : config('app.name') }}</title>

    <link href="{{ public_path('css/styles.css') }}" rel="stylesheet" media="all,print" />
    <style>* {font-family: sans-serif!important;}.tabled tr:nth-child(even){background-color: #f2f2f2}.tabled td{padding:8px}.col-print-half{width:50%}@page {margin-bottom: 20px;margin-top: 20px;margin-left: 30px;margin-right: 30px}</style>
</head>
<body>

    <img src="{{ public_path('system/kop-surat.png') }}" width="100%" alt="Kop Surat" class="mb-3" />

    <div class="text-center"><strong><u>SURAT PENGANTAR</u></strong></div>
    <div class="text-center mb-2">Nomor: {{ \Carbon\Carbon::now()->format('Y/m') }}/{{ $cetak->id_surat }}</div>

    <p class="my-1"><strong>Dengan Hormat,</strong></p>
    <p>Yang bertanda tangan dibawah ini, Kepala Desa Munggut, Kecamatan Padas, Kabupaten Ngawi, dengan ini menyatakan bahwa :</p>

    <table class="tabled mb-3">
        <tbody>
            <tr>
                <td width="25%">Nama Lengkap</td>
                <td>{{ $cetak->penduduk[0]->nama_lengkap }}</td>
            </tr>
            <tr>
                <td width="25%">NIK</td>
                <td>{{ $cetak->nik }}</td>
            </tr>
            <tr>
                <td>TTL</td>
                <td>{{ $cetak->penduduk[0]->tempat_lahir }}, {{ Carbon\Carbon::parse($cetak->penduduk[0]->tgl_lahir)->translatedFormat('j F Y') }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                @if (!$cetak->penduduk[0]->pekerjaan)
                <td>&mdash;</td>
                @else
                <td>{{ $cetak->penduduk[0]->pekerjaan }}</td>
                @endif
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                @if ($cetak->penduduk[0]->kewarganegaraan == 'wni')
                <td>Indonesia</td>
                @else
                <td>Luar Negeri</td>
                @endif
            </tr>
            <tr>
                <td width="25%">Agama</td>
                <td>{{ $agama[$cetak->penduduk[0]->agama] }}</td>
            </tr>
            <tr>
                <td width="25%">Alamat</td>
                <td>{{ $cetak->penduduk[0]->alamat_jalan }}, RT {{ $cetak->penduduk[0]->RT }}/{{ $cetak->penduduk[0]->RW }}, Munggut, Padas, Ngawi, Jawa Timur 63281.</td>
            </tr>
        </tbody>
    </table>

    <p class="m-0">Menyatakan bahwa surat ini digunakan untuk <strong>{{ $cetak->keperluan }}</strong>.</p>
    <p class="m-0">Demikian Surat Pengantar ini diberikan untuk dipergunakan sebagaimana mestinya.</p>

    <div style="margin-left: 35rem; margin-top: 2rem;">
        <p class="text-right mb-2" style="text-align: right!important;">Ngawi, {{ Carbon\Carbon::now()->translatedFormat('j F Y') }}</p>
        <p class="text-right m-0" style="text-align: center!important;"><strong>Mengetahui</strong></p>
        <p style="text-align: center!important;">Kepala Desa Munggut</p>
        <p style="text-align: center!important; margin-top: 3.5rem;" class="mb-0">(Kepala Desa Munggut)</p>
        <p style="text-align: center!important;" class="m-0">NIP: xxxxx xxxxx xxx</p>
    </div>

    <br>
    <br>
    <br>
    <p class="m-0 text-center"><small class="m-0 text-muted">Dicetak di <a href="{{ URL::to('/') }}">{{ config('app.name') }}</a>.</small></p>

</body>
</html>
