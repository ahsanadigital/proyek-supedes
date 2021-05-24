<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\DataPengantar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    function main() {
        $data['title'] = 'Beranda SUPEDES';
        return view('welcome', $data);
    }

    function process_data(Request $request) {
        $nomor_nik  = $request->input('nik');
        $nama       = $request->input('fullname');
        $subyek     = $request->input('subject');
        $keterangan = $request->input('keterangan');

        $valid      = Validator::make($request->all(), [
            'nik'                   => 'digits_between:5,16|required|numeric',
            'fullname'              => 'required',
            'subject'               => 'min:5|required',
        ], [
            'nik.required'          => 'Kolom NIK harap diisi terlebih dahulu!',
            'nik.digits_between'    => 'Nomor NIK hanya bisa terisi 5-16 digit angka saja!',
            'nik.numeric'           => 'Nomor NIK hanya bisa terisi angka saja!',

            'fullname.required'     => 'Kolom Nama Lengkap harap diisi terlebih dahulu!',

            'subject.min'           => 'Subyek harus terisi setidaknya 5 karakter saja!',
            'subject.required'      => 'Subyek hanya harap diisi terlebih dahulu!',
        ]);

        if($valid->fails()) {
            return response()->json([
                'data'      => $valid->errors()->all(),
                'request'   => $request->all(),
                'error'     => true,
                'message'   => 'Ups, ada yang harus anda perbaiki dahulu!',
                'severity'  => 'low',
            ], 403);
        } else {
            $data = DataPengantar::firstOrCreate([
                'id_surat'          => 'PNTR-' . md5(sha1(time())),
                'nik'               => $nomor_nik,
                'nama_terang'       => $nama,
                'keperluan'         => $subyek,
                'description'       => $keterangan
            ]);

            if($data) {
                return response()->json([
                    'success' => true,
                ], 200);
            } else {
                return response()->json([
                    'error'     => true,
                    'message'   => 'Maaf, data tidak dapat diproses! Ulangi beberapa saat lagi!',
                    'severity'  => 'mid',
                ], 403);
            }
        }
    }

    function get_nik(Request $request) {
        $nik    = $request->input('nik');
        $search = DataPenduduk::where('nomor_nik', '=', $nik);

        if($search->count() > 0) {
            return response()->json([
                'data'    => $search->get()[0],
                'success' => true,
            ], 200);
        } else {
            return response()->json([
                'error'     => true,
                'message'   => 'Nomor NIK kependudukan tidak tercatat di basis data!',
                'severity'  => 'low',
            ], 403);
        }
    }
}
