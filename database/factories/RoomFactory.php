<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'ruang' => 'AULA LT 2',
        'status' => 0,
        'statusPinjam' => 0
    ];
});
