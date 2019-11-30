<?php

namespace Tests\Feature;

use App\Feed;
use App\Notifications\HaveNewPhotoEmal;
use App\Photo;
use App\Subscriber;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_subscribe_to_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $this->be($user)
            ->post(route('feeds.subscribe', $feed));

        $this->assertCount(1, $feed->subscribers()->get());
    }

    /** @test */
    public function quest_can_not_subscribe_to_feed()
    {
        $this->post(route('feeds.subscribe', 1))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_unsubscribe_to_feed()
    {
        $this->withoutExceptionHandling();

        $feed = factory(Feed::class)->create();
        $user = factory(User::class)->create();

        $this->be($user);
        $user->subscribe($feed);

        $this->assertCount(1, $feed->subscribers()->get());
        $this->delete(route('feeds.unsubscribe', $feed));
        $this->assertCount(0, $feed->subscribers()->get());
    }

    /** @test */
    public function subscriber_got_email_after_create_photo()
    {
        Notification::fake();

        $sub = factory(Subscriber::class)->create();

        $this->assertCount(1, $sub->feed->subscribers()->get());

        $photo = UploadedFile::fake()->image('aaaa.png');
        $this->be($sub->feed->user)
            ->post(route('photos.store', $sub->feed), ['photo'=>$photo]);

        Notification::assertSentTo(
            $sub->user,
            HaveNewPhotoEmal::class
        );


    }
}
