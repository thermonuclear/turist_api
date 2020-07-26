<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EloquentModels\Lead;
use Faker\Generator as Faker;
use App\EloquentModels\User;

$factory->define(Lead::class, function (Faker $faker) {
    $source = ['сайт', 'vk', 'ok', 'fb'];
    $userID = (new User)->newQuery()->select('id')->take(10)->inRandomOrder()->first();

    return [
        'lead_user_id' => $userID->id,
        'lead_name' => $faker->name,
        'lead_phone' => $faker->phoneNumber,
        'lead_email' => $faker->email,
        'lead_source' => $source[array_rand($source)],
        'lead_fields' => json_encode([
            [
                'name' => 'Желаемая страна отдыха',
                'values' => ['Турция', 'Тунис']
            ],
            [
                'name' => 'Бюджет',
                'values' => [150000]
            ]
        ]),
    ];
});
