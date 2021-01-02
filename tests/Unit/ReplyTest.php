<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function setUP(): void
    {
        parent::setUp();

        $this->reply = factory('App\Reply')->create();
    }

    /** @test */

    public function it_has_an_owner()
    {
        $this->assertInstanceOf('App\User', $this->reply->owner);
    }
}
