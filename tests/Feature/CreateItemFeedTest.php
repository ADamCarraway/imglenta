<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateItemFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_form_add_item_feed()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $this->get(route('items.create'))
            ->assertViewIs('feeds.items.create');
    }

    /** @test */
    public function guest_not_see_form_add_item_feed()
    {
        $this->get(route('items.create'))
            ->assertRedirect('/login');
    }
//
//    /** @test */
//    public function user_can_create_new_item_feed()
//    {
//        Storage::fake('public/feed_items');
//        $feed = factory(Feed::class)->create();
//        $this->be($feed->user);
////        $this->assertCount(1,auth()->user()->feeds()->get());
//        $response = $this->json('POST', route(''), [
//            UploadedFile::fake()->image('photo1.jpg'),
//        ]);
//    }
}
