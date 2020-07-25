<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EloquentModels\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'account' => Str::random(5),
        'name' => $faker->name,
        'email' => $faker->unique()->companyEmail,
        'email_verified_at' => now(),
        'password' => Str::random(10), // password
        'remember_token' => Str::random(10),
        'api_token' => Hash::make(Str::random(8).' '.Str::random(8)),
    ];
});
