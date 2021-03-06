<?php

namespace Tests\Feature;

use App\Feed;
use App\Photo;
use App\Subscriber;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $this->be($feed->user);
        $feed2 = factory(Feed::class)->create(['user_id' => auth()->id()]);
        $this->delete(route('feeds.destroy', $feed))
            ->assertRedirect(route('feeds.index'))
            ->assertSessionHas('success');
        $this->assertCount(1, auth()->user()->feeds()->get());
    }

    /** @test */
    public function guest_can_not_delete_feed()
    {
        $feed = factory(Feed::class)->create();
        $this->delete(route('feeds.destroy', $feed))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_not_delete_not_his_feed()
    {
        $user = factory(User::class)->create();
        $feed = factory(Feed::class)->create();
        $this->be($user)
            ->delete(route('feeds.destroy', $feed))
            ->assertStatus(403);
    }

    /** @test */
    public function user_can_not_delete_last_feed()
    {
        $feed = factory(Feed::class)->create();
        $this->be($feed->user)
            ->delete(route('feeds.destroy', $feed))
            ->assertSessionHas('error');
        $this->assertTrue(Feed::where('id', $feed->id)->exists());
    }

    /** @test */
    public function after_deleted_feed_delete_photo_and_subs()
    {
        $sub = factory(Subscriber::class)->create();
        $feed = $sub->feed;
        factory(Photo::class)->create(['feed_id' => $feed->id]);

        $sub->feed->delete();
        $this->assertDatabaseMissing('feeds', ['id' => $feed]);
        $this->assertCount(0, $feed->photos()->get());
        $this->assertCount(0, $feed->subscribers()->get());
    }
}
