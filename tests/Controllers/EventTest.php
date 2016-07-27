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

        $this->json("GET", "events/".$event->id, [], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $this->assertEquals($event->name, $data->name);
        $this->assertEquals($event->when, $data->when);
        $this->assertEquals($event->lat, $data->lat);
        $this->assertEquals($event->long, $data->long);
    }

    public function testGetEvents()
    {
        $user = factory(\App\Models\User::class)->create();
        $user = \App\Models\User::find($user->facebook_id);
        /**
         * @var \App\Models\Event $event
         */
        $event = factory(\App\Models\Event::class)->create();
        $event = \App\Models\Event::find($event->id);

        $eventInvitee = new \App\Models\EventInvitee();
        $eventInvitee->user_id = $user->facebook_id;
        $eventInvitee->event_id = $event->id;
        $eventInvitee->save();

        $this->json("GET", "events", [], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $this->assertEquals(1, count($data));

        $this->assertEquals($event->name, $data[0]->name);
        $this->assertEquals($event->when, $data[0]->when);
        $this->assertEquals($event->lat, $data[0]->lat);
        $this->assertEquals($event->long, $data[0]->long);
    }

    public function testGetEventsOnlyMine()
    {
        $user = factory(\App\Models\User::class)->create();
        $user = \App\Models\User::find($user->facebook_id);

        $event = factory(\App\Models\Event::class)->create();
        $event = \App\Models\Event::find($event->id);
        $eventInvitee = new \App\Models\EventInvitee();
        $eventInvitee->user_id = $user->facebook_id;
        $eventInvitee->event_id = $event->id;
        $eventInvitee->save();

        $user2 = factory(\App\Models\User::class)->create();
        $user2 = \App\Models\User::find($user2->facebook_id);

        $event2 = factory(\App\Models\Event::class)->create();
        $event2 = \App\Models\Event::find($event2->id);
        $eventInvitee2 = new \App\Models\EventInvitee();
        $eventInvitee2->user_id = $user2->facebook_id;
        $eventInvitee2->event_id = $event2->id;
        $eventInvitee2->save();

        $this->json("GET", "events", [], ["X-Auth-Facebook-ID" => $user2->facebook_id, "X-Auth-Token" => $user2->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $this->assertEquals(1, count($data));

        $this->json("GET", "events", [], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $this->assertEquals(1, count($data));
    }

    public function testPostEvent()
    {
        $user = factory(\App\Models\User::class)->create();

        $this->json("POST", "events", [
            "name" => "some",
            "when" => "2016-07-28 00:00:00",
            "lat" => 2,
            "long" => 5
        ], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $event = \App\Models\Event::find($data->id);

        $this->assertEquals("some", $event->name);
        $this->assertEquals("2016-07-28 00:00:00", $event->when);
        $this->assertEquals(2, $event->lat);
        $this->assertEquals(5, $event->long);
    }

    public function testPutEvent()
    {
        $user = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();

        $this->json("PUT", "events/".$event->id, [
            "name" => "some",
            "when" => "2016-07-28 00:00:00",
            "lat" => 2,
            "long" => 5
        ], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $event = \App\Models\Event::find($data->id);

        $this->assertEquals("some", $event->name);
        $this->assertEquals("2016-07-28 00:00:00", $event->when);
        $this->assertEquals(2, $event->lat);
        $this->assertEquals(5, $event->long);
    }
}
