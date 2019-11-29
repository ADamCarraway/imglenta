<?php

namespace Tests\Feature;

use App\Feed;
use App\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeletePhotoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_photo()
    {
        $photo = factory(Photo::class)->create();
        $feed = $photo->feed;

        $this->be($feed->user)
            ->delete(route('photos.destroy', [$feed, $photo]))
            ->assertRedirect(route('feeds.show', $feed->id))
            ->assertSessionHas('success');

        $this->assertFalse($feed->photos()->exists());
        Storage::disk()->assertMissing('public/photos/'.$photo->path);
    }

    /** @test */
    public function guest_can_not_delete_photo()
    {
        $this->delete(route('photos.destroy', [1, 1]))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_not_delete_not_his_photo()
    {
        $photo = factory(Photo::class)->create();
        $photo_two = factory(Photo::class)->create();
        $feed = $photo->feed;

        $this->be($feed->user)
            ->delete(route('photos.destroy', [$photo_two->feed, $photo_two]))
            ->assertStatus(403);

        $this->delete(route('photos.destroy', [$feed, $photo_two]))
            ->assertStatus(404);
    }


}
