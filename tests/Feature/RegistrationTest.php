<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeEmail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $request = [
            'name'=>'imglenta2',
            'email'=>'rrr@mail.ru',
            'password'=> 'wwwwwwww',
            'password_confirmation'=>'wwwwwwww'
        ];

        $response = $this->post('/register',$request);

        $response->assertRedirect('/home');
        $this->assertTrue(auth()->check());
    }

    /** @test */
    public function user_got_emai_after_registration()
    {
        Notification::fake();
        $request = [
            'name'=>'imglenta2',
            'email'=>'rrr@mail.ru',
            'password'=> 'wwwwwwww',
            'password_confirmation'=>'wwwwwwww'
        ];

        $response = $this->post('/register',$request);

        Notification::assertSentTo(
            auth()->user(),
            WelcomeEmail::class
        );
    }

    /** @test */
    public function it_a_feed()
    {
        $request = [
            'name'=>'imglenta2',
            'email'=>'rrr@mail.ru',
            'password'=> 'wwwwwwww',
            'password_confirmation'=>'wwwwwwww'
        ];

        $response = $this->post('/register',$request);

        $this->assertCount(1, auth()->user()->feeds()->get());
    }
}
