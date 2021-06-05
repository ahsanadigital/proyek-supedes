<?php

namespace App\Http\Controllers\rt;

use App\Http\Controllers\Controller;
use App\Models\DataPengantar;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KetuaRTController extends Controller
{
    public function main() {
        $data['title']      = 'Beranda Ketua RT';
        $data['jabatan']    = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('rt.home', $data);
    }

    public function verifikasi() {
        $data['title']      = 'Verifikasi Data &mdash; Ketua RT';
        $data['pemohon']    = DataPengantar::where('keterangan', '=', 'verifikasi_rt');
        $data['jabatan']    = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('rt.verifikasi', $data);
    }

    function krisar(KritikSaran $krisar) {
        $data['title']          = 'Kritik Saran';
        $data['krisar']         = $krisar->where('for', '=', 'ketua_rt')->paginate(12);
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('rt.krisar', $data);
    }

    function verify_krisar(KritikSaran $krisar, $id) {
        $krisar->whereId($id)->update(['confirmed' => 1]);
        return back();
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
     * The Verify RT Action
     *
     * @package Supedes App
     * @return  \App\Models\DataPengantar
     */
    function verify(DataPengantar $pengantar, $id = null) {
        $pengantar->whereId($id)->update(['keterangan' => 'verifikasi_rw']);
        return back();
    }
}
