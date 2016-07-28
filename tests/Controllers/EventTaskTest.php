<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTaskTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostEventTask()
    {
        $user = factory(\App\Models\User::class)->create();
        $assignee = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();

        $this->json("POST", "events/".$event->id."/tasks", [
            "name" => "some",
            "cost" => 5,
            "assignee" => $assignee->facebook_id
        ], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $eventTask = \App\Models\EventTask::find($data->id);

        $this->assertEquals("some", $eventTask->name);
        $this->assertEquals(5, $eventTask->cost);
        $this->assertEquals($assignee->facebook_id, $eventTask->assignee);
    }

    public function testPutEventTask()
    {
        $user = factory(\App\Models\User::class)->create();
        $assignee = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();
        $eventTask = factory(\App\Models\EventTask::class)->make();
        /**
         * @var \App\Models\EventTask $eventTask
         * @var \App\Models\Event $event
         */
        $eventTask->event_id = $event->id;
        $eventTask->assignee = $assignee->facebook_id;
        $eventTask->save();

        $this->json("PUT", "events/".$event->id."/tasks/".$eventTask->id, [
            "name" => "some",
            "cost" => 5,
            "assignee" => $user->facebook_id,
            "done" => TRUE
        ], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $eventTask = \App\Models\EventTask::find($data->id);

        $this->assertEquals("some", $eventTask->name);
        $this->assertEquals(5, $eventTask->cost);
        $this->assertEquals($user->facebook_id, $eventTask->assignee);
        $this->assertSame(TRUE, $eventTask->done);
    }

    public function testPutEventTaskEmptyFields()
    {
        $user = factory(\App\Models\User::class)->create();
        $assignee = factory(\App\Models\User::class)->create();
        $event = factory(\App\Models\Event::class)->create();
        $eventTask = factory(\App\Models\EventTask::class)->make();
        /**
         * @var \App\Models\EventTask $eventTask
         * @var \App\Models\Event $event
         */
        $eventTask->event_id = $event->id;
        $eventTask->assignee = $assignee->facebook_id;
        $eventTask->save();

        $this->json("PUT", "events/".$event->id."/tasks/".$eventTask->id, [], ["X-Auth-Facebook-ID" => $user->facebook_id, "X-Auth-Token" => $user->token]);
        $this->assertEquals(200, $this->response->getStatusCode());

        $data = json_decode($this->response->content())->data;

        $savedEventTask = \App\Models\EventTask::find($data->id);

        $this->assertEquals($eventTask->name, $savedEventTask->name);
        $this->assertEquals($eventTask->cost, $savedEventTask->cost);
        $this->assertEquals($eventTask->assignee, $savedEventTask->assignee);
        $this->assertEquals($eventTask->done, $savedEventTask->done);
    }
}
