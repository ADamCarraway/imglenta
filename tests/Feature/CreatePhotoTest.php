<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePhotoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_form_create_photo()
    {
//        $this->withoutExceptionHandling();

        $this->get(route('photos.create',0))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_see_form_create_photo()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $this->be($feed->user)
            ->get(route('photos.create',$feed))
            ->assertStatus(200)
            ->assertViewIs('photos.create')
            ->assertViewHas('feed');
    }

    /** @test */
    public function user_can_create_photo()
    {
        $this->withoutExceptionHandling();

        Storage::fake('photos');

        $feed = factory(Feed::class)->create();
        $photo = UploadedFile::fake()->image('aaaa.png');
        $this->be($feed->user)
            ->post(route('photos.store', $feed), ['photo'=>$photo])
            ->assertRedirect(route('feeds.show',$feed->id));
        Storage::disk()->assertExists('public/photos/'.$photo->hashName());
        $this->assertCount(1,$feed->photos()->get());
        $photo_path = $feed->photos()->first()->path;
        $this->assertEquals($photo_path,$photo->hashName());
    }
}
