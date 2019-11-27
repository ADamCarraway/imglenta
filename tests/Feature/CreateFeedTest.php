<?php

namespace Tests\Feature;

use App\Feed;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateFeedTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function user_can_see_form_add_feed()
    {

        $user = factory(User::class)->create();
        $this->be($user);
        $response = $this->get(route('feeds.create'))->assertStatus(200);
        $response->assertViewIs('feeds.create');

    }

    /** @test */
    public function guest_not_see_form_add_feed()
    {
        $response = $this->get(route('feeds.create'));
        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_create_new_feed()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->be($user);
        $request = [
            'title'=>'Title',
            'info'=>'Info'
        ];
        $this->post(route('feeds.store'),$request)->assertRedirect(route('feeds.create'));
        $this->assertCount(1, auth()->user()->feeds()->where($request)->get());
    }

    /** @test */
    public function guest_can_not_add_feed()
    {
        $this->post(route('feeds.store'))->assertRedirect('/login');
    }

    /** @test */
    public function user_can_not_add_feed_whith_incorrect_data()
    {
        $user = factory(User::class)->create();
        $this->be($user);
        $request = [];
        $this->post(route('feeds.store'),$request)
        ->assertSessionHasErrors(['title','info']);
//            ->assertRedirect(route('feeds.create'));
    }
}
