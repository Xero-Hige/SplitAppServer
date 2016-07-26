<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\Models\User::class)->create();
        $user->facebook_id = 10207483104971247;
        $user->save();

        $event = new \App\Models\Event();
        $event->name = "PAST EVENT";
        $event->when = new DateTime("-2 months");
        $event->lat = 0.00;
        $event->long = 0.00;
        $event->save();

        $eventTask = new \App\Models\EventTask();
        $eventTask->name = "done task";
        $eventTask->assignee = $user->facebook_id;
        $eventTask->done = TRUE;
        $eventTask->event_id = $event->id;
        $eventTask->save();

        $eventTask = new \App\Models\EventTask();
        $eventTask->name = "undone task";
        $eventTask->assignee = $user->facebook_id;
        $eventTask->done = FALSE;
        $eventTask->event_id = $event->id;
        $eventTask->save();

        $eventInvitee = new \App\Models\EventInvitee();
        $eventInvitee->event_id = $event->id;
        $eventInvitee->user_id = $user->facebook_id;
        $eventInvitee->save();

        $event = new \App\Models\Event();
        $event->name = "CURRENT EVENT";
        $event->when = new DateTime("+2 months");
        $event->lat = 0.00;
        $event->long = 0.00;
        $event->save();

        $eventTask = new \App\Models\EventTask();
        $eventTask->name = "done task";
        $eventTask->assignee = $user->facebook_id;
        $eventTask->done = TRUE;
        $eventTask->event_id = $event->id;
        $eventTask->save();

        $eventTask = new \App\Models\EventTask();
        $eventTask->name = "undone task";
        $eventTask->assignee = $user->facebook_id;
        $eventTask->done = FALSE;
        $eventTask->event_id = $event->id;
        $eventTask->save();

        $eventInvitee = new \App\Models\EventInvitee();
        $eventInvitee->event_id = $event->id;
        $eventInvitee->user_id = $user->facebook_id;
        $eventInvitee->save();

    }
}
