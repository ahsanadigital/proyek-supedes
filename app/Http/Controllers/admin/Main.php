<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use App\Models\DataPengantar;
use App\Models\KritikSaran;
use App\Models\User;
use Illuminate\Http\Request;

class Main extends Controller
{
    function home(Request $request) {
        $data['title']          = 'Beranda Admin';
        $data['jml_petugas']    = User::whereIn('jabatan', ['admin', 'lurah', 'ketua_rt'])->count();
        $data['pemohon']        = DataPengantar::count();
        $data['penduduk']       = DataPenduduk::count();
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.home', $data);
    }

    function krisar(KritikSaran $krisar) {
        $data['title']          = 'Kritik Saran';
        $data['krisar']         = $krisar->paginate(12);
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.krisar', $data);
    }
}
