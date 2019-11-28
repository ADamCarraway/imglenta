<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $this->be($feed->user);
        $this->delete(route('feeds.destroy',$feed))->assertStatus(200);
        $this->assertCount(0,auth()->user()->feeds()->get());
    }

    /** @test */
    public function guest_can_not_delete_feed()
    {
        $feed = factory(Feed::class)->create();
        $this->delete(route('feeds.destroy',$feed))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_not_delete_not_his_feed()
    {
        $user = factory(User::class)->create();
        $feed = factory(Feed::class)->create();
        $this->be($user)
            ->delete(route('feeds.destroy',$feed))
            ->assertStatus(403);
    }
}
