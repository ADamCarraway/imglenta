<?php

namespace Tests\Feature;

use App\Feed;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowUserFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_see_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();

        $this->get(route('user.feeds.show', $feed->id))
            ->assertSee($feed->title)
            ->assertSee($feed->info);
    }
}
