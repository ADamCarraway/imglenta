<?php

namespace Tests\Unit;

use App\Feed;
use App\Photo;
use App\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_like_photo()
    {
        $photo = factory(Photo::class)->create();
        $user = factory(User::class)->create();

        $user->like($photo);

        $this->assertCount(1, $photo->likes()->where('user_id', $user->id)->get());
    }

    /** @test */
    public function user_can_like_photo_only_once()
    {
        $photo = factory(Photo::class)->create();
        $user = factory(User::class)->create();

        $user->like($photo);
        $user->like($photo);

        $this->assertCount(1, $photo->likes()->where('user_id', $user->id)->get());
    }

    /** @test */
    public function user_can_unlike_photo()
    {
        $photo = factory(Photo::class)->create();
        $user = factory(User::class)->create();

        $user->like($photo);

        $this->assertCount(1, $photo->likes()->where('user_id', $user->id)->get());
        $user->unlike($photo);
        $this->assertCount(0, $photo->likes()->where('user_id', $user->id)->get());

    }
}
