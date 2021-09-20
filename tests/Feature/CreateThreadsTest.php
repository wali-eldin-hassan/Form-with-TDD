<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class CreateThreadsTest extends TestCase

{
    use DatabaseMigrations;

    /** @test */

    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();


        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }


    /** @test */

    function an_authenticted_user_can_create_new_forum_threads()

    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());
        // dd($response->headers->get('location'));

        $this->get($response->headers->get('location'))

            ->assertSee($thread->title)

            ->assertSee($thread->body);
    }



    /**
     * @test
     */

    public function a_threads_requires_title()
    {
        $this->puplishTread(['title' => null])
            ->assertSessionHasErrors('title');
    }



    /**
     * @test
     */

    public function a_threads_requires_body()
    {

        $this->puplishTread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */

    public function a_threads_requires_valid_channle()
    {
        factory('App\Channel', 2)->create();

        $this->puplishTread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
            
        $this->puplishTread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }



    public function puplishTread($overrides = [])
    {

        $this->withExceptionHandling()->signIn();


        $thread = make('App\Thread', $overrides);


        return $this->post('/threads', $thread->toArray());
    }
}
