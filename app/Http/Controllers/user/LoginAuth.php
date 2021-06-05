<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginAuth extends Controller
{
    function main() {
        $data['title'] = 'Autentikasi';
        return view('user.login', $data);
    }
}
