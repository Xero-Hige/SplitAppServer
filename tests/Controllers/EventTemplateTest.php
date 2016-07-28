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

    public function testGetEventTemplates()
    {
        /**
         * @var \App\Models\User $user
         * @var \App\Models\Event $event
         * @var \App\Models\EventTask $eventTask
         * @var \App\Models\EventTemplate $eventTemplate
         */
        $user = factory(\App\Models\User::class)->create();

        $eventTemplate = new \App\Models\EventTemplate();
        $eventTemplate->name = "a";
        $eventTemplate->save();

        $eventTemplateTask = new \App\Models\EventTemplateTask();
        $eventTemplateTask->name = "b";
        $eventTemplateTask->event_template_id = $eventTemplate->id;
        $eventTemplateTask->save();

        $eventTemplate2 = new \App\Models\EventTemplate();
        $eventTemplate2->name = "c";
        $eventTemplate2->save();

        $eventTemplateTask2 = new \App\Models\EventTemplateTask();
        $eventTemplateTask2->name = "d";
        $eventTemplateTask2->event_template_id = $eventTemplate2->id;
        $eventTemplateTask2->save();

        $this->json("GET", "eventTemplates", [], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $savedEventTemplate = \App\Models\EventTemplate::find($data[0]->id);
        $this->assertEquals($eventTemplate->name, $savedEventTemplate->name);
        $this->assertEquals($eventTemplateTask->name, $savedEventTemplate->tasks[0]->name);

        $savedEventTemplate = \App\Models\EventTemplate::find($data[1]->id);
        $this->assertEquals($eventTemplate2->name, $savedEventTemplate->name);
        $this->assertEquals($eventTemplateTask2->name, $savedEventTemplate->tasks[0]->name);

    }
}
