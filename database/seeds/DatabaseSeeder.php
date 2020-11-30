<?php

use App\Mahasiswa;
use App\RuangFasilitas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(RuangSeeder::class);
        $this->call(FasilitasSeed::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(PagawaiSeed::class);
        $this->call(RuangFasilitasSeeder::class);
    }
}
