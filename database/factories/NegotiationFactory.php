<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Negotiation;
use Faker\Generator as Faker;

$factory->define(Negotiation::class, function (Faker $faker) {
    return [
        'user_id' =>  9,//factory(App\User::class),
        'contact_id' => $faker->numberBetween($min = 1, $max = 160),//factory(App\Contact::class),
        'neg_type_id' => $faker->numberBetween($min = 1, $max = 3),//factory(App\NegotiationType::class),
        'neg_status_id' => $faker->numberBetween($min = 1, $max = 3),//factory(App\NegotiationStatus::class),
        'title' => $faker->sentence,
        'description' => $faker->text($maxNbChars = 100),
        'active' => 1,
        'deadline' => '2020-07-31',
        'neg_process_id' => $faker->numberBetween($min = 1, $max = 6),
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000),
        //
    ];
});
