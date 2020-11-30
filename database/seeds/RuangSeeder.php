<?php

use App\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
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
                'ruang' => 'AULA DOM UMM',
                'status' => 0,
            ],

            [
                'ruang' => 'AULA LT 1',
                'status' => 0,
            ],

            [
                'ruang' => 'AULA LT 9',
                'status' => 0,
            ],

            [
                'ruang' => 'LAPANGAN BASKET UMM',
                'status' => 0,
            ],

            [
                'ruang' => 'AULA MASJID LT 1 UMM',
                'status' => 0,
            ],

            [
                'ruang' => 'AULA DOM UMM',
                'status' => 0,
            ],

            [
                'ruang' => 'LAPANFAN HALLYPAD UMM',
                'status' => 0,
            ],
            [
                'ruang' => 'AULA GKB III',
                'status' => 0,
            ],
            [
                'ruang' => 'GBK IV',
                'status' => 0,
            ],

            [
                'ruang' => 'RUANG SIDANG SENAT',
                'status' => 0,
            ],
        ];

        Room::insert($data);
    }
}
