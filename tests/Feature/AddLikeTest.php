<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddLikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_add_like_photo()
    {
        $this->withoutExceptionHandling();

        $photo = factory(Photo::class)->create();
        $user = factory(User::class)->create();
        $feed = $photo->feed;

        $this->be($user)
            ->post(route('photos.like',[$feed, $photo]));
        $this->assertCount(1, $photo->likes()->get());
    }

    /** @test */
    public function guest_can_not_add_like_photo()
    {
        $this->post(route('photos.like',[1, 1]))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_unlike_photo()
    {
        $this->withoutExceptionHandling();

        $photo = factory(Photo::class)->create();
        $user = factory(User::class)->create();
        $feed = $photo->feed;

        $user->like($photo);
        $this->be($user)
            ->delete(route('photos.unlike',[$feed, $photo]));
        $this->assertCount(0, $photo->likes()->get());
    }
}
