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
            'password' => '12345678',
            'role' => 'admin',
            'no_telepon' => '673487',
            'alamat' => 'grebeg',
            'bio' => 'hi aku wong cui',
        ];
        User::create($data);
    }
}
