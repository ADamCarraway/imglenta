<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_edit_form()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $this->be($feed->user)
            ->get(route('feeds.edit', $feed->id))
            ->assertStatus(200)
            ->assertViewIs('feeds.edit')
            ->assertSee($feed->title)
            ->assertSee($feed->info)
            ->assertViewHas('feed');
    }

    /** @test */
    public function user_can_not_see_edit_form_not_his_feed()
    {
        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $this->be($user)
            ->get(route('feeds.edit',$feed->id))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_not_see_edit_form()
    {
        $feed = factory(Feed::class)->create();
        $this->get(route('feeds.edit', $feed))
            ->assertRedirect('/login');
    }
}
