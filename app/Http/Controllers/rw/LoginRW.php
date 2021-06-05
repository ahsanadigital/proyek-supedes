<?php

namespace App\Http\Controllers\rw;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginRW extends Controller
{
    function main() {
        $data['title'] = 'Autentikasi';
        return view('rw.login', $data);
    }

    function process(Request $request) {
        $email      = $request->input('email');
        $password   = $request->input('password');
        $remember   = filter_var($request->input('remember'), FILTER_VALIDATE_BOOLEAN);

        $auth       = Auth::attempt(['email' => $email, 'password' => $password, 'jabatan' => 'ketua_rw'], $remember);
        $validate   = Validator::make($request->all(), [
            'email'     => 'required|email|min:5',
            'password'  => 'required|min:5',
        ], [
            'email.required'    => 'Kolom Surat Elektronik harap diisi terlebih dahulu!',
            'email.email'       => 'Kolom Surat Elektronik setidaknya teriisi dengan format email yang benar!',
            'email.min'         => 'Kolom Surat Elektronik harus terisi minimal 5 karakter!',

            'password.required' => 'Kolom Kata Sandi harap diisi terlebih dahulu!',
            'password.min'      => 'Kolom Kata Sandi harus terisi minimal 5 karakter!',
        ]);

        if($validate->fails()) {
            return response()->json([
                'error'     => true,
                'message'   => 'Maaf, ada beberapa kesalahan dari peladen!',
                'data'      => $validate->errors()->all()
            ], 401);
        } else {
            if($auth) {
                return response()->json([
                    'success'   => true,
                ], 200);
            } else {
                return response()->json([
                    'error'     => true,
                    'message'   => 'Maaf, periksa kembali detail kredensial anda. Nama Pengguna atau Kata Sandi tidak dapat ditemukan oleh peladen.'
                ], 401);
            }
        }
    }
}
