<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Amenities;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Amenities::class, function (Faker $faker) {
    return [
        'ruang' => 'AULA DOM',
        'status' => 0,
        'statusPinjam' => 0
    ];
});
