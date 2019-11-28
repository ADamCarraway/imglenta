<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();

        $this->be($feed->user)
            ->put(route('feeds.update', $feed), ['title'=>'new 2222', 'info'=>'new www'])
        ->assertRedirect(route('feeds.show', $feed))
        ->assertSessionHas('success');
        $feed->refresh();
        $this->assertEquals($feed->title,'new 2222');
        $this->assertEquals($feed->info,'new www');
    }

    /** @test */
    public function user_can_not_update_feed_whith_incorrect_data()
    {
//        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();

        $this->be($feed->user)
            ->put(route('feeds.update', $feed), ['title'=>'', 'info'=>''])
            ->assertSessionHasErrors(['title', 'info']);
        $this->assertNotEquals($feed->title,'');
        $this->assertNotEquals($feed->info,'');
    }

    /** @test */
    public function user_can_not_update_not_his_feed()
    {
        $user = factory(User::class)->create();
        $feed = factory(Feed::class)->create();
        $this->be($user)
            ->put(route('feeds.update', $feed), ['title'=>'ddd', 'info'=>'ddd'])
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_update_not_feed()
    {
        $feed = factory(Feed::class)->create();

        $this->put(route('feeds.update', $feed), ['title'=>'ddd', 'info'=>'ddd'])
            ->assertRedirect('/login');
    }
}
