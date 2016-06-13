<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Flyer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory('App\User')->create()->id,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'state' => $faker->streetName,
        'country' => $faker->country,
        'price' => $faker->numberBetween(10000, 500000),
        'description' => $faker->paragraphs(3, true)
    ];
});
