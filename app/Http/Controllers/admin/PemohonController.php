<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataPengantar;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\View;

class PemohonController extends Controller
{
    /**
     * Main Index of Pemohon Page
     *
     * @package Supedes App
     * @return  \Illuminate\View\View
     */
    function main() {
        $data['title']          = 'Data Pemohon';
        $data['pemohon']        = DataPengantar::all();
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.pemohon', $data);
    }

    /**
     * Delete action
     *
     * @return  \App\Models\DataPengantar
     * @package Supedes App
     */
    function delete(DataPengantar $pengantar, $id = null) {
        $pengantar->whereId($id)->delete();
        return back();
    }

    /**
     * The Main Data Pengantar Verifikasi RT Action
     *
     * @package Supedes App
     * @return  \Illuminate\View\View
     **/
    public function verifikasi_rt() {
        $data['title']          = 'Verifikasi Data &mdash; Data Pemohon';
        $data['pemohon']        = DataPengantar::where('keterangan', '=', 'verifikasi_rt');
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.pemohon-verify_rt', $data);
    }

    /**
     * The Main Data Pengantar Verifikasi Lurah Action
     *
     * @package Supedes App
     * @return  \Illuminate\View\View
     **/
    public function verifikasi_lurah() {
        $data['title']          = 'Verifikasi Data &mdash; Data Pemohon';
        $data['pemohon']        = DataPengantar::where('keterangan', '=', 'verifikasi_lurah');
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.pemohon-verify_lurah', $data);
    }

    /**
     * The Main Data Pengantar Verifikasi RW Action
     *
     * @package Supedes App
     * @return  \Illuminate\View\View
     **/
    public function verifikasi_rw() {
        $data['title']          = 'Verifikasi Data &mdash; Data Pemohon';
        $data['pemohon']        = DataPengantar::where('keterangan', '=', 'verifikasi_rw');
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.pemohon-verify_rw', $data);
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
            return redirect()->route('pemohon.index');
        }
    }

    /**
     * The PDF report download
     *
     * @package Supedes App
     * @return  \Barryvdh\DomPDF\Facade
     */
    function download(DataPengantar $pengantar, $id = null) {
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
            return redirect()->route('pemohon.index');
        }
    }

    /**
     * The Verify RT Action
     *
     * @package Supedes App
     * @return  \App\Models\DataPengantar
     */
    function verify_rt(DataPengantar $pengantar, $id = null) {
        $pengantar->whereId($id)->update(['keterangan' => 'verifikasi_rw']);
        return back();
    }

    /**
     * The Archive Action
     *
     * @package Supedes App
     * @return  \App\Models\DataPengantar
     */
    function arsipkan(DataPengantar $pengantar, $id = null) {
        $pengantar->whereId($id)->update(['status' => 0]);
        return back();
    }

    /**
     * The Verify Lurah Action
     *
     * @package Supedes App
     * @return  \App\Models\DataPengantar
     */
    function verify_lurah(DataPengantar $pengantar, $id = null) {
        $pengantar->whereId($id)->update([
            'keterangan'    => 'terverifikasi',
            'tgl_berlaku'   => Carbon::now()->addDays(7)->format('Y-m-d'),
        ]);
        return back();
    }

    /**
     * The Verify RW Action
     *
     * @package Supedes App
     * @return  \App\Models\DataPengantar
     */
    function verify_rw(DataPengantar $pengantar, $id = null) {
        $pengantar->whereId($id)->update(['keterangan' => 'verifikasi_lurah']);
        return back();
    }
}
