<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTemplate extends Model
{
    public function tasks() {
        return $this->hasMany(EventTemplateTask::class);
    }

    public function fromEvent(Event $event) {
        $this->name = $event->name;
        $this->save();
        foreach ($event->tasks as $task) {
            $eventTemplateTask = new EventTemplateTask();
            $eventTemplateTask->name = $task->name;
            $this->tasks()->save($eventTemplateTask);
        }
    }
}
