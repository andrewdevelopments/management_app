<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProjectsUser;
use Faker\Generator as Faker;

$factory->define(ProjectsUser::class, function (Faker $faker) {
    return [
        //'user_id' => factory(App\User::class),
        //'projects_id' => factory(App\Projects::class),
    ];
});

