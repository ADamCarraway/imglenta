<?php

namespace Tests\Unit;

use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_subscribe()
    {
        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $user->subscribe($feed);

        $this->assertCount(1, $feed->subscribers()->where('user_id', $user->id)->get());
    }

    /** @test */
    public function user_can_subscribe_only_once()
    {
        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $user->subscribe($feed);
        $user->subscribe($feed);

        $this->assertCount(1, $feed->subscribers()->where('user_id', $user->id)->get());
    }

    /** @test */
    public function user_can_unsubscribe()
    {
        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $user->subscribe($feed);
        $this->assertCount(1, $feed->subscribers()->where('user_id', $user->id)->get());
        $user->unsubscribe($feed);
        $this->assertCount(0, $feed->subscribers()->where('user_id', $user->id)->get());
    }

}
