<?php

namespace Tests\Feature;

use App\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreatePhotoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_see_form_create_photo()
    {
//        $this->withoutExceptionHandling();

        $this->get(route('photos.create', 0))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_see_form_create_photo()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $this->be($feed->user)
            ->get(route('photos.create', $feed))
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
            ->post(route('photos.store', $feed), ['photo' => $photo])
            ->assertRedirect(route('feeds.show', $feed->id))
            ->assertSessionHas('success');
        Storage::disk()->assertExists('public/photos/' . $photo->hashName());
        $this->assertCount(1, $feed->photos()->get());
        $photo_path = $feed->photos()->first()->path;
        $this->assertEquals($photo_path, $photo->hashName());
    }

    /** @test */
    public function guest_can_create_photo()
    {
        $this->post(route('photos.store', 0), ['photo' => 1])
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_not_create_photo_whith_incorrect_data()
    {
//        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();

        $this->be($feed->user)
            ->post(route('photos.store', $feed), ['photo' => ''])
            ->assertSessionHasErrors('photo');
    }

    /** @test */
    public function user_can_not_create_anything_except_image_type()
    {
        $feed = factory(Feed::class)->create();

        $this->be($feed->user)
            ->post(route('photos.store', $feed), ['photo' => 'image.log'])
            ->assertSessionHasErrors('photo');
    }
}
