<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\DataPengantar;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class HomeController extends Controller
{
    function main() {
        $data['title'] = 'Beranda SUPEDES';
        return view('welcome', $data);
    }

    function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    function process_data(Request $request) {
        $nomor_nik  = $request->input('nik');
        $subyek     = $request->input('subject');
        $keterangan = $request->input('keterangan');

        $valid      = Validator::make($request->all(), [
            'nik'                   => 'required|min:12',
            'subject'               => 'min:5|required',
        ], [
            'nik.required'          => 'Kolom NIK harap diisi terlebih dahulu!',
            'nik.min'               => 'Nomor NIK/Kitas minimal terdiri dari 12 karakter alfanumerik!',

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
                'id_surat'          => IdGenerator::generate(['table' => 'data_pengantars', 'field' => 'id_surat', 'length' => 10, 'prefix' =>'PNTR-']),
                'nik'               => $nomor_nik,
                'keperluan'         => $subyek,
                'description'       => $keterangan,
                'keterangan'        => 'verifikasi_rt',
                'status'            => 1,
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

    function search(DataPengantar $pengantar, Request $request) {
        $nik                = $request->get('nik');
        $data['pengantar']  = $pengantar->where('nik', '=', $nik)->paginate(15);
        $data['status']     = [
            'verifikasi_rt'     => 'Masih Diverifikasi di Ketua RT',
            'verifikasi_rw'     => 'Masih Diverifikasi di Ketua RW',
            'verifikasi_lurah'  => 'Masih Diverifikasi di Kelurahan',
        ];

        return view('search-data', $data);
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

    /**
     * The PDF report print
     *
     * @package Supedes App
     * @return  \Barryvdh\DomPDF\Facade
     */
    function cetak(DataPengantar $pengantar, $id = null) {
        $verify = $pengantar->whereId($id);
        if($verify->count() > 0) {
            $data['cetak']  = $verify->first();
            $data['hash']   = md5(time());
            $data['title']  = "laporan-{$data['hash']}.pdf";
            $data['jk']     = [
                'l' => 'Laki-laki',
                'p' => 'Perempuan',
            ];
            $data['agama']     = [
                'islam' => 'Islam',
                'katolik' => 'Kristen Katolik',
                'protestan' => 'Kristen Protestan',
                'hindu' => 'Hindu',
                'buddha' => 'Buddha',
                'konghuchu' => 'Kong Hu Chu',
            ];

            $pdf = PDF::loadView('admin.pemohon-cetak', $data);
            $pdf->getDomPDF()->setHttpContext(
                stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
            return $pdf->stream($data['hash']);
        } else {
            return back();
        }
    }

    /**
     * The PDF report download
     *
     * @package Supedes App
     * @return  \Barryvdh\DomPDF\Facade
     */
    function unduh(DataPengantar $pengantar, $id = null) {
        $verify = $pengantar->whereId($id);
        if($verify->count() > 0) {
            $data['cetak']  = $verify->first();
            $data['hash']   = md5(time());
            $data['title']  = "laporan-{$data['hash']}.pdf";
            $data['jk']     = [
                'l' => 'Laki-laki',
                'p' => 'Perempuan',
            ];
            $data['agama']     = [
                'islam' => 'Islam',
                'katolik' => 'Kristen Katolik',
                'protestan' => 'Kristen Protestan',
                'hindu' => 'Hindu',
                'buddha' => 'Buddha',
                'konghuchu' => 'Kong Hu Chu',
            ];

            $pdf = PDF::loadView('admin.pemohon-cetak', $data);
            $pdf->getDomPDF()->setHttpContext(
                stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
            return $pdf->download($data['title']);
        } else {
            return back();
        }
    }
}
