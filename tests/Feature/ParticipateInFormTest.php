<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInFormTest extends TestCase

{
    use DatabaseMigrations;


    /** @test */

    public function unauthenticated_users_cannot_add_repiles()
    
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);
    }

    /** @test */

    public function an_authenticated_user_may_participate_in_form_threads()
   
    {
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->make();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
