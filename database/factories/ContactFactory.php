<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'user_id' => 9, //factory(App\User::class), //9,
        'phone' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        //'created_at' => $faker->dateTime,
        //'updated_at' => $faker->dateTime,
    ];
});
