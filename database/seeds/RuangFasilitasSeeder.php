<?php

use App\RuangFasilitas;
use Illuminate\Database\Seeder;

class RuangFasilitasSeeder extends Seeder
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
                'room_id' => 1,
                'fasilitas' => 'AC FLAFON',
                'jumlah' => 2
            ],

            [
                'room_id' => 1,
                'fasilitas' => 'CLEANNING SERVICE',
                'jumlah' => 3
            ],

            [
                'room_id' => 1,
                'fasilitas' => 'GENSET',
                'jumlah' => 2
            ],

            [
                'room_id' => 1,
                'fasilitas' => 'MIKROFON',
                'jumlah' => 3
            ],
            [
                'room_id' => 1,
                'fasilitas' => 'OPERATOR',
                'jumlah' => 1
            ],
            [
                'room_id' => 1,
                'fasilitas' => 'SOUND SYSTEM',
                'jumlah' => 4
            ],

            [
                'room_id' => 1,
                'fasilitas' => 'STAND MIC',
                'jumlah' => 2
            ],
            [
                'room_id' => 1,
                'fasilitas' => 'MEJA PANGGUNG',
                'jumlah' => 3
            ],

            [
                'room_id' => 2,
                'fasilitas' => 'AC FLAFON',
                'jumlah' => 2
            ],

            [
                'room_id' => 2,
                'fasilitas' => 'MIKROFON',
                'jumlah' => 2
            ],
            [
                'room_id' => 2,
                'fasilitas' => 'GENSET',
                'jumlah' => 2
            ],
            [
                'room_id' => 2,
                'fasilitas' => 'KARPET',
                'jumlah' => 2
            ],
            [
                'room_id' => 2,
                'fasilitas' => 'SOUND SYSTEM',
                'jumlah' => 3
            ],

            [
                'room_id' => 2,
                'fasilitas' => 'MEJA PANGGUNG',
                'jumlah' => 3
            ],

            [
                'room_id' => 2,
                'fasilitas' => 'PARKIR',
                'jumlah' => null
            ],

            [
                'room_id' => 3,
                'fasilitas' => 'AC FLAFON',
                'jumlah' => 2
            ],

            [
                'room_id' => 3,
                'fasilitas' => 'GENSET',
                'jumlah' => 1
            ],

            [
                'room_id' => 3,
                'fasilitas' => 'PARKIR',
                'jumlah' => null
            ],

            [
                'room_id' => 3,
                'fasilitas' => 'LCD',
                'jumlah' => 2
            ],

            [
                'room_id' => 3,
                'fasilitas' => 'KURSI PANGGUNG',
                'jumlah' => 1
            ],
        ];

        RuangFasilitas::insert($data);
    }
}
