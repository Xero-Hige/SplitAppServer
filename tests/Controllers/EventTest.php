<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetEvent()
    {
        $user = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();
        $event = \App\Models\Event::find($event->id);

        $this->json("GET", "events/".$event->id, [], ["X-Auth-UserID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $this->assertEquals($event->name, $data->name);
        $this->assertEquals($event->when, $data->when);
        $this->assertEquals($event->lat, $data->lat);
        $this->assertEquals($event->long, $data->long);
    }
}
