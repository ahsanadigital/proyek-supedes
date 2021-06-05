<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaranController extends Controller
{
    function main() {
        $data['title'] = 'Kritik dan Saran';
        return view('krisar', $data);
    }

    function process(KritikSaran $krisar, Request $request) {
        $insert = $krisar->firstOrCreate([
            'nik'               => $request->input('nik'),
            'for'               => $request->input('for'),
            'nomor_whatsapp'    => $request->input('nomor'),
            'email'             => $request->input('email'),
            'description'       => $request->input('description'),
        ]);

        if($insert) {
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
