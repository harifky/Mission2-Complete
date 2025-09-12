<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class SampleUsersSeeder extends Seeder
{
    public function run()
    {
        // Dosen user
        $dosenUser = User::create([
            'username' => 'dosen01',
            'password' => Hash::make('password123'),
            'full_name' => 'Dr. Riza',
            'role' => 'dosen'
        ]);
        Dosen::create(['user_id' => $dosenUser->id, 'nidn' => '12345678']);

        // Mahasiswa 1
        $mhsUser = User::create([
            'username' => 'mhs060',
            'password' => Hash::make('password321'),
            'full_name' => 'Rifky Hermawan',
            'role' => 'mahasiswa'
        ]);
        Mahasiswa::create(['user_id' => $mhsUser->id, 'nim' => '241511060', 'tahun_masuk' => 2024]);

        // Mahasiswa 2
        $mhsUser2 = User::create([
            'username' => 'mhs051',
            'password' => Hash::make('password432'),
            'full_name' => 'Muhammad Faiz Ramdhani',
            'role' => 'mahasiswa'
        ]);
        Mahasiswa::create(['user_id' => $mhsUser2->id, 'nim' => '241511051', 'tahun_masuk' => 2024]);
    }
}
