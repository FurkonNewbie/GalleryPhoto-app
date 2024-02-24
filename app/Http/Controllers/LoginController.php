<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

// use Alert;

class LoginController extends Controller
{

    public function cek_log(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'user') {
                Alert::success('Login berhasil!', 'Selamat datang di halaman user');
                return redirect('index');
            } else {
                Alert::success('Login berhasil!', 'Selamat datang di halaman dashboard');
                return redirect('dashboard');
            }
        } else {
            Alert::error('Gagal Login', 'Email atau password salah');
            return redirect('login');
        }
    }
    public function login()
    {
        return view('login');
    }
}
