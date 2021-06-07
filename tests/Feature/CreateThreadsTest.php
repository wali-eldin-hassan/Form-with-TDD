<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

use function PHPSTORM_META\map;

class CreateThreadsTest extends TestCase

{
    use DatabaseMigrations;

    /** @test */

    public function a_guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function a_guests_can_not_see_create_threads_page()
    {

        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');
    }


    /** @test */

    function an_authenticted_user_can_create_new_forum_threads()

    {
        $this->signIn();

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())

            ->assertSee($thread->title)

            ->assertSee($thread->body);
    }
}
