<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\Dosen;

class SampleCoursesSeeder extends Seeder
{
    public function run()
    {
        $dosen = Dosen::first(); // seeder sebelumnya membuat 1 dosen

        MataKuliah::create([
            'kode_mk' => 'MK001',
            'nama_mk' => 'Pemrograman Berbasis Objek',
            'dosen_id' => $dosen->id,
            'sks' => 3
        ]);

        MataKuliah::create([
            'kode_mk' => 'MK002',
            'nama_mk' => 'Struktur Data dan Algoritma',
            'dosen_id' => $dosen->id,
            'sks' => 3
        ]);
    }
}
