<?php

namespace Tests\Feature;

use App\Photo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewPhotosTest extends TestCase
{
    /** @test */
    public function user_can_see_photos_in_his_feed()
    {
        $photo = factory(Photo::class)->create();
        $photos_two = factory(Photo::class)->create();
        $this->be($photo->feed()->first()->user)
            ->get(route('feeds.show',$photo->feed()->first()->id))
            ->assertSee($photo->path)
            ->assertDontSee($photos_two->path)
            ->assertSee(route('photos.like',[$photo->feed, $photo]));
    }
}
