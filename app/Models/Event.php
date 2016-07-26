<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $dates = ["when"];
    protected $hidden = ["pivot"];
    
    public function invitees() {
        return $this->belongsToMany(User::class, "event_invitees");
    }

    public function tasks() {
        return $this->hasMany(EventTask::class);
    }
}
