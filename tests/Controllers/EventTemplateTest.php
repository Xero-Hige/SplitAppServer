<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTemplateTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostEventTemplate()
    {
        /**
         * @var \App\Models\User $user
         * @var \App\Models\Event $event
         * @var \App\Models\EventTask $eventTask
         * @var \App\Models\EventTemplate $eventTemplate
         */
        $user = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();
        $eventTask = factory(\App\Models\EventTask::class)->make();
        $eventTask->event_id = $event->id;
        $eventTask->save();

        $this->json("POST", "eventTemplates", [
            "event_id" => $event->id
        ], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $eventTemplate = \App\Models\EventTemplate::find($data->id);
        $this->assertEquals($event->name, $eventTemplate->name);

        $this->assertEquals($eventTask->name, $eventTemplate->tasks[0]->name);

    }
}
