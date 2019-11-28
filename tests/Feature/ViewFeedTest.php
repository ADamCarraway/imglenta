<?php

namespace Tests\Feature;


use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_his_feeds()
    {
        $feed1 = factory(Feed::class)->create();
        $feed2 = factory(Feed::class)->create();

        $this->be($feed1->user);
        $this->get(route('feeds.index'))
            ->assertStatus(200)
            ->assertSee($feed1->title)
            ->assertSee($feed1->info)
            ->assertDontSee($feed2->title)
            ->assertDontSee($feed2->info);
    }

    /** @test */
    public function guest_can_not_see_feeds()
    {
        $this->get(route('feeds.index'))->assertRedirect('/login');
    }

    /** @test */
    public function user_can_see_his_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $this->be($feed->user);

        $this->get(route('feeds.show',$feed->id))
            ->assertStatus(200)
            ->assertSee($feed->title)
            ->assertSee($feed->info);
    }

    /** @test */
    public function user_can_not_use_private_url_another_user()
    {
        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $this->be($user)
            ->get(route('feeds.show',$feed->id))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_use_private_url_another_user()
    {
        $feed = factory(Feed::class)->create();

        $this->get(route('feeds.show',$feed->id))
            ->assertRedirect('/login');
    }
}
