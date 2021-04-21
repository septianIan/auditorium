<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Pegawai;
use Faker\Generator as Faker;

$factory->define(Pegawai::class, function (Faker $faker) {
    return [
        'nik' => $faker->randomNumber(3),
        'nama' => $faker->name,
        'alamat' => $faker->city,
        'noTelp' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});
