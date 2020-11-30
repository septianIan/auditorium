<?php

use App\Pegawai;
use Illuminate\Database\Seeder;

class PagawaiSeed extends Seeder
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
                'nik' => 12345,
                'nama' => 'yono',
                'alamat' => 'jl candi malang',
                'noTelp' => '085775088458',
                'email' => 'yono@hmail.com'
            ],

            [
                'nik' => 123456,
                'nama' => 'siswanto',
                'alamat' => 'jl candi malang',
                'noTelp' => '083435456576',
                'email' => 'siswanto@hmail.com'
            ],

            [
                'nik' => 1234567,
                'nama' => 'yogi',
                'alamat' => 'jl candi malang',
                'noTelp' => '085775088458',
                'email' => 'yogi@hmail.com'
            ],

            [
                'nik' => 123456789,
                'nama' => 'Budu',
                'alamat' => 'jl candi malang',
                'noTelp' => '0823242345',
                'email' => 'budi@hmail.com'
            ],
        ];

        Pegawai::insert($data);
    }
}
