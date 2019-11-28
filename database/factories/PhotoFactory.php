<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feed;
use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'feed_id'=>function(){
            return factory(Feed::class)->create();
        },
        'path'=> $faker->image(public_path('storage/photos'),400,300, 'people', false)
    ];
});
