<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\vagprice;
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

$factory->define(vagpice::class, function (Faker $faker) {
    return [
        'NUMBER' => $faker->numbers,
        'NUMBER2' => $faker->numbers,
        'WEIGHT' => numbers,
        'VPE' =>  numbers,
        'TITLE' => text,
      
    ];
});
