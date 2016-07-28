<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventInviteeTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostEventInvitee()
    {
        /**
         * @var \App\Models\User $user
         * @var \App\Models\User $invitee
         * @var \App\Models\Event $event
         */
        $user = factory(\App\Models\User::class)->create();
        $invitee = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();

        $this->json("POST", "events/".$event->id."/invitees", [
            "invitee" => $invitee->facebook_id
        ], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $events_invited = $invitee->events()->get();

        $this->assertEquals(1, count($events_invited->toArray()));
        $this->assertEquals($event->id, $events_invited->get(0)->id);
    }
}
