<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function main() {
        $data['title']      = 'Data Petugas';
        $data['petugas']    = User::where('id', '!=', auth()->user()->id)->paginate(15);
        $data['jabatan']    = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.petugas', $data);
    }

    public function create() {
        $data['title']      = 'Data Petugas Baru';
        $data['jabatan']    = [
            'ketua_rw'  => 'Ketua RW',
            'lurah'     => 'Kelurahan',
            'ketua_rt'  => 'Ketua RT',
            'user'      => 'Warga',
        ];
        return view('admin.petugas-new', $data);
    }

    public function tambah(User $user, Request $request) {
        $validate = Validator::make($request->all(), [
            'nama_terang'   => 'required',
            'status'        => 'required',
            'jabatan'       => 'required',
            'email'         => 'email|required|min:5',
            'password'      => 'min:5|required',
        ]);

        if($validate->fails()) {
            return back();
        } else {
            $user->insertOrIgnore([
                'nama_terang'   => $request->input('nama_terang'),
                'status'        => $request->input('status'),
                'jabatan'       => $request->input('jabatan'),
                'email'         => $request->input('email'),
                'password'      => bcrypt($request->input('password'))
            ]);

            if($user) {
                return redirect()->route('petugas.main');
            } else {
                return back();
            }
        }
    }

    public function edit(User $user, $id, Request $request) {
        $data = $request->except(['password', '_token']);
        if($request->input('password')) {
            $user->whereId($id)->update([
                'password'      => bcrypt($request->input('password')),
                'nama_terang'   => $data['nama_terang'],
                'email'         => $data['email'],
                'jabatan'       => $data['jabatan'],
                'status'        => $data['status'],
            ]);
        } else {
            $user->whereId($id)->update([
                'nama_terang'   => $data['nama_terang'],
                'email'         => $data['email'],
                'jabatan'       => $data['jabatan'],
                'status'        => $data['status'],
            ]);
        }
        return back();
    }

    public function delete(User $user, $id) {
        $user->find($id)->delete();
        return back();
    }
}
