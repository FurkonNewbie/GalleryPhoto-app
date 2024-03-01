<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '00000000', // pastikan untuk mengenkripsi kata sandi
            'role' => 'admin',
            'no_telepon' => '673487',
            'alamat' => 'grebeg',
            'bio' => 'hi aku wong cui',
            'profile' => 'users.png', // nama file gambar di folder public/profile/
        ];

        // Perbaiki path sumber gambar menggunakan public_path()
        $sourcePath = public_path('profile/users.png');

        // Perbaiki path tujuan gambar (storage) menggunakan storage_path()
        $destinationPath = storage_path('app/public/profile/users.png');

        // Pastikan folder tujuan sudah ada
        if (!file_exists(dirname($destinationPath))) {
            mkdir(dirname($destinationPath), 0755, true);
        }

        // Salin gambar ke direktori yang sesuai
        copy($sourcePath, $destinationPath);

        // Tambahkan data ke basis data
        User::create($data);
    }
}
