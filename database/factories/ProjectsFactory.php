<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Projects;
use Faker\Generator as Faker;

$factory->define(Projects::class, function (Faker $faker) {
    return [
        'name' => 'Project ' . $faker->unique(true)->numberBetween(1, 20),
        'description' => $faker->text(200)
    ];
});
