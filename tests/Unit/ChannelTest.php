<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChannelTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * @test
     */
    public function a_channel_consist_of_threads()
    {
        $channle = create('App\Channel');

        $thread = create('App\Thread',['channel_id'=>$channle->id]);

        $this->assertTrue($channle->threads->contains($thread));

    }
}
