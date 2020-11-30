<?php

use App\Amenities;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FasilitasSeed extends Seeder
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
                'fasilitas' => 'kursi',
            ],
            [
                'fasilitas' => 'meja',
            ],
            [
                'fasilitas' => 'mikrofon',
            ],
            [
                'fasilitas' => 'lcd',
            ],
            [
                'fasilitas' => 'meja terima tamu',
            ],
            [
                'fasilitas' => 'kursi putar',
            ],
            [
                'fasilitas' => 'meja sidang',
            ],
            [
                'fasilitas' => 'genset',
            ],
            [
                'fasilitas' => 'sound system',
            ],
            [
                'fasilitas' => 'karpet',
            ],
            [
                'fasilitas' => 'parkir',
            ],
            [
                'fasilitas' => 'operator',
            ],
            [
                'fasilitas' => 'stand mic',
            ],
            [
                'fasilitas' => 'meja operator lcd',
            ],
            [
                'fasilitas' => 'ac flafon',
            ],
            [
                'fasilitas' => 'meja panggung',
            ],
            [
                'fasilitas' => 'kursi panggung',
            ],
            [
                'fasilitas' => 'cleaning service',
            ],
        ];
        Amenities::insert($data);
    }
}
