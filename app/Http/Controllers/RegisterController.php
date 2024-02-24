<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{

    public function cek_register(Request $request)
    {
        $alert = [
            'username.required' => 'nama harus diisi!',
            'email.unique' => 'email sudah digunakan',
            'email.required' => 'email harus diisi!',
            'password.required' => 'password harus diisi!',
            'password.min' => 'password minimal 7 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'no_telepon.required' => 'no telepon harus diisi!',
            'bio.required' => 'no telepon harus diisi!',
        ];
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password'  => 'required|min:7',
        ], $alert);

        // Membuat profil otomatis
        $newProfile = 'users.png'; // Nama file gambar profil default

        // Membuat pengguna baru
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->password,
            'profile' => $newProfile, // Simpan nama file gambar profil
        ]);

        // Menyimpan file profil default ke storage
        $defaultProfilePath = public_path('profile/' . $newProfile);
        copy(public_path('profile/users.png'), $defaultProfilePath);
        Alert::success('Registrasi berhasil', 'Anda telah berhasil registrasi');
        return redirect('register');
    }



    public function register()
    {
        return view('register');
    }
}
