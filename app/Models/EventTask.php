<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTask extends Model
{
    public function assignee() {
        return $this->belongsTo(User::class, "facebook_id", "assignee");
    }

    public function getDoneAttribute($value) {
        return $value == 1;
    }
}
