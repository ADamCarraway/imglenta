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
        $photos = factory(Photo::class)->create();
        $photos_two = factory(Photo::class)->create();
        $this->be($photos->feed()->first()->user)
            ->get(route('feeds.show',$photos->feed()->first()->id))
            ->assertSee($photos->path)
            ->assertDontSee($photos_two->path);
    }
}
