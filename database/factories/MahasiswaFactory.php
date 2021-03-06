<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mahasiswa;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Mahasiswa::class, function (Faker $faker) {
    return [
        'nim' => 81131526,
        'nama' => $faker->name,
        'fakultas' => 'Teknologi Informasi Update',
        'jurusan' => 'Teknik Informatika Update',
        'alamat' => $faker->city,
        'noTelp' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
