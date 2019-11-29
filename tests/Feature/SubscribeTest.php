<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_subscribe_to_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $this->be($user)
            ->post(route('feeds.subscribe', $feed))
            ->assertRedirect(route('user.feeds.show', $feed->id));

        $this->assertCount(1, $feed->subscribers()->get());
    }

    /** @test */
    public function quest_can_not_subscribe_to_feed()
    {
        $this->post(route('feeds.subscribe', 1))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_unsubscribe_to_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $this->be($user);
        $user->subscribe($feed);

        $this->assertCount(1, $feed->subscribers()->get());
        $this->delete(route('feeds.unsubscribe', $feed))
            ->assertRedirect(route('user.feeds.show', $feed->id));
        $this->assertCount(0, $feed->subscribers()->get());
    }
}
