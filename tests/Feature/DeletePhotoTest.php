<?php

namespace Tests\Feature;

use App\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePhotoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_photo()
    {
        $this->withoutExceptionHandling();

        $photo = factory(Photo::class)->create();
        factory(Photo::class)->create(['feed_id' => $photo->feed()->first()->id]);
        $this->be($photo->feed()->first()->user)
            ->delete(route('photos.destroy', [$photo->feed, $photo]))
            ->assertRedirect(route('feeds.show', $photo->feed->id))
            ->assertSessionHas('success');
        $this->assertCount(1, auth()->user()->feeds()->first()->photos()->get());;
    }

    /** @test */
    public function guest_can_not_delete_photo()
    {
        $this->delete(route('photos.destroy', [1, 1]))
            ->assertRedirect('/login');
    }

//    /** @test */
//    public function user_can_not_delete_not_his_photo()
//    {
////        $this->withoutExceptionHandling();
//
//        $photo = factory(Photo::class)->create();
//        $photo_two = factory(Photo::class)->create();
//
//        $this->be($photo->feed()->first()->user)
//            ->delete(route('photos.destroy', [$photo_two->feed, $photo_two]))
//            ->assertStatus(403);
//    }
}
