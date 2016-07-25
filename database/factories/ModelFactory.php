<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function(Faker\Generator $faker) {
    return [
        "facebook_id" => str_random(20),
        "facebook_token" => str_random(20),
        "token" => str_random(20)
    ];
});

$factory->define(App\Models\Event::class, function(Faker\Generator $faker) {
    return [
        "name" => str_random(20),
        "when" => $faker->dateTime,
        "lat" => $faker->latitude,
        "long" => $faker->longitude
    ];
});