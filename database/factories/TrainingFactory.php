<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// 'type_id' => factory(\App\Type::class)->create(),

use App\Training;
use Faker\Generator as Faker;

$factory->define(\App\Training::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'type_id' => App\TrainingType::inRandomOrder()->first()->id,
    ];
});
