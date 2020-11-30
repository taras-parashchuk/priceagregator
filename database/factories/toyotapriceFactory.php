<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\toyotaprice;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(toyotaprice::class, function (Faker $faker) {
    return [
        'NUMBER' => $faker->unique()->randomNumber,
        'NUMBER2' => $faker->randomNumber,
        'WEIGHT' => $faker->numberBetween(1,200),
        'VIN' => $faker->randomDigit,
        'NL' => $faker->randomDigit,  
        'VPE' =>  $faker->randomLetter,
        'TITLE' => $faker->sentence(2, true),
        'TEILEART' => $faker->sentence(2)
    ];
});
