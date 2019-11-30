<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feed;
use App\Subscriber;
use App\User;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'feed_id' => function () {
            return factory(Feed::class)->create()->id;
        },
    ];
});
