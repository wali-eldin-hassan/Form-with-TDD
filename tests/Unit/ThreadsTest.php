<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUP(): void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */

    public function a_thread_has_replies()
    {


        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */

    public function a_thread_has_creator()
    {


        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */

    public function a_thread_can_add_reply()
    {
        $this->thread->addReply([
            'body' => 'foobar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
