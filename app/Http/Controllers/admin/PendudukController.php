<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    function main() {
        $data['title']          = 'Data Penduduk';
        $data['penduduk']       = DataPenduduk::all();
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.penduduk', $data);
    }

    function edit(DataPenduduk $penduduk, Request $request) {
        $penduduk->whereId($request->input('id'))->update($request->except(['id', '_token']));
        return back();
    }

    function create(DataPenduduk $penduduk, Request $request) {
        $penduduk->create($request->except(['id', '_token']));
        return redirect()->route('penduduk.index');;
    }

    function add() {
        $data['title']          = 'Data Penduduk Baru';
        $data['penduduk']       = DataPenduduk::all();
        $data['jabatan']        = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.penduduk-new', $data);
    }

    function delete(DataPenduduk $penduduk, $id = null) {
        $penduduk->whereId($id)->delete();
        return back();
    }
}
