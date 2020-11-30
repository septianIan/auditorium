<?php

use App\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nim' => 12345,
                'nama' => 'Ian',
                'fakultas' => 'Teknologi Informasi',
                'jurusan' => 'Teknik Informatika',
                'alamat' => 'Jl mongin sidi bojonegoro',
                'noTelp' => '085775088148',
                'email' => 'ian@gmail.test'
            ],

            [
                'nim' => 123456,
                'nama' => 'Bayu',
                'fakultas' => 'Teknologi Informasi',
                'jurusan' => 'Teknik Informatika',
                'alamat' => 'Jl panglima soedirman',
                'noTelp' => '085798798',
                'email' => 'bayu@gmail.test'
            ],

            [
                'nim' => 1234567,
                'nama' => 'Andi',
                'fakultas' => 'Ekonomi dan Bisnis',
                'jurusan' => 'Akutansi',
                'alamat' => 'Perumahan puri cepaka putih',
                'noTelp' => '085775082323',
                'email' => 'andi@gmail.test'
            ],

            [
                'nim' => 12345678,
                'nama' => 'Budi',
                'fakultas' => 'Ekonomi dan Bisnis',
                'jurusan' => 'Akutansi',
                'alamat' => 'Jl mongin sidi bojonegoro',
                'noTelp' => '08577508162',
                'email' => 'budi@gmail.test'
            ],

            [
                'nim' => 123456789,
                'nama' => 'Novi',
                'fakultas' => 'Ekonomi dan Bisnis',
                'jurusan' => 'Perbankan',
                'alamat' => 'Jl basuki rahmat',
                'noTelp' => '085775028148',
                'email' => 'novi@gmail.test'
            ],
        ];

        Mahasiswa::insert($data);
    }
}
