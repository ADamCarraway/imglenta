<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feed;
use App\User;
use Faker\Generator as Faker;

$factory->define(Feed::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'info' => $faker->text
    ];
});
