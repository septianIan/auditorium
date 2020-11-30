<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = User::create([
            'name' => 'Administator',
            'email' => 'admin@gmail.test',
            'password' => bcrypt(12345),
        ]);

        $roleAdmin->assignRole('admin');

        $roleKetua = User::create([
            'name' => 'Ketua',
            'email' => 'ketua@gmail.test',
            'password' => bcrypt(12345),
        ]);

        $roleKetua->assignRole('ketua');
    }
}
